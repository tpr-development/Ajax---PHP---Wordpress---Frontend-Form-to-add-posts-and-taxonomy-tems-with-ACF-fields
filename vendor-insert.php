<?php
// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
$term_name = $_POST['term_name'];
$term_description = $_POST['term_description'];
$bank_ac_name = $_POST['bank_ac_name'];
$ac_number = $_POST['ac_number'];
$ifsc = $_POST['ifsc'];
$vendor_email = $_POST['vendor_email'];
$vendor_mobile = $_POST['vendor_mobile'];

// Inserting Term
$new_term_array = wp_insert_term(
    $term_name,   // the term
    'vendor', // the taxonomy
    array(
        'description' => $term_description,
    )
);

echo $new_term_array;
