<?php
/**
 * Template Name: Home Page Template
 * 
 */
get_header(); ?>
<div id="content" class="clearfix">
	<div id="inner-content">
		<header class="homePageHeader">
			<h4><span class="orange">Bringing the</span> flavours of Canada <span class="orange">to India</span></h4>
			<p>The healthier alternative to sugar - 100% pure maple syrup</p>
		</header>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	    	<?php the_content(); ?>
	    <?php endwhile; endif; ?>
	</div>
	<main id="main" class="row">
		<div class="columns large-6 large-offset-3 medium-8 medium-offset-2 small-10 small-offset-1 wherToFindContainer">
			<div class="whereToFind">
				<img class="quote" src="http://test.the-practice.net/maple/wp-content/uploads/sites/8/2017/08/bubble.png"/>
				<img class="mapleBottle" src="http://test.the-practice.net/maple/wp-content/uploads/sites/8/2017/08/bottle.png" />
			</div>
			<h4 class="text-center">Maple Recipes</h4>
			<p>Whether it's for breakfast, lunch, dinner or dessert, maple syrup's versatality is loved by chefs and home cooks alike.</p>
		</div>
		<div class="columns large-6 medium-12 featuredRecipes">
			<h5>Featured Recipes</h5>
			<?php
				$fRecipes = new WP_Query(
					array(
						'posts_per_page' => 4,
                        'category' => 'recipes',
                        'tag' => 'featured',
                        'orderby' => 'date',
                        'order' => 'desc'
                        )
					);
				if($fRecipes -> have_posts()):while($fRecipes->have_posts()):$fRecipes->the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('columns large-6 medium-6 small-10 small-centered medium-uncentered'); ?> role="article">
			    		<?php get_template_part( 'parts/loop', 'grid' ); ?>
		    		</article> <!-- end article -->
					<?php
				endwhile; endif;
			?>
		</div>
		<div class="columns large-6 medium-12 featuredVideo">
			<h5>Featured Video</h5>
			<div class="columns medium-12"><img src="http://test.the-practice.net/maple/wp-content/uploads/sites/8/2017/08/nutritionist.jpg" class="fullWidth"/></div>
		</div>
	</main>
</div>
<?php get_footer(); ?>