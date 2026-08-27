<?php
/**
 * woocommerce/single-product.php - TPM SA Theme
 * Fiche Technique Officielle de Produit
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header( 'shop' ); ?>

<main id="primary" class="site-main flex-grow bg-slate-100/60 py-6 sm:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <?php wc_get_template_part( 'content', 'single-product' ); ?>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer( 'shop' );
