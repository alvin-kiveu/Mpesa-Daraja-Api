<?php
header("Content-Type: application/json");
$response = '{
"ResultCode": 0,
"ResultDesc": "Confirmation Received Successfully"
}';
$mpesaResponse = file_get_contents('php://input');
$logFile = "C2bPesaResponse.json";
$log = fopen($logFile, "a");
fwrite($log, $mpesaResponse);
fclose($log);
