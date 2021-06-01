<?php
class Provider extends CI_controller{
   
    public function transferdata()  
    {  
        // //this array is used to get data from the postman parameter.  
        // $data = array(  
        //                 'ServiceProviderID'  => $this->input->get('ServiceProviderID'),  
        //                 'ServiceID'   => $this->input->get('ServiceID'),  
        //                 );  
        //insert data into database table from other table.  
    $query = $this->db->get('Job');
    $value=array($ServiceID,$ServiceProviderID);
     
     foreach ($query->result() as $value) {
        print_r($value);
    //  $this->db->insert('Provider_Service',$value);
}
    }  
}
?>