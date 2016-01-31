<?php
// Download the library and copy into the folder containing this file.
require('vendor/twilio-php/Services/Twilio.php');

$account_sid = "Your Twilio account sid"; // Your Twilio account sid
$auth_token = "Your Twilio auth token"; // Your Twilio auth token

$client = new Services_Twilio($account_sid, $auth_token);
$resourceName = $client->getResourceName();
$message = $client->account->messages->sendMessage(
    '+441253530197', // From a Twilio number in your account
    '+447900000000', // Text any number
    "PrintCode ABCXYZii"
);
echo $message->sid;
echo $resourceName;