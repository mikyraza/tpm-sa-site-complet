<?php get_header(); ?>

<main class="flex-grow py-16">
    <div class="max-w-container-max mx-auto px-4 md:px-6">
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
