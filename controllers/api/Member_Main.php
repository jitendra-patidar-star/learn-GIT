<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_Main extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('api_model/Member_Main_Model');

    }
    
    public function issue_RFQ()
    {
        $inputdata = $this->input->post();
        
        if($inputdata['JobDate'] == '' || $inputdata['ServiceID'] == '' || $inputdata['JobDescription'] == '' || $inputdata['Budget'] == '' || $inputdata['JobDate'] == ''){
            
        }else{
            
            
        }
    }
    
}