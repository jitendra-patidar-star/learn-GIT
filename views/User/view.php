<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-sm-12">
				<section class="card">
					<header class="card-header">
						<h4><b>All Users</b></h4>
					</header>
					<div class="card-body">
						<div class="adv-table">
							<div class="table-responsive">
								<table class="display table table-bordered  table-striped" id="dynamic-table">
									<thead>
										<th>Sr No.</th>
										<th>First Name</th>
									    <th>Last Name</th>
										<th>Email</th>
										<th>Company Name</th>
										<th>Address</th>
										<th>Phone</th>
										<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(empty($result)){ ?>
										<tr>
											<td colspan="6" class="text-center">NO DATA AVAILABLE</td>
										</tr>
										<?php }else{ $i=1; foreach($result as $res) { ?>
										<tr class="gradeX">
											<td>
												<?php echo $i++; ?>
											</td>
											<td>
												<?php echo $res->name; ?></td>
											<td>
												<?php echo $res->last_name; ?></td>
												<td>
												<?php echo $res->email; ?></td>
												<td>
												<?php echo $res->company_name; ?></td>
											<td>
												<?php echo $res->address; ?></td>
											<td>
												<?php echo $res->phone; ?></td>
											<td>
												<?php if($res->position !=1){ ?>
												<a href="<?php echo base_url('User/user_update/'.$res->id);?>" type="button" class="btn btn-sm btn-round btn-qwick viewit"> <i class="fa fa-edit" title="view"></i>
												</a>
												<?php }?>
											</td>
										</tr>
										<?php } } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>