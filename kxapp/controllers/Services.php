<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends RS_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customers_model');
    }

    public function index()
    {
        echo 'Invalid Access!';
    }

    public function updateCustomer()
    {
        $postdata = json_decode($this->input->post('postdata'));
        $customers = $this->customers_model->getCustomerByMobile($postdata->mobile);
        if ($customers->num_rows() == 1) {
            $row = $customers->row();
            $this->customers_model->update($postdata->id, $postdata->name, $postdata->mobile,  $postdata->email, $postdata->address);
        } else {
            $this->customers_model->insert($postdata->id, $postdata->name, $postdata->mobile,  $postdata->email, $postdata->address);
        }
        if ($this->db->affected_rows() > 0) {
            echo "SUCCESS";
        } else
            echo "Unable to process request";
    }
}
