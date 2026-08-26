<?php
/**
 * inc/proforma-pdf.php - Dynamic B2B Pro-Forma PDF Engine for TPM SA
 * Generates instant, downloadable, tax-compliant Cameroon B2B Pro-Forma PDF documents.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'TPM_PDF' ) ) {
    class TPM_PDF {
        protected $page = 0;
        protected $n = 2;
        protected $offsets = [];
        protected $buffer = '';
        protected $pages = [];
        protected $w = 210.0;
        protected $h = 297.0;
        protected $k;
        protected $x = 10.0;
        protected $y = 10.0;
        protected $lMargin = 15.0;
        protected $rMargin = 15.0;
        protected $tMargin = 15.0;
        protected $bMargin = 15.0;
        protected $fontSizePt = 10;
        protected $fontSize = 10;
        protected $fontFamily = 'Helvetica';
        protected $fontStyle = '';
        protected $currentFont = 'F1';
        protected $state = 0;
        protected $images = [];

        public function __construct() {
            $this->k = 72.0 / 25.4;
            $this->fontSizePt = 10;
            $this->fontSize = $this->fontSizePt / $this->k;
        }

        public function Image($file, $x, $y, $w = 0, $h = 0) {
            if (!isset($this->images[$file])) {
                $info = getimagesize($file);
                if (!$info) return;
                $data = file_get_contents($file);
                $this->images[$file] = [
                    'idx'  => count($this->images) + 1,
                    'w'    => $info[0],
                    'h'    => $info[1],
                    'data' => $data,
                    'n'    => 0
                ];
            }
            $info = $this->images[$file];
            if ($w == 0 && $h == 0) {
                $w = $info['w'] / $this->k;
                $h = $info['h'] / $this->k;
            } elseif ($w == 0) {
                $w = $h * $info['w'] / $info['h'];
            } elseif ($h == 0) {
                $h = $w * $info['h'] / $info['w'];
            }

            $this->_out(sprintf('q %.2F 0 0 %.2F %.2F %.2F cm /I%d Do Q',
                $w * $this->k, $h * $this->k, $x * $this->k, ($this->h - ($y + $h)) * $this->k, $info['idx']));
        }


        public function AddPage() {
            $this->page++;
            $this->pages[$this->page] = '';
            $this->state = 1;
            $this->x = $this->lMargin;
            $this->y = $this->tMargin;
            $this->SetFont($this->fontFamily, $this->fontStyle, $this->fontSizePt);
        }

        public function SetFont($family, $style = '', $size = 10) {
            $this->fontFamily = $family;
            $this->fontStyle = strtoupper($style);
            $this->fontSizePt = $size;
            $this->fontSize = $size / $this->k;

            $fontKey = 'F1';
            if (strpos($this->fontStyle, 'B') !== false && strpos($this->fontStyle, 'I') !== false) {
                $fontKey = 'F4';
            } elseif (strpos($this->fontStyle, 'B') !== false) {
                $fontKey = 'F2';
            } elseif (strpos($this->fontStyle, 'I') !== false) {
                $fontKey = 'F3';
            }
            $this->currentFont = $fontKey;
            if ($this->page > 0) {
                $this->_out(sprintf('/%s %.2F Tf', $fontKey, $this->fontSizePt));
            }
        }

        public function SetTextColor($r, $g = null, $b = null) {
            if ($g === null) {
                $this->_out(sprintf('%.3F g', $r / 255));
            } else {
                $this->_out(sprintf('%.3F %.3F %.3F rg', $r / 255, $g / 255, $b / 255));
            }
        }

        public function SetFillColor($r, $g = null, $b = null) {
            if ($g === null) {
                $this->_out(sprintf('%.3F g', $r / 255));
            } else {
                $this->_out(sprintf('%.3F %.3F %.3F rg', $r / 255, $g / 255, $b / 255));
            }
        }

        public function SetDrawColor($r, $g = null, $b = null) {
            if ($g === null) {
                $this->_out(sprintf('%.3F G', $r / 255));
            } else {
                $this->_out(sprintf('%.3F %.3F %.3F RG', $r / 255, $g / 255, $b / 255));
            }
        }

        public function SetLineWidth($width) {
            $this->_out(sprintf('%.2F w', $width * $this->k));
        }

        public function Rect($x, $y, $w, $h, $style = '') {
            $op = 'S';
            if ($style === 'F') $op = 'f';
            elseif ($style === 'FD' || $style === 'DF') $op = 'B';
            $this->_out(sprintf('%.2F %.2F %.2F %.2F re %s', 
                $x * $this->k, ($this->h - $y - $h) * $this->k, $w * $this->k, $h * $this->k, $op));
        }

        public function Line($x1, $y1, $x2, $y2) {
            $this->_out(sprintf('%.2F %.2F m %.2F %.2F l S',
                $x1 * $this->k, ($this->h - $y1) * $this->k, $x2 * $this->k, ($this->h - $y2) * $this->k));
        }

        public function SetXY($x, $y) {
            $this->x = $x;
            $this->y = $y;
        }

        public function SetX($x) {
            $this->x = $x;
        }

        public function SetY($y) {
            $this->y = $y;
        }

        public function GetX() {
            return $this->x;
        }

        public function GetY() {
            return $this->y;
        }

        public function Ln($h = null) {
            $this->x = $this->lMargin;
            $this->y += ($h !== null) ? $h : ($this->fontSizePt * 0.35);
        }

        public function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false) {
            $k = $this->k;
            $s = '';
            if ($fill || $border == 1) {
                $op = ($fill && $border == 1) ? 'B' : ($fill ? 'f' : 'S');
                $s .= sprintf('%.2F %.2F %.2F %.2F re %s ', 
                    $this->x * $k, ($this->h - $this->y - $h) * $k, $w * $k, $h * $k, $op);
            }
            if ($txt !== '') {
                $txt2 = $this->_escape($txt);
                $width = $this->GetStringWidth($txt);
                $dx = 1.5;
                if ($align === 'R') {
                    $dx = $w - $width - 1.5;
                } elseif ($align === 'C') {
                    $dx = ($w - $width) / 2;
                }
                $s .= sprintf('BT %.2F %.2F Td (%s) Tj ET', 
                    ($this->x + $dx) * $k, ($this->h - ($this->y + 0.5 * $h + 0.3 * $this->fontSize)) * $k, $txt2);
            }
            if ($s) {
                $this->_out($s);
            }
            $this->x += $w;
            if ($ln == 1) {
                $this->x = $this->lMargin;
                $this->y += $h;
            } elseif ($ln == 2) {
                $this->x = $this->lMargin;
            }
        }

        public function MultiCell($w, $h, $txt, $border = 0, $align = 'J', $fill = false) {
            $lines = explode("\n", $txt);
            foreach ($lines as $line) {
                $this->Cell($w, $h, $line, $border, 1, $align, $fill);
            }
        }

        public function GetStringWidth($s) {
            return strlen($s) * ($this->fontSizePt * 0.52) / $this->k;
        }

        protected function _escape($s) {
            $replacements = [
                'é' => "\xE9", 'è' => "\xE8", 'ê' => "\xEA", 'ë' => "\xEB",
                'à' => "\xE0", 'â' => "\xE2", 'ä' => "\xE4",
                'î' => "\xEE", 'ï' => "\xEF",
                'ô' => "\xF4", 'ö' => "\xF6",
                'ù' => "\xF9", 'û' => "\xFB", 'ü' => "\xFC",
                'ç' => "\xE7",
                'É' => "\xC9", 'È' => "\xC8", 'Ê' => "\xCA",
                'À' => "\xC0", 'Â' => "\xC2",
                'Ô' => "\xD4",
                'Ç' => "\xC7",
                '°' => "\xB0", '²' => "\xB2", '³' => "\xB3",
                '•' => "\x95", '—' => "-", '–' => "-",
                '«' => "\xAB", '»' => "\xBB",
                '’' => "'", '“' => '"', '”' => '"'
            ];
            $s = strtr($s, $replacements);
            return strtr($s, [')' => '\\)', '(' => '\\(', '\\' => '\\\\']);
        }

        protected function _out($s) {
            if ($this->state == 1) {
                $this->pages[$this->page] .= $s . "\n";
            } else {
                $this->buffer .= $s . "\n";
            }
        }

        public function Output($dest = 'I', $name = 'proforma.pdf') {
            $this->state = 2;
            $this->buffer = '';
            
            $this->_putheader();
            $this->_putimages();
            $this->_putpages();
            $this->_putresources();
            $this->_putinfo();
            $this->_puttrailer();
            
            if ($dest === 'F') {
                file_put_contents($name, $this->buffer);
                return true;
            } elseif ($dest === 'S') {
                return $this->buffer;
            } elseif ($dest === 'D') {
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . $name . '"');
                header('Content-Length: ' . strlen($this->buffer));
                header('Cache-Control: private, max-age=0, must-revalidate');
                header('Pragma: public');
                echo $this->buffer;
                exit;
            } else { // 'I' Inline
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . $name . '"');
                header('Content-Length: ' . strlen($this->buffer));
                header('Cache-Control: private, max-age=0, must-revalidate');
                header('Pragma: public');
                echo $this->buffer;
                exit;
            }
        }

        protected function _newobj() {
            $this->n++;
            $this->offsets[$this->n] = strlen($this->buffer);
            $this->_out($this->n . ' 0 obj');
        }

        protected function _putheader() {
            $this->_out('%PDF-1.4');
        }

        protected function _putimages() {
            foreach ($this->images as $file => &$info) {
                $this->_newobj();
                $info['n'] = $this->n;
                $this->_out('<</Type /XObject /Subtype /Image /Width ' . $info['w'] . ' /Height ' . $info['h'] . ' /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length ' . strlen($info['data']) . '>>');
                $this->_out("stream\n" . $info['data'] . "\nendstream");
                $this->_out('endobj');
            }
        }

        protected function _putpages() {
            $nb = $this->page;
            $page_obj_start = $this->n + 1;
            for ($n = 1; $n <= $nb; $n++) {
                $this->_newobj();
                $this->_out('<</Type /Page');
                $this->_out('/Parent 1 0 R');
                $this->_out('/Resources 2 0 R');
                $this->_out('/Contents ' . ($this->n + 1) . ' 0 R>>');
                $this->_out('endobj');

                $p = $this->pages[$n];
                $this->_newobj();
                $this->_out('<</Length ' . strlen($p) . '>>');
                $this->_out("stream\n" . $p . "endstream");
                $this->_out('endobj');
            }

            $this->offsets[1] = strlen($this->buffer);
            $this->_out('1 0 obj');
            $this->_out('<</Type /Pages');
            $kids = '/Kids [';
            for ($i = 0; $i < $nb; $i++) {
                $kids .= ($page_obj_start + 2 * $i) . ' 0 R ';
            }
            $this->_out($kids . ']');
            $this->_out('/Count ' . $nb);
            $this->_out(sprintf('/MediaBox [0 0 %.2F %.2F]', $this->w * $this->k, $this->h * $this->k));
            $this->_out('>>');
            $this->_out('endobj');
        }

        protected function _putresources() {
            $this->offsets[2] = strlen($this->buffer);
            $this->_out('2 0 obj');
            $this->_out('<< /ProcSet [/PDF /Text /ImageB /ImageC /ImageI]');
            $this->_out('/Font <<');
            $this->_out('/F1 << /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>');
            $this->_out('/F2 << /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>');
            $this->_out('/F3 << /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Oblique /Encoding /WinAnsiEncoding >>');
            $this->_out('/F4 << /Type /Font /Subtype /Type1 /BaseFont /Helvetica-BoldOblique /Encoding /WinAnsiEncoding >>');
            $this->_out('>>');
            if (!empty($this->images)) {
                $this->_out('/XObject <<');
                foreach ($this->images as $file => $info) {
                    $this->_out('/I' . $info['idx'] . ' ' . $info['n'] . ' 0 R');
                }
                $this->_out('>>');
            }
            $this->_out('>>');
            $this->_out('endobj');
        }

        protected function _putinfo() {
            $this->_newobj();
            $this->_out('<< /Title (TPM SA - Facture Pro-Forma B2B) /Author (TPM SA - Groupe CAC) /Subject (Facture Pro-Forma Officielle) /Creator (TPM SA ERP) /CreationDate (D:' . date('YmdHis') . ') >>');
            $this->_out('endobj');
        }

        protected function _puttrailer() {
            $offset_xref = strlen($this->buffer);
            $this->_out('xref');
            $this->_out('0 ' . ($this->n + 1));
            $this->_out('0000000000 65535 f ');
            for ($i = 1; $i <= $this->n; $i++) {
                $this->_out(sprintf('%010d 00000 n ', $this->offsets[$i]));
            }
            $this->_out('trailer');
            $this->_out('<< /Size ' . ($this->n + 1) . ' /Root 1 0 R /Info ' . $this->n . ' 0 R >>');
            $this->_out('startxref');
            $this->_out($offset_xref);
            $this->_out('%%EOF');
        }
    }
}

/**
 * Handle Request for Generating Pro-Forma PDF
 */
