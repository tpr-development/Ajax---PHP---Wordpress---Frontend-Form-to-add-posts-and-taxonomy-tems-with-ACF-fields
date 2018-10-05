<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cdb
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
    <ol>
		<?php
		$blogs = wp_get_sites();
		foreach ($blogs AS $blog) {
		echo "<li class='btn-link'><a href='http://".$blog["domain"].$blog["path"]."'>".get_blog_option( $blog[ 'blog_id' ], 'blogname' )."</a></li>";
		restore_current_blog();
		}
		?>
		</ol>
		
		
		
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'cdb' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

