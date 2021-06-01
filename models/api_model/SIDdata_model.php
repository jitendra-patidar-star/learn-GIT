<?php
class SIDdata_model extends CI_model{
    //  public function __construct(){
    //     parent::__construct();
    // }
    // function for getting data for particular StageID=20
    public function get_data(){
          $fetch = $this->db->select('*')
               ->from ('Job')
               ->where('StageID=20')
               ->get();
        

         return $fetch->result_array();
    }
}
?>