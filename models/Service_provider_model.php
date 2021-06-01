<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_provider_model extends CI_Model {


	public function get_data()
	{
        
		$this->db->select('*');
		$this->db->from('Service_Provider');
		
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
}
	