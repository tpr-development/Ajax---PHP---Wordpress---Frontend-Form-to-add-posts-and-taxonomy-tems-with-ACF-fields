<?php

// Check for 500 error
ini_set('display_errors', 1);
// Load wp bootstrap
require(dirname(__FILE__) . '/wp-load.php');
$post_id = $_POST['post_id'];
$po_number = $_POST['po_number'];
$attachment_id = $_POST['attachment_id'];

$url = wp_get_attachment_url( $attachment_id );
// echo $url;
// echo $post_id;
$purchase_order_group_key = 'field_5b8916378ab92';
$attachment_id_key = 'field_5b8916378ab94';
$url_key = 'field_5b8916378ab95';
$purchase_order_number_key = 'field_5b8916378ab96';
// Update PO Field
$po = array(
		$attachment_id_key	=> $attachment_id,
		$url_key	=> $url,
    $purchase_order_number_key => $po_number,
);
// print_r($po);
$res = add_row( $purchase_order_group_key, $po, $post_id );
echo json_encode(array($url, $po_number));
