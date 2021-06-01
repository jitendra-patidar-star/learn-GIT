<?php
class Service_type_data extends CI_controller{
   public function __construct(){
        parent::__construct();
        $this->load->model('api_model/Service_type_data_model');
    }
    public function get_type_data(){
         
        $typedata=$this->Service_type_data_model->get_data();
        // echo "<pre>";
        // print_r($typedata);
        echo json_encode($typedata);
    }
    
    public function ser_pro_data($serproID){
        
        $data=$this->Service_type_data_model->ser_data($serproID);
        
        echo json_encode($data);
    }
    
   public function pro_ser($ServiceProviderID,$ServiceID){
              
                $serviceidexists =   $this->Service_type_data_model->check_service_exists($ServiceProviderID,$ServiceID);

                
        
        if($serviceidexists){
            
            $datas = array('status'=>'deleted','msg'=>'ServiceID exists so data deleted..!!');
            echo json_encode($datas);
            $this->Service_type_data_model->delete_service_exists($ServiceProviderID,$ServiceID);
            
        }
        else{
           $newdata=$this->Service_type_data_model->insert_data($ServiceProviderID,$ServiceID);
        
            
                $msg = array('status'=>'Success','msg'=>'data entered Successfully');
                echo json_encode($msg);
           
       
        }
        
    }
    
}
?>