<?php
//INCLUDE ACCESS TOKEN FILE 
include 'accessToken.php';
$registerurl = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
$BusinessShortCode = '';
$confirmationUrl = 'https://1c95-105-161-14-223.ngrok-free.app/Daraja-Api/confirmation_url.php';
$validationUrl = 'https://1c95-105-161-14-223.ngrok-free.app/Daraja-Api/validation_url.php';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $registerurl);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  'Content-Type:application/json',
  'Authorization:Bearer ' . $access_token
));
$data = array(
  'ShortCode' => $BusinessShortCode,
  'ResponseType' => 'Completed',
  'ConfirmationURL' => $confirmationUrl,
  'ValidationURL' => $validationUrl
);
$data_string = json_encode($data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
echo $curl_response = curl_exec($curl);
