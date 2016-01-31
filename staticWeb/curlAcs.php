<?php

$privateKey="9c2057734ec05dd90967892a640b9cca";
$apiKey="a0198e401d7a2257aa9cf8001476e925";
$timestamp = date("Y-m-d\TH:i:s\Z");

//echo $timestamp."\n";

$data = array(
    "username" => "abc@newsint.co.uk",
    "shareURL" => "http://www.uat-thesun.co.uk/sol/homepage/showbiz/tv/article5412798.ece",
    "articleId" => "5412798",
    "shareStartDate" => "$timestamp",
    "maxHitsCount" => "10",
    "timestamp" => "$timestamp"
);
$dataJson = json_encode($data);
//echo $dataJson."\n";

$acsUrl = "https://acs-uat.newsint.co.uk/sharing/generateToken";
//base64-encode the binary value:
$signature  = hash_hmac('sha1', $dataJson, $privateKey, true);
$signature = base64_encode($signature);
//echo $signature."\n";

$headers= array(
    'Content-Type: application/json',
    'X-NI-signatureType: 2',
    'X-NI-signatureHash: '.$signature,
    'X-NI-apiKey: '.$apiKey,
    'X-NI-apiVersion: 1',
    'X-Fowarded-Protocol: https',
    'X-Fowarded-For: 10.198.10.78'
);
//print_r($headers);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $acsUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$dataJson);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_VERBOSE, true); //for diagnostic

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

$response = curl_exec($ch);
$acsResponse = json_decode($response);
//print_r($acsResponse);
echo $acsResponse->shareURL;
curl_close($ch);
?>