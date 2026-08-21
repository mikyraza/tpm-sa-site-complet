<?php
/**
 * woocommerce/archive-product.php
 * Modern High-Density Industrial B2B Catalog Template
 */

defined( 'ABSPATH' ) || exit;

get_header();

$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
$cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');

$total_products = wp_count_posts('product')->publish ?? 58;

$categories = get_terms([
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
]);

$current_cat_name = is_product_category() ? single_term_title('', false) : 'Tous les Articles';
?>

<main id="primary" class="site-main flex-grow bg-slate-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-10 space-y-8">
            
            <!-- HEADER -->
            <header class="entry-header border-b border-gray-200 pb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="entry-title text-2xl md:text-3xl font-extrabold text-tpm-navy uppercase tracking-tight">
                        <?php echo is_product_category() ? esc_html($current_cat_name) : 'Catalogue Général (58 Articles)'; ?>
                    </h1>
                    <p class="text-xs md:text-sm text-gray-500 mt-1 font-medium">
                        Tarifs Usine HT/TTC en FCFA — Expédition depuis les usines de Douala PK12 &amp; Bekoko.
                    </p>
                </div>
                <div class="shrink-0">
                    <a href="<?php echo esc_url($cart_url); ?>" class="custom-button-primary px-5 py-2.5 rounded-lg text-xs uppercase font-extrabold shadow flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                        Mon Devis Pro-Forma
                    </a>
                </div>
            </header>

            <!-- CATEGORIES FILTER TABS -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-gray-100">
                <a href="<?php echo esc_url($shop_url); ?>" class="px-4 py-2 rounded-lg text-xs font-extrabold uppercase whitespace-nowrap transition-colors <?php echo !is_product_category() ? 'bg-tpm-orange text-white shadow' : 'bg-slate-100 text-tpm-navy hover:bg-slate-200'; ?>">
                    Tous les Articles (<?php echo esc_html($total_products); ?>)
                </a>
                <?php if ( ! empty($categories) && ! is_wp_error($categories) ): ?>
                    <?php foreach ( $categories as $cat ): ?>
                        <?php if ($cat->slug === 'uncategorized' || $cat->slug === 'non-classe') continue; ?>
                        <a href="<?php echo esc_url( get_term_link($cat) ); ?>" class="px-4 py-2 rounded-lg text-xs font-extrabold uppercase whitespace-nowrap transition-colors <?php echo is_product_category($cat->slug) ? 'bg-tpm-orange text-white shadow' : 'bg-slate-100 text-tpm-navy hover:bg-slate-200'; ?>">
                            <?php echo esc_html($cat->name); ?> (<?php echo esc_html($cat->count); ?>)
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- PRODUCTS GRID -->
            <?php if ( woocommerce_product_loop() ) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 pt-2">
                    <?php
                    while ( have_posts() ) {
                        the_post();
                        wc_get_template_part( 'content', 'product' );
                    }
                    ?>
                </div>

                <!-- PAGINATION -->
                <div class="pt-6 flex justify-center">
                    <?php do_action( 'woocommerce_after_shop_loop' ); ?>
                </div>
            <?php else : ?>
                <div class="bg-slate-50 p-12 text-center rounded-xl border border-gray-200 space-y-4">
                    <p class="text-lg font-bold text-tpm-navy">Aucun produit trouvé dans cette catégorie.</p>
                    <a href="<?php echo esc_url($shop_url); ?>" class="inline-block bg-tpm-navy text-white px-6 py-2.5 rounded text-xs font-bold uppercase">
                        Retour au Catalogue
                    </a>
                </div>
            <?php endif; ?>

        </article>
    </div>
</main>

<?php get_footer(); ?>

