<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_type_model extends CI_Model {


	public function saverecords($data)
	{
        $this->db->insert('Service_Type',$data);
	}
	
	public function get_data()
	{
        
		$this->db->select('*');
		$this->db->from('Service_Type');
		$query = $this->db->get();
	
	 if($query -> num_rows() >0)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }

	}
	
	public function get_service_by_id($id)
	{
	   
		$this->db->select('*');
		$this->db->from('Service_Type');
     	$this->db->where('TypeID',$id);
		$query = $this->db->get();
	
	  if($query -> num_rows() > 0)
	   {
	     return $query->result_array();
	   }
	   else
	   {
	     return false;
	   }

	}
	
	
	public function update_service($id,$data){
	    
	    $this->db->where('TypeID',$id);
	    $this->db->update('Service_Type',$data);
	}
	
    public	function deleteservice($deleteid)
	{

    $value=  $this->db->query("delete  from Service_Type where TypeID='".$deleteid."'");
    return $value;
	}	
	
}