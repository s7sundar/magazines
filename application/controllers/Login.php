<?php

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('login_model', 'login');
	}

	public function index($data = array())
    {
		$user_id=$this->session->userdata('user_id');
		if(empty($user_id)){
			$this->load->view('login/index',$data);
		}
		else{
			redirect('admin');
		}
    }

	 public function authenticate()
	 {
	     $data = array();
	     $params = $this->input->post(NULL, TRUE);
			if(sizeof($params)){
				$data = $this->login->authenticate($params);
				if($data['status']){
					$this->session->set_userdata($data['result']);
					redirect('admin/add');
				}
				else{
					$this->index($data);
				}
			}
			else{
				redirect(site_url('/login'));
			}
	 }

	 public function logout()
	 {
		   $val=array('user_id','user_role','email');
		   $this->session->unset_userdata($val);
		   $this->index();
	 }
 }
