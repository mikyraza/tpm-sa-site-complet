<?php
/**
 * woocommerce/content-product.php
 * Product card in loops
 */

defined( 'ABSPATH' ) || exit;

global $product;
if ( empty( $product ) || ! $product->is_visible() ) return;

$product_id  = $product->get_id();
$sku         = $product->get_sku();
$title       = $product->get_name();
$price_html  = $product->get_price_html();
$unit        = get_post_meta( $product_id, '_unit', true ) ?: 'unité';
$img_url     = wp_get_attachment_image_url( $product->get_image_id(), 'medium' ) ?: get_template_directory_uri() . '/assets/images/prod1_tole.jpg';
$permalink   = get_permalink();
?>

<div <?php wc_product_class( 'group bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col justify-between', $product ); ?>>
    <div>
        <!-- Image & Badge -->
        <div class="aspect-square relative overflow-hidden bg-slate-100 border-b border-gray-100">
            <a href="<?php echo esc_url($permalink); ?>">
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
            </a>
            <?php if ($sku): ?>
                <span class="absolute top-3 left-3 bg-tpm-navy/90 text-white font-mono text-[10px] font-bold px-2 py-0.5 rounded shadow">
                    <?php echo esc_html($sku); ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Details -->
        <div class="p-5 space-y-2">
            <h3 class="font-extrabold text-tpm-navy text-base group-hover:text-tpm-orange transition-colors line-clamp-2">
                <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
            </h3>
            <p class="text-xs text-gray-500 font-medium">Prix par <?php echo esc_html($unit); ?></p>
        </div>
    </div>

    <!-- Bottom Actions -->
    <div class="p-5 pt-0 space-y-3">
        <div class="flex items-baseline justify-between border-t border-gray-100 pt-3">
            <span class="text-lg font-black text-tpm-orange"><?php echo $price_html; ?></span>
            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded">+ TVA 19.25%</span>
        </div>

        <div class="grid grid-cols-2 gap-2 pt-1">
            <a href="<?php echo esc_url($permalink); ?>" class="bg-slate-100 hover:bg-slate-200 text-tpm-navy font-bold py-2 text-center rounded text-xs transition-colors">
                Détails
            </a>
            <a href="?add-to-cart=<?php echo esc_attr($product_id); ?>" class="bg-tpm-orange hover:bg-orange-700 text-white font-bold py-2 text-center rounded text-xs transition-colors uppercase tracking-wider flex items-center justify-center gap-1">
                + Pro-Forma
            </a>
        </div>
    </div>
</div>
