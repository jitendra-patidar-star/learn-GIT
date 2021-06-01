<style>
    .alert-danger{
        background:#0095ff33 !important;
        color:#0095FF !important;
    }
</style>
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
        background:#0095FF important;
    }
    
</style>
  <body class="login-body">

    <div class="container">

                   <form class="form-signin" method="post" action="<?php echo base_url('Admin/auth');?>">
                <div  style="max-height: 100%;max-width: 100%;width: 100%;text-align:center !important;">  
                    <p class=" text-center" style="padding:10px;color:#0095FF;text-align:center !important;font-size:31px;"><B>QWICKHAND</b></p>

<!--                <img class="card-img-top" src="<?php echo base_url();?>assets/assets_front/upload/<?php echo $results[0]['logo']; ?>" alt="Card image" style="max-height: 50%;max-width: 50%;padding:10px">
-->
              </div>

                          
                                <div class="form-signin-heading">
                                    <h5 class=" text-center"><strong>Welcome To Login</strong></h5>
                                </div>
           
        <div class="login-wrap">
                   <?php 
              if($this->session->flashdata('msg')){
                echo "<div class='alert alert-danger text-center mt-2'>";
                
                echo $this->session->flashdata('msg'); 
                echo "</div>";
              }
            ?> 
              
            		<?php $new_pass = $this->session->flashdata('message');
				if($new_pass==true){
				    echo "<div class='alert alert-info text-center'>";
				echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times";
				echo "</span></button>";
				echo $new_pass;
				echo "</div>";


				}	?>
				
           <input type="text" name="email" class="form-control mb-3" placeholder="Email/Phone" style="font-size: 16px;"  required>
            
            <input type="password" name="password" class="form-control mb-3 " placeholder="Password" onmouseover="this.type='text'"
       onmouseout="this.type='password'" style="font-size: 16px;" required> 
      
            <button class="btn  btn-block btn-qwick" type="submit">Sign in</button>
            
            </form>
           
            
           <a href="#myModal" data-toggle="modal" data-target="#myModal" class="btn  btn-block btn-qwick">Forgot your password?</a>
                  <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" style="background:#0095FF !important">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" >Forgot Password</h4>
                  </div>
             <div class="modal-body" style="color:black;">
        
              Please input your email:<br>
              
             <form method="post" action="<?php echo base_url('Admin/forgot_password');?>">
              
                  <div class="form group">
                    <label class="control-label col-sm-2">E-mail</label>
                      <div class="col-lg-8">
                        <input type="text" name="emailpass" class="form-control"/>
                      </div>
                  </div>
                  
                  <input type="submit" value="Submit" class="btn btn-qwick"/>
        
            </form>
              </div>
              </div>
      </div>
    </div>
  </div>
</div>

    </div>

   
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    

  </body>
</html>