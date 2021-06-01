<?php
class Constantmodel extends CI_model{
    //  public function __construct(){
    //     parent::__construct();
    // }
    // function for getting count for particular StageID=20
    public function getConstant(){
          $fetch = $this->db->select('*')
               ->from ('constant')
               ->get();
        

         return $fetch->result_array();
    }
}
?>