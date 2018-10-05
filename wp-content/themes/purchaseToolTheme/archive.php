<?php get_header(); ?>
<!-- Archive for list view -->
<div id="content">
    <div id="inner-content">
        <header class="category-header" style="background-color: #ccc; padding: 2rem 0; background-image: url(<?php
            if (function_exists('z_taxonomy_image_url'))
                { 
                    echo z_taxonomy_image_url();
                }
            ?>)">
            <div class="row">
                <div class="columns large-12">
                    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                        <?php if(function_exists('bcn_display'))
                        {
                            bcn_display();
                        }?>
                    </div>
                    <h1 class="page-title small-centered"><?php the_archive_title(); ?></h1>
                </div>
            </div>
        </header>
    </div>
    <main id="main" class="row" role="main">
        <div class="columns large-9">
        <?php if (have_posts()) : ?>
            <div class="row">
                <?php while (have_posts()) : the_post();?>
                <div class="columns large-12 list">
                    <?php get_template_part('parts/loop', 'listArchive'); ?>
                </div>
                <?php endwhile;
                ?>
            </div>
        <div class="page_navigation clearfix">
            <div class="previous navigation"><?php previous_posts_link('Previous'); ?></div>
            <div class="next navigation"><?php next_posts_link('Next', ''); ?></div> 
<!-- In post navigation, if the last parameter is set to 'true', then it will traverse in the same category, if we remove it, it will navigate through all category -->
        </div>
        <?php else : ?>
            <?php get_template_part('parts/content', 'missing'); ?>
        <?php endif; ?>
        </div>
    </main> <!-- end #main -->
</div> <!-- end #content -->
<?php get_footer(); ?>