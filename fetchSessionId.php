<?php
session_start();
if($_SESSION["vc_id"]){
  include "credentials.php";
  include "config.php";
  $amount = $_POST["amount"];
  $vc_id = $_SESSION['vc_id'];
  $sql = "SELECT `user_name`,`mobile_no`,`email` FROM `users` WHERE `vc_id` = '$vc_id'";
  $result = $conn->query($sql);
  $r = $result->fetch_assoc();
  $curl = curl_init();
  $uname = $r['user_name'];
  $mobile_no = $r['mobile_no'];
  $email = $r['email'];

$headers = array(
    'x-client-id: '.$client_id,
    'x-client-secret: '.$secret_key,
    'Accept: application/json',
    'Content-Type: application/json',
    'x-api-version: 2022-09-01'
);

$paymentMethods = "nb,dc,upi";
$orderExpiryTime = date('Y-m-d\TH:i:s\Z', strtotime('+5 minutes'));
$timestamp = date('YmdHis');
$orderId = "order_" . strtolower(str_replace(" ", "", $uname)) . "_" . $timestamp;

$data = '{
    "order_amount": '.$amount.',
    "order_currency": "INR",
    "customer_details": {
        "customer_id": "'.$vc_id.'",
        "customer_phone": "'.$mobile_no.'",
        "customer_name": "'.$uname.'",
        "customer_email": "'.$email.'"
    },
    "order_meta": {
        "payment_methods": "'.$paymentMethods.'"
    },
    "order_expiry_time": "'.$orderExpiryTime.'",
    "order_tags": {
        "name": "Amin Shaikh",
        "company": "Amin Cable"
    },
    "order_id": "'.$orderId.'"
}';

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
$err = curl_error($curl);
curl_close($ch);


if ($err) {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(array("error" => 1));
  echo "cURL Error #:" . $err;
  die();
  
} else {
  $result = json_decode($response, true);
  header('Content-Type: application/json; charset=utf-8');
  $output = array("payment_session_id" => $result["payment_session_id"]);
  echo json_encode(array("success" => $output));
  die();
}
}
$conn->close();
?>