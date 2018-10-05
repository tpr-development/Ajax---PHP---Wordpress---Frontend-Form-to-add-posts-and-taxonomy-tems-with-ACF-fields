<?php get_header(); ?>
			
	<div id="content">

		<div id="inner-content" class="row">
	
			<main id="main" class="large-8 medium-8 columns search" role="main">
				<header>
					<h1 class="page-title"><?php echo $wp_query->found_posts; ?> <?php _e( 'Search Results For', 'locale' ); ?>: <?php the_search_query(); ?></h1>
				</header>
				<div class="clearfix list-view">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			 <!-- <div class="columns large-12 medium-12 small-12 list-view search-results"> -->
					<!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'listArchive' ); ?>
                         <!-- </div> -->
				<?php endwhile; ?>	
			</div>
					<div class="page_navigation clearfix">
                <div class="previous navigation"><?php previous_posts_link('Previous'); ?></div><!-- %title -->
                <div class="next navigation"><?php next_posts_link('Next', ''); ?></div><!-- %title -->
<!-- In post navigation, if the last parameter is set to 'true', then it will traverse in the same category, if we remove it, it will navigate through all category -->
            </div>
					
				<?php else : ?>
				
					<?php get_template_part( 'parts/content', 'missing' ); ?>
						
			    <?php endif; ?>
	
		    </main> <!-- end #main -->
		
		    <?php get_sidebar(); ?>
		
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
