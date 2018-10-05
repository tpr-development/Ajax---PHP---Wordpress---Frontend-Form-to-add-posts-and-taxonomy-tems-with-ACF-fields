<?php
/**
 * Template Name: Weekly Report
 *
 */
get_header();
?>
<!-- Page Title -->
<div class="page-title-container">
	<div class="col m12 center-align">
		<h1 class="page-title screen-reader-text">Fortnightly Analysis and Activity Report: <?php the_title(); ?></h1>
	</div>
</div>
<!-- Page content -->
<div class="page-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col m12">
				<main id="main" class="site-main" role="main">
					<?php
					if ( have_posts() ) : while ( have_posts() ) : the_post();
							echo '<div class="sectionTitle">Food for thought</div>';
							echo '<div class="foodforthought">'; the_content(); echo '</div>';
							/***** Getting the values of custom field ****/
							$fort_night_template = ''; $key_article_template = '';
							// Get fort night posts
							if(get_field('fort_night')): while(has_sub_field('fort_night')):
								$technology_articles = get_sub_field('technology_articles');
								if($technology_articles):
									$fort_night_template = $fort_night_template . '<div class="subSection row technology"><div class="subSectionTitle col m12">Technology</div>';
									foreach($technology_articles as $eachArticle){
										$fort_night_template = $fort_night_template . '<div class="col s12 m6"><div class="card"><div class="card-content"><span class="card-title">'.$eachArticle->post_title.'</span><p>'.$eachArticle->post_content.'</p></div></div></div>';
										// end of technology relation field
									}
									$fort_night_template = $fort_night_template . '</div>';
							// end of technology articles
							endif;
							$environment_articles = get_sub_field('environment_articles');
							if($environment_articles):
								$fort_night_template = $fort_night_template . '<div class="subSection row environment"><div class="subSectionTitle col m12">Environment</div>';
								foreach($environment_articles as $eachArticle){
									$fort_night_template = $fort_night_template . '<div class="col s12 m6"><div class="card"><div class="card-content"><span class="card-title">'.$eachArticle->post_title.'</span><p>'.$eachArticle->post_content.'</p></div></div></div>';
									// end of environment relation field
								}
								$fort_night_template = $fort_night_template . '</div>';
							// end of environment articles
							endif;
							$regulatory_articles = get_sub_field('regulatory_articles');
							if($regulatory_articles):
								$fort_night_template = $fort_night_template . '<div class="subSection row regulatory"><div class="subSectionTitle col m12">Regulatory</div>';
								foreach($regulatory_articles as $eachArticle){
									$fort_night_template = $fort_night_template . '<div class="col s12 m6"><div class="card"><div class="card-content"><span class="card-title">'.$eachArticle->post_title.'</span><p>'.$eachArticle->post_content.'</p></div></div></div>';
									// end of regulatory relation field
								}
								$fort_night_template = $fort_night_template . '</div>';
							// end of regulatory articles
							endif;
							$monetary_articles = get_sub_field('monetary_articles');
							if($monetary_articles):
								$fort_night_template = $fort_night_template . '<div class="subSection row monetary"><div class="subSectionTitle col m12">Monetary</div>';
								foreach($monetary_articles as $eachArticle){
									$fort_night_template = $fort_night_template . '<div class="col s12 m6"><div class="card"><div class="card-content"><span class="card-title">'.$eachArticle->post_title.'</span><p>'.$eachArticle->post_content.'</p></div></div></div>';
									// end of monetary relation field
								}
								$fort_night_template = $fort_night_template . '</div>';
							// end of monetary articles
							endif;
					// end of fort_night repeater field
							endwhile; wp_reset_postdata(); endif;
							// ***** Key Articles *****
							// $dataPoints is being used in bar graph
							$dataPoints = array();
							$dataPoints["cols"][] = array("label"=>"Article", "type" => "string");
							$dataPoints["cols"][] = array("label" => "Reach", "type" => "number");
							$dataPoints["cols"][] = array("label" => "Engagement", "type" => "number");
							// $dataSpots is being used in bubble graph
							$dataSpots = array();
							$dataSpots["cols"][] = array("label"=>"ID", "type" => "string");
							$dataSpots["cols"][] = array("label" => "Reach", "type" => "number");
							$dataSpots["cols"][] = array("label" => "Article", "type" => "number");
							$dataSpots["cols"][] = array("label"=>"Name", "type"=>"string");
							$dataSpots["cols"][] = array("label" => "Engagement", "type" => "number");
							// $dataDots is being used in the scatter chart
							$dataDots = array();
							$dataDots["cols"][] = array("label" => "Reach", "type" => "number");
							$dataDots["cols"][] = array("label" => "Engagement", "type" => "number");
							$dataDots["cols"][] = array("type" => "string", "role" => "tooltip", 'p'=> array('html'=> true));

							if(have_rows('key_article_section')): while(have_rows('key_article_section')): the_row();
										$key_articles = get_sub_field('key_articles');
										if($key_articles):
											foreach($key_articles as $key_article){
												$key_article_template = $key_article_template . '<tr><td><span class="top">Article '.get_row_index().'</span><br/>'.$key_article->post_title.'<br/><span class="date">'.get_the_time('F j, Y').'</span></td></tr>';
											}
										endif;
										$engagement = get_sub_field('engageent');
										$reach = get_sub_field('reach');
										$name = $key_article->post_title.'<br/><b>Reach:</b> '.$reach.'<br/><b>Engagement:</b> '.$engagement;
										$dataPoints["rows"][] = array("c"=> array(array("v"=>"Article".get_row_index()), array("v" => $reach), array("v" => $engagement)));
										$dataSpots["rows"][] = array("c"=> array(array("v"=>""), array("v" => $reach), array("v" => get_row_index()), array("v"=>$key_article->post_title), array("v" => $engagement)));
										$dataDots["rows"][] = array("c"=> array(array("v" => $reach), array("v" => $engagement), array("v" => $name)));
							endwhile; endif;
					/**** End of page query loop ****/
						endwhile;
					endif;
					$var = json_encode($dataPoints);
					$var2 = json_encode($dataSpots);
					$var3 = json_encode($dataDots);
					?>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- #row -->
	</div>
