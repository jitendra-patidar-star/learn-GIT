
<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <section class="card">  
            <header class="card-header"><h4><b>Edit Service</b></h4></header>
            <div class="card-body">   
	           <form  method="post" action="<?php echo base_url('Service_list/updatedata/'.$result[0]['ServiceID']);?>" enctype="multipart/form-data">
	       
                    
	               <div class="row">
	              
	                     <div class="col-md-4">
	           <h3 class="text-center">FOR English</h3>
		        <div class="form-group row ">
        		 	    <div class="col-md-12">
                            <div class="form-group">
                                
                  						<label><i class="fa fa-cog"></i> Service Name</label>
                  					
                                <input type="text" name="service_name" id="service_name"  class="form-control" value="<?php echo $result[0]['ServiceE']?>" placeholder="Enter Service Name" required />
                            </div>
                            
                          <div class="form-group">
                                	<label><i class="fa fa-cog"></i> Service Type</label>
                                <select class="form-control" name="service_type_id" id="service_type_id">
											<option value="">Please Select Type</option>
										<?php if(!empty($result[0]['TypeE'])){ foreach($service as $ser) { ?>
										<option value="<?php echo $ser->TypeID; ?>"<?php if($ser->TypeID==$result[0]['TypeE']){ echo "Selected"; }?>>
											<?php echo $ser->TypeE;?></option>
										<?php } }?>
									</select>
                					
                            </div>
                            
                            
                    
                            
                            
                            
                            <div class="form-group">
                                
                  				<label><i class="fa fa-pencil"></i> Description</label>
           <textarea name="description_e" id="description_e" rows="4" class="form-control"  placeholder="Enter Your Description" required ><?php echo $result[0]['DescriptionE']?></textarea>
                            </div>                                               
                        </div>
                         </div>
                       
        
		       </div>
		       
		       
		       
		       	        <div class="col-md-4">
	           <h3 class="text-center">FOR T Chinese</h3>
		        <div class="form-group row ">
        		 	    <div class="col-md-12">
                            <div class="form-group">
                                
                  						<label ><i class="fa fa-cog"></i> Service Name</label>
                  					
                                <input type="text" name="service_name_t" id="service_name_t" value="<?php echo $result[0]['ServiceTC']?>" class="form-control" placeholder="Enter Service Name" required />
                            </div>
                            
                                   <div class="form-group">
                                	<label><i class="fa fa-cog"></i> Service Type</label>
                                <select class="form-control" name="service_type_idt" id="service_type_idt">
											<option value="">Please Select Type</option>
										<?php if(!empty($result[0]['TypeTC'])){ foreach($service as $ser) { ?>
										<option value="<?php echo $ser->TypeID; ?>"<?php if($ser->TypeID==$result[0]['TypeTC']){ echo "Selected"; }?>>
											<?php echo $ser->TypeTC;?></option>
										<?php } }?>
									</select>
                					
                                
                            </div>
                            
                            
                            
                            
                              <div class="form-group">
                                
                  				<label><i class="fa fa-pencil"></i> Description</label>
                  					   
                                <textarea name="description_t" rows="4" id="description_t" class="form-control" placeholder="Enter Your Description" required ><?php echo $result[0]['DescriptionTC']?></textarea>
                            </div>                                      
                        </div>
                         </div>
     	   
			 </div>
                          
                          
                          <div class="col-md-4">
	           <h3 class="text-center">FOR S Chinese</h3>
		        <div class="form-group row ">
        		 	    <div class="col-md-12">
                            <div class="form-group">
                                
                  						<label><i class="fa fa-cog"></i> Service Name</label>
                  					
                                <input type="text" name="service_name_s" id="service_name_s" value="<?php echo $result[0]['ServiceSC']?>" class="form-control" placeholder="Enter Service Name" required />
                            </div>
                            
                            
                               <!--<div class="form-group">
                       
                                
									<label>Service Type</label>
									<select class="form-control" name="service_type_ids" id="service_type_ids">
										<option value="">Please Select Type</option>
										<?php if(!empty($result[0][ 'service_type_ids'])){ foreach($service as $ser) { ?>
										<option value="<?php echo $ser->TypeID; ?>" <?php if($ser->TypeID==$result[0]['service_type_ids']){ echo "Selected"; }?>>
											<?php echo $ser->TypeSC;?></option>
										<?php } }?>
									</select>
							
								
                                
                            </div>-->
                            
                                 <div class="form-group">
                                	<label><i class="fa fa-cog"></i> Service Type</label>
                                <select class="form-control" name="service_type_ids" id="service_type_ids">
											<option value="">Please Select Type</option>
										<?php if(!empty($result[0]['TypeSC'])){ foreach($service as $ser) { ?>
										<option value="<?php echo $ser->TypeID; ?>"<?php if($ser->TypeID==$result[0]['TypeSC']){ echo "Selected"; }?>>
											<?php echo $ser->TypeSC;?></option>
										<?php } }?>
									</select>
                					
                                
                            </div>
                            
                            
                            
                              <div class="form-group">
                                
                  				<label><i class="fa fa-pencil"></i> Description</label>
                                <textarea name="description_s" id="description_s"  rows="4" class="form-control" placeholder="Enter Your Description" required><?php echo $result[0]['DescriptionSC']?></textarea>
                            </div>                                                
                        </div>
                         </div>
                       
 	    	
		     
		       </div> 
    		             <div class="form-group">
                          
                                      
             <div class="col-md-12">
                     <!-- <label class="control-label col-md-2">Image Upload</label>-->
                      <label><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Image Upload</label>
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;" required ></div>
                      <div>
                       <span class="btn btn-qwick btn-file">
                       <input type="file" name="files" />
                       <span class="file fileupload-new "><i class="fa fa-paper-clip"></i> Select image</span>
                    
                       <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                      
                       </span>
                         
                      </div>
                  </div>
                 
              </div>
            </div>
                        
	                    <div class="col-lg-12 form-group text-center">
			                 <button type="submit"  class="btn btn-qwick">Update</button>
	                    </div>
		       </form>
		      
		            </div>
             </div>
        </section>
      </div>
    </div>

  
