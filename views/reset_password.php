<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Mosaddek">
	<meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>/assets/css/bootstrap-reset.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Custom styles for this template -->
	<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet">
</head>
<style>
	.modal-header{
	        display:initial !important;
	    }
</style>

<body class="login-body">
    <form class="form-signin"  id="resetpass" method="post">
    <!--	<form method="post" action="<?php echo base_url('Profile/reset_token_fill/');?>"  class="form-signin" id="resetpass" >-->
		<div class="login-wrap">
			<!--<input type="hidden" name="userid" id="adminid" value="<?php echo $_SESSION['id'];?>" />-->
			<div class="form-signin-heading">
				<p class=" text-center" style="padding:10px;color:#0095FF;text-align:center !important;font-size:21px;">
					<B>RESET PASSWORD</b>
				</p>
			</div>
			<div class="md-form md-outline">
				<input type="text" id="reset_token_id" name="reset_token_id" class="form-control mb-3" placeholder="Enter Your Reset Token ID" >
				<label data-error="wrong" data-success="right" for="reset_token_id"></label>
			</div> <span id="rst_error" class="text-danger"></span> 
			<div class="md-form md-outline">
				<input type="password" id="newPass" name="newpwd" class="form-control mb-3" placeholder="New password" >
				<label data-error="wrong" data-success="right" for="newPass"></label>
			</div> <span id="newpwd_error" class="text-danger"></span>
			<div class="md-form md-outline">
				<input type="password" id="newPassConfirm" name="cpwd" class="form-control mb-3" placeholder="Confirm password" >
				<label data-error="wrong" data-success="right" for="newPassConfirm"></label>
			</div> <span id="cpwd_error" class="text-danger"></span>
				<div class="form-group text-center">
								<div class="col-lg-12 ">
									<input type="submit" value="Submit" class="btn btn-qwick " />
								</div>
							</div>
		</div>
	</form>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script>
			$('#resetpass').submit(function(event){
			event.preventDefault();
			
			var adminid = $('#adminid').val();
			var formdata=$('#resetpass').serialize();
			
			$.ajax({
			        url:'<?php echo base_url()?>Profile/change_pass/'+adminid,
			         method: 'POST',
			         data: formdata,
			         dataType:"json",
			         beforeSend:function(){
			        $('#submit').attr('disabled', 'disabled');
			       },
			       success:function(data)
			       {
			           
			    if(data.error)
			        {
			         if(data.newpwd_error != '')
			         {
			          $('#newpwd_error').html(data.newpwd_error);
			         }
			         else
			         {
			          $('#newpwd_error').html('');
			         }
			         if(data.cpwd_error != '')
			         {
			          $('#cpwd_error').html(data.cpwd_error);
			         }
			         else
			         {
			          $('#cpwd_error').html('');
			         }
			          
		        }
			        if(data.success)
			        {
			             $('#success_message').html(data.success);
			             $('#newpwd_error').html('');
			             $('#cpwd_error').html('');
			             $('#resetpass')[0].reset();
			        }
			        $('#submit').attr('disabled', false);
			  
			       }
			  })
			 });
		</script>