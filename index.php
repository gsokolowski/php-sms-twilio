<?php

// http://localhost:8080/php-sms-twilio/index.php?printcode=DF56TR78UJ

require_once ('GooShortUrl.php');



$longUrl = "http://wiadomosci.onet.pl/swiat/bialorus-rosnie-poparcie-dla-lukaszenki-i-chec-zjednoczenia-z-rosja/z1nch";
$goo = new Googl();
$r = $goo->setShortUrl($longUrl);
var_dump($r);
echo $r['id'];









