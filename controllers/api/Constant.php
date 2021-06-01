<?php
class Constant extends CI_controller{
    public function __construct(){
            parent::__construct();
            $this->load->model('api_model/Constantmodel');
        }
        
    public function getConstant(){
        $typedata=$this->Constantmodel->getConstant();
        // echo "<pre>";
        // print_r($typedata);
        
        $en = [];
        $zhcn = [];
        $zhtw = [];
        $data = [];
        foreach($typedata as $tdata){
           $en[$tdata['lng_key']] = $tdata['en'];
           $zhcn[$tdata['lng_key']] = $tdata['zhcn'];
           $zhtw[$tdata['lng_key']] = $tdata['zhtw'];
        }
        $data['en'] = $en;
        $data['zhcn'] = $zhcn;
        $data['zhtw'] = $zhtw;
        // print_r(json_encode($data));
        echo json_encode($data);
    }
    
}
?>