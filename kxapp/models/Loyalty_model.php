<?php

class Loyalty_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getLoyalty($filter, $sort, $pn, $ps)
    {
        $this->db->select('*');
        $this->db->from('loyalty');
        $this->db->where("(1=1) " . $filter);
        $this->db->order_by($sort);
        $this->db->limit($ps, $pn);
        $query = $this->db->get();
        return $query;
    }

    public function getLoyaltyCount($filter)
    {
        $this->db->select('*');
        $this->db->from('loyalty');
        $this->db->where("(1=1) " . $filter);
        return $this->db->count_all_results();
    }

    public function getLoyaltyById($loyalty_id)
    {
        $this->db->select('*');
        $this->db->from('loyalty');
        $this->db->where('loyalty_id', $loyalty_id);
        $query = $this->db->get();
        return $query;
    }

    public function getLoyaltyDefault($loyalty_b_id)
    {
        $this->db->select('*');
        $this->db->from('loyalty');
        $this->db->where('loyalty_b_id', $loyalty_b_id);
        $this->db->where('loyalty_default', 1);
        $query = $this->db->get();
        return $query;
    }

    public function insert($loyalty_id, $loyalty_b_id, $loyalty_name, $loyalty_default, $loyalty_params)
    {
        $idata = array(
            'loyalty_id' => $loyalty_id,
            'loyalty_b_id' => $loyalty_b_id,
            'loyalty_name' => $loyalty_name,
            'loyalty_default' => $loyalty_default,
            'loyalty_params' => $loyalty_params,
            'loyalty_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->insert('loyalty', $idata);
    }

    public function update($loyalty_id, $loyalty_name, $loyalty_params)
    {
        $idata = array(
            'loyalty_name' => $loyalty_name,
            'loyalty_params' => $loyalty_params,
            'loyalty_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->where('loyalty_id', $loyalty_id);
        $this->db->update('loyalty', $idata);
    }

    public function setDefault($loyalty_id)
    {
        $this->db->set('loyalty_default', "CASE WHEN loyalty_id = '" . $loyalty_id . "' THEN 1 ELSE 0 END", FALSE);
        $this->db->set('loyalty_modified', mdate("%Y-%m-%d %H:%i:%s", time()));
        $this->db->update('loyalty');
    }

    public function delete($loyalty_id) {
		$this->db->where ( 'loyalty_id', $loyalty_id );
		$this->db->delete ( 'loyalty' );
	}
}
