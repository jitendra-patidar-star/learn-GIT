<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Job extends CI_CONTROLLER{
        public function __construct()
        
       
    {
   
    parent::__construct();
       $this->load->model('Job_model');
}
 
   
    public function view(){
        
     if($this->session->userdata('logged_in')){  
        $this->load->view('header');
        $this->load->view('job_view');
        $this->load->view('footer');
     }else{
	         redirect('Admin/index');  
	     }
    }
}