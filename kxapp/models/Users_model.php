<?php

class Users_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getUsers($filter, $sort, $pn, $ps)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("(1=1) " . $filter);
        $this->db->order_by($sort);
        $this->db->limit($ps, $pn);
        $query = $this->db->get();
        return $query;
    }

    public function getUsersCount($filter)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("(1=1) " . $filter);
        return $this->db->count_all_results();
    }

    public function getUserByUserId($user_id)
    {
    	$this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query;
    }

    public function getUserByMobile($user_mobile)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_mobile', $user_mobile);
        $query = $this->db->get();
        return $query;
    }

    public function getUserByEmail($user_email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_email', $user_email);
        $query = $this->db->get();
        return $query;
    }

    public function getUserByEmailMobile($user_email, $user_mobile)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_email', $user_email);
        $this->db->or_where('user_mobile', $user_mobile);
        $query = $this->db->get();
        return $query;
    }

    public function insert($user_id, $user_email, $user_mobile, $user_name, $user_pwd)
    {
        $idata = array(
            'user_id' => $user_id,
            'user_email' => $user_email,
            'user_mobile' => $user_mobile,
            'user_name' => $user_name,
            'user_pwd' => $user_pwd,
            'user_modified' => mdate("%Y-%m-%d %H:%i:%s", time()),
        );
        $this->db->insert('users', $idata);
    }

    public function update($user_id, $user_mobile, $user_name, $user_pwd)
    {
        $idata = array(
            'user_mobile' => $user_mobile,
            'user_name' => $user_name,
            'user_modified' => mdate("%Y-%m-%d %H:%i:%s", time()),
            'user_pwd' => $user_pwd
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $idata);
    }

    public function updateOtp($user_email, $user_otp)
    {
        $idata = array(
            'user_otp' => $user_otp,
            'user_modified' => mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->where('user_email', $user_email);
        $this->db->update('users', $idata);
    }

    public function activate($user_email)
    {
        $idata = array(
            'user_active' => 1,
            'user_modified' => mdate("%Y-%m-%d %H:%i:%s", time()),
        );
        $this->db->where('user_email', $user_email);
        $this->db->update('users', $idata);
    }

    public function delete($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('users');
    }

}