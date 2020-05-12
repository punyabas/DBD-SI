<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Dirjen_model extends CI_Model {

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

public function rulesGetUser()
{
    return [
      ['field' => 'id_user', 'label' => 'id_user', 'rules' => 'required']
    ];
}

public function getDirjenUser($id){
    $this->db->where('dbd_dirjen.id_user', $id);
    //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
    //$this->db->group_by("dbd_rs.id_rs");
    //$this->db->from('dbd_rs');
    //$this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
    //$query = $this->db->get(''); 
      $query = $this->db->get('dbd_dirjen'); 
    $dataRS = $query->row();
    $db_error = $this->db->error();
      if (!empty($db_error['message'])) {
        throw new Exception('Database error! Error: ' . $db_error['message']);
      }
      else{
        return $dataRS;
      }
  }

}