<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cdb
 */
get_header();
?>
<div class="container">
<section class="content-body">
    <?php while (have_posts()) : the_post(); ?>
        <div class="row">
            <div id="primary" class="col l9">
                <!-- Basic Information -->
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php // edit_post_link('<i class="material-icons" style="padding: 4px;">mode_edit</i>', '', ''); ?>
                <?php the_content(); ?>
                <!-- Order List -->
                <?php if( have_rows('order') ): ?>
                <div class="orderList">
                  <table>
                    <thead>
                      <tr>
                          <th>Description</th>
                          <th>Quantity</th>
                          <th>Price Per Item</th>
                          <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ( have_rows('order') ) : the_row(); ?>
                      <tr>
                        <td><?php the_sub_field('description'); ?></td>
                        <td><?php the_sub_field('quantity'); ?></td>
                        <td><?php the_sub_field('price_per_quantity'); ?></td>
                        <td><?php the_sub_field('total'); ?></td>
                      </tr>
                    <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
                <!-- Vertical -->
                <div class="verticalList">
                  <?php $verticals = get_the_terms( get_the_ID(), 'vertical' );
                    foreach($verticals as $vertical){
                      echo '<p><strong>Vertical</strong>: '.$vertical->name.'</p>';
                    }
                  ?>
                </div>
                <!-- Client -->
                <div class="clientList">
                  <?php $clients = get_the_terms( get_the_ID(), 'client' );
                    foreach($clients as $client){
                      echo '<p><strong>Client</strong>: '.$client->name.'</p>';
                    }
                  ?>
                </div>
                <!-- Activity Duration -->
                <div class="activityDuration">
                  <p><?php the_field('activity_duration'); ?></p>
                </div>
                <!-- Bill Type -->
                <div class="billType">
                  <p><?php the_field('billable_or_non-billable'); ?></p>
                </div>
                <!-- Vendor Details -->
                <div class="vendorDetails">
                  <?php
                  $vendors = get_the_terms( get_the_ID(), 'vendor' );
                  foreach($vendors as $vendor){
                    $vendor_name = $vendor->name;
                    $vendor_term_id = $vendor->term_id;
                  }
                  $vendor_term = 'vendor_'.$vendor_term_id;
                  ?>
                  <h5>Vendor Details</h5>
                  <table>
                    <tbody>
                      <tr>
                        <td><strong>Vendor Name</strong></td>
                        <td><?php echo $vendor_name; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Email ID</strong></td>
                        <td><?php the_field('vendor_email_id', $vendor_term); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Mobile</strong></td>
                        <td><?php the_field('vendor_mobile_number', $vendor_term); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Bank Account Name</strong></td>
                        <td><?php the_field('vendor_bank_account_name', $vendor_term); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Account Number</strong></td>
                        <td><?php the_field('account_number', $vendor_term); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><?php the_field('bank_name', $vendor_term); ?></td>
                      </tr>
                      <tr>
                        <td><strong>IFSC Code</strong></td>
                        <td><?php the_field('ifsc_code', $vendor_term); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- Status -->
                <div class="approveStatus">
                <?php
                  $user = wp_get_current_user();
                  $user_role = $user->roles[0]; // Current Usr Role
                  $approved_by = get_field('need_approval_from');

                  $approve_status = get_field('approve_status'); // get approval status
                  if( $user_role == 'author'){ // Condition for Employee
                    if($approve_status[0] == 'Approved'){
                      echo '<p>Approved by <span class="approvedByDisplayName">'.$approved_by['display_name'].'</span></p>';
                    } else {
                      echo '<p>Pending approval from <span class="approvedByDisplayName">'.$approved_by['display_name'].'</span></p>';
                    }
                  }
                  else if($user_role == 'contributor'){ // Condition for Vertical Head
                    if($approve_status[0] == 'Approved'){
                      echo '<label>
                        <input type="checkbox" checked="checked" disabled="disable"/>
                        <span>Approved by '.$approved_by['display_name'].'</span>
                      </label>';
                    } else {
                      echo '<form id="approveForm" action="'.site_url().'/approve_pr.php">
                      <div class="row">
                        <div class="input-field col s12">
                          <label>
                            <input type="checkbox" id="checkApprove"/>
                            <span>Approved</span>
                          </label>
                        </div>
                      </div>
                      <input type="hidden" value="'.get_the_ID().'" id="post_id"/>
                      <div class="row approveSubmit">
            						<div class="input-field col s12">
            							<button class="btn waves-effect waves-light">Update
            								<i class="material-icons right">send</i>
            							</button>
            							<input type="hidden" name="action" value="myfilter">
            						</div>
            					</div>
                    </form>';
                    }
                  }
                  else if($user_role == 'editor'){ // Condition for Finance Head
                    if($approve_status[0] == 'Approved'){
                      echo '<p>Approved by <span class="approvedByDisplayName">'.$approved_by['display_name'].'</span></p>';
                    } else {
                      echo '<p>Pending approval from <span class="approvedByDisplayName">'.$approved_by['display_name'].'</span></p>';
                    }
                  }
                  else {
                    if($approve_status[0] == 'Approved'){
                      echo '<p>Approved by <span class="approvedByDisplayName">'.$approved_by['display_name'].'</span></p>';
                    } else {
                      echo '<p>Pending approval from <span class="approvedByDisplayName">'.$approved_by['display_name'].'</span></p>';
                    }
                  }
                ?>
                </div>
                <!-- PO status -->
                <div class="po_status">
                  <hr/>
                  <h5>PO Status</h5>
                  <?php
                  if( $user_role == 'author'){ // Condition for Employee

                  }
                  else if($user_role == 'contributor'){ // Condition for Vertical Head

                  }
                  else if($user_role == 'editor'){ // Condition for Finance Head
                    if(!empty(get_field('po_'))){
                      echo '<pre>';
                      print_r(get_field('po_'));
                      echo '</pre>';
                    } else {
                      echo '<form enctype="multipart/form-data" id="uploadPO" action="'.site_url().'/upload-po.php">
                        <div class="row">
                          <div class="file-field input-field col s12">
                            <!-- <input type="file" id="sortpicture" name="upload"> -->
                            <div class="btn">
              				        <span>Upload PO</span>
              				        <input type="file" id="sortpicture" name="upload"/>
              				      </div>
              				      <div class="file-path-wrapper">
              				        <input class="file-path validate" type="text" id="fileName">
              				      </div>
                            <input type="hidden" value="'.get_the_ID().'" id="post_id_1"/>
                            <!-- <input class="save-support" name="save_support" type="button" value="Save"> -->
                          </div>
                          <div class="input-field col s12">
                            <input id="po_number" type="number" class="validate" required="" aria-required="true">
              		          <label for="po_number">PO Number</label>
                          </div>
                        </div>
                        <div class="row uploadPOSubmit">
              						<div class="input-field col s12">
              							<button class="btn waves-effect waves-light save-support" name="save_support">Update
              								<i class="material-icons right">send</i>
              							</button>
              							<input type="hidden" name="action" value="myfilter">
              						</div>
              					</div>
                       </form>';
                    }
                  }
                  else{

                  }
                  ?>
                </div>
            </div>
            <div class="col l3 s12" id="secondary">
              <!-- <a class="waves-effect waves-light btn-small"><i class="material-icons left">add</i>Add PR</a>
              <a class="waves-effect waves-light btn-small red"><i class="material-icons left">remove</i>Delete</a> -->
            </div>
        </div>
    <?php endwhile; ?>
</section>
</div>
<?php //get_sidebar();    ?>
<?php get_footer(); ?>
