<?php
// Download the library and copy into the folder containing this file.
require('vendor/twilio-php/Services/Twilio.php');

$account_sid = "Your Twilio account sid"; // Your Twilio account sid
$auth_token = "Your Twilio auth token"; // Your Twilio auth token

$client = new Services_Twilio($account_sid, $auth_token);
$resourceName = $client->getResourceName();
$message = $client->account->messages->sendMessage(
    '+447900000000', // From mobile number
    '+441253530197', // To  Twilio number in your account
    "To Twilio printCode ZZZVVV"
);
echo $message->sid;
echo $resourceName;