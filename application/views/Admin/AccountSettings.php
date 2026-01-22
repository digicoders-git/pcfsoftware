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
					
					<div class="row match-height">
						
						<!--2nd start here-->
						<div class="col-md-6">
							<div class="card" style="max-height:610px">
								<center>
									<div class="card-content collapse show">
										<div class="card-body">
											<!--<img src="<?//= base_url(); ?>uploads/profile_pic/<?//= $profile->icon; ?>" class="rounded-circle mt-2" height="80px" width="80px" alt="Card image">-->
											
										</div>
										<div class="card-body">
											<h4 class="card-title" style="font-family:verdana"><?= $profile->name; ?></h4>
											<h5 class="card-title" style="font-family:verdana">(<?= $profile->refcode; ?>)</h5>
											<h6 class="card-subtitle" style="font-family:verdana"><?= $profile->mobile; ?></h6>
											<ul class="list-inline list-inline-pipe">
												<li><?= $profile->email; ?></li><br>
											</ul>
											<ul class="list-inline list-inline-pipe">
												<li>Visit Count </li>
												<li> <?= $profile->visit_count; ?></li>
											</ul>
											<ul class="list-inline list-inline-pipe">
												<li>Login Time </li>
												<li> <?= $profile->login_at; ?></li>
											</ul>
											<ul class="list-inline list-inline-pipe">
												<li>Logout Time </li>
												<li> <?= $profile->logout_at; ?></li>
											</ul>
											<ul class="list-inline list-inline-pipe">
												<li>Verified Date </li>
												<li> <?= $profile->verified_at; ?></li>
											</ul>
											<ul class="list-inline list-inline-pipe">
												<li>Register Date </li>
												<li> <?= $profile->created_at; ?></li>
											</ul>
										</div>
										<div class="btn-group" role="group" aria-label="Profile example">
											<?php
												if ($profile->is_status == 'true')
												{ ?>
												<button type="button" class="btn btn-float box-shadow-0 btn-info"><span class="ladda-label"><span>Activated</span></span><span class="ladda-spinner"></span></button>
												<?php }
												else
												{ ?>
												<button type="button" class="btn btn-float box-shadow-0 btn-danger"><span class="ladda-label"><span>Deactivated</span></span><span class="ladda-spinner"></span></button>
												<?php }
											?>
											<?php
												if ($profile->is_verified == 'true')
												{ ?>
												<button type="button" class="btn btn-float box-shadow-0 btn-outline-info"><span class="ladda-label"><span>Verified</span></span><span class="ladda-spinner"></span></button>
												<?php }
												else
												{ ?>
												<button type="button" class="btn btn-float box-shadow-0 btn-outline-danger"><span class="ladda-label"><span>Unverified</span></span><span class="ladda-spinner"></span></button>
												<?php }
											?>
										</div>
										<div class="card-body">
											<!-- <button type="button" class="btn btn-outline-danger btn-md mr-1" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out"></i> Logout</button> -->
											<a type="button" class="btn btn-outline-danger btn-md mr-1" href="<?= base_url($this->data->controller); ?>/AccountSettings/Logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
											
											<a type="button" class="btn btn-outline-primary btn-md mr-1" href="<?= base_url($this->data->controller); ?>/AccountSettings/UpdateProfile"><i class="fa fa-sign-out" aria-hidden="true"></i> Update Profile</a>
										</div>
									</div>
								</center>
							</div>
						</div>
						<!--2nd end here-->
						
						<div class="col-md-6">
							<section id="configuration">
								<div class="row">
									<div class="col-12">
										<div class="card" >
											<div class="card-header">
												<h4 class="card-title">
												LOGIN ACTIVITIES</h4>
												<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
												
											</div>
											<div class="card-content collapse show">
												<div class="card-body card-dashboard">
													<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div></div>
														<div class="row">
															<div class="col-sm-12">
															<table class="table table-striped  table-bordered table-responsive" id="table_id">
																<thead>
																	<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 160.828px;">#</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">UserID</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Username</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 50px;">IP</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 110.844px;">Device</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">OS</th>
																		<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Browser</th>
																		
																		<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Computer</th>
																		<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">MAC</th>
																		<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Date</th>
																		
																	</tr>
																</thead>
																<tbody>
																	<?php $srno = 1;
																		foreach ($activitiesList as $item)
																		{ ?>
																		<tr>
																			<td><?= $srno; ?></td>
																			<td><?= $item->user->refcode; ?></td>
																			<td><?= $item->user->name; ?></td>
																			<td><?= $item->ip; ?></td>
																			<td><?= $item->device; ?></td>
																			<td><?= $item->os; ?></td>
																			<td><?= $item->browser; ?></td>
																			<td><?= $item->computer_name; ?></td>
																			<td><?= $item->mac; ?></td>
																			<td><?= $item->created_at; ?></td>
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