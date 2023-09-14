


<?php

// last update: 19:27 07.09.2023.

class Encryptor{

	public $key;

	public function encrypt($var){
		return $this->$key.base64encode($var.$this->$key);
	}

	public function decrypt($var){
		return trim($this->$key, base64decode(trim($this->$key,
		$var)));
	}

}