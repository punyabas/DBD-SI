<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class RumahSakit extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->model('RumahSakit_model');
$status=check_sessions('posisi','0');
if(!$status){
    $response['Status'] = 'Error';
    $response['Data'] =   'Unauthorized';
    getOutput($response,'401');   
}

}
public function saveRS() {
    $data = (array)json_decode(file_get_contents('php://input'));
    $RS = $this->RumahSakit_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($RS->rulesSave());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $RS->saveRS($data);
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


public function updateRS() {
    $data = (array)json_decode(file_get_contents('php://input'));
    $RS = $this->RumahSakit_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($RS->rulesUpdate());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $RS->updateRS($data);
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

public function getRSAll(){
    try{
        $RS = $this->RumahSakit_model;
        $resdata = $RS->getRSAll();
        $response['Status'] = 'Succes';
        $response['Data'] = $resdata;
        getOutput($response,'200');
    }
    catch(Exception $e){
        $response['Status'] = 'Error';
        $response['Error'] = $e->getMessage();
        getOutput($response,'400');    
    }
}



}