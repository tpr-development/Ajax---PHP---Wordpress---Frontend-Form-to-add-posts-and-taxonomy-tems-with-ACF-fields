<?php
// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
$term_name = $_POST['term_name'];
$term_description = $_POST['term_description'];
$bank_name = $_POST['bank_name'];
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
// Updating meta keys for Vendors
update_term_meta($new_term_array['term_id'], 'vendor_bank_account_name', $bank_ac_name);
update_term_meta($new_term_array['term_id'], 'bank_name', $bank_name);
update_term_meta($new_term_array['term_id'], 'account_number', $ac_number);
update_term_meta($new_term_array['term_id'], 'ifsc_code', $ifsc);
update_term_meta($new_term_array['term_id'], 'vendor_email_id', $vendor_email);
update_term_meta($new_term_array['term_id'], 'vendor_mobile_number', $vendor_mobile);
// echo $new_term_array['term_id'];