function tpm_handle_proforma_pdf_request() {
    if ( ! isset( $_GET['generate_proforma_pdf'] ) && ! isset( $_GET['tpm_proforma_pdf'] ) ) {
        return;
    }

    if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
        return;
    }

    $cart = WC()->cart;
    $cart_items = $cart->get_cart();
    
    // Generate unique proforma reference
    $proforma_no = 'TPM-PRO-' . date('Y') . '-' . strtoupper(substr(md5(session_id() . time()), 0, 5));
    $emission_date = date('d/m/Y');
    $validity_date = date('d/m/Y', strtotime('+30 days'));

    $navy_r = 28; $navy_g = 19; $navy_b = 64;       // #1C1340
    $orange_r = 216; $orange_g = 75; $orange_b = 31; // #D84B1F
    $gray_bg_r = 245; $gray_bg_g = 247; $gray_bg_b = 250;

    $pdf = new TPM_PDF();
    $pdf->AddPage();

    // TOP BANNER
    $pdf->SetFillColor($navy_r, $navy_g, $navy_b);
    $pdf->Rect(0, 0, 210, 42, 'F');
    $pdf->SetFillColor($orange_r, $orange_g, $orange_b);
    $pdf->Rect(0, 42, 210, 2.5, 'F');

    // Logo / Emblem - Official TPM SA Logo Container
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Rect(15, 8, 30, 26, 'F');
    $logo_path = get_template_directory() . '/assets/images/logo_tpm.jpg';
    if ( file_exists( $logo_path ) ) {
        $pdf->Image( $logo_path, 16.5, 12, 27, 14 );
    } else {
        $pdf->SetFillColor($orange_r, $orange_g, $orange_b);
        $pdf->Rect(15, 8, 24, 24, 'F');
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->SetXY(15, 15);
        $pdf->Cell(24, 10, 'TPM', 0, 0, 'C');
    }

    // Header Title
    $pdf->SetXY(48, 8);
    $pdf->SetFont('Helvetica', 'B', 15);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(95, 7, 'TPM SA — GROUPE CAC', 0, 1, 'L');

    $pdf->SetXY(48, 16);
    $pdf->SetFont('Helvetica', '', 8.5);
    $pdf->SetTextColor(220, 225, 235);
    $pdf->Cell(95, 5, 'Transformation Métallique & Plasturgie • Douala PK12 & Bekoko (Cameroun)', 0, 1, 'L');

    $pdf->SetXY(48, 22);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(95, 5, 'NIU : M052217435713Q  •  RCCM : RC/DLA/1976/B/XXXX  •  TVA : 19.25%', 0, 1, 'L');

    $pdf->SetXY(48, 28);
    $pdf->SetFont('Helvetica', '', 7.5);
    $pdf->SetTextColor(190, 195, 210);
    $pdf->Cell(95, 5, 'Email : CAC_VIS3@YAHOO.FR  •  WhatsApp / Tel : +237 655 70 58 66 / +237 696 34 00 08', 0, 1, 'L');

    // Right Pro-Forma Tag Box
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(210, 215, 225);
    $pdf->Rect(142, 8, 53, 27, 'FD');

    $pdf->SetXY(142, 10);
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(53, 5, 'FACTURE PRO-FORMA B2B', 0, 1, 'C');

    $pdf->SetXY(142, 16);
    $pdf->SetFont('Helvetica', 'B', 8.5);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(53, 4.5, $proforma_no, 0, 1, 'C');

    $pdf->SetXY(142, 22);
    $pdf->SetFont('Helvetica', '', 7.5);
    $pdf->SetTextColor(80, 90, 105);
    $pdf->Cell(53, 4, "Date : {$emission_date}", 0, 1, 'C');

    $pdf->SetXY(142, 27);
    $pdf->SetFont('Helvetica', 'I', 7);
    $pdf->SetTextColor(120, 130, 145);
    $pdf->Cell(53, 4, "Validité : 30 jours ({$validity_date})", 0, 1, 'C');

    // Slogan Strip
    $pdf->SetY(48);
    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(180, 5, '"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ"', 0, 1, 'C');

    // Client & Destination Info Box
    $pdf->SetY(56);
    $pdf->SetFillColor($gray_bg_r, $gray_bg_g, $gray_bg_b);
    $pdf->SetDrawColor(220, 225, 235);
    $pdf->Rect(15, 55, 180, 24, 'FD');

    $current_user = wp_get_current_user();
    $client_name = ($current_user && $current_user->exists()) ? $current_user->display_name : 'Client / Entreprise B2B';
    $client_email = ($current_user && $current_user->exists()) ? $current_user->user_email : 'Non renseigné (Devis Flash)';

    $pdf->SetXY(20, 58);
    $pdf->SetFont('Helvetica', 'B', 8.5);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(85, 4.5, "DESTINATAIRE / CLIENT :", 0, 0, 'L');
    $pdf->Cell(85, 4.5, "CONDITIONS DE LIVRAISON & ENLÈVEMENT :", 0, 1, 'L');

    $pdf->SetXY(20, 64);
    $pdf->SetFont('Helvetica', '', 8);
    $pdf->SetTextColor(60, 70, 85);
    $pdf->Cell(85, 4, "Nom : {$client_name}", 0, 0, 'L');
    $pdf->Cell(85, 4, "Mise à disposition : Enlèvement Usine Bekoko (Ex-Works)", 0, 1, 'L');

    $pdf->SetXY(20, 69);
    $pdf->Cell(85, 4, "Contact : {$client_email}", 0, 0, 'L');
    $pdf->Cell(85, 4, "Délai de découpe / profilage : 24h à 48h après validation", 0, 1, 'L');

    // TABLE HEADER
    $pdf->SetY(84);
    $pdf->SetFillColor($navy_r, $navy_g, $navy_b);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Helvetica', 'B', 8);

    $pdf->Cell(18, 7, "RÉF", 1, 0, 'C', true);
    $pdf->Cell(78, 7, "DÉSIGNATION & CARACTÉRISTIQUES", 1, 0, 'L', true);
    $pdf->Cell(20, 7, "UNITÉ", 1, 0, 'C', true);
    $pdf->Cell(16, 7, "QTÉ", 1, 0, 'C', true);
    $pdf->Cell(24, 7, "P.U. HT", 1, 0, 'R', true);
    $pdf->Cell(24, 7, "TOTAL HT", 1, 1, 'R', true);

    $total_ht = 0;
    $row_idx = 0;

    if ( ! empty( $cart_items ) ) {
        foreach ( $cart_items as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = $cart_item['product_id'];

            if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 ) continue;

            $sku   = $_product->get_sku() ?: 'TPM-' . $product_id;
            $name  = $_product->get_name();
            $qty   = $cart_item['quantity'];
            $price = floatval( $_product->get_price() );
            $unit  = get_post_meta( $product_id, '_unit', true ) ?: 'Unité';

            $options = [];
            if ( ! empty( $cart_item['flash_length'] ) ) $options[] = 'Long: ' . $cart_item['flash_length'];
            if ( ! empty( $cart_item['flash_color'] ) )  $options[] = 'Coul: ' . $cart_item['flash_color'];
            $opt_str = ! empty( $options ) ? ' (' . implode( ', ', $options ) . ')' : '';

            $line_total = $price * $qty;
            $total_ht += $line_total;

            $fill = ($row_idx % 2 == 1);
            $pdf->SetFillColor(248, 250, 252);
            $pdf->SetDrawColor(220, 225, 235);
            $pdf->SetTextColor(30, 40, 55);
            $pdf->SetFont('Helvetica', '', 7.5);

            $pdf->Cell(18, 6.5, $sku, 1, 0, 'C', $fill);
            $pdf->Cell(78, 6.5, substr($name . $opt_str, 0, 48), 1, 0, 'L', $fill);
            $pdf->Cell(20, 6.5, substr($unit, 0, 12), 1, 0, 'C', $fill);
            $pdf->Cell(16, 6.5, strval($qty), 1, 0, 'C', $fill);
            $pdf->Cell(24, 6.5, number_format($price, 0, ',', ' ') . ' F', 1, 0, 'R', $fill);
            $pdf->Cell(24, 6.5, number_format($line_total, 0, ',', ' ') . ' F', 1, 1, 'R', $fill);

            $row_idx++;
        }
    } else {
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(100, 110, 125);
        $pdf->SetFont('Helvetica', 'I', 8);
        $pdf->Cell(180, 12, "Aucun article actuellement dans votre sélection. Ajoutez des produits depuis le catalogue.", 1, 1, 'C');
    }

    // TAX CALCULATIONS (19.25% TVA Cameroun)
    $tva_amount = round($total_ht * 0.1925, 0);
    $total_ttc  = $total_ht + $tva_amount;

    // TOTALS BOX
    $pdf->SetY($pdf->GetY() + 4);
    $totals_y = $pdf->GetY();

    // Left Notes Box
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(220, 225, 235);
    $pdf->Rect(15, $totals_y, 100, 36, 'FD');

    $pdf->SetXY(18, $totals_y + 3);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(94, 4, "CONDITIONS DE RÈGLEMENT & INFORMATIONS BANCAIRES :", 0, 1, 'L');

    $pdf->SetXY(18, $totals_y + 8);
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->SetTextColor(80, 90, 105);
    $pdf->Cell(94, 3.5, "• Modes acceptés : Virement bancaire, Chèque certifié, Espèces caisse usine.", 0, 1, 'L');
    $pdf->SetXY(18, $totals_y + 12);
    $pdf->Cell(94, 3.5, "• Paiement Mobile : Orange Money & MTN Mobile Money disponibles.", 0, 1, 'L');
    $pdf->SetXY(18, $totals_y + 16);
    $pdf->Cell(94, 3.5, "• Acompte de 70% à la commande pour tôles profilées sur mesure.", 0, 1, 'L');
    $pdf->SetXY(18, $totals_y + 20);
    $pdf->Cell(94, 3.5, "• Solde de 30% exigible avant enlèvement ou expédition sur chantier.", 0, 1, 'L');
    $pdf->SetXY(18, $totals_y + 25);
    $pdf->SetFont('Helvetica', 'B', 7);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(94, 3.5, "Validation WhatsApp : +237 655 70 58 66 (Service Commercial TPM SA)", 0, 1, 'L');

    // Right Totals Table
    $pdf->SetXY(120, $totals_y);
    $pdf->SetDrawColor(220, 225, 235);
    $pdf->SetFillColor(248, 250, 252);
    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->SetTextColor(60, 70, 85);

    $pdf->Cell(40, 7, "TOTAL GÉNÉRAL HT :", 1, 0, 'L', true);
    $pdf->Cell(35, 7, number_format($total_ht, 0, ',', ' ') . ' FCFA', 1, 1, 'R', true);

    $pdf->SetX(120);
    $pdf->Cell(40, 7, "TVA CAMEROUN (19.25%) :", 1, 0, 'L', true);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(35, 7, number_format($tva_amount, 0, ',', ' ') . ' FCFA', 1, 1, 'R', true);

    $pdf->SetX(120);
    $pdf->SetTextColor(16, 140, 90);
    $pdf->Cell(40, 6, "Manutention Usine :", 1, 0, 'L', true);
    $pdf->Cell(35, 6, "Inclus Usine", 1, 1, 'R', true);

    // Total TTC Highlight
    $pdf->SetX(120);
    $pdf->SetFillColor($navy_r, $navy_g, $navy_b);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell(40, 9, "TOTAL GÉNÉRAL TTC :", 1, 0, 'L', true);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(35, 9, number_format($total_ttc, 0, ',', ' ') . ' FCFA', 1, 1, 'R', true);

    // SIGNATURE & CACHET BOX
    $pdf->SetY($totals_y + 42);
    $sig_y = $pdf->GetY();

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(210, 215, 225);
    $pdf->Rect(15, $sig_y, 88, 30, 'FD');
    $pdf->Rect(107, $sig_y, 88, 30, 'FD');

    $pdf->SetXY(18, $sig_y + 3);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(82, 4, "BON POUR ACCORD DU CLIENT (Cachet & Signature) :", 0, 1, 'L');
    $pdf->SetXY(18, $sig_y + 8);
    $pdf->SetFont('Helvetica', 'I', 7);
    $pdf->SetTextColor(130, 140, 155);
    $pdf->Cell(82, 4, "Mention manuscrite 'Bon pour commande' + Date :", 0, 1, 'L');

    $pdf->SetXY(110, $sig_y + 3);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(82, 4, "DIRECTION COMMERCIALE TPM SA (Groupe CAC) :", 0, 1, 'L');
    $pdf->SetXY(110, $sig_y + 8);
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->SetTextColor(80, 90, 105);
    $pdf->Cell(82, 4, "Validé par le Service des Ventes & Expéditions Usine", 0, 1, 'L');
    $pdf->SetXY(110, $sig_y + 20);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(82, 4, "[ CACHET ÉLECTRONIQUE TPM SA ]", 0, 1, 'C');

    // FOOTER LEGAL
    $pdf->SetFillColor($navy_r, $navy_g, $navy_b);
    $pdf->Rect(0, 275, 210, 22, 'F');

    $pdf->SetXY(15, 277);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(180, 4, "TPM SA (GROUPE CAC) — USINES DE DOUALA PK12 & BEKOKO (CAMEROUN)", 0, 1, 'C');

    $pdf->SetXY(15, 282);
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->SetTextColor(220, 225, 235);
    $pdf->Cell(180, 3.5, "Siège Douala PK12 : B.P. 12530 Douala | Usine Bekoko : Axe lourd Douala - Bafoussam | Email : CAC_VIS3@YAHOO.FR", 0, 1, 'C');

    $pdf->SetXY(15, 286.5);
    $pdf->SetFont('Helvetica', 'I', 6.5);
    $pdf->SetTextColor(180, 190, 205);
    $pdf->Cell(180, 3.5, "Ce document constitue une offre de prix pro-forma officielle. Tarifs garantis pendant la durée de validité mentionnée.", 0, 1, 'C');

    $filename = 'Proforma_' . $proforma_no . '.pdf';
    $pdf->Output('I', $filename);
    exit;
}
add_action( 'template_redirect', 'tpm_handle_proforma_pdf_request', 10 );

