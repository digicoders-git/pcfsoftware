<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
	
	<head>
		<?php require APPPATH . 'views/Auth/CssLinks.php'; ?>
		
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
						<section id="configuration">
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-header">
											
											
											<h4 class="card-title">
												<button type="button" class="btn" style="background-color:#4da7ff;color:white" data-bs-toggle="modal" data-bs-target="#AddModal">
													<i class="fa fa-plus-circle " aria-hidden="true"></i> Add <?= $this->data->key; ?>
												</button></h4>
												<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
												
										</div>
										<div class="card-content collapse show">
											<div class="card-body card-dashboard">
												<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div></div>
													<div class="row">
														<div class="col-sm-12">
														<table class="table table-striped table-bordered table-responsive" id="table_id" >
															<thead>
																<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 160.828px;">Sr No</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">Pf Number</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 50px;">Grade</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 110.844px;">Desigination</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Mobile</th>
																	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Action</th>
																	
																</tr>
															</thead>
															<tbody>
																<?php
																	$srno = 1;
																	foreach ($list as $item)
																	{
																	?>
																	<tr role="row" class="even">
																		<td><?= $srno; ?></td>
																		<td><?= $item->pf_number; ?></td>
																		<td width="16%"><?= $item->name; ?></td>
																		<td width="12%"><?= $item->grade; ?></td>
																		<td><?= $item->desigination; ?></td>
																		<td><?= $item->mobile; ?></td>
																		<td width="12%" >
																			<a href="javascript:void(0);" class="action_btn mr_10" onclick="Edit('<?= $item->id; ?>')"> <i class="fa fa-edit text-primary"></i> </a>
																			
																			<a href="javascript:void(0);" class="action_btn1" onclick="return ActiveInactiveMembers(this,'<?= $this->data->table; ?>','id','<?= $item->id; ?>')"> <i class="fa fa-trash text-danger"></i> </a>
																			
																		</td>
																	</tr>
																	<?php $srno++;
																	} ?>
															</tbody>
															
														</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
									<!--/ Stats -->
									
									<!--/ Basic Horizontal Timeline -->
									
								</div>
							</div>
						</div>
						<!-- END: Content-->
						<!-- start modal here -->
						<div class="modal fade" id="AddModal">
							<div class="modal-dialog">
								<div class="modal-content border-primary">
									<div class="modal-header p-1" style="background-color:#4da7ff">
										<h5 class="modal-title text-white">Add <?= $this->data->key; ?></h5>
										<button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="<?php echo base_url($this->data->controller . '/' . $this->data->method . '/Add'); ?>" method="post" id="addForm">
										
										<div class="modal-body">
											<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
											
											<div class="form-group">
												<label class="col-form-label">Pf Number <span class="text-danger">*</span></label>
												<input type="text" class="form-control text-capitalize" name="pf_number" placeholder="Pf Number" required>
												<?php echo form_error("pf_number", "<p class='text-danger' >", "</p>"); ?>
											</div>
											
											<div class="form-group">
												<label class="col-form-label">User Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control text-capitalize" name="name" placeholder="User Name" required>
												<?php echo form_error("name", "<p class='text-danger' >", "</p>"); ?>
											</div>
											
											<div class="form-group">
												<label class="col-form-label">Grade <span class="text-danger">*</span></label>
												<select id="disabledSelect" class="form-select form-control" name="grade">
													<option selected disabled>Grade Select Here</option>
													<option>Grade A</option>
													<option>Grade B</option>
													<option>Grade C</option>
												</select>
												<?php echo form_error("grade", "<p class='text-danger' >", "</p>"); ?>
											</div>
											
											<div class="form-group">
												<label class="col-form-label">Desigination<span class="text-danger">*</span></label>
												<input type="text" class="form-control text-capitalize" name="desigination" placeholder="Desigination" required>
												<?php echo form_error("desigination", "<p class='text-danger' >", "</p>"); ?>
											</div>
											
											<div class="form-group">
												<label class="col-form-label">Mobile<span class="text-danger">*</span></label>
												<input type="text" class="form-control text-capitalize" name="mobile" placeholder="User Mobile" required minlength="10" maxlength="10">
												<?php echo form_error("mobile", "<p class='text-danger' >", "</p>"); ?>
											</div>
											
										</div>
										<div class="modal-footer d-block p-2">
											<button type="submit" class="btn" style="background-color:#4da7ff;color:white" id="addBtn"> <i class="fa fa-check-circle"></i> Submit <i class="fa fa-spin fa-spinner" id="addSpin" style="display:none;"></i></button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end modal here -->
						
						<!--Modal Start Edit Modal-->
						<div class="modal fade" id="EditModal">
							<div class="modal-dialog">
								<div class="modal-content border-primary">
									<div class="modal-header p-1" style="background-color:#4da7ff">
										<h5 class="modal-title text-white">Edit <?= $this->data->key; ?></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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