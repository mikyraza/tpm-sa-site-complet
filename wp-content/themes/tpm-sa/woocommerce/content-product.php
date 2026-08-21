<?php
/**
 * woocommerce/content-product.php
 * High-Density Industrial Product Card
 */

defined( 'ABSPATH' ) || exit;

global $product;
if ( empty( $product ) || ! $product->is_visible() ) return;

$product_id  = $product->get_id();
$sku         = $product->get_sku();
$title       = $product->get_name();
$price_html  = $product->get_price_html();
$unit        = get_post_meta( $product_id, '_unit', true ) ?: 'unité';
$img_url     = function_exists('tpm_get_product_image_url') ? tpm_get_product_image_url($product) : (wp_get_attachment_image_url( $product->get_image_id(), 'medium' ) ?: get_template_directory_uri() . '/assets/images/prod1_tole.jpg');
$permalink   = get_permalink();

$terms = get_the_terms( $product_id, 'product_cat' );
$cat_name = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : 'Matériaux';
?>

<div <?php wc_product_class( 'group bg-white border border-gray-200/90 hover:border-tpm-orange/60 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative', $product ); ?>>
    <div>
        <!-- Image & Floating Badges -->
        <div class="aspect-[4/3] relative overflow-hidden bg-gradient-to-b from-slate-50 to-slate-100/60 border-b border-gray-100 flex items-center justify-center p-3">
            <a href="<?php echo esc_url($permalink); ?>" class="w-full h-full block">
                <img src="<?php echo esc_url($img_url); ?>" 
                     alt="<?php echo esc_attr($title); ?>" 
                     class="w-full h-full object-cover rounded-lg group-hover:scale-105 transition-transform duration-500"/>
            </a>
            
            <!-- Floating SKU Tag -->
            <?php if ($sku): ?>
                <span class="absolute top-2.5 left-2.5 bg-tpm-navy/90 backdrop-blur-sm text-white font-mono text-[9px] font-bold px-2 py-0.5 rounded shadow">
                    <?php echo esc_html($sku); ?>
                </span>
            <?php endif; ?>

            <!-- Stock Tag -->
            <span class="absolute top-2.5 right-2.5 bg-white/90 backdrop-blur-sm text-emerald-800 border border-emerald-200 font-bold text-[9px] px-2 py-0.5 rounded-full flex items-center gap-1 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Stock Usine
            </span>
        </div>

        <!-- Product Details -->
        <div class="p-4 space-y-2">
            <span class="text-[10px] uppercase font-bold text-tpm-orange tracking-wider block">
                <?php echo esc_html($cat_name); ?>
            </span>
            
            <h3 class="font-extrabold text-tpm-navy text-sm sm:text-base leading-snug group-hover:text-tpm-orange transition-colors line-clamp-2">
                <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
            </h3>

            <div class="inline-flex items-center gap-1 text-[11px] font-semibold text-gray-500 bg-slate-100 px-2 py-0.5 rounded">
                <span class="material-symbols-outlined text-[13px] text-gray-400">straighten</span>
                <span>Tarif par <?php echo esc_html($unit); ?></span>
            </div>
        </div>
    </div>

    <!-- Pricing & Action Buttons -->
    <div class="p-4 pt-0 space-y-3">
        <div class="flex items-baseline justify-between border-t border-gray-100 pt-3">
            <div class="text-base sm:text-lg font-black text-tpm-orange">
                <?php echo $price_html; ?>
            </div>
            <span class="text-[9px] font-bold text-emerald-800 bg-emerald-50 border border-emerald-200/60 px-1.5 py-0.5 rounded">
                + TVA 19.25%
            </span>
        </div>

        <div class="grid grid-cols-2 gap-2 pt-1">
            <a href="<?php echo esc_url($permalink); ?>" 
               class="bg-slate-100 hover:bg-slate-200 text-tpm-navy font-bold py-2 text-center rounded-lg text-xs transition-colors flex items-center justify-center gap-1">
                <span class="material-symbols-outlined text-[15px]">visibility</span>
                Détails
            </a>
            <a href="?add-to-cart=<?php echo esc_attr($product_id); ?>" 
               class="bg-tpm-orange hover:bg-orange-700 text-white font-extrabold py-2 text-center rounded-lg text-xs transition-colors uppercase tracking-wider flex items-center justify-center gap-1 shadow-sm hover:shadow">
                <span class="material-symbols-outlined text-[15px]">add</span>
                Pro-Forma
            </a>
        </div>
    </div>
</div>
