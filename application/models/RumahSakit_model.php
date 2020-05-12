<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class RumahSakit_model extends CI_Model {

public function rulesSave()
{
    return [
      ['field' => 'id_user', 'label' => 'id_user', 'rules' => 'required'],
      ['field' => 'name_rs', 'label' => 'name_rs','rules' => 'required'],
      ['field' => 'email_rs', 'label' => 'email_rs','rules' => 'required'],
      ['field' => 'handphone_rs', 'label' => 'handphone_rs','rules' => 'required'],
      ['field' => 'region_rs', 'label' => 'region_rs','rules' => 'required'],
      ['field' => 'address_rs', 'label' => 'address_rs','rules' => 'required'],
      ['field' => 'lat_rs', 'label' => 'lat_rs','rules' => 'required'],
      ['field' => 'lon_rs', 'label' => 'lon_rs','rules' => 'required']
    ];
}

public function rulesUpdate()
{
    return [
        ['field' => 'id_rs', 'label' => 'id_rs', 'rules' => 'required'],
        ['field' => 'name_rs', 'label' => 'name_rs','rules' => 'required'],
        ['field' => 'email_rs', 'label' => 'email_rs','rules' => 'required'],
        ['field' => 'handphone_rs', 'label' => 'handphone_rs','rules' => 'required'],
        ['field' => 'region_rs', 'label' => 'region_rs','rules' => 'required'],
        ['field' => 'address_rs', 'label' => 'address_rs','rules' => 'required'],
        ['field' => 'lat_rs', 'label' => 'lat_rs','rules' => 'required'],
        ['field' => 'lon_rs', 'label' => 'lon_rs','rules' => 'required']
    ];
}

public function rulesGetId()
{
    return [
      ['field' => 'id_rs', 'label' => 'id_rs', 'rules' => 'required']
    ];
}

public function rulesGetUser()
{
    return [
      ['field' => 'id_user', 'label' => 'id_user', 'rules' => 'required']
    ];
}

public function saveRS($data)
{
  $value = array(
    'id_rs' => uniqid(),
    'id_user' => $data['id_user'], 
    'name_rs' => $data['name_rs'],  
    'email_rs'  => $data['email_rs'],
    'handphone_rs'  => $data['handphone_rs'],
    'address_rs'  => $data['address_rs'],
    'region_rs'  => $data['region_rs'],
    'lat_rs'  => $data['lat_rs'],
    'lon_rs'  => $data['lon_rs']
  );
  $this->db->set($value);
  $this->db->insert('dbd_rs');
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $value;
    }
}

public function getRSId($id){
  $this->db->where('dbd_rs.id_rs', $id);
  //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
  //$this->db->group_by("dbd_rs.id_rs");
  //$this->db->from('dbd_rs');
  //$this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
  //$query = $this->db->get(''); 
    $query = $this->db->get('dbd_rs'); 
  $dataRS = $query->row();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $dataRS;
    }
}

public function getRSUser($id){
  $this->db->where('dbd_rs.id_user', $id);
  //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
  //$this->db->group_by("dbd_rs.id_rs");
  //$this->db->from('dbd_rs');
  //$this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
  //$query = $this->db->get(''); 
    $query = $this->db->get('dbd_rs'); 
  $dataRS = $query->row();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $dataRS;
    }
}

public function getRSAll(){
  //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
  $this->db->select("*");
  //$this->db->group_by("dbd_rs.id_rs");
  $this->db->from('dbd_rs');
  //$this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
  $query = $this->db->get(); 
  $dataRS = $query->result();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $dataRS;
    } 
}

public function updateRS($data)
{
  $value = array( 
    'name_rs' => $data['name_rs'],  
    'email_rs'  => $data['email_rs'],
    'handphone_rs'  => $data['handphone_rs'],
    'address_rs'  => $data['address_rs'],
    'region_rs'  => $data['region_rs'],
    'address_rs'  => $data['address_rs'],
    'lat_rs'  => $data['lat_rs'],
    'lon_rs'  => $data['lon_rs']
  );
  $this->db->set($value);
  $this->db->where('id_rs', $data['id_rs']);
  $this->db->update('dbd_rs');
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