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
									<h5>THIS MONTH ENTRIES</h5><hr>
									
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body">
											
											<!--table start here -->
											<table class="table table-striped table-bordered table-responsive" id="table_id" >
												<thead>
													<tr role="row">
														<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 160.828px;">Sr No</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">Voucher No</th>
														
														
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">PF Number</th>
														
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">Entry Code</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">Entry Description</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Debit</th>
														
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Credit</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">DateTime</th>
														
													</tr>
												</thead>
												<tbody>
													<?php
													// echo "<pre>";
													// print_r($list);
													// die();
													
														$sr=1;
														foreach ($list as $item)
														{
														?>
														<tr role="row" class="even">
															<td><?= $sr;?></td>
															<td><?= $item->vno?></td>
															<td><?= $item->pf_no?></td>
															<td><?= $item->entrycode?></td>
															<td><?= $item->entrydesc?></td>
															<td><?= $item->debit?></td>
															<td><?= $item->credit?></td>
															<td><?= $item->date_time?></td>
														</tr>
														<?php 
															$sr++;
														}
													?>
													
												</tbody>
												
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