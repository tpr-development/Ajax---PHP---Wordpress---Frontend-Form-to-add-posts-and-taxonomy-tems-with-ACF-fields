<?php
/**
 * Template Name: Create New Term - Vendor
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
					the_content();
				?>
				<form action="<?php echo site_url() ?>/vendor-insert.php" method="POST" id="vendorSubmit">
          <!-- Term Name -->
					<div class="row">
						<div class="input-field col s12">
		          <input id="term_name" type="text" class="validate" required="" aria-required="true">
		          <label for="term_name">Name of Vendor</label>
		        </div>
					</div>
          <!-- Term Description -->
					<div class="row">
		        <div class="input-field col s12">
		          <textarea id="textarea1" class="materialize-textarea"></textarea>
		          <label for="textarea1">Description</label>
		        </div>
		      </div>
          <!-- Bank a/c name -->
					<div class="row">
						<div class="input-field col s12">
		          <input id="bank_ac_name" type="text" class="validate" required="" aria-required="true">
		          <label for="bank_ac_name">Bank A/C Name</label>
		        </div>
					</div>
					<!-- Bank name -->
					<div class="row">
						<div class="input-field col s12">
		          <input id="bank_name" type="text" class="validate" required="" aria-required="true">
		          <label for="bank_name">Name of the Bank</label>
		        </div>
					</div>
          <!-- A/C number -->
					<div class="row">
						<div class="input-field col s12">
		          <input id="ac_number" type="number" class="validate" required="" aria-required="true">
		          <label for="ac_number">Account Number</label>
		        </div>
					</div>
          <!-- IFSC code -->
					<div class="row">
						<div class="input-field col s12">
		          <input id="ifsc" type="text" class="validate" required="" aria-required="true">
		          <label for="ifsc">IFSC Code</label>
		        </div>
					</div>
          <!-- Vendor Email -->
					<div class="row">
						<div class="input-field col s12">
		          <input id="vendor_email" type="email" class="validate" required="" aria-required="true">
		          <label for="vendor_email">Email id</label>
		        </div>
					</div>
          <!-- Vendor Mobile -->
					<div class="row">
						<div class="input-field col s12">
		          <input id="vendor_mobile" type="number" class="validate" required="" aria-required="true">
		          <label for="vendor_mobile">Mobile Number</label>
		        </div>
					</div>
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
				<div class="successMessage">Vendor has been successfully created. <a href="" id="newPRLink">View Vendor Details</a></div>
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
