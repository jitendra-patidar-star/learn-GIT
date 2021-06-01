<?php
class Rating_model extends CI_model{
    public function __construct(){
        parent::__construct();
    }
    
    //database query for member rating 2 service provider
    public function get_stageID($jobid){
      
        $checkstage = $this->db->SELECT('StageID')
                                 ->where(array('JobID' => $jobid))
                                 ->from('Job')
                                 ->get();
        $result = $checkstage->result_array();
        return $result;
    }
    
    public function rating_insert($newdata,$jobid){
        $this->db->where('JobID',$jobid)->update('Job',$newdata);
        
        // $checkstage = $this->db->SELECT('JobStageTo')
        //                          ->where(array('JobID' => $jobid))
        //                          ->from('Job_Stage_History')
        //                          ->get();
        // $result = $checkstage->result_array();
        // if($result[0]==array('JobStageTo'=>82)){
            
        // }
        // else{
            
        // }
        $jobdata = $this->db-> select('ServiceProviderID')
	    	                ->from('Job')
	                       ->where('JobID',$jobid)
	                        ->get()
	                        ->result_array();
	  
	    
	        $serproid = $jobdata[0]['ServiceProviderID'];
	    
   
      $creditscore=$this->db-> select('CreditScore')
	    	                ->from('Service_Provider')
	                       ->where('ServiceProviderID',$serproid)
	                        ->get()
	                        ->result_array();
      $cs=$creditscore[0]['CreditScore'];
      
      $rate=$newdata['Member2ServiceProviderRating'];
            
      $ucs=($cs)+$rate;
	    
	    $serprodata =  array('CreditScore' => $ucs);
	    
	     $state=   $this->db->where('ServiceProviderID', $serproid)->update('Service_Provider',$serprodata);

      
	    
	 
	   
	   $serprocreditscore = array('ServiceProviderID'=>$serproid,'JobID'=>$jobid,'RuleApplied'=>'10','CreditScoreBF'=>$cs,'CreditScoreApplied'=>$rate,'CreditScoreCF'=>$ucs,'DateTime'=>date('Y-m-d H:i:s'));
	   $this->db->insert('Service_Provider_Credit_Score_Log',$serprocreditscore);
    }
    
    public function update_stage_81($jobid){
        $data = array('StageID' => 83,'Stage8XDate' => date('Y-m-d H:i:s'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	  $jobhistory= array('JobID'=>$jobid,'JobStageFrom'=>81,'JobStageTo'=>83,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);
    }
    
    public function update_stage_82($jobid){
        $data = array('StageID' => 83,'Stage8XDate' => date('Y-m-d H:i:s'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	  $jobhistory= array('JobID'=>$jobid,'JobStageFrom'=>82,'JobStageTo'=>83,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);
    }
    
    public function update_stage_84($jobid){
        $data = array('StageID' => 85,'Stage8XDate' => date('Y-m-d H:i:s'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	   $jobhistory= array('JobID'=>$jobid,'JobStageFrom'=>84,'JobStageTo'=>85,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);
    }
    
    //database query for service provider rating 2 member
    public function got_stageID($jobid){
      
        $checkstage = $this->db->SELECT('StageID')
                                 ->where(array('JobID' => $jobid))
                                 ->from('Job')
                                 ->get();
        $result = $checkstage->result_array();
        return $result;
    }
    
    public function rate_insert($newdata,$jobid){
        $this->db->where('JobID',$jobid)->update('Job',$newdata);
        
        // $checkstage = $this->db->SELECT('JobStageTo')
        //                          ->where(array('JobID' => $jobid))
        //                          ->from('Job_Stage_History')
        //                          ->get();
        // $result = $checkstage->result_array();
        // if($result[0]==array('JobStageTo'=>82)){
            
        // }
        // else{
            
        // }
         $jobdata = $this->db-> select('MemberID')
	    	                ->from('Job')
	                       ->where('JobID',$jobid)
	                        ->get()
	                        ->result_array();
	  
	    
	        $memberid = $jobdata[0]['MemberID'];
	    
   
      $creditscore=$this->db-> select('CreditScore')
	    	                ->from('Member')
	                       ->where('MemberID',$memberid)
	                        ->get()
	                        ->result_array();
      $cs=$creditscore[0]['CreditScore'];
      
      $rate=$newdata['ServiceProvider2MemberRating'];
            
      $ucs=($cs)+$rate;
	    
	    $memberdata =  array('CreditScore' => $ucs);
	    
	     $state=   $this->db->where('MemberID', $memberid)->update('Member',$memberdata);

      
	    
	 
	   
	   $membercreditscore = array('MemberID'=>$memberid,'JobID'=>$jobid,'RuleApplied'=>'11','CreditScoreBF'=>$cs,'CreditScoreApplied'=>$rate,'CreditScoreCF'=>$ucs,'DateTime'=>date('Y-m-d H:i:s'));
	   $this->db->insert('Member_Credit_Score_Log',$membercreditscore);
    }
    
    public function update_stagee_81($jobid){
        $data = array('StageID' => 84,'Stage8XDate' => date('Y-m-d H:i:s'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	  $jobhistory= array('JobID'=>$jobid,'JobStageFrom'=>81,'JobStageTo'=>84,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);
    }
    
    public function update_stagee_82($jobid){
        $data = array('StageID' => 84,'Stage8XDate' => date('Y-m-d H:i:s'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	  $jobhistory= array('JobID'=>$jobid,'JobStageFrom'=>82,'JobStageTo'=>84,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);
    }
    
    public function update_stagee_83($jobid){
        $data = array('StageID' => 85,'Stage8XDate' => date('Y-m-d H:i:s'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	   $jobhistory= array('JobID'=>$jobid,'JobStageFrom'=>83,'JobStageTo'=>85,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);
    }
    
    
    
}