<?php

// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
$attachment_id = $_POST['attachment_id'];
$post_id = $_POST['post_id'];

$url = wp_get_attachment_url( $attachment_id );

update_field('field_5b7ba11e60af2', $url, $post_id);
echo $url;
