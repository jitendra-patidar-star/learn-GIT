
      <div class="row exammodule-footer">
            <div class="col-md-4"></div>
              <div class="col-md-4"> 
              <p class="text-center " style="margin-bottom: 0px;text-align:center;"><span style="color:#0095FF;">Qwickhand</span><span id="copyrightyear" style="color:#00000 !important"> © 2021 All Rights Reserved</span> </p>
          </div>
          <div class="col-md-4"></div>
      </div>
      <!--footer end-->

   </section>
   </section>
   
     
<script type="text/javascript">
 
        $(function(){
    var url = window.location.pathname, 
    urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
          console.log(urlRegExp);
        $('li a').each(function(){
                    // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                console.log("this",this);
                $(this).parent().addClass('active');
                $(this).parent().parent().parent().children().addClass('active');
                /*$(this).parent().parent().removeAttr("style");*/
            }
        });
    });

    
 $(document).ready(function() {
    var currentURL = $(location).attr("href");
    var page1= "<?php echo base_url();?>User/index";
    
    if (currentURL === '<?php echo base_url();?>User/index' ) 
    {
       
    $('#dashboardpage').addClass('active');    
    }  
       
});

</script>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

   
    <!-- js placed at the end of the document so the pages load faster -->

    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>

    <script src="<?php echo base_url();?>assets/comingsoon/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/comingsoon/vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo base_url();?>assets/comingsoon/vendor/bootstrap/js/bootstrap.min.js"></script>
     <script src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
    <!--<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>-->
    <script src="<?php echo base_url();?>assets/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/assets_front/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo base_url();?>assets/js/owl.carousel.js" ></script>
    <script src="<?php echo base_url();?>assets/js/jquery.customSelect.min.js" ></script>
    

    
   <!-- <script src="<?php echo base_url();?>assets/comingsoon/vendor/select2/select2.min.js"></script>
    <script src="<?php echo base_url();?>assets/comingsoon/vendor/countdowntime/flipclock.min.js"></script>
	<script src="<?php echo base_url();?>assets/comingsoon/vendor/countdowntime/moment.min.js"></script>
	<script src="<?php echo base_url();?>assets/comingsoon/vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="<?php echo base_url();?>assets/comingsoon/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="<?php echo base_url();?>assets/comingsoon/vendor/countdowntime/countdowntime.js"></script>
    <script src="<?php echo base_url();?>assets/comingsoon/vendor/tilt/tilt.jquery.min.js"></script>-->
 
    
    
         
         
         
      <script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/assets_front/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/data-tables/DT_bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/respond.min.js" ></script>

    
    <!--right slidebar-->
    <script src="<?php echo base_url();?>assets/js/slidebars.min.js"></script>

  
    <!--dynamic table initialization -->
    <script src="<?php echo base_url();?>assets/js/dynamic_table_init.js"></script>
    
    <!--script for this page-->
    <script src="<?php echo base_url();?>assets/js/sparkline-chart.js"></script>
    <script src="<?php echo base_url();?>assets/js/easy-pie-chart.js"></script>
    <script src="<?php echo base_url();?>assets/js/count.js"></script>
    
    
    
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/fuelux/js/spinner.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/jquery-multi-select/js/jquery.multi-select.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/jquery-multi-select/js/jquery.quicksearch.js"></script>
  
 <!-- <script src="<?php echo base_url();?>assets/comingsoon/js/main.js"></script>-->
  
 
   <!--select2-->
  <script type="text/javascript" src="<?php echo base_url();?>assets/assets_front/select2/js/select2.min.js"></script>
  <!--summernote-->
  <script src="<?php echo base_url();?>assets/assets_front/summernote/summernote-bs4.min.js"></script>
   <!--multiselect start + spinner + wysihtml5 scripts-->
  <script src="<?php echo base_url();?>assets/js/advanced-form-components.js"></script>
  <!--pickers script-->
  <script src="<?php echo base_url();?>assets/js/pickers/init-date-picker.js"></script>
  <script src="<?php echo base_url();?>assets/js/pickers/init-datetime-picker.js"></script>
  <script src="<?php echo base_url();?>assets/js/pickers/init-color-picker.js"></script>
<!--bootstrap-switch-->
  <script src="<?php echo base_url();?>assets/assets_front/bootstrap-switch/static/js/bootstrap-switch.js"></script>

  <!--bootstrap-switch-->
  <script src="<?php echo base_url();?>assets/assets_front/switchery/switchery.js"></script>
 
    <!--dropzone -->
    <script src="<?php echo base_url();?>assets/assets_front/dropzone/dropzone.js"></script>
    
     <!--common script for all pages-->
    <script src="<?php echo base_url();?>assets/js/common-scripts.js"></script>
    
      <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
      

  </body>
</html>
