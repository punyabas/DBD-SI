<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class ImportRS extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->model('RumahSakit_model');
$this->load->model('User_model');
$status=check_sessions('posisi','0');
if(!$status){
    $response['Status'] = 'Error';
    $response['Data'] =   'Unauthorized';
    getOutput($response,'401');   
}
}


public function importRS(){
    $config['file_name'] = 'Rumah_sakit';
    $config['upload_path']          = './uploaded/';
    $config['allowed_types']        = '*';
    $this->load->library('upload', $config);
    $this->upload->do_upload('rumah_sakit');
    //$error = array('error' => $this->upload->display_errors());
    $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
    $file_name = $upload_data['file_name'];
    $objPHPExcel = PHPExcel_IOFactory::load('uploaded/'.$file_name);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray();
          $count = count($sheetData);
          $jml = 0;
          $errors = array();
          for($i = 1; $i<$count; $i++){
              $val = array(
              'username' => $sheetData[$i][5],
              'password_user' => $sheetData[$i][3],
              'role_user'  => '1'
              );
  
              $res=$this->_saveUser($val);
              if(array_key_exists('id_user', $res)){
                $val2 = array(
                    'id_user' => $res['id_user'], 
                    'name_rs' => $sheetData[$i][1],  
                    'email_rs'  => $sheetData[$i][5],
                    'handphone_rs'  => $sheetData[$i][4],
                    'address_rs'  => $sheetData[$i][2],
                    'region_rs'  => $sheetData[$i][8],
                    'lat_rs'  => $sheetData[$i][6],
                    'lon_rs'  => $sheetData[$i][7]
                     );
                $res2=$this->_saveRS($val2);
                if($res2==1){
                    $jml+=1;
                }                       
                if(is_array($res2)){
                        $errors[$i]=$res;
                }
              }
              else{
                  $errors[$i]=$res;
              }
          }
          $this->load->helper("file");
          $path_up = './uploaded/';
          delete_files($path_up);
          $response['Status'] = 'Success';
          $response['Data'] = 'Jumlah berhasil '.$jml.' data';
          if($errors){
          $response['error'] = $errors;
            }
          getOutput($response, 200);   
}


public function _saveUser($data) {
    $user = $this->User_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($user->rulesSave());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $user->saveUser($data);
            return $resdata;
        }
        catch(Exception $e){
            return array($e);
        }
    }
    else{
        return array(validation_errors());
    }
}

public function _saveRS($data) {
    $RS = $this->RumahSakit_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($RS->rulesSave());
    if ($validation->run() == TRUE) {
        try{
            $RS->saveRS($data);
            return 1;   
        }
        catch(Exception $e){
            return array($e);
        }
    }
    else{
        return array(validation_errors());
    }
}


  

}
