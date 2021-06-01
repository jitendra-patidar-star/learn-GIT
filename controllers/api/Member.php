<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('api_model/Member_model');
        $this->load->helper('string');
    }
    
    public function member_register()
    {
        $inputdata= $this->input->post();
        $emailexists =   $this->Member_model->check_email_exists($inputdata['Email']);
        $phoneexists =   $this->Member_model->check_phone_exists($inputdata['Phone']);

        
        if($inputdata['Phone']=='' || $inputdata['FirstName'] =='' || $inputdata['LastName'] =='' || $inputdata['Email']=='' ||$inputdata['Retype_Email']=='' || $inputdata['PostCode'] =='' ||   $inputdata['Password']=='' || $inputdata['Retype_Password']=='' )
        {
            $msg = array('status'=>'Failed','msg'=>'Please Fill All Required Fileds');
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
            
            $datas = array('status'=>'Failed','msg'=>'phone Already Registered..!!');
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
                'Phone' =>  $inputdata['Phone'],
                'FirstName' => $inputdata['FirstName'],
                'LastName' =>  $inputdata['LastName'],
                'PostCode' => $inputdata['PostCode'] ,
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
        
        $insert =  $this->Member_model->member_insert($newdata);
       
            
            if($newdata){
                 
                $msg = array('status'=>'Success','msg);'=>'Registerd Successfully');
                echo json_encode($msg);
                
            }
            else{
                
                $msg = array('status'=>'Failed','msg'=>'Error!!');
                echo json_encode($msg);
            }
          
            
        }
    }
        
    
    
    public function member_auth()
    {
        
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        
    
               if($phone!='' && $password!=''){
            
            $auth =  $this->Member_model->member_auth_data_with_phone( $phone , $password );  
        
                if($auth->num_rows() > 0){
                     
                        $logindata  = $auth->row_array();
                        $userid=     $logindata['MemberID'];
                        $phone = $logindata['Phone'];
                        
                        //$sesdata = array('id'=>$id,'email'=> $email,'logged_in' => TRUE);
                        //$this->session->set_userdata($sesdata);
                        //redirect('Admin/dashboard');
        	        
        	        $datas = array('status'=>'Success','msg'=>'Login Successfully','user_id'=>$userid);
                    echo json_encode($datas);
                   
        	    }else{
        	        
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
        
        
        $length = 6;
        $str = '0123456789';
        $resettoken = substr(str_shuffle($str), 0, $length);
        
        $tokeninsert = $this->Member_model->insert_reset_token($email,$phone,$resettoken);
        // print_r(tokeninsert);
        $sendmail = $this->send_email_for_reset_token($email,$resettoken);
        // $sendmsg = $this->send_msg_for_reset_token($phone,$resettoken);
        
        if($tokeninsert || $sendmail){
            $memid= $this->Member_model->get_memid($email,$phone);
            
           if($memid->num_rows() > 0){
                     
                        $logindata  = $memid->row_array();
                        $meid=     $logindata['MemberID'];
                        
            $datas = array('status'=>'Success','msg'=>'Token Generated Successfully','memberID'=>$meid,'email'=>$email);
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
        
       /* if($email != ''){
            
            $length = 8;
            $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
              
            $resettoken = substr(str_shuffle($str), 0, $length);
            
            $this->Member_model->insert_reset_token($email,$resettoken);

        }elseif($phone != ''){
            
            $length = 8;
            $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
              
            $resettoken = substr(str_shuffle($str), 0, $length);
            
            $this->Member_model->insert_reset_token($email,$resettoken);
            
        }*/
        
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
    
    // public function send_msg_for_reset_token($phone,$resettoken)
//     {
//         //	$apiKey = urlencode('lwHg4/unmNs-sDzGCNZxhebNp1mYexD7ApS1JdtnFV');
//     $apiKey ="";
// 	// Message details
// 	$numbers = array("+91".$phone);
// 	$sender = urlencode('QWICKIND');
// 	$message = rawurlencode("Your reset password token is $resettoken ");
 
// 	$numbers = implode(',', $numbers);
 
// 	// Prepare data for POST request
// 	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
// 	// Send the POST request with cURL
// 	$ch = curl_init('https://api.textlocal.in/send/');
// 	curl_setopt($ch, CURLOPT_POST, true);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	$response = curl_exec($ch);
// 	curl_close($ch);
          
// // /*Your authentication key*/
// // $authKey = "3456655757gEr5a019b18";
// // /*Multiple mobiles numbers separated by comma*/
// // $mobileNumber = $phone;
// // /*Sender ID,While using route4 sender id should be 6 characters long.*/
// // $senderId = "ABCDEF";
// // /*Your message to send, Add URL encoding here.*/
// // $message = "Hello $phone";
// // $message.= "<h3>Please find your Reset Password Token Below Here</h3>
// //             <p><b>Token:&nbsp;&nbsp;</b>$resettoken</p>
// //             <p>Copy the above mentioned code and go back to the reset password screen on Qwickhand app</p>
// //             <h4><i>Thanks & Regards,</i></h4>
// //             <p>Qwick Hand</p>";
// // /*Define route */
// // $route = "route=4";
// // /*Prepare you post parameters*/
// // $postData = array(
// // 'authkey' => $authKey,
// // 'mobiles' => $mobileNumber,
// // 'message' => $message,
// // 'sender' => $senderId,
// // 'route' => $route
// // );
// // /*API URL*/
// // $url="https://control.msg91.com/api/sendhttp.php";
// // /* init the resource */
// // $ch = curl_init();
// // curl_setopt_array($ch, array(
// // CURLOPT_URL => $url,
// // CURLOPT_RETURNTRANSFER => true,
// // CURLOPT_POST => true,$newdata = array(
                // 'Phone' =>  $inputdata['Phone'],
                // 'FirstName' => $inputdata['FirstName'],
                // 'LastName' =>  $inputdata['LastName'],
                // 'PostCode' => $inputdata['PostCode'] ,
                // 'Email' => $inputdata['Email'],
                // 'Password' => md5($inputdata['Password']),
                //  'CreditScore' => '100' ,
                //  'ValidTill'=>'2029/12/31' ,
                //  'English' =>'0',
                //  'TChinese'=>'0',
                //  'SChinese'=>'0'
               
                //  hash ( "sha256", $str );
                //  'Password'
        // );
// // CURLOPT_POSTFIELDS => $postData
// // /*,CURLOPT_FOLLOWLOCATION => true*/
// // ));
// // /*Ignore SSL certificate verification*/
// // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// // /*get response*/
// // $output = curl_exec($ch);
// // /*Print error if any*/
// // if(curl_errno($ch))
// // {
// // echo 'error:' . curl_error($ch);
// // }
// // curl_close($ch);
	
//     }
    
    
    public function reset_password($memberid)
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
        else{ 
            
            
            $newdata = array(
                
                // 'Password' => md5($inputdata['password']),
                  
                 'Password' => hash ( "sha256", $inputdata['password'] ),
                 'ResetPasswordToken' => $inputdata['reset_token']
        );
        
        $checkexists =   $this->Member_model->check_exists($newdata['ResetPasswordToken'],$memberid);
        
        
            if(!empty($checkexists)){
            $resetpassword = $this->Member_model->reset_password_data($newdata,$memberid);
            
            if($resetpassword){
                
                 $datas = array('status'=>'Success','msg'=>'Password Reset Successfully');
                 echo json_encode($datas);
                
            }
            else
            {
                
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
    
    public function get_member_setting_data($memberid)
    {
        $meberdata = $this->Member_model->get_member_data_by_id($memberid);
        
        echo json_encode($meberdata);
    }
    
    public function member_data_update($memberid)
    {
        $inputdata = $this->input->post();
        
       
        
        
        if($inputdata['Phone']=='' || $inputdata['FirstName'] =='' || $inputdata['LastName'] =='' || $inputdata['Email']=='' ||$inputdata['Retype_Email']=='' || $inputdata['PostCode'] =='' ||   $inputdata['Password']=='' || $inputdata['Retype_Password']=='' )
        {
            $msg = array('status'=>'Failed','msg'=>'Please Fill All Required Fileds');
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
        else
        {
             
            $newdata = array(
                'Phone' =>  $inputdata['Phone'],
                'FirstName' => $inputdata['FirstName'],
                'LastName' =>  $inputdata['LastName'],
                'PostCode' => $inputdata['PostCode'] ,
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
           
            $update =  $this->Member_model->member_update_setting($newdata,$memberid);

            if($update){
                
                $msg = array('status'=>'Success','msg'=>'Updated Successfully');
                echo json_encode($msg);
            
                
            }else{
                
                $msg = array('status'=>'Failed','msg'=>'Error!!');
                echo json_encode($msg);
            
            }          
           
            
        }
    }
}