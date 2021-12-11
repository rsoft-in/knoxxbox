<?php

class Billing_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getBilling($filter, $sort, $pn, $ps)
    {
        $this->db->select('*');
        $this->db->from('billing');
        $this->db->where("(1=1) " . $filter);
        $this->db->order_by($sort);
        $this->db->limit($ps, $pn);
        $query = $this->db->get();
        return $query;
    }

    public function getBillingCount($filter)
    {
        $this->db->select('*');
        $this->db->from('billing');
        $this->db->where("(1=1) " . $filter);
        return $this->db->count_all_results();
    }

    public function getBillingByNr($bill_nr)
    {
        $this->db->select('*');
        $this->db->from('billing');
        $this->db->where('bill_nr', $bill_nr);
        $query = $this->db->get();
        return $query;
    }

    public function insert($bill_id, $bill_nr, $bill_date, $bill_seller, $bill_customer_id, $bill_gross_amount, $bill_grand_total, $bill_bid, $bill_redeem_type, $bill_redeem_value, $bill_loyalty_type, $bill_loyalty_value)
    {
        $idata = array(
            'bill_id' => $bill_id,
            'bill_nr' => $bill_nr,
            'bill_date' => $bill_date,
            'bill_seller' => $bill_seller,
            'bill_customer_id' => $bill_customer_id,
            'bill_gross_amount' => $bill_gross_amount,
            'bill_grand_total' => $bill_grand_total,
            'bill_bid' => $bill_bid,
            'bill_redeem_type' => $bill_redeem_type,
            'bill_redeem_value' => $bill_redeem_value,
            'bill_loyalty_type' => $bill_loyalty_type,
            'bill_loyalty_value' => $bill_loyalty_value
        );
        $this->db->insert('billing', $idata);
    }

    public function update($bill_nr, $bill_date, $bill_seller, $bill_customer_id, $bill_gross_amount, $bill_grand_total, $bill_bid, $bill_redeem_type, $bill_redeem_value, $bill_loyalty_type, $bill_loyalty_value)
    {
        $idata = array(
            'bill_date' => $bill_date,
            'bill_seller' => $bill_seller,
            'bill_customer_id' => $bill_customer_id,
            'bill_gross_amount' => $bill_gross_amount,
            'bill_grand_total' => $bill_grand_total,
            'bill_bid' => $bill_bid,
            'bill_redeem_type' => $bill_redeem_type,
            'bill_redeem_value' => $bill_redeem_value,
            'bill_loyalty_type' => $bill_loyalty_type,
            'bill_loyalty_value' => $bill_loyalty_value
        );
        $this->db->where('bill_nr', $bill_nr);
        $this->db->update('billing', $idata);
    }

    public function cancel($bill_nr)
    {
        $idata = array(
            'bill_cancelled' => 1
        );
        $this->db->where('bill_nr', $bill_nr);
        $this->db->update('billing', $idata);
    }

    public function delete($bill_nr)
    {
        $this->db->where('bill_nr', $bill_nr);
        $this->db->delete('billing');
    }
}
