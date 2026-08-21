<?php get_header(); ?>

<main class="flex-grow py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        else :
            echo '<p class="text-center text-gray-500 py-12">Aucun contenu trouvé.</p>';
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
