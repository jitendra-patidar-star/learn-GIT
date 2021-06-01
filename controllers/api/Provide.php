<?php
class Provide extends CI_controller{
   
     function savingdata()  
    {  
        //this array is used to get data from the postman parameter.  
        $data = array(  
                        'ServiceProviderID'  => $this->input->get('ServiceProviderID'),  
                        'ServiceID'   => $this->input->get('ServiceID'),  
                        );  
        //insert data into database table.  
                        $insert = $this->db->insert('Provider_Service',$data);
     
    }  
}
?>