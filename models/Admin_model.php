<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

   	public function __construct()
	{

		parent::__construct();

	}

	public function get_user()
	{
	   
		$this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
	
	 if($query -> num_rows() >0)
	   {
	     return $query->result_array();
	   }
	   else
	   {
	     return false;
	   }

	}
		public function get_login_logo()
	{
		$this->db->select('*');
		$this->db->from('user');
	//	$this->db->where('email',$email);
	//	$this ->db-> limit(1);
	 
	   $query = $this ->db-> get();
	 
	   if($query -> num_rows() >0)
	   {
	     return $query->result_array();
	   }
	   else
	   {
	     return false;
	   }

	}
	public function display_user($email,$password)
	{
      	$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->or_where('phone', $email);
		$this->db->where('status',1);
		$this->db->where('password',md5($password));
		
	   $query = $this ->db-> get();
	   return $query;
	  
	}
	
 	 public function get_admin()
	{
	   
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('position',1);
		$query = $this->db->get();
		
		return $query->num_rows();
	    
	/*   if($query -> num_rows() > 0)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }*/

	}


 public function update($email,$data){
  

       $this->db->where('email',$email);
       $this->db->update('user',$data);
   }
  
 
}