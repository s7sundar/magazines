<?php

class Admin extends CI_Controller
{
    private $aHead = array();
    public function __construct()
    {
        parent::__construct();
        $this->aHead['title'] = 'Add New Magazine';
    		$this->aHead['sURLAdd'] = site_url('admin/add');
    		$this->aHead['sURLView'] = site_url('admin/list-all');
        $user_id = $this->session->userdata('user_id');
        if(empty($user_id)) {
            redirect('/login');
            exit(0);
        }
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        redirect(site_url('/admin/add'));
        exit(0);
    }

    public function add($data=array())
    {
        $this->aHead['sActive'] = 'add';
        $this->load->view('temp/header', $this->aHead);
        $this->load->view('admin/add', $data);
        $this->load->view('temp/footer');
    }

    public function save()
    {
      $files = array();
      $params = $this->input->post(null, true);
      $cover = $this->upload_cover($params['mag_date']);
      if(!$cover['status']) {
        $this->add($cover);        
      }
      else {
        $files['mag_tamil_cover'] = $cover['file_path'];
        $files['mag_file_path'] = $params['mag_file_path'];
        if(isset($_FILES['mag_file']) &&
          isset($_FILES['mag_file']['name']) &&
            !empty($_FILES['mag_file']['name'])) {
            $mag_file = $this->upload_file($params['mag_date']);
            if(!$mag_file['status']) {
              $this->add($mag_file);              
            }
            else {
              $files['mag_file_path'] = $mag_file['file_path'];
              $data = $this->admin->save($params, $files);
              $this->add($data);
            }          
        }
        else {
          $data = $this->admin->save($params, $files);
          $this->add($data);
        }
        
      }
      
    }

    private function upload_cover($date)
    {
      $file_path = FCPATH.'magazines/covers/'.$date;
      if(!is_dir($file_path)) {
        mkdir($file_path, 0777, TRUE);
      }

      $data = array('status'=>false, 'msg'=>'', 'file_path'=>'');
      $config['upload_path']          = $file_path;
      $config['allowed_types']        = 'gif|jpg|jpeg|png';
      $config['max_width']            = 245;
      $config['max_height']           = 205;
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('mag_tamil_cover')) {
          $data['msg'] = $this->upload->display_errors();
      } else {
          $data['status'] = true;
          $data['file_path'] = $this->upload->data('full_path');
      }      
      return $data;
    }

    private function upload_file($date)
    {
      $file_path = FCPATH.'/magazines/files/'.$date;
      if(!is_dir($file_path)) {
        mkdir($file_path);
      }
      $data = array('status'=>false, 'msg'=>'', 'file_path'=>'');
      $config['upload_path']          = $file_path;
      $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('mag_file')) {
          $data['msg'] = $this->upload->display_errors();
      } else {
          $data['status'] = true;
          $data['file_path'] = $this->upload->data('full_path');
      }
      return $data;
    }

    public function list_all()
    {
      $this->aHead['sActive'] = 'view';
      $this->aHead['title'] = 'List All Magazines';
      $this->load->view('temp/header', $this->aHead);
      $this->load->view('admin/list');
      $this->load->view('temp/footer');
    }

    public function get_records()
    {
      $params = $this->input->post(null, true);
      $data = $this->admin->get_records($params);
      echo json_encode($data);
    }

    public function delete($mag_id)
    {
      if($this->input->is_ajax_request()) {
        $data = $this->admin->delete($mag_id);
        echo json_encode($data);
      }
      else {
        redirect(site_url('login/logout'));
      }
    }
}
