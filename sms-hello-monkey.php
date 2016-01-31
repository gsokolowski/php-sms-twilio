<?php
session_start();
require_once ('SmsMassage.php');
require_once ('vendor/twilio-php/Services/Twilio.php');

$account_sid = 'AC951a1c0111b4fa7511b4d25184024375';
$auth_token = 'f45c4e8f41d35e4c3b610be7ea7135e4';
$twilio = new Services_Twilio($account_sid, $auth_token);

$app = new SmsMassage($twilio);
    $isSession = $app->saveMassageData($_POST);
    $isValid = $app->validatePrintCode($_POST);
    $returnMessage = $app->buildReturnMessage($_POST, $isValid);

$counter = $_SESSION['counter'];
if(!strlen($counter)) {
    $counter = 0;
}
$counter++;
$_SESSION['counter'] = $counter;

header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Sms>
        <?php echo $returnMessage; ?>
        <?php
            //foreach ($_SESSION as $key => $value) {
            //    echo "Field ".$key." : ".$value;
            //}
        ?>
        <?php echo 'Counter: '.$_SESSION['counter']; ?>
    </Sms>
</Response>