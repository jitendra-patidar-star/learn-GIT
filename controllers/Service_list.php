<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Service_list extends CI_CONTROLLER{
        public function __construct()
        
       
    {
   
    parent::__construct();
       $this->load->model('Service_list_model');
}
    public function index(){
        
         if($this->session->userdata('logged_in')){  
        $data['service']=$this->Service_list_model->get_service_type();
        $this->load->view('header');
        $this->load->view('Service_list/add',$data);
        $this->load->view('footer');
      }else{
          redirect('Admin/index');
      }
    }
    public function view(){
        
        if($this->session->userdata('logged_in')){  
        $data['result']=$this->Service_list_model->get_data();
        $this->load->view('header');
        $this->load->view('Service_list/view',$data);
        $this->load->view('footer');
        }
        else{
          redirect('Admin/index');
      }
      }
   
     public function update($id){
        
         if($this->session->userdata('logged_in')){  
        
        $data['service']=$this->Service_list_model->get_service_type();

        $data['result']=$this->Service_list_model->get_service_by_id($id);
      
        $this->load->view('header');
        $this->load->view('Service_list/edit',$data);
        $this->load->view('footer');
      }
      else{
          redirect('Admin/index');
      }
      }
   
      
     public function insertdata(){
      
      if($this->session->userdata('logged_in')){  
         $data= array(
          
            
             "TypeE"=>$this->input->post('service_type_id'),
             "TypeTC"=>$this->input->post('service_type_idt'),
             "TypeSC"=>$this->input->post('service_type_ids'),
             "ServiceE"=>$this->input->post('service_name'),
             "ServiceTC"=>$this->input->post('service_name_t'),
             "ServiceSC"=>$this->input->post('service_name_s'),
             "DescriptionE"=>$this->input->post('description_e'),
             "DescriptionTC"=>$this->input->post('description_t'),
             "DescriptionSC"=>$this->input->post('description_s'),
             
             );

             $this->Service_list_model->saverecords($data);
             redirect('Service_list/view');
     }else{
           redirect('Admin/index');
     }
     }  
     
     public function updatedata($id){
        
      if($this->session->userdata('logged_in')){  
        $data= array(
             
               
             "TypeE"=>$this->input->post('service_type_id'),
             "TypeTC"=>$this->input->post('service_type_idt'),
             "TypeSC"=>$this->input->post('service_type_ids'),
             "ServiceE"=>$this->input->post('service_name'),
             "ServiceTC"=>$this->input->post('service_name_t'),
             "ServiceSC"=>$this->input->post('service_name_s'),
             "DescriptionE"=>$this->input->post('description_e'),
             "DescriptionTC"=>$this->input->post('description_t'),
             "DescriptionSC"=>$this->input->post('description_s'),
             
             );
            
             $this->Service_list_model->update_service($id,$data);
             redirect('Service_list/view');
     }
     else{
         redirect('Admin/index');
     }
    }   
    
     public function deletedata($deleteid='')
	 {
     $did = $this->Service_list_model->deleteservice($deleteid);
       if($did){
           $redirecturl = base_url('Service_list/index');
           echo "<script> window.alert('Delete Successfully'); </script>";
           echo "<script> window.location.href= '$redirecturl' </script>";
         }
      }
} 
    
    
    
   