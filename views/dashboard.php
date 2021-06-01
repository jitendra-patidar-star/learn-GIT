<style>
    hr.new4 {
  border: 1px solid grey;
}
</style>
<?php
 
$dataPoints = array( 
	array("y" => 3373.64, "label" => "January" ),
	array("y" => 2435.94, "label" => "February" ),
	array("y" => 1842.55, "label" => "March" ),
	array("y" => 1828.55, "label" => "April" ),
	array("y" => 1039.99, "label" => "May" ),
	array("y" => 765.215, "label" => "June" ),
	array("y" => 612.453, "label" => "July" )
);
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Daily New Job"
	},
	axisY: {
		title: "Gold Reserves (in tonnes)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
     <section id="main-content">
          <section class="wrapper">
              <!--state overview start-->
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6 col-md-3">
                      <section class="card">
                          <div class="symbol terques">
                              <i class="fa fa-cogs"></i>
                          </div>
                          <div class="value">
                              <h1 style="color:black;">
                                 
                              </h1>
                              <p style="color:black;">Total Service Provider</p>
                          </div>
                      </section>
                  </div>
             
                  <div class="col-lg-3 col-sm-6 col-md-3">
                      <section class="card">
                          <div class="symbol red">
                             <i class="fa fa-users"></i>
                          </div>
                          <div class="value">
                           <!--   <h1 class=" count2">-->
                       
                           <h1 style="color:black;" >
                                  
                              </h1>
                              <p style="color:black;">Total Member</p>
                          </div>
                      </section>
                  </div>
              
                  <div class="col-lg-3 col-sm-6 col-md-3">
                      <section class="card">
                          <div class="symbol yellow">
                             <i class="fa fa-briefcase"></i>
                          </div>
                          <div class="value">
                              <h1 style="color:black;">
                                
                              </h1>
                              <p style="color:black;">All Confirmed Job</p>
                          </div>
                      </section>
                  </div> 
                
                  <div class="col-lg-3 col-sm-6 col-md-3">
                      <section class="card">
                          <div class="symbol yellow">
                             <i class="fa fa-window-close"></i>
                          </div>
                          <div class="value">
                              <h1 style="color:black;">
                                
                              </h1>
                              <p style="color:black;">All Closed Job</p>
                          </div>
                      </section>
                  </div> 
           
                      <div class="col-lg-4 col-sm-6 col-md-4">
                      <section class="card">
                           <section class="card">
                         <div id="chartContainer" style="width:300px !important;height:300px !important;"></div>
                      </section>
                      </section>
                  </div> 
                    <div class="col-lg-4 col-sm-6 col-md-4">
                      <section class="card">
                           <section class="card">
                         <div id="chartContainer" style="width:300px !important;height:300px !important;"></div>
                      </section>
                      </section>
                  </div> 
                    <div class="col-lg-4 col-sm-6 col-md-4">
                      <section class="card">
                          <section class="card">
                         <div id="chartContainer" style="width:300px !important;height:300px !important;"></div>
                      </section>
                      </section>
                  </div> 
              
                </div>

     <hr class="new4"></hr>
     
     
        <div class="row state-overview">
                  <div class="col-lg-4 col-sm-6 col-md-4">
                      <section class="card">
                          <div class="symbol terques">
                              <i class="fa fa-search"></i>
                          </div>
                          <div class="value">
                              <h1 style="color:black;">
                                 
                              </h1>
                              <p style="color:black;">New Job</p>
                          </div>
                      </section>
                  </div>
             
                  <div class="col-lg-4 col-sm-6 col-md-4">
                      <section class="card">
                          <div class="symbol red">
                             <i class="fa fa-check"></i>
                          </div>
                          <div class="value">
                           <!--   <h1 class=" count2">-->
                       
                           <h1 style="color:black;" >
                                  
                              </h1>
                              <p style="color:black;">Responded Job</p>
                          </div>
                      </section>
                  </div>
              
                  <div class="col-lg-4 col-sm-6 col-md-4">
                      <section class="card">
                          <div class="symbol yellow">
                             <i class="fa fa-briefcase"></i>
                          </div>
                          <div class="value">
                              <h1 style="color:black;">
                                
                              </h1>
                              <p style="color:black;">Confirmed Job</p>
                          </div>
                      </section>
                  </div> 
                
                  <div class="col-lg-4 col-sm-6 col-md-4">
                      <section class="card">
                          <div class="symbol yellow">
                             <i class="fa fa-window-close"></i>
                          </div>
                          <div class="value">
                              <h1 style="color:black;">
                                
                              </h1>
                              <p style="color:black;">Complete Job</p>
                          </div>
                      </section>
                  </div> 
            
               <div class="col-lg-4 col-sm-6 col-md-4">
                      <section class="card">
                          <div class="symbol yellow">
                             <i class="fa fa-window-close"></i>
                          </div>
                          <div class="value">
                              <h1 style="color:black;">
                                
                              </h1>
                              <p style="color:black;">All Closed Job</p>
                          </div>
                      </section>
                  </div> 
                  
              
                </div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>      