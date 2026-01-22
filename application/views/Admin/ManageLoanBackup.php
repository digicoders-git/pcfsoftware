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
						<h4 class="content-header-title float-left pr-1 mb-0"><?= $this->data->pageTitle; ?></h4>
						<h5><a href="<?= base_url($this->data->controller); ?>/Dashboard"><?= $this->data->title; ?></a> / <?= $this->data->pageTitle; ?></h5>
					</div></div>
					<!--extra added here-->
					
					<div class="content-body"><!-- Stats -->
						
						<div class="row match-height">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title" id="basic-layout-form-center">All LOAN</h4><hr>
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
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Loan Account Balance</th>
														
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Ledger</th>
														<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Edit</th>-->
														
														
													</tr>
												</thead>
												<tbody>
													<?php
														$total_loan = 0;
														$srno = 1;
														foreach ($list as $item)
														{
															$total_loan+=$item->loan;
															if($item->loan>0)
															{
															?>
															<tr role="row" class="even">
																<td width="10%"><?= $srno; ?></td>
																<td width="20%"><?= $item->pf_number; ?></td>
																<td ><?= $item->name; ?></td>
																<td width="16%"><span>&#8377;</span><?= $item->loan; ?></td>
																<td width="12%" >
																	<a href="<?= base_url('Admin/UserFullDeatils/').$item->id ?>" class="btn btn-dark btn-sm" >View Ledger</a>
																</td>
															<!--<td width="12%" >
																<a href="javascript:void(0);" class="action_btn mr_10" onclick="Edit('<?//= $item->id; ?>')"> <i class="fa fa-edit text-primary"></i> </a>
															</td>-->
															</tr>
															<?php
															}
														?>
														
														<?php $srno++;
														} ?>
												</tbody>
												
												<!--2nd Tbody Start Here-->
												<tbody>	
													<tr>
														<th></th>	
														<th></th>	
														<th></th>	
														<th>Total Loan</th>	
														<th></th>		
													</tr>
													<tr>
														<td></td>	
														<td></td>	
														<td></td>	
														<td><?= $total_loan; ?></td>		
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
		
		
		<!-- BEGIN: Footer-->
		<?php require APPPATH . 'views/Auth/Footer.php'; ?>
		<?php require APPPATH . 'views/Auth/JsLinks.php'; ?>
		
	</body>
	<!-- END: Body-->
	
</html>