<?php
class Service_type_data_model extends CI_model{
    public function __construct(){
        parent::__construct();
    }
    public function get_data(){
        $fact=[];
        //for selecting TypeID and TypeE from Service table
        $fetchE=$this->db->SELECT('TypeID,TypeE,')
        // ->WHERE(array('TypeID'=>$TypeID))
        ->FROM('Service_Type')
        ->get();
        $E = $fetchE->result_array();
        
        
      
        //for selecting particular services according to type id(multiple services exsits)
        foreach($E as $e){
                $TypeID = $e['TypeID'];
                $TypeE = $e['TypeE'];
                
                $fetchE=$this->db->SELECT('ServiceID as id,ServiceE as name,DescriptionE as description')
                ->WHERE(array('TypeID'=>$TypeID))
                ->FROM('Service')
                ->get();
                $E= $fetchE->result_array();
                
                // $fact['Type'] = $TypeE;
                // $fact['service_list'] = $E;
                array_push($fact,array('id'=>$TypeID,'categoryName'=>$TypeE,'subCategory'=>$E));
        }
        return $fact;
    }
    
    public function ser_data($ID){
        $fact=[];
        $fetchE=$this->db->SELECT('ServiceID')
        ->WHERE(array('ServiceProviderID'=>$ID))
        ->FROM('Provider_Service')
        ->get();
        $E = $fetchE->result_array();
        // print_r($E);
        // die;
        foreach($E as $e){
            $SID = $e['ServiceID'];
            // $TypeE = $e['TypeE'];
            
            $fetchE=$this->db->SELECT('ServiceID as id,TypeE as categoryName,ServiceE as name')
            ->WHERE(array('ServiceID'=>$SID))
            ->FROM('Service')
            ->get();
            $serviceArray= $fetchE->result_array();
            // print_r($serviceArray[0]);
            // $fact['Type'] = $TypeE;
            // $fact['service_list'] = $E;
            foreach($serviceArray as $rs){
                // print_r($rs);
                array_push($fact,$rs);
            }
            
            // return $E;
                
        }
        
//         SELECT `Service`.`TypeE` as `categoryName`, `Service`.`ServiceE` as `name`
// 			FROM `Provider_Service`
// 			JOIN `Service` ON `Service`.`ServiceID` = `Provider_Service`.`ServiceID`
//             JOIN `Service_Type` ON `Service_Type`.`TypeID` = `Service`.`TypeID`
// 			WHERE `Provider_Service`.`ServiceProviderID` = '30'
        
        return $fact;
    }
    // DELETE FROM `feed` WHERE `feed`.`feed_id` = 3"
    
    public function check_service_exists($serID,$SID){
        $cond  = ['ServiceID' =>  $SID,'ServiceProviderID' =>  $serID];
        $checkservice = $this->db->from('Provider_Service')
                                 ->where($cond)
                                 ->get();
                                 
        $result = $checkservice->result_array();
        return $result;
    }
    
    public function delete_service_exists($serID,$SID){
         $cond  = ['ServiceID' =>  $SID,'ServiceProviderID' =>  $serID];
    $query = $this->db->where($cond);
    return $this->db->delete('Provider_Service');
    }
    
     public function insert_data($SPID,$SID){
         $data = array(
                'ServiceProviderID' => $SPID,
                'ServiceID' =>  $SID
                );
                
         $this->db->insert('Provider_Service',$data);
        
    }
}
?>
        
     