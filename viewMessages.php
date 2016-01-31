<?php
//https://twilio-php.readthedocs.org/en/latest/api/rest.html#message
// load twilio library
require('vendor/twilio-php/Services/Twilio.php');

$account_sid = 'Your Twilio account sid';
$auth_token = 'Your Twilio auth token';
$client = new Services_Twilio($account_sid, $auth_token);

$messages = $client->account->messages->getIterator(0, 50, array(
));

foreach ($messages as $message) {
    echo 'Body: '.$message->body.'<br />';
    echo 'Date: '.$message->date_created.'<br />';
    echo 'Sid: '.$message->sid.'<br />';
    echo 'From: '.$message->from.'<br />';
    echo 'To: '.$message->to.'<br />';
    echo 'Status: '.$message->status.'<br />';
    echo '<br /><br />';

}