<?php
include 'accessToken.php';
$B2BExpressCheckOutUrl = 'https://sandbox.safaricom.co.ke/v1/ussdpush/get-msisdn';
$primaryShortCode = '7318002';
$receiverShortCode = '174379';
//GENERATE REQUEST ID ODk4O-Tk4NWU4O-DQ66HD-D4OThkY 
$FirstCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
$SecondCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
$ThirdCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
$FourthCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
$RequestRefID = $FirstCode . '-' . $SecondCode . '-' . $ThirdCode . '-' . $FourthCode;
$amount = 10;
$headers = array(
  'Authorization:Bearer ' . $access_token,
  'Content-Type: application/json',
);
$requestData = array(
  'primaryShortCode' => $primaryShortCode,
  'receiverShortCode' => $receiverShortCode,
  'amount' => $amount,
  'paymentRef' => 'paymentRef',
  'callbackUrl' => 'http://your-callback-url.com/result',
  'partnerName' => 'Vendor',
  'RequestRefID' => $RequestRefID,
);
$curl = curl_init($B2BExpressCheckOutUrl);

curl_setopt($curl, CURLOPT_POST, true) ;
curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($requestData));
curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
echo $response;