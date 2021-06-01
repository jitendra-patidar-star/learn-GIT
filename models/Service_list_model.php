<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_list_model extends CI_Model {


	public function saverecords($data)
	{
        $this->db->insert('Service',$data);
       
	}
	
	public function get_data()
	{
        
		$this->db->select('*,Service.DescriptionE as desce,Service.DescriptionSC as descsc,Service.DescriptionTC as desctc');
		$this->db->from('Service');
		$this->db->join('Service_Type','Service_Type.TypeID = Service.TypeE');
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
		$this->db->from('Service');
     	$this->db->where('ServiceID',$id);
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
	
	
	public function get_service_type()
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
	
	public function update_service($id,$data){
	    
	    $this->db->where('ServiceID',$id);
	    $this->db->update('Service',$data);
	}
	
	 	function deleteservice($deleteid)
	{

    $value=  $this->db->query("delete  from Service where ServiceID='".$deleteid."'");
    return $value;
	}
}