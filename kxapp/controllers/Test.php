<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends RS_Controller
{
    public function index()
    {
        $this->load->view('test_view');
    }
}