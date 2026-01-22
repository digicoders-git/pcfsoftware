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
										<h4 class="card-title" id="basic-layout-form-center">New Entry</h4><hr>
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body">
											<form action="<?php echo base_url($this->data->controller . '/' . $this->data->method . '/Add'); ?>" method="post" id="addForm">
												<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
												<div class="row justify-content-md-center">
													<div class="col-md-12">
														<div class="form-body">
															
															<!-- Invoice Start Here -->
															<div class="form-group">
																<h3>Entry Details <button type="button" class="btn btn-warning btn-sm" onclick="additem()"><i class="fa fa-plus-circle"></i> Add <i class="glyphicon glyphicon-plus" ></i> </button> <button type="submit" class="btn btn-sm" style="background-color:green;color:white" id="addBtn"> <i class="fa fa-check-circle"></i> Save <i class="fa fa-spin fa-spinner" id="addSpin" style="display:none;"></i></button> </h3>
																<table class="table table-bordered table-responsive itemtable">
																	<tr>
																		<th>#</th>
																		<th>Voucher No</th>
																		<th>Date</th>
																		<th>Entry Code</th>
																		<th>Description</th>
																		<th>PF No</th>
																		<th>Debit</th>
																		<th>Credit</th>
																	</tr>
																	<tr>
																		<th>1</th>
																		<td> <input type="text" id="voucher"  name="vno[]" placeholder="Voucher No" /> </td>
																		<td> <input type="date" id="date" id="date"  name="date[]" placeholder="Date" required/> </td>
																		
																		<td> 
																			<input list="entry" type="text" name="entrycode[]" onkeyup="getEntry(this.value)" placeholder="Entry Code" required/><span style="font-size:10px" id="entrydesc"></span> 
																		</td>
																		
																		<td><input type="text" id="description"  name="entrydesc[]"  placeholder="Description"/> 
																		</td>
																		
																		<td> <input type="text" id="pfno" name="pfno[]" onkeyup="getPFNO(this.value)" placeholder="PF NO" required/>
																			<span style="font-size:10px" id="pfno_desc"></span>
																		</td>
																		<td> <input type="text" id="debit" class="test" name="debit[]" placeholder="Debit" /> </td>
																		<td> <input type="text" id="credit" class="test" name="credit[]" placeholder="Credit" /> </td>
																	</tr>
																</table>
																<!-- DataList Start Here-->
																<datalist id="entry">
																	<?php
																		$list = $this->db->get('entriesmaster')->result();
																		foreach ($list as $item)
																		{
																		?>
																		<option value="<?= $item->entrycode?>">
																			<?php 
																			}
																		?>
																	</datalist>
																	<!-- DataList End Here-->
																	
																</div>
																<!-- Invoice End Here -->
															</div>
														</div>
													</div>
													
													<div class="form-actions center">
														<!--<button type="submit" class="btn" style="background-color:green;color:white" id="addBtn"> <i class="fa fa-check-circle"></i> Save <i class="fa fa-spin fa-spinner" id="addSpin" style="display:none;"></i></button>-->
														
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
									$(document).ready(function() {
										
										$("#debit").keyup(function() {
											var x = document.getElementById('credit');
											if($(this).val() == "") {
												$(x).attr("readonly",false);
												} else {
												$(x).attr("readonly",true);
											}
										});
										$("#credit").keyup(function() {
											var x = document.getElementById('debit');
											if($(this).val() == "") {
												$(x).attr("readonly",false);
												} else {
												$(x).attr("readonly",true);
											}
										});
									});
								</script>
								
								
								<!-- END: Body-->
								<script>
									function additem()
									{
										var a=$(".itemtable tr").length;
										if(a>0)
										{
											var b=$(".itemtable tr").length+1;
											
											var b='<tr><th>'+a+'</th><td> <input type="text" id="vno'+b+'" name="vno[]" placeholder="Voucher No"/> </td> <td> <input type="date" id="date"  name="date[]" placeholder="Date" /> </td> <td> <input type="text" name="entrycode[]" onkeyup="getEntry('+a+')" placeholder="Entry Code"/> </td> <td> <input type="text" id="description"  name="description[]" placeholder="Description" /> </td> <td> <input type="text" id="pfno'+b+'" name="pfno[]" placeholder="PF NO" /> </td> <td> <input type="text" name="debit[]" placeholder="Debit" /> </td> <td> <input type="text" name="credit[]" placeholder="Credit" /> </td> <td><button class="btn btn-danger btn-sm fa fa-times-circle remove-extra-content" type="button"></button></td>  </tr>';
											
											$(".itemtable").append(b);
										}
										/*
											else {
											$(".itemtable tr").length('');
											}
										*/
										$('.itemtable').on('click', '.remove-extra-content', function(e) {
											e.preventDefault();
											
											$(this).parent().parent().remove();
											// end here 
											
										});
										$(".itemname").change(function(){
											
											var a=$(this).parent().parent().find("th").eq(0).html();
											updatesubtotal(a);
										})
									}	
									
								</script>
								
								
								<script>
									function getEntry(id){
										var dist=id;
										$.ajax({
											url: "<?= base_url('Admin/getEntry')?>",
											type: 'post',
											data: {id:id},
											cache: false,
											success: function(response){
												// alert(response);
												// $("#entrydesc").val(response);
												$("#entrydesc").text(response);
											}
										});
									}
								</script>
								<script>
									function getPFNO(id){
										var id=id;
										$.ajax({
											url: "<?= base_url('Admin/getPFNO')?>",
											type: 'post',
											data: {id:id},
											cache: false,
											success: function(response){
												// alert(response);
												$("#pfno_desc").text(response);
											}
										});
									}
								</script>
								
								
							</html>																			