<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
    <?php if (has_post_thumbnail()) {
        $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
    }
    ?>
    <header class="article-header" style="background-color: #ccc; padding: 2rem 0;">
        <div class="row">
            <div class="columns large-12">
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                        <?php if(function_exists('bcn_display'))
                        {
                            bcn_display();
                        }?>
                    </div>
                <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
                <?php // get_template_part('parts/content', 'byline'); ?>
            </div>
        </div>
    </header> <!-- end article header -->
    <main id="main" role="main">
        <div class="row">
            <div class="columns large-9 medium-8">
                <img class="" src="<?php echo $src[0]; ?>"/>
                <section class="entry-content" itemprop="articleBody">
                    <?php the_content(); ?>
                </section> <!-- end article section -->
            </div>
            <?php get_sidebar(); ?><!-- end sidebar -->
        </div>
    </main> <!-- end #main -->
</article> <!-- end article -->