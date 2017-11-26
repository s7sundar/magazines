<?php

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin_model', 'admin');
  }

  public function index()
  {
    $data = array();
    $token = mt_rand(100000,99999999);
    $this->session->set_userdata(array('token'=>$token));
    $data['token'] = $token;
    $data['result'] = $this->admin->get_mags(20);
    $this->load->view('home/tmpl1', $data);
  }

  public function download($mag_id, $token)
  {
    $this->load->helper('download');
    $sess_token = $this->session->userdata('token');
    if($sess_token==$token) {
      $data = $this->admin->mag_details($mag_id);
      $file_path = FCPATH.$data['mag_file_path'];
      force_download($file_path, NULL);
    }
    else {
      redirect(site_url());
    }
  }

  public function search_auto_complete()
  {
    $data = array();
		$params =$this->input->post(null, true);
		$data = $this->admin->search($params);
		echo json_encode($data);
  }



}
