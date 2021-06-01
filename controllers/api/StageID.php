<?php
class StageID extends CI_controller{
    public function __construct(){
            parent::__construct();
            $this->load->model('api_model/StageID_model');
        }
        
    public function get_number($serproID){
        $typedata=$this->StageID_model->get_count($serproID);
        // echo "<pre>";
        // print_r($typedata);
        echo json_encode($typedata);
    }
    
    public function get_number_member($memID){
        $typedata=$this->StageID_model->get_count_member($memID);
        // echo "<pre>";
        // print_r($typedata);
        echo json_encode($typedata);
    }
    
   /* public function get_number10(){
        $typedata=$this->StageID_model->get_count10();
        // echo "<pre>";
        // print_r($typedata);
        echo json_encode($typedata);
    }
    
     public function get_number30(){
        $typedata=$this->StageID_model->get_count30();
        // echo "<pre>";
        // print_r($typedata);
        echo json_encode($typedata);
    }
    
    public function get_number82(){
        $typedata=$this->StageID_model->get_count82();
        // echo "<pre>";
        // print_r($typedata);
        echo json_encode($typedata);
    }
    
   */
}

?>