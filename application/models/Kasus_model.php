<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Kasus_model extends CI_Model {

public function rulesSave()
{
    return [
      // ['field' => 'id_rs', 'label' => 'id_rs', 'rules' => 'required'],
      ['field' => 'record_case', 'label' => 'id_rs', 'rules' => 'required'],
      ['field' => 'gender_case', 'label' => 'gender_case','rules' => 'required'],
      ['field' => 'age_case', 'label' => 'age_case','rules' => 'required'],
    ];
}

public function rulesUpdate()
{
    return [
      ['field' => 'id_case', 'label' => 'id_case', 'rules' => 'required'],
      ['field' => 'record_case', 'label' => 'id_rs', 'rules' => 'required'],
      //['field' => 'id_rs', 'label' => 'id_rs', 'rules' => 'required'],
      ['field' => 'gender_case', 'label' => 'gender_case','rules' => 'required'],
      ['field' => 'age_case', 'label' => 'age_case','rules' => 'required'],
      ['field' => 'status_case', 'label' => 'status_case','rules' => 'required'],
      ['field' => 'update_date_case', 'label' => 'update_date_case','rules' => 'required']
    ];
}

public function rulesGetId()
{
    return [
      ['field' => 'id_rs', 'label' => 'id_rs', 'rules' => 'required']
    ];
}


public function saveCase($data)
{
  $value = array(
    'id_case' => uniqid(),
    'record_case' =>  $data['record_case'],
    'id_rs' =>$this->session->userdata('id_rs'),
    //'id_rs' => $data['id_rs'], 
    'age_case' => $data['age_case'],  
    'gender_case '  => $data['gender_case'],
    'update_date_case' => date("Y-m-d")
    //'update_date_case' => $data['update_date_case'],
  );
  $this->db->set($value);
  $this->db->insert('dbd_case');
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $value;
    }
}

public function getCaseID($id){
  $this->db->where('dbd_case.id_case', $id);
  //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
  //$this->db->group_by("dbd_rs.id_rs");
  //$this->db->from('dbd_rs');
  //$this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
  //$query = $this->db->get(''); 
    $query = $this->db->get('dbd_case'); 
  $dataCase = $query->row();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $dataCase;
    }
}




public function getCaseRS($id){
    $this->db->where('dbd_case.id_rs', $id);
    //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
    //$this->db->group_by("dbd_rs.id_rs");
    //$this->db->from('dbd_rs');
    //$this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
    //$query = $this->db->get(''); 
    $query = $this->db->get('dbd_case'); 
    $dataCase = $query->result();
    $db_error = $this->db->error();
      if (!empty($db_error['message'])) {
        throw new Exception('Database error! Error: ' . $db_error['message']);
      }
      else{
        return $dataCase;
      }
  }

  public function getCaseActive($loc){
    $this->db->where('dbd_case.status_case', '0');
    if($loc){
      $this->db->where('dbd_rs.region_rs',$loc);
    }
    //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
    //$this->db->group_by("dbd_rs.id_rs");
    //$this->db->from('dbd_rs');
    //$this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
    //$query = $this->db->get(''); 
    $query = $this->db->select("COUNT(id_case) as 'total'"); 
    $this->db->from('dbd_case');
    $this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_case.id_rs','left');
    $query = $this->db->get();
    $count = $query->result();
    $db_error = $this->db->error();
      if (!empty($db_error['message'])) {
        throw new Exception('Database error! Error: ' . $db_error['message']);
      }
      else{
        return $count;
      }
  }

public function getCaseAll($loc){
  if($loc){
    $this->db->where('dbd_rs.region_rs',$loc);
  }
  //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
  //$this->db->select("*");
  //$this->db->group_by("dbd_rs.id_rs");
  // $this->db->from('dbd_case');
  //$this->db->join('dbd_case', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
  $query = $this->db->select("COUNT(id_case) as 'total'"); 
  $this->db->from('dbd_case');
  $this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_case.id_rs','left');
  $query = $this->db->get();
  $count = $query->row();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $count;
    } 
}

public function getCaseDie($loc){
  if($loc){
    $this->db->where('dbd_rs.region_rs',$loc);
  }
  $this->db->where('dbd_case.status_case','2');
  //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
  //$this->db->select("*");
  //$this->db->group_by("dbd_rs.id_rs");
  // $this->db->from('dbd_case');
  //$this->db->join('dbd_case', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
  $query = $this->db->select("COUNT(id_case) as 'total'"); 
  $this->db->from('dbd_case');
  $this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_case.id_rs','left');
  $query = $this->db->get();
  $count = $query->row();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $count;
    } 
}

public function getLocation($loc){
  if($loc){
    $this->db->where('dbd_rs.region_rs',$loc);
  }
  $this->db->where('dbd_case.status_case','0');
  //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
  //$this->db->select("*");
  //$this->db->group_by("dbd_rs.id_rs");
  // $this->db->from('dbd_case');
  //$this->db->join('dbd_case', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
  $query = $this->db->select("dbd_rs.name_rs, dbd_rs.lat_rs, dbd_rs.lon_rs, COUNT(id_case) as 'total'"); 
  $this->db->group_by("dbd_rs.id_rs");
  $this->db->from('dbd_case');
  $this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_case.id_rs','left');
  $query = $this->db->get();
  $count = $query->result();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $count;
    } 
}

public function updateCase($data)
{
  $value = array( 
    //'id_rs' => $data['id_rs'],
    'record_case' =>  $data['record_case'],
    'age_case' => $data['age_case'],  
    'gender_case'  => $data['gender_case'],
    'status_case'  => $data['status_case'],
    'update_date_case' => $data['update_date_case'],
  );
  $this->db->set($value);
  $this->db->where('id_case', $data['id_case']);
  $this->db->update('dbd_case');
  $result=$this->db->affected_rows();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else if($result>0){
      return $value;
    }
    else{
      return $result;
    }
}

// public function deleteRSId($id){
//   $this->db->where('id_rs', $id);
//   $this->db->delete('dbd_rs'); 
//   $result=$this->db->affected_rows();
//   $db_error = $this->db->error();
//   if (!empty($db_error['message'])) {
//       throw new Exception('Database error! Error: ' . $db_error['message']);
//   }
//   else{
//       return $result;
//   }
// }

}