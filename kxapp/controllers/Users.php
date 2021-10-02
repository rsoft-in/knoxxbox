<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends RS_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->library('encryption');
	}
}