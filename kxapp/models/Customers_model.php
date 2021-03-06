<?php

class Customers_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getCustomers($filter, $sort, $pn, $ps)
    {
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where("(1=1) " . $filter);
        $this->db->order_by($sort);
        $this->db->limit($ps, $pn);
        $query = $this->db->get();
        return $query;
    }

    public function getCustomersCount($filter)
    {
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where("(1=1) " . $filter);
        return $this->db->count_all_results();
    }

    public function getCustomerById($customer_id)
    {
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get();
        return $query;
    }

    public function getCustomerByMobile($customer_mobile)
    {
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where('customer_mobile', $customer_mobile);
        $query = $this->db->get();
        return $query;
    }

    public function insert($customer_id, $customer_name, $customer_mobile,  $customer_email, $customer_address)
    {
        $idata = array(
            'customer_id' => $customer_id,
            'customer_name' => $customer_name,
            'customer_mobile' => $customer_mobile,
            'customer_email' => $customer_email,
            'customer_address' => $customer_address,
            'customer_points' => 0,
            'customer_cashback' => 0,
            'customer_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->insert('customers', $idata);
    }

    public function update($customer_id, $customer_name, $customer_mobile,  $customer_email, $customer_address)
    {
        $idata = array(
            'customer_name' => $customer_name,
            'customer_mobile' => $customer_mobile,
            'customer_email' => $customer_email,
            'customer_address' => $customer_address,
            'customer_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->where('customer_id', $customer_id);
        $this->db->update('customers', $idata);
    }

    public function addPoints($customer_mobile, $customer_points)
    {
        $this->db->set('customer_points', 'customer_points+' . $customer_points, FALSE);
        $this->db->set('customer_modified', mdate("%Y-%m-%d %H:%i:%s", time()));
        $this->db->where('customer_mobile', $customer_mobile);
        $this->db->update('customers');
    }

    public function deductPoints($customer_mobile, $customer_points)
    {
        $this->db->set('customer_points', 'customer_points-' . $customer_points, FALSE);
        $this->db->set('customer_modified', mdate("%Y-%m-%d %H:%i:%s", time()));
        $this->db->where('customer_mobile', $customer_mobile);
        $this->db->update('customers');
    }

    public function addCashBack($customer_mobile, $customer_cashback)
    {
        $this->db->set('customer_cashback', 'customer_cashback+' . $customer_cashback, FALSE);
        $this->db->set('customer_modified', mdate("%Y-%m-%d %H:%i:%s", time()));
        $this->db->where('customer_mobile', $customer_mobile);
        $this->db->update('customers');
    }

    public function deductCashBack($customer_mobile, $customer_cashback)
    {
        $this->db->set('customer_cashback', 'customer_cashback-' . $customer_cashback, FALSE);
        $this->db->set('customer_modified', mdate("%Y-%m-%d %H:%i:%s", time()));
        $this->db->where('customer_mobile', $customer_mobile);
        $this->db->update('customers');
    }

    public function delete($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('customers');
    }
}
