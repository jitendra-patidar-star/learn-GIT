<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {


	public function saverecords($data)
	{
        $this->db->insert('user',$data);
	}
		public function get_user()
	{
	   
		$this->db->select('*');
		$this->db->from('user');
     	/*$this->db->where('position',1);*/
		$query = $this->db->get();
	
	 if($query -> num_rows() >0)
	   {
	     return $query->result_array();
	   }
	   else
	   {
	     return false;
	   }

	}
	
		public function get_token($token)
	{
	   
		$this->db->select('*');
		$this->db->from('user');
     /*	$this->db->where('position',1);*/
     	$this->db->where('reset_token_id',$token);  
		$query = $this->db->get();
	
	 if($query -> num_rows() > 0)
	   {
	     return $query->result_array();
	   }
	   else
	   {
	     return false;
	   }

	}
	
	
	public function get_user_by_id($id)
	{
	   
		$this->db->select('*');
		$this->db->from('user');
     /*	$this->db->where('position',1);*/
     	$this->db->where('id',$id);
		$query = $this->db->get();
	
	 if($query -> num_rows() > 0)
	   {
	     return $query->result_array();
	   }
	   else
	   {
	     return false;
	   }

	}
     public function view_data()
	{
	    
		$this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
	 
	   if($query->num_rows() > 0)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }

	}
	public function update($data,$id) {
       
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        
    }
    
    public function reset_token($token,$pass){
        
        if(!empty($pass) && !empty($token)){
             
            $update = $this->db->query("UPDATE user SET Password = '$pass' WHERE reset_token_id='$token'");
          
            return $update?true:false;
        }else{
            return false;
        }
       
        
    }
    public function update_token($id,$data) {
       
        $this->db->where('id',$id );
        $this->db->update('user', $data);
        
    }
    
     public function changepass($token,$new_pass)

    {
        if(!empty($new_pass) && !empty($token)){
             
            $update = $this->db->query("UPDATE user SET Password = '$new_pass' WHERE reset_token_id='$token'");
            return $update?true:false;
        }else{
            return false;
        }
       
    }
	

}