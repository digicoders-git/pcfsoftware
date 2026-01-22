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
											
											<form action="<?php echo base_url($this->data->controller . '/' . $this->data->method . '/Add'); ?>" method="post" id="addForm">
												<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
												
												<div class="row justify-content-md-center">
													<div class="col-md-12">
													    
														<h4 class="text-center"><u>H.O Deduction</u></h4>
														<div class="form-row">
															<div class="col-md-2">
																<label>VNO<span class="text-danger">*</span></label>
																<input type="text" class="form-control vno entry_vno" name="vno" placeholder="Voucher No" required >
															</div>
															<div class="col-md-2">
																<label>Date<span class="text-danger">*</span></label>
																<input type="date" class="form-control date entry_date" name="date" placeholder="Date" required>
															</div>
															<div class="col-md-3">
																<label>Description<span class="text-danger">*</span></label>
																<input type="text" class="form-control desc entry_desc" name="entrydesc" placeholder="Description" required />
															</div>
															<div class="col-md-2">
																<label>Ho Deduction<span class="text-danger">*</span></label>
																<input type="text" class="form-control date ho_deduction" name="ho_deduction" placeholder="HO Deduction" >
															</div>
															<div class="col-md-3">
																<label>AddMemberTo HO<span class="text-danger">*</span></label><br>
																
																<a type="button" href="<?= base_url('Admin/ActiveMembers')?>" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i> AddMember To HO <i class="glyphicon glyphicon-plus" ></i> </a>
															</div>
														</div><br>
														
														<?php
															$list = $this->db->query("select * from members where ho_status='true' order by pf_number")->result();
															{
																if(!empty($list))
																{
																	$srno = 1;
																	foreach($list as $item)
																	{	
																	?>
																	<div class="form-row ">
																	
																	<div class="col-md-1 mt-3">
																	<label></label>
																			<?= $srno?>
																		</div>
																	
																	
																		<div class="col-md-2">
																		<input type="hidden" class="form-control vno id" name="id"   value="<?= $item->id; ?>">
																			<label>PF Number</label>
																			<input minlength="6" maxlength="6" type="text" class="form-control pfno entry_pfno" name="pfno[]" onkeyup="getPFNO1(this,this.value,<?=$srno?>)" placeholder="PF Number" value="<?= $item->pf_number?>">
																		</div>
																		
																		<div class="col-md-3">
																			<label>Member Name</label>
																			<input type="text" class="form-control member_name" id="member_name<?=$srno?>"  placeholder="Member Name" value="<?= $item->name?>">
																		</div>
																		
																		<div class="col-md-3 mb-3">
																			<label>Loan</label>
																			<input type="text" class="form-control credit entry_debit" name="debit[]" onkeyup="debitLogic(this,<?=$srno?>)" placeholder="Loan">
																		</div>
																		
																		<div class="col-md-3 mb-3">
																		<input type="hidden" class="form-control pm_saving"   id="pm_saving"  value="<?= $item->pm_saving; ?>">
																		
																			<label>Saving</label>
																			<input type="text" class="form-control credit entry_credit " name="credit[]" id="saving" placeholder="Saving"  onkeyup="creditLogic(this)">
																		</div>
																	</div> 
																	
																	<?php
																		$srno++;
																		// forech end 
																	}
																}
																
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
														
														<!-- Invoice End Here -->
														
														<!-- Total Start Here -->
														<div class="card-body" style="background-image: linear-gradient(#fbf3f3, #f7f2e9, #f7f7e2, #ebf7eb);">
														<div class="row">
														<div class="col-md-4"><b>Total Amount</b></div>	
														<div class="col-md-4"><b>Loan Total : </b> &ensp; &#8377;<span class="entry_debit_total">0</span> </div>
														<div class="col-md-4"><b>Saving Total :</b>  &ensp; &#8377;<span class="entry_credit_total">0</span></div>	
														
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
														function setvalue(){
															var pm = document.getElementById("pm_saving").value;
																document.getElementById("getValue").value = pm;
															}
														
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
														
														function debitLogic(e,idd) {
															
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
																// start here 
																var pf = $("#saving").val();
																// alert(pf);
																// $("#pm_saving"+idd).val(pf);
																
																// end here 
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
															$(".entry_credit").each(function(){
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
															// alert(e);
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
														
														function getPFNO1(e,id,idd){
															// alert(e);
															var id=id;
															$.ajax({
																url: "<?= base_url('Admin/getPFNO1')?>",
																type: 'post',
																data: {id:id},
																cache: false,
																success: function(response){
																	$(e).parent().find(".entry_pf_name").text(response);
																	$("#member_name"+idd).val(response);
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