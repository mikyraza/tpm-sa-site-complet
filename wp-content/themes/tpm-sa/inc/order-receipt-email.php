<?php
/**
 * inc/order-receipt-email.php
 * Automated Dual-Receipt Delivery System for TPM SA (Customer + Admin)
 * Generates and dispatches responsive, tax-compliant HTML Order Receipts & Pro-Forma Invoices.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Configure WooCommerce Default Email Recipients
 */
add_filter( 'woocommerce_email_recipient_new_order', function( $recipient, $order = null ) {
    $admin_email = get_option( 'admin_email' );
    $tpm_commercial = 'cac_vis3@yahoo.fr';

    $recipients = array_filter( array_unique( [ $admin_email, $tpm_commercial ] ) );
    return implode( ', ', $recipients );
}, 10, 2 );

/**
 * Build Professional HTML Order Receipt
 */
function tpm_generate_order_receipt_html( $order ) {
    if ( ! $order ) return '';

    $order_id      = $order->get_id();
    $order_number  = $order->get_order_number();
    $order_date    = $order->get_date_created() ? $order->get_date_created()->date_i18n( 'd/m/Y à H:i' ) : date('d/m/Y H:i');
    $billing_name  = trim( $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() );
    $company       = $order->get_billing_company() ?: 'Particulier / Entreprise B2B';
    $email         = $order->get_billing_email();
    $phone         = $order->get_billing_phone();
    $address       = $order->get_formatted_billing_address();
    $niu           = get_post_meta( $order_id, '_billing_niu', true ) ?: 'M052217435713Q';
    $rccm          = get_post_meta( $order_id, '_billing_rccm', true ) ?: 'DLA/2026/B/1976';
    $payment_title = $order->get_payment_method_title() ?: 'Virement B2B / Pro-Forma Usine';

    $subtotal_ht = $order->get_subtotal();
    $total_tax   = $order->get_total_tax();
    $total_ttc   = $order->get_total();

    $logo_url = get_template_directory_uri() . '/assets/images/logo_tpm.png';

    // Build Items Rows
    $items_html = '';
    foreach ( $order->get_items() as $item_id => $item ) {
        $product = $item->get_product();
        $name    = $item->get_name();
        $qty     = $item->get_quantity();
        $total   = $order->get_formatted_line_subtotal( $item );
        $sku     = $product ? $product->get_sku() : 'TPM-REF';
        $unit    = $product ? ( get_post_meta( $product->get_id(), '_unit', true ) ?: 'unité' ) : 'unité';
        $price   = $product ? wc_price( $product->get_price() ) : '';

        // Meta (Length, Color)
        $meta_str = '';
        $meta_data = $item->get_formatted_meta_data();
        if ( ! empty( $meta_data ) ) {
            $meta_parts = [];
            foreach ( $meta_data as $m ) {
                $meta_parts[] = esc_html( $m->display_key ) . ': <strong>' . wp_kses_post( $m->display_value ) . '</strong>';
            }
            $meta_str = '<div style="font-size:11px; color:#64748b; margin-top:3px;">' . implode(' | ', $meta_parts) . '</div>';
        }

        $items_html .= '
        <tr style="border-bottom:1px solid #e2e8f0;">
            <td style="padding:12px 10px; font-size:12px; color:#1e293b; font-family:Helvetica,Arial,sans-serif;">
                <strong style="color:#1C1340;">' . esc_html( $name ) . '</strong>
                <div style="font-size:10px; color:#64748b; font-family:monospace;">SKU: ' . esc_html( $sku ) . '</div>
                ' . $meta_str . '
            </td>
            <td style="padding:12px 10px; font-size:12px; text-align:center; color:#1e293b; font-weight:bold;">
                ' . esc_html( $qty ) . ' ' . esc_html( $unit ) . '
            </td>
            <td style="padding:12px 10px; font-size:12px; text-align:right; color:#1e293b; font-family:monospace;">
                ' . $price . '
            </td>
            <td style="padding:12px 10px; font-size:12px; text-align:right; color:#1C1340; font-weight:bold; font-family:monospace;">
                ' . $total . '
            </td>
        </tr>';
    }

    $html = '
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Reçu de Commande TPM SA</title>
    </head>
    <body style="margin:0; padding:20px; background-color:#f1f5f9; font-family:Helvetica,Arial,sans-serif; -webkit-font-smoothing:antialiased;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="max-width:680px; margin:0 auto; background-color:#ffffff; border-radius:12px; overflow:hidden; border:2px solid #1C1340; box-shadow:0 10px 25px rgba(0,0,0,0.08);">
            
            <!-- HEADER -->
            <tr>
                <td style="background-color:#1C1340; padding:22px 30px; border-bottom:4px solid #D84B1F;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="middle" style="width:95px; padding-right:16px;">
                                <div style="background:#ffffff; border-radius:8px; padding:6px 8px; text-align:center; display:inline-block;">
                                    <img src="' . esc_url( $logo_url ) . '" alt="Logo TPM SA" width="85" height="37" style="display:block; width:85px; height:auto; max-height:40px; border:0;" />
                                </div>
                            </td>
                            <td valign="middle">
                                <h1 style="margin:0; font-size:20px; font-weight:900; color:#ffffff; letter-spacing:0.5px; text-transform:uppercase;">TPM SA (GROUPE CAC)</h1>
                                <p style="margin:3px 0 0 0; font-size:10.5px; font-weight:bold; color:#D84B1F; text-transform:uppercase; letter-spacing:1px;">Transformation Métallique &amp; Plasturgie — Depuis 1976</p>
                                <p style="margin:2px 0 0 0; font-size:10px; color:#cbd5e1;">Usines de Douala PK12 &amp; Bekoko • Cameroun</p>
                            </td>
                            <td valign="middle" align="right">
                                <div style="background-color:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); padding:8px 14px; border-radius:8px; text-align:right;">
                                    <div style="font-size:10px; font-weight:bold; color:#D84B1F; text-transform:uppercase;">FACTURE PRO-FORMA</div>
                                    <div style="font-size:14px; font-weight:900; color:#ffffff; font-family:monospace;">N° #' . esc_html( $order_number ) . '</div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- PDF ATTACHMENT NOTICE -->
            <tr>
                <td style="background-color:#eff6ff; padding:12px 30px; border-bottom:1px solid #bfdbfe;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="30" valign="middle" style="font-size:20px;">
                                📎
                            </td>
                            <td valign="middle" style="font-size:12px; color:#1e40af; line-height:1.4;">
                                <strong>Facture Pro-Forma PDF jointe en pièce attachée :</strong><br>
                                Le document officiel certifié <em>Proforma_Commande_' . esc_html( $order_number ) . '.pdf</em> avec cachet et décompte TVA 19.25% est attaché à ce message.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- ORDER STATUS BANNER -->
            <tr>
                <td style="background-color:#f8fafc; padding:14px 30px; border-bottom:1px solid #e2e8f0;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="font-size:12px; color:#334155;">
                                📅 Date d\'émission : <strong>' . esc_html( $order_date ) . '</strong>
                            </td>
                            <td align="right" style="font-size:12px; color:#334155;">
                                💳 Règlement : <strong>' . esc_html( $payment_title ) . '</strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- CUSTOMER & BILLING INFO -->
            <tr>
                <td style="padding:24px 30px;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:16px;">
                        <tr>
                            <td width="50%" valign="top" style="padding-right:15px;">
                                <div style="font-size:11px; font-weight:bold; color:#D84B1F; text-transform:uppercase; margin-bottom:6px;">Coordonnées Client / Entreprise :</div>
                                <div style="font-size:13px; font-weight:bold; color:#1C1340;">' . esc_html( $billing_name ) . '</div>
                                <div style="font-size:12px; color:#475569; margin-top:2px;"><strong>Raison Sociale :</strong> ' . esc_html( $company ) . '</div>
                                <div style="font-size:12px; color:#475569; margin-top:2px;"><strong>NIU :</strong> ' . esc_html( $niu ) . '</div>
                                <div style="font-size:12px; color:#475569; margin-top:2px;"><strong>RCCM :</strong> ' . esc_html( $rccm ) . '</div>
                            </td>
                            <td width="50%" valign="top" style="padding-left:15px; border-left:1px solid #e2e8f0;">
                                <div style="font-size:11px; font-weight:bold; color:#D84B1F; text-transform:uppercase; margin-bottom:6px;">Contact &amp; Livraison :</div>
                                <div style="font-size:12px; color:#475569;"><strong>Email :</strong> <a href="mailto:' . esc_attr( $email ) . '" style="color:#1C1340; text-decoration:none;">' . esc_html( $email ) . '</a></div>
                                <div style="font-size:12px; color:#475569; margin-top:2px;"><strong>Téléphone :</strong> ' . esc_html( $phone ) . '</div>
                                <div style="font-size:12px; color:#475569; margin-top:2px;"><strong>Adresse :</strong> ' . wp_strip_all_tags( $address ) . '</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- ITEMS TABLE -->
            <tr>
                <td style="padding:0 30px 20px 30px;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden;">
                        <thead>
                            <tr style="background-color:#1C1340; color:#ffffff;">
                                <th align="left" style="padding:10px; font-size:11px; text-transform:uppercase; font-weight:bold;">Article &amp; Spécifications</th>
                                <th align="center" style="padding:10px; font-size:11px; text-transform:uppercase; font-weight:bold;">Quantité</th>
                                <th align="right" style="padding:10px; font-size:11px; text-transform:uppercase; font-weight:bold;">Prix Unit. HT</th>
                                <th align="right" style="padding:10px; font-size:11px; text-transform:uppercase; font-weight:bold;">Total HT</th>
                            </tr>
                        </thead>
                        <tbody>
                            ' . $items_html . '
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- FINANCIAL TOTALS & TAX BREAKDOWN -->
            <tr>
                <td style="padding:0 30px 24px 30px;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="50%" valign="top">
                                <div style="background-color:#eff6ff; border:1px solid #bfdbfe; padding:12px 16px; border-radius:8px; font-size:11px; color:#1e40af; line-height:1.5;">
                                    <strong>✔ Document officiel certifié conforme</strong><br>
                                    Applicable aux déductions fiscales et audits BTP en République du Cameroun.
                                </div>
                            </td>
                            <td width="50%" valign="top" style="padding-left:20px;">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:monospace; font-size:12px;">
                                    <tr>
                                        <td style="padding:4px 0; color:#64748b;">Sous-Total HT :</td>
                                        <td align="right" style="padding:4px 0; font-weight:bold; color:#1e293b;">' . wc_price( $subtotal_ht ) . '</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:4px 0; color:#64748b;">TVA Cameroun (19.25%) :</td>
                                        <td align="right" style="padding:4px 0; font-weight:bold; color:#D84B1F;">' . wc_price( $total_tax ) . '</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:4px 0; color:#64748b;">Manutention Usine :</td>
                                        <td align="right" style="padding:4px 0; font-weight:bold; color:#059669;">Inclus Usine</td>
                                    </tr>
                                    <tr style="border-top:2px solid #1C1340;">
                                        <td style="padding:10px 0 0 0; font-size:14px; font-weight:900; color:#1C1340; text-transform:uppercase;">TOTAL GÉNÉRAL TTC :</td>
                                        <td align="right" style="padding:10px 0 0 0; font-size:18px; font-weight:900; color:#D84B1F;">' . wc_price( $total_ttc ) . '</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- ACTIONS (WHATSAPP & CONTACT) -->
            <tr>
                <td style="padding:0 30px 24px 30px;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:#1C1340; border-radius:8px; padding:16px; text-align:center;">
                        <tr>
                            <td style="color:#ffffff; font-size:12px;">
                                <p style="margin:0 0 10px 0; font-weight:bold; font-size:13px; color:#ffffff;">Une question sur votre commande ou un enlèvement usine ?</p>
                                <a href="https://wa.me/237696340008?text=' . rawurlencode('Bonjour TPM SA, je souhaite suivre ma commande N° ' . $order_number) . '" target="_blank" style="display:inline-block; background-color:#25D366; color:#ffffff; text-decoration:none; padding:10px 20px; border-radius:6px; font-size:12px; font-weight:bold; text-transform:uppercase; margin-right:8px;">
                                    💬 Contacter le Commercial WhatsApp (+237 696 34 00 08)
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- FOOTER -->
            <tr>
                <td style="background-color:#f1f5f9; padding:20px 30px; border-top:1px solid #e2e8f0; font-size:11px; color:#64748b; line-height:1.5;">
                    <p style="margin:0 0 4px 0; font-weight:bold; color:#1C1340; text-transform:uppercase;">Coordonnées Officielles TPM SA (Groupe CAC) :</p>
                    <p style="margin:0 0 2px 0;">• <strong>Direction &amp; Usines :</strong> Carrefour Bekoko (Axe Douala - Limbé) &amp; Zone Industrielle Douala PK12, Cameroun.</p>
                    <p style="margin:0 0 2px 0;">• <strong>Téléphones Usine :</strong> +237 696 34 00 08 / +237 691 53 75 14 / +237 655 70 58 66</p>
                    <p style="margin:0 0 2px 0;">• <strong>Email Officiel :</strong> <a href="mailto:cac_vis3@yahoo.fr" style="color:#D84B1F;">cac_vis3@yahoo.fr</a></p>
                    <p style="margin:6px 0 0 0; font-size:10px; color:#94a3b8;">Ce reçu et bon pro-forma officiel a été généré automatiquement par la plateforme numérique de TPM SA.</p>
                </td>
            </tr>

        </table>
    </body>
    </html>';

    return $html;
}

