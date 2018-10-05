<?php
// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
$post_title = $_POST['title'];
$content = $_POST['content'];
$vendor = $_POST['vendor'];
$vertical = $_POST['vertical'];
$client = $_POST['client'];
$userID = $_POST['userID'];
$billType = $_POST['billType'];
$duration = $_POST['duration'];
// Repeater Field array
$orderDescription = json_decode(stripslashes($_POST['orderDescription']));
$orderQuantity = json_decode(stripslashes($_POST['orderQuantity']));
$orderRate =  json_decode(stripslashes($_POST['orderRate']));
$orderTotal = json_decode(stripslashes($_POST['orderTotal']));

// Creating new post
$new_post = array(
  'post_title' => $post_title,
  'post_content' => $content,
  'post_status' => 'publish',
  'post_author' => get_current_user_id(),
);
$post_id = wp_insert_post($new_post);

// Update taxonomy
wp_set_object_terms( $post_id, $vertical, 'vertical' );
wp_set_object_terms( $post_id, $client, 'client' );
wp_set_object_terms( $post_id, $vendor, 'vendor' );

// Update custom fields
update_field( 'activity_duration', $duration, $post_id);
update_field('billable_or_non-billable', $billType, $post_id);
update_field('need_approval_from', $userID, $post_id);

// Update Repeater Field
$order_field_key = 'field_5b7b9fdf60ae9';
$order_description_key = 'field_5b7ba00660aea';
$order_quantity_key = 'field_5b7ba01860aeb';
$order_rate_key = 'field_5b7ba02b60aec';
$order_total_key = 'field_5b7ba04160aed';

$count = sizeof($orderDescription);

for($i = 0; $i < $count; $i++) {
  $order_value[] = array($order_description_key => $orderDescription[$i], $order_quantity_key => $orderQuantity[$i], $order_rate_key => $orderRate[$i], $order_total_key => $orderTotal[$i]);
}
update_field( $order_field_key, $order_value, $post_id );

$post_url = get_permalink( $post_id );
// $user_info = get_userdata($userID);
// $user_email = $user_info->user_email;


echo $post_url;
