<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class User extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->model('User_model');

}
public function saveUser() {
    $data = (array)json_decode(file_get_contents('php://input'));
    $user = $this->User_model;
    $validation = $this->form_validation;
    $validation->set_data($data);
    $validation->set_rules($user->rulesSave());
    if ($validation->run() == TRUE) {
        try{
            $resdata = $user->saveUser($data);
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


}