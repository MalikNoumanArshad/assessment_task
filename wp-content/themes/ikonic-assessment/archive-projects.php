<?php
/**
 * Template Name: Projects Archive
 * Description: Template for displaying the archive of the "Projects" custom post type.
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type'      => 'projects',
            'posts_per_page' => 6,
            'paged'          => $paged
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
            // pagination code
            the_posts_pagination(array(
                'prev_text'          => __('Previous', 'ikonic-test'),
                'next_text'          => __('Next', 'ikonic-test'),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'ikonic-test') . ' </span>',
            ));
            //for reser post data
            wp_reset_postdata();
        else :
            echo __('No projects found', 'textdomain');
        endif;
        ?>
    </main>
</div>

<?php get_footer(); ?>
