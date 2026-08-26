<?php
/**
 * woocommerce/content-single-product.php
 * Template Produit Individuel TPM SA - Catalogue Industriel Certifié
 */

defined( 'ABSPATH' ) || exit;

global $product;
if ( ! $product ) return;

$product_id   = $product->get_id();
$sku          = $product->get_sku() ?: ('TPM-' . $product_id);
$title        = $product->get_name();
$price_html   = $product->get_price_html();
$unit         = get_post_meta( $product_id, '_unit', true ) ?: 'unité';
$colors_meta  = get_post_meta( $product_id, '_colors', true ) ?: '';
$img_url      = function_exists('tpm_get_product_image_url') ? tpm_get_product_image_url($product) : (wp_get_attachment_image_url( $product->get_image_id(), 'full' ) ?: get_template_directory_uri() . '/assets/images/prod1_tole.jpg');
$cart_url     = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');

// Dynamic specifications & options for this specific product
$flash_details = function_exists('tpm_get_product_flash_details') ? tpm_get_product_flash_details($product) : [
    'length_label' => 'LONGUEUR / FORMAT',
    'color_label'  => 'COULEUR / FINITION',
    'lengths'      => ['Standard Usine'],
    'colors'       => ['Standard Usine'],
    'unit'         => $unit
];

