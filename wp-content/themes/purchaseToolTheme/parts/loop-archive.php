<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix columns large-4 medium-6 small-12'); ?> role="article">
    <?php
    if (has_post_thumbnail()) {
        $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium', false);
    } else {
        $src[0] = "/wp-content/themes/default/image/default-image.png";
    }
    ?><a href="<?php the_permalink() ?>"><div class="article-featured-image" style="background-image: url(<?php echo $src[0]; ?>)"></div></a>
    <header class="article-header">
        <h3><a class="archive_post_title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
        <?php get_template_part('parts/content', 'byline'); ?>
    </header> <!-- end article header -->

    <section class="entry-content" itemprop="articleBody">
        <?php the_excerpt(); ?>
    </section>  <!-- end article section--> 

    <footer class="article-footer">
        <p class="byline">
            <?php the_tags('<span class="tag">', '</span><span class="tag">', '</span>'); ?>
        </p>
    </footer> <!-- end article footer -->				    						
</article> <!-- end article -->