<?php
include 'accessToken.php';
include 'securitycridential.php';
$TaxRemittanceUrl = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/remittax';
$BusinessShortCode = 600426;
$KRA_SHORT_CODE = 572572;
$KRA_PIN = "353353";
$request_data = array(
    'Initiator' => 'testapi',
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => 'PayTaxToKRA',
    "SenderIdentifierType"=> "4",
    "RecieverIdentifierType"=> "4",
    "Amount"=> 239,
    "PartyA"=> $BusinessShortCode,
    "PartyB"=> $KRA_SHORT_CODE,
    "AccountReference"=> $KRA_PIN,
    "Remarks"=>"OK",
    'QueueTimeOutURL' => 'https://1c95-105-161-14-223.ngrok-free.app/MPEsa-Daraja-Api/QueueTimeOutURL.php',
    'ResultURL' => 'https://1c95-105-161-14-223.ngrok-free.app/MPEsa-Daraja-Api/ResultURL.php',
);
$data_string = json_encode($request_data);
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token
);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $TaxRemittanceUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
echo $response;
?>
