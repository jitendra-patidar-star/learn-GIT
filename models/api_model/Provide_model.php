<?php
class Provide_model extends CI_model{
  
    // function for getting count for particular StageID=20
    public function post_data(){
          $insert = $this->db->insert('Provider_Service',$data);

         return $insert;
    }
}
?>