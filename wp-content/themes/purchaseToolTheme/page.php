<?php get_header(); ?>
<div id="content" class="clearfix">
	<div id="inner-content">
		<?php if (has_post_thumbnail()) {
		        $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
		    }
		    ?>
		    <header class="article-header" style="background-image: url(<?php echo $src[0]; ?>);">
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
	</div>
	<main id="main" class="row">
		<div class="main-content columns large-9 medium-8">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		    	<section class="entry-content" itemprop="articleBody">
	                <?php the_content(); ?>
	            </section> <!-- end article section -->
		    <?php endwhile; endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</main> <!-- end #main -->
</div> <!-- end #content -->
<?php get_footer(); ?>