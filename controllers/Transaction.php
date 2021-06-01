<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Transaction extends CI_CONTROLLER{
        public function __construct()
        
       
    {
   
    parent::__construct();
       $this->load->model('Transaction_model');
}
 
   
    public function view(){
        
       if($this->session->userdata('logged_in')){   
        $this->load->view('header');
        $this->load->view('transaction_view');
        $this->load->view('footer');
      }
    
	else{
           redirect('Admin/index'); 
       } 
    }
    
}