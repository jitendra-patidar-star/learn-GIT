<?php
class Job_data_model extends CI_model
{
    public function __construct()
	{
		parent::__construct();
	}
    public function get_job_data()
    {
        $fetch=$this->db->select("*")->from("Job")->get();
        return $fetch->result_array();
    }
    
}
?>