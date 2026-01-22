<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
	
	<head>
		<?php require APPPATH . 'views/Auth/CssLinks.php'; ?>
		<style>
			h4,h5 {
			font-family:verdana;
			}
			#maindiv
			{
			position: relative;
			margin-left: 260px;
			margin-top: -58px;
			margin-bottom: 25px;
			font-size: 20px;
			}
			.radio_btn
			{
			height:20px;
			width:20px;
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
										<h4 class="card-title">New Entry</h4><hr>
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body">
											
											<?php 
												$mode="off";
												if(!empty($this->input->get("mode"))){
													$mode=$this->input->get("mode");
												}
											?>
											
											<form action="<?php echo base_url($this->data->controller . '/' . $this->data->method . '/Add'); ?>" method="post" id="addForm">
												<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
												
												<!--- Radio Button Start Here -->
												<div id="maindiv">
													<div class="form-check form-check-inline">
														<input <?php if($mode=="off") { echo "checked"; } ?> class="form-check-input radio_btn mode_cb" type="radio" name="entry_type" id="inlineRadio1" value="C-SO">
														<label class="form-check-label" for="inlineRadio1">Cashbook</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input radio_btn" type="radio" name="entry_type" id="inlineRadio2" value="12B">
														<label class="form-check-label" for="inlineRadio2">12 B</label>
													</div>
													<div class="form-check form-check-inline">
														<input <?php if($mode=="ho") { echo "checked"; } ?> class="form-check-input radio_btn mode_ho" type="radio" name="entry_type" id="inlineRadio3" value="J-SO">
														<label class="form-check-label" for="inlineRadio3">Transfer Journal</label>
													</div>
												</div>
												<!--- Radio Button End Here -->
												
												
												
												<div class="row justify-content-md-center">
													<div class="col-md-12">
													    
														<?php
															if($mode=="ho") {
																// previous month data show here every field filed up
																
																$firstdate = date('Y-m-d', strtotime('first day of last month'));
																$lastdate = date('Y-m-d', strtotime('last day of last month'));
																
																// $list = $this->db->query("select * from tbl_entry where date_time>='$firstdate' AND date_time<='$lastdate' ")->result();
																
																$list = $this->db->query("select * from tbl_entry where date_time>='$firstdate' AND date_time<='$lastdate' AND entry_type='J-SO'")->result();
																
																// echo "<pre>";
																// print_r($list);die();
																if(!empty($list))
																{
																	foreach($list as $item)
																	{
																		
																	?>
																	
																	<div class="card-body itemtable">
																		
																		<div class="form-group formBox border border-danger p-1 entryrow">
																			<div class="form-row">
																				<div class="col-md-1">
																					<br/>
																					<big><b class="entry_srno">1</b></big>
																				</div>
																				<div class="col-md-3">
																					<label>Voucher No<span class="text-danger">*</span></label>
																					<input type="text" class="form-control vno entry_vno" name="vno[]" placeholder="Voucher No" required value="<?= $item->vno;?>">
																				</div>
																				<div class="col-md-2">
																					<label>Date<span class="text-danger">*</span></label>
																					<input type="date" class="form-control date entry_date" name="date[]" placeholder="Date" value="<?= $item->date_time;?>" required>
																				</div>
																				<div class="col-md-3">
																					<label>Entry Code<span class="text-danger">*</span></label>
																					<input type="text" class="form-control entrycode entry_code" name="entrycode[]"  placeholder="Entry Code" list="entry" onchange="getEntry(this, this.value)" value="<?= $item->entrycode;?>" required>
																					<span class="entry_code_name">ENTRY_DESCRIPTION</span>
																				</div>
																				<div class="col-md-3">
																					<label>PF Number</label>
																					<input minlength="6" maxlength="6" type="text" class="form-control pfno entry_pfno" name="pfno[]" onkeyup="getPFNO(this,this.value)" placeholder="PF Number" value="<?= $item->pf_no;?>">
																					<span class="entry_pf_name">MEMBER_NAME</span>
																				</div>
																			</div> 
																			<div class="form-row">
																				<div class="col-md-3 descriptionbox">
																					<label>Description<span class="text-danger">*</span></label>
																					<input type="text" class="form-control desc entry_desc" name="entrydesc[]" placeholder="Description" value="<?= $item->entrydesc;?>" required />
																				</div>
																				<div class="col-md-3 districtbox">
																					<label>District Code </label>
																					<input type="text" class="form-control districtcode district_code"  placeholder="District Code" list="district" onchange="getDistrict(this, this.value)" >
																					<span class="district_name">DISTRICT_NAME</span>
																					<input type="hidden" name="districtcode[]" class="district_code1" />
																				</div>
																				<div class="col-md-3 mb-3">
																					<label>Debit*</label>
																					<input value="<?= $item->debit;?>" type="text" class="form-control debit entry_debit" name="debit[]" placeholder="Debit" onkeyup="debitLogic(this)" >
																				</div>
																				<div class="col-md-3 mb-3">
																					<label>Credit*</label>
																					<input value="<?= $item->credit;?>" type="text" class="form-control credit entry_credit" name="credit[]" placeholder="Credit" onkeyup="creditLogic(this)">
																				</div>
																			</div>
																		</div>
																		
																	</div>
																	
																	<?php
																		// forech end 
																	}
																}
																else
																{
																?>
																<div class="card-body itemtable">
																	
																	<div class="form-group formBox border border-danger p-1 entryrow">
																		<div class="form-row">
																			<div class="col-md-1">
																				<br/>
																				<big><b class="entry_srno">1</b></big>
																			</div>
																			<div class="col-md-3">
																				<label>Voucher No<span class="text-danger">*</span></label>
																				<input type="text" class="form-control vno entry_vno" name="vno[]" placeholder="Voucher No" required >
																			</div>
																			<div class="col-md-2">
																				<label>Date<span class="text-danger">*</span></label>
																				<input type="date" class="form-control date entry_date" name="date[]" placeholder="Date" required>
																			</div>
																			<div class="col-md-3">
																				<label>Entry Code<span class="text-danger">*</span></label>
																				<input type="text" class="form-control entrycode entry_code" name="entrycode[]"  placeholder="Entry Code" list="entry" onchange="getEntry(this, this.value)"  required>
																				<span class="entry_code_name">ENTRY_DESCRIPTION</span>
																			</div>
																			<div class="col-md-3">
																				<label>PF Number</label>
																				<input minlength="6" maxlength="6" type="text" class="form-control pfno entry_pfno" name="pfno[]" onkeyup="getPFNO(this,this.value)" placeholder="PF Number">
																				<span class="entry_pf_name">MEMBER_NAME</span>
																			</div>
																		</div> 
																		<div class="form-row">
																			<div class="col-md-3 descriptionbox">
																				<label>Description<span class="text-danger">*</span></label>
																				<input type="text" class="form-control desc entry_desc" name="entrydesc[]" placeholder="Description" required />
																			</div>
																			<div class="col-md-3 districtbox">
																				<label>District Code </label>
																				<input type="text" class="form-control districtcode district_code"  placeholder="District Code" list="district" onchange="getDistrict(this, this.value)" >
																				<span class="district_name">DISTRICT_NAME</span>
																				<input type="hidden" name="districtcode[]" class="district_code1" />
																			</div>
																			<div class="col-md-3 mb-3">
																				<label>Debit*</label>
																				<input type="text" class="form-control debit entry_debit" name="debit[]" placeholder="Debit" onkeyup="debitLogic(this)" >
																			</div>
																			<div class="col-md-3 mb-3">
																				<label>Credit*</label>
																				<input type="text" class="form-control credit entry_credit" name="credit[]" placeholder="Credit" onkeyup="creditLogic(this)">
																			</div>
																		</div>
																	</div>
																	
																</div>
																<?php 
																}
																
																// else end here 
																
															}
															else
															{
															?>
															
															<div class="card-body itemtable">
																
																<div class="form-group formBox border border-danger p-1 entryrow">
																	<div class="form-row">
																		<div class="col-md-1">
																			<br/>
																			<big><b class="entry_srno">1</b></big>
																		</div>
																		<div class="col-md-3">
																			<label>Voucher No<span class="text-danger">*</span></label>
																			<input type="text" class="form-control vno entry_vno" name="vno[]" placeholder="Voucher No" required >
																		</div>
																		<div class="col-md-2">
																			<label>Date<span class="text-danger">*</span></label>
																			<input type="date" class="form-control date entry_date" name="date[]" placeholder="Date" required>
																		</div>
																		<div class="col-md-3">
																			<label>Entry Code<span class="text-danger">*</span></label>
																			<input type="text" class="form-control entrycode entry_code" name="entrycode[]"  placeholder="Entry Code" list="entry" onchange="getEntry(this, this.value)"  required>
																			<span class="entry_code_name">ENTRY_DESCRIPTION</span>
																		</div>
																		<div class="col-md-3">
																			<label>PF Number</label>
																			<input minlength="6" maxlength="6" type="text" class="form-control pfno entry_pfno" name="pfno[]" onkeyup="getPFNO(this,this.value)" placeholder="PF Number">
																			<span class="entry_pf_name">MEMBER_NAME</span>
																		</div>
																	</div> 
																	<div class="form-row">
																		<div class="col-md-3 descriptionbox">
																			<label>Description<span class="text-danger">*</span></label>
																			<input type="text" class="form-control desc entry_desc" name="entrydesc[]" placeholder="Description" required />
																		</div>
																		<div class="col-md-3 districtbox">
																			<label>District Code </label>
																			<input type="text" class="form-control districtcode district_code"  placeholder="District Code" list="district" onchange="getDistrict(this, this.value)" >
																			<span class="district_name">DISTRICT_NAME</span>
																			<input type="hidden" name="districtcode[]" class="district_code1" />
																		</div>
																		<div class="col-md-3 mb-3">
																			<label>Debit*</label>
																			<input type="text" class="form-control debit entry_debit" name="debit[]" placeholder="Debit" onkeyup="debitLogic(this)" >
																		</div>
																		<div class="col-md-3 mb-3">
																			<label>Credit*</label>
																			<input type="text" class="form-control credit entry_credit" name="credit[]" placeholder="Credit" onkeyup="creditLogic(this)">
																		</div>
																	</div>
																</div>
																
															</div>
															
															<?php
															}
														?>
														
														<!-- DataList for entry type Start Here-->
														
														<datalist id="entry">
															<?php 
																$list = $this->db->get('entriesmaster')->result();
																foreach ($list as $item)
																{
																    $name=$item->entrycode;
																?>
																<option><?= $name ?></option>
																<?php 
																}
															?>
														</datalist>
														<!-- DataList for entry type End Here-->
														
														<!-- DataList for district Start Here-->
														<datalist id="district">
															<?php 
																$list = $this->db->query("select * from districts where state='34'")->result();
																foreach ($list as $item)
																{
																    $name=$item->district;
																    //$name = substr($name, 0, 6);
																    //$name=strtoupper($name);
																?>
																<option><?= $name ?></option>
																<?php 
																}
															?>
														</datalist>
														<!-- DataList for district End Here-->
														
														
														
														<!-- Add More Row Button -->
														<div class="row justify-content-md-center">
															<div class="col-md-12">
																<div class="card-body">
																	
																	<button type="button" class="btn btn-warning btn-md" onclick="additem()"><i class="fa fa-plus-circle"></i> Add New Entry <i class="glyphicon glyphicon-plus" ></i> </button>
																	
																</div>
															</div>
														</div>
														
														
														<!-- Invoice End Here -->
														
														<!-- Total Start Here -->
														<div class="card-body" style="background-image: linear-gradient(#fbf3f3, #f7f2e9, #f7f7e2, #ebf7eb);">
															<div class="row">
																<div class="col-md-4"><b>Total Amount</b></div>	
																<div class="col-md-4"><b>Debit Total : </b> &ensp; &#8377;<span class="entry_debit_total">0</span> </div>
																<div class="col-md-4"><b>Credit Total :</b>  &ensp; &#8377;<span class="entry_credit_total">0</span></div>	
																
															</div>
														</div>
														<!-- Total End Here -->
														
													</div>
													
												</div>
												
												<div class="form-actions center mb-4 mt-2">
													<div class="row">
														
														<div class="col-md-4">
															<!-- 
																<button type="button" class="btn btn-warning btn-md" onclick="additem()"><i class="fa fa-plus-circle"></i> Add New Entry <i class="glyphicon glyphicon-plus" ></i> </button>
															-->
														</div>	
														
														
														<div class="col-md-4">
															
															<button type="submit" class="btn btn-md" style="background-color:green;color:white" id="addBtn"> <i class="fa fa-check-circle"></i> Submit All Entries <i class="fa fa-spin fa-spinner" id="addSpin" style="display:none;"></i></button>
															
															<!--
															<button type="submit" class="btn btn-md" style="background-color:green;color:white" > <i class="fa fa-check-circle"></i> Submit All Entries </button>-->
															
														</div>	
														
														<div class="col-md-4"><a href="<?= base_url($this->data->controller);
														?>/NewEntry" class="btn btn-danger" > <i class="fa fa-times-circle"></i> Cancel All Entries </a></div>	
													</div>
													
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
	
	<script>
		
		var entry_type="";
		
		$(document).ready(function(){
			
			$(".mode_ho").click(function(){
				var check=$(this).prop("checked");
				if(check==true) {
					window.location.href="<?= base_url('Admin/NewEntry?mode=ho') ?>";
				}
			});
			
			$(".mode_cb").click(function(){
				var check=$(this).prop("checked");
				if(check==true) {
					window.location.href="<?= base_url('Admin/NewEntry') ?>";
				}
			});
			
			if($("#inlineRadio1").prop("checked")) {
				entry_type="cashbook";
			}
			if($("#inlineRadio2").prop("checked")) {
				entry_type="12b";
			}
			if($("#inlineRadio3").prop("checked")) {
				entry_type="transferjournal";
			}
			
			$("#inlineRadio1").click(function(){
				if($(this).prop("checked")) {
					entry_type="cashbook";
				}
				setentrymode();
			})
			$("#inlineRadio2").click(function(){
				if($(this).prop("checked")) {
					entry_type="12b";
				}
				setentrymode();
			})
			$("#inlineRadio3").click(function(){
				if($(this).prop("checked")) {
					entry_type="transferjournal";
				}
				setentrymode();
			})
			
			setentrymode();
			
		});
		
		
		function setentrymode() {
			
			if(entry_type=="12b") {
				$(".districtbox").show();
				if($(".descriptionbox").hasClass("col-md-3")) {
					$(".descriptionbox").removeClass("col-md-3");
				}
				
				if($(".descriptionbox").hasClass("col-md-6")) {
					$(".descriptionbox").removeClass("col-md-6");
				}
				$(".descriptionbox").addClass("col-md-3");
			}
			else {
				$(".districtbox").hide();
				if($(".descriptionbox").hasClass("col-md-3")) {
					$(".descriptionbox").removeClass("col-md-3");
				}
				if($(".descriptionbox").hasClass("col-md-6")) {
					$(".descriptionbox").removeClass("col-md-6");
				}
				$(".descriptionbox").addClass("col-md-6");
			}
			
		}
		
		var count=1;
		function additem()
		{
			
			// for autofill
			var vno=$(".entryrow:last-child").find(".entry_vno").val();
			var date=$(".entryrow:last-child").find(".entry_date").val();
			var entrycode=$(".entryrow:last-child").find(".entry_code").val();
			var desc=$(".entryrow:last-child").find(".entry_desc").val();
			
			// span
			var entryname=$(".entryrow:last-child").find(".entry_code_name").text();
			
			// for 12b 
			var districtcode=$(".entryrow:last-child").find(".districtcode").val();
			var district_name=$(".entryrow:last-child").find(".district_name").text();
			
			// for validation
			var credit=$(".entryrow:last-child").find(".entry_credit").val();
			var debit=$(".entryrow:last-child").find(".entry_debit").val();
			
			if( vno.length==0 || date.length==0 || entrycode.length==0 || desc.length==0 ) {
				
				notif({
					msg: "All * Fields are Required to Fill!",
					position: "center",
					bgcolor: "#ff4500",
					color: "white"
				});
				// end here 
			}
			else if(debit.length==0 && credit.length==0)
			{
				
				notif({
					msg: "Debit or Credit is required!",
					position: "center",
					bgcolor: "#ffa500",
					color: "white"
				});
				
				// end here 
			}
			else
			{
				
				count=count+1;
				
				//var row='<div class="form-group formBox border border-danger p-1 entryrow"><div class="form-row"><div class="col-md-1"><br><big><b class="entry_srno">'+count+'</b></big></div><div class="col-md-3"><label>Voucher No<span class="text-danger">*</span></label><input type="text" class="form-control vno entry_vno" name="vno[]" value="'+vno+'" placeholder="Voucher No" required></div><div class="col-md-2"><label>Date<span class="text-danger">*</span></label><input type="date" class="form-control date entry_date" name="date[]" value="'+date+'" placeholder="Date" required></div><div class="col-md-3"><label>Entry Code<span class="text-danger">*</span></label><input type="text" class="form-control entrycode entry_code" name="entrycode[]" value="'+entrycode+'" placeholder="Entry Code" list="entry" onkeyup="getEntry(this,this.value)" required><span class="entry_code_name">'+entryname+'</span></div><div class="col-md-3"><button class="btn btn-sm float-right remove-row" style="background-color:red;color:#fff" type="button" onclick="removeRow(this)"><i class="fa fa-remove"></i></button><label>PF Number</label><input type="text" class="form-control pfno entry_pfno" name="pfno[]"  onkeyup="getPFNO(this,this.value)" placeholder="PF Number" ><span class="entry_pf_name">MEMBER_NAME</span></div></div><div class="form-row"><div class="col-md-6"><label>Description<span class="text-danger">*</span></label><input type="text" class="form-control desc entry_desc" name="entrydesc[]" placeholder="Description" value="'+desc+'" required></div><div class="col-md-3 mb-3"><label>Debit*</label><input type="text" class="form-control debit entry_debit"  name="debit[]" placeholder="Debit" onkeyup="debitLogic(this)"></div><div class="col-md-3 mb-3"><label>Credit*</label><input type="text" class="form-control credit entry_credit" name="credit[]" placeholder="Credit" onkeyup="creditLogic(this)"></div></div></div>';
				
				var row="";
				
				if(entry_type=="12b") {
					// for 12b
					row='<div class="form-group formBox border border-danger p-1 entryrow"><div class="form-row"><div class="col-md-1"><br><big><b class="entry_srno">'+count+'</b></big></div><div class="col-md-3"><label>Voucher No<span class="text-danger">*</span></label><input type="text" class="form-control vno entry_vno" name="vno[]" value="'+vno+'" placeholder="Voucher No" required></div><div class="col-md-2"><label>Date<span class="text-danger">*</span></label><input type="date" class="form-control date entry_date" name="date[]" value="'+date+'" placeholder="Date" required></div><div class="col-md-3"><label>Entry Code<span class="text-danger">*</span></label><input type="text" class="form-control entrycode entry_code" name="entrycode[]" value="'+entrycode+'" placeholder="Entry Code" list="entry" onkeyup="getEntry(this,this.value)" required><span class="entry_code_name">'+entryname+'</span></div><div class="col-md-3"><button class="btn btn-sm float-right remove-row" style="background-color:red;color:#fff" type="button" onclick="removeRow(this)"><i class="fa fa-remove"></i></button><label>PF Number</label><input minlength="6" maxlength="6" type="text" class="form-control pfno entry_pfno" name="pfno[]" onkeyup="getPFNO(this,this.value)" placeholder="PF Number"><span class="entry_pf_name">MEMBER_NAME</span></div></div><div class="form-row"><div class="col-md-3 descriptionbox"><label>Description<span class="text-danger">*</span></label><input type="text" class="form-control desc entry_desc" name="entrydesc[]" placeholder="Description" value="'+desc+'" required></div><div class="col-md-3 districtbox"><label>District Code</label><input type="text" class="form-control districtcode district_code" value="'+districtcode+'" placeholder="District Code" list="district" onchange="getDistrict(this,this.value)"><span class="district_name">'+district_name+'</span><input type="hidden" name="districtcode[]" value="'+district_name+'" class="district_code1"></div><div class="col-md-3 mb-3"><label>Debit*</label><input type="text" class="form-control debit entry_debit" name="debit[]" placeholder="Debit" onkeyup="debitLogic(this)"></div><div class="col-md-3 mb-3"><label>Credit*</label><input type="text" class="form-control credit entry_credit" name="credit[]" placeholder="Credit" onkeyup="creditLogic(this)"></div></div></div>';
				}
				else 
				{
					// for non 12b 
					row='<div class="form-group formBox border border-danger p-1 entryrow"><div class="form-row"><div class="col-md-1"><br><big><b class="entry_srno">'+count+'</b></big></div><div class="col-md-3"><label>Voucher No<span class="text-danger">*</span></label><input type="text" class="form-control vno entry_vno" name="vno[]" value="'+vno+'" placeholder="Voucher No" required ></div><div class="col-md-2"><label>Date<span class="text-danger">*</span></label><input type="date" class="form-control date entry_date" name="date[]" value="'+date+'" placeholder="Date" required></div><div class="col-md-3"><label>Entry Code<span class="text-danger">*</span></label><input type="text" class="form-control entrycode entry_code" name="entrycode[]" value="'+entrycode+'" placeholder="Entry Code" list="entry" onkeyup="getEntry(this,this.value)" required><span class="entry_code_name">'+entryname+'</span></div><div class="col-md-3"><button class="btn btn-sm float-right remove-row" style="background-color:red;color:#fff" type="button" onclick="removeRow(this)"><i class="fa fa-remove"></i></button><label>PF Number</label><input type="text" class="form-control pfno entry_pfno" name="pfno[]"  onkeyup="getPFNO(this,this.value)" placeholder="PF Number" ><span class="entry_pf_name">MEMBER_NAME</span></div></div><div class="form-row"><div class="col-md-6"><label>Description<span class="text-danger">*</span></label><input type="text" class="form-control desc entry_desc" name="entrydesc[]" placeholder="Description" value="'+desc+'" required></div><div class="col-md-3 mb-3"><label>Debit*</label><input type="text" class="form-control debit entry_debit"  name="debit[]" placeholder="Debit" onkeyup="debitLogic(this)"></div><div class="col-md-3 mb-3"><label>Credit*</label><input type="text" class="form-control credit entry_credit" name="credit[]" placeholder="Credit" onkeyup="creditLogic(this)"></div></div></div>';
				}
				
				// $(".itemtable").append(row);
				
				$(".itemtable").append(row);
				
				
				
			}
			
		}
		
		function removeRow(e) {
			
			// Swal.fire({
			// title: 'Are you sure?',
			// text: "You want to remove?",
			// icon: 'warning',
			// showCancelButton: true,
			// confirmButtonColor: '#3085d6',
			// cancelButtonColor: '#d33',
			// confirmButtonText: 'Remove'
			// }).then((result) => {
			// if (result.isConfirmed) {
			// $(e).parent().parent().parent().remove();
			// Swal.fire(
			// 'Deleted!',
			// 'Your Entry has been Removed.',
			// 'success'
			// )
			// }
			
			// })
			notif({
				msg: "Your Entry has been Removed.",
				position: "center",
				bgcolor: "#9acd32",
				color: "white"
			});
			$(e).parent().parent().parent().remove();
			// end here 
			
			// if(confirm("Are you sure want to remove?")) 
			// {
			// $(e).parent().parent().parent().remove();
			// }
		}
		
		function debitLogic(e) {
			
			if($(e).val() == "") {
				$(e).parent().next().find("input").attr("readonly",false);
				} else {
				$(e).parent().next().find("input").attr("readonly",true);
			}
			
			var debit_total=0;
			$(".itemtable .entry_debit").each(function(){
				var debit_amt=$(this).val();
				if(debit_amt.length>0) {
					if(!isNaN(debit_amt)) {
						debit_amt=parseInt(debit_amt);
						debit_total=debit_total+debit_amt;
					}
				}
			});
			
			$(".entry_debit_total").text(debit_total);
			
		}
		
		function creditLogic(e) {
			
			if($(e).val() == "") {
				$(e).parent().prev().find("input").attr("readonly",false);
				} else {
				$(e).parent().prev().find("input").attr("readonly",true);
			}
			
			var credit_total=0;
			$(".itemtable .entry_credit").each(function(){
				var credit_amt=$(this).val();
				if(credit_amt.length>0) {
					if(!isNaN(credit_amt)) {
						credit_amt=parseInt(credit_amt);
						credit_total=credit_total+credit_amt;
					}
				}
			});
			
			$(".entry_credit_total").text(credit_total);
			
		}
		
		function getEntry(e,id){
			
			if(e.value == 'LONACC' || e.value == 'SHAACC' || e.value == 'SAVACC' ){  
				$(e).parent().next().find("input").attr("readonly",false);
				} else {
				$(e).parent().next().find("input").attr("readonly",true);
			}
			
			var dist=id;
			$.ajax({
				url: "<?= base_url('Admin/getEntry')?>",
				type: 'post',
				data: {id:id},
				cache: false,
				success: function(response){
					$(e).parent().find(".entry_code_name").text(response);
					// end here 
				}
			});
		}
		
		function getDistrict(e, id) {
			
			var dist=id;
			$.ajax({
				url: "<?= base_url('Admin/getDistrict')?>",
				type: 'post',
				data: {id:id},
				cache: false,
				success: function(response){
					$(e).parent().find(".district_name").text(response);
					$(e).parent().find(".district_code1").val(response);
					// end here 
				}
			});
			
		}
		
		
		function getPFNO(e,id){
			var id=id;
			$.ajax({
				url: "<?= base_url('Admin/getPFNO')?>",
				type: 'post',
				data: {id:id},
				cache: false,
				success: function(response){
					$(e).parent().find(".entry_pf_name").text(response);
				}
			});
		}
		
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
		
		
		
	</script>
	
	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	
</html>																																																															