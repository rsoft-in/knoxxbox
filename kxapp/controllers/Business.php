<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Business extends RS_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data = array(
            'title' => '',
            'content' => 'business_view'
        );
        $this->load->view('template', $data);
    }
}
