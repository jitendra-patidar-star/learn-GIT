<?php
class StageID_model extends CI_model{
   
    public function get_count($serproid){
            $array = [];
        
       
        
        $a = $this->db->select('count(stageID)as new')
              ->from ('Job')
              ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
              ->where(array('Job.StageID'=>10,'Job_Provider.ServiceProviderID'=>$serproid,'Job_Provider.AcceptRFQ'=>2))
              ->get()
              ->result_array();
              
        $array['TotalCountForStageID10'] = $a[0]['new'];
            
           
        $b = $this->db->select('count(stageID)as new_one')
              ->from ('Job')
              ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
              ->where(array('Job.StageID'=>20,'Job_Provider.ServiceProviderID'=>$serproid,'Job_Provider.AcceptRFQ'=>2))
              ->get()
              ->result_array();      
              
        $array['TotalCountForStageID20'] = $b[0]['new_one'];
           
           
        $c = $this->db->select('count(stageID)as neww')
              ->from ('Job')
              ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
              ->where(array('Job.StageID'=>30,'Job_Provider.ServiceProviderID'=>$serproid,'Job_Provider.AcceptRFQ'=>3))
              ->get()
              ->result_array();
            
        $array['TotalCountForStageID30'] = $c[0]['neww'];
        
            $count82 = $this->db->select('count(stageID)as TotalCountForStageID82')
              ->from ('Job')
              ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
              ->where(array('Job.StageID'=>82,'Job_Provider.ServiceProviderID'=>$serproid,'Job_Provider.AcceptRFQ'=>3))
              ->get()
             ->result_array();
            
            $count81 = $this->db->select('count(stageID)as TotalCountForStageID81')
              ->from ('Job')
              ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
              ->where(array('Job.StageID'=>81,'Job_Provider.ServiceProviderID'=>$serproid,'Job_Provider.AcceptRFQ'=>3))
              ->get()
              ->result_array();
            
            $count83 = $this->db->select('count(stageID)as TotalCountForStageID83')
              ->from ('Job')
              ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
              ->where(array('Job.StageID'=>83,'Job_Provider.ServiceProviderID'=>$serproid,'Job_Provider.AcceptRFQ'=>3))
              ->get()
              ->result_array();
            
            $count84 = $this->db->select('count(stageID)as TotalCountForStageID84')
              ->from ('Job')
              ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
              ->where(array('Job.StageID'=>84,'Job_Provider.ServiceProviderID'=>$serproid,'Job_Provider.AcceptRFQ'=>3))
              ->get()
              ->result_array();
            
            $count85 = $this->db->select('count(stageID)as TotalCountForStageID85')
              ->from ('Job')
              ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
              ->where(array('Job.StageID'=>85,'Job_Provider.ServiceProviderID'=>$serproid,'Job_Provider.AcceptRFQ'=>3))
              ->get()
              ->result_array();
              
            $jode=$count81[0]['TotalCountForStageID81']+$count82[0]['TotalCountForStageID82']+$count83[0]['TotalCountForStageID83']+$count84[0]['TotalCountForStageID84']+$count85[0]['TotalCountForStageID85'];
            
            $array['TotalCountForStageID8X'] = $jode;
            
             $count91 = $this->db->select('count(stageID)as TotalCountForStageID91')
              ->from ('Job')
              ->join('Job_Provider','Job_Provider.JobID=Job.JobID')
              ->where(array('Job.StageID'=>91,'Job_Provider.ServiceProviderID'=>$serproid,'Job_Provider.AcceptRFQ'=>3))
              ->get()
              ->result_array();
            
            $array['TotalCountForStageID91'] = $count91[0]['TotalCountForStageID91'];
            // $array= [$c10,$c20,$c30,$c82];
            return $array;
    }
    
    
     public function get_count_member($memID){
            $array = [];
        
            $count10 = $this->db->select('count(stageID)as TotalCountForStageID10')
               ->from ('Job')
               ->where(array('StageID'=>10,'MemberID'=>$memID))
               ->get();
               
            $c10 = $count10->result_array();
           
            $array['TotalCountForStageID10'] = $c10[0]['TotalCountForStageID10'];
               
            $count20 = $this->db->select('count(stageID)as TotalCountForStageID20')
              ->from ('Job')
              ->where(array('StageID'=>20,'MemberID'=>$memID))
              ->get();
              
            $c20 = $count20->result_array();
            
            $array['TotalCountForStageID20'] = $c20[0]['TotalCountForStageID20'];
               
            $count30 = $this->db->select('count(stageID)as TotalCountForStageID30')
              ->from ('Job')
              ->where(array('StageID'=>30,'MemberID'=>$memID))
              ->get();
            
            $c30 = $count30->result_array();
            
            $array['TotalCountForStageID30'] = $c30[0]['TotalCountForStageID30'];
        
            $count82 = $this->db->select('count(stageID)as TotalCountForStageID82')
              ->from ('Job')
              ->where(array('StageID'=>82,'MemberID'=>$memID))
              ->get();
           
            $c82 = $count82->result_array();
            
            $count81 = $this->db->select('count(stageID)as TotalCountForStageID81')
              ->from ('Job')
              ->where(array('StageID'=>81,'MemberID'=>$memID))
              ->get();
           
            $c81 = $count81->result_array();
            
           
            
            
              $count83 = $this->db->select('count(stageID)as TotalCountForStageID83')
              ->from ('Job')
              ->where(array('StageID'=>83,'MemberID'=>$memID))
              ->get()
              ->result_array();
            
            $count84 = $this->db->select('count(stageID)as TotalCountForStageID84')
              ->from ('Job')
              ->where(array('StageID'=>84,'MemberID'=>$memID))
              ->get()
              ->result_array();
            
            $count85 = $this->db->select('count(stageID)as TotalCountForStageID85')
              ->from ('Job')
              ->where(array('StageID'=>85,'MemberID'=>$memID))
              ->get()
              ->result_array();
              
            $jode=$c82[0]['TotalCountForStageID82']+$c81[0]['TotalCountForStageID81']+$count83[0]['TotalCountForStageID83']+$count84[0]['TotalCountForStageID84']+$count85[0]['TotalCountForStageID85'];
            
            $array['TotalCountForStageID8X'] = $jode;
            
             $count91 = $this->db->select('count(stageID)as TotalCountForStageID91')
              ->from ('Job')
              ->where(array('StageID'=>91,'MemberID'=>$memID))
              ->get();
           
            $c91 = $count91->result_array();
            
            $array['TotalCountForStageID91'] = $c91[0]['TotalCountForStageID91'];
            // $array= [$c10,$c20,$c30,$c82];
            return $array;
    }
}
?>