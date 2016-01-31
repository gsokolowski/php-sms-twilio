<?php
class SmsMassage {

    private $validPrintCodes = array('ABCD123','XYZA456','QWER789');

    public function __construct(Asc $acs, Googl $goo) {
        $this->acs = $acs;
        $this->goo = $goo;
    }

    public function saveMassageData($_POST){
        foreach ($_POST as $key => $value) {
            $_SESSION[$key]=$value;
        }
        if(isset( $_SESSION[$_POST['From']] )){
            return true;
        }else{
            return false;
        }
    }

    public function validatePrintCode($_POST){
        if (in_array( strtoupper($_POST['Body']), $this->validPrintCodes)){
            return true;
        } else {
            return false;
        }
    }

    public function buildReturnMessage($_POST, $isValid) {
        if($isValid){
            $webUrl = $this->acs->requestAcsWebUrl();
            if(strlen($webUrl)){
                $shortWebUrl = $this->goo->setShortUrl($webUrl);
                $returnMessage = "The Sun Team: Tap link to access the Premium content: ".$shortWebUrl['id'];
            } else {
                $returnMessage = 0;
            }
        } else {
            $returnMessage = "The Sun Team: Print Code: ".$_POST['Body']." is not valid. Make sure you typed it correctly.";
        }
        return $returnMessage;
    }
}