<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
	
	<head>
		<?php require APPPATH . 'views/Auth/CssLinks.php'; ?>
		<style>
			@media print {
			.noPrint{
			display:none;
			}
			}
			h1{
			color:#f6f6;
			}	
			#print_btn 
			{
			position: relative;
			margin-left: 475px;
			margin-top: 10px;
			margin-bottom: 20px;
			}
		</style>
	</head>
	<!-- END: Head-->
	
	<!-- BEGIN: Body-->
	
	<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
		
		<!-- BEGIN: Topbar-->
		<?php require 'Topbar.php'; ?>
		<!-- END: Topbar-->
		
		<!-- BEGIN: Sidebar Menu-->
		<?php require 'Sidebar.php'; ?>
		<!-- END: Sidebar Menu-->
		
		<!-- BEGIN: Content-->
		<div class="app-content content">
			<div class="content-overlay"></div>
			<div class="content-wrapper" >
				<div class="content-header row">
				</div>
				
				<!--extra added here-->
				<div class="row mb-2">
					<div class="col-12">
						<span><a class="btn btn-primary btn-md" href="<?= base_url($this->data->controller);
						?>/Dashboard"><i class="fa-solid fa-arrow-left"></i> Back</a>&ensp;&ensp;&ensp;&ensp;<span style="font-size:25px;">Ledger Of  - <?= $list->name; ?> - <?= $list->pf_number; ?></span></span>
						
					</div></div>
					<!--extra added here-->
					
					<div class="content-body" ><!-- Stats -->
						
						<div class="row match-height">
							
							<!--2nd start here-->
							<div class="col-md-12 col-lg-12 col-sm-12">
								<div class="card">
									<center>
										<div class="card-content collapse show">
											
											<div class="card-body">
												<?php
													$srno =1;	
												?>
												<h5 class="card-title" style="font-family:verdana;margin-top:0px;"><?= $list->name; ?></h5>
												<ul class="list-inline" style="font-family:verdana;margin-top:-10px;">
													<li><b>PF Number</b> : </li>
													<li> <?= $list->pf_number; ?></li>
												</ul>
												<div class="card-body" style="margin-top:-15px;">
													<table class="table table-striped" style="width:100%">
														<tbody>
															<tr>
																<th>Savings : </th>
																<td><span>&#8377;</span> <?= $list->savings ?></td>
															</tr> 
															<tr>
																<th>Loan : </th>
																<td><span>&#8377;</span> <?= $list->loan ?></td>
															</tr>  
															<tr>
																<th>Shares : </th>
																<td><span>⬤</span> <?= $list->shares ?> </td>
															</tr>
															<!--<tr>
																<th>Grade : </th>
																<td><?= $list->grade ?></td>
																</tr>
																
																<tr>
																<th>Designation : </th>
																<td><?= $list->designation ?></td>
																</tr>
																
																<tr>
																<th>Mobile : </th>
																<td><?= $list->mobile ?></td>
																</tr>
																
																<tr>
																<th>Member Type : </th>
																<td>
																<div class="custom-control custom-switch custom-control-inline">
																<input type="checkbox" class="custom-control-input"  onchange="return Status(this,'<?= 'members'; ?>','id','<?= $list->id; ?>','is_status')"  <?php if($list->is_status == 'true') { echo 'checked'; } ?> id="switch-id<?=$srno;?>">
																<label class="custom-control-label mr-1" for="switch-id<?=$srno;?>"></label>
																</div>
																</td>
																</tr>
																
																<tr>
																<th>DateTime : </th>
																<td><?= $list->created_at ?></td>
															</tr>-->
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</center>
								</div>
							</div>
							<!--2nd end here-->
							
							<div class="col-md-12 col-lg-12 col-sm-12">
								<div class="card" >
									<div class="card-content collapse show">
										<div class="card-body" id="printableArea">
											
											<!-- 1st Tab Start Here -->
											<ul class="nav nav-pills" id="pills-tab" role="tablist">
												<li class="nav-item">
													<!--<a style="font-family:verdana" class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Transaction</a>-->
												</li>
												<!-- 1st Tab End Here -->
												
												<!-- 2nd Tab Start Here -->
												<!--<li class="nav-item">
													<a style="font-family:verdana" class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Loans</a>
												</li>-->
												<!-- 2nd Tab End Here -->
												
											</ul>
											<div id="printableArea">
												<!--<h4 class="mb-2">Transaction History</h4>-->
												
												<div class="tab-content" id="pills-tabContent" style="margin-top:-10px;">
													<h4 class="mb-2">Transaction History</h4>
													<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
														<!--table start here -->
														<table style="width:100%">
															<thead style="border-top-style: dotted;border-bottom-style: dotted;">
																<th>DATE</th>
																<th>VTY</th>
																<th>VNO</th>
																<th>PF Number</th>
																<th>Entry Code</th>
																<th>Entry Description</th>
																<th>Debit</th>
																<th>Credit</th>
															</thead>
															<tbody>
																<?php
																	$sr=1;
																	foreach ($txn_list as $item)
																	{
																	?>
																	<tr>
																		<td>
																			<?php 
																				// echo $item->date_time
																				$date_time =$item->date_time;
																				$date = date("d/m/Y",strtotime($date_time));
																				echo $date;
																			?>
																		</td>
																		<td><?= $item->entry_type?></td>
																		<td><?= $item->vno?></td>
																		<td><?= $item->pf_no?></td>
																		<td><?= $item->entrycode?></td>
																		<td><?= $item->entrydesc?></td>
																		<td>
																			<?php 
																				// $item->debit
																				if(!empty($item->debit))
																				{
																					echo number_format($item->debit, 2, '.', '');
																				}
																				else 
																				{
																					echo "0.00";
																				}
																			?>	
																		</td>
																		<td>
																			<?php 
																				// $item->credit
																				if(!empty($item->credit))
																				{
																					echo number_format($item->credit, 2, '.', '');
																				}
																				else 
																				{
																					echo "0.00";
																				}
																			?>
																		</td>
																		
																	</tr>
																	<?php 
																		$sr++;
																	}
																?>
																
																
															</tbody>
															
														</table>
														<!--table end here -->
													</div>
													
													<!-- 2nd tab code start here -->
													
													<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
														<button class="btn btn-success mb-2" data-toggle="modal" data-target="#AddModal">
														<i class="fa fa-plus-circle" aria-hidden="true"></i> Create Loan</button>
														<!-- 2nd table start here -->
														<table class="table table-striped table-bordered table-responsive" id="table_id2" >
															<thead>
																<tr role="row">
																	<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 160.828px;">Sr No</th>
																	
																	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">PF Number</th>
																	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Loan Amount</th>
																	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">No Of Months</th>
																	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">Interest(%)</th>
																	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">EMI Amount</th>
																	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Remark</th>
																	
																	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Created_at</th>
																	<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Edit</th>-->
																</tr>
															</thead>
															<tbody>
																<?php
																	$sr=1;
																	foreach ($loan as $item)
																	{
																	?>
																	<tr role="row" class="even">
																		<td><?= $sr;?></td>
																		<td><?= $item->pf_number;?></td>
																		<td>&#8377;<?= $item->loan_amount;?></td>
																		<td><?= $item->no_of_months;?></td>
																		<td><?= $item->interest;?></td>
																		<td>&#8377;<?= $item->emi_amount;?></td>
																		<td><?= $item->remark;?></td>
																		<td><span><?= $item->created_at;?></span></td>
																		<!--<td width="12%">
																			<a href="javascript:void(0);" class="action_btn mr_10" onclick="EditLoan('<?//= $item->id; ?>')"> <i class="fa fa-edit text-primary"></i> </a>
																		</td>-->
																	</tr>
																	<?php 
																		$sr++;
																	}
																?>
															</tbody>
														</table>
														<!--table end here -->
														
													</div>
													<!-- 2nd tab code end here -->
													
												</div>
												
											</div>
											
											
											<!-- End Tabs Here -->
											
											<!--end here-->
											
										</div>
										
										<!-- Print Button Start Here -->
										<button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" id="print_btn"><i class="fa fa-print noPrint"></i> Print</button>
										<!-- Print Button End Here -->
										
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
			</div>
		</div>
		<!-- END: Content-->
		<!--Modal Start-->
		<div class="modal fade" id="AddModal">
			<div class="modal-dialog">
				<div class="modal-content border-primary">
					<div class="modal-header bg-primary p-1">
						<h5 class="modal-title text-white">Add Loans</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?php echo base_url('Admin/Loans/Add'); ?>" method="post" enctype="multipart/form-data" id="addForm">
						<div class="modal-body p-1">
							<input type="hidden" value="<?= $list->id;?>" name="id"/>
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
							value="<?= $this->security->get_csrf_hash(); ?>" />
							
							<div class="form-group">
								<label class="col-form-label">PF Number <span class="text-danger"></span></label>
								<input type="text" class="form-control" value="<?= $list->pf_number ?>" name="pf_number" readonly>
							</div>
							
							<div class="form-group">
								<label class="col-form-label">Loan Amount <span class="text-danger"></span></label>
								<input type="text" class="form-control" placeholder="Loan Amount" name="loan_amount" id="new_amount" required>
							</div>
							<div class="form-group">
								<label class="col-form-label">Old Loan<span class="text-danger"></span></label>
								<input type="text" class="form-control" placeholder="Old Amount" value="<?= $list->loan ?>" id="old_amount" readonly>
							</div>
							<div class="form-group">
								<label class="col-form-label">Total Loan<span class="text-danger"></span></label>
								<input type="text" class="form-control" id="total_amount" name="loan" readonly placeholder="0">
							</div>
							
							<div class="form-group">
								<label class="col-form-label">No Of Months <span class="text-danger"></span></label>
								<input type="text" class="form-control" placeholder="Enter No Of Months" name="no_of_months" required>
								
							</div>
							<div class="form-group">
								<label class="col-form-label">Interest (%) <span class="text-danger"></span></label>
								<input type="text" class="form-control" placeholder="Enter Interest" name="interest"  required>
							</div>
							<div class="form-group">
								<label class="col-form-label">EMI Amount <span class="text-danger"></span></label>
								<input type="text" class="form-control" placeholder="Enter EMI Amount" name="emi_amount" required>
							</div>
							
							
							<div class="form-group">
								<label class="col-form-label">Remark<span class="text-danger"></span></label>
								<input type="text" class="form-control" placeholder="Enter Remark" name="remark" required>
							</div>
							<div id="output"></div>
							
						</div>
						<div class="modal-footer d-block p-1">
							<button type="submit" class="btn btn-primary" id="addBtn"> <i class="fa fa-check-circle"></i>  Submit <i class="fa fa-spin fa-spinner" id="addSpin" style="display:none;"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--Modal End-->
		
		
		<!--Modal Start Edit Modal-->
		<div class="modal fade" id="EditModal">
			<div class="modal-dialog">
				<div class="modal-content border-primary">
					<div class="modal-header p-1" style="background-color:#4da7ff">
						<h5 class="modal-title text-white">Edit Loans</h5>
						<button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form action="<?php echo base_url('Admin/Loans/Update'); ?>" method="post" enctype="multipart/form-data" id="updateForm">
						<div class="modal-body">
							
						</div>
						<div class="modal-footer d-block p-1">
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
							<button type="submit" class="btn" style="background-color:#4da7ff;color:white" id="updateBtn"> <i class="fa fa-check-circle"></i> Update <i class="fa fa-spin fa-spinner" id="updateSpin" style="display:none;"></i></button>
						</div>
					</form>
					
				</div>
			</div>
		</div>
		<!--Modal Edit Modal End-->
		
		<!-- BEGIN: Footer-->
		<?php require APPPATH . 'views/Auth/Footer.php'; ?>
		<?php require APPPATH . 'views/Auth/JsLinks.php'; ?>
		
	</body>
	<!-- END: Body-->
	<script>
		$(document).ready(function(){
			$("#new_amount").keyup(function(){
				var num1 = $("#old_amount").val();
				var num2 = $("#new_amount").val();
				var answer = parseInt(num1) + parseInt(num2);
				if(!isNaN(answer)) {
					$("#total_amount").val(answer);
				}
			});
		});
	</script>
	<script>
		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}	
	</script>
</html>		