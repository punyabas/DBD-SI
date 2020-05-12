<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class User_model extends CI_Model {

public function rulesSave()
{
    return [
      ['field' => 'username', 'label' => 'username','rules' => 'required'],
      ['field' => 'password_user', 'label' => 'password_user','rules' => 'required'],
      ['field' => 'role_user', 'label' => 'role_user','rules' => 'required']
    ];
}

public function rulesUpdate()
{
    return [
        ['field' => 'id_user', 'label' => 'id_user', 'rules' => 'required'],
        ['field' => 'username', 'label' => 'username','rules' => 'required'],
        ['field' => 'password_user', 'label' => 'password_user','rules' => 'required'],
        ['field' => 'role_user', 'label' => 'role_user','rules' => 'required']
    ];
}

public function rulesGetId()
{
    return [
      ['field' => 'id_user', 'label' => 'id_user', 'rules' => 'required']
    ];
}


public function saveuser($data)
{
  $value = array(
    'id_user' => uniqid(),
    'username' => $data['username'],  
    'password_user'  => md5($data['password_user']),
    'role_user'  => $data['role_user'],
  );
  $this->db->set($value);
  $this->db->insert('dbd_user');
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $value;
    }
}

public function getuserId($id){
  $this->db->where('dbd_user.id_user', $id);
  //$this->db->select(" dbd_user.*, COUNT(dbd_user.id_user) as 'jumlah_user'");
  //$this->db->group_by("dbd_user.id_user");
  //$this->db->from('dbd_user');
  //$this->db->join('dbd_user', 'dbd_user.id_user = dbd_user.id_user', 'left');
  //$query = $this->db->get(''); 
    $query = $this->db->get('dbd_user'); 
  $datauser = $query->row();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $datauser;
    }
}

public function getuserlogin($user){
  $cond = array('username' => $user['username'], 'password_user' => md5($user['password_user']) );
  $this->db->where($cond);
  //$this->db->where('dbd_user.username', $username['username']);
  //$this->db->select(" dbd_user.*, COUNT(dbd_user.id_user) as 'jumlah_user'");
  //$this->db->group_by("dbd_user.id_user");
  //$this->db->from('dbd_user');
  //$this->db->join('dbd_user', 'dbd_user.id_user = dbd_user.id_user', 'left');
  //$query = $this->db->get(''); 
  $query = $this->db->get('dbd_user'); 
  $datauser = $query->row();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $datauser;
    }
}

public function getuserAll(){
  //$this->db->select(" dbd_user.*, COUNT(dbd_user.id_user) as 'jumlah_user'");
  $this->db->select("*");
  //$this->db->group_by("dbd_user.id_user");
  $this->db->from('dbd_user');
  //$this->db->join('dbd_user', 'dbd_user.id_user = dbd_user.id_user', 'left');
  $query = $this->db->get(); 
  $datauser = $query->result();
  $db_error = $this->db->error();
    if (!empty($db_error['message'])) {
      throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
      return $datauser;
    } 
}

public function updateuser($data)
{
  $value = array( 
    'username' => $data['username'],  
    'password_user'  => $data['password_user'],
    'role_user'  => $data['role_user'],
  );
  $this->db->set($value);
  $this->db->where('id_user', $data['id_user']);
  $this->db->update('dbd_user');
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

// public function deleteuserId($id){
//   $this->db->where('id_user', $id);
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