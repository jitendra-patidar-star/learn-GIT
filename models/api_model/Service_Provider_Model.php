<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_Provider_Model extends CI_Model {

   	public function __construct()
	{
		parent::__construct();
	}
	
	public function service_provider_insert($data)
	{
	     $this->db->insert('Service_Provider',$data);
	}
	
	public function service_provider_auth_data($email,$password)
	{
	 
	 $q =  $this->db->select('Email,Phone,Password')
	                ->from('Service_Provider')
	                ->where(array('Email'=>$email,'Password'=>md5($password)))
	                ->get();
	 return $q;
	}
	
	public function service_provider_id()
	{
	       $this->db->select('ServiceProviderID');
           $this->db->from('Service_Provider');
           $this->db->order_by("ServiceProviderID", "desc");
           $this->db->limit(1);
           $query=$this->db->get();
           $x= $query->result_array();
           $tid= $x[0]['ServiceProviderID'];
           return $tid;

	}
	public function service_provider_auth_data_with_phone($phone,$password)
	{
	 
	 $q =  $this->db->select('Phone,ServiceProviderID,Password')
	                ->from('Service_Provider')
	                ->where(array('Phone'=>$phone,'Password'=>hash("sha256",$password)))
	                ->get();
	 return $q;
// 	 hash ( "sha256", $inputdata['Password'] )
	}
	
	public function insert_reset_token($email,$phone,$resettoken)
	{
	   
	    
        
	        $resetdata = array('ResetPasswordToken'=>$resettoken);
	        
    	    $q=$this->db->where(array('Email'=>$email))
    	                ->where(array('Phone'=>$phone))
    	                ->update('Service_Provider',$resetdata);
           
	}
	
	public function get_serproid($email,$phone){
	     $q=$this->db->select('ServiceProviderID')
	                ->from('Service_Provider')
	                ->where(array('Email'=>$email,'Phone'=>$phone))
	                ->get();    
	                
         return $q;   
	}

	
	public function reset_password_data($newdata,$serviceproviderid)
	{
	    $datas = array('Password'=>$newdata['Password']);
	    $q =   $this->db->where(array('ResetPasswordToken'=>$newdata['ResetPasswordToken'],'ServiceProviderID'=>$serviceproviderid))
	                    ->update('Service_Provider',$datas);
	   return true;
	}
	
	public function get_service_provider_data_by_id($serviceproviderid)
	{
            $q = $this->db->select('*')
                         ->from('Service_Provider')
                         ->where('ServiceProviderID',$serviceproviderid)
                         ->get();
                         
            return $q->result_array();
	}
	
	public function service_provider_update_setting( $data , $serviceproviderid )
	{
	   $q = $this->db->where('ServiceProviderID',$serviceproviderid)
	                 ->update('Service_Provider',$data);
	   return $q;
	}
	
	public function check_email_exists($email)
	{
    $checkmail = $this->db->from('Service_Provider')
                                 ->where('Email',$email)
                                 ->get();
                                 
        $result = $checkmail->result_array();
        return $result;
                    
	}
	public function check_phone_exists($phone)
	{
    $checkphone =    $this->db->from('Service_Provider')
                                 ->where('Phone',$phone)
                                 ->get();
                                 
        $result = $checkphone->result_array();
        return $result;
                    
	}
	
	public function service_provider_update($id,$data)
	{
	   
	    $q = $this->db->where('ServiceProviderID',$id)
	                    ->update('Service_Provider',$data);
	   

	}
	
	public function check_email_exists_sp($email)
	{
    $checkphone =    $this->db->from('Service_Provider')
                                 ->where('Email',$email)
                                 ->get();
                                 
        $result = $checkphone->result_array();
        return $result;
                    
	}
	
	public function check_exists($data,$spid)
	{
    $checkmail =    $this->db->from('Service_Provider')
                                 ->where(array('ServiceProviderID'=>$spid,'ResetPasswordToken'=>$data))
                                 ->get();
                                 
        $result = $checkmail->result_array();
        
        return $result;
                    
	}
	
}