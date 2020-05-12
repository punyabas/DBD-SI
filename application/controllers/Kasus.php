<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Kasus extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->model('Kasus_model');
$this->load->model('RumahSakit_model');
$status=check_sessions('posisi','1');
if(!$status){
    $response['Status'] = 'Error';
    $response['Data'] =   'Unauthorized';
    getOutput($response,'401');  
}
}
public function saveCase() {
    $data = (array)json_decode(file_get_contents('php://input'));
    $Case = $this->Kasus_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($Case->rulesSave());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $Case->saveCase($data);
            $response['Status'] = 'Success';
            $response['Data'] =   $resdata;
            getOutput($response,'200');    
        }
        catch(Exception $e){
            $response['Status'] = 'Error';
            $response['Data'] =   $e->getMessage();
            getOutput($response,'400');
        }
    }
    else{
        $response['Status'] = 'Error';
        $response['Error'] = validation_errors();
        getOutput($response,'400');
    }
}


public function updateCase() {
    $data = (array)json_decode(file_get_contents('php://input'));
    $Case = $this->Kasus_model;
    $Upstat= $Case->getCaseID($data['id_case']);
    if($Upstat->status_case!=$data['status_case']){
        $data['update_date_case']=date("Y-m-d");
    }
    else{
        $data['update_date_case']=$Upstat->update_date_case;
    }
    // $response['Status'] = 'Success';
    //         $response['Data'] =   $Upstat->status_case;
    //         $response['Data2'] =   $data['status_case'];
    //         getOutput($response,'200'); 


    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($Case->rulesUpdate());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $Case->updateCase($data);
            $response['Status'] = 'Success';
            $response['Data'] =   $resdata;
            getOutput($response,'200');    
        }
        catch(Exception $e){
            $response['Status'] = 'Error';
            $response['Data'] =   $e->getMessage();
            getOutput($response,'400');
        }
    }
    else{
        $response['Status'] = 'Error';
        $response['Error'] = validation_errors();
        getOutput($response,'400');
    }
}

public function importCase(){
    $config['file_name'] = 'Kasus';
    $config['upload_path']          = './uploaded/';
    $config['allowed_types']        = '*';
    $this->load->library('upload', $config);
    $this->upload->do_upload('kasus');
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
            'record_case' =>  $sheetData[$i][0],
            'id_rs' => $this->_GetRSID($this->session->userdata('id_user')), 
            //'id_rs' => $sheetData[$i][7], 
            'age_case' =>  $sheetData[$i][4],  
            'gender_case'  => ''.$sheetData[$i][5],
            //'update_date_case' =>  $sheetData[$i][2]
            );
  
            $res=$this->_saveCases($val);
            if($res==1){
                $jml+=1;
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

public function importCaseUpdate(){
    $config['file_name'] = 'Kasus';
    $config['upload_path']          = './uploaded/';
    $config['allowed_types']        = '*';
    $this->load->library('upload', $config);
    $this->upload->do_upload('kasus');
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
            'id_case'      => $sheetData[$i][6],
            'record_case' =>  $sheetData[$i][0],
            'age_case' =>  $sheetData[$i][4],  
            'gender_case'  => ''.$sheetData[$i][5],
            'status_case'  => ''.$sheetData[$i][1],
            'update_date_case' =>  $sheetData[$i][3]
            );
  
            $res=$this->_updateCases($val);
            if($res==1){


                $jml+=1;
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

public function _GetRSID($data) {
        try{
            $RS = $this->RumahSakit_model;
            $resdata = $RS->getRSUser($data);
            return $resdata->id_rs;
        }
        catch(Exception $e){
            return $e->getMessage();   
        }
}

public function _saveCases($data) {
    $Case = $this->Kasus_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($Case->rulesSave());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $Case->saveCase($data);
            return 1;  
        }
        catch(Exception $e){
            return  $e->getMessage();
        }
    }
    else{
        return array(validation_errors());
    }
}


public function _updateCases( $data) {
    //$data = (array)json_decode(file_get_contents('php://input'));

    $Case = $this->Kasus_model;
    $Upstat= $Case->getCaseID($data['id_case']);
    if($Upstat->status_case!=$data['status_case']){
        $data['update_date_case']=$data['update_date_case'];
    }
    else{
        $data['update_date_case']=$Upstat->update_date_case;
    }
    // $response['Status'] = 'Success';
    //         $response['Data'] =   $Upstat->status_case;
    //         $response['Data2'] =   $data['status_case'];
    //         getOutput($response,'200'); 


    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($Case->rulesUpdate());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $Case->updateCase($data);
            return 1;   
        }
        catch(Exception $e){
           return  $e->getMessage();
           
        }
    }
    else{
        return array(validation_errors());
    }
}


public function getCaseRS(){
    //$data = (array)json_decode(file_get_contents('php://input'));
    $kasus= $this->Kasus_model;
    $validation = $this->form_validation;
    $id = $this->session->userdata('id_rs'); 
    $data= array("id_rs" => $id);
    $validation->set_data($data);
    $validation->set_rules($kasus->rulesGetId());
    if ($validation->run() == TRUE) {
        try{
            //$id=$data['id_proyek'];
            $kasus= $this->Kasus_model;
            $resdata = $kasus->getCaseRS($id);
            if(!$resdata){
                $response['Status'] = 'Error';
                $response['Error'] = 'Id_Unmatch';
                getOutput($response,'400');    
            }
            else{
                $response['Status'] = 'Succes';
                $response['Data'] =  $resdata;
                getOutput($response,'200');
            }
        } 
        catch(Exception $e){
            $response['Status'] = 'Error';
            $response['Error'] = $e->getMessage();
            getOutput($response,'400');    
        }
    }
    else {
        $response['Status'] = 'Error';
        $response['Error'] = validation_errors();
        getOutput($response,'400');
    }
}


}