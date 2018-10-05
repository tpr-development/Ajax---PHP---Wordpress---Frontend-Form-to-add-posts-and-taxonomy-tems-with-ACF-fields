<?php
// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');

$amount = $_POST['amount'];
$status = $_POST['status'];
$post_id = $_POST['post_id'];

update_field( 'field_5b7ba17560af4', $amount, $post_id );
update_field( 'field_5b7ba19c60af5', $status, $post_id );

$author_id = get_post_field( 'post_author', $post_id );
$post_title = get_the_title($post_id);
$approver_id = get_field('need_approval_from', $post_id);

echo json_encode(array($amount, $status, $author_id, $post_title, $approver_id));
