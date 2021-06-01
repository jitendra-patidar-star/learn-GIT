<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Qwickhand</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap-reset.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">


    <!--external css-->
        <link href="<?php echo base_url();?>assets/assets_front/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="<?php echo base_url();?>assets/assets_front/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.carousel.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets_front/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets_front/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets_front/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets_front/bootstrap-timepicker/compiled/timepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets_front/bootstrap-daterangepicker/daterangepicker-bs3.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets_front/bootstrap-datetimepicker/css/datetimepicker.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets_front/colorpicker/css/bootstrap-colorpicker.min.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets_front/jquery-multi-select/css/multi-select.css" />
          <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
          <link rel="stylesheet" href="<?php echo base_url();?>assets/css/table-responsive.css" />

	<link href="<?php echo base_url();?>assets/assets_front/file-input/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/assets_front/file-input/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
    

     <!--dynamic table-->
    <link href="<?php echo base_url();?>assets/assets_front/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/assets_front/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/assets_front/data-tables/DT_bootstrap.css" />
   
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!--right slidebar-->
    <link href="<?php echo base_url();?>assets/css/slidebars.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" />
    
<style>
   
.modal-header{
        background-color: #0095FF important;
    }
.btn-success {
    background-color: #78CD51;
    border-color: #78CD51;
    color: #FFFFFF;
}
.modal {
    z-index: 1320 !important;
}
.qwick{
    color: #0095FF !important;
    font-size:21px;
   
}
</style>
  </head>

  <body class="light-sidebar-nav">

  <section id="container">
      <!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <i class="fa fa-bars"></i>
              
            <!--logo start-->
            <a href="javascript:;" class="qwick"><b> QWICKHAND</b></a>
            <!--logo end-->
          </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                 <!--   <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>-->
                    <!-- user login dropdown start-->
                    <!--<li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar1_small.jpg">
                            <span class="username">Jhon Doue</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout dropdown-menu-right">
                            <div class="log-arrow-up"></div>
                            <li><a href="https://exammodule.reflomsolutions.com/admins/Profile"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                            <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>-->
                   <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle active" href="#" aria-haspopup="true" aria-expanded="false" id="dropdown01">
                      <!--<img alt="" src="<?php echo base_url();?>assets/assets_front/upload/Group_620(1).png" style="width: 29px;height:29px;">-->
                                   <?php
                                 
                                 $loginid =  $_SESSION['id'];
                                 
                                 if($_SESSION['position'] == 1){
                                 ?>
                            
                                 <span class="username"> Admin </span>
                                                             
                                    <?php } else{ 
                                         $adminname =  $this->db->get_where('user',array('id'=>$loginid))->row()->name; 
                                    ?>
                                    
                                 <span class="username"><?php  echo $adminname   ; ?></span>
                                    <?php } ?>

                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended dropdown-menu-right active" aria-labelledby="dropdown01">
                            <div class="log-arrow-up"></div>
                            <li class="dropdown-item active" style="background-color: white;"><a href="<?php echo base_url()?>Profile/profile_update/<?php echo $_SESSION['id']; ?>"><i class=" fa fa-suitcase" ></i> Profile</a></li>
                            
                            <li class="dropdown-item" style="background-color: white;"><a href="<?php echo base_url()?>Admin/Logout"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                 </li>
                   <!-- <li class="sb-toggle-right">
                        <i class="fa  fa-align-right"></i>
                    </li>-->
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
           <div id="sidebar"  class="nav-collapse">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu " id="nav-accordion" >
                 
                 <li class="sub-menu " data-url="<?php echo base_url('User/index');?>" id="0" >
                      <a href="<?php echo base_url()?>User/index" id="dashboardpage">
                           <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                      </li>
          
        <!--  <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
             <!-- <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="<?php echo base_url()?>User/index" id="dashboardpage">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                           </a>-->
              <!--    </li>-->
                 <li class="sub-menu" id="1">
                      <a href="javascript:;" >
                          <i class="fa fa-user"></i>
                          <span>User</span>
                      </a>
                      <ul class="sub">
                          <li id="011" data-url="<?php echo base_url('User/index')?>"> <a  href="<?php echo base_url('User/index')?>"><i class="fa fa-plus-circle"></i>Create User</a></li>
                          <li id="012" data-url="<?php echo base_url('User/view')?>"> <a  href="<?php echo base_url('User/view')?>"><i class="fa fa-list"></i> View User</a></li>
                        
                      </ul>
                  </li>
                  

                  <li class="sub-menu" id="2">
                        <a href="javascript:;" >
                          <i class="fa fa-sliders"></i>
                          <span>Service Provider</span>
                      </a>
                     <ul class="sub">
                         
                          <li id="021" data-url="<?php echo base_url('Service_Provider/view')?>"> <a  href="<?php echo base_url('Service_Provider/view')?>"><i class="fa fa-eye"></i>View Service Provider</a></li>

                      </ul>
                  </li>
                     

                     <li class="sub-menu" id="3">
                      <a href="javascript:;" >
                          <i class="fa fa-wrench"></i>
                          <span>Issue RFQ</span>
                      </a>
                     
                  </li>
                     <li class="sub-menu" id="4">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Service</span>
                      </a>
                       <ul class="sub">
                          <li id="051" data-url="<?php echo base_url('Service_list/index')?>"> <a  href="<?php echo base_url('Service_list/index')?>"><i class="fa fa-plus-circle"></i>Create Service</a></li>
                          <li id="052" data-url="<?php echo base_url('Service_list/view')?>"> <a  href="<?php echo base_url('Service_list/view')?>"><i class="fa fa-eye"></i> View Service</a></li>
                        
                      </ul>
                  </li>
                  
                  
                  
                 <li class="sub-menu" id="5">
                       <a href="javascript:;" >
                          <i class="fa fa-bars"></i>
                          <span>Job List</span>
                      </a>
                       <ul class="sub">
                         
                          <li id="051" data-url="<?php echo base_url('Job/view')?>"> <a  href="<?php echo base_url('Job/view')?>"><i class="fa fa-eye"></i>View Job List</a></li>

                      </ul>
                  </li>
                    <li class="sub-menu" id="6">
                      <a href="javascript:;" >
                          <i class="fa fa-user"></i>
                          <span>Service Type</span>
                      </a>
                      <ul class="sub">
                          <li id="061" data-url="<?php echo base_url('Service_type/index')?>"> <a  href="<?php echo base_url('Service_type/index')?>"><i class="fa fa-plus-circle"></i>Create Service Type</a></li>
                          <li id="062" data-url="<?php echo base_url('Service_type/view')?>"> <a  href="<?php echo base_url('Service_type/view')?>"><i class="fa fa-eye"></i> View Service Type</a></li>
                        
                      </ul>
                  </li>
                  
                     <li class="sub-menu" id="7">
                      <a href="<?php echo base_url('Transaction/view')?>" >
                          <i class="fa fa-exchange"></i>
                          <span>Transactions</span>
                      </a>
                     <ul class="sub">
                         
                          <li id="051" data-url="<?php echo base_url('Transaction/view')?>"> <a  href="<?php echo base_url('Transaction/view')?>"><i class="fa fa-eye"></i>View Transaction List</a></li>

                      </ul>
                  </li>
                     
                  <!--multi level menu start-->
              
                  <!--multi level menu end-->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      
      <script type="text/javascript">
      
      $(function() {
      $( 'ul.sidebar-menu li' ).on( 'click', function() {
            $( this ).parent().find( 'li.active' ).removeClass( 'active' );
            $( this ).addClass( 'active');
      });
     
});


  </script>
  

   
   