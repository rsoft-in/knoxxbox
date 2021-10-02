<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
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

    public function pricing()
    {
        $data = array(
            'title' => 'Plans & Pricing',
            'content' => 'pricing_view'
        );
        $this->load->view('template', $data);
    }
}
