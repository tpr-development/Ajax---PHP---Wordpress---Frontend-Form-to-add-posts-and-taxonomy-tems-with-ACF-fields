<?php
// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
$approve_status = array($_POST['approve']);
$post_id = $_POST['post_id'];
update_field( 'approve_status', $approve_status, $post_id);
echo 'Approved';
