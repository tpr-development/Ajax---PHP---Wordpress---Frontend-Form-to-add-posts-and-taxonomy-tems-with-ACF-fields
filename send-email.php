<?php
// require(dirname(__FILE__) . '/wp-content/themes/TPR_material/img/PHPMailer/PHPMailerAutoload.php' );
require(dirname(__FILE__) . '/wp-load.php');
$subject = $_POST['subject'];
$body = $_POST['body'];
$receipentID = $_POST['receiverId'];
$receipent = get_user_by('id', $receipentID);
$receipentEmail = $receipent->user_email;
// echo $receipentEmail;
$headers = array('Content-Type: text/html; charset=UTF-8');
// Sending email
if(! (wp_mail ( $receipentEmail, $subject, $body, $headers))){
  $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
  die($output);
} else{
  echo 'Success';
}
