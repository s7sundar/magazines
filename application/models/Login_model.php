<?php

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function authenticate($params)
    {
       $data = array();
       $data['status']=FALSE;
       $data['msg']="Invalid Email / Password";
       $sql='SELECT * FROM user_login WHERE email=?
       AND password=? AND user_role="Admin"';
       $result =$this->db->query($sql,array(
            $params['email'],md5($params['password'])
       ));

       if($result->num_rows()>0) {
          $row = $result->row_array();
            if($row['status']){
                $data['status'] = TRUE;
                $data['result']['user_id'] =$row['user_id'];
                $data['result']['email'] =$row['email'];
                $data['result']['user_role'] =$row['user_role'];
            }
            else {
                $data['status']=FALSE;
                $data['msg']="Accout is Blocked Contact Administrator";
            }
       }
       return $data;
    }  

}
