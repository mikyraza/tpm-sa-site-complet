<?php
/**
 * woocommerce/content-single-product.php
 * Fiche Technique Officielle Certifiée TPM SA (Groupe CAC)
 * Conforme au modèle certifié de Fiche Technique & Commerciale (2 Pages)
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

// Retrieve complete certified Fiche Technique data
$fiche = function_exists('tpm_get_product_fiche_technique') ? tpm_get_product_fiche_technique($product) : [];
$product_family = $fiche['product_family'] ?? 'tole';

// Dynamic options for format/length and color/finish
$flash_details = function_exists('tpm_get_product_flash_details') ? tpm_get_product_flash_details($product) : [
    'length_label' => 'LONGUEUR / FORMAT',
    'color_label'  => 'COULEUR / FINITION',
    'lengths'      => ['Standard Usine (6,00 m)', 'Sur-mesure 3,00 m', 'Sur-mesure 4,00 m', 'Sur-mesure 5,00 m'],
    'colors'       => ['Bleu Outremer (RAL 5002)', 'Rouge Tuile / Basque (RAL 3004)', 'Vert Mousse (RAL 6005)', 'Gris Anthracite (RAL 7016)', 'Brun Chocolat (RAL 8017)', 'Alu Naturel (Brut non laqué)'],
    'unit'         => $unit
];

// Product Gallery images
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

$phone = '237655705866';
$msg   = rawurlencode( "Bonjour TPM SA, je souhaite commander : {$title} (Réf: {$sku})." );
$wa_url = "https://wa.me/{$phone}?text={$msg}";

do_action( 'woocommerce_before_single_product' );
?>

<style>
@media print {
    header, footer, nav, #wpadminbar, .print-hidden, .site-header, .site-footer {
        display: none !important;
    }
    body {
        background: #ffffff !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .sheet-page-1 {
        page-break-after: always !important;
        break-after: page !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }
    .sheet-page-2 {
        page-break-before: always !important;
        break-before: page !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }
}
</style>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'max-w-5xl mx-auto px-3 sm:px-6 py-6 font-sans text-slate-800 space-y-8', $product ); ?>>

    <!-- BREADCRUMB & FIL D'ARIANE (SCREEN ONLY) -->
    <div class="print:hidden bg-slate-100/80 border border-gray-200 px-4 sm:px-5 py-3 rounded-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 text-xs">
        <nav class="text-gray-600 flex items-center gap-2 flex-wrap font-medium">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-tpm-orange transition-colors">Accueil</a>
            <span>&gt;</span>
            <a href="<?php echo esc_url( wc_get_page_permalink('shop') ); ?>" class="hover:text-tpm-orange transition-colors">Catalogue Usine</a>
            <span>&gt;</span>
            <span class="text-gray-400"><?php echo esc_html($fiche['pole'] ?? 'Pôle Métallurgie'); ?></span>
            <span>&gt;</span>
            <span class="font-bold text-tpm-navy truncate max-w-xs"><?php echo esc_html($title); ?></span>
        </nav>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200 px-3 py-1 rounded font-bold text-[11px]">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Stock Usine Certifié
            </span>
            <button onclick="window.print()" class="bg-white hover:bg-slate-50 text-[#154c9e] border border-blue-200 font-bold px-3 py-1 rounded transition flex items-center gap-1.5 text-[11px] shadow-sm cursor-pointer">
                <span class="material-symbols-outlined text-[15px]">print</span>
                Imprimer la Fiche Technique (PDF)
            </button>
        </div>
    </div>

    <!-- BANDEAU DE COMMANDE & PRO-FORMA RAPIDE (SCREEN ONLY) -->
    <div class="print:hidden bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-md grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
        <!-- Photo réelle & miniatures -->
        <div class="lg:col-span-4 flex flex-col items-center">
            <div class="aspect-[4/3] w-full max-w-xs bg-slate-50 border border-gray-200 rounded-xl p-3 flex items-center justify-center overflow-hidden group">
                <img id="main-product-image" 
                     src="<?php echo esc_url($img_url); ?>" 
                     alt="<?php echo esc_attr($title); ?>" 
                     class="max-h-44 w-auto object-contain transition-transform duration-300 group-hover:scale-105" />
            </div>
            <?php if ( count( $item_images ) > 1 ) : ?>
                <div class="flex gap-2 pt-2.5">
                    <?php foreach ( $item_images as $idx => $t_url ) : ?>
                        <div class="w-12 h-12 bg-white border-2 <?php echo ($idx === 0) ? 'border-tpm-orange' : 'border-gray-200 opacity-70'; ?> rounded-lg overflow-hidden cursor-pointer transition p-0.5 product-thumb"
                             onclick="changeProductImage('<?php echo esc_url($t_url); ?>', this)">
                            <img src="<?php echo esc_url($t_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover rounded"/>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Formulaire de chiffrage direct -->
        <div class="lg:col-span-8 space-y-4">
            <div class="flex flex-wrap items-baseline justify-between gap-2 border-b border-gray-100 pb-3">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-gray-400">Tarif Usine Direct Fabricant :</span>
                    <div class="text-2xl sm:text-3xl font-black text-tpm-orange"><?php echo $price_html; ?></div>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-gray-600 uppercase">HT / <?php echo esc_html($unit); ?></span>
                    <div class="text-[10px] text-emerald-700 font-extrabold bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded mt-0.5">
                        TVA 19.25% Récupérable
                    </div>
                </div>
            </div>

            <form id="fiche-add-to-cart-form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-end">
                <div>
                    <label class="block text-[10px] font-black uppercase text-tpm-navy mb-1">
                        <?php echo esc_html($flash_details['length_label']); ?>
                    </label>
                    <select name="flash_length" class="w-full text-xs font-bold bg-slate-50 border border-gray-300 rounded-lg px-2.5 py-2 text-gray-800 outline-none focus:ring-2 focus:ring-tpm-orange transition cursor-pointer">
                        <?php foreach ($flash_details['lengths'] as $l_opt): ?>
                            <option value="<?php echo esc_attr($l_opt); ?>"><?php echo esc_html($l_opt); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-tpm-navy mb-1">
                        <?php echo esc_html($flash_details['color_label']); ?>
                    </label>
                    <select name="flash_color" class="w-full text-xs font-bold bg-slate-50 border border-gray-300 rounded-lg px-2.5 py-2 text-gray-800 outline-none focus:ring-2 focus:ring-tpm-orange transition cursor-pointer">
                        <?php foreach ($flash_details['colors'] as $c_opt): ?>
                            <option value="<?php echo esc_attr($c_opt); ?>"><?php echo esc_html($c_opt); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <div class="w-20 shrink-0">
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-1">Quantité :</label>
                        <input type="number" name="quantity" min="1" value="1" class="w-full text-xs font-bold text-center bg-slate-50 border border-gray-300 rounded-lg py-2 text-tpm-navy outline-none focus:ring-2 focus:ring-tpm-orange"/>
                    </div>
                    <div class="flex-1">
                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>" class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-black py-2.5 px-3 rounded-lg text-xs uppercase tracking-wider transition shadow flex items-center justify-center gap-1.5 cursor-pointer">
                            <span class="material-symbols-outlined text-[16px]">add_shopping_cart</span>
                            Ajouter au Panier Pro-Forma
                        </button>
                    </div>
                </div>
            </form>

            <div class="flex items-center justify-between gap-3 pt-2 text-[11px] text-gray-500 border-t border-gray-100">
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px] text-[#154c9e]">verified</span>
                    <span>Conforme Norme Camerounaise (NC) &amp; ISO 9001:2015</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="<?php echo esc_url($wa_url); ?>" target="_blank" class="text-emerald-700 hover:text-emerald-800 font-bold flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">chat</span>
                        Assistance WhatsApp
                    </a>
                    <a href="javascript:void(0)" onclick="openCataloguePreview()" class="text-[#154c9e] hover:text-blue-800 font-bold flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">visibility</span>
                        Catalogue Complet
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- =================================================================== -->
    <!-- PAGE 1 : FICHE DESCRIPTIVE TECHNIQUE & COMMERCIALE                 -->
    <!-- =================================================================== -->
    <div class="sheet-page-1 bg-white border border-slate-200 rounded-2xl p-6 sm:p-10 shadow-xl space-y-6">

        <!-- EN-TÊTE BLEU INDUSTRIEL -->
        <div class="bg-[#154c9e] text-white p-6 sm:p-8 rounded-xl shadow-sm text-left">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-black uppercase tracking-tight leading-tight m-0 text-white">
                <?php echo esc_html($fiche['header_title'] ?? $title); ?>
            </h1>
            <p class="text-xs sm:text-sm text-blue-100 font-medium mt-1.5 m-0 tracking-wide">
                <?php echo esc_html($fiche['header_subtitle'] ?? 'Fiche Descriptive Technique & Commerciale'); ?>
            </p>
        </div>

        <!-- DESCRIPTIF COMMERCIAL & BADGES -->
        <div class="space-y-3.5 pt-1">
            <p class="text-xs sm:text-sm text-gray-700 leading-relaxed text-justify m-0">
                <strong class="text-gray-900 font-extrabold">Descriptif commercial :</strong>
                <?php echo esc_html($fiche['commercial_desc'] ?? $fiche['description']); ?>
            </p>

            <!-- Badges Caractéristiques Clés -->
            <div class="flex flex-wrap items-center gap-2 pt-1.5">
                <?php if ( ! empty($fiche['pills']) ) : ?>
                    <?php foreach ($fiche['pills'] as $pill): ?>
                        <span class="bg-blue-100 text-[#154c9e] font-black text-[10px] sm:text-[11px] uppercase tracking-wider px-3 py-1 rounded shadow-2xs">
                            <?php echo esc_html($pill); ?>
                        </span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- POINTS FORTS & AVANTAGES CLÉS -->
        <div class="space-y-3 pt-4">
            <h2 class="text-sm sm:text-base font-black text-[#154c9e] uppercase tracking-wider border-b-2 border-[#154c9e] pb-1 m-0">
                POINTS FORTS &amp; AVANTAGES CLÉS
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                <?php if ( ! empty($fiche['points_forts']) ) : ?>
                    <?php foreach ($fiche['points_forts'] as $pf): ?>
                        <div class="border border-slate-200 rounded-xl p-4 bg-white shadow-2xs flex flex-col justify-start">
                            <div class="font-extrabold text-xs sm:text-sm text-[#154c9e] flex items-center gap-2">
                                <?php 
                                    $icon = $pf['icon'] ?? 'palette';
                                    if ($icon === 'palette') echo '🎨';
                                    elseif ($icon === 'shield') echo '🛡️';
                                    elseif ($icon === 'architecture') echo '🏗️';
                                    elseif ($icon === 'feather') echo '🪶';
                                    elseif ($icon === 'verified') echo '✅';
                                    elseif ($icon === 'bolt') echo '⚡';
                                    elseif ($icon === 'water_drop') echo '💧';
                                    elseif ($icon === 'anchor') echo '⚓';
                                    elseif ($icon === 'grid_view') echo '🔲';
                                    elseif ($icon === 'shower') echo '🚿';
                                    elseif ($icon === 'fitness_center') echo '💪';
                                    else echo '🔹';
                                ?>
                                <span><?php echo esc_html($pf['title']); ?></span>
                            </div>
                            <p class="text-[11px] sm:text-xs text-gray-600 mt-1.5 leading-relaxed m-0">
                                <?php echo esc_html($pf['desc']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- SPÉCIFICATIONS & CARACTÉRISTIQUES TECHNIQUES -->
        <div class="space-y-3 pt-4">
            <h2 class="text-sm sm:text-base font-black text-[#154c9e] uppercase tracking-wider border-b-2 border-[#154c9e] pb-1 m-0">
                SPÉCIFICATIONS &amp; CARACTÉRISTIQUES TECHNIQUES
            </h2>

            <div class="border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse text-[11px] sm:text-xs">
                    <thead>
                        <tr class="bg-[#0B192C] text-white">
                            <?php foreach ($fiche['specs_table']['headers'] as $idx => $th): ?>
                                <th class="py-2.5 px-4 font-black uppercase text-[10px] sm:text-[11px] tracking-wider <?php echo ($idx === 0) ? 'w-4/12' : 'w-4/12'; ?>">
                                    <?php echo esc_html($th); ?>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($fiche['specs_table']['rows'] as $r_idx => $row): ?>
                            <tr class="<?php echo ($r_idx % 2 === 0) ? 'bg-slate-50/70' : 'bg-white'; ?>">
                                <td class="py-2.5 px-4 font-extrabold text-gray-900 border-r border-slate-200">
                                    <?php echo esc_html($row['label']); ?>
                                </td>
                                <td class="py-2.5 px-4 text-gray-700 font-medium border-r border-slate-200">
                                    <?php echo esc_html($row['bac']); ?>
                                </td>
                                <td class="py-2.5 px-4 text-gray-700 font-medium">
                                    <?php echo esc_html($row['ondu']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- GUIDE DE MONTAGE & RECOMMANDATIONS DE POSE -->
        <div class="space-y-3 pt-4">
            <h2 class="text-sm sm:text-base font-black text-[#154c9e] uppercase tracking-wider border-b-2 border-[#154c9e] pb-1 m-0">
                GUIDE DE MONTAGE &amp; RECOMMANDATIONS DE POSE
            </h2>

            <div class="border border-slate-200 rounded-xl p-5 bg-white space-y-2.5 shadow-2xs text-[11px] sm:text-xs text-gray-700 leading-relaxed">
                <?php foreach ($fiche['guide_pose'] as $g_item): ?>
                    <p class="m-0 flex items-start gap-2">
                        <span class="font-black text-[#154c9e] shrink-0 mt-0.5">•</span>
                        <span>
                            <strong class="font-extrabold text-gray-900"><?php echo esc_html($g_item['label']); ?> :</strong>
                            <?php echo esc_html($g_item['text']); ?>
                        </span>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- PIED DE PAGE : PAGE 1 / 2 -->
        <div class="pt-4 border-t border-slate-200 flex justify-between items-center text-[10px] text-gray-400 font-mono tracking-wide">
            <span>Fiche Technique &amp; Descriptif Produit | <?php echo esc_html($title); ?></span>
            <span>Page 1 / 2</span>
        </div>

    </div>

    <!-- =================================================================== -->
    <!-- PAGE 2 : CROQUIS TECHNIQUES & DÉTAILS DE FIXATION                   -->
    <!-- =================================================================== -->
    <div class="sheet-page-2 bg-white border border-slate-200 rounded-2xl p-6 sm:p-10 shadow-xl space-y-8">

        <!-- TITRE CROQUIS TECHNIQUES -->
        <div>
            <h2 class="text-base sm:text-lg font-black text-[#154c9e] uppercase tracking-wider border-b-2 border-[#154c9e] pb-1 m-0">
                CROQUIS TECHNIQUES &amp; DÉTAILS DE FIXATION
            </h2>
        </div>

        <?php if ($product_family === 'tole'): ?>
            <!-- 1. PROFILS EN COUPE & STRUCTURE MULTICOUCHE PRÉLAQUÉE -->
            <div class="space-y-4">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    1. PROFILS EN COUPE &amp; STRUCTURE MULTICOUCHE PRÉLAQUÉE (<?php echo esc_html($fiche['epaisseur_val'] ?? '0,35 mm'); ?>)
                </h3>

                <div class="relative bg-slate-50/50 border border-slate-200 rounded-2xl p-4 sm:p-6 space-y-6">
                    <div class="sm:absolute top-4 right-4 z-10 bg-blue-50/95 border border-blue-200 rounded-lg p-3 text-[10px] sm:text-[11px] text-blue-900 shadow-sm sm:max-w-xs space-y-1">
                        <div class="font-extrabold uppercase text-[#154c9e] border-b border-blue-200 pb-1">
                            STRUCTURE MULTICOUCHE PRÉLAQUÉE :
                        </div>
                        <ul class="list-none p-0 m-0 space-y-0.5 text-gray-700">
                            <li>▫ Couche de finition Polyester / PVDF (20-25 µm)</li>
                            <li>▫ Primaire d'accrochage anticorrosion (5 µm)</li>
                            <li>▫ Âme en Aluminium Haute Résistance (<?php echo esc_html($fiche['epaisseur_val'] ?? '0,35 mm'); ?>)</li>
                            <li>▫ Revêtement protecteur verso / Backer (5-7 µm)</li>
                        </ul>
                    </div>

                    <!-- A. PROFIL BAC TRAPÉZOÏDAL PRÉLAQUÉ -->
                    <div class="space-y-2">
                        <div class="text-xs font-extrabold text-[#154c9e] uppercase">
                            A. PROFIL BAC TRAPÉZOÏDAL PRÉLAQUÉ <span class="text-gray-500 font-medium">(Largeur utile ~850-920 mm | H=28 mm)</span>
                        </div>
                        <div class="w-full overflow-x-auto bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
                            <svg viewBox="0 0 800 120" class="w-full h-auto min-w-[600px] stroke-[#154c9e]" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M 20,80 L 70,80 L 95,20 L 155,20 L 180,80 L 250,80 L 275,20 L 335,20 L 360,80 L 430,80 L 455,20 L 515,20 L 540,80 L 610,80 L 635,20 L 695,20 L 720,80 L 780,80" />
                                <line x1="165" y1="20" x2="165" y2="80" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="3,3" />
                                <line x1="95" y1="15" x2="155" y2="15" stroke="#3b82f6" stroke-width="1.5" />
                                <text x="125" y="10" fill="#3b82f6" font-size="10" font-weight="bold" text-anchor="middle">Sommet onde</text>
                                <line x1="20" y1="105" x2="780" y2="105" stroke="#64748b" stroke-width="1.5" />
                                <text x="400" y="100" fill="#64748b" font-size="11" font-weight="bold" text-anchor="middle">Largeur totale : ~950 à 1050 mm (Utile : ~850 à 920 mm)</text>
                            </svg>
                        </div>
                    </div>

                    <!-- B. PROFIL ONDULÉ SINUSOÏDAL PRÉLAQUÉ -->
                    <div class="space-y-2 pt-2">
                        <div class="text-xs font-extrabold text-[#154c9e] uppercase">
                            B. PROFIL ONDULÉ SINUSOÏDAL PRÉLAQUÉ <span class="text-gray-500 font-medium">(Pas = 76 mm | Hauteur onde = 18 mm)</span>
                        </div>
                        <div class="w-full overflow-x-auto bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
                            <svg viewBox="0 0 800 90" class="w-full h-auto min-w-[600px] stroke-[#154c9e]" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M 20,50 Q 40,15 65,50 T 110,50 Q 130,15 155,50 T 200,50 Q 220,15 245,50 T 290,50 Q 310,15 335,50 T 380,50 Q 400,15 425,50 T 470,50 Q 490,15 515,50 T 560,50 Q 580,15 605,50 T 650,50 Q 670,15 695,50 T 740,50 L 780,50" />
                                <line x1="200" y1="65" x2="290" y2="65" stroke="#3b82f6" stroke-width="1.5" />
                                <text x="245" y="80" fill="#3b82f6" font-size="10" font-weight="bold" text-anchor="middle">Pas standard = 76 mm</text>
                                <line x1="605" y1="20" x2="605" y2="50" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="2,2" />
                                <text x="635" y="35" fill="#64748b" font-size="10" font-weight="bold">H = 18 mm</text>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. SCHÉMA DE FIXATION ÉTANCHE TEINTÉE -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    2. SCHÉMA DE FIXATION ÉTANCHE TEINTÉE (Pose en Sommet d'Onde / Nervure)
                </h3>
                <div class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-6 shadow-2xs">
                    <div class="w-full overflow-x-auto">
                        <svg viewBox="0 0 850 320" class="w-full h-auto min-w-[650px]">
                            <defs>
                                <pattern id="wood-hatch" width="20" height="20" patternTransform="rotate(45 0 0)" patternUnits="userSpaceOnUse">
                                    <line x1="0" y1="0" x2="0" y2="20" stroke="#d97706" stroke-width="2" opacity="0.4" />
                                </pattern>
                            </defs>
                            <rect x="50" y="190" width="750" height="60" fill="#fef3c7" stroke="#d97706" stroke-width="2.5" rx="4" />
                            <rect x="50" y="190" width="750" height="60" fill="url(#wood-hatch)" rx="4" />
                            <text x="425" y="226" fill="#92400e" font-size="12" font-weight="900" letter-spacing="1" text-anchor="middle">
                                PANNE DE CHARPENTE (BOIS OU MÉTALLIQUE)
                            </text>
                            <path d="M 30,190 L 80,190 L 105,120 L 165,120 L 190,190 L 260,190 L 285,120 L 345,120 L 370,190 L 440,190 L 465,120 L 525,120 L 550,190 L 620,190 L 645,120 L 705,120 L 730,190 L 790,190" fill="none" stroke="#154c9e" stroke-width="4" stroke-linecap="round" />
                            <?php foreach ([135, 315, 495, 675] as $cx): ?>
                                <path d="M <?php echo ($cx - 15); ?>,118 L <?php echo $cx; ?>,108 L <?php echo ($cx + 15); ?>,118 Z" fill="#1e3a8a" stroke="#1e3a8a" stroke-width="1.5" />
                                <rect x="<?php echo ($cx - 5); ?>" y="94" width="10" height="14" fill="#0f172a" rx="1.5" />
                                <circle cx="<?php echo $cx; ?>" cy="101" r="3" fill="#3b82f6" />
                                <line x1="<?php echo $cx; ?>" y1="120" x2="<?php echo $cx; ?>" y2="230" stroke="#0284c7" stroke-width="3" stroke-linecap="round" />
                            <?php endforeach; ?>
                            <g>
                                <rect x="180" y="20" width="220" height="55" rx="8" fill="#fef2f2" stroke="#ef4444" stroke-width="1.5" />
                                <text x="190" y="38" fill="#b91c1c" font-size="10" font-weight="bold">Vis autoperceuse laquée tête couleur</text>
                                <text x="190" y="52" fill="#b91c1c" font-size="10" font-weight="bold">+ Cavalier prélaqué assorti + Joint EPDM</text>
                                <text x="190" y="65" fill="#dc2626" font-size="9" font-style="italic">(Fixation impérative en sommet d'onde)</text>
                                <line x1="220" y1="75" x2="140" y2="105" stroke="#ef4444" stroke-width="1.5" stroke-dasharray="3,3" />
                                <circle cx="140" cy="105" r="3" fill="#ef4444" />
                            </g>
                            <line x1="100" y1="275" x2="750" y2="275" stroke="#64748b" stroke-width="1.5" />
                            <line x1="100" y1="270" x2="100" y2="280" stroke="#64748b" stroke-width="1.5" />
                            <line x1="750" y1="270" x2="750" y2="280" stroke="#64748b" stroke-width="1.5" />
                            <rect x="250" y="263" width="350" height="24" rx="12" fill="#ffffff" stroke="#cbd5e1" stroke-width="1" />
                            <text x="425" y="279" fill="#475569" font-size="10" font-weight="bold" text-anchor="middle">
                                ↔ Entraxe régulier des pannes : 60 cm à 90 cm max selon la pente et la charge
                            </text>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- 3. PRINCIPE D'EMBOÎTEMENT & NUANCIER COULEURS DISPONIBLES (RAL) -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    3. PRINCIPE D'EMBOÎTEMENT &amp; NUANCIER COULEURS DISPONIBLES (RAL)
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center bg-slate-50/50 border border-slate-200 rounded-2xl p-5 sm:p-7">
                    <div class="lg:col-span-6 flex flex-col items-center">
                        <div class="w-full max-w-sm">
                            <svg viewBox="0 0 360 220" class="w-full h-auto">
                                <polygon points="40,160 160,30 340,30 220,160" fill="#2563eb" stroke="#1d4ed8" stroke-width="2" opacity="0.9" />
                                <polygon points="40,160 220,160 215,168 35,168" fill="#1e40af" stroke="#1d4ed8" stroke-width="1.5" />
                                <line x1="85" y1="160" x2="205" y2="30" stroke="#60a5fa" stroke-width="2" opacity="0.6" />
                                <line x1="130" y1="160" x2="250" y2="30" stroke="#60a5fa" stroke-width="2" opacity="0.6" />
                                <line x1="175" y1="160" x2="295" y2="30" stroke="#60a5fa" stroke-width="2" opacity="0.6" />
                                <line x1="25" y1="180" x2="145" y2="45" stroke="#ef4444" stroke-width="2.5" stroke-linecap="round" />
                                <polygon points="145,45 135,53 148,56" fill="#ef4444" />
                                <polygon points="25,180 35,172 22,169" fill="#ef4444" />
                                <text x="75" y="105" transform="rotate(-47 75 105)" fill="#b91c1c" font-size="10" font-weight="900">
                                    Longueur commerciale (2 m à 6 m+)
                                </text>
                                <text x="175" y="110" fill="#ffffff" font-size="11" font-weight="bold" text-anchor="middle">
                                    Tôle Alu Prélaquée (Longueur 2 m à 6 m+)
                                </text>
                            </svg>
                        </div>
                    </div>
                    <div class="lg:col-span-6 space-y-3">
                        <div class="text-xs font-black uppercase tracking-wider text-[#154c9e] text-center lg:text-left border-b border-slate-200 pb-1.5">
                            NUANCIER STANDARD DISPONIBLE :
                        </div>
                        <div class="grid grid-cols-5 gap-2 pt-1 text-center">
                            <?php foreach ($fiche['ral_swatches'] as $sw): ?>
                                <div class="flex flex-col items-center gap-1.5">
                                    <div class="w-full h-16 sm:h-20 rounded-lg shadow-sm border border-black/10 transition-transform hover:scale-105" style="background-color: <?php echo esc_attr($sw['hex']); ?>;"></div>
                                    <div class="text-[9px] sm:text-[10px] font-bold text-gray-800 leading-tight"><?php echo esc_html($sw['name']); ?></div>
                                    <div class="text-[8px] sm:text-[9px] text-gray-500 font-mono">(<?php echo esc_html($sw['ral']); ?>)</div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($product_family === 'accessoire'): ?>
            <!-- 1. PROFILS EN COUPE DE L'ACCESSOIRE -->
            <div class="space-y-4">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    1. GÉOMÉTRIE &amp; DÉVELOPPÉ RÉGLEMENTAIRE (DÉVELOPPÉ 0,33 M À 0,35 M)
                </h3>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-2xs space-y-4">
                    <div class="w-full overflow-x-auto">
                        <svg viewBox="0 0 800 160" class="w-full h-auto min-w-[600px] stroke-[#154c9e]" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <!-- Profil Faîtière Double Pente avec Relevés -->
                            <path d="M 50,130 L 100,120 L 380,30 L 400,25 L 420,30 L 700,120 L 750,130" />
                            <!-- Aile gauche -->
                            <line x1="100" y1="120" x2="380" y2="30" stroke="#2563eb" stroke-width="4" />
                            <text x="240" y="65" fill="#1e40af" font-size="11" font-weight="bold" transform="rotate(-18 240 65)">Aile gauche (160 mm)</text>
                            <!-- Aile droite -->
                            <line x1="420" y1="30" x2="700" y2="120" stroke="#2563eb" stroke-width="4" />
                            <text x="560" y="65" fill="#1e40af" font-size="11" font-weight="bold" transform="rotate(18 560 65)">Aile droite (160 mm)</text>
                            <!-- Ourlet anti-goutte aux extrémités -->
                            <circle cx="50" cy="130" r="4" fill="#154c9e" />
                            <circle cx="750" cy="130" r="4" fill="#154c9e" />
                            <!-- Angle au faîte -->
                            <path d="M 370,50 Q 400,65 430,50" stroke="#f59e0b" stroke-width="2" />
                            <text x="400" y="80" fill="#b45309" font-size="10" font-weight="bold" text-anchor="middle">Angle adaptable (100° à 140°)</text>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- 2. SCHÉMA DE JONCTION SUR COUVERTURE -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    2. SCHÉMA DE JONCTION ÉTANCHE SUR TÔLE DE COUVERTURE
                </h3>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-2xs">
                    <svg viewBox="0 0 800 220" class="w-full h-auto">
                        <!-- Deux versants de tôle -->
                        <path d="M 50,180 L 380,60" stroke="#94a3b8" stroke-width="5" stroke-linecap="round" />
                        <path d="M 750,180 L 420,60" stroke="#94a3b8" stroke-width="5" stroke-linecap="round" />
                        <!-- Faîtière au-dessus -->
                        <path d="M 120,160 L 400,50 L 680,160" fill="none" stroke="#154c9e" stroke-width="5" stroke-linecap="round" />
                        <!-- Fixation sur onde -->
                        <line x1="260" y1="90" x2="260" y2="135" stroke="#ef4444" stroke-width="3" stroke-linecap="round" />
                        <rect x="252" y="80" width="16" height="10" fill="#dc2626" rx="2" />
                        <line x1="540" y1="90" x2="540" y2="135" stroke="#ef4444" stroke-width="3" stroke-linecap="round" />
                        <rect x="532" y="80" width="16" height="10" fill="#dc2626" rx="2" />
                        <text x="400" y="30" fill="#154c9e" font-size="12" font-weight="900" text-anchor="middle">FAÎTIÈRE COIFFANTE EN ALUMINIUM PUR</text>
                        <text x="400" y="195" fill="#475569" font-size="11" font-weight="bold" text-anchor="middle">Vissage étanche traversant au sommet d'onde de part et d'autre de la crête</text>
                    </svg>
                </div>
            </div>

            <!-- 3. NUANCIER RAL COORDONNÉ -->
            <div class="space-y-3 pt-2">
                <div class="text-xs font-black uppercase tracking-wider text-[#154c9e] text-center border-b border-slate-200 pb-1.5">
                    NUANCIER RAL ASSORTI AUX TÔLES DE TOITURE :
                </div>
                <div class="grid grid-cols-5 gap-3 text-center">
                    <?php foreach ($fiche['ral_swatches'] as $sw): ?>
                        <div class="flex flex-col items-center gap-1.5">
                            <div class="w-full h-16 sm:h-20 rounded-lg shadow-sm border border-black/10 transition-transform hover:scale-105" style="background-color: <?php echo esc_attr($sw['hex']); ?>;"></div>
                            <div class="text-[9px] sm:text-[10px] font-bold text-gray-800 leading-tight"><?php echo esc_html($sw['name']); ?></div>
                            <div class="text-[8px] sm:text-[9px] text-gray-500 font-mono">(<?php echo esc_html($sw['ral']); ?>)</div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php elseif ($product_family === 'fixation'): ?>
            <!-- 1. ÉCLATÉ TECHNIQUE DE LA FIXATION & ÉTANCHÉITÉ -->
            <div class="space-y-4">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    1. VUE ÉCLATÉE DU SYSTÈME D'ANCRAGE &amp; BARRIÈRE ÉTANCHE
                </h3>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-2xs">
                    <svg viewBox="0 0 800 240" class="w-full h-auto">
                        <!-- Tête de vis hexagonale avec collerette -->
                        <rect x="360" y="20" width="80" height="35" rx="4" fill="#0f172a" />
                        <circle cx="400" cy="37" r="10" fill="#2563eb" />
                        <text x="460" y="42" fill="#0f172a" font-size="11" font-weight="bold">1. Tête hexagonale zinguée avec embase large</text>
                        <!-- Rondelle vulcanisée EPDM -->
                        <rect x="345" y="70" width="110" height="15" rx="3" fill="#64748b" />
                        <rect x="345" y="85" width="110" height="10" rx="2" fill="#1e293b" />
                        <text x="470" y="87" fill="#475569" font-size="11" font-weight="bold">2. Rondelle acier + Joint néoprène EPDM inaltérable</text>
                        <!-- Cavalier alu trapézoïdal -->
                        <path d="M 320,120 L 400,105 L 480,120 L 460,135 L 400,125 L 340,135 Z" fill="#154c9e" />
                        <text x="500" y="125" fill="#154c9e" font-size="11" font-weight="bold">3. Cavalier d'onde en aluminium (répartition de charge)</text>
                        <!-- Tige filetée et pointe forêt -->
                        <rect x="393" y="135" width="14" height="70" fill="#0284c7" />
                        <polygon points="390,205 410,205 400,230" fill="#0369a1" />
                        <text x="430" y="180" fill="#0284c7" font-size="11" font-weight="bold">4. Filetage renforcé &amp; pointe auto-foreuse trempée</text>
                    </svg>
                </div>
            </div>

            <!-- 2. ANCRAGE SUR PANNE DE CHARPENTE -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    2. PÉNÉTRATION &amp; COMPRESSION D'ÉTANCHÉITÉ DANS LA PANNE
                </h3>
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-2xs text-center">
                    <p class="text-xs text-gray-700 leading-relaxed max-w-2xl mx-auto m-0">
                        La fixation TPM SA pénètre d'au moins <strong>40 à 50 mm</strong> dans le bois de charpente pour mobiliser la résistance au cisaillement des fibres. Le joint EPDM doit être comprimé à <strong>30% de son épaisseur initiale</strong> pour assurer l'herméticité sans dépasser le point d'écrasement.
                    </p>
                </div>
            </div>

        <?php elseif ($product_family === 'carrelage'): ?>
            <!-- 1. COUPE TECHNIQUE DE POSE DU CARRELAGE -->
            <div class="space-y-4">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    1. COUPE STRUCTURELLE DE POSE COLLÉE SUR CHAPE (NORME C2TE)
                </h3>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-2xs">
                    <svg viewBox="0 0 800 240" class="w-full h-auto">
                        <!-- Dalle béton support -->
                        <rect x="50" y="180" width="700" height="50" fill="#94a3b8" />
                        <text x="400" y="210" fill="#ffffff" font-size="11" font-weight="bold" text-anchor="middle">DALLE BÉTON STRUCTURALE ARMÉE</text>
                        <!-- Chape ciment de nivellement -->
                        <rect x="50" y="130" width="700" height="50" fill="#cbd5e1" stroke="#94a3b8" stroke-dasharray="3,3" />
                        <text x="400" y="160" fill="#475569" font-size="11" font-weight="bold" text-anchor="middle">CHAPE CIMENT DE NIVELLEMENT PARFAITEMENT SÈCHE</text>
                        <!-- Lit de mortier colle -->
                        <rect x="50" y="100" width="700" height="30" fill="#fde68a" stroke="#d97706" />
                        <text x="400" y="120" fill="#92400e" font-size="10" font-weight="bold" text-anchor="middle">LIT DE MORTIER-COLLE HAUTE ADHÉRENCE C2TE (5 MM)</text>
                        <!-- Carreaux de grès cérame avec joints -->
                        <rect x="60" y="60" width="200" height="40" fill="#1e293b" rx="2" />
                        <rect x="270" y="60" width="200" height="40" fill="#1e293b" rx="2" />
                        <rect x="480" y="60" width="200" height="40" fill="#1e293b" rx="2" />
                        <!-- Joint hydrofuge -->
                        <line x1="265" y1="60" x2="265" y2="100" stroke="#38bdf8" stroke-width="4" />
                        <line x1="475" y1="60" x2="475" y2="100" stroke="#38bdf8" stroke-width="4" />
                        <text x="400" y="45" fill="#0f172a" font-size="11" font-weight="black" text-anchor="middle">CARRELAGE GRÈS CÉRAME 1ER CHOIX AVEC JOINT HYDROFUGE (2 MM)</text>
                    </svg>
                </div>
            </div>

            <!-- 2. NORMES & CLASSIFICATION DU GRÈS CÉRAME -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    2. RÉSISTANCE À L'ABRASION (PEI) &amp; POROSITÉ HYDROFUGE
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="border border-slate-200 rounded-xl p-4 bg-slate-50 text-center">
                        <div class="text-xl font-black text-[#154c9e]">PEI IV / V</div>
                        <div class="text-xs font-bold text-gray-800 mt-1">Trafic Intense &amp; Résistance Rayures</div>
                        <p class="text-[11px] text-gray-600 mt-1 m-0">Convient parfaitement aux espaces publics, commerces, séjours et terrasses.</p>
                    </div>
                    <div class="border border-slate-200 rounded-xl p-4 bg-slate-50 text-center">
                        <div class="text-xl font-black text-emerald-600">E &lt; 0.08%</div>
                        <div class="text-xs font-bold text-gray-800 mt-1">Absorption d'Eau Quasi-Nulle</div>
                        <p class="text-[11px] text-gray-600 mt-1 m-0">Matériau vitrifié non poreux : zéro moisissure, inaltérable sous climat humide.</p>
                    </div>
                    <div class="border border-slate-200 rounded-xl p-4 bg-slate-50 text-center">
                        <div class="text-xl font-black text-amber-600">&gt; 35 N/mm²</div>
                        <div class="text-xs font-bold text-gray-800 mt-1">Résistance à la Flexion</div>
                        <p class="text-[11px] text-gray-600 mt-1 m-0">Haute ténacité structurelle éliminant le risque de casse sous les charges de meubles.</p>
                    </div>
                </div>
            </div>

        <?php elseif ($product_family === 'douche'): ?>
            <!-- SCHÉMA D'INSTALLATION SANITAIRE & ÉLECTRIQUE -->
            <div class="space-y-4">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    SCHÉMA DE RACCORDEMENT HYDRAULIQUE &amp; SÉCURITÉ ÉLECTRIQUE
                </h3>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-2xs">
                    <svg viewBox="0 0 800 240" class="w-full h-auto">
                        <!-- Boîtier douche thérapeutique -->
                        <rect x="320" y="40" width="160" height="140" rx="16" fill="#f8fafc" stroke="#0284c7" stroke-width="4" />
                        <circle cx="400" cy="90" r="30" fill="#e0f2fe" stroke="#0284c7" stroke-width="2" />
                        <text x="400" y="95" fill="#0369a1" font-size="11" font-weight="900" text-anchor="middle">SÉLECTEUR</text>
                        <!-- Buse de pulvérisation multi-jets -->
                        <path d="M 300,180 L 500,180 L 480,210 L 320,210 Z" fill="#0284c7" />
                        <line x1="340" y1="215" x2="330" y2="235" stroke="#38bdf8" stroke-width="2" stroke-dasharray="2,2" />
                        <line x1="370" y1="215" x2="365" y2="235" stroke="#38bdf8" stroke-width="2" stroke-dasharray="2,2" />
                        <line x1="400" y1="215" x2="400" y2="235" stroke="#38bdf8" stroke-width="2" stroke-dasharray="2,2" />
                        <line x1="430" y1="215" x2="435" y2="235" stroke="#38bdf8" stroke-width="2" stroke-dasharray="2,2" />
                        <line x1="460" y1="215" x2="470" y2="235" stroke="#38bdf8" stroke-width="2" stroke-dasharray="2,2" />
                        <!-- Arrivée d'eau -->
                        <line x1="150" y1="100" x2="320" y2="100" stroke="#0284c7" stroke-width="8" />
                        <text x="150" y="85" fill="#0284c7" font-size="11" font-weight="bold">Arrivée d'eau 1/2" mâle</text>
                        <!-- Alimentation électrique sécurisée -->
                        <line x1="650" y1="60" x2="480" y2="60" stroke="#ef4444" stroke-width="4" />
                        <text x="520" y="45" fill="#ef4444" font-size="10" font-weight="bold">Phase &amp; Neutre (Câble 4-6 mm²)</text>
                        <!-- Mise à la terre -->
                        <line x1="650" y1="90" x2="480" y2="90" stroke="#22c55e" stroke-width="4" stroke-dasharray="4,2" />
                        <text x="520" y="110" fill="#15803d" font-size="10" font-weight="bold">Mise à la terre obligatoire (Terre)</text>
                    </svg>
                </div>
            </div>

        <?php else: ?>
            <!-- PLASTURGIE / SACS PP OU AUTRES MATÉRIAUX -->
            <div class="space-y-4">
                <h3 class="text-xs sm:text-sm font-black text-gray-800 text-center uppercase tracking-wider m-0">
                    MATRICE DE TISSAGE CIRCULAIRE &amp; RÉSISTANCE À LA RUPTURE
                </h3>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-2xs text-center space-y-4">
                    <svg viewBox="0 0 800 180" class="w-full h-auto">
                        <!-- Tissage croisé PP -->
                        <?php for ($i = 50; $i <= 750; $i += 40): ?>
                            <line x1="<?php echo $i; ?>" y1="20" x2="<?php echo $i; ?>" y2="160" stroke="#94a3b8" stroke-width="4" />
                        <?php endfor; ?>
                        <?php for ($j = 30; $j <= 150; $j += 30): ?>
                            <line x1="40" y1="<?php echo $j; ?>" x2="760" y2="<?php echo $j; ?>" stroke="#154c9e" stroke-width="4" />
                        <?php endfor; ?>
                    </svg>
                    <p class="text-xs text-gray-700 leading-relaxed max-w-2xl mx-auto m-0">
                        Polypropylène pur extrudé en rubans haute ténacité et croisé sur métiers à tisser circulaires sans couture latérale. Finition avec double point de chaînette en fil polyester au fond pour prévenir toute perte de grains ou de poudre.
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <!-- PIED DE PAGE : PAGE 2 / 2 -->
        <div class="pt-4 border-t border-slate-200 flex justify-between items-center text-[10px] text-gray-400 font-mono tracking-wide">
            <span>Fiche Technique &amp; Descriptif Produit | <?php echo esc_html($title); ?></span>
            <span>Page 2 / 2</span>
        </div>

    </div>

</div>

<!-- SCRIPT SWITCHER D'IMAGE -->
<script>
function changeProductImage(src, thumb) {
    const mainImg = document.getElementById('main-product-image');
    if (mainImg) {
        mainImg.style.opacity = '0.3';
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