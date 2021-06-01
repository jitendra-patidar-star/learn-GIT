    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_Provider_Job_Model extends CI_Model {

   	public function __construct()
	{
		parent::__construct();
	}
	
		public function service_provider_update($jobid,$data)
	{
	   
	    $q = $this->db->where('JobID',$jobid)
	                    ->update('Job',$data);
	   
	}
	
	public function job_data_for_service_provider_data($userid,$type,$page)
	{
	    $limit_per_page = 6;
	    $lower=$page*$limit_per_page;
	    
	     $arre=[]; 
	     
	      $this->db->select('JobID');
       
	                 $this->db->from('Job_Provider');

                     $this->db->where(array('ServiceProviderID'=>$userid));
    if($type==1)
	 {  
	     
    $typ='asc';
	
	 }
	 
	 elseif($type==0)
	 {
	     
	      $typ='desc';
	     
	 }
	 
	 else
	 {
	     return false;
	 }

	                $this->db->order_by('JobID', $typ);
                     $this->db->limit($limit_per_page, $lower);
	                $q=$this->db->get()
	                        ->result_array();

	               // print_r($q);
	               // die;

// 	  $q =  $a->result_array();
// 	   print_r($q);
// 	                die;
    // 	$data= array('cat_id'=>$q);
    	
      foreach($q as $e){
    	 $jobID = $e['JobID'];
    	 
        $b= $this->db->select('Job.JobID,Job.JobDate,Job.ServiceE,Job.StageID,Job_Provider.AcceptRFQ')
    	             ->from('Job')
    	             ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
    	             ->where(array('Job.JobID'=>$jobID,'Job_Provider.ServiceProviderID'=>$userid))
    	             ->get()
    	             ->result_array();
	       array_push($arre,$b[0]);     
	 
      }
        return $arre;
	 
	}
	
	

	
		public function selected_job_data_for_service_provider($jobid)
	{
	    
	 $q =  $this->db->select('*')
	                ->from('Job')
	                ->join('Member','Member.MemberID=Job.MemberID')
	                ->where(array('JobID'=>$jobid))
	                ->get();
	           
	 return $q->result_array();

	}
	
	public function get_new_responded_job_data()
	{   
	     $q =  $this->db->select('*')
	                ->from('Job')
	                ->where('StageID <=',10)
	                ->get();
	           
	    return $q->result_array();
	    
	}
	
	public function update_job_stage($jobid)
	{
	    
	    $data = array('StageID' => 20,'Stage20Date'=> date('Y-m-d'));
	    
	    $data = $this->db->where('JobID',$jobid)->update('Job',$data);
	   
	    
        if($data){
            // 0 = accept, 1 = reject
            
            $joboroviderdata = array('AcceptRFQ'=>'','RejectReasonE'=>'','RejectReasonTC'=>'','RejectReasonSC'=>'','ReplyDate'=>'');
    	    return $this->db->where('JobID',$jobid)
    	             ->update('Job_Provider',$joboroviderdata);
            
        }
        else{
            return 0;    
        }
	    
	}
	
	public function update_job_reject_stage($jobid)
	{
	    $data = array('StageID' => 20,'Stage20Date'=> date('Y-m-d'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	             
	             
	    $joboroviderdata = array('AcceptRFQ'=>'','RejectReasonE'=>'','RejectReasonTC'=>'','RejectReasonSC'=>'','ReplyDate'=>'');
	    $this->db->where('JobID',$jobid)
	             ->update('Job_Provider',$joboroviderdata);
	    
	}
	
	public function all_confirmed_job_data()
	{
	  $q =   $this->db->select('*')
	                  ->where('StageID',20)
	                  ->from('Job');
	                  
	  return $q->result_array();
	}
	
	public function update_complete_job_data($jobid)
	{
//'img1'=>$data['img1'],'img2'=>$data['img2'],'img3'=>$data['img3'],
	    $data = array('StageID' => 82,'Stage8xDate'=> date('Y-m-d'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	            
	    	 
	     // 1 april 2021 start
	    //get serviceprovider data 
	    $jobdata = $this->db-> select('ServiceProviderID')
	    	                ->from('Job')
	                       ->where('JobID',$jobid)
	                        ->get()
	                        ->result_array();
	   
	   // $memberArray = $jobdata->result_array();
	   // print_r($jobdata);
	   // die;
	    
	        $serproid = $jobdata[0]['ServiceProviderID'];
	    
    //     print_r($memberid);
	   // die;
      $creditscore=$this->db-> select('CreditScore')
	    	                ->from('Service_Provider')
	                       ->where('ServiceProviderID',$serproid)
	                        ->get()
	                        ->result_array();
	                        
	                       // print_r($creditscore);
	                       // die;
	                        
      $cs=$creditscore[0]['CreditScore'];
     
            
      $ucs=($cs)+10;
	    
	    $serprodata =  array('CreditScore' => $ucs);
	    
	     $state=   $this->db->where('ServiceProviderID', $serproid)->update('Service_Provider',$serprodata);

      
	    
	 
	   
	   $serprocreditscore = array('ServiceProviderID'=>$serproid,'JobID'=>$jobid,'RuleApplied'=>'9','CreditScoreBF'=>$cs,'CreditScoreApplied'=>10,'CreditScoreCF'=>$ucs,'DateTime'=>date('Y-m-d H:i:s'));
	   $this->db->insert('Service_Provider_Credit_Score_Log',$serprocreditscore);
	   
	   $jobhistory= array('JobID'=>$jobid,'JobStageFrom'=>30,'JobStageTo'=>82,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);
	 
	   return true;
	   
	   //  echo 'order has successfully been deleted';
	}
	
	public function get_complete_job_data()
	{
       $q = $this->db->select('*')
    	             ->from('Job')
    	             ->where('StageID >=',82)
    	             ->get();
    	             
      return $q->result_array();
	}
	
	public function get_job_by_id($jobid)
	{
	    $q = $this->db->select('*')
    	             ->from('Job')
    	             ->where('JobID >=',$jobid)
    	             ->get();
       return $q->result_array();
	}
	
	public function update_member_credit_score($memberid)
	{
	    $data = array('CreditScore'=>'');
	    $this->db->where('MemberID',$memberid)
	             ->update('Member',$data);
	}
	public function get_job_member_data($jobid)
	{
	    

$q = $this->db->select('*')
         ->where('Job.JobID', $jobid)
         ->from('Job')
         ->join('Member', 'Job.MemberID = Member.MemberID', 'full')
         ->get();

return $q->result_array();
	}
	public function got_stageID($jobid){
      
        $checkstage = $this->db->SELECT('StageID')
                                 ->where(array('JobID' => $jobid))
                                 ->from('Job')
                                 ->get();
        $result = $checkstage->result_array();
        // print_r($result);
        // die;
        return $result;
    }
    public function update_stage_10($jobid,$serproid){
        $data = array('StageID' => 20,'Stage20Date' => date('Y-m-d H:i:s'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	 
	 $jobhistory= array('JobID'=>$jobid,'JobStageFrom'=>10,'JobStageTo'=>20,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);
	 
// 	 $accepted=0{AcceptRFQ};
// 	 $reject0="no";
	
	 
	 
	  $joboroviderdata = array('AcceptRFQ'=> 0);
	   // $this->db->where(array())
	   $this->db->where(array('ServiceProviderID'=>$serproid,'JobID'=>$jobid))
	            ->update('Job_Provider',$joboroviderdata);
        
    }
     public function update_stage($jobid,$serproid,$newdata){
        //$rejcted=1{AcceptRFQ};
// 	 $reject1="Budget_too_Low";
// 	  $joboroviderdata = array('ServiceProviderID'=>$serproid,'JobID'=>$jobid,'AcceptRFQ'=> 1,'RejectReasonTC'=>'','RejectReasonSC'=>'','ReplyDate'=>date('Y-m-d'));
	   //$joboroviderdata[4]=array('RejectReasonE'=>$newdata);
	   // $this->db->where(array('ServiceProviderID'=>$serproid,'JobID'=>$jobid))
	   //'RejectReasonE'=>$newdata,
// 	  $this->db->insert('Job_Provider',$joboroviderdata);
	            $this->db->where(array('ServiceProviderID'=>$serproid,'JobID'=>$jobid))
	                     ->update('Job_Provider',$newdata);
    }
}