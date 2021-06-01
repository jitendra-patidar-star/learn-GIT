<?php
class SIDdata extends CI_controller{
    public function __construct(){
            parent::__construct();
            $this->load->model('api_model/SIDdata_model');
        }
    public function get_data(){
        $typedata=$this->SIDdata_model->get_data();
        echo "<pre>";
        print_r($typedata);
        // echo json_encode($typedata);
    }
}
?>