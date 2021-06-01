<?php
class Job_data extends CI_controller{
    public function __construct()
	{
	    parent::__construct();
	    $this->load->model('api_model/Job_data_model');

    }
    public function get_all_job()
    {
        $jobdata=$this->Job_data_model->get_job_data();
        // echo "<pre>";
        // print_r($jobdata);
        echo json_encode($jobdata);
    }
}
?>