<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model {

		public function get_user()
	{
	   
		$this->db->select('Member.FirstName as memberfname,Member.LastName as memberlname');
		$this->db->from('Job');
        $this->db->join('Member', 'Member.MemberID = Job.JobID');
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
	
}