<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
	<!-- BEGIN: Head-->
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<title><?= $this->data->appName; ?></title>
		<link rel="apple-touch-icon" href="<?= base_url($this->data->appTempletePath); ?>app-assets/images/ico/pcflogo.png">
		<link rel="shortcut icon" type="image/x-icon" href="<?= base_url($this->data->appTempletePath); ?>app-assets/images/ico/pcflogo.png">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		
		<!-- BEGIN: Vendor CSS-->
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/vendors/css/vendors.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/vendors/css/forms/icheck/icheck.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/vendors/css/forms/icheck/custom.css">
		<!-- END: Vendor CSS-->
		
		<!-- BEGIN: Theme CSS-->
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/css/bootstrap-extended.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/css/colors.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/css/components.min.css">
		<!-- END: Theme CSS-->
		
		
		<!-- BEGIN: Page CSS-->
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/css/core/colors/palette-gradient.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>app-assets/css/pages/login-register.min.css">
		<!-- END: Page CSS-->
		
		<!-- BEGIN: Custom CSS-->
		<link rel="stylesheet" type="text/css" href="<?= base_url($this->data->appTempletePath); ?>css/style.css">
		<!-- END: Custom CSS-->
		
	</head>
	<!-- END: Head-->
	
	<!-- BEGIN: Body-->
	
	<body class="vertical-layout vertical-menu-modern 1-column bg-secondary blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
		<!-- BEGIN: Content-->
		<div class="app-content content">
			<div class="content-overlay"></div>
			<div class="content-wrapper">
				<div class="content-header row">
				</div>
				<div class="content-body">
					<section class="row flexbox-container">
						<div class="col-12 d-flex align-items-center justify-content-center">
							<div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
								<div class="card border-grey border-lighten-3 px-1 py-1 m-0">
									<div class="card-header border-0">
										<div class="card-title text-center">
											<h4>PCF Employees Cooperative Society Ltd.</h4>
										</div>
										<h5 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Admin Login</span></h5>
									</div>
									<div class="card-content">
										<div class="card-body">
											<form class="form-horizontal" method="POST" action="<?= base_url($this->data->controller . '/Authentication/Login'); ?>" id="addForm">
												<input type="hidden" name="role_id" value="<?= $this->data->role_id; ?>" />
												<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
												
												<label for="username">Username <span class="text-danger">*</span></label>
												<fieldset class="form-group position-relative has-icon-left">
													<input type="text" class="form-control" id="username" name="username" placeholder="Username">
													<?php echo form_error("username", "<p class='text-danger' >", "</p>"); ?>
													<div class="form-control-position">
														<i class="fa fa-user"></i>
													</div>
												</fieldset>
												<label for="password">Password <span class="text-danger">*</span></label>
												<fieldset class="form-group position-relative has-icon-left">
													<input type="password" class="form-control" id="password" name="password" placeholder="Password">
													<?php echo form_error("password", "<p class='text-danger'>", "</p>"); ?>
													<div class="form-control-position">
														<i class="fa fa-key"></i>
													</div>
												</fieldset>
												
												<button type="submit" class="btn btn-outline-primary mb-4 mt-4 btn-block" id="addBtn"><i class="fa fa-lock"></i> Login <i class="fa fa-spinner fa-spin" id="addSpin" style="display:none;"></i></button>
											</form>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
		<!-- END: Content-->
		
		<?php require APPPATH . 'views/Auth/JsLinks.php'; ?>
		
	</body>
	<!-- END: Body-->
	
</html>
