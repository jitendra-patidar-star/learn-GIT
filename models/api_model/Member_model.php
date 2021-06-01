<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

   	public function __construct()
	{
		parent::__construct();
	}
	
	public function member_insert($data)
	{
	    $this->db->insert('Member',$data);
	}
	
	public function member_auth_data($email,$password)
	{
	 
	 $q =  $this->db->select('Email,Phone,Password')
	                ->from('Member')
	                ->where(array('Email'=>$email,'Password'=>md5($password)))
	                ->get();
	 return $q;
	}
	
	public function member_auth_data_with_phone($phone,$password)
	{
	 
	 $q =  $this->db->select('Phone,MemberID')
	                ->from('Member')
	                ->where(array('Phone'=>$phone,'Password'=>hash ( "sha256", $password )))
	                ->get();
	 return $q;
	}
	
    // 	hash ( "sha256", $password )
	
	public function insert_reset_token($email,$phone,$resettoken)
	{
	    $resetdata = array('ResetPasswordToken'=>$resettoken);
	    $q =   $this->db->where(array('Email'=>$email))
	                    ->where(array('Phone'=>$phone))
	                    ->update('Member',$resetdata);
	                   // return $q->result_array();
	                    
	}
	
		public function get_memid($email,$phone){
	     $q=$this->db->select('MemberID')
	                ->from('Member')
	                ->where(array('Email'=>$email,'Phone'=>$phone))
	                ->get();    
	                
	        return $q;   
	}
	
	public function reset_password_data($newdata,$memberid)
	{
	   
	    $datas = array('Password'=>$newdata['Password']);
	    $q =   $this->db->where(array('MemberID'=>$memberid,'ResetPasswordToken'=>$newdata['ResetPasswordToken']))
	                    ->update('Member',$datas);
	                    
	   return true;
	}
	
	public function get_member_data_by_id($memberid)
	{
            $q = $this->db->select('*')
                         ->from('Member')
                         ->where('MemberID',$memberid)
                         ->get();
                         
            return $q->result_array();
	}
	
	public function member_update_setting( $data , $memberid )
	{
	   $q = $this->db->where('MemberID',$memberid)
	                 ->update('Member',$data);
	   return $q;
	}
	public function check_email_exists($email)
	{
    $checkmail =    $this->db->from('Member')
                                 ->where('Email',$email)
                                 ->get();
                                 
        $result = $checkmail->result_array();
        return $result;
                    
	}
	public function check_phone_exists($phone)
	{
    $checkmail =    $this->db->from('Member')
                                 ->where('phone',$phone)
                                 ->get();
                                 
        $result = $checkmail->result_array();
        return $result;
                    
	}
	
	public function check_exists($data,$mid)
	{
    $checkmail =    $this->db->from('Member')
                                 ->where(array('MemberID'=>$mid,'ResetPasswordToken'=>$data))
                                 ->get();
                                 
        $result = $checkmail->result_array();
        
        return $result;
                    
	}
}