<?php
class Rating extends CI_controller{
   
   public function __construct()
	{
	    parent::__construct();
	    $this->load->model('api_model/Rating_model');
        $this->load->helper('string');
    }
    
    //function for member rating 2 service provider
     public function member_rating($jobid)  
    {  
       $inputdata= $this->input->post();
       $stageid =   $this->Rating_model->get_stageID($jobid);
    //   print_r($stageid[0]);
    //   die;
       
       if($inputdata['Actual'] =='' || $inputdata['MemberReview'] =='' || $inputdata['Member2ServiceProviderRating'] =='')
      {
            $msg = array('status'=>'Failed','msg'=>'Please Fill All Required Fileds');
            echo json_encode($msg);
            
        }
        elseif($stageid[0]==array('StageID'=>83)||$stageid[0]==array('StageID'=>85)){
             $msg = array('msg'=>'Member2ServiceProviderRating Already exists');
            echo json_encode($msg);
        }
        
    else{
        $newdata = array(
                'Actual' =>  $inputdata['Actual'],
                'MemberReview' => $inputdata['MemberReview'],
                'Member2ServiceProviderRating' =>  $inputdata['Member2ServiceProviderRating']
        );
         $insert =  $this->Rating_model->rating_insert($newdata,$jobid);
          
            if($newdata){
                 
                $msg = array('status'=>'Success','msg'=>'Rating Done');
                echo json_encode($msg);
                
                
                if($stageid[0]==array('StageID'=>81)){
                    
                    $update= $this->Rating_model->update_stage_81($jobid);
                }
                
                elseif($stageid[0]==array('StageID'=>82)){
                    
                    $update= $this->Rating_model->update_stage_82($jobid);
                }
                
                else{
                    $update= $this->Rating_model->update_stage_84($jobid);
                }
            }
            else{
                
                $msg = array('status'=>'Failed','msg'=>'Error!!');
                echo json_encode($msg);
            }
    }
    }  
    
        //function for service provider rating 2 member

    public function ser_pro_rating($jobid)  
    {  
       $inputdata= $this->input->post();
       $stageid =   $this->Rating_model->got_stageID($jobid);
    //   print_r($stageid[0]);
    //   die;
       
       if($inputdata['ServiceProviderReview'] =='' || $inputdata['ServiceProvider2MemberRating'] =='')
      {
            $msg = array('status'=>'Failed','msg'=>'Please Fill All Required Fileds');
            echo json_encode($msg);
            
        }
        elseif($stageid[0]==array('StageID'=>84)||$stageid[0]==array('StageID'=>85)){
             $msg = array('msg'=>'ServiceProvider2MemberRating Already exists');
            echo json_encode($msg);
        }
        
    else{
        $newdata = array(
                'ServiceProviderReview' => $inputdata['ServiceProviderReview'],
                'ServiceProvider2MemberRating' =>  $inputdata['ServiceProvider2MemberRating']
        );
         $insert =  $this->Rating_model->rate_insert($newdata,$jobid);
          
            if($newdata){
                 
                $msg = array('status'=>'Success','msg'=>'Rating Done');
                echo json_encode($msg);
                if($stageid[0]==array('StageID'=>81)){
                    
                    $update= $this->Rating_model->update_stagee_81($jobid);
                }
                
                elseif($stageid[0]==array('StageID'=>82)){
                    
                    $update= $this->Rating_model->update_stagee_82($jobid);
                }
                
                else{
                    $update= $this->Rating_model->update_stagee_83($jobid);
                }
            }
            else{
                
                $msg = array('status'=>'Failed','msg'=>'Error!!');
                echo json_encode($msg);
            }
    }
    }  
}
?>
