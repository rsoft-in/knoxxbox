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

    public function verifyCustomer()
    {
        $postdata = json_decode($this->input->post('postdata'));
        $customers = $this->customers_model->getCustomerByMobile($postdata->mobile);
        $data_item = array();
        if ($customers->num_rows() == 1) {
            $row = $customers->row();
            $data_item = array(
                'customer_id' => $row->customer_id,
                'customer_name' => $row->customer_name,
                'customer_mobile' => $row->customer_mobile,
                'customer_email' => $row->customer_email,
                'customer_address' => $row->customer_address,
                'customer_points' => $row->customer_points,
                'customer_cashback' => $row->customer_cashback,
                'customer_modified' => $row->customer_modified
            );
        } else {
            $guid = $this->utility->guid();
            $this->customers_model->insert($guid, 'Unknown User', $postdata->mobile,  '', '');
            $data_item = array(
                'customer_id' => $guid,
                'customer_name' => 'Unknown User',
                'customer_mobile' => $postdata->mobile,
                'customer_email' => '',
                'customer_address' => '',
                'customer_points' => 0,
                'customer_cashback' => 0.0,
                'customer_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
            );
        }
        echo json_encode($data_item);
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
