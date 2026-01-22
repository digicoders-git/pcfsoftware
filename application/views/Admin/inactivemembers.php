<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
	
	<head>
		<?php require APPPATH . 'views/Auth/CssLinks.php'; ?>
		<style>
			h4,h5 {
			font-family:verdana;
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
			<div class="content-wrapper">
				<div class="content-header row">
				</div>
				
				<!--extra added here-->
				<div class="row mb-2">
					<div class="col-12">
						<!--<h4 class="content-header-title float-left pr-1 mb-0"><?//= $this->data->pageTitle; ?></h4>-->
						<h5><a href="<?= base_url($this->data->controller); ?>/Dashboard"><?= $this->data->title; ?></a> / <span>Retired Members</span></h5>
					</div></div>
					<!--extra added here-->
					
					<div class="content-body"><!-- Stats -->
						
						<div class="row match-height">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title" id="basic-layout-form-center">Retired Members</h4><hr>
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body">
											
											
											<!--table start here -->
											<table class="table table-striped table-bordered table-responsive" id="table_id" >
												<thead>
													<tr role="row">
														<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 160.828px;">Sr No</th>
														
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">PF Number</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Member Name</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">PerMonthSavings</th>
														
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Savings</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Loan</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Shares</th>
														
														<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 160.828px;">Status</th>
														
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Ledger</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Edit</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$total_savings =0;
														$total_loan = 0;
														$total_shares = 0;
														$srno = 1;
														foreach ($list as $item)
														{
														$total_savings+=$item->savings;
														$total_loan+=$item->loan;
														$total_shares+=$item->shares;
														?>
														<tr role="row" class="even">
															<td><?= $srno; ?></td>
															<td><?= $item->pf_number; ?></td>
															<td width="16%"><?= $item->name; ?></td>
															<td width="12%"><span>&#8377;</span><?= $item->pm_saving; ?></td>
															<td width="12%"><span>&#8377;</span><?= $item->savings; ?></td>
															<td width="12%"><span>&#8377;</span><?= $item->loan; ?></td>
															<td width="12%"><span>⬤</span> <?= $item->shares; ?></td>
															<td>
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="checkbox" class="custom-control-input"  onchange="return Status(this,'<?= $this->data->table; ?>','id','<?= $item->id; ?>','is_status')"  <?php if($item->is_status == 'true') { echo 'checked'; } ?> id="switch-id<?=$srno;?>">
																	<label class="custom-control-label mr-1" for="switch-id<?=$srno;?>"></label>
																</div>
															</td>
															<td width="12%" >
																<a href="<?= base_url('Admin/UserFullDeatils/').$item->id ?>" class="btn btn-dark btn-sm" >View Ledger</a>
															</td>
															<td width="12%" >
																<a href="javascript:void(0);" class="action_btn mr_10" onclick="Edit('<?= $item->id; ?>')"> <i class="fa fa-edit text-primary"></i> </a>
																<!--<a href="javascript:void(0);" class="action_btn1" onclick="return ActiveInactiveMembers(this,'<?//= $this->data->table; ?>','id','<?//= $item->id; ?>')"> <i class="fa fa-trash text-danger"></i> </a>-->
																
															</td>
															
														</tr>
														<?php $srno++;
														} ?>
												</tbody>
												
												<!--2nd Tbody Start Here-->
												<tbody>	
													<tr>
														<th width="12%">Total Members</th>	
														<th></th>	
														<th></th>	
														<th></th>	
														<th>Total Savings</th>	
														<th>Total Loan</th>	
														<th>Total Shares</th>	
														<th></th>	
														<th></th>	
														<th></th>
													</tr>
													<?php 
													$rows = $this->db->get_where('members',array('is_status'=>'false'));
													$data = $rows->num_rows();
													?>
													<tr>
														<td><?= $data; ?></td>	
														<td></td>	
														<td></td>	
														<td></td>	
														<td><?= $total_savings; ?></td>	
														<td><?= $total_loan; ?></td>	
														<td><?= $total_shares; ?></td>	
														<td></td>	
														<td></td>	
														<td></td>	
													</tr>	
												</tbody>
												<!--2nd Tbody End Here-->
												
											</table>
											<!--table end here -->
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
		<!-- END: Content-->
		<!--Modal Start Edit Modal-->
		<div class="modal fade" id="EditModal">
			<div class="modal-dialog">
				<div class="modal-content border-primary">
					<div class="modal-header p-1" style="background-color:#4da7ff">
						<h5 class="modal-title text-white">Edit <?= $this->data->key; ?></h5>
						<button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form action="<?php echo base_url($this->data->controller . '/' . $this->data->method . '/Update'); ?>" method="post" enctype="multipart/form-data" id="updateForm">
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
	
</html>