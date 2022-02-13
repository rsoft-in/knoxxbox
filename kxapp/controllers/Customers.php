<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends RS_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customers_model');
        $this->load->model('business_model');
    }

    public function index()
    {
        echo 'Invalid Access!';
    }

    private function authorizeAPI($api_key)
    {
        $business = $this->business_model->getBusinessById($api_key);
        if ($business->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get()
    {
        // receive post data parameters
        $postdata = json_decode($this->input->post('postdata'));
        // check api_key validity
        if (!$this->authorizeAPI($postdata->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        // build filter for business ID
        $filter = "";
        $filter .= " AND (customer_business_id = '" . $postdata->bid . "')";
        // initialize data array
        $item_array = array();
        // fetch data
        $customers = $this->customers_model->getCustomers($filter, $postdata->sort, $postdata->pn, $postdata->ps);
        if ($customers->num_rows() > 0) {
            foreach ($customers->result() as $row) {
                $_item = array(
                    'customer_id' => $row->customer_id,
                    'customer_name' => $row->customer_name,
                    'cusomter_mobile' => $row->customer_mobile,
                    'customer_email' => $row->customer_email,
                    'customer_address' => $row->customer_address,
                    'customer_points' => $row->customer_points,
                    'customer_cashback' => $row->customer_cashback,
                    'customer_modified' => $row->customer_modified
                );
                $item_array[] = $_item;
            }
        }
        //output data array
        echo json_encode($item_array);
    }

    public function getByMobile()
    {
        // receive post data parameters
        $postdata = json_decode($this->input->post('postdata'));
        // check api_key validity
        if (!$this->authorizeAPI($postdata->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        // fetch data
        $customers = $this->customers_model->getCustomerByMobile($postdata->mobile);
        if ($customers->num_rows() == 1) {
            $row = $customers->row();
            $customer = array(
                'customer_id' => $row->customer_id,
                'customer_name' => $row->customer_name,
                'cusomter_mobile' => $row->customer_mobile,
                'customer_email' => $row->customer_email,
                'customer_address' => $row->customer_address,
                'customer_points' => $row->customer_points,
                'customer_cashback' => $row->customer_cashback,
                'customer_modified' => $row->customer_modified
            );
            //output data array
            echo json_encode($customer);
        } else {
            echo 'CUSTOMER_NOT_FOUND';
        }
    }

    public function addCustomer() {
        $postdata = json_decode($this->input->post('postdata'));
        // check api_key validity
        if (!$this->authorizeAPI($postdata->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        $guid = $this->utility->guid ();
        $this->customers_model->insert($guid, $postdata->bid, $postdata->name, $postdata->mobile,  $postdata->email, $postdata->address, 0, 0);
        if ($this->db->affected_rows () > 0) {
            echo "{ \"result\": \"SUCCESS\", \"id\": \"" . $guid . "\"}";
        } else
            echo "Unable to process request";
    }

    public function updateCustomer() {
        $postdata = json_decode($this->input->post('postdata'));
        // check api_key validity
        if (!$this->authorizeAPI($postdata->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        $this->customers_model->update($postdata->id, $postdata->bid, $postdata->name, $postdata->mobile,  $postdata->email, $postdata->address);
        if ($this->db->affected_rows () > 0) {
            echo "{ \"result\": \"SUCCESS\", \"id\": \"" . $postdata->id . "\"}";
        } else
            echo "Unable to process request";
    }

}
