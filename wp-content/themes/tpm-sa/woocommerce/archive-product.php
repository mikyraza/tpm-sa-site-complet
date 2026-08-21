<?php
/**
 * woocommerce/archive-product.php
 * Faithful implementation of Design/tpm_sa_hub_catalogue_official_inventory/code.html
 */

defined( 'ABSPATH' ) || exit;

get_header();

$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/boutique/');
$cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/panier/');

$categories = get_terms([
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
]);
?>

<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- HEADER SHOP BANNER -->
        <div class="bg-tpm-navy text-white rounded-2xl p-8 md:p-12 shadow-xl border border-white/10 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="space-y-4 max-w-2xl">
                <div class="inline-flex items-center px-3.5 py-1 rounded-full bg-tpm-orange/20 border border-tpm-orange/40 text-tpm-orange font-bold text-xs uppercase tracking-widest">
                    Inventaire Officiel Usine TPM SA
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight uppercase">
                    Catalogue Général <span class="text-tpm-orange">2026</span>
                </h1>
                <p class="text-gray-300 text-sm md:text-base leading-relaxed">
                    "BÂTIMENTS SOLIDES = MATÉRIAUX SOLIDES AVEC GARANTIE DE DURABILITÉ"
                    <br/>Tarifs Usine HT/TTC en FCFA — Expédition depuis les usines de Douala PK12 &amp; Bekoko.
                </p>
            </div>
            <div class="shrink-0 flex flex-col gap-3 w-full md:w-auto">
                <a href="<?php echo esc_url($cart_url); ?>" class="custom-button-primary px-6 py-3.5 text-center text-xs uppercase tracking-wider font-extrabold shadow-lg flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                    Voir mon Devis Pro-Forma
                </a>
            </div>
        </div>

        <!-- CATEGORIES FILTER TABS -->
        <div class="flex items-center gap-3 overflow-x-auto pb-2 border-b border-gray-200">
            <a href="<?php echo esc_url($shop_url); ?>" class="px-5 py-2.5 rounded-lg text-xs font-extrabold uppercase whitespace-nowrap transition-colors <?php echo !is_product_category() ? 'bg-tpm-orange text-white shadow' : 'bg-white text-tpm-navy hover:bg-gray-100 border border-gray-200'; ?>">
                Tous les Articles (58)
            </a>
            <?php if ( ! empty($categories) && ! is_wp_error($categories) ): ?>
                <?php foreach ( $categories as $cat ): ?>
                    <?php if ($cat->slug === 'uncategorized' || $cat->slug === 'non-classe') continue; ?>
                    <a href="<?php echo esc_url( get_term_link($cat) ); ?>" class="px-5 py-2.5 rounded-lg text-xs font-extrabold uppercase whitespace-nowrap transition-colors <?php echo is_product_category($cat->slug) ? 'bg-tpm-orange text-white shadow' : 'bg-white text-tpm-navy hover:bg-gray-100 border border-gray-200'; ?>">
                        <?php echo esc_html($cat->name); ?> (<?php echo esc_html($cat->count); ?>)
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- PRODUCTS GRID -->
        <?php if ( woocommerce_product_loop() ) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php
                while ( have_posts() ) {
                    the_post();
                    wc_get_template_part( 'content', 'product' );
                }
                ?>
            </div>
            <div class="pt-8">
                <?php do_action( 'woocommerce_after_shop_loop' ); ?>
            </div>
        <?php else : ?>
            <div class="bg-white p-12 text-center rounded-xl border border-gray-200 space-y-4">
                <p class="text-lg font-bold text-tpm-navy">Aucun produit trouvé dans cette catégorie.</p>
                <a href="<?php echo esc_url($shop_url); ?>" class="inline-block bg-tpm-navy text-white px-6 py-3 rounded text-xs font-bold uppercase">Retour au Catalogue</a>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
