<?php

class Admin_model extends CI_Model
{
    public function save($params, $files)
    {
      $data = array(
        'status'=>false,
        'msg'=>'Failed to create the records.'
      );
      $files['mag_tamil_cover'] = str_replace(
        FCPATH, '',$files['mag_tamil_cover']
      );
      $files['mag_file_path'] = str_replace(
        FCPATH, '',$files['mag_file_path']
      );
      $insert = array();
      $insert['mag_date'] = $params['mag_date'];
      $insert['mag_eng_name'] = $params['mag_eng_name'];
      $insert['mag_tamil_title'] = $params['mag_tamil_title'];
      $insert['mag_tamil_desc'] = $params['mag_tamil_desc'];
      $insert['mag_tamil_cover'] = $files['mag_tamil_cover'];
      $insert['mag_file'] = $files['mag_file_path'];
      $insert['mag_file_path'] = $files['mag_file_path'];
      $insert['user_id'] = $this->session->userdata('user_id');
      $insert['ctime'] = time();
      if($this->db->insert('magazines', $insert)) {
        $data = array(
          'status'=>true,
          'msg'=>'Record created successfully.'
        );
      }
      return $data;
    }

    public function get_records($params)
    {
      $result = array ();
  		$where = $orderby = '';
  		$result ['aaData'] = array ();
  		$sql = "SELECT mag_id,mag_date, mag_eng_name,mag_tamil_title,
  					mag_tamil_desc,mag_tamil_cover,mag_file
             FROM magazines WHERE 1=1 ";

  		$cql = "SELECT COUNT(mag_id) AS cnt
        				FROM magazines WHERE 1=1 ";

  		if (isset ( $params ['sSearch'] ) && ! empty ( $params ['sSearch'] )) {
  			$sStr = $this->db->escape_like_str($params ['sSearch']);
  			$where = " AND (mag_eng_name LIKE '%{$sStr}%'
  			OR mag_tamil_title = '{$sStr}' OR mag_tamil_desc = '{$sStr}'
        OR mag_id = '{$sStr}' OR mag_date = '{$sStr}')";
  		}

  		$result ['sEcho'] = intval($params['sEcho']);
  		switch ($params ['iSortCol_0']) {
  			case 0 :
  				$orderby = " ORDER BY mag_id " . strtoupper ( $params ['sSortDir_0'] );
  				break;

  			case 1 :
  				$orderby = " ORDER BY mag_date " . strtoupper ( $params ['sSortDir_0'] );
  				break;

  			case 2 :
  				$orderby = " ORDER BY mag_eng_name " . strtoupper ( $params ['sSortDir_0'] );
  				break;

  			case 3 :
  				$orderby = " ORDER BY mag_tamil_title " . strtoupper ( $params ['sSortDir_0'] );
  				break;

  			case 4 :
  				$orderby = " ORDER BY mag_tamil_desc " . strtoupper ( $params ['sSortDir_0'] );
  				break;

  			default :
  				$orderby = " ORDER BY ctime DESC";
  				break;
  		}

  		$cql .= $where;
  		$sql .= $where . $orderby;
  		if (isset ( $params ['iDisplayStart'] ) &&
  			is_numeric ( $params ['iDisplayStart'] )
  			&& isset ( $params ['iDisplayLength'] )
  			&& is_numeric ( $params ['iDisplayLength'] )
  			&& $params ['iDisplayLength'] > 0) {
  			$sql .= " LIMIT ".$params ['iDisplayStart'].",".$params ['iDisplayLength'];
  		} else {
  			$sql .= " LIMIT 0, 10";
  		}
      log_message('error', $sql);
  		$rs = $this->db->query ($sql);
  		$cnt = $this->db->query ($cql)->row_array ();
  		$result ['iTotalRecords'] = $result ['iTotalDisplayRecords'] = $cnt ['cnt'];
  		if ($rs->num_rows () > 0) {
  			foreach ( $rs->result () as $row ) {
  				$links = '';
          $links .= '<a  href="'.site_url($row->mag_tamil_cover).'" class="btn btn-xs btn-default pop-up-dialog">';
  				$links .= '<i class="glyphicon glyphicon-picture"> </i>&nbsp;Cover</a>';
          $links .= '<a target="_blank" href="'.site_url($row->mag_file).'" class="btn btn-xs btn-default">';
  				$links .= '<i class="glyphicon glyphicon-search"> </i>&nbsp;View</a>';
  				$links .= '<a  href="'.site_url('admin/delete/'.$row->mag_id).'" class="btn btn-xs btn-default delete">';
  				$links .= '<i class="glyphicon glyphicon-trash"> </i>&nbsp;Delete</a>';

  				$result ['aaData'] [] = array (
  						$row->mag_id,
  						$row->mag_date,
  						$row->mag_eng_name,
              $row->mag_tamil_title,
  						$row->mag_tamil_desc,
  						$links
  				);
  			}
  		}
  		return $result;
    }

    public function delete($mag_id)
    {
      $data = array('status'=>'false', 'msg'=>'Failed to delete the record');
      if($this->db->delete('magazines', array('mag_id'=>$mag_id))) {
        $data['status'] = true;
        $data['msg'] = 'Record deleted successfully!';
      }
      return $data;
    }

    public function get_mags($limit)
    {
      $sql = 'SELECT * FROM magazines ORDER BY mag_date DESC LIMIT '.$limit;
      $result = $this->db->query($sql);
      return $result->result_array();
    }

    public function mag_details($mag_id)
    {
      return $this->db->get_where('magazines', array(
        'mag_id'=>$mag_id))->row_array();
    }

    public function search($params)
  	{
  		$data = array();
  		$sql = 'SELECT mag_id,mag_eng_name,
      mag_file_path,mag_tamil_title FROM magazines'.
  		' WHERE mag_eng_name LIKE "%'.$params['term'].'%"
      OR mag_tamil_title LIKE "%'.$params['term'].'%"
      OR mag_tamil_desc LIKE "%'.$params['term'].'%" LIMIT 10';
  		$oResult = $this->db->query($sql);

  		if($oResult && $oResult->num_rows() > 0) {
  			foreach ($oResult->result() as $oRow) {
  				$aItem = array();
          $aItem['mag_id'] = $oRow->mag_id;
          $aItem['mag_eng_name'] = $oRow->mag_eng_name;
          $aItem['mag_tamil_title'] = $oRow->mag_tamil_title;
          $aItem['mag_file_path'] = $oRow->mag_file_path;
          $aItem['value'] = strtoupper($oRow->mag_eng_name);
          $data[] = $aItem;
  			}
  		}
  		return $data;
  	}
}
