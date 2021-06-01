<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="card">
					<header class="card-header">
						
							<div class="row">
							<div class="col-md-6">
								<h4><b>Create User</b></h4>
							</div>
							 
							</span>
						</div>
					
					</header>
					<div class="card-body">
						<form method="post" action="<?php echo base_url('User/insertdata');?>" enctype="multipart/form-data">
							<div class="form-group row ">
								<div class="col-md-4">
									<div class="form-group">
										<label><i class="fa fa-user"></i>&nbsp;First Name</label>
										<input type="text" name="name" id="name" class="form-control" placeholder="Enter your first name" required/>
									</div> <span class="help-block text-danger"> </span> 
								</div>
									<div class="col-md-4">
									<div class="form-group">
										<label><i class="fa fa-user" aria-hidden="true"></i> &nbsp;Last Name</label>
										<input type="text" class="form-control" placeholder="Enter your last name" id="last_name" name="last_name" required/>	<small class="form-text text-muted"></small>
									</div>	<span id="email_error" class="text-danger"></span>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;Email</label>
										<input type="email" class="form-control" placeholder="Enter your email" id="email" name="email" required/>	<small class="form-text text-muted"></small>
									</div>	<span id="email_error" class="text-danger"></span>
								</div>
						
							</div>
							
							
								<div class="form-group row ">
								<div class="col-md-4">
									<div class="form-group">
										<label><i class="fa fa-building-o"></i>&nbsp;Company Name</label>
										<input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter your company name" required/>
									</div> <span class="help-block text-danger"> </span> 
								</div>
									<div class="col-md-4">
									<div class="form-group">
										<label><i class="fa fa-address-card" aria-hidden="true"></i> &nbsp;Address</label>
                                       <textarea name="address" rows="1" id="address" class="form-control" placeholder="Enter your address"></textarea>								
                                       </div>	<span id="email_error" class="text-danger"></span>
								</div>
							
							<!--	<div class="col-md-4">
									<div class="form-group">
										<label><i class="fa fa-key" aria-hidden="true"></i> &nbsp;Password</label>
										<input type="password" name="password" class="form-control" placeholder="Enter your password" required/>
									</div> <span class="help-block text-danger">
                    
                </span> 
								</div>-->
								<div class="col-md-4">
									<div class="form-group">
										<label><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Phone</label>
										<input type="number" name="phone" class="form-control" placeholder="Enter phone no." required />
									</div> <span class="help-block text-danger">
                   
                          </span> 
								</div>
							</div>
							
							
							
							
							<div class="from-group row">
								
								<div class="col-sm-4">
									<label><i class="fa fa-check-circle" aria-hidden="true"></i> &nbsp;Choose Position</label>
									<select class="form-control" name="position" id="position">
										<option value="">select position</option>
										<?php if(!empty($result)){ foreach($result as $res) { ?>
										<option value="<?php echo $res->p_id;?>">
											<?php echo $res->name;?></option>
										<?php } }?>
									</select>
								</div>
							</div>
							<div class="form-group row">
							<div class="col-md-6">
							    <br>
									<!-- <label class="control-label col-md-2">Image Upload</label>-->
									<label><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Image Upload</label>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
											<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
										</div>
										<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
										<div> <span class="btn btn-qwick btn-file">
                                                   <input type="file" name="files" required/>
                                                   <span class="file fileupload-new "><i class="fa fa-paper-clip"></i> Select image</span>
											<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
											</span>
										</div>
									</div>
								
								</div>
							</div>
							<div class="form-group text-center">
								<div class="col-lg-12 ">
									<input type="submit" value="Submit" class="btn btn-qwick" />
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