// Official Catalogue PDF technical details
$pdf_details = function_exists('tpm_get_product_pdf_catalog_details') ? tpm_get_product_pdf_catalog_details($product) : [
    'sku'        => $sku,
    'pole_title' => 'PÔLE INDUSTRIEL TPM SA',
    'pole_desc'  => 'Fabrication industrielle de tôles, pliages et matériaux de construction aux normes camerounaises.',
    'spec'       => 'Conforme au Cahier des Charges Usine TPM SA',
    'app'        => 'Bâtiments industriels, toitures résidentielles et chantiers BTP.',
    'garantie'   => '"BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ"',
    'desc'       => $product->get_description() ?: $product->get_short_description(),
    'stock'      => 'Disponible en Stock Usine (Bekoko & Douala PK12) — Enlèvement Ex-Works immédiat',
    'pdf_url'    => content_url('/uploads/catalogue-general-tpm-sa-2026.pdf'),
    'unit'       => $unit
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

do_action( 'woocommerce_before_single_product' );
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'max-w-container-max mx-auto px-4 md:px-8 py-8 space-y-12', $product ); ?>>

    <!-- 1. BREADCRUMB & STOCK STATUS -->
    <div class="bg-slate-100 border border-gray-200 px-6 py-4 rounded-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <nav class="text-sm text-gray-600 flex items-center gap-2 flex-wrap font-medium">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-tpm-orange transition-colors">Accueil</a>
            <span>></span>
            <a href="<?php echo esc_url( wc_get_page_permalink('shop') ); ?>" class="hover:text-tpm-orange transition-colors">Catalogue Usine</a>
            <span>></span>
            <span class="font-bold text-tpm-navy"><?php echo esc_html($title); ?></span>
        </nav>
        <div class="bg-emerald-50 text-emerald-800 border border-emerald-200 px-4 py-1.5 rounded text-xs font-bold flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Disponible en Stock Usine (Bekoko &amp; Douala PK12)
        </div>
    </div>

    <!-- 2. MAIN HERO PRODUCT SECTION -->
    <section class="bg-white border border-gray-200 rounded-xl overflow-hidden flex flex-col lg:flex-row shadow-sm">
        
        <!-- Gallery: ONLY images related to this product -->
        <div class="lg:w-1/2 p-6 md:p-8 border-b lg:border-b-0 lg:border-r border-gray-200 flex flex-col gap-4 bg-slate-50 justify-center">
            <div class="aspect-[4/3] w-full bg-white border border-gray-200 rounded-lg overflow-hidden flex items-center justify-center shadow-inner relative group">
                <img id="main-product-image" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-contain p-2 transition-all duration-300"/>
                <div class="absolute top-3 left-3 bg-tpm-navy/80 text-white text-[10px] uppercase font-mono px-2 py-0.5 rounded backdrop-blur">
                    Réf: <?php echo esc_html($sku); ?>
                </div>
            </div>

            <?php if ( count( $item_images ) > 1 ) : ?>
                <!-- Thumbnails: only rendered when multiple photos of this product exist -->
                <div class="grid grid-cols-4 gap-3 pt-2">
                    <?php foreach ( $item_images as $index => $thumb_url ) : ?>
                        <div class="aspect-square bg-white border-2 <?php echo ($index === 0) ? 'border-tpm-orange' : 'border-gray-200 opacity-70 hover:opacity-100'; ?> rounded-lg overflow-hidden cursor-pointer transition-all p-1 product-thumb"
                             onclick="changeProductImage('<?php echo esc_url($thumb_url); ?>', this)">
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($title); ?> - Vue <?php echo $index + 1; ?>" class="w-full h-full object-cover rounded"/>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Details & Form -->
        <div class="lg:w-1/2 p-6 md:p-8 flex flex-col justify-between">
            <div>
                <!-- Category Pole & SKU Badges -->
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="bg-tpm-navy text-white text-[10px] font-extrabold uppercase px-2.5 py-1 rounded tracking-wider">
                        <?php echo esc_html($pdf_details['pole_title']); ?>
                    </span>
                    <span class="text-xs font-bold text-gray-500 tracking-wider uppercase">
                        Réf: <span class="text-tpm-orange font-mono font-extrabold"><?php echo esc_html($sku); ?></span>
                    </span>
                    <span class="text-[11px] text-gray-400 font-medium">| Norme NC ISO 9001:2015</span>
                </div>

                <h1 class="text-2xl md:text-3xl font-extrabold text-tpm-navy mb-3"><?php echo esc_html($title); ?></h1>
                
                <!-- Price HT & Unit -->
                <div class="flex items-baseline gap-3 mb-6 bg-slate-50 p-4 rounded-lg border border-gray-200">
                    <span class="text-3xl font-black text-tpm-orange"><?php echo $price_html; ?></span>
                    <span class="text-xs font-bold text-gray-500 uppercase">HT / <?php echo esc_html($unit); ?></span>
                    <span class="text-xs font-semibold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded ml-auto">+ TVA (19.25%)</span>
                </div>

                <!-- Product Description from Catalog PDF / DB -->
                <div class="text-sm text-gray-600 mb-6 leading-relaxed space-y-2">
                    <p class="font-medium text-gray-800">
                        <?php echo esc_html($pdf_details['desc']); ?>
                    </p>
                    <p class="text-xs text-gray-500 italic bg-amber-50/70 border-l-2 border-amber-400 p-2 rounded-r">
                        <strong>Spécification Usine :</strong> <?php echo esc_html($pdf_details['spec']); ?>
                    </p>
                </div>

                <!-- Product Form (Add to Pro-Forma) -->
                <form id="single-product-flash-form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' class="space-y-4">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- List Box 2: Dynamic Format / Longueur -->
                        <div>
                            <label class="block text-xs font-extrabold text-tpm-navy mb-1 uppercase tracking-wide">
                                <?php echo esc_html($flash_details['length_label']); ?>
                            </label>
                            <select name="flash_length" class="w-full bg-slate-50 border border-gray-300 rounded-lg p-2.5 text-xs font-bold text-tpm-navy outline-none focus:ring-2 focus:ring-tpm-orange transition cursor-pointer">
                                <?php foreach ($flash_details['lengths'] as $len_opt): ?>
                                    <option value="<?php echo esc_attr($len_opt); ?>"><?php echo esc_html($len_opt); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- List Box 3: Dynamic Couleur / Finition -->
                        <div>
                            <label class="block text-xs font-extrabold text-tpm-navy mb-1 uppercase tracking-wide">
                                <?php echo esc_html($flash_details['color_label']); ?>
                            </label>
                            <select name="flash_color" class="w-full bg-slate-50 border border-gray-300 rounded-lg p-2.5 text-xs font-bold text-tpm-navy outline-none focus:ring-2 focus:ring-tpm-orange transition cursor-pointer">
                                <?php foreach ($flash_details['colors'] as $col_opt): ?>
                                    <option value="<?php echo esc_attr($col_opt); ?>"><?php echo esc_html($col_opt); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Quantity Input -->
                    <div>
                        <label class="block text-xs font-extrabold text-tpm-navy mb-1 uppercase tracking-wide">
                            Quantité (en <?php echo esc_html($unit); ?>)
                        </label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="quantity" min="1" value="1" class="w-28 bg-slate-50 border border-gray-300 rounded-lg p-2.5 text-xs font-mono font-bold text-tpm-navy outline-none focus:ring-2 focus:ring-tpm-orange"/>
                            <span class="text-xs text-gray-500 font-semibold uppercase"><?php echo esc_html($unit); ?></span>
                        </div>
                    </div>

                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="w-full bg-tpm-orange hover:bg-orange-700 text-white font-extrabold py-4 px-6 rounded-lg transition-all shadow-lg flex items-center justify-center gap-2 uppercase tracking-wider text-sm">
                        <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                        Ajouter à ma Facture Pro-Forma
                    </button>
                </form>
            </div>

            <!-- WhatsApp Direct Order Button & PDF Download -->
            <?php
            $phone = '237696340008';
            $msg   = rawurlencode( "Bonjour TPM SA, je souhaite commander le produit : {$title} (Réf: {$sku})." );
            $wa_url = "https://wa.me/{$phone}?text={$msg}";
            ?>
            <div class="mt-6 pt-4 border-t border-gray-200 flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url($wa_url); ?>" target="_blank" class="flex-1 bg-[#25D366] hover:bg-[#1ebd59] text-white font-bold py-3.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2 text-xs uppercase tracking-wider shadow">
                    <span class="material-symbols-outlined text-[18px]">chat</span>
                    Commander via WhatsApp
                </a>
                <a href="<?php echo esc_url($pdf_details['pdf_url']); ?>" target="_blank" download="Catalogue_General_TPM_SA_2026.pdf" class="bg-slate-100 hover:bg-slate-200 text-tpm-navy border border-gray-300 font-bold py-3.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2 text-xs uppercase tracking-wider shadow-sm">
                    <span class="material-symbols-outlined text-[18px] text-tpm-orange">picture_as_pdf</span>
                    Fiche Catalogue (PDF)
                </a>
            </div>

        </div>
    </section>

    <!-- 3. FICHE TECHNIQUE ISSUE DU CATALOGUE OFFICIEL (PDF 2026) -->
    <section class="space-y-6">
        <div class="flex items-center justify-between flex-wrap gap-4 border-b-2 border-tpm-orange pb-3">
            <div>
                <span class="text-xs font-extrabold uppercase text-tpm-orange tracking-wider">Catalogue Officiel TPM SA — Édition 2026</span>
                <h2 class="text-xl md:text-2xl font-extrabold text-tpm-navy">Caractéristiques Techniques &amp; Données Certifiées Usine</h2>
            </div>
            <a href="<?php echo esc_url($pdf_details['pdf_url']); ?>" target="_blank" download="Catalogue_General_TPM_SA_2026.pdf" class="inline-flex items-center gap-2 text-xs font-bold text-tpm-navy bg-amber-100 hover:bg-amber-200 border border-amber-300 px-4 py-2 rounded-lg transition">
                <span class="material-symbols-outlined text-[16px] text-amber-800">download</span>
                Télécharger le Catalogue Complet (PDF)
            </a>
        </div>

        <!-- Description du Pôle Industriel extrait du PDF -->
        <div class="bg-blue-50/60 border border-blue-200 rounded-xl p-5">
            <h3 class="text-xs font-black text-blue-900 uppercase tracking-wider mb-1">
                Extrait du Catalogue Général TPM SA (<?php echo esc_html($pdf_details['pole_title']); ?>) :
            </h3>
            <p class="text-sm text-blue-950 leading-relaxed font-medium">
                « <?php echo esc_html($pdf_details['pole_desc']); ?> »
            </p>
        </div>

        <!-- Tableau des Caractéristiques Certifiées du Catalogue PDF -->
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse text-sm">
                <tbody>
                    <tr class="border-b border-gray-100 bg-slate-50">
                        <th class="py-3.5 px-6 font-bold text-tpm-navy w-1/3">Référence Catalogue (SKU)</th>
                        <td class="py-3.5 px-6 font-mono text-tpm-orange font-bold text-base"><?php echo esc_html($sku); ?></td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <th class="py-3.5 px-6 font-bold text-tpm-navy">Désignation Officielle</th>
                        <td class="py-3.5 px-6 font-bold text-gray-900"><?php echo esc_html($title); ?></td>
                    </tr>
                    <tr class="border-b border-gray-100 bg-slate-50">
                        <th class="py-3.5 px-6 font-bold text-tpm-navy">Spécification Technique &amp; Matière</th>
                        <td class="py-3.5 px-6 text-gray-800 font-semibold"><?php echo esc_html($pdf_details['spec']); ?></td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <th class="py-3.5 px-6 font-bold text-tpm-navy">Domaines d'Application Recommandés</th>
                        <td class="py-3.5 px-6 text-gray-700"><?php echo esc_html($pdf_details['app']); ?></td>
                    </tr>
                    <tr class="border-b border-gray-100 bg-slate-50">
                        <th class="py-3.5 px-6 font-bold text-tpm-navy">Unité &amp; Conditionnement Usine</th>
                        <td class="py-3.5 px-6 text-gray-800 font-medium capitalize"><?php echo esc_html($unit); ?> (Tarifs dégressifs par volume sur Pro-Forma)</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <th class="py-3.5 px-6 font-bold text-tpm-navy">Disponibilité &amp; Lieux de Retrait</th>
                        <td class="py-3.5 px-6 text-gray-700">
                            <span class="inline-flex items-center gap-1.5 font-bold text-emerald-700">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <?php echo esc_html($pdf_details['stock']); ?>
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-100 bg-slate-50">
                        <th class="py-3.5 px-6 font-bold text-tpm-navy">Normes de Fabrication &amp; Traitement</th>
                        <td class="py-3.5 px-6 text-gray-700">
                            Norme Camerounaise (NC) &amp; ISO 9001:2015 • Traitement anti-corrosion marine et tropicale humide (PK12 / Bekoko)
                        </td>
                    </tr>
                    <tr>
                        <th class="py-3.5 px-6 font-bold text-tpm-navy">Engagement Qualité &amp; Garantie</th>
                        <td class="py-3.5 px-6 font-bold text-tpm-navy">
                            <?php echo esc_html($pdf_details['garantie']); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

</div>

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
