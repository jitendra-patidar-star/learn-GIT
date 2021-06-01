<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
    class Profile extends CI_CONTROLLER
    {
        public function __construct()
    {
 
    parent::__construct();
        $this->load->model('Profile_model');
        $this->load->helper('string');
        $this->load->library('email');

}
    public function index(){
       if($this->session->userdata('logged_in')){  
        $this->load->view('header');
        $this->load->view('profile');
        $this->load->view('footer');
       }
       else{
           redirect('Admin/index'); 
       }
    }
    
    public function reset(){
    
     $this->load->view('reset_password');

  } 	
	public function profile_update($id)
	{   
	    if($this->session->userdata('logged_in')){  
        $data['result']=$this->Profile_model->get_user_by_id($id);
	   	$this->load->view('header');
        $this->load->view('profile',$data);
        $this->load->view('footer');
	}
	else{
           redirect('Admin/index'); 
       } 
    }
    
    
     	public function admin_view()
	{
	    if($this->session->userdata('logged_in')){ 
        $data['result']=$this->Admin_profile->view_data();
	   	$this->load->view('admin/header');
        $this->load->view('admin/admin_view_table',$data);
        $this->load->view('admin/footer');
	}
	 else{
        redirect('admins/Admin/login');
       }
    }
       	 public function insertdata()
        {
          if($this->session->userdata('logged_in')){  
           $data=array(
                 "name"=>$this->input->post("name"),
                 "last_name"=>$this->input->post("last_name"),
                 "address"=>$this->input->post("address"),
                 "company_name"=>$this->input->post("company_name"),
                 "email"=>$this->input->post("email"),
                 "phone"=>$this->input->post("phone"),
                 "status"=>1,
                 "position"=>1
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
                }
                
          $this->Profile_model->saverecords($data);
          }
	 else{
        redirect('admins/Admin/login');
       }
    }
     
		 public function updatedata($id)
        {
           if($this->session->userdata('logged_in')){  
           $data=array(
                "name"=>$this->input->post("name"),
                "last_name"=>$this->input->post("last_name"),
                 "address"=>$this->input->post("address"),
                 "company_name"=>$this->input->post("company_name"),
                 "email"=>$this->input->post("email"),
                 "phone"=>$this->input->post("phone"),
                 "status"=>1,
                 "position"=>1
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
        
          $this->Profile_model->update($data,$id);
          redirect('User/view');
        }
    
   else{
            redirect('Profile/profile_update/'.$id);
            redirect('admins/Admin/login');
       }
     }
     
   public function change_pass($id='')
    {
        
       
        $this->load->helper('security');  
        $this->load->library('form_validation');  
        
        $this->form_validation->set_rules('reset_token_id', 'Reset token', 'required|trim|xss_clean'); 
        $this->form_validation->set_rules('newpwd', 'Password', 'required|trim|xss_clean'); 
        $this->form_validation->set_rules('cpwd', 'Confirm Password', 'required|trim|xss_clean|matches[newpwd]'); 
        if ($this->form_validation->run())   
        { 
            
            	$old_pass=$this->input->post('oldpwd');
    		    $token=$this->input->post("reset_token_id");
    			$new_pass=md5($this->input->post('newpwd'));
    			$confirm_pass=$this->input->post('cpwd');
            /*	$session_id=$this->input->post('userid');*/
    		   
    	    	if($new_pass!=''){
    		
    			$this->Profile_model->changepass($token,$new_pass);
    			 $array = array(
            'success' => '<div class="alert alert-success">Changed Successfully</div>'
           );
    			 
    	   }
    	    
        }
      else
      {
       $array = array(
        'error'   => true,
        'rst_error'=> form_error('reset_token_id'),
        'newpwd_error' => form_error('newpwd'),
        'cpwd_error' => form_error('cpwd')
       );
      }

    echo json_encode($array);
   
    }   
    
   
      
       public function reset_token($id) 
    { 
         $data = $this->Profile_model->get_user_by_id($id);
        
         $token=random_string('alnum', 16);//generate random password
        
        
         $from_email ="noreply@qwickhand.com"; 
         $to_email = $data[0]['email'];
         
         $url='https://qwickhand.reflomsolutions.com/Profile/reset/';
        
         $message='';         
         $message.= "Hello ,\r\n
                               <p> Your Token ID are \r\n</p>
                                <p><b>Token ID</b> : $token\r\n</p>
                                <p><a href='$url'>$url</a></p>
             <p><i>Thanks,</i></p> 
             <p><i>Qwickhand<i><p>";
                     
         $config['wordwrap'] = TRUE;

         $config['mailtype'] = 'html';

        $this->email->initialize($config);
         $this->email->from($from_email); 
         $this->email->to($to_email);
         $this->email->subject('Account Information'); 
         $this->email->message($message); 
        $send = $this->email->send();
         //Send mail 
         if($send) {

         $this->session->set_flashdata("email_sent","Token ID send on your mail with Reset Password Link."); 
         
          $data=array(
                
                 "reset_token_id"=>$token
                );
              $did = $this->Profile_model->update_token($id,$data);
               if($did) {
                redirect('Profile/profile_update/'.$id);
               }    
         }
         else {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
          redirect('Profile/profile_update/'.$id); 
         }
 } 
 
/* public function reset_token_fill(){
  
                $token=$this->input->post("reset_token_id");
                $pass=md5($this->input->post("newpwd"));
            
           $this->Profile_model->reset_token($token,$pass);
        
 }*/
 
    }
    
    