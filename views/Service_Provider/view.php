   <section id="main-content">
          <section class="wrapper">
         <div class="row">
                  <div class="col-lg-12">
                      <section class="card">
                          <header class="card-header">
                           <div class="row">
                             <div class="col-md-6 col-12 heading">
                               <h4><b>Service Provider List</b></h4>
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
                      <th>First Name</th>  
                      <th>Last Name</th>
                      <th>Company Name</th>
                      <th>Language</th>
                      <th>Address</th> 
                      <th>Contact Details</th>
                      <th>Credit Score</th>  
                      <th>Valid Till</th>
                      <th>Announcement</th>
                     
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
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                    
                </tr>
                <?php }else{ $i=1; foreach($result as $res) { ?>
                
            <tr class="gradeX">
                  
                <td><?php echo $i++; ?></td>
                
	           <td><?php echo $res->FirstName;?></td>
			   <td><?php echo $res->LastName;?></td>
			   <td><?php echo $res->CompanyName;?></td>
			   <td><?php echo $res->English.'<br>'.$res->TChinese.'<br>'.$res->SChinese;?></td>
				<td><?php echo $res->Address;?></td>
				<td><?php echo $res->Phone;?></td>
			   <td><?php echo $res->CreditScore;?></td>						
               <td><?php echo $res->ValidTill;?></td>
			   <td><?php echo $res->AnnouncementE.'<br>'.$res->AnnouncementSC.'<br>'.$res->AnnouncementTC;?></td>
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
    