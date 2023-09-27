


<?php

// copied from https://github.com/sathoro/php-xor-cipher

class XORCipher {

	public function cipher($plaintext, $key) {
		$key = $this->text2ascii($key);
		$plaintext = $this->text2ascii($plaintext);

		$keysize = count($key);
		$input_size = count($plaintext);

		$cipher = "";
		
		for ($i = 0; $i < $input_size; $i++)
			$cipher .= chr($plaintext[$i] ^ $key[$i % $keysize]);

		return $cipher;
	}

}