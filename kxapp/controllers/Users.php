<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

	public function getUserByEmail()
	{
		$data = json_decode($this->input->post('postdata'));
		// TODO: make some dynamic password that nobody can guess
		$user = array();
		$dd = "";
		$un = strtolower($data->un);
		if (($un == "rsoft" && $data->up == "Elia1092" . $dd)) {
			$user = array(
				'user_id' => $un,
				'user_email' => 'sales@knoxxbox.in',
				'user_mobile' => '7032055706',
				'user_name' => $un,
				'user_pwd' => '',
				'user_otp' => '',
				'user_active' => 1,
				'user_modified' => mdate('%Y-%m-%d', time()),
				'user_level' => 5
			);
			echo json_encode($user);
		} else {
			$ures = $this->users_model->getUserByEmail($un);
			if ($ures->num_rows() == 1) {
				$prow = $ures->row();
				if ($this->encryption->decrypt($prow->user_pwd) == $data->up) {
					$user = array(
						'user_id' => $prow->user_id,
						'user_email' => $prow->user_email,
						'user_mobile' => $prow->user_mobile,
						'user_name' => $prow->user_name,
						'user_pwd' => $this->encryption->decrypt($prow->user_pwd),
						'user_otp' => $prow->user_otp,
						'user_active' => $prow->user_active,
						'user_modified' => mdate('%Y-%m-%d', strtotime($prow->user_modified)),
						'user_level' => 1
					);
					echo json_encode($user);
				} else {
					echo $this->lang->line('invalid_login'); // username not found
				}
			} else {
				echo $this->lang->line('invalid_login'); // username not found
			}
		}
	}

	public function createUser()
	{
		$data = json_decode($this->input->post('postdata'));
		$vcode = mt_rand(100000, 999999);
		$res = $this->users_model->getUserByEmailMobile($data->email, $data->mobile);

		if ($res->num_rows() == 1) {
			$user = $res->row();
			if ($user->user_active == 1)
				echo 'E-Mail/Mobile already registered';
			else {
				$codeSent = $this->sendEmailVerification($user->user_email, $user->user_name, $vcode);
				if ($codeSent) {
					$this->users_model->update($user->user_id, $data->mobile, $data->name, $this->encryption->encrypt($data->pwd));
					$this->users_model->updateOtp($data->email, $vcode);
					echo 'SUCCESS';
				} else {
					echo $this->email->print_debugger(array('headers'));
				}
			}
			return;
		} else {
			$codeSent = $this->sendEmailVerification($data->email, $data->name, $vcode);
			if (!$codeSent) {
				echo $this->email->print_debugger(array('headers'));
				return;
			} else {
				$uid = $this->utility->guid();
				$this->users_model->insert($uid, $data->email, $data->mobile, $data->name, $this->encryption->encrypt($data->pwd));
				if ($this->db->affected_rows() > 0) {
					$this->users_model->updateOtp($data->email, $vcode);
					echo 'SUCCESS';
				} else {
					echo "Unable to process request";
					return;
				}
			}
		}
	}

	public function verifyOtp()
	{
		$data = json_decode($this->input->post('postdata'));
		$user = $this->users_model->getUserByEmail($data->email);
		if ($user->num_rows() == 1) {
			$row = $user->row();
			if ($row->user_otp == $data->otp) {
				$this->users_model->activate($data->email);
				echo 'SUCCESS';
			} else {
				echo 'FAILED';
			}
		} else {
			echo 'FAILED';
		}
	}

	private function sendEmailVerification($email, $displayName, $otp)
	{
		$data = json_decode($this->input->post('postdata'));
		$this->load->library('email');
		$this->load->model('users_model');

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.knoxxbox.in';
		$config['smtp_port'] = '587';
		$config['smtp_user'] = 'sales@knoxxbox.in';
		$config['smtp_pass'] = 'Godzilla0410';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n";

		$this->email->initialize($config);
		$this->email->from('sales@knoxxbox.in', 'Knoxxbox CLP');
		$this->email->to($email);
		$this->email->subject("Welcome to Knoxxbox");
		$this->email->message("<p>Dear " . $displayName . ",</p><p>Welcome to Knoxxbox. Your verification code is <b>" . $otp . "</b>.</p><p>Administrator<br>Knoxxbox</p>");
		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}

	public function changePwd()
	{
		$data = json_decode($this->input->post('postdata'));
		$user = $this->users_model->updatePassword($data->uid, $this->encryption->encrypt($data->pwd) );
		if ($this->db->affected_rows() > 0) {
			echo 'SUCCESS';
		} else {
			echo "Unable to process request";
		}
	}
}