</div>
<!-- fortnight articles -->
<div class="fortnight-articles">
	<div class="container">
		<div class="row">
			<div class="col m12">
				<div class="sectionTitle">Fortnight</div>
			</div>
		</div>
		<div>
			<?php
				echo $fort_night_template;
			?>
		</div>
	</div>
</div>
<!-- Dashboard -->
<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col m12">
				<div class="sectionTitle">Dashboard</div>
			</div>
			<div class="col m3 list-key-articles">
				<table>
					<tbody><?php echo $key_article_template; ?></tbody>
				</table>
			</div>
			<div class="col m9 graphContainer">
				<!-- <div id="bubbleChart" class="chart" style="height: 500px;"></div> -->
				<div id="barChart" class="chart" style="height: 500px;"></div>
				<!-- <div id="scatterChart" class="chart" style="height: 500px;"></div> -->
			</div>
		</div>
	</div>
</div>
<!-- Stakeholder of the fortnight -->
<div class="stakeholders-fortnight">
	<div class="container">
		<div class="row">
			<div class="col m12">
				<div class="sectionTitle">Stakeholders of the Fortnight</div>
			</div>
			<?php if(have_rows('stakeholder_profiles')): while(have_rows('stakeholder_profiles')): the_row(); ?>
				<div class="col m4">
					<div class="stakeholder">
		        <div class="image">
							<?php $profile_img = get_sub_field('image'); ?>
		          <img src="<?php echo $profile_img['url']; ?>"/>
		        </div>
		        <div class="story">
		          <h5 class="card-title"><?php the_sub_field('name'); ?></h5>
		          <p><?php the_sub_field('bio'); ?></p>
		        </div>
						<div class="action">
		          <a data-target="popup-<?php echo get_row_index(); ?>" class="btn-flat modal-trigger grey lighten-3">View Report</a>
		        </div>
						<div id="popup-<?php echo get_row_index(); ?>" class="modal modal-fixed-footer"><!-- Image popup -->
					    <div class="modal-content">
								<?php $impact_img = get_sub_field('graph'); ?>
					      <img src="<?php echo $impact_img['url']; ?>" class="responsive-img"/>
					    </div>
					    <div class="modal-footer">
					      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
					    </div>
					  </div>
		      </div>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>
<!-- Featured Story -->
<div class="featured-story">
	<div class="container">
		<div class="row">
			<div class="col m12">
				<div class="sectionTitle">Featured Story</div>
			</div>
			<div class="col m6 image">
				<?php $impactAssesmentImage = get_field('impact_assesment_-_image'); ?>
				<img src="<?php echo $impactAssesmentImage['url']; ?>" class="responsive-img"/>
			</div>
			<div class="col m6 story">
				<h5><?php the_field('impact_assesment_title'); ?></h5>
				<p><?php the_field('impact_assesment_-_content'); ?></p>
			</div>
		</div>
	</div>
</div>
<!-- Contributor Story -->
<div class="contributor-story">
	<div class="container">
		<div class="row valign-wrapper">
			<div class="col m3 image center-align">
				<?php $contributorImage = get_field('contributor_-_image'); ?>
				<img src="<?php echo $contributorImage['url'] ?>" />
			</div>
			<div class="col m9 story">
				<div class="sectionTitle">Contributor Story</div>
				<p><?php the_field('contributor_-_description'); ?></p>
				<h5><?php the_field('contributor_-_title'); ?></h5>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- code for bar graph -->
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = new google.visualization.DataTable(<?php echo $var; ?>);
    var options = {
      bars: 'vertical', // Required for Material Bar Charts.
			colors: ['#d95f02', '#F8B600'],
			backgroundColor: { fill:'transparent' }
    };

    var chart = new google.charts.Bar(document.getElementById('barChart'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
<!-- code for bubble chart -->
<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawSeriesChart);

	function drawSeriesChart() {

		var data = new google.visualization.DataTable(<?php echo $var2; ?>);

		var options = {
		// title: 'Correlation between life expectancy, fertility rate ' +
					 // 'and population of some world countries (2010)',
		hAxis: {title: 'Reach'},
		vAxis: {title: 'Articles', textPosition: 'none'},
		bubble: {textStyle: {color: "transparent", fontSize: 11}},
		// tooltip: {isHtml: true},
		legend: 'none',
		backgroundColor: { fill:'transparent' }
		};

	var chart = new google.visualization.BubbleChart(document.getElementById('bubbleChart'));
	chart.draw(data, options);
	}
</script>
<!-- Code for Scatter chart -->
<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = new google.visualization.DataTable(<?php echo $var3; ?>);
		var options = {
			pointSize: 20,
			lagend: 'none',
			hAxis: {title: 'Reach'},
			vAxis: {title: 'Engagement'},
			tooltip: {isHtml: true},
			backgroundColor: { fill:'transparent' }
		};

		var chart = new google.visualization.ScatterChart(document.getElementById('scatterChart'));

		chart.draw(data, options);
	}
</script>

<?php get_footer(); ?>
