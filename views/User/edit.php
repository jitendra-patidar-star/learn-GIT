<style>
    .alert-danger{
        background:#0095ff33 !important;
        color:#0095FF !important;
    }
</style>

<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="card">
					<header class="card-header">
						<?php if( $this->session->flashdata('email_sent')){ echo "
						<div class='alert alert-danger text-center'>"; echo $this->session->flashdata('email_sent'); echo "</div>"; } ?>
						<div class="row">
							<div class="col-md-6 col-6">
								<h4><b> Update User</b></h4>
							</div>
							<div class="col-md-6 col-6 text-right"> <a href="<?php echo base_url('Profile/reset_token/'.$result[0]['id']);?>" class="btn btn-sm btn-round btn-qwick" type="button">RESET PASSWORD</a>
							</div>
							</span>
						</div>
		
			</header>
			<div class="card-body">
				<form method="post" action="<?php echo base_url('User/updatedata/'.$result[0]['id']);?>" enctype="multipart/form-data">
					<div class="form-group row ">
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="fa fa-user"></i>&nbsp;First Name</label>
								<input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" value="<?php echo $result[0]['name']; ?>" required/>
							</div> <span class="help-block text-danger">
                                      
                                    </span> 
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="fa fa-user" aria-hidden="true"></i> &nbsp;Last Name</label>
								<input type="text" class="form-control" placeholder="Enter your last name" id="last_name" name="last_name" value="<?php echo $result[0]['last_name']; ?>" required/>	<small class="form-text text-muted"></small>
							</div>	<span id="email_error" class="text-danger"></span>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; Email</label>
								<input type="email" class="form-control" placeholder="Enter your email" id="email" name="email" value="<?php echo $result[0]['email']; ?>" required/>	<small class="form-text text-muted"></small>
							</div> <span id="email_error" class="text-danger"></span>
						</div>
					</div>
					<div class="form-group row ">
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="fa fa-building-o"></i>&nbsp;Company Name</label>
								<input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $result[0]['company_name']; ?>" placeholder="Enter your company name" required/>
							</div> <span class="help-block text-danger"> </span> 
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="fa fa-address-card" aria-hidden="true"></i> &nbsp;Address</label>
								<input type="text" name="address" id="address" class="form-control" value="<?php echo $result[0]['address']; ?>" placeholder="Enter your address" required/>
							</div>	<span id="email_error" class="text-danger"></span>
						</div>
					<!--	<div class="col-md-4">
							<div class="form-group">
								<label><i class="fa fa-key" aria-hidden="true"></i> &nbsp;Password</label>
								<input type="password" name="password" class="form-control" placeholder="Enter your password" value="<?php echo $result[0]['password']; ?>" required/>
							</div> <span class="help-block text-danger">
                    
                </span> 
						</div>-->
							<div class="col-md-4">
							<div class="form-group">
								<label><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Phone</label>
								<input type="number" name="phone" class="form-control" placeholder="Enter phone no." value="<?php echo $result[0]['phone']; ?>" required />
							</div> <span class="help-block text-danger">
                                   
                                </span> 
						</div>
					</div>
					

					<div class="form-group row">
						<div class="col-md-6">
							<label><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Image Upload</label>
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
									<?php if($result[0][ 'logo']=='' ){ ?>
									<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
									<?php }else{ ?>
									<img src="<?php echo base_url();?>assets/assets_front/upload/<?php echo $result[0]['logo'];?>" alt="">
									<?php } ?>
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;" required></div>
								<div> <span class="btn btn-qwick btn-file">
                                                <input type="file" name="files" />
                                                <span class="file fileupload-new "><i class="fa fa-paper-clip"></i> Select image</span>
									<input type="hidden" name="old_img" value="<?php echo $result[0]['logo'];?>"> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						<div class="col-lg-12 ">
							<input type="submit" value="Update" class="btn btn-qwick " />
						</div>
					</div>
				</form>
			</div>
			</section>
		</div>
		</div>
