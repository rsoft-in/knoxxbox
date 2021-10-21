<?php if (! defined ( 'BASEPATH' )) 	exit ( 'No direct script access allowed' );

class RS_Controller extends CI_Controller {
	function __construct() {
		parent::__construct ();
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
		$this->load->library('encryption');
		date_default_timezone_set('Asia/Kolkata');
	}
}

?>