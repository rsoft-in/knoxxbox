<?php

class Business_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getBusiness($filter, $sort, $pn, $ps)
    {
        $this->db->select('*');
        $this->db->from('business');
        $this->db->where("(1=1) " . $filter);
        $this->db->order_by($sort);
        $this->db->limit($ps, $pn);
        $query = $this->db->get();
        return $query;
    }

    public function getBusinessCount($filter)
    {
        $this->db->select('*');
        $this->db->from('business');
        $this->db->where("(1=1) " . $filter);
        return $this->db->count_all_results();
    }

    public function getBusinessById($b_id)
    {
    	$this->db->select('*');
        $this->db->from('business');
        $this->db->where('b_id', $b_id);
        $query = $this->db->get();
        return $query;
    }

    public function getBusinessByUserId($b_user_id)
    {
    	$this->db->select('*');
        $this->db->from('business');
        $this->db->where('b_user_id', $b_user_id);
        $query = $this->db->get();
        return $query;
    }

    public function getBusinessByMobileEmail($b_mobile, $b_email)
    {
        $this->db->select('*');
        $this->db->from('business');
        $this->db->where('b_mobile', $b_mobile);
        $this->db->or_where('b_email', $b_email);
        $query = $this->db->get();
        return $query;
    }

    public function getBusinessByEmail($b_email)
    {
        $this->db->select('*');
        $this->db->from('business');
        $this->db->where('b_email', $b_email);
        $query = $this->db->get();
        return $query;
    }

    public function insert($b_id, $b_user_id, $b_name, $b_mobile,  $b_email, $b_address, $b_city, $b_pincode, $b_state, $b_attributes)
    {
        $idata = array(
            'b_id' => $b_id,
            'b_user_id' => $b_user_id,
            'b_name' => $b_name,
            'b_mobile' => $b_mobile,
            'b_email' => $b_email,
            'b_address' => $b_address,
            'b_city' => $b_city,
            'b_pincode' => $b_pincode,
            'b_state' => $b_state,
            'b_attributes' => $b_attributes,
            'b_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->insert('business', $idata);
    }

    public function update($b_id, $b_user_id, $b_name, $b_mobile,  $b_email, $b_address, $b_city, $b_pincode, $b_state, $b_attributes)
    {
        $idata = array(
            'b_user_id' => $b_user_id,
            'b_name' => $b_name,
            'b_mobile' => $b_mobile,
            'b_email' => $b_email,
            'b_address' => $b_address,
            'b_city' => $b_city,
            'b_pincode' => $b_pincode,
            'b_state' => $b_state,
            'b_attributes' => $b_attributes,
            'b_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->where('b_id', $b_id);
        $this->db->update('business', $idata);
    }

    public function delete($b_id)
    {
        $this->db->where('b_id', $b_id);
        $this->db->delete('business');
    }

}