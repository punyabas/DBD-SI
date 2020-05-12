<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Login extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->model('User_model');
$this->load->model('Dirjen_model');
$this->load->model('RumahSakit_model');

}
// Check for user login process
public function login() {

    $status=check_sessions('status','logged_in');

    if(!$status){
        $user = $this->User_model;
        $data = (array)json_decode(file_get_contents('php://input'));
        $validation = $this->form_validation;
        $validation->set_data($data);
        $validation->set_rules('username', 'username', 'required');
        $validation->set_rules('password_user', 'password_user', 'required');
        if ($validation->run() == TRUE) {
            $result1 = $user->getuserlogin($data);
            if ($result1) {

                $data_session = array(
                'status' => 'logged_in',
                'username' => $result1->username,
                'id_user' =>  $result1->id_user,
                'posisi' => $result1->role_user
                    );
                $this->session->set_userdata($data_session);
                if($this->session->userdata('posisi')=='1'){
                    $result=$this->_getRSUser();
                    //property_exists($result,'id_rs');
                    $data_session = array(
                        'id_rs' => $result->id_rs,
                        'name_rs' =>  $result->name_rs,
                        'address_rs' => $result->address_rs,
                        'handphone_rs' => $result->handphone_rs,
                        'email_rs' => $result->email_rs
                    );
                    $this->session->set_userdata($data_session);
                }
                else{
                    $result=$this->_getDirjenUser();
                    $data_session = array(
                        'id_dirjen' => $result->id_dirjen,
                        'name_dirjen' =>  $result->name_dirjen,
                        'handphone_dirjen' => $result->handphone_dirjen,
                        'email_dirjen' => $result->email_dirjen
                    );
                    $this->session->set_userdata($data_session);
                }
                $DataCnt['Info']= 'Berhasil Login';
                $DataCnt['Posisi']=  $this->session->userdata('posisi');
                $response['Status'] = 'Success';
                $response['Data1'] =  $DataCnt;
                $response['Data2'] =  $result;
                getOutput($response,'200');
            }

            else
            {
                $response['Status'] = 'Error';
                $response['Error'] = 'username atau password salah';
                getOutput($response,'400');
            }
        } 

        else{
        $response['Status'] = 'Error';
        $response['Error'] =  validation_errors();
        getOutput($response,'400');
        }
    }

    else{
        $DataCnt['Info']= 'Sudah Login';
        $DataCnt['Kondisi']=  $this->session->userdata('status');
        $response['Status'] = 'Error';
        $response['Error'] = $DataCnt;
        getOutput($response,'400');
    }
}

// Logout from admin page
public function logout(){
    $status=check_sessions('status','logged_in');
    if($status){
        $_SESSION = array();
        $this->session->sess_destroy();
        //$this->cache->clean();
        ob_clean();
        $response['Status'] = 'Success';
        $response['Data'] = $this->session->userdata('status');
        getOutput($response,'200');
    }
    else{
        $response['Status'] = 'Error';
        $response['Error'] = $this->session->userdata('status');
        getOutput($response,'400');
    }
}

public function checklogin() {
    $sid = $this->session->userdata('status');
    if($sid) {
    $response['Status'] = 'Success';
    $response['Data'] = $this->session->userdata('status');    
    getOutput($response,'200');
    } else {
    $response['Status'] = 'Success';
    $response['Data'] = NULL;    
    getOutput($response,'200');
    }
}

public function checkposisi() {
    $sid = $this->session->userdata('posisi'); 
    if($sid!=NULL) {
    $response['Status'] = 'Success';
    $response['Data'] = $this->session->userdata('posisi'); 
    getOutput($response,'200');
    } else {
    $response['Status'] = 'Success';
    $response['Data'] = NULL;    
    getOutput($response,'200');
    }
}

public function _getRSUser(){
    //$data = (array)json_decode(file_get_contents('php://input'));
    $RS= $this->RumahSakit_model;
    $validation = $this->form_validation;
    $id = $this->session->userdata('id_user'); 
    $data= array("id_user" => $id);
    $validation->set_data($data);
    $validation->set_rules($RS->rulesGetUser());
    if ($validation->run() == TRUE) {
        try{
            //$id=$data['id_proyek'];
            // $RS= $this->RumahSakit_model;
            $resdata = $RS->getRSUser($id);
            if(!$resdata){
                $response['Status'] = 'Error';
                $response['Error'] = 'Id_Unmatch';
               return $response;    
            }
            else{
                return  $resdata;
            }
        } 
        catch(Exception $e){
           return $e->getMessage(); 
        }
    }
    else {
       return validation_errors();
    }
}

public function _getDirjenUser(){
    //$data = (array)json_decode(file_get_contents('php://input'));
    $Dirjen= $this->Dirjen_model;
    $validation = $this->form_validation;
    $id = $this->session->userdata('id_user'); 
    $data= array("id_user" => $id);
    $validation->set_data($data);
    $validation->set_rules($Dirjen->rulesGetUser());
    if ($validation->run() == TRUE) {
        try{
            //$id=$data['id_proyek'];
            // $Dirjen= $this->RumahSakit_model;
            $resdata = $Dirjen->getDirjenUser($id);
            if(!$resdata){
                $response['Status'] = 'Error';
                $response['Error'] = 'Id_Unmatch';
               return $response;    
            }
            else{
                return  $resdata;
            }
        } 
        catch(Exception $e){
           return $e->getMessage(); 
        }
    }
    else {
       return validation_errors();
    }
}


}