<?php
include 'accessToken.php';
$stimulateTransactionUrl = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';
$BusinessShortCode  = '';
$amount     = '';
$phone     = "";
$BillRefNumber    = '';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $stimulateTransactionUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token));
$curl_post_data = array(
  'ShortCode' =>  $BusinessShortCode,
  'CommandID' => 'CustomerPayBillOnline',
  'Amount' => $amount,
  'Msisdn' => $phone,
  'BillRefNumber' => $BillRefNumber
);
$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$response = curl_exec($curl);
echo $response;
