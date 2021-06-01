<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_Service_list extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('api_model/Member_Service_list_Model');

    }
    
    public function get_servicestype_for_home_screen()
	{
	    
	    $servicetype =  $this->Member_Service_list_Model->get_servicestype_for_home_screen_data();
	    echo json_encode($servicetype);
	  
	}
	
	public function glo_ann()
	{
	    $glo= $this->Member_Service_list_Model->glo_annou();
	    echo json_encode($glo);
	}
	
	 public function get_ann()
	{
	    
	    $ann =  $this->Member_Service_list_Model->get_annou();
	    echo json_encode($ann);
	  
	}
	
	 public function get_mem_ann($memid)
	{
	    
	    $mem_ann =  $this->Member_Service_list_Model->get_mem_annou($memid);
	    echo json_encode($mem_ann);
	  
	}
	
	public function get_serpro_ann($serproid)
	{
	    
	    $serpro_ann =  $this->Member_Service_list_Model->get_serpro_annou($serproid);
	    echo json_encode($serpro_ann);
	  
	}
	
	public function get_services_for_home_screen()
	{
	    
	    $servicetype =  $this->Member_Service_list_Model->get_services_for_home_screen_data();
	    echo json_encode($servicetype);
	  
	}
	
	public function get_serices_by_service_type($servicetypeid)
	{
	    $service =  $this->Member_Service_list_Model->get_services_by_type_id($servicetypeid);  
	    echo json_encode($service);
	}
	
	public function get_serivce_description($serviceid)
	{
	    $servicedesc =  $this->Member_Service_list_Model->get_serivce_description_data($serviceid);  
	    echo json_encode($servicedesc);
	}
}