<?php

// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
require(dirname(__FILE__) . '/wp-admin/includes/image.php' );
require(dirname(__FILE__) . '/wp-admin/includes/file.php');
require(dirname(__FILE__) . '/wp-admin/includes/media.php' );

  $posted_data =  isset( $_POST ) ? $_POST : array();
  $file_data = isset( $_FILES ) ? $_FILES : array();

  $data = array_merge( $posted_data, $file_data );
  // print_r($data);
// $uploadedfile = $_FILES['file'];
// echo $uploadedfile;
// $post_id = $_POST['post_id'];
// $po_number = $_POST['po_number'];

// $movefile = wp_handle_upload($data['file'], array('test_form' => false));
$attachment_id = media_handle_upload( 'file', 0 );
if ( is_wp_error( $attachment_id ) ) {
  $attachment_id->get_error_message();
} else {
  echo $attachment_id;
}
