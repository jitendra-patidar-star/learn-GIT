   <section id="main-content">
          <section class="wrapper">
         <div class="row">
                  <div class="col-lg-12">
                      <section class="card">
                          <header class="card-header">
                           <div class="row">
                             <div class="col-md-6 col-12 heading">
                               <h4><b>Job List</b></h4>
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
                      <th>Member Name</th> 
                      <th>Service Provider Name</th>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Budget</th>
                   </tr>
                    </thead>
               <tbody>
                <?php if(empty($result)){?>
                
                <tr>
                     <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;">NO DATA AVAILABLE</td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                    
                </tr>
                <?php }else{ $i=1; foreach($result as $res) { ?>
                
            <tr class="gradeX">
                  
                <td><?php echo $i++; ?></td>
                
	           <td><?php echo $res->JobID;?></td>
			   <td><?php echo $res->memberfname.'<br>'.$res->memberlname;?>;?></td>
			   <td><?php echo $res->ServiceProviderFirstName.'<br>'.$res->ServiceProviderLastName;?></td>
			   <td><?php echo $res->JobDate;?></td>
			   <td><?php echo $res->JobDescription;?></td>
			   <td><?php echo $res->Budget;?></td>
             
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
    