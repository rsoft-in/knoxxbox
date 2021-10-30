<?php

class Loyalty extends RS_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('loyalty_model');
    }

    public function index()
    {
        echo 'Invalid Access!';
    }

    public function get()
    {
        $data = json_decode($this->input->post('postdata'));
        $filt = "";
        $item_array = array();
        if (!empty($data->bid))
            $filt .= "AND (loyalty_b_id = '" . $data->bid . "')";

        $loyalty = $this->loyalty_model->getLoyalty($filt, 'loyalty_modified DESC', $data->pn * $data->ps, $data->ps);
        if ($loyalty->num_rows() > 0) {
            foreach ($loyalty->result() as $row) {
                $_item = array(
                    'loyalty_id' => $row->loyalty_id,
                    'loyalty_default' => $row->loyalty_default,
                    'loyalty_params' => $row->loyalty_params,
                    'loyalty_modified' => $row->loyalty_modified
                );
                $item_array[] = $_item;
            }
        }
        echo json_encode($item_array);
    }

    public function getById()
    {
        $id = $this->input->post('id');
        $res = $this->loyalty_model->getLoyaltyById($id);
        if ($res->num_rows() == 1) {
            $prow = $res->row();
            $dataArray = array(
                'loyalty_id' => $prow->loyalty_id,
                'loyalty_default' => $prow->loyalty_default,
                'loyalty_params' => $prow->loyalty_params,
                'loyalty_modified' => $prow->loyalty_modified
            );
            echo json_encode($dataArray);
        } else {
            echo 'NOT FOUND';
        }
    }

    public function update() {
		$data = json_decode ( $this->input->post ( 'postdata' ) );
		$guid = $this->utility->guid ();
		if ($data->mode === "add") {
			$this->loyalty_model->insert ( $guid, $data->bid, $data->df, $data->param );
			if ($this->db->affected_rows () > 0) {
				echo "SUCCESS";
			} else
				echo "Unable to process request";
		} else {
			$this->loyalty_model->update ( $data->id, $data->bid, $data->df, $data->param );
			if ($this->db->affected_rows () > 0) {
				echo "SUCCESS";
			} else
				echo "Unable to process request";
		}
	}

    public function delete() {
		$data = json_decode ( $this->input->post ( 'postdata' ) );
		$this->loyalty_model->delete ( $data->id );
		if ($this->db->affected_rows () > 0) {
			echo "SUCCESS";
		} else
			echo "Unable to process request";
	}
}
