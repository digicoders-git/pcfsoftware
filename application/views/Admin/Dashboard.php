<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
	
	<head>
		<?php require APPPATH . 'views/Auth/CssLinks.php'; ?>
		<style>
			* .dash_box h5{
			font-family:verdana;
			font-size:11px;
			}
			
			// * .dash_box h5{
			// max-width: 120px;
			// overflow:hidden; 
			// white-space:nowrap; 
			// text-overflow: ellipsis;
			// }
			
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
						<h5><a href="<?= base_url($this->data->controller); ?>/Dashboard"><?= $this->data->title; ?></a> / <?= $this->data->pageTitle; ?></h5>
					</div></div>
					<!--extra added here-->
					
					<div class="content-body"><!-- Stats -->
						<div class="row">
							
							<div class="col-xl-3 col-lg-6 col-12">
								<a href="<?= base_url($this->data->controller); ?>/AllMembers">
									<div class="card">
										<div class="card-content">
											<div class="media align-items-stretch">
												<div class="p-2 text-center bg-danger bg-darken-2">
													<!--<i class="icon-user font-large-2 white"></i>-->
													<i class="fa-solid fa-user font-large-2 white"></i>
												</div>
												<div class="p-2 bg-gradient-x-danger white media-body dash_box">
													<h5>Total Members</h5>
													<h5 class="text-bold-400 mb-0"><i class="fa-solid fa-arrow-up"></i> <?= $totalmembers;?></h5>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							
							<div class="col-xl-3 col-lg-6 col-12">
								<a href="<?= base_url($this->data->controller); ?>/ActiveMembers">
								<div class="card">
								<div class="card-content">
								<div class="media align-items-stretch">
								<div class="p-2 text-center bg-warning bg-darken-2">
								<i class="fa-solid fa-person-walking font-large-2 white"></i>
								</div>
								<div class="p-2 bg-gradient-x-warning white media-body dash_box">
								<h5>Loan Credit</h5>
								<h5 class="text-bold-400 mb-0"><i class="fa-solid fa-arrow-up"></i> <?= $loan_credit;?></h5>
								</div>
								</div>
								</div>
								</div>
								</a>
							</div>
							<div class="col-xl-3 col-lg-6 col-12">
								<a href="<?= base_url($this->data->controller); ?>/InactiveMembers">
									<div class="card">
										<div class="card-content">
											<div class="media align-items-stretch">
												<div class="p-2 text-center bg-success bg-darken-2">
													<!--<i class="fa-solid fa-user font-large-2 white"></i>-->
													<i class="fa-solid fa-person-walking-with-cane font-large-2 white"></i>
												</div>
												<div class="p-2 bg-gradient-x-success white media-body dash_box">
													<h5>Retired Members</h5>
													<h5 class="text-bold-400 mb-0"><i class="fa-solid fa-arrow-up"></i> <?= $inactivemembers;?></h5>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="col-xl-3 col-lg-6 col-12">
								<a href="<?= base_url($this->data->controller); ?>/ManageSavings">
									<div class="card">
										<div class="card-content">
											<div class="media align-items-stretch">
												<div class="p-2 text-center bg-primary bg-darken-2">
													<!-- <i class="icon-camera font-large-2 white"></i>-->
													<i class="fa-sharp fa-solid fa-piggy-bank font-large-2 white"></i>
												</div>
												<div class="p-2 bg-gradient-x-primary white media-body dash_box">
													<h5>Total Saving Money</h5>
													<h5 class="text-bold-400 mb-0"><i class="fa-solid fa-arrow-up"></i> <?= $totalsavings;?></h5>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="col-xl-3 col-lg-6 col-12">
								<a href="<?= base_url($this->data->controller); ?>/ManageLoan">
									<div class="card">
										<div class="card-content">
											<div class="media align-items-stretch">
												<div class="p-2 text-center bg-info bg-darken-2">
													<!-- <i class="icon-camera font-large-2 white"></i>-->
													<i class="fa-solid fa-landmark font-large-2 white"></i>
												</div>
												<div class="p-2 bg-gradient-x-info white media-body dash_box">
													<h5>Total Loan Amount</h5>
													<h5 class="text-bold-400 mb-0"><i class="fa-solid fa-arrow-up"></i> <?= $totalloan;?></h5>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="col-xl-3 col-lg-6 col-12">
								<a href="<?= base_url($this->data->controller); ?>/ManageShares">
									<div class="card">
										<div class="card-content">
											<div class="media align-items-stretch">
												<div class="p-2 text-center bg-secondary bg-darken-2">
													<!--<i class="icon-camera font-large-2 white"></i>-->
													<i class="fa-solid fa-money-bill-trend-up font-large-2 white"></i>
												</div>
												<div class="p-2 bg-gradient-x-secondary white media-body dash_box">
													<h5>Total Shares</h5>
													<h5 class="text-bold-400 mb-0"><i class="fa-solid fa-arrow-up"></i> <?= $totalshares;?></h5>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							
							<div class="col-xl-3 col-lg-6 col-12">
								<a href="<?= base_url($this->data->controller); ?>/ThisMonthEntries">
									<div class="card">
										<div class="card-content">
											<div class="media align-items-stretch">
												<div class="p-2 text-center bg-danger bg-darken-2">
													<!--<i class="icon-camera font-large-2 white"></i>-->
													<i class="fa-solid fa-person-through-window font-large-2 white"></i>
												</div>
												<div class="p-2 bg-gradient-x-danger white media-body dash_box">
													<h5>This Month Entries</h5>
													<h5 class="text-bold-400 mb-0"><i class="fa-solid fa-arrow-up"></i> 20</h5>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="col-xl-3 col-lg-6 col-12">
								<a href="<?= base_url($this->data->controller); ?>/AllEntries">
									<div class="card">
										<div class="card-content">
											<div class="media align-items-stretch">
												<div class="p-2 text-center bg-warning bg-darken-2">
													<i class="fa-solid fa-person-through-window font-large-2 white"></i>
												</div>
												<div class="p-2 bg-gradient-x-warning white media-body dash_box">
													<h5>All Entries</h5>
													<h5 class="text-bold-400 mb-0"><i class="fa-solid fa-arrow-up"></i> 40</h5>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="col-xl-3 col-lg-6 col-12">
								<a href="<?= base_url($this->data->controller); ?>/TodayEntries">
									<div class="card">
										<div class="card-content">
											<div class="media align-items-stretch">
												<div class="p-2 text-center bg-success bg-darken-2">
													<i class="fa-solid fa-person-through-window font-large-2 white"></i>
												</div>
												<div class="p-2 bg-gradient-x-success white media-body dash_box">
													<h5>Today Entries</h5>
													<h5 class="text-bold-400 mb-0"><i class="fa-solid fa-arrow-up"></i> 10</h5>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							
						</div>
						<!--/ Stats -->
						
						<!--/ Basic Horizontal Timeline -->
						
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