/**
 * Generate Pro-Forma PDF File for a WooCommerce Order
 * 
 * @param WC_Order|int $order
 * @return string|false Absolute path to generated PDF file
 */
function tpm_generate_order_proforma_pdf_file( $order ) {
    if ( is_numeric( $order ) ) {
        $order = wc_get_order( $order );
    }
    if ( ! $order || ! is_a( $order, 'WC_Order' ) ) {
        return false;
    }

    $upload_dir = wp_upload_dir();
    $pdf_dir = $upload_dir['basedir'] . '/proformas';
    if ( ! file_exists( $pdf_dir ) ) {
        wp_mkdir_p( $pdf_dir );
    }

    $order_id      = $order->get_id();
    $order_number  = $order->get_order_number();
    $filename      = 'Proforma_Commande_' . $order_number . '.pdf';
    $filepath      = $pdf_dir . '/' . $filename;

    $proforma_no   = 'TPM-PRO-' . date('Y') . '-' . str_pad( $order_number, 5, '0', STR_PAD_LEFT );
    $emission_date = $order->get_date_created() ? $order->get_date_created()->date_i18n( 'd/m/Y' ) : date('d/m/Y');
    $validity_date = date('d/m/Y', strtotime('+30 days'));

    $navy_r = 28; $navy_g = 19; $navy_b = 64;       // #1C1340
    $orange_r = 216; $orange_g = 75; $orange_b = 31; // #D84B1F
    $gray_bg_r = 245; $gray_bg_g = 247; $gray_bg_b = 250;

    $pdf = new TPM_PDF();
    $pdf->AddPage();

    // TOP BANNER
    $pdf->SetFillColor($navy_r, $navy_g, $navy_b);
    $pdf->Rect(0, 0, 210, 42, 'F');
    $pdf->SetFillColor($orange_r, $orange_g, $orange_b);
    $pdf->Rect(0, 42, 210, 2.5, 'F');

    // Logo Container
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Rect(15, 8, 30, 26, 'F');
    $logo_path = get_template_directory() . '/assets/images/logo_tpm.jpg';
    if ( file_exists( $logo_path ) ) {
        $pdf->Image( $logo_path, 16.5, 12, 27, 14 );
    }

    // Header Title
    $pdf->SetXY(48, 8);
    $pdf->SetFont('Helvetica', 'B', 15);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(95, 7, 'TPM SA — GROUPE CAC', 0, 1, 'L');

    $pdf->SetXY(48, 16);
    $pdf->SetFont('Helvetica', '', 8.5);
    $pdf->SetTextColor(220, 225, 235);
    $pdf->Cell(95, 5, 'Transformation Métallique & Plasturgie • Douala PK12 & Bekoko (Cameroun)', 0, 1, 'L');

    $pdf->SetXY(48, 22);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(95, 5, 'NIU : M052217435713Q  •  RCCM : RC/DLA/1976/B/XXXX  •  TVA : 19.25%', 0, 1, 'L');

    $pdf->SetXY(48, 28);
    $pdf->SetFont('Helvetica', '', 7.5);
    $pdf->SetTextColor(190, 195, 210);
    $pdf->Cell(95, 5, 'Email : CAC_VIS3@YAHOO.FR  •  WhatsApp / Tel : +237 655 70 58 66 / +237 696 34 00 08', 0, 1, 'L');

    // Right Pro-Forma Tag Box
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(210, 215, 225);
    $pdf->Rect(144, 8, 51, 27, 'FD');

    $pdf->SetXY(144, 10);
    $pdf->SetFont('Helvetica', 'B', 8.5);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(51, 5, 'FACTURE PRO-FORMA B2B', 0, 1, 'C');

    $pdf->SetXY(144, 16);
    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(51, 4.5, $proforma_no, 0, 1, 'C');

    $pdf->SetXY(144, 22);
    $pdf->SetFont('Helvetica', '', 7.5);
    $pdf->SetTextColor(80, 90, 105);
    $pdf->Cell(51, 4, "Date : {$emission_date}", 0, 1, 'C');

    $pdf->SetXY(144, 27);
    $pdf->SetFont('Helvetica', 'I', 7);
    $pdf->SetTextColor(120, 130, 145);
    $pdf->Cell(51, 4, "Commande N° #{$order_number}", 0, 1, 'C');

    // Slogan Strip
    $pdf->SetY(48);
    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(180, 5, '"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ"', 0, 1, 'C');

    // Client & Destination Info Box
    $pdf->SetY(56);
    $pdf->SetFillColor($gray_bg_r, $gray_bg_g, $gray_bg_b);
    $pdf->SetDrawColor(220, 225, 235);
    $pdf->Rect(15, 55, 180, 26, 'FD');

    $billing_name = trim( $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() ) ?: 'Client Particulier / B2B';
    $company      = $order->get_billing_company() ?: 'Entreprise B2B / Chantier';
    $email        = $order->get_billing_email() ?: 'cac_vis3@yahoo.fr';
    $phone        = $order->get_billing_phone() ?: '+237';
    $address      = wp_strip_all_tags( $order->get_formatted_billing_address() );
    $niu          = get_post_meta( $order_id, '_billing_niu', true ) ?: 'M052217435713Q';
    $rccm         = get_post_meta( $order_id, '_billing_rccm', true ) ?: 'DLA/2026/B/1976';

    $pdf->SetXY(20, 57);
    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(85, 4, "DESTINATAIRE / CLIENT :", 0, 0, 'L');
    $pdf->Cell(85, 4, "CONDITIONS DE LIVRAISON & ENLÈVEMENT :", 0, 1, 'L');

    $pdf->SetXY(20, 62);
    $pdf->SetFont('Helvetica', '', 7.5);
    $pdf->SetTextColor(60, 70, 85);
    $pdf->Cell(85, 3.5, "Nom : {$billing_name} (" . substr($company, 0, 25) . ")", 0, 0, 'L');
    $pdf->Cell(85, 3.5, "Mise à disposition : Enlèvement Usine Bekoko (Ex-Works)", 0, 1, 'L');

    $pdf->SetXY(20, 66);
    $pdf->Cell(85, 3.5, "Email : {$email} | Tél : {$phone}", 0, 0, 'L');
    $pdf->Cell(85, 3.5, "Délai de découpe / profilage : 24h à 48h après validation", 0, 1, 'L');

    $pdf->SetXY(20, 70);
    $pdf->Cell(85, 3.5, "NIU : {$niu} | RCCM : {$rccm}", 0, 0, 'L');
    $pdf->Cell(85, 3.5, "Adresse : " . substr($address, 0, 45), 0, 1, 'L');

    // TABLE HEADER
    $pdf->SetY(85);
    $pdf->SetFillColor($navy_r, $navy_g, $navy_b);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Helvetica', 'B', 8);

    $pdf->Cell(18, 7, "RÉF", 1, 0, 'C', true);
    $pdf->Cell(78, 7, "DÉSIGNATION & CARACTÉRISTIQUES", 1, 0, 'L', true);
    $pdf->Cell(20, 7, "UNITÉ", 1, 0, 'C', true);
    $pdf->Cell(16, 7, "QTÉ", 1, 0, 'C', true);
    $pdf->Cell(24, 7, "P.U. HT", 1, 0, 'R', true);
    $pdf->Cell(24, 7, "TOTAL HT", 1, 1, 'R', true);

    $row_idx = 0;
    foreach ( $order->get_items() as $item_id => $item ) {
        $product = $item->get_product();
        $name    = $item->get_name();
        $qty     = $item->get_quantity();
        $sku     = $product ? $product->get_sku() : 'TPM-REF';
        $unit    = $product ? ( get_post_meta( $product->get_id(), '_unit', true ) ?: 'Unité' ) : 'Unité';
        $price   = $product ? floatval( $product->get_price() ) : ( $qty > 0 ? floatval($item->get_subtotal() / $qty) : 0 );
        $line_total = floatval( $item->get_subtotal() );

        $meta_parts = [];
        $meta_data = $item->get_formatted_meta_data();
        if ( ! empty( $meta_data ) ) {
            foreach ( $meta_data as $m ) {
                $meta_parts[] = esc_html( $m->display_key ) . ': ' . wp_strip_all_tags( $m->display_value );
            }
        }
        $opt_str = ! empty( $meta_parts ) ? ' (' . implode( ', ', $meta_parts ) . ')' : '';

        $fill = ($row_idx % 2 == 1);
        $pdf->SetFillColor(248, 250, 252);
        $pdf->SetDrawColor(220, 225, 235);
        $pdf->SetTextColor(30, 40, 55);
        $pdf->SetFont('Helvetica', '', 7.5);

        $pdf->Cell(18, 6.5, $sku, 1, 0, 'C', $fill);
        $pdf->Cell(78, 6.5, substr($name . $opt_str, 0, 48), 1, 0, 'L', $fill);
        $pdf->Cell(20, 6.5, substr($unit, 0, 12), 1, 0, 'C', $fill);
        $pdf->Cell(16, 6.5, strval($qty), 1, 0, 'C', $fill);
        $pdf->Cell(24, 6.5, number_format($price, 0, ',', ' ') . ' F', 1, 0, 'R', $fill);
        $pdf->Cell(24, 6.5, number_format($line_total, 0, ',', ' ') . ' F', 1, 1, 'R', $fill);

        $row_idx++;
    }

    $subtotal_ht = floatval( $order->get_subtotal() );
    $total_tax   = floatval( $order->get_total_tax() );
    $total_ttc   = floatval( $order->get_total() );

    // TOTALS BOX
    $pdf->SetY($pdf->GetY() + 4);
    $totals_y = $pdf->GetY();

    // Left Notes Box
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(220, 225, 235);
    $pdf->Rect(15, $totals_y, 100, 36, 'FD');

    $pdf->SetXY(18, $totals_y + 3);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(94, 4, "CONDITIONS DE RÈGLEMENT & INFORMATIONS BANCAIRES :", 0, 1, 'L');

    $pdf->SetXY(18, $totals_y + 8);
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->SetTextColor(80, 90, 105);
    $pdf->Cell(94, 3.5, "• Modes acceptés : Virement bancaire, Chèque certifié, Espèces caisse usine.", 0, 1, 'L');
    $pdf->SetXY(18, $totals_y + 12);
    $pdf->Cell(94, 3.5, "• Paiement Mobile : Orange Money & MTN Mobile Money disponibles.", 0, 1, 'L');
    $pdf->SetXY(18, $totals_y + 16);
    $pdf->Cell(94, 3.5, "• Acompte de 70% à la commande pour tôles profilées sur mesure.", 0, 1, 'L');
    $pdf->SetXY(18, $totals_y + 20);
    $pdf->Cell(94, 3.5, "• Solde de 30% exigible avant enlèvement ou expédition sur chantier.", 0, 1, 'L');
    $pdf->SetXY(18, $totals_y + 25);
    $pdf->SetFont('Helvetica', 'B', 7);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(94, 3.5, "Validation WhatsApp : +237 655 70 58 66 (Service Commercial TPM SA)", 0, 1, 'L');

    // Right Totals Table
    $pdf->SetXY(120, $totals_y);
    $pdf->SetDrawColor(220, 225, 235);
    $pdf->SetFillColor(248, 250, 252);
    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->SetTextColor(60, 70, 85);

    $pdf->Cell(40, 7, "TOTAL GÉNÉRAL HT :", 1, 0, 'L', true);
    $pdf->Cell(35, 7, number_format($subtotal_ht, 0, ',', ' ') . ' FCFA', 1, 1, 'R', true);

    $pdf->SetX(120);
    $pdf->Cell(40, 7, "TVA CAMEROUN (19.25%) :", 1, 0, 'L', true);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(35, 7, number_format($total_tax, 0, ',', ' ') . ' FCFA', 1, 1, 'R', true);

    $pdf->SetX(120);
    $pdf->SetTextColor(16, 140, 90);
    $pdf->Cell(40, 6, "Manutention Usine :", 1, 0, 'L', true);
    $pdf->Cell(35, 6, "Inclus Usine", 1, 1, 'R', true);

    // Total TTC Highlight
    $pdf->SetX(120);
    $pdf->SetFillColor($navy_r, $navy_g, $navy_b);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Cell(40, 9, "TOTAL GÉNÉRAL TTC :", 1, 0, 'L', true);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(35, 9, number_format($total_ttc, 0, ',', ' ') . ' FCFA', 1, 1, 'R', true);

    // SIGNATURE & CACHET BOX
    $pdf->SetY($totals_y + 42);
    $sig_y = $pdf->GetY();

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(210, 215, 225);
    $pdf->Rect(15, $sig_y, 88, 30, 'FD');
    $pdf->Rect(107, $sig_y, 88, 30, 'FD');

    $pdf->SetXY(18, $sig_y + 3);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(82, 4, "BON POUR ACCORD DU CLIENT (Cachet & Signature) :", 0, 1, 'L');
    $pdf->SetXY(18, $sig_y + 8);
    $pdf->SetFont('Helvetica', 'I', 7);
    $pdf->SetTextColor(130, 140, 155);
    $pdf->Cell(82, 4, "Mention manuscrite 'Bon pour commande' + Date :", 0, 1, 'L');

    $pdf->SetXY(110, $sig_y + 3);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($navy_r, $navy_g, $navy_b);
    $pdf->Cell(82, 4, "DIRECTION COMMERCIALE TPM SA (Groupe CAC) :", 0, 1, 'L');
    $pdf->SetXY(110, $sig_y + 8);
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->SetTextColor(80, 90, 105);
    $pdf->Cell(82, 4, "Validé par le Service des Ventes & Expéditions Usine", 0, 1, 'L');
    $pdf->SetXY(110, $sig_y + 20);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(82, 4, "[ CACHET ÉLECTRONIQUE TPM SA ]", 0, 1, 'C');

    // FOOTER LEGAL
    $pdf->SetFillColor($navy_r, $navy_g, $navy_b);
    $pdf->Rect(0, 275, 210, 22, 'F');

    $pdf->SetXY(15, 277);
    $pdf->SetFont('Helvetica', 'B', 7.5);
    $pdf->SetTextColor($orange_r, $orange_g, $orange_b);
    $pdf->Cell(180, 4, "TPM SA (GROUPE CAC) — USINES DE DOUALA PK12 & BEKOKO (CAMEROUN)", 0, 1, 'C');

    $pdf->SetXY(15, 282);
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->SetTextColor(220, 225, 235);
    $pdf->Cell(180, 3.5, "Siège Douala PK12 : B.P. 12530 Douala | Usine Bekoko : Axe lourd Douala - Bafoussam | Email : CAC_VIS3@YAHOO.FR", 0, 1, 'C');

    $pdf->SetXY(15, 286.5);
    $pdf->SetFont('Helvetica', 'I', 6.5);
    $pdf->SetTextColor(180, 190, 205);
    $pdf->Cell(180, 3.5, "Ce document constitue une offre de prix pro-forma officielle. Tarifs garantis pendant la durée de validité mentionnée.", 0, 1, 'C');

    $pdf->Output('F', $filepath);
    return $filepath;
}

