<?php
class Googl {

	private $APIKey = "YourGoogleAPIKey";
	private $API = "https://www.googleapis.com/urlshortener/v1/url";

	function Googl($apiKey=""){
		if ($apiKey != ""){
			$this->APIKey = $apiKey;
		}
	}

	function setShortUrl($longURL){
		$vars = "";
		if ($this->APIKey){
			$vars .= "?key=$this->APIKey";
		}
		
		$ch = curl_init($this->API.$vars);  
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{"longUrl": "' . $longURL . '"}');
		$result=curl_exec($ch);  
		curl_close($ch);
		$array = json_decode($result, true);
		return $array;
	}
}
