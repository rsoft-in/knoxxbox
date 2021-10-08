<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends RS_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->model('business_model');
        $business_id = "";
        $business_name = "";
        if ($_SESSION["is_app_logged"]) {
            if (isset($_SESSION["kx_business_id"])) {
                $business_id = $_SESSION["kx_business_id"];
                $business_name = $_SESSION["kx_business_name"];
            }
        }
        $data = array(
            'title' => 'Settings',
            'content' => 'settings_view',
            'business_id' => $business_id,
            'business_name' => $business_name
        );
        $this->load->view('template', $data);
    }
}
