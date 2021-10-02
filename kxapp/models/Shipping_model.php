<?php

class Shipping_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getShipping($filter, $sort, $pn, $ps)
    {
        $this->db->select('*');
        $this->db->from('shipping');
        $this->db->where("(1=1) " . $filter);
        $this->db->order_by($sort);
        $this->db->limit($ps, $pn);
        $query = $this->db->get();
        return $query;
    }

    public function getShippingCount($filter)
    {
        $this->db->select('*');
        $this->db->from('shipping');
        $this->db->where("(1=1) " . $filter);
        return $this->db->count_all_results();
    }

    public function getShippingId($ship_id)
    {
    	$this->db->select('*');
        $this->db->from('shipping');
        $this->db->where('ship_id', $ship_id);
        $query = $this->db->get();
        return $query;
    }

    public function insert($ship_id, $ship_user_id, $ship_email, $ship_mobile, $ship_street, $ship_city, $ship_district, $ship_state, $ship_pincode)
    {
        $idata = array(
            'ship_id' => $ship_id,
            'ship_user_id' => $ship_user_id,
            'ship_email' => $ship_email,
            'ship_mobile' => $ship_mobile,
            'ship_street' => $ship_street,
            'ship_city' => $ship_city,
            'ship_district' => $ship_district,
            'ship_state' => $ship_state,
            'ship_pincode' => $ship_pincode,
            'ship_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->insert('shipping', $idata);
    }

    public function update($ship_id, $ship_user_id, $ship_email, $ship_mobile, $ship_street, $ship_city, $ship_district, $ship_state, $ship_pincode)
    {
        $idata = array(
            'ship_email' => $ship_email,
            'ship_mobile' => $ship_mobile,
            'ship_street' => $ship_street,
            'ship_city' => $ship_city,
            'ship_district' => $ship_district,
            'ship_state' => $ship_state,
            'ship_pincode' => $ship_pincode,
            'ship_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->where('ship_id', $ship_id);
        $this->db->update('shipping', $idata);
    }

    public function setDefault($ship_id, $ship_user_id)
    {
        $idata = array(
            'ship_default' => 1,
            'ship_modified' => mdate("%Y-%m-%d %H:%i:%s", time()),
        );
        $this->db->where('ship_id', $ship_id);
        $this->db->update('shipping', $idata);
    }

    public function delete($ship_id)
    {
        $this->db->where('ship_id', $ship_id);
        $this->db->delete('shipping');
    }

}