<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

    class User extends CI_CONTROLLER
    {
        public function __construct()
    {
   
    parent::__construct();
       $this->load->model('User_model');
       $this->load->model('Profile_model');
        if($this->session->userdata('logged_in')){ 
        
     if($_SESSION['position']=='1' || $_SESSION['position']=='2'){
        
    }else{
       
       
            $url= base_url('Admin/index');
         
           echo "<script> window.alert(' You Dont Have Permission To Access This Url.'); </script>";
           echo "<script> window.location.href= '$url' </script>";
    }
         }
    else{
        redirect('Admin/index');
       }
    }
    

    public function index(){
        
      if($this->session->userdata('logged_in')){ 
        $data['result']=$this->User_model->get_position();
        $this->load->view('header');
        $this->load->view('User/add',$data);
        $this->load->view('footer');
      }
    else{
        redirect('Admin/index');
       }
    }
    	
	public function user_update($id)
	{   
	   if($this->session->userdata('logged_in')){ 
        $data['result']=$this->User_model->get_user_by_id($id);
	   	$this->load->view('header');
        $this->load->view('User/edit',$data);
        $this->load->view('footer');
	    
	}
else{
        redirect('Admin/index');
       }
    }

     	public function view()
	{
	   if($this->session->userdata('logged_in')){ 
        $data['result']=$this->User_model->view_data();
	   	$this->load->view('header');
        $this->load->view('User/view',$data);
        $this->load->view('footer');
	   }
else{
        redirect('Admin/index');
       }
    }
       	 public function insertdata()
        {
           
           $data=array(
                 "name"=>$this->input->post("name"),
                 "email"=>$this->input->post("email"),
                 "phone"=>$this->input->post("phone"),
                 "last_name"=>$this->input->post("last_name"),
                 "address"=>$this->input->post("address"),
                 "company_name"=>$this->input->post("company_name"),
                 "position"=>$this->input->post("position"),
                 "password"=>md5($this->input->post("password")),
                 "status"=>1,
                
                 );
                 
            if(!empty($_FILES["files"]["name"]))  
            {  
                    $config['upload_path'] = 'assets/assets_front/upload';
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);  
                    
                    if(!$this->upload->do_upload('files'))  
                    {  
                        $error = $this->upload->display_errors();
                    }  
                    else  
                    {  
                         $dataa = $this->upload->data(); 
                      //use different name variables 
                         $data['logo'] = $dataa['file_name'];
                        
                    }  
             
                
          $this->User_model->saverecords($data);
          redirect('User/view');
            }
    }
        
		 public function updatedata($id)
        {
            if($this->session->userdata('logged_in')){ 
           $data=array(
                 "name"=>$this->input->post("name"),
                 "email"=>$this->input->post("email"),
                 "last_name"=>$this->input->post("last_name"),
                 "address"=>$this->input->post("address"),
                 "company_name"=>$this->input->post("company_name"),
                 "phone"=>$this->input->post("phone"),
                 "position"=>$this->input->post("position"),
                 "password"=>md5($this->input->post("password")),
                 "status"=>1,
                 
                 );
                
            if($_FILES["files"]["name"])  
            {  
                    $config['upload_path'] = 'assets/assets_front/upload';
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);  
                    
                    if(!$this->upload->do_upload('files'))  
                    {  
                        $error = $this->upload->display_errors();
                    }  
                    else  
                    {  
                        
                         $dataa = $this->upload->data(); 
                      //use different name variables 
                         $data['logo'] = $dataa['file_name'];
                        
                    }  
                }
        
          $this->User_model->update($data,$id);
          if($_SESSION['position']==1){
                    redirect('User/view');
          }else{
          redirect('User/user_update/'.$id);
          }
          } 
           else{
        redirect('Admin/index');
       }
    }
}