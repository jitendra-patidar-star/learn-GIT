   <section id="main-content">
          <section class="wrapper">
         <div class="row">
                  <div class="col-lg-12">
                      <section class="card">
                          <header class="card-header">
                           <div class="row">
                             <div class="col-md-6 col-12 heading">
                               <h4><b>Transaction List</b></h4>
                      </div>
                    
                          </div>
                   </header>
                  <div class="card-body">
                   <div class="adv-table">
                   <div class="table-responsive">
                   <table  class="display table table-bordered  table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Job ID</th>  
                      <th>Date</th>
                      <th>Service Name</th>
                      <th>Service Provider</th>  
                      <th>Member Name</th>
                      <th>Stage</th>
                   </tr>
                    </thead>
               <tbody>
                <?php if(empty($result)){?>
                
                <tr>
                       <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;">NO DATA AVAILABLE</td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                    
                </tr>
                <?php }else{ $i=1; foreach($result as $res) { ?>
                
            <tr class="gradeX">
                  
                <td><?php echo $i++; ?></td>
                
	           <td></td>
			   <td></td>
			   <td></td>
			   <td></td>
			   <td></td>
			   <td></td>
									
              
            </tr>
                <?php } }?>
                </tbody>
                </table>
              </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    