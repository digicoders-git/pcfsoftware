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
							<div class="card">
								<center>
									<div class="card-content collapse show" >
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
											<button type="button" class="btn btn-outline-danger btn-md mr-1" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out"></i> Logout</button>
											
											<!--<a type="button" class="btn btn-outline-danger btn-md mr-1" href="<?= base_url($this->data->controller); ?>/AccountSettings/Logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>-->
										</div>
									</div>
								</center>
							</div>
						</div>
						<!--2nd end here-->
						
						<div class="col-md-6">
							<div class="card" style="max-height:470px;">
								<div class="card-header">
									<h4 class="card-title" id="basic-layout-form-center">Change Password</h4><hr>
									<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
									
								</div>
								<div class="card-content collapse show" style="margin-top:-40px;">
									<div class="card-body">
										
										<form action="<?php echo base_url($this->data->controller . '/' . $this->data->method . '/ChangePassword'); ?>" method="post" id="addForm">
											<div class="row justify-content-md-center">
												<div class="col-md-12">
													<div class="form-body">
														<div class="form-group">
															<label for="eventInput1">Current Password</label>
															<input id="opass" class="form-control" placeholder="Current Password"type="password" name="opass" placeholder="Current Password" data-parsley-minlength="6" required>
															<?php //echo form_error("opass", "<p class='text-danger' >", "</p>"); ?>
														</div>
														
														<div class="form-group">
															<label for="eventInput2">New Password</label>
															<input  class="form-control" type="password" id="npass" name="npass" placeholder="New Password" required>
															<?php  //echo form_error("npass", "<p class='text-danger'>", "</p>"); ?>
														</div>
														
														<div class="form-group">
															<label for="eventInput3">Confirm Password</label>
															<input type="password" name="cpass" id="cpass " class="form-control" placeholder="Confirm Password" data-parsley-minlength="6"  required>
															
															<?php //data-parsley-equalTo-message="New and Confirm Password are not match."secho form_error("cpass", "<p class='text-danger' >", "</p>"); ?>
														</div>
													</div>
												</div>
											</div>
											
											<div class="form-actions center">
												<button type="submit" class="btn btn-primary mt-2" id="addBtn">
													<i class="fa fa-check-square-o"></i> Change Password
												<i class="fa fa-spin fa-spinner" id="addSpin" style="display:none;"></i></button>
												
											</div>
										</form>	
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