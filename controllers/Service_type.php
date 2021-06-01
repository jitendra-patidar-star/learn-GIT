<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Service_type extends CI_CONTROLLER{
        public function __construct()
        
       
    {
   
    parent::__construct();
       $this->load->model('Service_type_model');
}
    public function index(){
        
        if($this->session->userdata('logged_in')){  
        $this->load->view('header');
        $this->load->view('Service_type/add');
        $this->load->view('footer');
      }else{
          redirect('Admin/index');
      }
    }
    public function view(){
        
         if($this->session->userdata('logged_in')){  
        $data['result']=$this->Service_type_model->get_data();
        $this->load->view('header');
        $this->load->view('Service_type/view',$data);
        $this->load->view('footer');
      }else{
         redirect('Admin/index'); 
      }
    }
    
     public function update($id){
        
        if($this->session->userdata('logged_in')){  
        $data['result']=$this->Service_type_model->get_service_by_id($id);
        $this->load->view('header');
        $this->load->view('Service_type/edit',$data);
        $this->load->view('footer');
      }else{
           redirect('Admin/index'); 
      }
     }  
      
     public function insertdata(){
       
       if($this->session->userdata('logged_in')){    
         $data= array(
             
             "TypeE"=>$this->input->post('service_name'),
             "TypeTC"=>$this->input->post('service_name_t'),
             "TypeSC"=>$this->input->post('service_name_s'),
             "DescriptionE"=>$this->input->post('description_e'),
             "DescriptionTC"=>$this->input->post('description_t'),
             "DescriptionSC"=>$this->input->post('description_s'),
             
             );
             
             $this->Service_type_model->saverecords($data);
             redirect('Service_type/view');
             
     } else{
           redirect('Admin/index'); 
      }
     }  
     
     
     public function updatedata($id){
         
        if($this->session->userdata('logged_in')){    
         $data= array(
             
             "TypeE"=>$this->input->post('service_name'),
             "TypeTC"=>$this->input->post('service_name_t'),
             "TypeSC"=>$this->input->post('service_name_s'),
             "DescriptionE"=>$this->input->post('description_e'),
             "DescriptionTC"=>$this->input->post('description_t'),
             "DescriptionSC"=>$this->input->post('description_s'),
             
             );
             
             $this->Service_type_model->update_service($data,$id);
             redirect('Service_type/view');
     }
     else{
           redirect('Admin/index'); 
      }
     } 
     
    public function deletedata($deleteid='')
	 {
     $did = $this->Service_type_model->deleteservice($deleteid);
       if($did){
           $redirecturl = base_url('Service_type/index');
           echo "<script> window.alert('Delete Successfully'); </script>";
           echo "<script> window.location.href= '$redirecturl' </script>";
         }
      }
} 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    