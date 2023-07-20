<?php
include 'accessToken.php';
$DynamicQRUrl = "https://sandbox.safaricom.co.ke/mpesa/qrcode/v1/generate";
$MerchantName = "UMESKIA TEST PAY";
$AccountNumber = "umeskia1234";
$BusinessShortCode = "600997";
$payload = array(
  'MerchantName' => $MerchantName,
  'RefNo' =>  $AccountNumber,
  'Amount' => '10',
  'TrxCode' => 'PB',
  'CPI' => $BusinessShortCode,
  'Size' => '300',
);
$ch = curl_init();
curl_setopt_array(
  $ch,
  array(
    CURLOPT_URL => $DynamicQRUrl,
    CURLINFO_HEADER_OUT => true,
    CURLOPT_HTTPHEADER =>  array('Content-Type: application/json', 'Authorization:Bearer ' . $access_token),
    CURLOPT_POST =>  true,
    CURLOPT_POSTFIELDS =>  json_encode($payload),
    CURLOPT_RETURNTRANSFER =>  true,
    CURLOPT_SSL_VERIFYPEER =>  false,
    CURLOPT_SSL_VERIFYHOST =>  false
  )
);
$response = curl_exec($ch);
$resp = json_decode($response);
$resp->QRCode;
if (isset($resp->QRCode)) {
  $data =  $resp->QRCode;
 $qrImage = "data:image/jpeg;base64, {$resp->QRCode}";
} else {
  echo "An Error has occurred. Please try again later.";
}
?>

<img class="qrcode" src="<?php echo $qrImage; ?>" alt="QR Code" />

