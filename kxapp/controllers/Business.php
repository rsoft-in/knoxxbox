<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Business extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('business_model');
    }

    public function index()
    {
        echo 'Invalid Access!';
    }

    public function get()
    {
        $data = json_decode($this->input->post('postdata'));
        $business = $this->business_model->getBusinessByUserId($data->uid);
        if ($business->num_rows() == 1) {
            $prow = $business->row();
            $dataArray = array(
                'id' => $prow->b_id,
                'name' => $prow->b_name,
                'email' => $prow->b_email,
                'mobile' => $prow->b_mobile,
                'address' => $prow->b_address,
                'city' => $prow->b_city,
                'pincode' => $prow->b_pincode,
                'state' => $prow->b_state,
                'attributes' => $prow->b_attributes
            );
            echo json_encode($dataArray);
        } else {
            echo 'INVALID-REQUEST';
        }
    }

    public function update()
    {
        $data = json_decode($this->input->post('postdata'));
        $key = implode('-', str_split(substr(strtolower(md5(microtime() . rand(1000, 9999))), 0, 30), 6));
        if ($data->mode === "add") {
            $this->business_model->insert($key, $data->uid, $data->name, $data->mobile,  $data->email, $data->address, $data->city, $data->pincode, $data->state, $data->attributes);
            if ($this->db->affected_rows() > 0) {
                echo "SUCCESS";
            } else
                echo "Unable to process request";
        } else {
            $this->business_model->update($data->id, $data->uid, $data->name, $data->mobile, $data->email, $data->address, $data->city, $data->pincode, $data->state, $data->attributes);
            if ($this->db->affected_rows() > 0) {
                echo "SUCCESS";
            } else
                echo "Unable to process request";
        }
    }
}
