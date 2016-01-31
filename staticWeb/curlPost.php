<?php
$url = "http://127.0.0.1:8080/printdigital/staticWeb/post_output.php";

$post_data = array (
    "foo" => "bar",
    "query" => "Nettuts",
    "action" => "Submit"
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// we are doing a POST request
curl_setopt($ch, CURLOPT_POST, 1);
// adding the post variables to the request
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

$output = curl_exec($ch);

curl_close($ch);

echo $output;