<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_Service_list_Model extends CI_Model {

   	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_servicestype_for_home_screen_data()
	{
	   $query =   $this->db->select('TypeID,TypeE')
	                       ->from('Service_Type')
	                       ->get();
	                   
	   $res = $query->result_array();
	   return $res;
	}
	
	   public function glo_annou()
	{
	    $query =   $this->db->select('AnnouncementE,AnnouncementTC,AnnouncementSC')
	                       ->from('Global_Announcement')
	                       ->get();
	                   
	         $res = $query->result_array();
	         return $res;  
	}
		public function get_annou()
	{
		  
	   $query =   $this->db->select('AnnouncementE,AnnouncementTC,AnnouncementSC')
	                       ->from('Member')
	                       ->get();
	                   
	   $res = $query->result_array();
	   return $res;  
		    
	}
		
		public function get_mem_annou($memid)
	{
		  
	   $query =   $this->db->select('AnnouncementE,AnnouncementTC,AnnouncementSC')
	                       ->from('Member')
	                       ->where('MemberID',$memid)
	                       ->get();
	                   
	   $res = $query->result_array();
	   return $res;  
		    
	}
	
	public function get_serpro_annou($serproid)
	{
		  
	   $query =   $this->db->select('AnnouncementE,AnnouncementTC,AnnouncementSC')
	                       ->from('Service_Provider')
	                       ->where('ServiceProviderID',$serproid)
	                       ->get();
	                   
	   $res = $query->result_array();
	   return $res;  
		    
	}
	
	public function get_services_for_home_screen_data()
	{
	    $query =   $this->db->select('*')
	                        ->from('Service')
	                        ->get();
	                   
	   $res = $query->result_array();
	   return $res;
	}
	
	public function get_services_by_type_id($servicetypeid)
	{
	    $query =   $this->db->select('*')
	                        ->from('Service')
	                        ->where('TypeID',$servicetypeid)
	                        ->get();
	                   
	   $res = $query->result_array();
	   return $res;
	    
	}
	
	public function get_serivce_description_data($serviceid)
	{
	    $query =   $this->db->select('*')
	                        ->from('Service')
	                        ->where('ServiceID',$serviceid)
	                        ->get();
	                   
	   $res = $query->result_array();
	   return $res;
	}
}