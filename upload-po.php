<?php

// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
require(dirname(__FILE__) . '/wp-admin/includes/file.php');

$uploadedfile = $_FILES['file'];
$upload_overrides = array('test_form' => false);
$movefile = wp_handle_upload($uploadedfile, $upload_overrides);

    // echo $movefile['url'];
if ($movefile && !isset($movefile['error'])) {
   echo "File Upload Successfully";
} else {
  echo $movefile['error'];
}
