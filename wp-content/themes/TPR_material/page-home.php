<?php
/**
 * Template Name: Home Page
 *
 */
get_header();
?>
<!-- Page Title -->
<div class="page-title-container">
	<div class="col m12 center-align">
		<h1 class="page-title screen-reader-text"><?php the_title(); ?></h1>
	</div>
</div>
<!-- Page content -->
<div class="page-content">
	<div class="container">
<div class="row">
	<div id="primary" class="content-area col m12">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'page' );
				?>
        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>
			<?php endwhile; ?>
			<?php the_posts_navigation(); ?>

		<?php endif; ?>
    <?php
		// Get category List
		$table = '';
		$categories = get_categories( array(
		    'orderby' => 'name',
		    'order'   => 'ASC'
		) );
		$dataPoints = array();
		$dataPoints["cols"][] = array("label"=>"Category", "type" => "string");
		$dataPoints["cols"][] = array("label" => "Articles", "type" => "number");
		foreach ($categories as $category) {
			// get number of posts in each category
			if($category->slug != 'uncategorized'){
				$allPosts_args = array(
					'posts_per_page' => -1,
					'category_name' => $category->slug,
		    	'date_query' => array(
		        array(
		            'column' => 'post_date_gmt',
		            'after'  => '90 days ago',
		        ),
		    	),
		    );
				$allPosts = new WP_Query($allPosts_args);
				$count = $allPosts->post_count;
				$dataPoints["rows"][] = array("c"=> array(array("v"=>$category->name), array("v" => $count)));
			}
		}
		$var = JSON_encode($dataPoints);
    ?>
	</main><!-- #main -->
</div><!-- #primary -->
</div><!-- #row -->
	<div class="row">
		<div class="col m3 s6">
			<?php
				$date = date("Y/m/d"); // 2018/07/05/
				$url = site_url() . '/'.$date;
			?>
			<a class="card" href="<?php echo $url; ?>"><div class="card-content">Todays Articles</div></a>
		</div>
		<div class="col m3 s6">
			<a class="card" href="#"><div class="card-content">Weekly Reports</div></a>
		</div>
	</div>
</div><!-- .container -->
</div><!-- .page-content -->
<div class="homeChart">
	<div class="container">
		<div class="row">
			<h5>Number of Articles last 3 months</h5>
    	<div id="columnchart_material" style="width: 100%; height: 500px;"></div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
			google.charts.load('current', {packages: ['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawBasic);

			function drawBasic() {
				var data = new google.visualization.DataTable(<?php echo $var; ?>);
				var options = {
					// title: 'Population of Largest U.S. Cities',
					hAxis: {
						title: 'Number of Articles',
						minValue: 0
					},
					vAxis: {
						title: 'Categories'
					},
					legend: 'none',
					chartArea:{top:20,right:0,bottom:50},
					backgroundColor: { fill:'transparent' }
				};
				var chart = new google.visualization.BarChart(document.getElementById('columnchart_material'));
				chart.draw(data, options);
		}
    </script>
<?php get_footer(); ?>
