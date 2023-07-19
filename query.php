<?php
//INCLUDE ACCESS TOKEN FILE 
include 'accessToken.php';
date_default_timezone_set('Africa/Nairobi');
$query_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
$BusinessShortCode = '174379';
$Timestamp = date('YmdHis');
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
// ENCRIPT  DATA TO GET PASSWORD
$Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
//THIS IS THE UNIQUE ID THAT WAS GENERATED WHEN STK REQUEST INITIATED SUCCESSFULLY
$CheckoutRequestID = 'ws_CO_03072023054410314768168060';
$queryheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];
# initiating the transaction
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $query_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $queryheader); //setting custom header
$curl_post_data = array(
  'BusinessShortCode' => $BusinessShortCode,
  'Password' => $Password,
  'Timestamp' => $Timestamp,
  'CheckoutRequestID' => $CheckoutRequestID
);
$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
echo $curl_response = curl_exec($curl);
$data_to = json_decode($curl_response);
if (isset($data_to->ResultCode)) {
  $ResultCode = $data_to->ResultCode;
  if ($ResultCode == '1037') {
    $massage = "1037 Timeout in completing transaction";
  } elseif ($ResultCode == '1032') {
    $massage = "1032 Transaction  has cancelled by user";
  } elseif ($ResultCode == '1') {
    $massage = "1 The balance is insufficient for the transaction";
  } elseif ($ResultCode == '0') {
    $massage = "0 The transaction is successfully";
  }
}

echo $massage;