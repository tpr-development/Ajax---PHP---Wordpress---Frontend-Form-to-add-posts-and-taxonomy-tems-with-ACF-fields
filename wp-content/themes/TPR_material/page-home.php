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
		<h3 class="page-title screen-reader-text"><?php the_title(); ?></h3>
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
		<ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_list</i> Advanced Filter</div>
    <?php
		// Check user role
		$user = wp_get_current_user();
		$user_role = $user->roles[0]; // Current Usr Role
		$user_id = $user->ID;
		if($user_role == 'author'){ // Condition for employees
			$prs_arg = array(
				'post_status'=>'publish',
				'author' => $user_id
			);
		} else if($user_role == 'contributor'){ // condition for Vertical heads
			$prs_arg = array(
				'post_status'=>'publish',
				'meta_query' => array(
					array(
						'key'     => 'need_approval_from',
						'value'   => $user_id,
						'compare' => '=',
					),
				),
			);
		} else if($user_role == 'editor'){ // Condition for Finance head
			$prs_arg = array('post_status'=>'publish');
		} else { // Condition for administrator
			$prs_arg = array('post_status'=>'publish');
		}
		?>
				<div class="collapsible-body filterFor-<?php echo $user_role; ?>">
					<div class="row">
						<div class="col m3 verticalFilter">
							<div class="input-field col s12">
								<select id="selectVerticalFilter" class="singleSelect">
									<option value="all" disabled selected>Choose your option</option>
							<?php $verticals = get_terms('vertical');
							foreach($verticals as $vertical){
								?>
								<option value="<?php echo $vertical->slug; ?>"><?php echo $vertical->name; ?></option>
								<?php
							} ?>
								</select>
								<label>Select Vertical</label>
							</div>
						</div>
						<div class="col m3 clientFilter">
							<div class="input-field col s12">
								<select id="selectClientFilter" class="singleSelect">
									<option value="all" disabled selected>Choose your option</option>
							<?php $clients = get_terms('client');
							foreach($clients as $client){
								?>
								<option value="<?php echo $client->slug; ?>"><?php echo $client->name; ?></option>
								<?php
							} ?>
								</select>
								<label>Select Client</label>
							</div>
						</div>
						<div class="col m3 vendorFilter">
							<div class="input-field col s12">
								<select id="selectVendorFilter" class="singleSelect">
									<option value="all" disabled selected>Choose your option</option>
							<?php $vendors = get_terms('vendor');
							foreach($vendors as $vendor){
								?>
								<option value="<?php echo $vendor->slug; ?>"><?php echo $vendor->name; ?></option>
								<?php
							} ?>
								</select>
								<label>Select Vendor</label>
							</div>
						</div>
						<div class="col m3 statusFilter">
							<div class="input-field col s12">
								<select id="selectStatusFilter" class="singleSelect">
									<option value="all" disabled selected>Choose your option</option>
									<option value="Open">Open</option>
									<option value="Closed">Closed</option>
								</select>
								<label>Select Status</label>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<table class="striped prList" id="showing_<?php echo $user_role; ?>">
			<thead>
				<tr>
					<td>Purchase requision</td>
					<td>Submitted on</td>
					<td>Vertical</td>
					<td>Client</td>
					<td>Vendor</td>
					<td>Status</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$prs = new WP_Query($prs_arg);
				if($prs -> have_posts()): while($prs -> have_posts()): $prs -> the_post();
					get_template_part('template-parts/archive', 'grid');
				endwhile; endif;
				?>
			</tbody>
		</table>
	</main><!-- #main -->
</div><!-- #primary -->
</div><!-- #row -->

</div><!-- .container -->
</div><!-- .page-content -->
<?php get_footer(); ?>
