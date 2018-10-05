<?php get_header(); ?>
<!-- Archive for list view -->
<div id="content">
    <div id="inner-content">
        <header class="category-header" style="background-image: url(<?php
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
    <main id="main" class="row">
    	<?php get_template_part('parts/filter', 'recipes'); ?>
        <div class="large-9 medium-12 columns response" role="main" data-equalizer="grid-4" data-equalize-on="medium">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('columns large-4 medium-6 small-10 small-centered medium-uncentered'); ?> role="article">
		    		<?php get_template_part( 'parts/loop', 'grid' ); ?>
	    		</article> <!-- end article -->
		    <?php endwhile; ?>
            <div class="page_navigation clearfix">
                <div class="previous navigation"><?php previous_posts_link('Previous'); ?></div>
                <div class="next navigation"><?php next_posts_link('Next', ''); ?></div>
    <!-- In post navigation, if the last parameter is set to 'true', then it will traverse in the same category, if we remove it, it will navigate through all category -->
            </div>
        </div>
    </main> <!-- end #main -->
        <?php else : ?>
            <?php get_template_part('parts/content', 'missing'); ?>
        <?php endif; ?>
        <div class="featuredChefContainer">
            <div class="row">
                <div class="columns medium-12"><h4 class="widgetTitle">Featured <span class="orange">Chefs</span></h4></div>
            </div>
            <div class="manishMehrotraContainer">
                <div class="row" data-equalizer="manish">
                    <?php $mm_recipes = new WP_Query( array(
                        'posts_per_page' => 2,
                        'category' => 'recipes',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'chef',
                                'field'    => 'slug',
                                'terms'    => 'manish-mehrotra',
                            ),
                        ),
                        'orderby' => 'date',
                        'order' => 'desc'

                    ));
                    if( $mm_recipes -> have_posts()) : while ($mm_recipes -> have_posts()) : $mm_recipes -> the_post();
                        ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class('columns large-3 medium-6 small-10 small-centered medium-uncentered'); ?> role="article" data-equalizer-watch="manish">
                            <?php get_template_part( 'parts/loop', 'grid' ); ?>
                        </div> <!-- end article -->
                        <?php
                    endwhile;
                    endif;
                    wp_reset_query();
                    ?>
                    <div class="columns large-3 medium-6 small-10 small-centered medium-uncentered quote text-center" data-equalizer-watch="manish">
                        <h5>Manish Mehrotra</h5>
                        <p><strong>"Pure maple syrup from Canada blends easily with Indian cuisin,</strong>without overpowering the flavours of other spices."</p>
                    </div>
                    <div class="columns large-3 medium-6 small-10 small-centered medium-uncentered" data-equalizer-watch="manish">
                        <img src="http://test.the-practice.net/maple/wp-content/uploads/sites/8/2017/08/home-manish-mehrotra.png" />
                    </div>
                </div>
            </div>
            <div class="vickyRatnaniContainer">
                <div class="row" data-equalizer="vicky">
                    <div class="columns large-3 medium-6 small-10 small-centered medium-uncentered" data-equalizer-watch="vicky">
                        <img src="http://test.the-practice.net/maple/wp-content/uploads/sites/8/2017/08/home-vicky-ratnani.png" />
                    </div>
                    <div class="columns large-3 medium-6 small-10 small-centered medium-uncentered quote text-center" data-equalizer-watch="vicky">
                        <h5>Vicky Ratnani</h5>
                        <p><strong>"Pure maple syrup from Canada blends easily with Indian cuisin,</strong>without overpowering the flavours of other spices."</p>
                    </div>
                    <?php $mm_recipes = new WP_Query( array(
                        'posts_per_page' => 2,
                        'category' => 'recipes',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'chef',
                                'field'    => 'slug',
                                'terms'    => 'vicky-ratnani',
                            ),
                        ),
                        'orderby' => 'date',
                        'order' => 'desc'

                    ));
                    if( $mm_recipes -> have_posts()) : while ($mm_recipes -> have_posts()) : $mm_recipes -> the_post();
                        ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class('columns large-3 medium-6 small-10 small-centered medium-uncentered'); ?> role="article" data-equalizer-watch="vicky">
                            <?php get_template_part( 'parts/loop', 'grid' ); ?>
                        </div> <!-- end article -->
                        <?php
                    endwhile; endif;
                    wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
</div> <!-- end #content -->
<?php get_footer(); ?>