<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="card">
					<header class="card-header">
						<div class="row">
							<div class="col-md-6 col-12 heading">
								<h4><b>Service Type List</b></h4>
							</div>
						</div>
					</header>
					<div class="card-body">
						<div class="adv-table">
							<div class="table-responsive">
								<table class="display table table-bordered  table-striped" id="dynamic-table">
									<thead>
										<tr>
											<th>Sr No.</th>
											<th>Service Name</th>
											<th>Description</th>
											<th>Image</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(empty($result)){?>
										<tr>
                                        				    <td style="border: none;"></td>
                                                            <td style="border: none;"></td>
                                                            <td style="border: none;">NO DATA AVAILABLE</td>
                                                            <td style="border: none;"></td>
                                                            <td style="border: none;"></td>
                                                            
										</tr>
										<?php }else{ $i=1; foreach($result as $res) { ?>
										<tr class="gradeX">
											<td>
												<?php echo $i++; ?>
											</td>
											<td>
												<?php echo $res->TypeE.'
												<br>'.$res->TypeSC.'
												<br>'.$res->TypeTC;?></td>
											<td>
												<?php echo $res->DescriptionE.'
												<br>'.$res->DescriptionSC.'
												<br>'.$res->DescriptionTC;?></td>
											<td></td>
											<td>
												<a href="<?php echo base_url('Service_type/update/'.$res->TypeID);?>" type="button" class="btn btn-sm btn-round btn-qwick viewit"> <i class="fa fa-edit" title="edit"></i>
												</a>
													<a href="<?php echo base_url('Service_type/deletedata/'.$res->TypeID);?>" type="button" class="btn btn-qwick btn-round btn-sm deleteit"> <i class="fa fa-trash-o" title="delete"></i>
											    </a>
											    
											</td>
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
