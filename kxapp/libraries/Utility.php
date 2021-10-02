<?php
class Utility {
	function guid($opt = true) { // Set to true/false as your default way to do this.
		if (function_exists ( 'com_create_guid' )) {
		if ($opt) {
				return trim ( com_create_guid (), '{}' );
			} else {
				return trim ( com_create_guid (), '{}' );
			}
		} else {
			mt_srand ( ( double ) microtime () * 10000 ); // optional for php 4.2.0 and up.
			$charid = strtoupper ( md5 ( uniqid ( rand (), true ) ) );
			$hyphen = chr ( 45 ); // "-"
			$left_curly = $opt ? chr ( 123 ) : ""; // "{"
			$right_curly = $opt ? chr ( 125 ) : ""; // "}"
			$uuid = $left_curly . substr ( $charid, 0, 8 ) . $hyphen . substr ( $charid, 8, 4 ) . $hyphen . substr ( $charid, 12, 4 ) . $hyphen . substr ( $charid, 16, 4 ) . $hyphen . substr ( $charid, 20, 12 ) . $right_curly;
			return trim ( $uuid, '{}' );
		}
	}
	function generateCDKey() {
		$key = "";
		$I1 = rand ( 1, 100000 );
		$I2 = fmod ( 127612343612, $I1 );
		$I3 = rand ( 1, 100000 );
		$I4 = fmod ( 324234343412, $I3 );
		$key = str_pad ( ( string ) $I1, 5, '0', STR_PAD_LEFT ) . "-" . str_pad ( ( string ) $I2, 5, '0', STR_PAD_LEFT ) . "-" . str_pad ( ( string ) $I3, 5, '0', STR_PAD_LEFT ) . "-" . str_pad ( ( string ) $I4, 5, '0', STR_PAD_LEFT );
		return $key;
	}
	function validateCDKey($key) {
		$akey = explode("-", $key);
		$I1 = $akey[0];
		$I2 = fmod ( 127612343612, $I1 );
		$I3 = $akey[2];
		$I4 = fmod ( 324234343412, $I3 );
		if ($I2 == $akey[1] && $I4 == $akey[3])
			return true;
		else 
			return false;
	}
}
?>