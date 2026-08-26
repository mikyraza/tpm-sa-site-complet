<?php
/**
 * woocommerce/content-single-product.php
 * Fiche Technique Officielle Certifiée TPM SA (Groupe CAC)
 * Conforme au modèle de Fiche Technique Industrielle
 */

defined( 'ABSPATH' ) || exit;

global $product;
if ( ! $product ) return;

$product_id   = $product->get_id();
$title        = $product->get_name();
$sku          = $product->get_sku() ?: ('TPM-' . $product_id);
$price_html   = $product->get_price_html();
$unit         = get_post_meta( $product_id, '_unit', true ) ?: 'unité';
$img_url      = function_exists('tpm_get_product_image_url') ? tpm_get_product_image_url($product) : (wp_get_attachment_image_url( $product->get_image_id(), 'full' ) ?: get_template_directory_uri() . '/assets/images/prod1_tole.jpg');
$cart_url     = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');

// Retrieve complete certified Fiche Technique
$fiche = function_exists('tpm_get_product_fiche_technique') ? tpm_get_product_fiche_technique($product) : [
    'ref'          => $sku,
    'title'        => $title,
    'designation'  => $title,
    'category'     => 'Matériaux de Construction Métallurgiques',
    'pole'         => 'Pôle Industriel TPM SA',
    'material'     => 'Aluminium de Premier Choix / Acier Certifié',
    'profil'       => 'Profilage Normalisé Conforme aux Normes Camerounaises',
    'epaisseur'    => 'Épaisseur Réelle Contrôlée',
    'finition'     => 'Finition Industrielle Protégée',
    'longueurs'    => 'Formats standards ou profilage sur-mesure',
    'description'  => $product->get_description() ?: $product->get_short_description(),
    'avantages'    => [
        "Matières premières certifiées 1er choix pour une durabilité maximale au Cameroun.",
        "Haute résistance mécanique et protection éprouvée contre la corrosion marine et tropicale.",
        "Précision dimensionnelle stricte garantissant une pose rapide sur chantier.",
        "Disponibilité permanente et enlèvement immédiat aux usines de Douala PK12 et Bekoko."
    ],
    'applications' => "Bâtiments industriels, hangars, édifices commerciaux et résidences de standing.",
    'pose'         => "Pose conforme aux règles de l'art BTP et aux spécifications techniques TPM SA.",
    'unit'         => $unit,
    'stock'        => 'Disponible en Stock Permanent (Usines Bekoko & Douala PK12)',
    'norme'        => 'Norme Camerounaise (NC) & ISO 9001:2015 • Garantie de Durabilité'
];

// Dynamic options for format/length and color/finish
$flash_details = function_exists('tpm_get_product_flash_details') ? tpm_get_product_flash_details($product) : [
    'length_label' => 'LONGUEUR / FORMAT',
    'color_label'  => 'COULEUR / FINITION',
    'lengths'      => ['Standard Usine'],
    'colors'       => ['Standard Usine'],
    'unit'         => $unit
];

// Product Gallery images: ONLY images strictly attached to this product
$gallery_ids = $product->get_gallery_image_ids();
$item_images = [$img_url];
if ( ! empty( $gallery_ids ) ) {
    foreach ( $gallery_ids as $gid ) {
        $g_url = wp_get_attachment_image_url( $gid, 'full' );
        if ( $g_url && ! in_array( $g_url, $item_images ) ) {
            $item_images[] = $g_url;
        }
    }
}

$catalog_pdf_url = content_url('/uploads/catalogue-general-tpm-sa-2026.pdf');

do_action( 'woocommerce_before_single_product' );
?>

