<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_Provider extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('api_model/Service_Provider_Model');
	    $this->load->helper('string');
	  
    }
    
    public function service_provider_register()
    {
        
        $inputdata= $this->input->post();
        $emailexists =   $this->Service_Provider_Model->check_email_exists($inputdata['Email']);
        $phoneexists =   $this->Service_Provider_Model->check_phone_exists($inputdata['Phone']);
       
        if($inputdata['FirstName'] =='' || $inputdata['LastName'] =='' || $inputdata['CompanyName'] ==''|| $inputdata['Address'] =='' || $inputdata['Phone']=='' || $inputdata['Email']=='' ||$inputdata['Retype_Email']=='' || $inputdata['Password']=='' || $inputdata['Retype_Password']=='' )
        {
            $msg = array('status'=>'Failed','msg'=>'Please Fill All Required Fields');
            echo json_encode($msg);
            
        }
        elseif($inputdata['Email'] != $inputdata['Retype_Email'])
        {
            $msg = array('status'=>'Failed','msg'=>'Email Not Macth');
            echo json_encode($msg);
            
        }
        elseif($inputdata['Password'] != $inputdata['Retype_Password'])
        {
            
            $msg = array('status'=>'Failed','msg'=>'Password Not Macth');
            echo json_encode($msg);
            
        } 
         elseif (strlen($inputdata['Phone']) < 10 || strlen($inputdata['Phone']) > 10 ) {
            
            $msg = array('status'=>'Failed','msg'=>'please enter 10 digit number');
            echo json_encode($msg);
            return false;
   
        }
      elseif($emailexists){
            
            $datas = array('status'=>'Failed','msg'=>'Email Already Registered..!!');
            echo json_encode($datas);
            
        }
          elseif($phoneexists){
            
            $datas = array('status'=>'Failed','msg'=>'Phone Already Registered..!!');
            echo json_encode($datas);
            
        }
        
        else
        {
/*
             $image = base64_decode($this->input->post("Profile"));
             $image_name = md5(uniqid(rand(), true));
             $filename = $image_name . '.' ;
             //rename file name with random number
             $path = "photo/service_provider/".$filename;
            //image uploading folder path
             file_put_contents($path . $filename, $image);
            */
    
            $newdata = array(
                'FirstName' => $inputdata['FirstName'],
                'LastName' =>  $inputdata['LastName'],
                'Phone' =>  $inputdata['Phone'],
                'CompanyName' => $inputdata['CompanyName'] ,
                'Address' => $inputdata['Address'] ,
                'Email' => $inputdata['Email'],
                'Password' => hash ( "sha256", $inputdata['Password'] ),
                 'CreditScore' => '100' ,
                 'ValidTill'=>'2029/12/31' ,
                 'English' =>$inputdata['English'],
                 'TChinese'=>$inputdata['TChinese'],
                 'SChinese'=>$inputdata['SChinese']
               
                //  hash ( "sha256", $str );
                //  'Password'
        );
        
       $ab = $this->Service_Provider_Model->service_provider_id();
    
         if($_FILES["Profile"]["name"])  
            {  
                    $config['upload_path'] = 'ezjobuatphoto/service_provider';
                    $config['allowed_types'] = 'jpg|png|jpeg|jpe';
                   
                      $new_name = $ab.'.'.pathinfo($_FILES["Profile"]["name"], PATHINFO_EXTENSION);
                    // $config['file_name'] = $new_name;
                    
                    
                    $_FILES["Profile"]['name'] = $new_name;
                   
                    $this->load->library('upload', $config);  
                    
                    if(!$this->upload->do_upload('Profile'))  
                    {  
                        $error = $this->upload->display_errors();
                    }  
                    else  
                    {  
                         $data = $this->upload->data(); 
                         $newdata['Profile'] = $data['file_name'];
                    }  
                }
                 
        $insert =  $this->Service_Provider_Model->service_provider_insert($newdata);
       
        if($newdata){
                 
                $msg = array('status'=>'Success','msg'=>'Registerd Successfully');
                echo json_encode($msg);
                
            }else{
                
                $msg = array('status'=>'Failed','msg'=>'Error!!');
                echo json_encode($msg);
            }
       
              
             
             $ab= $this->db->insert_id();
             if ($ab){
                 
                  $newdata = array(
                        
                         'Profile' => $ab.'.'.pathinfo($_FILES["Profile"]["name"], PATHINFO_EXTENSION)
                 );
               }
           
             $inserted =  $this->Service_Provider_Model->service_provider_update($ab,$newdata);
                 
        }
        
             
     }
        
    
    public function service_provider_auth()
    {
        
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
      
        if($phone!='' && $password!=''){
            
            $auth =  $this->Service_Provider_Model->service_provider_auth_data_with_phone( $phone , $password );  
        
                if($auth->num_rows() > 0){
                     
                        $logindata  = $auth->row_array();
                        $userid=     $logindata['ServiceProviderID'];
                        $phone = $logindata['Phone'];
                        
                        //$sesdata = array('id'=>$id,'email'=> $email,'logged_in' => TRUE);
                        //$this->session->set_userdata($sesdata);
                        //redirect('Admin/dashboard');
        	        
        	        $datas = array('status'=>'Success','msg'=>'Login Successfully','userid'=>$userid);
        	       //$datas = array('status'=>'Success','msg'=>'Login Successfully');
                    echo json_encode($datas);
                   
        	    }
        	    
        	    else{
        	        
        	        $datas = array('status'=>'Failed','msg'=>'Invalid Login Details!!');
                    echo json_encode($datas);
                    
        	    }
        	    
        }
        else{
            
            $datas = array('status'=>'Failed','msg'=>'Please Fill Both Fileds');
            echo json_encode($datas);
            
        }
      
      
    }
    
    public function reset_password_token()
    {
        
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        
        // $emailexists =   $this->Service_Provider_Model->check_email_exists($inputdata['email']);
        // $phoneexists =   $this->Service_Provider_Model->check_phone_exists($inputdata['phone']);
        
        $length = 6;
        $str = '1234567890';
        $resettoken = substr(str_shuffle($str), 0, $length);
        
        
        
        $tokeninsert = $this->Service_Provider_Model->insert_reset_token($email,$phone,$resettoken);
        $sendmail = $this->send_email_for_reset_token($email,$resettoken);
        // die;
        
        
      //  $sendmsg = $this->send_msg_for_reset_token($email,$resettoken);
    //   if(!($emailexists)){
            
    //         $datas = array('status'=>'Failed','msg'=>'Email not Registered..!!');
    //         echo json_encode($datas);
            
    //     }
    //       elseif(!($phoneexists)){
            
    //         $datas = array('status'=>'Failed','msg'=>'Phone not Registered..!!');
    //         echo json_encode($datas);
            
    //     }
        
        // else
        if($tokeninsert || $sendmail){
                     
            $serproid= $this->Service_Provider_Model->get_serproid($email,$phone);
              if($serproid->num_rows() > 0){        
            $logindata  = $serproid->row_array();
            $serid=     $logindata['ServiceProviderID'];
            $datas = array('status'=>'Success','msg'=>'Token Generated Successfully','serviceproviderID'=>$serid,'email'=>$email);
            echo json_encode($datas);
        }
         else{
            
            $datas = array('status'=>'Failed','msg'=>'wrong email and phone');
            echo json_encode($datas);
        }
        }
        else{
            
            $datas = array('status'=>'Failed','msg'=>'Error In Generating Token');
            echo json_encode($datas);
        }
        
}



    public function send_email_for_reset_token($email,$resettoken)
    {
        $from ="info@qwickhand.com";
        $to = $email;
        $subject = "Password Reset Token";
        $message = "Hello $email";
        
        $message.= "<h3>Please find your Reset Password Token Below Here</h3>
            <p><b>Token:&nbsp;&nbsp;&nbsp;&nbsp;</b>$resettoken</p>
            <p>Copy the above mentioned OTP and go back to the reset password screen on Qwickhand app</p>
            <h4><i>Thanks & Regards,</i></h4>
            <p>Qwick Hand</p>";
            
        $config['mailtype'] = 'html';
        $this->email->set_newline("\r\n");
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8'); //must add this line
        $this->email->set_header('Content-type', 'text/html'); //must add this line
        $this->email->initialize($config);
        $this->email->from('info@qwickhand.com',"Qwickhand"); //your mail address
        $this->email->to($email); //customer mail address
        $this->email->subject($subject);
        $this->email->message($message);
        $res = $this->email->send();

        return $res;

       
    }
    
    
    // public function send_email_for_reset_token($email,$resettoken)
    // {
        
        
    //     $from="info@qwickhand.com";
    //     $to=$email;
    //     $subject = "Password Reset Token";
    //     $message = "Hello $email";
        
    //     $message.= "<h3>Please find your Reset Password Token Below Here</h3>
    //         <p><b>Token:&nbsp;&nbsp;&nbsp;&nbsp;</b>$resettoken</p>
    //         <p>Copy the above mentioned code and go back to the reset password screen on Qwickhand app</p>
    //         <h4><i>Thanks & Regards,</i></h4>
    //         <p>Qwick Hand</p>";

    //     $config['mailtype'] = 'html';
    //     $this->email->set_newline("\r\n");
    //     $this->email->set_header('MIME-Version', '1.0; charset=utf-8'); //must add this line
    //     $this->email->set_header('Content-type', 'text/html'); //must add this line
    //     $this->email->initialize($config);
    //     $this->email->from('info@qwickhand.com',"Qwickhand"); //your mail address
    //     $this->email->to($to); //customer mail address
    //     $this->email->subject($subject);
    //     $this->email->message($message);
    //     $res = $this->email->send();

    //     return $res;

    // }
    
    public function send_msg_for_reset_token($phone , $resettoken)
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
    
    public function reset_password($serviceproviderid)
    {
        
        
        $inputdata = $this->input->post();
        
        if($inputdata['reset_token'] =='' || $inputdata['password'] =='' || $inputdata['confirm_password'] =='')
        {
            $datas = array('status'=>'Failed','msg'=>'Please Fill All Required Field');
            echo json_encode($datas);
        }
          elseif($inputdata['password'] != $inputdata['confirm_password'])
        {
            
            $msg = array('status'=>'Failed','msg'=>'Password Not Macth');
            echo json_encode($msg);
            
        } 
        else
        { $newdata = array(
                
                'Password' => hash ( "sha256", $inputdata['password'] ),
                 'ResetPasswordToken' => $inputdata['reset_token']
        );
            
            $checkexists =   $this->Service_Provider_Model->check_exists($newdata['ResetPasswordToken'],$serviceproviderid);
            
            if(!empty($checkexists)){
            $resetpass = $this->Service_Provider_Model->reset_password_data($newdata,$serviceproviderid);
            
            if($newdata){
                
                 $datas = array('status'=>'Success','msg'=>'Password Reset Successfully');
                 echo json_encode($datas);
                
            }
            else{
                
                 $datas = array('status'=>'Failed','msg'=>'Error!!');
                 echo json_encode($datas);
            }
            }
            else
            {
                $datas = array('status'=>'Failed','msg'=>'token entry wrong!!');
                 echo json_encode($datas); 
            }
           
        }
        
    }
    
    public function get_service_provider_setting_data($serviceproviderid)
    {
        $serviceproviderdata = $this->Service_Provider_Model->get_service_provider_data_by_id($serviceproviderid);
        
        echo json_encode($serviceproviderdata);
    }
    
    public function service_provider_settings_update($serviceproviderid)
    {
        $inputdata = $this->input->post();
        
        // $msg = array('status'=>'Failed','msg'=>$inputdata);
        // echo json_encode($msg);
        
        
        if($inputdata['FirstName'] =='' || $inputdata['LastName'] =='' || 
        $inputdata['CompanyName'] ==''|| $inputdata['Address'] =='' || 
        $inputdata['Phone']==''
        // || $inputdata['Email']=='' ||$inputdata['Retype_Email']=='' || 
        // $inputdata['Password']=='' || $inputdata['Retype_Password']=='' 
        )
        {
            $msg = array('status'=>'Failed','msg'=>'Please Fill All Required Fileds');
            echo json_encode($msg);
            
        }
        elseif(($inputdata['Email'] != $inputdata['Retype_Email']) && $inputdata['Retype_Email'] != '' && $inputdata['Email'] != '')
        {
            $msg = array('status'=>'Failed','msg'=>'Email Not Macth');
            echo json_encode($msg);
            
        }
        elseif(($inputdata['Password'] != $inputdata['Retype_Password']) && $inputdata['Password'] != '')
        {
            $msg = array('status'=>'Failed','msg'=>'Password Not Macth');
            echo json_encode($msg);
        }
        // elseif($this->Service_Provider_Model->check_email_exists_sp()>0){
        //     $msg = array('status'=>'Failed','msg'=>'Email already registered');
        //     echo json_encode($msg);
        // }
        else
        {
            if($inputdata['Email']===''){
                $newdata = array(
                        'FirstName' => $inputdata['FirstName'],
                        'LastName' =>  $inputdata['LastName'],
                        'Phone' =>  $inputdata['Phone'],
                        'CompanyName' => $inputdata['CompanyName'] ,
                        'Address' => $inputdata['Address'] ,
                        'Password' => hash ( "sha256", $inputdata['Password'] ),
                         'CreditScore' => '100' ,
                         'ValidTill'=>'2029/12/31' ,
                         'English' =>$inputdata['English'],
                         'TChinese'=>$inputdata['TChinese'],
                         'SChinese'=>$inputdata['SChinese']
                       
                        //  hash ( "sha256", $str );
                        //  'Password'
                );
            }
            else{
                $newdata = array(
                        'FirstName' => $inputdata['FirstName'],
                        'LastName' =>  $inputdata['LastName'],
                        'Phone' =>  $inputdata['Phone'],
                        'CompanyName' => $inputdata['CompanyName'] ,
                        'Address' => $inputdata['Address'] ,
                         'Email' => $inputdata['Email'],
                        'Password' => hash ( "sha256", $inputdata['Password'] ),
                         'CreditScore' => '100' ,
                         'ValidTill'=>'2029/12/31' ,
                         'English' =>$inputdata['English'],
                         'TChinese'=>$inputdata['TChinese'],
                         'SChinese'=>$inputdata['SChinese']
                       
                        //  hash ( "sha256", $str );
                        //  'Password'
                );
            }
            
             
        $ab = $this->Service_Provider_Model->service_provider_id();
    
         if(isset($_FILES["Profile"]["name"]) && $_FILES["Profile"]["name"])  
            {  
                    $config['upload_path'] = 'ezjobuatphoto/service_provider';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
                   
                      $new_name = $ab.'.'.pathinfo($_FILES["Profile"]["name"], PATHINFO_EXTENSION);
                    // $config['file_name'] = $new_name;
                    
                    
                    $_FILES["Profile"]['name'] = $new_name;
                   
                    $this->load->library('upload', $config);  
                    
                    if(!$this->upload->do_upload('Profile'))  
                    {  
                        $error = $this->upload->display_errors();
                    }  
                    else  
                    {  
                         $data = $this->upload->data(); 
                         $newdata['Profile'] = $data['file_name'];
                    }  
                }
            $update =  $this->Service_Provider_Model->service_provider_update_setting($newdata,$serviceproviderid);

            if($newdata){
                
                $msg = array('status'=>'Success','msg'=>'Updated Successfully');
                echo json_encode($msg);
            
                
            }else{
                
                $msg = array('status'=>'Failed','msg'=>'Error!!');
                echo json_encode($msg);
            
            }
             
             $ab= $this->db->insert_id();
             if ($ab){
                 
                  $newdata = array(
                        
                         'Profile' => $ab.'.'.pathinfo($_FILES["Profile"]["name"], PATHINFO_EXTENSION)
                 );
               }
           
             $inserted =  $this->Service_Provider_Model->service_provider_update($ab,$newdata);
           
            
        }
    }
    
    
}