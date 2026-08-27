<?php
/**
 * Custom Single Product Template - TPM SA (Groupe CAC)
 * Fiche Technique Certifiée Industrielle (2 Pages A4 Pro-Forma & Catalogue)
 * Avec croquis techniques cotés et fidèles pour chaque produit
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_ID() );
}

if ( ! $product ) return;

$product_id = $product->get_id();
$title      = $product->get_name();
$sku        = $product->get_sku() ?: ('TPM-' . $product_id);
$price_html = $product->get_price_html();
$price_raw  = $product->get_price();
$unit       = get_post_meta( $product_id, '_unit', true ) ?: 'unité';

$img_id     = $product->get_image_id();
$img_url    = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : wc_placeholder_img_src('large');
$gallery    = $product->get_gallery_image_ids();
$item_images = array_filter( array_merge( [$img_url], array_map( fn($gid) => wp_get_attachment_image_url( $gid, 'large' ), $gallery ) ) );

// Récupération des données techniques certifiées TPM SA
require_once get_template_directory() . '/inc/fiche-technique.php';
$fiche = tpm_get_product_fiche_technique( $product );

// Longueurs & Couleurs personnalisées selon le produit
$flash_details = [
    'length_label' => 'LONGUEUR DE COUPE',
    'color_label'  => 'COULEUR RAL',
    'lengths'      => ['Standard 6.00m', 'Sur-mesure 3.00m', 'Sur-mesure 4.00m', 'Sur-mesure 5.00m', 'Sur-mesure 7.00m', 'Sur-mesure 8.00m', 'Sur-mesure 10.00m', 'Sur-mesure 12.00m'],
    'colors'       => ['Bordeaux RAL 3005', 'Bleu Cendre RAL 5014', 'Orange Terracotta', 'Vert Olive RAL 6003', 'Gris Anthracite RAL 7016']
];

if ( preg_match( '/ondule/iu', $title ) ) {
    $flash_details['length_label'] = 'FORMAT STANDARD';
    $flash_details['color_label']  = 'FINITION';
    $flash_details['lengths']      = ['Format 3.00m (Standard)', 'Format 2.00m', 'Format 2.50m', 'Format 4.00m', 'Sur-mesure'];
    $flash_details['colors']       = ['Alu Naturel Brillant', 'Alu Satiné'];
} elseif ( preg_match( '/nature/iu', $title ) && ! preg_match( '/pr[eé]laqu/iu', $title ) ) {
    $flash_details['colors'] = ['Alu Naturel Brillant', 'Alu Naturel Traité'];
} elseif ( preg_match( '/vis|tirefond|cavalier|toiturole|rondelle|plaquette|tige/iu', $title ) ) {
    $flash_details['length_label'] = 'CONDITIONNEMENT';
    $flash_details['color_label']  = 'FINITION ACIER / ALU';
    $flash_details['lengths']      = ['Boîte de 100 pcs', 'Paquet de 72 pcs', 'Carton Pro 500 pcs', 'À l\'unité'];
    $flash_details['colors']       = ['Acier Zingué Inox', 'Alu Brut', 'Tête Prélaquée Assortie'];
} elseif ( preg_match( '/carreau|faience|sol|mur/iu', $title ) ) {
    $flash_details['length_label'] = 'CALIBRE / SURFACE';
    $flash_details['color_label']  = 'FINITION / EFFET';
    $flash_details['lengths']      = ['Carton Standard 1.44 m²', 'Carton 1.50 m²', 'Palette Complète (~40-60 m²)'];
    $flash_details['colors']       = ['Finition Polie Brillante', 'Finition Satinée Mat', 'Bords Rectifiés'];
} elseif ( preg_match( '/douche/iu', $title ) ) {
    $flash_details['length_label'] = 'TENSION / PUISSANCE';
    $flash_details['color_label']  = 'FINITION DU CORPS';
    $flash_details['lengths']      = ['220V - 6000W / 7500W Standard', '220V - 5500W Éco'];
    $flash_details['colors']       = ['Blanc Sanitaire & Chrome', 'Gris Platine'];
} elseif ( preg_match( '/[eé]ponge/iu', $title ) ) {
    $flash_details['length_label'] = 'CONDITIONNEMENT';
    $flash_details['color_label']  = 'GRADE MÉTAL';
    $flash_details['lengths']      = ['Sachet de 20 pièces', 'Sachet de 25 pièces', 'Carton Gros 200 pcs'];
    $flash_details['colors']       = ['Inox AISI 430 Pur', 'Double Couche Mousse'];
}

$wa_message = urlencode("Bonjour TPM SA, je souhaite commander : " . $title . " (Réf: " . $sku . ").");
$wa_url = "https://wa.me/237655705866?text=" . $wa_message;
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'max-w-5xl mx-auto space-y-6', $product ); ?>>

    <!-- BARRE D'ACTIONS RAPIDES : RETOUR & IMPRESSION PDF (SCREEN ONLY) -->
    <div class="print:hidden flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-xl border border-gray-200 shadow-2xs">
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-flex items-center gap-1.5 text-xs font-bold text-tpm-navy hover:text-tpm-orange transition">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Retour au Catalogue Général</span>
        </a>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 bg-[#154c9e] hover:bg-blue-900 text-white text-xs font-black px-4 py-2 rounded-lg shadow transition cursor-pointer">
                <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                <span>Télécharger la Fiche Technique PDF</span>
            </button>
            <a href="<?php echo esc_url($wa_url); ?>" target="_blank" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black px-4 py-2 rounded-lg shadow transition">
                <span class="material-symbols-outlined text-[18px]">chat</span>
                <span>Assistance WhatsApp</span>
            </a>
        </div>
    </div>

    <!-- BANDEAU DE COMMANDE & PRO-FORMA RAPIDE (SCREEN ONLY) -->
    <div class="print:hidden grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
        <!-- CARD 1 : VISUEL DU PRODUIT & GALERIE -->
        <div class="lg:col-span-4 bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex flex-col items-center justify-center">
            <div class="aspect-[4/3] w-full max-w-xs bg-slate-50 border border-gray-200 rounded-xl p-3 flex items-center justify-center overflow-hidden group">
                <img id="main-product-image" 
                     src="<?php echo esc_url($img_url); ?>" 
                     alt="<?php echo esc_attr($title); ?>" 
                     class="max-h-48 w-auto object-contain transition-transform duration-300 group-hover:scale-105" />
            </div>
            <?php if ( count( $item_images ) > 1 ) : ?>
                <div class="flex gap-2 pt-3">
                    <?php foreach ( $item_images as $idx => $t_url ) : ?>
                        <div class="w-12 h-12 bg-white border-2 <?php echo ($idx === 0) ? 'border-tpm-orange' : 'border-gray-200 opacity-70'; ?> rounded-lg overflow-hidden cursor-pointer transition p-0.5 product-thumb"
                             onclick="changeProductImage('<?php echo esc_url($t_url); ?>', this)">
                            <img src="<?php echo esc_url($t_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover rounded"/>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- CARD 2 : TOUT LE BLOC DE COMMANDE & TARIFS DANS LE MÊME BOX/CARD/SECTION/DIV -->
        <div class="lg:col-span-8 bg-white border border-slate-200 rounded-2xl p-6 sm:p-7 shadow-md flex flex-col justify-between space-y-4">
            
            <!-- 1. En-tête Tarif Usine & TVA -->
            <div class="flex flex-wrap items-baseline justify-between gap-3 border-b border-gray-100 pb-3.5">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-gray-400 block mb-0.5">
                        Tarif Usine Direct Fabricant :
                    </span>
                    <div class="text-2xl sm:text-3xl font-black text-tpm-orange leading-none">
                        <?php echo $price_html; ?>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-gray-600 uppercase block">
                        HT / <?php echo esc_html($unit); ?>
                    </span>
                    <span class="inline-block text-[10px] text-emerald-700 font-extrabold bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 rounded mt-1">
                        TVA 19.25% Récupérable
                    </span>
                </div>
            </div>

            <!-- 2. Formulaire avec Longueur, Couleur, Quantité & Bouton Pro-Forma -->
            <form id="fiche-add-to-cart-form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' class="space-y-4">
                
                <!-- Sélecteurs Format / Longueur & Couleur / Finition -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-tpm-navy mb-1.5 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px] text-tpm-orange">straighten</span>
                            <?php echo esc_html($flash_details['length_label']); ?>
                        </label>
                        <select name="flash_length" class="w-full text-xs font-bold bg-slate-50 border border-gray-300 rounded-xl px-3 py-2.5 text-gray-800 outline-none focus:ring-2 focus:ring-tpm-orange transition cursor-pointer shadow-2xs">
                            <?php foreach ($flash_details['lengths'] as $l_opt): ?>
                                <option value="<?php echo esc_attr($l_opt); ?>"><?php echo esc_html($l_opt); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-tpm-navy mb-1.5 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px] text-tpm-orange">palette</span>
                            <?php echo esc_html($flash_details['color_label']); ?>
                        </label>
                        <select name="flash_color" class="w-full text-xs font-bold bg-slate-50 border border-gray-300 rounded-xl px-3 py-2.5 text-gray-800 outline-none focus:ring-2 focus:ring-tpm-orange transition cursor-pointer shadow-2xs">
                            <?php foreach ($flash_details['colors'] as $c_opt): ?>
                                <option value="<?php echo esc_attr($c_opt); ?>"><?php echo esc_html($c_opt); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Quantité & Bouton Ajouter au Panier Pro-Forma -->
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end">
                    <div class="sm:col-span-4">
                        <label class="block text-[10px] font-black uppercase tracking-wider text-gray-600 mb-1.5 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px] text-tpm-orange">pin</span>
                            Quantité :
                        </label>
                        <input type="number" name="quantity" min="1" value="1" class="w-full text-xs font-bold text-center bg-slate-50 border border-gray-300 rounded-xl py-2.5 px-3 text-tpm-navy outline-none focus:ring-2 focus:ring-tpm-orange shadow-2xs"/>
                    </div>
                    <div class="sm:col-span-8">
                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>" class="w-full bg-gradient-to-r from-tpm-orange to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-black py-2.5 px-4 rounded-xl text-xs uppercase tracking-wider transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer active:scale-[0.99]">
                            <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                            <span>Ajouter au Panier Pro-Forma</span>
                        </button>
                    </div>
                </div>

            </form>

            <!-- 3. Pied du bloc : Normes, Assistance WhatsApp & Catalogue -->
            <div class="flex flex-wrap items-center justify-between gap-3 pt-3 text-[11px] text-gray-500 border-t border-gray-100">
                <div class="flex items-center gap-1.5 font-medium">
                    <span class="material-symbols-outlined text-[16px] text-[#154c9e]">verified</span>
                    <span>Conforme Norme Camerounaise (NC) &amp; ISO 9001:2015</span>
                </div>
                <div class="flex items-center gap-4 font-bold">
                    <a href="<?php echo esc_url($wa_url); ?>" target="_blank" class="text-emerald-700 hover:text-emerald-800 flex items-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[15px]">chat</span>
                        <span>Assistance WhatsApp</span>
                    </a>
                    <a href="javascript:void(0)" onclick="openCataloguePreview()" class="text-[#154c9e] hover:text-blue-800 flex items-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[15px]">visibility</span>
                        <span>Catalogue Complet</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- =================================================================== -->
    <!-- FICHE DESCRIPTIVE TECHNIQUE & COMMERCIALE                          -->
    <!-- PAGE 1 : DESCRIPTIF, POINTS FORTS, SPÉCIFICATIONS, GUIDE DE POSE   -->
    <!-- =================================================================== -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-md overflow-hidden text-gray-900 fiche-technique-page p-6 sm:p-8 space-y-6">

        <!-- 1. EN-TÊTE BLEU INDUSTRIEL AVEC LOGO & TITRE DE LA FICHE -->
        <div class="bg-gradient-to-r from-[#154c9e] to-[#0f3775] text-white p-5 sm:p-6 rounded-xl shadow-sm">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-white/20 pb-4 mb-4">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-amber-300 block mb-0.5">
                        TPM SA (GROUPE CAC) • USINES DE DOUALA (PK12 &amp; BEKOKO)
                    </span>
                    <h1 class="text-xl sm:text-2xl font-black tracking-tight leading-tight m-0 text-white">
                        <?php echo esc_html($fiche['header_title']); ?>
                    </h1>
                    <p class="text-xs sm:text-sm text-blue-100 font-medium mt-1 m-0">
                        <?php echo esc_html($fiche['header_subtitle']); ?>
                    </p>
                </div>
                <div class="text-right shrink-0 bg-white/10 px-3.5 py-2 rounded-lg border border-white/20">
                    <span class="text-[10px] uppercase font-bold text-blue-200 block">RÉFÉRENCE USINE</span>
                    <span class="text-sm font-black text-amber-300 font-mono"><?php echo esc_html($fiche['ref']); ?></span>
                </div>
            </div>
            <!-- BADGES / PILLS TECHNIQUES -->
            <div class="flex flex-wrap gap-2 pt-1">
                <?php foreach ($fiche['pills'] as $pill): ?>
                    <span class="bg-white/15 border border-white/25 text-white text-[10px] sm:text-[11px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md">
                        <?php echo esc_html($pill); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 2. DESCRIPTIF COMMERCIAL & TECHNIQUE -->
        <div class="bg-slate-50 border-l-4 border-tpm-orange p-4 sm:p-5 rounded-r-xl space-y-2">
            <div class="text-xs font-black text-tpm-navy uppercase tracking-wider flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px] text-tpm-orange">description</span>
                <span>Présentation &amp; Descriptif Industriel du Produit</span>
            </div>
            <p class="text-xs sm:text-sm text-gray-700 leading-relaxed m-0 font-normal">
                <?php echo esc_html($fiche['commercial_desc']); ?>
            </p>
        </div>

        <!-- 3. POINTS FORTS & AVANTAGES CLÉS (GRILLE 2x2) -->
        <div class="space-y-3">
            <div class="text-xs font-black text-[#154c9e] uppercase tracking-wider flex items-center gap-1.5 border-b border-gray-100 pb-2">
                <span class="material-symbols-outlined text-[18px] text-tpm-orange">star</span>
                <span>Points Forts &amp; Avantages Clés TPM SA</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                <?php foreach ($fiche['points_forts'] as $pf): ?>
                    <div class="bg-white border border-slate-200 rounded-xl p-3.5 sm:p-4 shadow-2xs hover:border-[#154c9e]/40 transition flex items-start gap-3">
                        <span class="material-symbols-outlined text-[24px] text-tpm-orange shrink-0 mt-0.5"><?php echo esc_attr($pf['icon']); ?></span>
                        <div class="space-y-0.5">
                            <h4 class="text-xs font-black text-tpm-navy m-0"><?php echo esc_html($pf['title']); ?></h4>
                            <p class="text-[11px] sm:text-xs text-gray-600 leading-normal m-0"><?php echo esc_html($pf['desc']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 4. SPÉCIFICATIONS & CARACTÉRISTIQUES TECHNIQUES COMPARATIVES -->
        <div class="space-y-3">
            <div class="text-xs font-black text-[#154c9e] uppercase tracking-wider flex items-center gap-1.5 border-b border-gray-100 pb-2">
                <span class="material-symbols-outlined text-[18px] text-tpm-orange">tune</span>
                <span>Spécifications &amp; Caractéristiques Techniques Certifiées</span>
            </div>
            <div class="overflow-x-auto rounded-xl border border-slate-200 shadow-2xs">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-slate-100 text-tpm-navy font-black border-b border-slate-200">
                            <?php foreach ($fiche['specs_table']['headers'] as $th): ?>
                                <th class="p-3 uppercase text-[11px] tracking-wider"><?php echo esc_html($th); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-gray-700">
                        <?php foreach ($fiche['specs_table']['rows'] as $rIdx => $row): ?>
                            <tr class="<?php echo ($rIdx % 2 === 0) ? 'bg-white' : 'bg-slate-50/50'; ?>">
                                <td class="p-3 font-bold text-gray-900"><?php echo esc_html($row['label']); ?></td>
                                <td class="p-3 font-semibold text-tpm-navy"><?php echo esc_html($row['bac']); ?></td>
                                <td class="p-3 text-gray-600"><?php echo esc_html($row['ondu']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 5. GUIDE DE MONTAGE & RECOMMANDATIONS DE POSE CHANTIER -->
        <div class="space-y-3">
            <div class="text-xs font-black text-[#154c9e] uppercase tracking-wider flex items-center gap-1.5 border-b border-gray-100 pb-2">
                <span class="material-symbols-outlined text-[18px] text-tpm-orange">construction</span>
                <span>Guide de Montage &amp; Recommandations d'Installation Professionnelle</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <?php foreach ($fiche['guide_pose'] as $gpIdx => $gp): ?>
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-3.5 space-y-1">
                        <div class="text-xs font-black text-tpm-navy flex items-center gap-1.5">
                            <span class="w-5 h-5 rounded-full bg-amber-100 text-amber-900 text-[10px] font-black flex items-center justify-center shrink-0">
                                <?php echo ($gpIdx + 1); ?>
                            </span>
                            <span><?php echo esc_html($gp['label']); ?></span>
                        </div>
                        <p class="text-[11px] sm:text-xs text-gray-600 leading-normal m-0 pl-6.5">
                            <?php echo esc_html($gp['text']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 6. LOGISTIQUE, STOCKAGE & GARANTIE USINE -->
        <div class="space-y-3 pt-1">
            <div class="text-xs font-black text-[#154c9e] uppercase tracking-wider flex items-center gap-1.5 border-b border-gray-100 pb-2">
                <span class="material-symbols-outlined text-[18px] text-tpm-orange">inventory_2</span>
                <span>Logistique, Stockage Chantier &amp; Garantie Usine</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3.5 space-y-1">
                    <span class="font-extrabold text-tpm-navy text-[11px] uppercase block">Conditions de Stockage :</span>
                    <p class="text-gray-600 m-0 leading-relaxed text-[11px]"><?php echo esc_html($fiche['stockage_info']['stockage']); ?></p>
                </div>
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3.5 space-y-1">
                    <span class="font-extrabold text-tpm-navy text-[11px] uppercase block">Manutention &amp; Transport :</span>
                    <p class="text-gray-600 m-0 leading-relaxed text-[11px]"><?php echo esc_html($fiche['stockage_info']['manutention']); ?></p>
                </div>
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3.5 space-y-1">
                    <span class="font-extrabold text-tpm-navy text-[11px] uppercase block">Garantie &amp; Conformité :</span>
                    <p class="text-gray-600 m-0 leading-relaxed text-[11px]"><?php echo esc_html($fiche['stockage_info']['garantie']); ?></p>
                </div>
            </div>
        </div>

        <!-- PIED DE PAGE : PAGE 1 / 2 -->
        <div class="pt-4 border-t border-slate-200 flex justify-between items-center text-[10px] text-gray-400 font-mono tracking-wide">
            <span>Fiche Technique Officielle TPM SA | Usines de Douala (Bekoko &amp; PK12)</span>
            <span>Page 1 / 2</span>
        </div>

    </div>

    <!-- =================================================================== -->
    <!-- PAGE 2 : CROQUIS TECHNIQUES COTÉS & PLANS DE DÉTAILS DÉDIÉS         -->
    <!-- =================================================================== -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-md overflow-hidden text-gray-900 fiche-technique-page p-6 sm:p-8 space-y-6">

        <!-- 1. EN-TÊTE BLEU DE LA PAGE 2 -->
        <div class="bg-[#154c9e] text-white p-4 sm:p-5 rounded-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest text-amber-300 block">DESSINS INDUSTRIELS &amp; COTATIONS NORMALISÉES</span>
                <h2 class="text-lg sm:text-xl font-black m-0 text-white"><?php echo esc_html($fiche['diagram_title']); ?></h2>
            </div>
            <div class="bg-white/10 px-3 py-1.5 rounded-lg border border-white/20 text-right">
                <span class="text-[9px] uppercase text-blue-200 block">DOCUMENTATION OFFICIELLE</span>
                <span class="text-xs font-bold text-amber-300 font-mono">Conforme Norme NC / ISO</span>
            </div>
        </div>

        <!-- 2. RENDU DU DESSIN VECTORIEL COTÉ SELON LE TYPE EXACT DE PRODUIT -->
        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 sm:p-6 space-y-6">

            <?php if ( strpos($fiche['diagram_type'], 'tole_') === 0 ): ?>
                <!-- ==================== CROQUIS TÔLES DE TOITURE ==================== -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                        <span class="text-xs font-black uppercase text-[#154c9e]">A. Profil en Coupe Transversale &amp; Cotes de Nervurage</span>
                        <span class="text-[11px] text-gray-500 font-mono">Épaisseur : <?php echo esc_html($fiche['epaisseur_val']); ?></span>
                    </div>

                    <?php if ( $fiche['diagram_type'] === 'tole_ondulee' ): ?>
                        <!-- Profil Ondulé 76/18 -->
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs overflow-x-auto">
                            <svg viewBox="0 0 800 130" class="w-full h-auto min-w-[600px] stroke-[#154c9e]" fill="none" stroke-width="3" stroke-linecap="round">
                                <path d="M 20,60 Q 40,25 65,60 T 110,60 Q 130,25 155,60 T 200,60 Q 220,25 245,60 T 290,60 Q 310,25 335,60 T 380,60 Q 400,25 425,60 T 470,60 Q 490,25 515,60 T 560,60 Q 580,25 605,60 T 650,60 Q 670,25 695,60 T 740,60 L 780,60" />
                                <line x1="200" y1="75" x2="290" y2="75" stroke="#ef4444" stroke-width="1.5" />
                                <text x="245" y="90" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Pas standard = 76 mm</text>
                                <line x1="605" y1="30" x2="605" y2="60" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="2,2" />
                                <text x="635" y="45" fill="#475569" font-size="10" font-weight="bold">H = 18 mm</text>
                                <line x1="20" y1="110" x2="780" y2="110" stroke="#64748b" stroke-width="1.5" />
                                <text x="400" y="105" fill="#475569" font-size="10" font-weight="bold" text-anchor="middle">Largeur utile : ~836 mm | Largeur totale : ~900 mm | Format 3,00 m</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'tole_d50' ): ?>
                        <!-- Profil Industriel D50 (Nervures 50 mm) -->
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs overflow-x-auto">
                            <svg viewBox="0 0 800 140" class="w-full h-auto min-w-[600px] stroke-[#154c9e]" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M 20,95 L 60,95 L 90,15 L 180,15 L 210,95 L 300,95 L 330,15 L 420,15 L 450,95 L 540,95 L 570,15 L 660,15 L 690,95 L 780,95" />
                                <line x1="180" y1="15" x2="180" y2="95" stroke="#ef4444" stroke-width="1.5" stroke-dasharray="3,3" />
                                <text x="195" y="60" fill="#dc2626" font-size="11" font-weight="bold">H = 50 mm</text>
                                <line x1="90" y1="10" x2="180" y2="10" stroke="#3b82f6" stroke-width="1.5" />
                                <text x="135" y="6" fill="#2563eb" font-size="10" font-weight="bold" text-anchor="middle">Sommet 90 mm</text>
                                <line x1="20" y1="120" x2="780" y2="120" stroke="#64748b" stroke-width="1.5" />
                                <text x="400" y="115" fill="#475569" font-size="11" font-weight="bold" text-anchor="middle">Largeur totale : ~920 mm (Utile : ~850 mm) | Portée pannes jusqu'à 1,50 m</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'tole_tuile' ): ?>
                        <!-- Profil Tuile Nervurale D50 -->
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs overflow-x-auto">
                            <svg viewBox="0 0 800 140" class="w-full h-auto min-w-[600px] stroke-[#154c9e]" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M 20,85 C 40,40 70,40 90,85 L 120,85 L 140,30 L 200,30 L 220,85 L 250,85 C 270,40 300,40 320,85 L 350,85 L 370,30 L 430,30 L 450,85 L 480,85 C 500,40 530,40 550,85 L 580,85 L 600,30 L 660,30 L 680,85 L 780,85" />
                                <line x1="140" y1="20" x2="200" y2="20" stroke="#ef4444" stroke-width="1.5" />
                                <text x="170" y="12" fill="#dc2626" font-size="10" font-weight="bold" text-anchor="middle">Onde Tuile Romane</text>
                                <line x1="20" y1="120" x2="780" y2="120" stroke="#64748b" stroke-width="1.5" />
                                <text x="400" y="115" fill="#475569" font-size="11" font-weight="bold" text-anchor="middle">Largeur totale : 1050 mm | Largeur utile : 950 mm | Pas de marche : 350 mm</text>
                            </svg>
                        </div>
                    <?php else: ?>
                        <!-- Profil Bac Trapézoïdal 4N / 5N -->
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs overflow-x-auto">
                            <svg viewBox="0 0 800 130" class="w-full h-auto min-w-[600px] stroke-[#154c9e]" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M 20,80 L 70,80 L 95,20 L 155,20 L 180,80 L 250,80 L 275,20 L 335,20 L 360,80 L 430,80 L 455,20 L 515,20 L 540,80 L 610,80 L 635,20 L 695,20 L 720,80 L 780,80" />
                                <line x1="165" y1="20" x2="165" y2="80" stroke="#ef4444" stroke-width="1.5" stroke-dasharray="3,3" />
                                <text x="175" y="55" fill="#dc2626" font-size="10" font-weight="bold">H = 28 mm</text>
                                <line x1="95" y1="15" x2="155" y2="15" stroke="#3b82f6" stroke-width="1.5" />
                                <text x="125" y="10" fill="#2563eb" font-size="10" font-weight="bold" text-anchor="middle">Sommet d'onde 60 mm</text>
                                <line x1="20" y1="110" x2="780" y2="110" stroke="#64748b" stroke-width="1.5" />
                                <text x="400" y="105" fill="#475569" font-size="11" font-weight="bold" text-anchor="middle">Largeur totale : ~1000 mm | Largeur utile : ~880-920 mm</text>
                            </svg>
                        </div>
                    <?php endif; ?>

                    <!-- Schéma de fixation sur charpente -->
                    <div class="space-y-2 pt-2">
                        <span class="text-xs font-black uppercase text-[#154c9e]">B. Principe de Fixation Étanche sur Panne de Charpente</span>
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs overflow-x-auto">
                            <svg viewBox="0 0 850 180" class="w-full h-auto min-w-[600px]">
                                <rect x="50" y="100" width="750" height="45" fill="#fef3c7" stroke="#d97706" stroke-width="2" rx="4" />
                                <text x="425" y="127" fill="#92400e" font-size="11" font-weight="900" text-anchor="middle">PANNE DE CHARPENTE (BOIS OU MÉTAL) — ENTRAXE 60 À 90 CM</text>
                                <path d="M 30,100 L 80,100 L 105,40 L 165,40 L 190,100 L 260,100 L 285,40 L 345,40 L 370,100 L 440,100 L 465,40 L 525,40 L 550,100 L 620,100 L 645,40 L 705,40 L 730,100 L 790,100" fill="none" stroke="#154c9e" stroke-width="3.5" stroke-linecap="round" />
                                <?php foreach ([135, 315, 495, 675] as $cx): ?>
                                    <path d="M <?php echo ($cx - 15); ?>,38 L <?php echo $cx; ?>,28 L <?php echo ($cx + 15); ?>,38 Z" fill="#1e3a8a" />
                                    <rect x="<?php echo ($cx - 4); ?>" y="12" width="8" height="16" fill="#0f172a" rx="1" />
                                    <line x1="<?php echo $cx; ?>" y1="40" x2="<?php echo $cx; ?>" y2="130" stroke="#0284c7" stroke-width="2.5" />
                                <?php endforeach; ?>
                                <text x="135" y="10" fill="#b91c1c" font-size="10" font-weight="bold" text-anchor="middle">Vis + Cavalier + Joint EPDM</text>
                            </svg>
                        </div>
                    </div>
                </div>

            <?php elseif ( strpos($fiche['diagram_type'], 'acc_') === 0 ): ?>
                <!-- ==================== CROQUIS ACCESSOIRES DE TOITURE ==================== -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                        <span class="text-xs font-black uppercase text-[#154c9e]">A. Vue Perspective &amp; Cotes de Pliage d'Usine</span>
                        <span class="text-[11px] text-gray-500 font-mono">Développé : 330 à 400 mm</span>
                    </div>

                    <?php if ( $fiche['diagram_type'] === 'acc_faitiere_centrale' ): ?>
                        <!-- Faîtière Centrale Bombée -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 600 200" class="w-full max-w-lg h-auto">
                                <path d="M 50,150 L 120,130 Q 300,50 480,130 L 550,150" fill="none" stroke="#154c9e" stroke-width="4" stroke-linecap="round" />
                                <circle cx="50" cy="150" r="4" fill="#ef4444" />
                                <circle cx="550" cy="150" r="4" fill="#ef4444" />
                                <line x1="120" y1="130" x2="480" y2="130" stroke="#94a3b8" stroke-dasharray="3,3" />
                                <text x="300" y="80" fill="#154c9e" font-size="12" font-weight="bold" text-anchor="middle">Bombage Central R=150 mm (Plat 80-100 mm)</text>
                                <line x1="50" y1="165" x2="550" y2="165" stroke="#ef4444" stroke-width="1.5" />
                                <text x="300" y="180" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Développé total : 330 mm / 350 mm | Ailes 130 mm</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'acc_faitiere_double' ): ?>
                        <!-- Faîtière Non Crantée Double Pente -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 600 200" class="w-full max-w-lg h-auto">
                                <path d="M 60,150 L 70,140 L 300,50 L 530,140 L 540,150" fill="none" stroke="#154c9e" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                <text x="300" y="40" fill="#154c9e" font-size="12" font-weight="900" text-anchor="middle">Angle de faîtage α = 120° (ajustable 100°-140°)</text>
                                <line x1="70" y1="140" x2="300" y2="50" stroke="#ef4444" stroke-width="1.5" />
                                <text x="170" y="85" fill="#dc2626" font-size="10" font-weight="bold" transform="rotate(-21 170 85)">Aile gauche 160 mm</text>
                                <line x1="300" y1="50" x2="530" y2="140" stroke="#ef4444" stroke-width="1.5" />
                                <text x="430" y="85" fill="#dc2626" font-size="10" font-weight="bold" transform="rotate(21 430 85)">Aile droite 160 mm</text>
                                <text x="300" y="180" fill="#475569" font-size="11" font-weight="bold" text-anchor="middle">Ourlets de rigidité anti-goutte 12 mm aux extrémités</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'acc_rive' ): ?>
                        <!-- Rive de Faîtage / Pignon -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 600 220" class="w-full max-w-lg h-auto">
                                <rect x="150" y="70" width="40" height="130" fill="#fef3c7" stroke="#d97706" stroke-width="2" rx="2" />
                                <text x="170" y="145" fill="#92400e" font-size="10" font-weight="bold" transform="rotate(90 170 145)" text-anchor="middle">Planche de rive</text>
                                <path d="M 130,200 L 140,70 L 450,70 L 460,80" fill="none" stroke="#154c9e" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                <line x1="120" y1="70" x2="120" y2="200" stroke="#ef4444" stroke-width="1.5" />
                                <text x="110" y="140" fill="#dc2626" font-size="10" font-weight="bold" transform="rotate(-90 110 140)" text-anchor="middle">Retombée 100-120 mm</text>
                                <line x1="140" y1="55" x2="450" y2="55" stroke="#ef4444" stroke-width="1.5" />
                                <text x="295" y="48" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Recouvrement toiture 140-160 mm</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'acc_gouttiere' ): ?>
                        <!-- Gouttière Aluminium -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 600 220" class="w-full max-w-lg h-auto">
                                <path d="M 120,60 L 120,120 Q 120,180 200,180 L 380,180 Q 460,180 460,120 L 460,70 C 460,50 485,50 485,70" fill="none" stroke="#154c9e" stroke-width="4" stroke-linecap="round" />
                                <circle cx="472" cy="60" r="10" fill="#dbeafe" stroke="#154c9e" stroke-width="2" />
                                <text x="472" y="40" fill="#154c9e" font-size="10" font-weight="bold" text-anchor="middle">Boudin Ø 16 mm</text>
                                <line x1="120" y1="195" x2="460" y2="195" stroke="#ef4444" stroke-width="1.5" />
                                <text x="290" y="210" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Développé 330 mm | Ouverture 125-140 mm | Profondeur 85 mm</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'acc_noue' ): ?>
                        <!-- Noue en V -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 600 200" class="w-full max-w-lg h-auto">
                                <path d="M 60,70 L 80,110 L 300,160 L 520,110 L 540,70" fill="none" stroke="#154c9e" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                <text x="300" y="135" fill="#154c9e" font-size="11" font-weight="bold" text-anchor="middle">Canal d'écoulement central V (Angle 130°)</text>
                                <line x1="60" y1="50" x2="540" y2="50" stroke="#ef4444" stroke-width="1.5" />
                                <text x="300" y="42" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Développé 330 à 400 mm | Relevés latéraux 30 mm</text>
                            </svg>
                        </div>
                    <?php else: ?>
                        <!-- Bande ourlée -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 600 200" class="w-full max-w-lg h-auto">
                                <path d="M 180,40 L 180,100 L 440,150 C 460,150 460,170 440,170" fill="none" stroke="#154c9e" stroke-width="4" stroke-linecap="round" />
                                <line x1="160" y1="40" x2="160" y2="100" stroke="#ef4444" stroke-width="1.5" />
                                <text x="150" y="75" fill="#dc2626" font-size="10" font-weight="bold" transform="rotate(-90 150 75)" text-anchor="middle">Relevé mural 70 mm</text>
                                <text x="320" y="115" fill="#154c9e" font-size="11" font-weight="bold" transform="rotate(11 320 115)">Bavette tombante 130 mm</text>
                                <text x="480" y="165" fill="#2563eb" font-size="10" font-weight="bold">Ourlet Ø 14 mm</text>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

            <?php elseif ( strpos($fiche['diagram_type'], 'fix_') === 0 ): ?>
                <!-- ==================== CROQUIS FIXATIONS ET ÉTANCHÉITÉ ==================== -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                        <span class="text-xs font-black uppercase text-[#154c9e]">A. Plan Technique d'Usinage &amp; Dimensions Mécaniques</span>
                        <span class="text-[11px] text-gray-500 font-mono">Conforme DIN / ISO</span>
                    </div>

                    <?php if ( strpos($fiche['diagram_type'], 'fix_vis') === 0 ): ?>
                        <!-- Vis Auto-foreuse -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 650 180" class="w-full max-w-xl h-auto">
                                <rect x="50" y="60" width="30" height="60" fill="#0f172a" rx="4" />
                                <circle cx="65" cy="90" r="10" fill="#3b82f6" />
                                <rect x="80" y="65" width="20" height="50" fill="#475569" />
                                <rect x="100" y="55" width="15" height="70" fill="#334155" rx="3" />
                                <text x="107" y="45" fill="#2563eb" font-size="10" font-weight="bold" text-anchor="middle">Rondelle EPDM Ø 16 mm</text>
                                <rect x="115" y="80" width="380" height="20" fill="#94a3b8" />
                                <?php for($i=130; $i<480; $i+=15): ?>
                                    <line x1="<?php echo $i; ?>" y1="75" x2="<?php echo ($i+8); ?>" y2="105" stroke="#475569" stroke-width="2.5" />
                                <?php endfor; ?>
                                <polygon points="495,80 550,90 495,100" fill="#64748b" />
                                <text x="525" y="70" fill="#dc2626" font-size="10" font-weight="bold">Pointe forêt #3</text>
                                <line x1="80" y1="140" x2="550" y2="140" stroke="#ef4444" stroke-width="1.5" />
                                <text x="315" y="155" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Longueur sous tête : <?php echo (strpos($fiche['diagram_type'], '70') !== false ? '70 mm' : '60 mm'); ?> | Filetage Ø 6,3 mm</text>
                            </svg>
                        </div>
                    <?php elseif ( strpos($fiche['diagram_type'], 'fix_tirefond') === 0 ): ?>
                        <!-- Tirefond à bois -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 650 180" class="w-full max-w-xl h-auto">
                                <rect x="50" y="60" width="35" height="60" fill="#1e293b" rx="4" />
                                <text x="67" y="50" fill="#2563eb" font-size="10" font-weight="bold" text-anchor="middle">Tête Hex 10 mm</text>
                                <rect x="85" y="78" width="120" height="24" fill="#94a3b8" />
                                <rect x="205" y="78" width="300" height="24" fill="#cbd5e1" />
                                <?php for($i=215; $i<490; $i+=20): ?>
                                    <line x1="<?php echo $i; ?>" y1="72" x2="<?php echo ($i+10); ?>" y2="108" stroke="#334155" stroke-width="3" />
                                <?php endfor; ?>
                                <polygon points="505,78 555,90 505,102" fill="#475569" />
                                <line x1="85" y1="140" x2="555" y2="140" stroke="#ef4444" stroke-width="1.5" />
                                <text x="320" y="155" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Longueur sous tête : <?php echo (strpos($fiche['diagram_type'], '80') !== false ? '80 mm' : '60 mm'); ?> | Filet bois Ø 6,0 mm</text>
                            </svg>
                        </div>
                    <?php elseif ( strpos($fiche['diagram_type'], 'fix_cavalier') === 0 ): ?>
                        <!-- Cavalier Alu -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 500 180" class="w-full max-w-md h-auto">
                                <path d="M 60,130 L 160,50 L 340,50 L 440,130 L 400,130 L 320,70 L 180,70 L 100,130 Z" fill="#2563eb" opacity="0.85" />
                                <ellipse cx="250" cy="50" rx="15" ry="6" fill="#0f172a" />
                                <text x="250" y="35" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Perçage central Ø 6,5 mm</text>
                                <line x1="60" y1="150" x2="440" y2="150" stroke="#ef4444" stroke-width="1.5" />
                                <text x="250" y="165" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Largeur de base 42 mm | Hauteur 28 mm | Épaisseur alu 1,2 mm</text>
                            </svg>
                        </div>
                    <?php elseif ( strpos($fiche['diagram_type'], 'fix_toiturole') === 0 ): ?>
                        <!-- Toiturole 900G -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 600 180" class="w-full max-w-lg h-auto">
                                <rect x="50" y="40" width="500" height="20" fill="#1e293b" rx="2" />
                                <text x="300" y="32" fill="#1e293b" font-size="10" font-weight="bold" text-anchor="middle">Couche de finition bitumineuse élastomère SBS</text>
                                <rect x="50" y="60" width="500" height="20" fill="#f59e0b" rx="1" />
                                <text x="300" y="75" fill="#78350f" font-size="11" font-weight="900" text-anchor="middle">ARMATURE NON-TISSÉE HAUTE TÉNACITÉ 900 G/M²</text>
                                <rect x="50" y="80" width="500" height="20" fill="#1e293b" rx="2" />
                                <text x="300" y="115" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Rouleau 10,00 m x 1,00 m | Épaisseur totale 2,5 mm</text>
                            </svg>
                        </div>
                    <?php else: ?>
                        <!-- Rondelles et Plaquettes -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 500 160" class="w-full max-w-md h-auto">
                                <circle cx="150" cy="80" r="50" fill="#334155" />
                                <circle cx="150" cy="80" r="15" fill="#ffffff" />
                                <text x="150" y="145" fill="#334155" font-size="10" font-weight="bold" text-anchor="middle">Rondelle Feutre Ø 25 mm</text>
                                <rect x="280" y="40" width="140" height="80" fill="#334155" rx="4" />
                                <circle cx="350" cy="80" r="15" fill="#ffffff" />
                                <text x="350" y="145" fill="#334155" font-size="10" font-weight="bold" text-anchor="middle">Plaquette Feutre 25 x 35 mm</text>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

            <?php elseif ( strpos($fiche['diagram_type'], 'douche_') === 0 ): ?>
                <!-- ==================== CROQUIS DOUCHES THÉRAPEUTIQUES ==================== -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                        <span class="text-xs font-black uppercase text-[#154c9e]">A. Vue Écorchée Industrielle &amp; Schéma de Raccordement</span>
                        <span class="text-[11px] text-gray-500 font-mono">Tension 220V | Sécurité IP24</span>
                    </div>

                    <?php if ( $fiche['diagram_type'] === 'douche_lorenzetti_advanced' ): ?>
                        <!-- Lorenzetti Advanced Blindé -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 650 240" class="w-full max-w-xl h-auto">
                                <path d="M 50,120 L 180,120 L 220,70 L 480,70 Q 580,70 580,140 Q 580,210 480,210 L 220,210 L 180,160 L 50,160 Z" fill="#f8fafc" stroke="#154c9e" stroke-width="3" />
                                <rect x="250" y="100" width="180" height="80" fill="#eff6ff" stroke="#3b82f6" stroke-width="2" rx="6" />
                                <text x="340" y="145" fill="#1e40af" font-size="11" font-weight="bold" text-anchor="middle">RÉSISTANCE BLINDÉE INOX</text>
                                <line x1="50" y1="140" x2="20" y2="140" stroke="#ef4444" stroke-width="3" />
                                <text x="35" y="125" fill="#dc2626" font-size="9" font-weight="bold">Arrivée 1/2"</text>
                                <line x1="500" y1="210" x2="500" y2="235" stroke="#64748b" stroke-width="2" />
                                <text x="500" y="235" fill="#475569" font-size="9" font-weight="bold" text-anchor="middle">Tige de commande</text>
                                <line x1="220" y1="50" x2="580" y2="50" stroke="#ef4444" stroke-width="1.5" />
                                <text x="400" y="42" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Longueur totale : 49,8 cm | Largeur diffuseur : 23,0 cm | H = 11,0 cm</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'douche_cardal_central' ): ?>
                        <!-- Cardal Centralisé -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 500 200" class="w-full max-w-md h-auto">
                                <rect x="150" y="30" width="200" height="140" fill="#f8fafc" stroke="#154c9e" stroke-width="3" rx="8" />
                                <circle cx="250" cy="80" r="25" fill="#3b82f6" opacity="0.2" />
                                <circle cx="250" cy="80" r="15" fill="#154c9e" />
                                <text x="250" y="125" fill="#154c9e" font-size="10" font-weight="bold" text-anchor="middle">Sélecteur Thermostatique</text>
                                <line x1="180" y1="170" x2="180" y2="195" stroke="#3b82f6" stroke-width="3" />
                                <text x="180" y="195" fill="#2563eb" font-size="9" font-weight="bold" text-anchor="middle">Eau Froide 1/2"</text>
                                <line x1="320" y1="170" x2="320" y2="195" stroke="#ef4444" stroke-width="3" />
                                <text x="320" y="195" fill="#dc2626" font-size="9" font-weight="bold" text-anchor="middle">Eau Chaude 1/2"</text>
                                <text x="250" y="20" fill="#475569" font-size="10" font-weight="bold" text-anchor="middle">Dimensions : H 180 mm x L 150 mm x P 120 mm</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'douche_duo_shower' ): ?>
                        <!-- Duo Shower Grand Modèle -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 600 220" class="w-full max-w-lg h-auto">
                                <rect x="50" y="80" width="180" height="30" fill="#cbd5e1" rx="4" />
                                <path d="M 230,95 L 380,95 L 450,50 L 520,50 L 520,70 L 450,70 L 380,115 L 230,115 Z" fill="#f8fafc" stroke="#154c9e" stroke-width="3" />
                                <ellipse cx="485" cy="60" rx="40" ry="12" fill="#3b82f6" opacity="0.3" />
                                <text x="485" y="40" fill="#154c9e" font-size="10" font-weight="bold" text-anchor="middle">Ciel de Pluie Ø 25 cm</text>
                                <path d="M 380,120 L 440,160" stroke="#ef4444" stroke-width="4" stroke-linecap="round" />
                                <text x="450" y="180" fill="#dc2626" font-size="10" font-weight="bold">Jet Directionnel Massant</text>
                                <text x="300" y="210" fill="#475569" font-size="10" font-weight="bold" text-anchor="middle">Système 2-en-1 | Bras d'extension 450 mm</text>
                            </svg>
                        </div>
                    <?php else: ?>
                        <!-- Maxi Ducha / Loren Shower / Zagonel -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 500 180" class="w-full max-w-md h-auto">
                                <path d="M 120,90 L 220,90 Q 340,30 400,90 Q 340,150 220,90 Z" fill="#f8fafc" stroke="#154c9e" stroke-width="3" />
                                <circle cx="320" cy="90" r="30" fill="#3b82f6" opacity="0.2" />
                                <text x="320" y="95" fill="#154c9e" font-size="11" font-weight="bold" text-anchor="middle">Chambre 3 Températures</text>
                                <line x1="80" y1="90" x2="120" y2="90" stroke="#ef4444" stroke-width="3" />
                                <text x="100" y="75" fill="#dc2626" font-size="9" font-weight="bold">Raccord 1/2"</text>
                                <text x="250" y="165" fill="#475569" font-size="10" font-weight="bold" text-anchor="middle">Dôme compact Ø 140 mm | Puissance 4600W - 5500W</text>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

            <?php elseif ( strpos($fiche['diagram_type'], 'carrelage_') === 0 ): ?>
                <!-- ==================== CROQUIS CARRELAGE SOLS & MURS ==================== -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                        <span class="text-xs font-black uppercase text-[#154c9e]">A. Plan Coté du Carreau &amp; Bords Rectifiés</span>
                        <span class="text-[11px] text-gray-500 font-mono">Grès Cérame 1er Choix (ISO 13006)</span>
                    </div>

                    <?php if ( $fiche['diagram_type'] === 'carrelage_parquet_15x80' ): ?>
                        <!-- Lame Parquet 15x80 -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 650 200" class="w-full max-w-xl h-auto">
                                <rect x="50" y="30" width="400" height="40" fill="#d97706" opacity="0.8" rx="2" />
                                <rect x="180" y="80" width="400" height="40" fill="#d97706" opacity="0.8" rx="2" />
                                <rect x="50" y="130" width="400" height="40" fill="#d97706" opacity="0.8" rx="2" />
                                <line x1="50" y1="20" x2="450" y2="20" stroke="#ef4444" stroke-width="1.5" />
                                <text x="250" y="15" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Longueur 800 mm (80 cm)</text>
                                <line x1="35" y1="30" x2="35" y2="70" stroke="#ef4444" stroke-width="1.5" />
                                <text x="25" y="55" fill="#dc2626" font-size="10" font-weight="bold" transform="rotate(-90 25 55)" text-anchor="middle">150 mm</text>
                                <text x="350" y="190" fill="#475569" font-size="10" font-weight="bold" text-anchor="middle">Calepinage conseillé : Pose décalée au tiers (1/3) | Épaisseur 9,0 mm</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'carrelage_xxl_60x120' ): ?>
                        <!-- Format XXL 60x120 -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 600 200" class="w-full max-w-lg h-auto">
                                <rect x="80" y="30" width="440" height="120" fill="#f8fafc" stroke="#154c9e" stroke-width="3" rx="2" />
                                <line x1="80" y1="18" x2="520" y2="18" stroke="#ef4444" stroke-width="1.5" />
                                <text x="300" y="12" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Longueur XXL : 1200 mm (1,20 m)</text>
                                <line x1="60" y1="30" x2="60" y2="150" stroke="#ef4444" stroke-width="1.5" />
                                <text x="50" y="95" fill="#dc2626" font-size="10" font-weight="bold" transform="rotate(-90 50 95)" text-anchor="middle">600 mm</text>
                                <text x="300" y="95" fill="#154c9e" font-size="12" font-weight="900" text-anchor="middle">BORDS RECTIFIÉS LASER 90° (Joint 1,5 à 2 mm)</text>
                                <text x="300" y="180" fill="#475569" font-size="10" font-weight="bold" text-anchor="middle">Épaisseur : 10,5 mm | Double encollage obligatoire</text>
                            </svg>
                        </div>
                    <?php elseif ( $fiche['diagram_type'] === 'carrelage_mur_25x40' ): ?>
                        <!-- Faïence Murale 25x40 -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 500 200" class="w-full max-w-md h-auto">
                                <rect x="120" y="30" width="260" height="130" fill="#f0fdf4" stroke="#16a34a" stroke-width="2.5" rx="3" />
                                <line x1="120" y1="18" x2="380" y2="18" stroke="#ef4444" stroke-width="1.5" />
                                <text x="250" y="12" fill="#dc2626" font-size="11" font-weight="bold" text-anchor="middle">Largeur 400 mm (40 cm)</text>
                                <line x1="100" y1="30" x2="100" y2="160" stroke="#ef4444" stroke-width="1.5" />
                                <text x="90" y="100" fill="#dc2626" font-size="10" font-weight="bold" transform="rotate(-90 90 100)" text-anchor="middle">250 mm</text>
                                <text x="250" y="100" fill="#15803d" font-size="11" font-weight="bold" text-anchor="middle">Émail Vitrifié Haute Brillance</text>
                                <text x="250" y="185" fill="#475569" font-size="10" font-weight="bold" text-anchor="middle">Épaisseur : 7,0 mm | Pâte céramique murale</text>
                            </svg>
                        </div>
                    <?php else: ?>
                        <!-- Carreaux Sol 60x60 / 40x40 / 30x30 -->
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                            <svg viewBox="0 0 500 200" class="w-full max-w-md h-auto">
                                <rect x="130" y="20" width="140" height="140" fill="#f8fafc" stroke="#154c9e" stroke-width="2.5" />
                                <rect x="280" y="20" width="140" height="140" fill="#f8fafc" stroke="#154c9e" stroke-width="2.5" />
                                <line x1="130" y1="175" x2="270" y2="175" stroke="#ef4444" stroke-width="1.5" />
                                <text x="200" y="190" fill="#dc2626" font-size="10" font-weight="bold" text-anchor="middle">Format Carré</text>
                                <text x="275" y="95" fill="#154c9e" font-size="11" font-weight="bold" text-anchor="middle">Joint 2-3 mm</text>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <!-- ==================== CROQUIS ÉPONGES & AUTRES ==================== -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                        <span class="text-xs font-black uppercase text-[#154c9e]">A. Microstructure &amp; Tressage Industriel</span>
                        <span class="text-[11px] text-gray-500 font-mono">100% Inox AISI 430</span>
                    </div>
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center">
                        <svg viewBox="0 0 500 160" class="w-full max-w-md h-auto">
                            <circle cx="250" cy="80" r="55" fill="#e2e8f0" stroke="#475569" stroke-width="3" />
                            <?php for($i=0; $i<360; $i+=45): ?>
                                <circle cx="<?php echo (250 + 25*cos(deg2rad($i))); ?>" cy="<?php echo (80 + 25*sin(deg2rad($i))); ?>" r="18" fill="none" stroke="#0284c7" stroke-width="2" />
                            <?php endfor; ?>
                            <text x="250" y="85" fill="#0f172a" font-size="11" font-weight="bold" text-anchor="middle">Fil Spiralé Inox</text>
                            <text x="250" y="150" fill="#475569" font-size="10" font-weight="bold" text-anchor="middle">Tressage anti-effilochage Ø 85 mm | Poids 40g - 50g</text>
                        </svg>
                    </div>
                </div>
            <?php endif; ?>

            <!-- 3. NUANCIER COULEURS RAL & FINITIONS DISPONIBLES -->
            <div class="space-y-3 pt-2">
                <div class="text-xs font-black uppercase tracking-wider text-[#154c9e] border-b border-slate-200 pb-1.5 flex items-center justify-between">
                    <span>Nuancier Officiel &amp; Finitions Industrielles Disponibles :</span>
                    <span class="text-[10px] text-gray-400 font-mono">Norme RAL &amp; Finitions Usine</span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-2.5 pt-1 text-center">
                    <?php foreach ($fiche['ral_swatches'] as $sw): ?>
                        <div class="flex flex-col items-center gap-1 bg-white p-2 rounded-xl border border-slate-200 shadow-2xs">
                            <div class="w-full h-12 sm:h-14 rounded-lg shadow-2xs border border-black/10 transition-transform hover:scale-105" style="background-color: <?php echo esc_attr($sw['hex']); ?>;"></div>
                            <div class="text-[10px] font-bold text-gray-800 leading-tight"><?php echo esc_html($sw['name']); ?></div>
                            <div class="text-[9px] text-gray-500 font-mono">(<?php echo esc_html($sw['ral']); ?>)</div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

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
        thumb.classList.add('border-tpm-orange');
    }
}
</script>