<!-- FICHE TECHNIQUE CONTAINER -->
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'max-w-5xl mx-auto px-3 sm:px-6 py-6 font-sans text-slate-800 space-y-6', $product ); ?>>

    <!-- BREADCRUMB & FIL D'ARIANE -->
    <div class="print:hidden bg-slate-100 border border-gray-200 px-5 py-3 rounded-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 text-xs">
        <nav class="text-gray-600 flex items-center gap-2 flex-wrap font-medium">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-tpm-orange transition-colors">Accueil</a>
            <span>&gt;</span>
            <a href="<?php echo esc_url( wc_get_page_permalink('shop') ); ?>" class="hover:text-tpm-orange transition-colors">Catalogue Usine</a>
            <span>&gt;</span>
            <span class="text-gray-400"><?php echo esc_html($fiche['pole']); ?></span>
            <span>&gt;</span>
            <span class="font-bold text-tpm-navy truncate max-w-xs"><?php echo esc_html($title); ?></span>
        </nav>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200 px-3 py-1 rounded font-bold text-[11px]">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Stock Usine Certifié
            </span>
            <button onclick="window.print()" class="bg-white hover:bg-slate-50 text-tpm-navy border border-gray-300 font-bold px-3 py-1 rounded transition flex items-center gap-1 text-[11px] shadow-sm">
                <span class="material-symbols-outlined text-[14px]">print</span>
                Imprimer la Fiche
            </button>
        </div>
    </div>

    <!-- DOCUMENT FICHE TECHNIQUE OFFICIELLE -->
    <div class="bg-white border-2 border-slate-200 rounded-2xl p-6 sm:p-8 shadow-md space-y-6 print:border-none print:shadow-none print:p-0">

        <!-- 1. EN-TÊTE OFFICIEL DE LA FICHE TECHNIQUE -->
        <header class="border-b-4 border-tpm-orange pb-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <!-- Logo Officiel TPM SA -->
                <div class="shrink-0 flex items-center bg-white p-1.5 rounded-lg border border-slate-200 shadow-sm">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo_tpm.png' ); ?>" 
                         alt="Logo TPM SA" 
                         class="h-12 sm:h-14 w-auto object-contain max-h-14" />
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-xl sm:text-2xl font-black text-tpm-navy uppercase tracking-tight m-0">TPM SA</h1>
                        <span class="bg-amber-100 text-amber-900 border border-amber-300 text-[10px] font-extrabold uppercase px-2 py-0.5 rounded">
                            Groupe CAC
                        </span>
                    </div>
                    <p class="text-[11px] font-bold text-tpm-orange uppercase tracking-wide m-0 mt-0.5">
                        Depuis 1976 • Fiche Technique Officielle de Produit
                    </p>
                </div>
            </div>
            <div class="text-left sm:text-right text-[11px] text-gray-500 leading-snug">
                <strong class="text-tpm-navy font-bold">Usines de Douala PK12 &amp; Bekoko</strong><br>
                République du Cameroun • Zone CEMAC<br>
                Commercial : <span class="font-mono text-gray-700 font-semibold">+237 655 70 58 66</span> | CAC_VIS3@YAHOO.FR<br>
                <span class="text-[10px] text-gray-400 font-mono">NIU : M052217435713Q • RCCM : RC/DLA/1976/B/725</span>
            </div>
        </header>

        <!-- 2. BANNIÈRE TITRE DU PRODUIT -->
        <div class="bg-tpm-navy text-white px-5 py-3.5 rounded-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 shadow-sm">
            <h2 class="text-base sm:text-lg font-black uppercase tracking-wide m-0 text-white">
                <?php echo esc_html($fiche['title']); ?>
            </h2>
            <div class="bg-tpm-orange text-white text-xs font-black uppercase font-mono px-3 py-1 rounded-md tracking-wider shrink-0">
                Réf: <?php echo esc_html($fiche['ref']); ?>
            </div>
        </div>

        <!-- 3. GRILLE PRINCIPALE (PHOTO RÉELLE & SPÉCIFICATIONS TECHNIQUES) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Colonne Gauche : Photo Réelle & Actions (5 colonnes) -->
            <div class="lg:col-span-5 flex flex-col gap-4">
                
                <!-- Cadre Photo Réelle : Uniquement l'image de l'article -->
                <div class="bg-slate-50 border border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center text-center shadow-inner relative group">
                    <div class="aspect-[4/3] w-full flex items-center justify-center bg-white rounded-lg border border-gray-100 p-2 overflow-hidden">
                        <img id="main-product-image" 
                             src="<?php echo esc_url($img_url); ?>" 
                             alt="<?php echo esc_attr($title); ?>" 
                             class="max-h-60 w-full object-contain transition-transform duration-300 group-hover:scale-105"/>
                    </div>
                    <div class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mt-2.5 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px] text-tpm-orange">verified</span>
                        Photo Réelle Inventaire TPM SA
                    </div>

                    <?php if ( count( $item_images ) > 1 ) : ?>
                        <!-- Thumbnails de l'article (si plusieurs photos réelles existent) -->
                        <div class="grid grid-cols-4 gap-2 pt-3 w-full">
                            <?php foreach ( $item_images as $idx => $t_url ) : ?>
                                <div class="aspect-square bg-white border-2 <?php echo ($idx === 0) ? 'border-tpm-orange' : 'border-gray-200 opacity-70 hover:opacity-100'; ?> rounded-lg overflow-hidden cursor-pointer transition-all p-0.5 product-thumb"
                                     onclick="changeProductImage('<?php echo esc_url($t_url); ?>', this)">
                                    <img src="<?php echo esc_url($t_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover rounded"/>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Boîte de Commande & Facture Pro-Forma (masquée à l'impression) -->
                <div class="print:hidden bg-slate-50 border border-gray-200 rounded-xl p-4 space-y-4 shadow-sm">
                    <!-- Prix HT & Unité -->
                    <div class="flex items-baseline justify-between bg-white border border-gray-200 p-3 rounded-lg">
                        <div>
                            <div class="text-[10px] font-extrabold uppercase text-gray-400">Prix Unitaire Usine :</div>
                            <div class="text-2xl font-black text-tpm-orange"><?php echo $price_html; ?></div>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-bold text-gray-600 uppercase">HT / <?php echo esc_html($unit); ?></span>
                            <div class="text-[10px] text-emerald-700 font-bold bg-emerald-100 px-2 py-0.5 rounded mt-0.5">+ TVA 19.25%</div>
                        </div>
                    </div>

                    <!-- Formulaire Pro-Forma direct -->
                    <form id="fiche-add-to-cart-form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' class="space-y-3">
                        
                        <!-- List Box Format / Longueur -->
                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-tpm-navy mb-1">
                                <?php echo esc_html($flash_details['length_label']); ?>
                            </label>
                            <select name="flash_length" class="w-full text-xs font-bold bg-white border border-gray-300 rounded-lg px-2.5 py-2 text-gray-800 outline-none focus:ring-2 focus:ring-tpm-orange transition cursor-pointer">
                                <?php foreach ($flash_details['lengths'] as $l_opt): ?>
                                    <option value="<?php echo esc_attr($l_opt); ?>"><?php echo esc_html($l_opt); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- List Box Finition / Couleur -->
                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-tpm-navy mb-1">
                                <?php echo esc_html($flash_details['color_label']); ?>
                            </label>
                            <select name="flash_color" class="w-full text-xs font-bold bg-white border border-gray-300 rounded-lg px-2.5 py-2 text-gray-800 outline-none focus:ring-2 focus:ring-tpm-orange transition cursor-pointer">
                                <?php foreach ($flash_details['colors'] as $c_opt): ?>
                                    <option value="<?php echo esc_attr($c_opt); ?>"><?php echo esc_html($c_opt); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Quantité & Ajout -->
                        <div class="flex items-center gap-3 pt-1">
                            <div class="w-24 shrink-0">
                                <label class="block text-[10px] font-extrabold uppercase text-gray-500 mb-1">Quantité :</label>
                                <input type="number" name="quantity" min="1" value="1" class="w-full text-xs font-bold text-center bg-white border border-gray-300 rounded-lg py-2 text-tpm-navy outline-none focus:ring-2 focus:ring-tpm-orange"/>
                            </div>
                            <div class="flex-1 pt-4">
                                <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>" class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-extrabold py-2.5 px-3 rounded-lg text-xs uppercase tracking-wider transition shadow flex items-center justify-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px]">add_shopping_cart</span>
                                    Ajouter à la Pro-Forma
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- WhatsApp & Catalogue PDF -->
                    <?php
                    $phone = '237696340008';
                    $msg   = rawurlencode( "Bonjour TPM SA, je souhaite commander : {$title} (Réf: {$fiche['ref']})." );
                    $wa_url = "https://wa.me/{$phone}?text={$msg}";
                    ?>
                    <div class="grid grid-cols-2 gap-2 pt-2 border-t border-gray-200">
                        <a href="<?php echo esc_url($wa_url); ?>" target="_blank" class="bg-[#25D366] hover:bg-[#1ebd59] text-white font-bold py-2 px-2 rounded-lg text-[11px] uppercase tracking-wider text-center flex items-center justify-center gap-1 transition">
                            <span class="material-symbols-outlined text-[14px]">chat</span>
                            WhatsApp
                        </a>
                        <a href="javascript:void(0)" onclick="openCataloguePreview()" class="bg-white hover:bg-slate-100 text-tpm-navy border border-gray-300 font-bold py-2 px-2 rounded-lg text-[11px] uppercase tracking-wider text-center flex items-center justify-center gap-1 transition shadow-sm cursor-pointer">
                            <span class="material-symbols-outlined text-[14px] text-tpm-orange">visibility</span>
                            Catalogue PDF
                        </a>
                    </div>
                </div>

            </div>

            <!-- Colonne Droite : Spécifications & Caractéristiques Industrielles (7 colonnes) -->
            <div class="lg:col-span-7 flex flex-col justify-start">
                
                <h3 class="text-xs font-black uppercase tracking-wider text-tpm-navy mb-2 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-sm bg-tpm-orange"></span>
                    Identification &amp; Spécifications Industrielles
                </h3>

                <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                    <table class="w-full text-left border-collapse text-xs">
                        <tbody>
                            <tr class="border-b border-gray-200 bg-slate-50">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy w-5/12">Désignation Produit</th>
                                <td class="py-2.5 px-4 font-extrabold text-gray-900"><?php echo esc_html($fiche['designation']); ?></td>
                            </tr>
                            <tr class="border-b border-gray-200 bg-white">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy">Référence Catalogue (SKU)</th>
                                <td class="py-2.5 px-4 font-mono font-bold text-tpm-orange"><?php echo esc_html($fiche['ref']); ?></td>
                            </tr>
                            <tr class="border-b border-gray-200 bg-slate-50">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy">Catégorie / Pôle</th>
                                <td class="py-2.5 px-4 text-gray-800 font-semibold"><?php echo esc_html($fiche['category']); ?></td>
                            </tr>
                            <tr class="border-b border-gray-200 bg-white">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy">Matière Première</th>
                                <td class="py-2.5 px-4 text-gray-800"><?php echo esc_html($fiche['material']); ?></td>
                            </tr>
                            <tr class="border-b border-gray-200 bg-slate-50">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy">Profil / Format / Développé</th>
                                <td class="py-2.5 px-4 text-gray-800 font-medium"><?php echo esc_html($fiche['profil']); ?></td>
                            </tr>
                            <tr class="border-b border-gray-200 bg-white">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy">Épaisseur Nominale Réelle</th>
                                <td class="py-2.5 px-4 text-tpm-navy font-bold"><?php echo esc_html($fiche['epaisseur']); ?></td>
                            </tr>
                            <tr class="border-b border-gray-200 bg-slate-50">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy">Finition de Surface &amp; Teinte</th>
                                <td class="py-2.5 px-4 text-gray-800"><?php echo esc_html($fiche['finition']); ?></td>
                            </tr>
                            <tr class="border-b border-gray-200 bg-white">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy">Longueurs / Formats Usine</th>
                                <td class="py-2.5 px-4 text-gray-800"><?php echo esc_html($fiche['longueurs']); ?></td>
                            </tr>
                            <tr class="border-b border-gray-200 bg-slate-50">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy">Unité &amp; Conditionnement</th>
                                <td class="py-2.5 px-4 text-gray-800 capitalize"><?php echo esc_html($unit); ?> (Vente en gros &amp; détails)</td>
                            </tr>
                            <tr class="bg-white">
                                <th class="py-2.5 px-4 font-bold text-tpm-navy">Disponibilité Quai Usine</th>
                                <td class="py-2.5 px-4 text-emerald-700 font-bold flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <?php echo esc_html($fiche['stock']); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!-- 4. DESCRIPTION & RÔLE TECHNIQUE DANS LA COUVERTURE / BÂTIMENT -->
        <div class="bg-white border border-gray-200 border-l-4 border-l-tpm-orange rounded-xl p-5 shadow-sm space-y-2">
            <h3 class="text-sm font-black uppercase tracking-wider text-tpm-navy flex items-center gap-2 m-0">
                <span class="material-symbols-outlined text-[18px] text-tpm-orange">description</span>
                Description &amp; Rôle Technique dans la Construction
            </h3>
            <p class="text-xs sm:text-sm text-gray-700 leading-relaxed text-justify m-0">
                <?php echo esc_html($fiche['description']); ?>
            </p>
        </div>

        <!-- 5. AVANTAGES & POINTS FORTS INDUSTRIELS -->
        <div class="bg-white border border-gray-200 border-l-4 border-l-tpm-orange rounded-xl p-5 shadow-sm space-y-3">
            <h3 class="text-sm font-black uppercase tracking-wider text-tpm-navy flex items-center gap-2 m-0">
                <span class="material-symbols-outlined text-[18px] text-tpm-orange">verified</span>
                Avantages &amp; Points Forts Industriels
            </h3>
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 m-0 p-0 list-none text-xs sm:text-sm text-gray-700">
                <?php foreach ($fiche['avantages'] as $av): ?>
                    <li class="flex items-start gap-2 bg-slate-50 p-2.5 rounded-lg border border-slate-200/60">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600 shrink-0 mt-0.5">check_circle</span>
                        <span><?php echo esc_html($av); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- 6. DOMAINES D'APPLICATION & GUIDE DE POSE -->
        <div class="bg-white border border-gray-200 border-l-4 border-l-tpm-navy rounded-xl p-5 shadow-sm space-y-2">
            <h3 class="text-sm font-black uppercase tracking-wider text-tpm-navy flex items-center gap-2 m-0">
                <span class="material-symbols-outlined text-[18px] text-tpm-navy">engineering</span>
                Domaines d'Application &amp; Guide de Pose
            </h3>
            <p class="text-xs sm:text-sm text-gray-700 leading-relaxed m-0">
                <strong>Applications recommandées :</strong> <?php echo esc_html($fiche['applications']); ?>
            </p>
            <p class="text-xs sm:text-sm text-gray-700 leading-relaxed m-0 pt-1 border-t border-gray-100">
                <strong>Conseils de pose &amp; fixations :</strong> <?php echo esc_html($fiche['pose']); ?>
            </p>
        </div>

        <!-- 7. PIED DE PAGE TECHNIQUE OFFICIEL -->
        <footer class="pt-4 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-gray-500">
            <div>
                © 1976-2026 <strong>TPM SA</strong> (Groupe CAC) — Leader de la Métallurgie et des Matériaux de Construction au Cameroun.
            </div>
            <div class="bg-slate-100 border border-slate-300 text-tpm-navy px-3 py-1 rounded-md font-bold text-[11px] flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[14px] text-tpm-orange">shield</span>
                <?php echo esc_html($fiche['norme']); ?>
            </div>
        </footer>

    </div>

</div>

<!-- SCRIPT SWITCHER D'IMAGE -->
<script>
function changeProductImage(src, thumb) {
    const mainImg = document.getElementById('main-product-image');
    if (mainImg) {
        mainImg.style.opacity = '0.4';
        setTimeout(() => {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 150);
    }
    document.querySelectorAll('.product-thumb').forEach(el => {
        el.classList.remove('border-tpm-orange');
        el.classList.add('border-gray-200', 'opacity-70');
    });
    if (thumb) {
        thumb.classList.remove('border-gray-200', 'opacity-70');
        thumb.classList.add('border-tpm-orange', 'opacity-100');
    }
}
</script>

<?php do_action( 'woocommerce_after_single_product' ); ?>
