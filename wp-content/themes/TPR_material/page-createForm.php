<?php
/**
 * Template Name: Create New PR
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
	<div id="primary" class="content-area col m9 s12">
		<main id="main" class="site-main" role="main">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'page' );
				?>
				<form action="<?php echo site_url() ?>/post-insert.php" method="POST" id="postSubmit">
					<div class="row">
						<div class="input-field col s12">
		          <input id="title" type="text" class="validate" required="" aria-required="true">
		          <label for="title">Title</label>
		        </div>
					</div>
					<div class="row">
		        <div class="input-field col s12">
		          <textarea id="textarea1" class="materialize-textarea"></textarea>
		          <label for="textarea1">Content</label>
		        </div>
		      </div>
					<!-- Order details - repeater field -->
					<div class="row orderDetails">
						<div class="input-field col m6 s12">
							<textarea id="description" class="description materialize-textarea" required="" aria-required="true"></textarea>
							<label for="description">Description of Order</label>
						</div>
						<div class="input-field col m2 s12">
							<input id="quantity" type="number" class="quantity validate" required="" aria-required="true">
		          <label for="quantity">Quantity</label>
							<span class="helper-text" data-error="wrong" data-success="right">Only number</span>
						</div>
						<div class="input-field col m2 s12">
							<input id="rate" type="number" class="rate validate" required="" aria-required="true">
		          <label for="rate">Rate</label>
							<span class="helper-text" data-error="wrong" data-success="right">Only number</span>
						</div>
						<div class="input-field col m2 s12">
							<input id="total" type="number" class="total validate" required="" aria-required="true">
		          <label for="total">Total</label>
							<span class="helper-text" data-error="wrong" data-success="right">Only number</span>
						</div>
					</div>
					<div class="row">
						<div class="input-field col m1 s12">
							<a class="btn-floating waves-effect waves-light red" id="addNew"><i class="material-icons">add</i></a>
						</div>
					</div>
					<!-- Vendor -->
					<div class="row">
						<div class="input-field col s12">
					    <select id="vendor" required="" aria-required="true">
					      <option value="*" selected>Choose your option</option>
								<?php
                    if( $vendors = get_terms( 'vendor', 'orderby=name&hide_empty=0' ) ) :
                        foreach ( $vendors as $vendor ) :
                            echo '<option value="'.$vendor->slug.'">'.$vendor->name.'</option>';
                        endforeach;
                    endif;
                ?>
					    </select>
					    <label>Select Vendor</label>
					  </div>
					</div>
					<!-- Client -->
					<div class="row">
						<div class="input-field col s12">
					    <select id="client" required="" aria-required="true">
					      <option value="*" selected>Choose your option</option>
								<?php
                    if( $clients = get_terms( 'client', 'orderby=name&hide_empty=0' ) ) :
                        foreach ( $clients as $client ) :
                            echo '<option value="'.$client->slug.'">'.$client->name.'</option>';
                        endforeach;
                    endif;
                ?>
					    </select>
					    <label>Select Client</label>
					  </div>
					</div>
					<!-- Vertical -->
					<div class="row">
						<div class="input-field col s12">
					    <select id="vertical" required="" aria-required="true">
					      <option value="*" selected>Choose your option</option>
								<?php
                    if( $verticals = get_terms( 'vertical', 'orderby=name&hide_empty=0' ) ) :
                        foreach ( $verticals as $vertical ) :
                            echo '<option value="'.$vertical->slug.'">'.$vertical->name.'</option>';
                        endforeach;
                    endif;
                ?>
					    </select>
					    <label>Select Vertical</label>
					  </div>
					</div>
					<!-- Need approval from -->
					<div class="row">
						<div class="input-field col s12">
					    <select id="user" required="" aria-required="true">
					      <option value="*" selected>Choose your option</option>
								<?php
                    if( $users = get_users( array( 'fields' => array( 'display_name', 'ID' ) ) ) ):
                        foreach ( $users as $user ) :
                            echo '<option value="'.$user->ID.'">'. $user->display_name .'</option>';
                        endforeach;
                    endif;
                ?>
					    </select>
					    <label>Need Approval from?</label>
					  </div>
					</div>
					<!-- Activity Duration -->
					<div class="row">
						<div class="input-field col s12">
		          <input id="duration" type="text" class="validate" required="" aria-required="true">
		          <label for="duration">Activity Duration</label>
		        </div>
					</div>
					<!-- Billable or not -->
					<div class="row">
						<div class="input-field col s3">
							<select id="billType" required="" aria-required="true">
								<option value="Billable" selected>Billable</option>
								<option value="Non-billable">Non-billable</option>
							</select>
							<label>Select an option</label>
						</div>
					</div>
					<!-- PO file upload -->
					<!-- <div class="row">
						<div class="file-field input-field col s12">
							<div class="btn">
				        <span>Upload PO</span>
				        <input type="file" id="po_file">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" id="fileName">
				      </div>
						</div>
					</div> -->
					<!-- Submit -->
					<div class="row">
						<div class="input-field col s12">
							<button class="btn waves-effect waves-light">Submit
								<i class="material-icons right">send</i>
							</button>
							<input type="hidden" name="action" value="myfilter">
						</div>
					</div>
				</form>
				<div class="successMessage">Your PR has been successfully created. <a href="" id="newPRLink">View PR</a></div>
			<?php endwhile; ?>
			<?php the_posts_navigation(); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div id="secondary" class="col m3 s12">
		<h3>Instruction</h3>
		<ol>
			<li>Lorem ipsum dolor sit amet, cu quo malis minimum liberavisse, ea eos bonorum inciderint. Sea rebum clita at.</li>
			<li>An nec tacimates efficiantur, graecis definiebas vel ad, id unum eius putant vix.</li>
			<li>Ea vero error efficiantur usu, soleat eruditi reprehendunt ei ius, mei no etiam quaeque nostrum.</li>
			<li>Postea corrumpit vix an, ei per illum ullum rationibus.</li>
		</ol>
	</div>
</div><!-- #row -->
</div><!-- .container -->
</div><!-- .page-content -->

<?php get_footer(); ?>
