<?php
session_start();
require_once ('SmsMassage.php');
require_once ('Acs.php');
require_once ('GooShortUrl.php');

$account_sid = 'Your Twilio account sid';
$auth_token = 'Your Twilio auth token';

$acs = new Asc();
$goo = new Googl();
$app = new SmsMassage($acs,$goo);
    $isSession = $app->saveMassageData($_POST);
    $isValid = $app->validatePrintCode($_POST);
    $returnMessage = $app->buildReturnMessage($_POST, $isValid);

if($returnMessage){
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Sms>
        <?php echo $returnMessage; ?>
    </Sms>
</Response>
<?php
}
