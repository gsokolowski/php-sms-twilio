<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
//http://code.tutsplus.com/tutorials/techniques-for-mastering-curl--net-8470
//http://davidwalsh.name/curl-post

$privateKey="9c2057734ec05dd90967892a640b9cca";
$apiKey="a0198e401d7a2257aa9cf8001476e925";
$timestamp = date("Y-m-d\TH:i:s\Z");
$webUrl = "http://www.uat-thesun.co.uk/sol/homepage/showbiz/tv/article5412798.ece";
$webUrl = urldecode($webUrl);
$data = array(
                "username" => "abc@newsint.co.uk",
                "shareURL" => "$webUrl",
                "articleId" => "5412798",
                "shareStartDate" => "$timestamp",
                "maxHitsCount" => "10",
                "timestamp" => "$timestamp"
);

print_r($data);

echo '<br /><br />';


$body = json_encode($data);
print_r($body);

//export SIG=$(cat ${BODY} | openssl dgst -sha1 -hmac ${PRIVATE_KEY} -binary | openssl enc -base64)
$signature  = hash_hmac('sha1', $body, $privateKey);
//$signature = base64_encode($signature);
//var_dump($signature);

echo '<br /><br />Signature: ';

//$signature = 'CmLwDP2FjbC/vZmE9lmyIfqWM7k=';
//$signature = 've86EHd+ccyj58tNutP2quO0orE=';
$signature = 'MinwsZLql1GT7N2VnzRRP8lTWHI==';

var_dump($signature);
echo '<br /><br /><br /><br />';

$acsUrl = "https://acs-uat.newsint.co.uk/sharing/generateToken 2>&1";

// make curl curl to acs
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $acsUrl);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'X-NI-signatureType: 2',
        'X-NI-signatureHash: '.$signature,
        'X-NI-apiKey: '.$apiKey,
        'X-NI-apiVersion: 1',
        'X-Fowarded-Protocol: https',
        'X-Fowarded-For: 10.198.10.78',
    )
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,5);

$output = curl_exec($ch);

if(curl_errno($ch)){
    echo 'error:' . curl_error($ch).'<br />';
    $info = curl_getinfo($ch);
    echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
}

var_dump($output);
curl_close($ch);


//-X means the method type. -H means headers, and -d means data that will be sent with the request

//curl -v -i --connect-timeout 5 -m 2 -X POST \
//-H "Content-Type: application/json" \
//-H "X-NI-signatureType: 2" \
//-H "X-NI-signatureHash: ${SIG}" \
//-H "X-NI-apiKey: ${API_KEY}" \
//-H "X-NI-apiVersion: 1" \
//-H "X-Fowarded-Protocol: https" \
//-H "X-Fowarded-For: 10.198.10.78" \
//-d @${BODY} \
//https://acs-uat.newsint.co.uk/sharing/generateToken 2>&1


//now curl call to
//https://groups.google.com/forum/#!topic/gs-discussion/_4yDybKnpzw
//https://php.net/curl
//To jest dobre: https://php.net/manual/en/function.curl-setopt-array.php