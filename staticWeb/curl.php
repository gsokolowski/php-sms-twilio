<?php
$data = array("name" => "Hagrid", "age" => "36");
$data_string = json_encode($data);

$ch = curl_init('http://amusing-oasis-3391.herokuapp.com/staticWeb/post_output.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
var_dump($result);