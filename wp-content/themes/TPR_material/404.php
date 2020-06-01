<?php
/**
 * @package cdb
 */

get_header(); ?>
<!-- Page Title -->
<div class="page-title-container">
	<div class="col m12 center-align">
		<h1 class="page-title screen-reader-text"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'cdb' ); ?></h1>
	</div>
</div>
<!-- Page content -->
<div class="page-content">
	<div class="container">
<div class="row">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cdb' ); ?></p>
					<?php // the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( cdb_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h5 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'cdb' ); ?></h5>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>

					<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'cdb' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #row -->
</div><!-- .container -->
</div><!-- .page-content -->

<?php get_footer(); ?>
