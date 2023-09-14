


<?php

// last update: 14:37 07.09.2023.

class Filter{

	public function baseClear($var, $algorithm){
		return htmlspecialchars(preg_replace($algorithm,
		"", $var), ENT_QUOTES);
	}

	public function baseContains($var, $algorithm){
		return preg_match($algorithm, htmlspecialchars($var,
		ENT_QUOTES));
	}

	public function clearString($var, $except=""){
		return $this->baseClear($var, "[^0-9$except]");
	}

	public function clearSpecial($var, $except=""){
		return $this->baseClear($var, "[^0-9A-Za-z$except]");
	}

	public function containsString($var, $except=""){
		return $this->baseContains($var, "[^0-9$except]");
	}

	public function containsSpecial($var, $except=""){
		return $this->baseContains($var, "[^0-9A-Za-z$except]");
	}

}

?>