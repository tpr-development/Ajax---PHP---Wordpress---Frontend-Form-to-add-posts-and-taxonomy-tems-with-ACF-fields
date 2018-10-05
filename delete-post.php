<?php

// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
$post_id = $_POST['post_id'];
wp_delete_post($post_id);
