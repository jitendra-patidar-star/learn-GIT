<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_Job_Model extends CI_Model {

   	public function __construct()
	{
		parent::__construct();
	}
	public function job_data_for_member_data($userid,$type,$page)
	{
	  $limit_per_page = 6;
	   $lower=$page*$limit_per_page;
	      
	                $this->db->select('*');
	                $this->db->from('Job');
	                $this->db->where(array('MemberID'=>$userid));
	                
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
	                $q =   $this->db->get()->result_array();
	           
	            return $q;

	}
	
	public function jobdata_for_member_data($userid,$jobid)
	{
	    
	 $q =  $this->db->select('*')
	                ->from('Job')
	                ->where(array('MemberID'=>$userid,'JobID'=>$jobid))
	                ->get();
	           
	 return $q->result_array();

	}
	
	
	public function issue_rfq_insert($newdata)
	{
	    $this->db->insert('Job',$newdata);
	}
	
	
	public function job_id($memberid,$serviceid)
	{
	       $this->db->select('JobID');
	       $this->db->where(array('MemberID'=>$memberid,'ServiceID'=>$serviceid));
           $this->db->from('Job');
           $this->db->order_by("JobID", "desc");
           $this->db->limit(1);
           $query=$this->db->get();
           $x= $query->result_array();
           $tid= $x[0]['JobID'];
           return $tid;

	}
	
	public function job_IDE($memberid,$serviceid)
	{
	      $this->db->select('JobID');
	      $this->db->where(array('MemberID'=>$memberid,'ServiceID'=>$serviceid));
          $this->db->from('Job');
          $this->db->order_by("JobID", "desc");
          $this->db->limit(1);
          $query=$this->db->get();
          $x= $query->result_array();
          $tid= $x[0]['JobID'];
          return $tid;
	}
	
	public function Mdata($memberid)
	{
	    $q =   $this->db->select('FirstName,LastName,Phone,Email')
    	             ->from('Member')
    	             ->where('MemberID',$memberid)
    	             ->get();
    	           //  ->result_array();
    	           //  print_r($q);
    	           //  die;
    	 return $q->result_array();
	}
	
	public function MUJdata($ab,$mdata)
	{
	   $this->db->where('JobID',$ab)
	             ->update('Job',$mdata[0]);
	}
	
	
		public function Sdata($serviceid)
	{
	    $q =   $this->db->select('ServiceE,ServiceTC,ServiceSC')
    	             ->from('Service')
    	             ->where('ServiceID',$serviceid)
    	             ->get();
    	           //  ->result_array();
    	return $q->result_array();           
	}
	
		public function SUJdata($ab,$sdata)
	{
	    $this->db->where('JobID',$ab)
	             ->update('Job',$sdata[0]);
	             
             
     $jobhistory= array('JobID'=>$ab,'JobStageFrom'=>0,'JobStageTo'=>10,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);	             
	}
	
	public function images_update($ab,$newdata)
	{
	   
	    $q = $this->db->where('JobID',$ab)
	                    ->update('Job',$newdata);
	   

	}
	
	public function get_ser_pro_list($ServiceID,$page){
	    $fact=[];
	    
	   $limit_per_page = 6;
	   $lower=$page*$limit_per_page;
	    
        $this->db->SELECT('ServiceProviderID');
        $this->db->WHERE(array('ServiceID'=>$ServiceID));
        $this->db->FROM('Provider_Service');
        $this->db->limit($limit_per_page, $lower);
        $E = $this->db->get()->result_array();

        foreach($E as $e){
            $SPID = $e['ServiceProviderID'];
            
            $array=[];
            
            $array['ServiceProviderID'] = $SPID;
            
    	$q =   $this->db->select('CompanyName,FirstName,LastName,MemberSince,CreditScore')
    	             ->from('Service_Provider')
    	             ->where('ServiceProviderID',$SPID)
    	             ->get();
    	            
    	 $sdata= $q->result_array();
    // 	  print_r($sdata);
    // 	             die;
    	 $array['CompanyName'] = $sdata[0]['CompanyName'];
    	  $array['FirstName'] = $sdata[0]['FirstName'];
    	   $array['LastName'] = $sdata[0]['LastName'];
    // 	 $array['Address'] = $sdata[0]['Address'];
    // 	 $array['Phone'] = $sdata[0]['Phone'];
    // 	 $array['Email'] = $sdata[0]['Email'];
    // 	 $array['Profile'] = $sdata[0]['Profile'];
    	 $array['MemberSince'] = $sdata[0]['MemberSince'];
    	 $array['CreditScore'] = $sdata[0]['CreditScore'];
    	 
    	 $countinvite = $this->db->select('count(AcceptRFQ)as total_invite')
              ->from ('Job_Provider')
              ->where(array('ServiceProviderID'=>$SPID))
              ->get();
            
            $cinvite = $countinvite->result_array();
            
            $array['job_invite'] = $cinvite[0]['total_invite'];
    	 
    	 $count30 = $this->db->select('count(stageID)as TotalCountForStageID30')
              ->from ('Job')
              ->where(array('StageID'=>30,'ServiceProviderID'=>$SPID))
              ->get();
            
            $c30 = $count30->result_array();
            
            $array['job_in_progress'] = $c30[0]['TotalCountForStageID30'];
    	 
    	 
    	  $count82 = $this->db->select('count(stageID)as TotalCountForStageID82')
              ->from ('Job')
              ->where(array('StageID'=>82,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c82 = $count82->result_array();
            
            $count81 = $this->db->select('count(stageID)as TotalCountForStageID81')
              ->from ('Job')
              ->where(array('StageID'=>81,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c81 = $count81->result_array();
            
            $count83 = $this->db->select('count(stageID)as TotalCountForStageID83')
              ->from ('Job')
              ->where(array('StageID'=>83,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c83 = $count83->result_array();
            
            $count84 = $this->db->select('count(stageID)as TotalCountForStageID84')
              ->from ('Job')
              ->where(array('StageID'=>84,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c84 = $count84->result_array();
            
            $count85 = $this->db->select('count(stageID)as TotalCountForStageID85')
              ->from ('Job')
              ->where(array('StageID'=>85,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c85 = $count85->result_array();
            
            $count91 = $this->db->select('count(stageID)as TotalCountForStageID91')
              ->from ('Job')
              ->where(array('StageID'=>91,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c91 = $count91->result_array();
            
           $sum=$c82[0]['TotalCountForStageID82']+$c81[0]['TotalCountForStageID81']+$c83[0]['TotalCountForStageID83']+$c84[0]['TotalCountForStageID84']+$c85[0]['TotalCountForStageID85']+$c91[0]['TotalCountForStageID91'];
            
            $array['job_completed'] = $sum;
            
            array_push($fact,$array);
            
        }
        // $this->db->order_by('CreditScore', 'asc');
        return $fact;
	}
	
	public function invite_list($serproid,$jobID){
	   
	    	  $joboroviderdata = array('ServiceProviderID'=>$serproid,'JobID'=>$jobID,'AcceptRFQ'=> 2);

	            $this->db->insert('Job_Provider',$joboroviderdata);
                // ->where(array('ServiceProviderID'=>$serproid,'JobID'=>$jobid));
//                 return $q;

$creditscore=$this->db-> select('CreditScore')
	    	                ->from('Service_Provider')
	                       ->where('ServiceProviderID',$serproid)
	                        ->get()
	                        ->result_array();
	                        
	                       // print_r($creditscore);
	                       // die;
	                        
      $cs=$creditscore[0]['CreditScore'];
            
      $ucs=($cs)+20;
	    
	    $serprodata =  array('CreditScore' => $ucs);
	    
	     $state=   $this->db->where('ServiceProviderID', $serproid)->update('Service_Provider',$serprodata);

      
	    
	 
	   
	   $serprocreditscore = array('ServiceProviderID'=>$serproid,'JobID'=>$jobID,'RuleApplied'=>'5','CreditScoreBF'=>$cs,'CreditScoreApplied'=>20,'CreditScoreCF'=>$ucs,'DateTime'=>date('Y-m-d H:i:s'));
	   $this->db->insert('Service_Provider_Credit_Score_Log',$serprocreditscore);
	}
	
	public function get_service_provider_profile($ServiceProviderID)
	{
	    $array=[];
    	$q =   $this->db->select('CompanyName,FirstName,LastName,Address,Phone,Email,Profile,MemberSince,CreditScore')
    	             ->from('Service_Provider')
    	             ->where('ServiceProviderID',$ServiceProviderID)
    	             ->get();
    	            
    	 $sdata= $q->result_array();
    // 	  print_r($sdata);
    // 	             die;
    	 $array['CompanyName'] = $sdata[0]['CompanyName'];
    	  $array['FirstName'] = $sdata[0]['FirstName'];
    	   $array['LastName'] = $sdata[0]['LastName'];
    	 $array['Address'] = $sdata[0]['Address'];
    	 $array['Phone'] = $sdata[0]['Phone'];
    	 $array['Email'] = $sdata[0]['Email'];
    	 $array['Profile'] = $sdata[0]['Profile'];
    	 $array['MemberSince'] = $sdata[0]['MemberSince'];
    	 $array['CreditScore'] = $sdata[0]['CreditScore'];
    	 
    	 $countinvite = $this->db->select('count(AcceptRFQ)as total_invite')
              ->from ('Job_Provider')
              ->where(array('ServiceProviderID'=>$ServiceProviderID))
              ->get();
            
            $cinvite = $countinvite->result_array();
            
            $array['job_invite'] = $cinvite[0]['total_invite'];
    	 
    	 $count30 = $this->db->select('count(stageID)as TotalCountForStageID30')
              ->from ('Job')
              ->where(array('StageID'=>30,'ServiceProviderID'=>$ServiceProviderID))
              ->get();
            
            $c30 = $count30->result_array();
            
            $array['job_in_progress'] = $c30[0]['TotalCountForStageID30'];
    	 
    	 
    	  $count82 = $this->db->select('count(stageID)as TotalCountForStageID82')
              ->from ('Job')
              ->where(array('StageID'=>82,'ServiceProviderID'=>$ServiceProviderID))
              ->get();
           
            $c82 = $count82->result_array();
            
            $count81 = $this->db->select('count(stageID)as TotalCountForStageID81')
              ->from ('Job')
              ->where(array('StageID'=>81,'ServiceProviderID'=>$ServiceProviderID))
              ->get();
           
            $c81 = $count81->result_array();
            
            $count83 = $this->db->select('count(stageID)as TotalCountForStageID83')
              ->from ('Job')
              ->where(array('StageID'=>83,'ServiceProviderID'=>$ServiceProviderID))
              ->get();
           
            $c83 = $count83->result_array();
            
            $count84 = $this->db->select('count(stageID)as TotalCountForStageID84')
              ->from ('Job')
              ->where(array('StageID'=>84,'ServiceProviderID'=>$ServiceProviderID))
              ->get();
           
            $c84 = $count84->result_array();
            
            $count85 = $this->db->select('count(stageID)as TotalCountForStageID85')
              ->from ('Job')
              ->where(array('StageID'=>85,'ServiceProviderID'=>$ServiceProviderID))
              ->get();
           
            $c85 = $count85->result_array();
            
            $count91 = $this->db->select('count(stageID)as TotalCountForStageID91')
              ->from ('Job')
              ->where(array('StageID'=>91,'ServiceProviderID'=>$ServiceProviderID))
              ->get();
           
            $c91 = $count91->result_array();
            
           $sum=$c82[0]['TotalCountForStageID82']+$c81[0]['TotalCountForStageID81']+$c83[0]['TotalCountForStageID83']+$c84[0]['TotalCountForStageID84']+$c85[0]['TotalCountForStageID85']+$c91[0]['TotalCountForStageID91'];
            
            $array['job_completed'] = $sum;
    	 
    	 return $array;

	}
	
	
	
	public function get_ser_proAR_list($jobID,$page){
	    $fact=[];
	    $limit_per_page = 6;
	   $lower=$page*$limit_per_page;
	    
	    
        $this->db->SELECT('ServiceProviderID');
        $this->db->WHERE(array('JobID'=>$jobID));
        $this->db->FROM('Job_Provider');
        $this->db->limit($limit_per_page, $lower);
        $E = $this->db->get()->result_array();

        foreach($E as $e){
            $SPID = $e['ServiceProviderID'];
            
            $array=[];
            
            $array['ServiceProviderID']=$SPID;
            
    	$q =   $this->db->select('CompanyName,FirstName,LastName,MemberSince,CreditScore')
    	             ->from('Service_Provider')
    	             ->where('ServiceProviderID',$SPID)
    	             ->get();
    	            
    	 $sdata= $q->result_array();
    // 	  print_r($sdata);
    // 	             die;
    	 $array['CompanyName'] = $sdata[0]['CompanyName'];
    	  $array['FirstName'] = $sdata[0]['FirstName'];
    	   $array['LastName'] = $sdata[0]['LastName'];
    // 	 $array['Address'] = $sdata[0]['Address'];
    // 	 $array['Phone'] = $sdata[0]['Phone'];
    // 	 $array['Email'] = $sdata[0]['Email'];
    // 	 $array['Profile'] = $sdata[0]['Profile'];
    	 $array['MemberSince'] = $sdata[0]['MemberSince'];
    	 $array['CreditScore'] = $sdata[0]['CreditScore'];
    	 
    	 
    	 $status=$this->db->select('AcceptRFQ as status')
              ->from ('Job_Provider')
              ->where(array('JobID'=>$jobID,'ServiceProviderID'=>$SPID))
              ->get();
            
            $cstatus = $status->result_array();
            // print_r($cstatus);
            // die;
            
            $array['status'] = $cstatus[0]['status'];
    	 
    	 $countinvite = $this->db->select('count(AcceptRFQ)as total_invite')
              ->from ('Job_Provider')
              ->where(array('ServiceProviderID'=>$SPID))
              ->get();
            
            $cinvite = $countinvite->result_array();
            
            $array['job_invite'] = $cinvite[0]['total_invite'];
    	 
    	 $count30 = $this->db->select('count(stageID)as TotalCountForStageID30')
              ->from ('Job')
              ->where(array('StageID'=>30,'ServiceProviderID'=>$SPID))
              ->get();
            
            $c30 = $count30->result_array();
            
            $array['job_in_progress'] = $c30[0]['TotalCountForStageID30'];
    	 
    	 
    	  $count82 = $this->db->select('count(stageID)as TotalCountForStageID82')
              ->from ('Job')
              ->where(array('StageID'=>82,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c82 = $count82->result_array();
            
            $count81 = $this->db->select('count(stageID)as TotalCountForStageID81')
              ->from ('Job')
              ->where(array('StageID'=>81,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c81 = $count81->result_array();
            
            $count83 = $this->db->select('count(stageID)as TotalCountForStageID83')
              ->from ('Job')
              ->where(array('StageID'=>83,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c83 = $count83->result_array();
            
            $count84 = $this->db->select('count(stageID)as TotalCountForStageID84')
              ->from ('Job')
              ->where(array('StageID'=>84,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c84 = $count84->result_array();
            
            $count85 = $this->db->select('count(stageID)as TotalCountForStageID85')
              ->from ('Job')
              ->where(array('StageID'=>85,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c85 = $count85->result_array();
            
            $count91 = $this->db->select('count(stageID)as TotalCountForStageID91')
              ->from ('Job')
              ->where(array('StageID'=>91,'ServiceProviderID'=>$SPID))
              ->get();
           
            $c91 = $count91->result_array();
            
           $sum=$c82[0]['TotalCountForStageID82']+$c81[0]['TotalCountForStageID81']+$c83[0]['TotalCountForStageID83']+$c84[0]['TotalCountForStageID84']+$c85[0]['TotalCountForStageID85']+$c91[0]['TotalCountForStageID91'];
            
            $array['job_completed'] = $sum;
            
            array_push($fact,$array);
            
        }
        
        return $fact;
	}
	
	
	
	public function select_one_SP($jobID,$serproid){
	    
	     $q =   $this->db->select('FirstName,LastName,CompanyName,Address,Phone,Email')
    	             ->from('Service_Provider')
    	             ->where('ServiceProviderID',$serproid)
    	             ->get()
    	             ->result_array();
    	             
    	 $data= array('ServiceProviderID' => $serproid,'StageID' => 30, 'Stage30Date' =>date('Y-m-d H:i:s'));
	     $this->db->where('JobID',$jobID)
	             ->update('Job',$data);
	     $module= array('ServiceProviderFirstName'=>$q[0]['FirstName'],'ServiceProviderLastName'=>$q[0]['LastName'],'CompanyName'=>$q[0]['CompanyName'],'ServiceProviderAddress'=>$q[0]['Address'],'ServiceProviderPhone'=>$q[0]['Phone'],'ServiceProviderEmail'=>$q[0]['Email']);         
	     $this->db->where('JobID',$jobID)
	             ->update('Job',$module);
	             
	             $creditscore=$this->db-> select('CreditScore')
	    	                ->from('Service_Provider')
	                       ->where('ServiceProviderID',$serproid)
	                        ->get()
	                        ->result_array();
	                        
	                       // print_r($creditscore);
	                       // die;
	                        
      $cs=$creditscore[0]['CreditScore'];
            
      $ucs=($cs)+20;
	    
	    $serprodata =  array('CreditScore' => $ucs);
	    
	     $state=   $this->db->where('ServiceProviderID', $serproid)->update('Service_Provider',$serprodata);

      
	    
	 
	   
	   $serprocreditscore = array('ServiceProviderID'=>$serproid,'JobID'=>$jobID,'RuleApplied'=>'6','CreditScoreBF'=>$cs,'CreditScoreApplied'=>20,'CreditScoreCF'=>$ucs,'DateTime'=>date('Y-m-d H:i:s'));
	   $this->db->insert('Service_Provider_Credit_Score_Log',$serprocreditscore);
	             
	             
	             
	     $jobhistory= array('JobID'=>$jobID,'JobStageFrom'=>20,'JobStageTo'=>30,'DateTime'=>date('Y-m-d H:i:s'));
	     $this->db->insert('Job_Stage_History',$jobhistory);
	     
	      $joboroviderdata = array('AcceptRFQ'=>3);
	   // $this->db->where(array())
	   $this->db->where(array('ServiceProviderID'=>$serproid,'JobID'=>$jobID))
	            ->update('Job_Provider',$joboroviderdata);
	}
	
// 		public function post_SP_data($jobID,$serproID,$sel_sp){
	     
	     
// 	     $data= array('ServiceProviderID' => $serproID,'StageID' => 30, 'Stage30Date' =>date('Y-m-d H:i:s'));
// 	     $this->db->where('JobID',$jobID)
// 	             ->update('Job',$data);
	             
// 	     $this->db->where('JobID',$jobID)
// 	             ->update('Job',$sel_sp[0]);
	             
// 	     $jobhistory= array('JobID'=>$jobID,'JobStageFrom'=>20,'JobStageTo'=>30,'DateTime'=>date('Y-m-d H:i:s'));
// 	     $this->db->insert('Job_Stage_History',$jobhistory);
	     
// 	}
	
	public function get_job_data()
	{
	    $q =   $this->db->select('*')
    	             ->from('Job')
    	             ->get();
    	             
    	 return $q->result_array();
	}
	
	public function update_complete_job_data($jobid)
	{

	   $data = array('StageID' => 81,'Stage8XDate' => date('Y-m-d H:i:s'));
	    
	    $this->db->where('JobID',$jobid)
	             ->update('Job',$data);
	            
	    	 
	  // 1 april 2021 start
	    //get member data 
	    $jobdata = $this->db-> select('MemberID')
	    	                ->from('Job')
	                       ->where('JobID',$jobid)
	                        ->get()
	                        ->result_array();
	   
	   // $memberArray = $jobdata->result_array();
	   // print_r($jobdata);
	   // die;
	    
	        $memberid = $jobdata[0]['MemberID'];
	    
    //     print_r($memberid);
	   // die;
      $creditscore=$this->db-> select('CreditScore')
	    	                ->from('Member')
	                       ->where('MemberID',$memberid)
	                        ->get()
	                        ->result_array();
      $cs=$creditscore[0]['CreditScore'];
            
      $ucs=($cs)+10;
	    
	    $memberdata =  array('CreditScore' => $ucs);
	    
	     $state=   $this->db->where('MemberID', $memberid)->update('Member',$memberdata);

      
	    
	 
	   
	   $membercreditscore = array('MemberID'=>$memberid,'JobID'=>$jobid,'RuleApplied'=>'9','CreditScoreBF'=>$cs,'CreditScoreApplied'=>10,'CreditScoreCF'=>$ucs,'DateTime'=>date('Y-m-d H:i:s'));
	   $this->db->insert('Member_Credit_Score_Log',$membercreditscore);
	   
	   $jobhistory= array('JobID'=>$jobid,'JobStageFrom'=>30,'JobStageTo'=>81,'DateTime'=>date('Y-m-d H:i:s'));
	 $this->db->insert('Job_Stage_History',$jobhistory);
	   return true;
	   
	   
	   
	}
	
	
	
	public function get_new_responded_job_data()
	{
	     $q =   $this->db->select('*')
    	             ->from('Job')
    	             ->where('StageID >=',10)
    	             ->get();
    	             
    	 return $q->result_array();
	}
	
	public function get_confirmed_job_data()
	{
	     $q =   $this->db->select('*')
    	             ->from('Job')
    	             ->where('StageID >=',30)
    	             ->get();
    	             
    	 return $q->result_array();
	}
	
	public function list_services_data_job()
	{
	     $q =   $this->db->select('*')
    	             ->from('Job')
    	             ->join('Job_Provider','Job_Provider.JobID = Job.JobID')
    	             ->get();
    	             
    	 return $q->result_array();
	}
	
	public function list_completed_job_data()
	{
	    
	     $q =   $this->db->select('*')
    	             ->from('Job')
    	             ->join('Job_Provider','Job_Provider.JobID = Job.JobID')
    	             ->where('AcceptRFQ !=','')
    	             ->get();
    	             
    	 return $q->result_array();
	}
	
	public function get_closed_jobs()
	{
	     $q =   $this->db->select('*')
        	             ->from('Job')
        	             ->join('Job_Provider','Job_Provider.JobID = Job.JobID')
        	             ->where('AcceptRFQ !=','')
        	             ->get();
    	             
    	 return $q->result_array();
	}
	
	
}