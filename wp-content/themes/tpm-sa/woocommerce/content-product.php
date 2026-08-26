<?php
/**
 * woocommerce/content-product.php
 * Exact Industrial Product Card matching the official TPM SA design.
 */

defined( 'ABSPATH' ) || exit;

global $product;
if ( empty( $product ) || ! $product->is_visible() ) return;

$product_id  = $product->get_id();
$sku         = $product->get_sku() ?: ('TPM-' . strtoupper(substr(md5($product_id), 0, 6)));
$title       = $product->get_name();
$price_html  = $product->get_price_html();
$unit        = get_post_meta( $product_id, '_unit', true ) ?: 'mètre linéaire';
$img_url     = function_exists('tpm_get_product_image_url') ? tpm_get_product_image_url($product) : (wp_get_attachment_image_url( $product->get_image_id(), 'medium' ) ?: get_template_directory_uri() . '/assets/images/prod1_tole.jpg');
$permalink   = get_permalink();

// Short description / Excerpt
$short_desc = $product->get_short_description();
if ( empty( $short_desc ) ) {
    $short_desc = wp_strip_all_tags( $product->get_description() );
}
if ( empty( $short_desc ) ) {
    $short_desc = "Produit industriel conforme aux normes de résistance et de durabilité TPM SA. Disponible pour expédition immédiate.";
}
$short_desc = wp_trim_words( $short_desc, 14, '...' );

// Category tag
$terms = get_the_terms( $product_id, 'product_cat' );
$cat_name = 'Matériaux Industriels';
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    foreach ($terms as $t) {
        if ($t->slug !== 'uncategorized' && $t->slug !== 'non-classe') {
            $cat_name = $t->name;
            break;
        }
    }
}

// Dispo location logic
$name_lower = strtolower( $title );
$dispo = 'Usine Bekoko';
if ( str_contains( $name_lower, 'faîtière' ) || str_contains( $name_lower, 'vis' ) || str_contains( $name_lower, 'tirefond' ) || str_contains( $name_lower, 'joint' ) ) {
    $dispo = 'PK12 & Bekoko';
}
?>

<div <?php wc_product_class( 'bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between group hover:-translate-y-0.5', $product ); ?>>
    <div>
        <!-- Top Image Box with Floating Tags -->
        <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
            <a href="<?php echo esc_url($permalink); ?>" class="block w-full h-full">
                <img src="<?php echo esc_url($img_url); ?>" 
                     alt="<?php echo esc_attr($title); ?>" 
                     loading="lazy" 
                     decoding="async" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
            </a>
            
            <!-- Category Tag -->
            <span class="absolute top-2.5 left-2.5 bg-tpm-navy/95 backdrop-blur-sm text-white text-[9px] font-bold px-2 py-0.5 rounded shadow uppercase tracking-wide">
                <?php echo esc_html( wp_trim_words( $cat_name, 3, '' ) ); ?>
            </span>
            
            <!-- Stock Tag -->
            <span class="absolute top-2.5 right-2.5 bg-emerald-50 text-emerald-800 border border-emerald-200 text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                En Stock Usine
            </span>
        </div>

        <!-- Card Body -->
        <div class="p-5 space-y-3">
            <div class="font-mono text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                REF: <?php echo esc_html( $sku ); ?>
            </div>
            
            <h3 class="text-sm sm:text-base font-black text-tpm-navy leading-snug group-hover:text-tpm-orange transition-colors line-clamp-2">
                <a href="<?php echo esc_url($permalink); ?>">
                    <?php echo esc_html($title); ?>
                </a>
            </h3>

            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed font-normal">
                <?php echo esc_html($short_desc); ?>
            </p>

            <!-- Specs Box -->
            <div class="bg-slate-50 p-2.5 rounded-lg border border-gray-100 flex justify-between items-center text-[11px] font-semibold text-gray-600">
                <span>Dispo : <strong class="text-tpm-navy"><?php echo esc_html($dispo); ?></strong></span>
                <span class="text-tpm-orange">Tarif HT / <?php echo esc_html($unit); ?></span>
            </div>
        </div>
    </div>

    <!-- Price & Action Row -->
    <div class="p-4 sm:p-5 pt-0 border-t border-gray-100 flex items-center justify-between gap-2 mt-2 pt-3">
        <div class="min-w-0 flex-1 whitespace-nowrap">
            <div class="text-sm sm:text-base md:text-lg font-black text-tpm-orange whitespace-nowrap overflow-hidden text-ellipsis leading-tight tracking-tight">
                <?php echo $price_html; ?>
            </div>
            <span class="text-[9px] text-gray-400 block font-medium uppercase tracking-wider mt-0.5 whitespace-nowrap">+ TVA 19.25%</span>
        </div>
        
        <a href="?add-to-cart=<?php echo esc_attr($product_id); ?>" 
           class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold px-2.5 sm:px-3 py-1.5 sm:py-2 rounded-lg text-[11px] sm:text-xs flex items-center gap-1 shadow transition-colors uppercase tracking-wider shrink-0 whitespace-nowrap">
            <span class="material-symbols-outlined text-[14px]">add</span>
            <span>+ Pro-Forma</span>
        </a>
    </div>
</div>
