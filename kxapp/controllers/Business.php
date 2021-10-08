<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Business extends RS_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('business_model');
    }
    public function index()
    {
        $data = array(
            'title' => 'Business',
            'content' => 'business_view'
        );
        $this->load->view('template', $data);
    }

    public function get()
    {
        $business = $this->business_model->getBusinessByUserId($_SESSION["kx_user_id"]);
        if ($business->num_rows() == 1) {
            $brow = $business->row();
            $_SESSION["kx_business_id"] = $brow->b_id;
            $_SESSION["kx_business_name"] = $brow->b_name;
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
        } else {
            echo 'NOT-FOUND';
        }
    }

    public function update() {
        $data = json_decode ( $this->input->post ( 'postdata' ) );
		$key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
		if ($data->mode === "add") {
			$this->business_model->insert ( $key, $_SESSION["kx_user_id"], $data->name, $data->mobile,  $data->email, $data->address, $data->city, $data->pincode, $data->state, $data->attributes );
			if ($this->db->affected_rows () > 0) {
				echo "SUCCESS";
			} else
				echo "Unable to process request";
		} else {
			$this->business_model->update ( $data->id, $_SESSION["kx_user_id"], $data->name, $data->mobile, $data->email, $data->address, $data->city, $data->pincode, $data->state, $data->attributes );
			if ($this->db->affected_rows () > 0) {
				echo "SUCCESS";
			} else
				echo "Unable to process request";
		}
    }
}
