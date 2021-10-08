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
        $this->load->model('business_model');
        $business_id = "";
        $business_name = "";
        if (isset($_SESSION["is_app_logged"])) {
            $business = $this->business_model->getBusinessByUserId($_SESSION["kx_user_id"]);
            if ($business->num_rows() == 1) {
                $brow = $business->row();
                $_SESSION["kx_business_id"] = $brow->b_id;
                $_SESSION["kx_business_name"] = $brow->b_name;
                $business_id = $brow->b_id;
                $business_name = $brow->b_name;
            }
        }
        $data = array(
            'title' => (isset($_SESSION["is_app_logged"]) ? 'Dashboard' : 'Welcome to Knoxxbox'),
            'content' => (isset($_SESSION["is_app_logged"]) ? 'dashboard_view' : 'home_view'),
            'business_id' => $business_id,
            'business_name' => $business_name
        );
        $this->load->view('template', $data);
    }
}
