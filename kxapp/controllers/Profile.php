<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends RS_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'My Account',
            'content' => 'profile_view'
        );
        $this->load->view('template', $data);
    }

    public function get()
    {
        $ures = $this->users_model->getUserByUserId($_SESSION["kx_user_id"]);
        if ($ures->num_rows() == 1) {
            $prow = $ures->row();
            $dataArray = array(
                'id' => $prow->user_id,
                'email' => $prow->user_email,
                'mobile' => $prow->user_mobile,
                'name' => $prow->user_name
            );
            echo json_encode($dataArray);
        }
    }
}
