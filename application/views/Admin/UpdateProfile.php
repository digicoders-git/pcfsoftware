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
									</div>
								</center>
							</div>
						</div>
						<!--2nd end here-->
						
						<div class="col-md-6">
							<div class="card" style="max-height:650px;">
								<div class="card-header">
									<h4 class="card-title" id="basic-layout-form-center">Update Profile</h4><hr>
									<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
									
								</div>
								<div class="card-content collapse show" style="margin-top:-40px;">
									<div class="card-body">
										
										<form action="<?php echo base_url($this->data->controller . '/' . $this->data->method . '/UpdateProfile'); ?>" method="post" id="addForm">
											<input type="hidden" class="form-control" name="id" placeholder="ID" required value="<?php echo $profile->id; ?>">
											<div class="row justify-content-md-center">
												<div class="col-md-12">
													<div class="form-body">
														<div class="form-group">
															<label>Name<span class="text-danger">*</span></label>
															<input type="text" class="form-control text-capitalize" name="name" placeholder="Name" required value="<?php echo $profile->name; ?>">
															<?php echo form_error("name", "<p class='text-danger' >", "</p>"); ?>
														</div>
														
														<div class="form-group">
															<label>Email Address<span class="text-danger">*</span></label>
															<input type="email" class="form-control" name="email" placeholder="Email Address" required value="<?php echo $profile->email; ?>">
															<?php echo form_error("email", "<p class='text-danger'>", "</p>"); ?>
														</div>
														
														<div class="form-group">
															<label>Mobile No<span class="text-danger">*</span></label>
															<input type="number" class="form-control" name="mobile" placeholder="Mobile No" required maxlength="10" minlength="10" value="<?php echo $profile->mobile; ?>">
															<?php echo form_error("mobile", "<p class='text-danger' >", "</p>"); ?>
														</div>
														
														<!--<div class="form-group">
															<label>Profile Photo<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control dropify" data-height="100" name="icon" Title="Choose Icon" accept="image/jpg, image/png, image/jpeg, image/gif" data-default-file="<?php //echo base_url('uploads/profile_pic/' . $profile->icon . '') ?>">
                                    <?php //echo form_error("icon", "<p class='text-danger' >", "</p>"); ?>
														</div>-->
														
													</div>
												</div>
											</div>
											
											<div class="form-actions center">
												<button type="submit" class="btn btn-primary" id="addBtn">
													<i class="fa fa-check-square-o"></i> Update Profile
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