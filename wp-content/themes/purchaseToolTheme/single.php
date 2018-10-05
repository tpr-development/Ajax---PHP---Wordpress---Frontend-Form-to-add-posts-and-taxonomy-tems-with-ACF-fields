<?php get_header(); ?>		
<div id="content">
	<div id="inner-content">
	    <?php
	    if (have_posts()) : while (have_posts()) : the_post(); 
	    		get_template_part( 'parts/loop', 'single' );
    		endwhile; ?>
    		<div class="row">
    			<div class="page_navigation clearfix">
	                <div class="previous navigation"><?php previous_post_link('%link', 'Previous', TRUE); ?></div><!-- %title -->
	                <div class="next navigation"><?php next_post_link('%link', 'Next', TRUE); ?></div><!-- %title -->
	            </div>
    		</div>
	    <?php else : ?>
	   		<?php get_template_part( 'parts/content', 'missing' ); ?>
	    <?php endif; ?>
	</div> <!-- end #inner-content -->
</div> <!-- end #content -->
<?php get_footer(); ?>