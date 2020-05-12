<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Rekap_model extends CI_Model {

public function __construct()
{
        // Call the Model constructor
    parent::__construct();
}

public function rulesRecap()
{
    return [
      ['field' => 'id_rs', 'label' => 'id_rs', 'rules' => 'required'],
    ];
}


public function getCountSakit($id_rs, $date){
    $count=0;
    //$date1 = str_replace('-', '/', $date);
    //$yesterday = date('yy-m-d',strtotime($date1 . "-1 days"));
    $this->db->where('id_rs', $id_rs);
    //$this->db->where('id_rs','5eb6850839508');
    $this->db->where('status_recap', '0');
    //$this->db->where('date_recap', $yesterday );
    $this->db->order_by('date_recap', 'DESC');
    $this->db->select("amount_recap");
    $this->db->from('dbd_recap');
    $query = $this->db->get();
    // if($query){
    $count = $query->row_array()['amount_recap'];
    //}
    $this->db->where('id_rs', $id_rs);
    $this->db->where('status_case', '0');
    $this->db->where('update_date_case', $date );
    //$this->db->where('id_rs', '5eb6850839508');
    $this->db->select("COUNT(id_rs) as 'total'");
    $this->db->from('dbd_case');
    $query = $this->db->get();
    $count1 = $count + $query->row()->total;
    //$count1 = $query->row()->total;
    if (!empty($db_error['message'])) {
        throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
        $value = array(
            'id_recap' => uniqid(),
            'id_rs' => $id_rs,
            'date_recap' => $date,
            'status_recap' => '0',
            'amount_recap' => $count1,
          );
          $this->db->set($value);
          $this->db->insert('dbd_recap');
          $db_error = $this->db->error();
            if (!empty($db_error['message'])) {
              throw new Exception('Database error! Error: ' . $db_error['message']);
            }
            else{
                // $value['cek1']= $count;
                // $value['cek2']= $yesterday;
              return $value;
            }
           //return array($count1);
    }

}

public function getCountSembuh($id_rs, $date){
    $count=0;
    //$date1 = str_replace('-', '/', $date);
    //$yesterday = date('yy-m-d',strtotime($date1 . "-1 days"));
    $this->db->where('id_rs', $id_rs);
    $this->db->where('status_recap', '1');
    //$this->db->where('date_recap', $yesterday );
    $this->db->order_by('date_recap', 'DESC');
    $this->db->select("amount_recap");
    $this->db->from('dbd_recap');
    $query = $this->db->get();
    // if($query){
    $count = $query->row_array()['amount_recap'];
    // }
    $this->db->where('id_rs', $id_rs);
    $this->db->where('status_case', '1');
    $this->db->where('update_date_case', $date );
    $this->db->select("COUNT(id_rs) as 'total'");
    $this->db->from('dbd_case');
    $query = $this->db->get();
    $count1 = $count + $query->row()->total;
    if (!empty($db_error['message'])) {
        throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
        $value = array(
            'id_recap' => uniqid(),
            'id_rs' => $id_rs,
            'date_recap' => $date,
            'status_recap' => '1',
            'amount_recap' => $count1,
          );
          $this->db->set($value);
          $this->db->insert('dbd_recap');
          $db_error = $this->db->error();
            if (!empty($db_error['message'])) {
              throw new Exception('Database error! Error: ' . $db_error['message']);
            }
            else{
                // $value['cek1']= $count;
                // $value['cek2']= $yesterday;
              return $value;
            }
           return array($count1);
    }

}

public function getCountDie($id_rs, $date){
    $count=0;
    //$date1 = str_replace('-', '/', $date);
    //$yesterday = date('yy-m-d',strtotime($date1 . "-1 days"));
    $this->db->where('id_rs', $id_rs);
    $this->db->where('status_recap', '2');
    //$this->db->where('date_recap', $yesterday );
    $this->db->order_by('date_recap', 'DESC');
    $this->db->select("amount_recap");
    $this->db->from('dbd_recap');
    $query = $this->db->get();
    // if($query){
    $count = $query->row_array()['amount_recap'];
    // }
    $this->db->where('id_rs', $id_rs);
    $this->db->where('status_case', '2');
    $this->db->where('update_date_case', $date );
    $this->db->select("COUNT(id_rs) as 'total'");
    $this->db->from('dbd_case');
    $query = $this->db->get();
    $count1 = $count + $query->row()->total;
    if (!empty($db_error['message'])) {
        throw new Exception('Database error! Error: ' . $db_error['message']);
    }
    else{
        $value = array(
            'id_recap' => uniqid(),
            'id_rs' => $id_rs,
            'date_recap' => $date,
            'status_recap' => '2',
            'amount_recap' => $count1,
          );
          $this->db->set($value);
          $this->db->insert('dbd_recap');
          $db_error = $this->db->error();
            if (!empty($db_error['message'])) {
              throw new Exception('Database error! Error: ' . $db_error['message']);
            }
            else{
                // $value['cek1']= $count;
                // $value['cek2']= $yesterday;
              return $value;
            }
           return array($count1);
    }

}

public function getGraphTotal($loc){
    if($loc){
      $this->db->where('dbd_rs.region_rs',$loc);
    }
    $this->db->where('dbd_recap.status_recap','0');
    //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
    //$this->db->select("*");
    //$this->db->group_by("dbd_rs.id_rs");
    // $this->db->from('dbd_case');
    //$this->db->join('dbd_case', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
    $query = $this->db->select("dbd_recap.date_recap, SUM(amount_recap) as 'total'"); 
    $this->db->group_by("dbd_recap.date_recap");
    $this->db->from('dbd_recap');
    $this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_recap.id_rs','left');
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

  public function getGraphDie($loc){
    if($loc){
      $this->db->where('dbd_rs.region_rs',$loc);
    }
    $this->db->where('dbd_recap.status_recap','2');
    //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
    //$this->db->select("*");
    //$this->db->group_by("dbd_rs.id_rs");
    // $this->db->from('dbd_case');
    //$this->db->join('dbd_case', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
    $query = $this->db->select("dbd_recap.date_recap, SUM(amount_recap) as 'total'"); 
    $this->db->group_by("dbd_recap.date_recap");
    $this->db->from('dbd_recap');
    $this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_recap.id_rs','left');
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

  public function getGraphSembuh($loc){
    if($loc){
      $this->db->where('dbd_rs.region_rs',$loc);
    }
    $this->db->where('dbd_recap.status_recap','1');
    //$this->db->select(" dbd_rs.*, COUNT(dbd_rs.id_rs) as 'jumlah_rs'");
    //$this->db->select("*");
    //$this->db->group_by("dbd_rs.id_rs");
    // $this->db->from('dbd_case');
    //$this->db->join('dbd_case', 'dbd_rs.id_rs = dbd_rs.id_rs', 'left');
    $query = $this->db->select("dbd_recap.date_recap, SUM(amount_recap) as 'total'"); 
    $this->db->group_by("dbd_recap.date_recap");
    $this->db->from('dbd_recap');
    $this->db->join('dbd_rs', 'dbd_rs.id_rs = dbd_recap.id_rs','left');
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




}