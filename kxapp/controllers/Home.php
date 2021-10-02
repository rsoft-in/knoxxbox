<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        $data = array(
            'title' => '',
            'content' => 'home_view'
        );
        $this->load->view('template', $data);
    }
}
