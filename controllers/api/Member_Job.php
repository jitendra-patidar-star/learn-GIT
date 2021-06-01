<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_Job extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('api_model/Member_Job_Model');

    }
    
     public function get_all_job_member($userid,$type,$page)
    {
        // $userid = $this->input->post('userid');
       $data = $this->Member_Job_Model->job_data_for_member_data($userid,$type,$page);
    //   echo "<pre>";
    //   print_r($data);
       
      echo json_encode($data);
    }
    
    public function get_job_member($userid,$jobid)
    {
        // $userid = $this->input->post('userid');
       $data = $this->Member_Job_Model->jobdata_for_member_data($userid,$jobid);
    //   echo "<pre>";
    //   print_r($data);
       
      echo json_encode($data);
    }
    
    public function issue_RFQ($memberid,$serviceid)
    {
        $inputdata = $this->input->post();
        
        if(  $inputdata['JobDate'] == '' || $inputdata['JobDescription'] == '' || $inputdata['Budget'] == '' || $inputdata['PostalCode'] == ''){
            
            $msg = array('status'=>'Failed','msg'=>'Please Fill All The Required Fields');
            echo json_encode($msg);
        }
        else{
            $newdata = array(
                'JobDate' => $inputdata['JobDate'],
                'MemberID' =>  $memberid,
                'ServiceID' =>  $serviceid,
                'StageID' => 10,
                'JobDescription' => $inputdata['JobDescription'] ,
                'Budget' => $inputdata['Budget'],
                'PostalCode' => $inputdata['PostalCode'],
                 'Stage10Date' =>date('Y-m-d H:i:s')
        );
       
       
        $insert =  $this->Member_Job_Model->issue_rfq_insert($newdata);
        
        //  if($newdata){
                 
        //         $msg = array('status'=>'Success','msg'=>'job created successfully');
        //         echo json_encode($msg);
                
        //     }
        // else{
                
        //         $msg = array('status'=>'Failed','msg'=>'Error!!');
        //         echo json_encode($msg);
        //     }
            
      
         $abc = $this->Member_Job_Model->job_IDE($memberid,$serviceid);
        
          $ab = $this->Member_Job_Model->job_id($memberid,$serviceid);
          
           $mdata=$this->Member_Job_Model->Mdata($memberid);
        
            $memberdata=$this->Member_Job_Model->MUJdata($abc,$mdata);
            
            $sdata=$this->Member_Job_Model->Sdata($serviceid);
            
            $servicedata=$this->Member_Job_Model->SUJdata($abc,$sdata);
            
          if($_FILES["img1"]["name"])  
            {  
                    $config['upload_path'] = 'ezjobuatphoto/job';
                    $config['allowed_types'] = 'jpg|png|jpeg|jpe';
                   
$new_name = $ab.'-1'.'.'.pathinfo($_FILES["img1"]["name"], PATHINFO_EXTENSION);
                    // $config['file_name'] = $new_name;
                    
                    
                    $_FILES["img1"]['name'] = $new_name;
                   
                    $this->load->library('upload', $config);  
                    
                    if(!$this->upload->do_upload('img1'))  
                    {  
                        $error = $this->upload->display_errors();
                    }  
                    else  
                    {  
                         $data = $this->upload->data(); 
                         $dataaa['img1'] = $data['file_name'];
                    }  
                }
                 if($_FILES["img2"]["name"])  
            {  
                    $config['upload_path'] = 'ezjobuatphoto/job';
                    $config['allowed_types'] = 'jpg|png|jpeg|jpe';
                   
$new_name = $ab.'-2'.'.'.pathinfo($_FILES["img2"]["name"], PATHINFO_EXTENSION);

                    $_FILES["img2"]['name'] = $new_name;
                   
                    $this->load->library('upload', $config);  
                    
                    if(!$this->upload->do_upload('img2'))  
                    {  
                        $error = $this->upload->display_errors();
                    }  
                    else  
                    {  
                         $data = $this->upload->data(); 
                         $dataaa['img2'] = $data['file_name'];
                    }  
                }
                 if($_FILES["img3"]["name"])  
            {  
                    $config['upload_path'] = 'ezjobuatphoto/job';
                    $config['allowed_types'] = 'jpg|png|jpeg|jpe';
                   
$new_name = $ab.'-3'.'.'.pathinfo($_FILES["img3"]["name"], PATHINFO_EXTENSION);
                    // $config['file_name'] = $new_name;
                    
                    
                    $_FILES["img3"]['name'] = $new_name;
                   
                    $this->load->library('upload', $config);  
                    
                    if(!$this->upload->do_upload('img3'))  
                    {  
                        $error = $this->upload->display_errors();
                    }  
                    else  
                    {  
                         $data = $this->upload->data(); 
                         $dataaa['img3'] = $data['file_name'];
                    }  
                }
                
       
            
           
       
                 $abd= $this->db->insert_id();
             if ($abd){
                 
                  $dataaa = array(
'img1' => $ab.'-1'.'.'.pathinfo($_FILES["img1"]["name"], PATHINFO_EXTENSION),
'img2' => $ab.'-2'.'.'.pathinfo($_FILES["img2"]["name"], PATHINFO_EXTENSION),
'img3' => $ab.'-3'.'.'.pathinfo($_FILES["img3"]["name"], PATHINFO_EXTENSION));
               }
    $updated =  $this->Member_Job_Model->images_update($ab,$dataaa);
    
    if($newdata){
                 
                $msg = array('status'=>'Success','msg'=>'job created successfully','jobid'=>$abc);
                echo json_encode($msg);
                
            }
        else{
                
                $msg = array('status'=>'Failed','msg'=>'Error!!');
                echo json_encode($msg);
            }
       
        }
    }
    
    public function issue_RFQ_list($ServiceID,$page){
      
      $serprolist =   $this->Member_Job_Model->get_ser_pro_list($ServiceID,$page);
        
        echo json_encode($serprolist);   
    }
    
    public function invite($SerproID,$jobID){
      
      $inv_list =   $this->Member_Job_Model->invite_list($SerproID,$jobID);
        
        // echo json_encode($inv_list);   
    }
    
    public function service_provider_profile($ServiceProviderID)
    {
        $serviceproviderdata =   $this->Member_Job_Model->get_service_provider_profile($ServiceProviderID);
        
        echo json_encode($serviceproviderdata);
    }
    
     public function service_provider_list($jobID,$page){
      
      $serprolist =   $this->Member_Job_Model->get_ser_proAR_list($jobID,$page);
        
        echo json_encode($serprolist);   
    }
    
     public function selectSP($jobID,$serproID){
      
      $sel_sp =   $this->Member_Job_Model->select_one_SP($jobID,$serproID);
      
        //  $this->Member_Job_Model->post_SP_data($jobID,$sel_sp);
         
    }
    
    
    public function complete_job($jobid)
    {

  
       $update = $this->Member_Job_Model->update_complete_job_data($jobid);
  
       if($update){
           
            $datas = array('status'=>'Success', 'msg'=>'Job Completed');
        
            echo json_encode($datas);
            
        }else{
           
            $datas = array('status'=>'Failed', 'msg'=>'Error!!');
        
            echo json_encode($datas);
        }
    }
    
    public function get_all_job()
    {
        
        $jobdata =   $this->Member_Job_Model->get_job_data();
        
        echo json_encode($jobdata);
        // echo $jobdata;
    }
    
    public function get_new_responded_job()
    {
        $jobdata =   $this->Member_Job_Model->get_new_responded_job_data();
        
        echo json_encode($jobdata);
    }
    
    public function get_confirmed_job()
    {
        $jobdata =   $this->Member_Job_Model->get_confirmed_job_data();
        
        echo json_encode($jobdata);
    }
    
    public function list_service_provider()
    {
        $jobdata =   $this->Member_Job_Model->list_services_data_job();
        
        echo json_encode($jobdata);
    }
    
    public function list_completed_job()
    {
        $jobdata =   $this->Member_Job_Model->list_completed_job_data();
        
        echo json_encode($jobdata);
    }
    
    public function closed_jobs()
    {
        $jobdata =   $this->Member_Job_Model->get_closed_jobs();
        
        echo json_encode($jobdata);
    }
    
}