<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Service_Provider extends CI_CONTROLLER{
        public function __construct()
        
       
    {
   
    parent::__construct();
       $this->load->model('Service_provider_model');
}
   
   
    public function view(){
        
       if($this->session->userdata('logged_in')){   
        $data['result']=$this->Service_provider_model->get_data();
        $this->load->view('header');
        $this->load->view('Service_Provider/view',$data);
        $this->load->view('footer');
      }
    
	else{
           redirect('Admin/index'); 
       } 
    }
  } 
    
   