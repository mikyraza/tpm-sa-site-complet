<?php
/**
 * The template for displaying all pages
 *
 * @package TPM_SA
 */

get_header();
?>

<main id="primary" class="site-main flex-grow bg-slate-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php
                the_content();

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tpm-sa' ),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div>
            <?php
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
