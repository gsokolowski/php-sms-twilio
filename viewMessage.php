<?php
require('vendor/twilio-php/Services/Twilio.php');

$account_sid = 'Your Twilio account sid';
$auth_token = 'Your Twilio auth token';
$client = new Services_Twilio($account_sid, $auth_token);

$message = $client->account->messages->get("SM6134f11c573e221bc448ed7696583542");

echo 'Body: '.$message->body.'<br />';
echo 'Date: '.$message->date_created.'<br />';
echo 'Sid: '.$message->sid.'<br />';
echo 'From: '.$message->from.'<br />';
echo 'To: '.$message->to.'<br />';
echo 'Status: '.$message->status.'<br />';
echo '<br /><br />';
