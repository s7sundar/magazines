<?php
error_reporting(0);

class Api
{
    private $CI;
    private $token;
    private $app_key;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->app_key = sha1('ThirU&Kural2');
    }

    public function android_request($type,$params)
    {
        if(!isset($params['token']) || 
            !isset($params['app_key']) || 
                (isset($params['app_key']) && $params['app_key'] != $this->app_key) || 
                    !$this->is_valid_request($params, $type)) {
            $data = array();
            $data['status'] = 0;
            $data['msg'] = 'Invalid Request.';            
            $this->token = isset($params['token'])?$params['token']:'';
            $this->response($data);
            exit(0);
        }
        $this->token = $params['token'];
        //$this->archive($params, $type);
        return $params;
    }

    public function request($type)
    {
        $params = $this->CI->input->post(null, true);		
        if(!isset($params['token']) || 
            !isset($params['app_key']) || 
                (isset($params['app_key']) && $params['app_key'] != $this->app_key) || 
                    !$this->is_valid_request($params, $type)) {
            $data = array();
            $data['status'] = 0;
            $data['msg'] = 'Invalid Request.';            
            $this->token = isset($params['token'])?$params['token']:'';
            $this->response($data);
            exit(0);
        }
        $this->token = $params['token'];
        $this->archive($params, $type);
        return $params;
    }
    
    public function response($data)
    {
        $data['token'] = $this->token;
        header_remove();
        echo json_encode($data);
    }

    public function is_valid_request($params, $type)
    {
        if($type != 'login' && 
            (!isset($params['api_key']) || strlen($params['api_key'])!=32)) {
            return false;
        }        
        return true;
    }

    private function archive($params, $type)
    {
        $data = array();
        $data['user_id'] = ($type=='login')?0:$params['user_id'];
        $data['api_key'] = ($type=='login')?null:$params['api_key'];
        $data['json_dump'] = is_array($params)?json_encode($params):null;
        $data['request_type'] = $type;
        $data['mtime'] = time();
        $sTable = $this->getTable();
        $this->CI->db->insert($sTable, $data);
    }

    private function getTable()
    {
        $sTable = 'raw_dump_archive_'.date('Y');
        if(!$this->CI->db->table_exists($sTable)) {
            $sql = "CREATE TABLE {$sTable} (
            `archive_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `api_key` char(40) DEFAULT NULL,
            `json_dump` varchar(1000) DEFAULT NULL,
            `request_type` char(16) DEFAULT NULL,
            `mtime` int(11) NOT NULL,
            PRIMARY KEY (`archive_id`)
            ) ENGINE=ARCHIVE DEFAULT CHARSET=latin1";
            $this->CI->db->query($sql);
        }
        return $sTable;
    }
}
