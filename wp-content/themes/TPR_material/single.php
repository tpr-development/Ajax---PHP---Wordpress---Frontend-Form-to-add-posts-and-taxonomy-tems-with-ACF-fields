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
                  <p><strong>Activity Duration:</strong> <?php the_field('activity_duration'); ?></p>
                </div>
                <!-- Bill Type -->
                <div class="billType">
                  <p><strong>Bill Type:</strong><?php the_field('billable_or_non-billable'); ?></p>
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
                    $current_user = wp_get_current_user();

                    if($approve_status[0] == 'Approved'){
                      echo '<label>
                        <input type="checkbox" checked="checked" disabled="disable"/>
                        <span>Approved by '.$approved_by['display_name'].'</span>
                      </label>';
                    } else {
                      echo '<form id="approveForm" action="'.site_url().'/approve_pr.php">
                      <div class="row">
                        <div class="input-field col s6">
                          <label>
                            <input type="checkbox" id="checkApprove"/>
                            <span>Approved</span>
                          </label>
                        </div>
                        <div class="input-field col s6">
                          <label>
                            <input type="checkbox" id="checkDisApprove"/>
                            <span>Disapproved</span>
                            <div><small>If you disapprove, the PR will be deleted and the author will be notified.</small></div>
                          </label>
                        </div>
                      </div>
                      <input type="hidden" value="'.get_the_ID().'" id="post_id"/>
                      <input type="hidden" value="'.$current_user->user_firstname.'" id="current_user"/>
                      <input type="hidden" value="'.$post->post_author.'" id="author_id"/>
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
                <div class="approveSuccessMessage">Thank you for approving. Email has been sent to Finance Team</div>
                </div>
                <!-- PO status -->
                <div class="po_status">
                  <hr/>
                  <h5>PO Status</h5>
                  <?php
                  if( $user_role == 'author'){ // Condition for Employee
                    if( have_rows('purchase_order') ){ // already has values
                      ?>
                      <table class="poList">
                        <thead>
                          <tr>
                            <td>Purchase Order</td>
                            <td>Purchase Order Number</td>
                          </tr>
                        </thead>
                        <tbody>
                            <?php while( have_rows('purchase_order') ): the_row(); ?>
                              <tr><td><a href="<?php the_sub_field('url'); ?>" target="_blank"><?php the_sub_field('url'); ?></a></td>
                              <td><?php the_sub_field('purchase_order_number'); ?></td></tr>
                            <?php endwhile; ?>
                        </tbody>
                      </table>
                      <?php
                    } else {
                      echo '<span class="nill">No Purchase Order has been uploaded yet.</span>';
                    }
                  }
                  else if($user_role == 'contributor'){ // Condition for Vertical Head
                    if( have_rows('purchase_order') ){ // already has values
                      ?>
                      <table class="poList">
                        <thead>
                          <tr>
                            <td>Purchase Order</td>
                            <td>Purchase Order Number</td>
                          </tr>
                        </thead>
                        <tbody>
                            <?php while( have_rows('purchase_order') ): the_row(); ?>
                              <tr><td><a href="<?php the_sub_field('url'); ?>" target="_blank"><?php the_sub_field('url'); ?></a></td>
                              <td><?php the_sub_field('purchase_order_number'); ?></td></tr>
                            <?php endwhile; ?>
                        </tbody>
                      </table>
                      <?php
                    } else {
                      echo '<span class="nill">No Purchase Order has been uploaded yet.</span>';
                    }
                    } else if($user_role == 'editor'){ // Condition for Finance Head
                    if( have_rows('purchase_order') ){ // already has values
                      ?>
                      <table class="poList">
                        <thead>
                          <tr>
                            <td>Purchase Order</td>
                            <td>Purchase Order Number</td>
                          </tr>
                        </thead>
                        <tbody>
                            <?php while( have_rows('purchase_order') ): the_row(); ?>
                              <tr><td><a href="<?php the_sub_field('url'); ?>" target="_blank"><?php the_sub_field('url'); ?></a></td>
                              <td><?php the_sub_field('purchase_order_number'); ?></td></tr>
                            <?php endwhile; ?>
                        </tbody>
                      </table>
                      <?php
                    } else {
                      echo '<span class="nill">No Purchase Order has been uploaded yet.</span>';
                    }
                    $order_status = get_field('order_status');
                    // print_r($order_status);
                    if($order_status == 'Open'){ // Show form only if the order is open
                      echo '<form enctype="multipart/form-data" id="uploadPO" action="'.site_url().'/update-poInfo.php">
                      <div class="row"><div class="col s12">
                      <table>
                        <tr>
                          <td>
                            <span id="noEmpty">Please select a file</span>
                            <div class="file-field input-field">
                              <!-- <input type="file" id="sortpicture" name="upload"> -->
                              <div class="btn btn-small">
              				            <span>Select PO</span>
              				            <input type="file" id="sortpicture" name="upload"/>
              				        </div>
              				        <div class="file-path-wrapper">
              				            <input class="file-path validate" type="text" id="fileName">
              				        </div>
                          </td>
                          <td>
                              <button class="btn waves-effect waves-light save-support" name="uploadFile" id="uploadFile">Upload</button>
                          </td>
                          <td>
                            <div class="input-field col s12">
                              <input id="po_number" type="number" class="validate" required="" aria-required="true">
                              <label for="po_number">PO Number</label>
                            </div>
                          </td>
                        </tr>
                      </table></div></div>
                      <input type="hidden" value="'.get_the_ID().'" id="post_id_1"/>
                      <!-- <input class="save-support" name="save_support" type="button" value="Save"> -->
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
                  else{ // for Other user roles => admin
                    if( have_rows('purchase_order') ){ // already has values
                      ?>
                      <table class="poList">
                        <thead>
                          <tr>
                            <td>Purchase Order</td>
                            <td>Purchase Order Number</td>
                          </tr>
                        </thead>
                        <tbody>
                            <?php while( have_rows('purchase_order') ): the_row(); ?>
                              <tr>
                              <td><a href="<?php the_sub_field('url'); ?>" target="_blank"><?php the_sub_field('url'); ?></a></td>
                              <td><?php the_sub_field('purchase_order_number'); ?></td></tr>
                            <?php endwhile; ?>
                        </tbody>
                      </table>
                      <?php
                    } else {
                      echo '<span class="nill">No Purchase Order has been uploaded yet.</span>';
                    }
                  }
                  ?>
                </div>
                <!-- vendor bill -->
                <div class="vendor-bill">
                  <hr/>
                  <h5>Vendor Bill</h5>
                  <?php
                  if($user_role == 'author'){ // condition for employees
                    if(get_field('vendor_bill')){ // already has bill
                      ?>
                      <div class="billResult">
                        <table>
                            <tr>
                              <td>Vendor Bill</td>
                              <td><a href="<?php the_field('vendor_bill'); ?>" target="_blank"><?php the_field('vendor_bill'); ?></a></td>
                            </tr>
                        </table>
                      </div>
                      <?php
                    } else {
                      echo '<span class="nillBill">No bill has been uploaded yet.</span>';
                    }
                  } else if($user_role == 'contributor'){ // condition for vertical head
                    if(get_field('vendor_bill')){ // already has bill
                      ?>
                      <div class="billResult">
                        <table>
                            <tr>
                              <td>Vendor Bill</td>
                              <td><a href="<?php the_field('vendor_bill'); ?>" target="_blank"><?php the_field('vendor_bill'); ?></a></td>
                            </tr>
                        </table>
                      </div>
                      <?php
                    } else {
                      echo '<span class="nillBill">No bill has been uploaded yet.</span>';
                    }
                  } else if($user_role == 'editor'){ // Condition for finance team
                    if(get_field('vendor_bill')){ // already has bill
                      ?>
                      <div class="billResult">
                        <table>
                            <tr>
                              <td>Vendor Bill</td>
                              <td><a href="<?php the_field('vendor_bill'); ?>" target="_blank"><?php the_field('vendor_bill'); ?></a></td>
                            </tr>
                        </table>
                      </div>
                      <?php
                    } else { // No bills yet; so form to upload
                      ?>
                      <form enctype="multipart/form-data" id="uploadBill">
                        <div class="row">
                          <div class="col s12">
                            <span id="noEmpty">Please select a file</span>
                            <div class="file-field input-field">
                              <!-- <input type="file" id="sortpicture" name="upload"> -->
                              <div class="btn btn-small">
              				            <span>Select Vendor Bill</span>
              				            <input type="file" id="sortbill" name="uploadBillField"/>
              				        </div>
              				        <div class="file-path-wrapper">
              				            <input class="file-path validate" type="text" id="fileName">
              				        </div>
                            </div>
                          </div>
                        </div>
                          <input type="hidden" value="<?php echo get_the_ID(); ?>" id="post_id_5" name="post_id_5"/>
                      <!-- <input class="save-support" name="save_support" type="button" value="Save"> -->
                        <div class="row uploadBillSubmit">
              						<div class="input-field col s12">
              							<button class="btn waves-effect waves-light save-support" name="uploadBillButton" id="uploadBillButton">Upload
              								<i class="material-icons right">send</i>
              							</button>
              							<input type="hidden" name="action" value="myfilter">
              						</div>
              					</div>
                       </form>
                      <?php
                    }
                  } else { // condition for administrator
                    if(get_field('vendor_bill')){ // already has bill
                      ?>
                      <div class="billResult">
                        <table>
                            <tr>
                              <td>Vendor Bill</td>
                              <td><a href="<?php the_field('vendor_bill'); ?>" target="_blank"><?php the_field('vendor_bill'); ?></a></td>
                            </tr>
                        </table>
                      </div>
                      <?php
                    } else {
                      echo 'No bill has been uploaded yet.';
                    }
                  }
                  ?>
                </div>
                <!-- Payment Status -->
                <div class="payment_status">
                  <hr/>
                  <h5>Payment Status</h5>
                  <?php
                  if( $user_role == 'author'){ // Condition for Employee
                    ?>
                    <div id="result"><table>
                      <thead>
                        <tr>
                          <td>Amount Paid to the Vendor</td>
                          <td>Bill Status</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php the_field('amount_paid_to_vendor'); ?></td>
                          <td><?php the_field('order_status'); ?></td>
                        </tr>
                      </tbody>
                    </table></div>
                    <?php
                  }
                  else if($user_role == 'contributor'){ // Condition for Vertical Head
                    ?>
                    <div id="result"><table>
                      <thead>
                        <tr>
                          <td>Amount Paid to the Vendor</td>
                          <td>Bill Status</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php the_field('amount_paid_to_vendor'); ?></td>
                          <td><?php the_field('order_status'); ?></td>
                        </tr>
                      </tbody>
                    </table></div>
                    <?php
                  }
                  else if($user_role == 'editor'){
                    // vars
                    // $order_status = get_field('order_status');
                    if($order_status == 'Closed'){ // if Order is closed
                      ?>
                      <div id="paid-result"><table>
                        <thead>
                          <tr>
                            <td>Amount Paid to the Vendor</td>
                            <td>Bill Status</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?php the_field('amount_paid_to_vendor'); ?></td>
                            <td><?php the_field('order_status'); ?></td>
                          </tr>
                        </tbody>
                      </table></div>
                      <?php
                    } else { // if Order is open
                      if(get_field('amount_paid_to_vendor')){ // if Amount field has some value
                        ?>
                        <div id="paid-result"><table>
                          <thead>
                            <tr>
                              <td>Amount Paid to the Vendor</td>
                              <td>Bill Status</td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php the_field('amount_paid_to_vendor'); ?></td>
                              <td><?php the_field('order_status'); ?></td>
                            </tr>
                          </tbody>
                        </table></div>
                        <?php
                      } else { // if Amount field is empty
                        ?><div id="paid-result"></div><?php
                      }
                    ?>
                    <form action="<?php echo site_url() ?>/update_paymentStatus.php" method="POST" id="paymentSubmit">
                      <h6>Update payment status</h6>
                      <div class="row">
                        <div class="col m6 input-field">
              							<input id="paidToVendor" type="number" class="paid validate" required="required" aria-required="true" <?php if(get_field('amount_paid_to_vendor')){ ?>value="<?php the_field('amount_paid_to_vendor'); ?>"<?php } ?>>
              		          <label for="paidToVendor">Amount Paid to Vendor</label>
              							<span class="helper-text" data-error="wrong" data-success="right">Only number</span>
                        </div>
                        <div class="col m6 input-field">
                          <label>
                            <input type="checkbox" id="status"/>
                            <span>Bill Closed</span>
                          </label>
                        </div>
                      </div>
                      <input type="hidden" value="<?php echo get_the_ID(); ?>" id="post_id_2"/>
                      <div class="row paymentresult">
            						<div class="input-field col s12">
            							<button class="btn waves-effect waves-light">Update</button>
            							<input type="hidden" name="action" value="myfilter">
            						</div>
            					</div>
                    </form>
                    <?php
                    }
                  } else { // for Admin
                    ?>
                    <div class="paid-result"><table>
                      <thead>
                        <tr>
                          <td>Amount Paid to the Vendor</td>
                          <td>Bill Status</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php the_field('amount_paid_to_vendor'); ?></td>
                          <td><?php the_field('order_status'); ?></td>
                        </tr>
                      </tbody>
                    </table></div>
                    <?php
                  } ?>
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
