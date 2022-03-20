<?php

class Transactions_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getTransactions($filter, $sort, $pn, $ps)
    {
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->where("(1=1) " . $filter);
        $this->db->order_by($sort);
        $this->db->limit($ps, $pn);
        $query = $this->db->get();
        return $query;
    }

    public function getTransactionsCount($filter)
    {
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->where("(1=1) " . $filter);
        return $this->db->count_all_results();
    }

    public function insert($idata)
    {
        $this->db->insert('transactions', $idata);
    }

    public function update($idata, $tr_id)
    {
        $this->db->where('tr_id', $tr_id);
        $this->db->update('transactions', $idata);
    }

    public function delete($tr_id)
    {
        $this->db->where('tr_id', $tr_id);
        $this->db->delete('transactions');
    }
}
