<?php
/**
 * The template for displaying all single posts
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
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-10'); ?>>
                <header class="entry-header border-b border-gray-200 pb-6 mb-8">
                    <h1 class="entry-title text-2xl md:text-4xl font-extrabold text-tpm-navy"><?php the_title(); ?></h1>
                    <div class="text-xs text-gray-500 mt-2">
                        Publié le <?php echo get_the_date(); ?>
                    </div>
                </header>

                <div class="entry-content prose max-w-none text-gray-700 leading-relaxed space-y-4">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
