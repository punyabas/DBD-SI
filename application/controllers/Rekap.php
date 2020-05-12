<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Rekap extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->model('Rekap_model');
$status=check_sessions('posisi','1');
if(!$status){
    $response['Status'] = 'Error';
    $response['Data'] =   'Unauthorized';
    getOutput($response,'401');  
}
}

public function recapSakit() {
    //$data = (array)json_decode(file_get_contents('php://input'));
    $id_rs= $this->session->userdata('id_rs');
    $data['id_rs']= $id_rs;
    $data['date']= date("Y-m-d");

    $Recap = $this->Rekap_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($Recap->rulesRecap());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $Recap->getCountSakit($id_rs, $data['date']);
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

public function recapSembuh() {
    //$data = (array)json_decode(file_get_contents('php://input'));
    $id_rs= $this->session->userdata('id_rs');
    $data['id_rs']= $id_rs;
    $data['date']= date("Y-m-d");
    $Recap = $this->Rekap_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($Recap->rulesRecap());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $Recap->getCountSembuh($id_rs, $data['date']);
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

public function recapDie() {
    //$data = (array)json_decode(file_get_contents('php://input'));
    $id_rs= $this->session->userdata('id_rs');
    $data['id_rs']= $id_rs;
    $data['date']= date("Y-m-d");
    $Recap = $this->Rekap_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($Recap->rulesRecap());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $Recap->getCountDie($id_rs, $data['date']);
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

public function BatchrecapSakit() {
    $start_date = '2020-03-25';
    $end_date = '2020-05-05';
    $id_rs= $this->session->userdata('id_rs');
    while (strtotime($start_date) <= strtotime($end_date)) {
    $Recap = $this->Rekap_model;
    $Recap->getCountSakit($id_rs,  $start_date);
    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
    
}
}

public function BatchrecapSembuh() {
    $start_date = '2020-03-25';
    $end_date = '2020-05-05';
    $id_rs= $this->session->userdata('id_rs');
    while (strtotime($start_date) <= strtotime($end_date)) {
    $Recap = $this->Rekap_model;
    $Recap->getCountSembuh($id_rs,  $start_date);
    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
    
}
}

public function BatchrecapDie() {
    $start_date = '2020-03-25';
    $end_date = '2020-05-05';
    $id_rs= $this->session->userdata('id_rs');
    while (strtotime($start_date) <= strtotime($end_date)) {
    $Recap = $this->Rekap_model;
    $Recap->getCountDie($id_rs,  $start_date);
    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
    
}

}

}