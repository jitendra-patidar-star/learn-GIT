<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_Provider_Job extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    
	    $this->load->library('pagination');
	    
	    $this->load->model('api_model/Service_Provider_Job_Model');
	    


    }
    
    
    
    public function get_all_job_service_provider($userid,$type,$page)
    {
        // $userid = $this->input->post('userid');
       $data = $this->Service_Provider_Job_Model->job_data_for_service_provider_data($userid,$type,$page);
    //   echo "<pre>";
    //   print_r($data);
       
      echo json_encode($data);
    }
    
    
    
    public function get_selected_job_of_service_provider($jobid)
    {
        // $userid = $this->input->post('userid');
       $data = $this->Service_Provider_Job_Model->selected_job_data_for_service_provider($jobid);
    //   echo "<pre>";
    //   print_r($data);
       
      echo json_encode($data);
    }
    
    public function get_new_responded_job()
    {
        $data = $this->Service_Provider_Job_Model->get_new_responded_job_data();
        echo json_encode($data);
    }
    
    public function confirm_job($jobid)
    {
        $update = $this->Service_Provider_Job_Model->update_job_stage($jobid);
        
        if($update){
        
            $datas = array('status'=>'Success', 'msg'=>'Confirmed Job');
        
            echo json_encode($datas);
            
        }else{
           
            $datas = array('status'=>'Failed', 'msg'=>'Error!!');
        
            echo json_encode($datas);
        }
        
    }
    
    public function reject_job($jobid)
    {
        $update = $this->Service_Provider_Job_Model->update_job_reject_stage($jobid);
        
        if($update){
        
            $datas = array('status'=>'Success', 'msg'=>'Job Rejected');
        
            echo json_encode($datas);
            
        }else{
           
            $datas = array('status'=>'Failed', 'msg'=>'Error!!');
        
            echo json_encode($datas);
        }
    }
    
    public function get_confirmed_job()
    {
       $data =  $this->Service_Provider_Job_Model->all_confirmed_job_data();
       
       echo json_encode($data);
    }
    
    
    public function complete_job($jobid)
    {
        
         $stageid =   $this->Service_Provider_Job_Model->got_stageID($jobid);
         
         
	   // echo json_encode($stageid);
	   if($stageid[0]==array('StageID'=>30)||$stageid[0]==array('StageID'=>81))
	   {
          
              $update = $this->Service_Provider_Job_Model->update_complete_job_data($jobid);
              
            $datas = array('status'=>'Success', 'msg'=>'Job Completed');
        
            echo json_encode($datas);

        }
        else{
            $msg = array('status'=>"failed","msg"=>"Member not select your confirmation yet please wait for sometime...");

            echo json_encode($msg);
        }
        
}
    public function get_complete_job()
    {
        $data = $this->Service_Provider_Job_Model->get_complete_job_data();
        
        echo json_encode($data);
    }
    
	public function rate_job($jobid)
	{
	   $jobtdata = $this->Service_Provider_Job_Model->get_job_by_id($jobid);
	   echo json_encode($jobtdata);
	   
	   //$memberid = $jobtdata['MemberID'];
	   
	   //$serviceproviderrating = $jobtdata['ServiceProvider2MemberRating'];

	   //if($jobtdata['StageID'] >= 81 || $jobtdata['StageID'] >= 82){
	          
	   //       $this->Service_Provider_Job_Model->update_member_credit_score($memberid);

	   }
	   public function get_member_job_data($jobid)
    {
        $data = $this->Service_Provider_Job_Model->get_job_member_data($jobid);
        
        echo json_encode($data);
    }
    public function accept_rfq($jobid,$serproid)
	{
	    $stageid =   $this->Service_Provider_Job_Model->got_stageID($jobid);
	   // echo json_encode($stageid);
	   if($stageid[0]==array('StageID'=>10)||$stageid[0]==array('StageID'=>20)){

            $update= $this->Service_Provider_Job_Model->update_stage_10($jobid,$serproid);
            $msg = array('msg'=>'service provider successfuly accept member job','status'=>'Success');
            echo json_encode($msg);

        }
        else{
            $msg = array('msg'=>'other service provider selected by member');
            echo json_encode($msg);
        }
	    
	}
       
        public function reject_rfq($jobid,$serproid)
	{
	    $inputdata= $this->input->post();
	    $stageid =   $this->Service_Provider_Job_Model->got_stageID($jobid);
	   // echo json_encode($stageid);
	    if($inputdata['RejectReasonE'] ==''){
	      $msg = array('status'=>'Failed','msg'=>'Please Fill Required Fileds');
            echo json_encode($msg);   
	    }
	    
	    
	    else{
	        
	   if($stageid[0]==array('StageID'=>10)||$stageid[0]==array('StageID'=>20)){
	  $newdata = array('AcceptRFQ'=> 1,'RejectReasonE' => $inputdata['RejectReasonE']);

     $update= $this->Service_Provider_Job_Model->update_stage($jobid,$serproid,$newdata);
            if($newdata){
                 
                $msg = array('status'=>'Success','msg'=>'Rejection Done');
                echo json_encode($msg);
            }
             else{
                
                $msg = array('status'=>'Failed','msg'=>'Error!!');
                echo json_encode($msg);
            }
        }
        else{
            $msg = array('msg'=>'other service provider selected by member');
            echo json_encode($msg);
        }
	}
	   
	}
}

    
