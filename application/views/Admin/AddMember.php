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
						<h5><a href="<?= base_url($this->data->controller); ?>/Dashboard"><?= $this->data->title; ?></a> / <?= $this->data->pageTitle; ?></h5>
					</div></div>
					<!--extra added here-->
					
					<div class="content-body"><!-- Stats -->
						
						<div class="row match-height">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title" id="basic-layout-form-center">Add Member</h4><hr>
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body">
											<form action="<?php echo base_url($this->data->controller . '/' . $this->data->method . '/Add'); ?>" method="post" id="addForm">
												<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
												<div class="row justify-content-md-center">
													<div class="col-md-12">
														<div class="form-row">
															
															<div class="col-md-4 col-sm-4 mb-1">
																<label class="col-form-label"><b>PF Number(unique</b>) <span class="text-danger">*</span></label>
																<input style="border:1px solid black" type="text" class="form-control" name="pf_number" minlength="6" maxlength="6" placeholder="PF Number" required>
															</div>
															
															<div class="col-md-4 col-sm-4 mb-1">
																<label class="col-form-label"><b>Member Name</b>  <span class="text-danger">*</span></label>
																<input style="border:1px solid black" type="text" class="form-control" name="name" placeholder="Member Name">
															</div>
															<div class="col-md-4 col-sm-4 mb-1">
																<label class="col-form-label"><b>Per Month Savings</b><span class="text-danger">*</span></label>
																<input style="border:1px solid black" type="text" class="form-control" name="pm_saving" placeholder="Per Month Savings" required>
															</div>
															
															
															<div class="col-md-4 col-sm-4 mb-1">
																<label class="col-form-label"><b>Savings</b><span class="text-danger">*</span></label>
																<input style="border:1px solid black" type="text" class="form-control" value="0" id="savings" name="savings" placeholder="Savings">
															</div>
															
															<div class="col-md-4 col-sm-4 mb-1">
																<label class="col-form-label"><b>Loan Debit</b><span class="text-danger">*</span></label>
																<input style="border:1px solid black" type="text" class="form-control entry_debit"  id="loan" name="loan" placeholder="Loan Debit" onkeyup="debitLogic(this)" value="0">
															</div>
															
															<div class="col-md-4 col-sm-4 mb-1">
																<label class="col-form-label"><b>Loan Credit</b><span class="text-danger">*</span></label>
																<input style="border:1px solid black" type="text" class="form-control entry_credit"  id="loan_credit" name="loan_credit" placeholder="Loan Credit" onkeyup="creditLogic(this)" value="0">
															</div>
															
															<div class="col-md-4 col-sm-4 mb-1">
																<label class="col-form-label"><b>Shares</b><span class="text-danger">*</span></label>
																<input style="border:1px solid black" type="text" class="form-control" value="0" id="shares" name="shares" placeholder="Shares">
															</div>
															
															<div class="col-md-4 col-sm-4 mt-4">
																<div class="form-check">
																	<input style="border:1px solid black" class="form-check-input" type="checkbox" name="ho_status" value="true" id="defaultCheck1">
																	<label class="form-check-label" for="defaultCheck1">
																		<b>HO Status</b>
																	</label>
																</div>
																
															</div>
														</div>
													</div>
												</div>
												
												<div class="form-actions center">
													<button type="submit" class="btn" style="background-color:#4da7ff;color:white" id="addBtn"> <i class="fa fa-check-circle"></i> Submit <i class="fa fa-spin fa-spinner" id="addSpin" style="display:none;"></i></button>
													
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
	<script>
		$(document).ready(function(){
			$("#savings").click(function(){
				$("#savings").val("");
			});
			$("#loan").click(function(){
				$("#loan").val("");
			});
			$("#loan_credit").click(function(){
				$("#loan_credit").val("");
			});
			$("#shares").click(function(){
				$("#shares").val("");
			});
		});
		
		
		function debitLogic(e) {
			
			if($(e).val() == "") {
				$(e).parent().next().find("input").attr("readonly",false);
				} else {
				$(e).parent().next().find("input").attr("readonly",true);
			}
			
			var debit_total=0;
			$(".entry_debit").each(function(){
				var debit_amt=$(this).val();
				if(debit_amt.length>0) {
					if(!isNaN(debit_amt)) {
						debit_amt=parseInt(debit_amt);
						debit_total=debit_total+debit_amt;
					}
				}
			});
			
			
		}
		
		function creditLogic(e) {
			
			if($(e).val() == "") {
				$(e).parent().prev().find("input").attr("readonly",false);
				} else {
				$(e).parent().prev().find("input").attr("readonly",true);
			}
			
			var credit_total=0;
			$(".entry_credit").each(function(){
				var credit_amt=$(this).val();
				if(credit_amt.length>0) {
					if(!isNaN(credit_amt)) {
						credit_amt=parseInt(credit_amt);
						credit_total=credit_total+credit_amt;
					}
				}
			});
			
			
		}
		
	</script>
	
</html>