<?php get_header(); ?>
<section id="content" class="clearfix">
    <div id="inner-content">
        <main id="main" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php get_template_part('parts/loop', 'archive'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php get_template_part('parts/content', 'missing'); ?>
            <?php endif; ?>
        </main> <!-- end #main -->
    </div> <!-- end #inner-content -->
</section> <!-- end #content -->
<?php get_footer(); ?>