/**
 * Send Dual Receipt Automatically on Order Creation & Status Changes
 */
function tpm_send_dual_order_receipt( $order_id ) {
    if ( ! $order_id ) return;

    $order = wc_get_order( $order_id );
    if ( ! $order ) return;

    // Prevent duplicate sending during the same request
    $already_sent = get_post_meta( $order_id, '_tpm_receipt_sent', true );
    if ( $already_sent ) {
        return;
    }

    $customer_email = $order->get_billing_email();
    $admin_email    = get_option( 'admin_email' );
    $tpm_commercial = 'cac_vis3@yahoo.fr';

    $recipients = [];
    if ( ! empty( $customer_email ) && is_email( $customer_email ) ) {
        $recipients[] = $customer_email;
    }
    if ( ! empty( $admin_email ) && is_email( $admin_email ) ) {
        $recipients[] = $admin_email;
    }
    if ( ! empty( $tpm_commercial ) && is_email( $tpm_commercial ) ) {
        $recipients[] = $tpm_commercial;
    }

    $recipients = array_unique( $recipients );
    if ( empty( $recipients ) ) {
        return;
    }

    $order_number = $order->get_order_number();
    $subject      = sprintf( 'TPM SA — Reçu de Commande & Pro-Forma Officielle #%s', $order_number );
    $message      = tpm_generate_order_receipt_html( $order );

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: TPM SA (Groupe CAC) <cac_vis3@yahoo.fr>',
        'Reply-To: cac_vis3@yahoo.fr'
    ];

    // Generate official Pro-Forma PDF attachment
    $attachments = [];
    if ( function_exists( 'tpm_generate_order_proforma_pdf_file' ) ) {
        $pdf_filepath = tpm_generate_order_proforma_pdf_file( $order );
        if ( $pdf_filepath && file_exists( $pdf_filepath ) ) {
            $attachments[] = $pdf_filepath;
        }
    }

    // Dispatch to Customer + Admin recipients
    foreach ( $recipients as $to ) {
        wp_mail( $to, $subject, $message, $headers, $attachments );
    }

    update_post_meta( $order_id, '_tpm_receipt_sent', current_time( 'mysql' ) );
}

// Hook into Order Creation & Checkout Processed
add_action( 'woocommerce_checkout_order_processed', 'tpm_send_dual_order_receipt', 20, 1 );
add_action( 'woocommerce_new_order', 'tpm_send_dual_order_receipt', 20, 1 );
add_action( 'woocommerce_thankyou', 'tpm_send_dual_order_receipt', 20, 1 );
add_action( 'woocommerce_order_status_completed', 'tpm_send_dual_order_receipt', 20, 1 );
add_action( 'woocommerce_order_status_processing', 'tpm_send_dual_order_receipt', 20, 1 );

/**
 * Route development emails to Mailpit SMTP (port 10001) in local environment
 */
add_action( 'phpmailer_init', function( $phpmailer ) {
    if ( strpos( home_url(), '.local' ) !== false || strpos( home_url(), 'localhost' ) !== false ) {
        $phpmailer->isSMTP();
        $phpmailer->Host = '127.0.0.1';
        $phpmailer->Port = 10001;
        $phpmailer->SMTPAuth = false;
        $phpmailer->SMTPSecure = false;
        $phpmailer->SMTPAutoTLS = false;
    }
} );

