<?php

$data = array(
    "url" => "http://www.uat-thesun.co.uk/sol/homepage/showbiz/tv/article5412798.ece",
    "senderEmail" => "myemail@yahoo.com",
    "recipientEmail" => "jaketalledo86@yahoo.com",
    "comment" => "Invitation",
    "forceDebitCard" => "false"
);

$url_send ="http://amusing-oasis-3391.herokuapp.com/staticWeb/post_output.php";
$dataJson = json_encode($data);
$headers= array('Accept: application/json',
                'Content-Type: application/json'
          );

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_send);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$dataJson);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

$response = curl_exec($ch);
$responseStatus = curl_getinfo($ch);


if($responseStatus['http_code'] == 200) {
    echo $response;
} else {
    print_r($responseStatus);
}
//echo '<br/>Response Status'.print_r($responseStatus);
curl_close($ch);
?>