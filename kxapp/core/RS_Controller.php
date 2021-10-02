<?php if (! defined ( 'BASEPATH' )) 	exit ( 'No direct script access allowed' );

class RS_Controller extends CI_Controller {
	function __construct() {
		parent::__construct ();
		session_start();
		
		// Check if login session is set else redirect to login page
		if (!isset($_SESSION['kx_app_level'])) {
			redirect ( 'login' );
		}
		
		// $this->lang->load('default', 'english');
		date_default_timezone_set('Asia/Kolkata');
	}
}

?>