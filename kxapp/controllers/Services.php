<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends RS_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customers_model');
        $this->load->model('business_model');
        $this->load->model('transactions_model');
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

    public function getCustomer()
    {
        $postdata = json_decode($this->input->post('postdata'));
        if (!$this->authorizeAPI($postdata->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        $filter = "";
        $filter .= " AND (customer_mobile LIKE '" . $postdata->key . "%' OR customer_name LIKE '" . $postdata->key . "%')";
        $item_array = array();
        $customers = $this->customers_model->getCustomers($filter, $postdata->sort, $postdata->pn, $postdata->ps);
        if ($customers->num_rows() > 0) {
            foreach ($customers->result() as $row) {
                $_item = array(
                    'customer_id' => $row->customer_id,
                    'customer_name' => $row->customer_name,
                    'customer_mobile' => $row->customer_mobile,
                    'customer_email' => $row->customer_email,
                    'customer_address' => $row->customer_address,
                    'customer_points' => $row->customer_points,
                    'customer_cashback' => $row->customer_cashback,
                    'customer_modified' => $row->customer_modified
                );
                $item_array[] = $_item;
            }
        }
        echo json_encode($item_array);
    }

    public function updateCustomer()
    {
        $postdata = json_decode($this->input->post('postdata'));
        if (!$this->authorizeAPI($postdata->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        $customers = $this->customers_model->getCustomerByMobile($postdata->mobile);
        if ($customers->num_rows() == 1) {
            $row = $customers->row();
            $this->customers_model->update($row->customer_id, $postdata->name, $row->customer_mobile,  $postdata->email, $postdata->address);
        } else {
            $guid = $this->utility->guid();
            $this->customers_model->insert($guid, $postdata->name, $postdata->mobile,  $postdata->email, $postdata->address);
        }
        if ($this->db->affected_rows() > 0) {
            echo "SUCCESS";
        } else
            echo "Unable to process request";
    }

    public function getTransactions()
    {
        $postdata = json_decode($this->input->post('postdata'));
        if (!$this->authorizeAPI($postdata->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        $filter = "";
        if (isset($postdata->bid))
            $filter .= " AND (tr_id = '" . $postdata->bid . "')";

        if (isset($postdata->cid))
            $filter .= " AND (tr_customer_id = '" . $postdata->cid . "')";

        if (isset($postdata->mobile))
            $filter .= " AND (customer_mobile = '" . $postdata->mobile . "')";

        $item_array = array();
        $transactions = $this->transactions_model->getTransactions($filter, 'tr_date DESC', $postdata->pn, $postdata->ps);
        if ($transactions->num_rows() > 0) {
            foreach ($transactions->result() as $row) {
                $_item = array(
                    'tr_id' => $row->tr_id,
                    'tr_date' => $row->tr_date,
                    'tr_bid' => $row->tr_bid,
                    'tr_customer_id' => $row->tr_customer_id,
                    'tr_bill_amount' => $row->tr_bill_amount,
                    'tr_points' => $row->tr_points,
                    'tr_cashback' => $row->tr_cashback,
                    'tr_reference' => $row->tr_reference,
                    'tr_cancelled' => $row->tr_cancelled,
                    'b_name' => $row->b_name,
                    'b_mobile' => $row->b_mobile,
                    'b_city' => $row->b_city,
                    'customer_name' => $row->customer_name,
                    'customer_mobile' => $row->customer_mobile
                );
                $item_array[] = $_item;
            }
        }
        echo json_encode($item_array);
    }

    public function addTransaction()
    {
        $postdata = json_decode($this->input->post('postdata'));
        if (!$this->authorizeAPI($postdata->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        $guid = $this->utility->guid();
        $idata = array(
            'tr_id' => $guid,
            'tr_date' => mdate("%Y-%m-%d %H:%i:%s", time()),
            'tr_bid' => $postdata->bid,
            'tr_customer_id' => $postdata->cid,
            'tr_bill_amount' => $postdata->bill_amount,
            'tr_points' => $postdata->points,
            'tr_cashback' => $postdata->cashback,
            'tr_reference' => $postdata->reference,
            'tr_cancelled' => 0
        );
        $this->customers_model->insert($idata);
        if ($this->db->affected_rows() > 0) {
            echo "{ \"result\": \"SUCCESS\", \"id\": \"" . $guid . "\"}";
        } else
            echo "Unable to process request";
    }
}
