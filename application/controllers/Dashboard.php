<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Dashboard extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->model('RumahSakit_model');
$this->load->model('Rekap_model');
$this->load->model('Kasus_model');
}

public function getCaseActive($loc){
    //$data = (array)json_decode(file_get_contents('php://input'));
    $kasus= $this->Kasus_model;
    $validation = $this->form_validation;
        try{
            $kasus= $this->Kasus_model;
            $resdata = $kasus->getCaseActive($loc);
            $response['Status'] = 'Succes';
            $response['Data'] =  $resdata;
            getOutput($response,'200');
        } 
        catch(Exception $e){
            $response['Status'] = 'Error';
            $response['Error'] = $e->getMessage();
            getOutput($response,'400');    
        }
}

public function getFatalityRate($loc){
    //$data = (array)json_decode(file_get_contents('php://input'));
    $kasus= $this->Kasus_model;
    $validation = $this->form_validation;
        try{
            $kasus= $this->Kasus_model;
            $all = $kasus->getCaseAll($loc);
            $die = $kasus->getCaseDie($loc);
            //$resdata = array($all, $die);
            $resdata = $die->total/$all->total;
            $response['Status'] = 'Succes';
            $response['Data'] =  $resdata;
            getOutput($response,'200');
        } 
        catch(Exception $e){
            $response['Status'] = 'Error';
            $response['Error'] = $e->getMessage();
            getOutput($response,'400');    
        }
}

public function getIncidenceRate($loc){
    //$data = (array)json_decode(file_get_contents('php://input'));
    $kasus= $this->Kasus_model;
    $validation = $this->form_validation;
        try{
            $kasus= $this->Kasus_model;
            //$all = $kasus->getCaseAll($loc);
            $die = $kasus->getCaseDie($loc);
            //$resdata = array($all, $die);
            //$resdata = $die->total/$all->total;
            $response['Status'] = 'Succes';
            $response['Data'] =  $die;
            getOutput($response,'200');
        } 
        catch(Exception $e){
            $response['Status'] = 'Error';
            $response['Error'] = $e->getMessage();
            getOutput($response,'400');    
        }
}

public function getLocation($loc){
    //$data = (array)json_decode(file_get_contents('php://input'));
    $kasus= $this->Kasus_model;
    $validation = $this->form_validation;
        try{
            $kasus= $this->Kasus_model;
            //$all = $kasus->getCaseAll($loc);
            $resdata  = $kasus->getLocation($loc);
            //$resdata = array($all, $die);
            //$resdata = $die->total/$all->total;
            $response['Status'] = 'Succes';
            $response['Data'] = $resdata ;
            getOutput($response,'200');
        } 
        catch(Exception $e){
            $response['Status'] = 'Error';
            $response['Error'] = $e->getMessage();
            getOutput($response,'400');    
        }
}

public function getGraphTotal($loc){
  //$data = (array)json_decode(file_get_contents('php://input'));
  $kasus= $this->Kasus_model;
  $validation = $this->form_validation;
      try{
          $Recap= $this->Rekap_model;
          //$all = $kasus->getCaseAll($loc);
          $resdata  = $Recap->getGraphTotal($loc);
          //$resdata = array($all, $die);
          //$resdata = $die->total/$all->total;
          $response['Status'] = 'Succes';
          $response['Data'] = $resdata ;
          getOutput($response,'200');
      } 
      catch(Exception $e){
          $response['Status'] = 'Error';
          $response['Error'] = $e->getMessage();
          getOutput($response,'400');    
      }

}

public function getGraphDie($loc){
    //$data = (array)json_decode(file_get_contents('php://input'));
    $kasus= $this->Kasus_model;
    $validation = $this->form_validation;
        try{
            $Recap= $this->Rekap_model;
            //$all = $kasus->getCaseAll($loc);
            $resdata  = $Recap->getGraphDie($loc);
            //$resdata = array($all, $die);
            //$resdata = $die->total/$all->total;
            $response['Status'] = 'Succes';
            $response['Data'] = $resdata ;
            getOutput($response,'200');
        } 
        catch(Exception $e){
            $response['Status'] = 'Error';
            $response['Error'] = $e->getMessage();
            getOutput($response,'400');    
        }
  
  }

  public function getGraphSembuh($loc){
    //$data = (array)json_decode(file_get_contents('php://input'));
    $kasus= $this->Kasus_model;
    $validation = $this->form_validation;
        try{
            $Recap= $this->Rekap_model;
            //$all = $kasus->getCaseAll($loc);
            $resdata  = $Recap->getGraphSembuh($loc);
            //$resdata = array($all, $die);
            //$resdata = $die->total/$all->total;
            $response['Status'] = 'Succes';
            $response['Data'] = $resdata ;
            getOutput($response,'200');
        } 
        catch(Exception $e){
            $response['Status'] = 'Error';
            $response['Error'] = $e->getMessage();
            getOutput($response,'400');    
        }
  
  }

}

