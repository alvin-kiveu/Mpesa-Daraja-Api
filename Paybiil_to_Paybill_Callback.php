<?php
header("Content-Type: application/json");
$PTPCallbackResponse = file_get_contents('php://input');
$logFile = "Paybill_To_Paybill.json";
$log = fopen($logFile, "a");
fwrite($log, $PTPCallbackResponse);
fclose($log);
