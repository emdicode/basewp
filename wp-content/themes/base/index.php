<?php get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            if (have_posts()):
                while (have_posts()):
                    the_post();

                    get_template_part('partials/content', get_post_type());
                endwhile;

                the_post_navigation();
            else:
                get_template_part('partials/content', 'none');
            endif;
            ?>
        </main>
    </div>
<?php
get_footer();
