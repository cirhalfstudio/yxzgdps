


<?php

// last update: 19:28 07.09.2023.

class Captcha{

	public $enabled;
	public $key;
	public $secret;

	public function display(){

		if($this->$enabled){

			echo "<script src='https://js.hcaptcha.com/1/api.js'
			async defer></script>";
			echo "<div class=\"h-captcha\" data-sitekey=\"$
			{$this->$key}\"></div>";

			return 1;

		}

		return 0;

	}

	public function verify(){

		if(!$this->$enabled){
			return 1;
		}

		$data = [
            "secret" => $this->$secret,
            "response" => $_POST["h-captcha-response"],
        ];

		$crl = curl_init();

		curl_setopt($crl, CURLOPT_URL,
		"https://hcaptcha.com/siteverify");
		curl_setopt($crl, CURLOPT_POST, true);
		curl_setopt($crl, CURLOPT_POSTFIELDS,
		http_build_query($data));
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($crl, CURLOPT_PROTOCOLS,
		CURLPROTO_HTTP | CURLPROTO_HTTPS);
		
		$result = json_decode(curl_exec($crl))->success;

		return $result;

	}

}

?>