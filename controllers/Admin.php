<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		    $this->load->database();
            $this->load->helper('url');
            $this->load->library('form_validation');
		    $this->load->model('Admin_model');
		    $this->load->helper('string');
		    
}

	 public function index()
	{
	   
	    $data['results']=$this->Admin_model->get_login_logo();
	    $this->load->view('login',$data);
	
     }

   	
	
   function auth()
   {
    
   
    $email    = $this->input->post('email',TRUE);
    $password =$this->input->post('password',TRUE);
    if(empty($email) || empty($password)){
        
                   $this->session->set_flashdata('msg', 'Please enter phone/email no. and password');
                    redirect('Admin/index');
    }else{
      
                 $login = $this->Admin_model->display_user($email,($password));
                  if($login->num_rows() > 0){
                    $data  = $login->row_array();
                    $id=     $data['id'];
                    $status  = $data['status'];
                    $email = $data['email'];
                    $level = $data['position'];
                    $sesdata = array(
                        'id'=>$id,
                        'status'  => $status,
                        'email'     => $email,
                        'position'   => $level,
                        'logged_in' => TRUE
                    );
                 //if num_rows not work then remove if condition from model and return it.
                   $this->session->set_userdata($sesdata);
                   	redirect('User');
                   	
                  }
                 else{
                     
                    $this->session->set_flashdata('msg', 'Invalid Email/Phone no. or password');
                    redirect('Admin/index');
               }  
    }
   
   } 
   
    public function dashboard_view(){
        
       $this->load->view('header');
       $this->load->view('dashboard');
       $this->load->view('footer');
        
        
    }
     public function Logout()
    {
        $this->session->sess_destroy();
        redirect('Admin/index');
    }
    
    function forgot_password()
    {
  
      $this->form_validation->set_rules('emailpass', 'emailpass', 'trim|required');
     
       if($this->form_validation->run() == FALSE)
       {
 
        $this->load->view('login');
        

       }else{
        
          
        $email= $this->input->post('emailpass');
        $password=random_string('alnum', 8);//generate random password
        $data = array('password'=>md5($password));
        $this->Admin_model->update($email,$data);
      
      //mp 14052020 added to send email
         $this->load->library('email');
       
        // Mail config
        $to = $this->input->post('emailpass');
        $from = 'noreply@qwickhand.com';
        $fromName = 'Qwickhand';
        $mailSubject = 'Password Reset Successfully';
        
        // Mail content
        $mailContent = '
            <p>Hello, </p>
            <h4>Here is your new password to access account :</h4>
            <p><b>Password: </b>'.$password.'</p>
            <br>
            <p><i>Thanks</i></p>
        ';
            
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->to($to);
        $this->email->from($from, $fromName);
        $this->email->subject($mailSubject);
        $this->email->message($mailContent);
            

        // Send email & return status
          $res =  $this->email->send()?true:false;
          $this->session->set_flashdata('msg', 'password sent successfully !');
          $this->sendmsg();
      }
    }
    

        public function send_msg_for_reset_token($phone,$resettoken)
    {
          
//	$apiKey = urlencode('lwHg4/unmNs-sDzGCNZxhebNp1mYexD7ApS1JdtnFV');
    $apiKey ="";
	// Message details
	$numbers = array("91".$phone);
	$sender = urlencode('QWICKIND');
	$message = rawurlencode("Your reset password token is '.$resettoken.' ");
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
    }
    
   
}
