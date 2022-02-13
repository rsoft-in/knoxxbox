<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Billing extends RS_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('billing_model');
        $this->load->model('customers_model');
        $this->load->model('loyalty_model');
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
        $filter .= " AND (bill_bid = '" . $postdata->bid . "')";
        // initialize data array
        $item_array = array();
        // fetch data
        $bills = $this->billing_model->getBilling($filter, $postdata->sort, $postdata->pn, $postdata->ps);
        if ($bills->num_rows() > 0) {
            foreach ($bills->result() as $row) {
                $_item = array(
                    'bill_id' => $row->bill_id,
                    'bill_nr' => $row->bill_nr,
                    'bill_date' => $row->bill_date,
                    'bill_seller' => $row->bill_seller,
                    'bill_customer_id' => $row->bill_customer_id,
                    'bill_gross_amount' => $row->bill_gross_amount,
                    'bill_disc_param' => $row->bill_disc_param,
                    'bill_disc_amount' => $row->bill_disc_amount,
                    'bill_grand_total' => $row->bill_grand_total
                );
                $item_array[] = $_item;
            }
        }
        //output data array
        echo json_encode($item_array);
    }

    public function getByBillNr()
    {
        // receive post data parameters
        $postdata = json_decode($this->input->post('postdata'));
        // check api_key validity
        if (!$this->authorizeAPI($postdata->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        // fetch data
        $bills = $this->billing_model->getByBillNr($postdata->bill_nr);
        if ($bills->num_rows() == 1) {
            $row = $bills->row();
            $bill = array(
                'bill_id' => $row->bill_id,
                'bill_nr' => $row->bill_nr,
                'bill_date' => $row->bill_date,
                'bill_seller' => $row->bill_seller,
                'bill_customer_id' => $row->bill_customer_id,
                'bill_gross_amount' => $row->bill_gross_amount,
                'bill_disc_param' => $row->bill_disc_param,
                'bill_disc_amount' => $row->bill_disc_amount,
                'bill_grand_total' => $row->bill_grand_total
            );
            //output data array
            echo json_encode($bill);
        } else {
            echo 'CUSTOMER_NOT_FOUND';
        }
    }

    /**
     * FUNCTION addBill()
     * @package Billing
     * @author  Rajesh Menon
     * @version 1.0
     * @param json $postdata bill_nr,date,seller,custid,gross_amt,disc_amt,grand_total,bid,redeem_type,redeem_value
     * @return json result
     */
    public function addBill()
    {
        $post = json_decode($this->input->post('postdata'));
        // check api_key validity
        if (!$this->authorizeAPI($post->bid)) {
            echo 'Unauthorized Access';
            return;
        }
        $guid = $this->utility->guid();
        $loyalty_value = 0;
        $loyalty_type = 'POINTS';
        $loyalties = $this->loyalty_model->getLoyaltyDefault($post->bid);
        if ($loyalties->num_rows() == 1) {
            $loyalty = $loyalties->row();
            $loyalty_param = json_decode($loyalty->loyalty_params);
            $loyalty_type = strtoupper($loyalty_param->type);
            if ($loyalty_type == 'POINTS') {
                $loyalty_type = 'P';
                $loyalty_value = intval(floatval($post->grand_total) * floatval($loyalty_param->percentage_rate) / 100);
                if ($loyalty_value > intval($loyalty_param->percentage_max_val))
                    $loyalty_value = intval($loyalty_param->percentage_max_val);
            } else {
                $loyalty_type = 'C';
                $loyalty_value = intval($loyalty_param->points_value) * intval(floatval($post->grand_total) / floatval($loyalty_param->points_amount));
            }
        }

        $this->billing_model->insert($guid, $post->bill_nr, $post->date, $post->seller,  $post->custid, $post->gross_amt, $post->grand_total, $post->bid, $post->redeem_type, $post->redeem_value, $loyalty_type == 'POINTS' ? 'P' : 'C', $loyalty_value);
        if ($this->db->affected_rows() > 0) {
            echo "{ \"result\": \"SUCCESS\", \"id\": \"" . $guid . "\"}";
        } else
            echo "Unable to process request";
    }
}
