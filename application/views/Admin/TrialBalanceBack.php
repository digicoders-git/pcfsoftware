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
						<h5><a href="<?= base_url($this->data->controller); ?>/Dashboard"><?= $this->data->title; ?></a> / <?= $this->data->pageTitle; ?></h5>
					</div></div>
					<!--extra added here-->
					
					<div class="content-body"><!-- Stats -->
						
						<div class="row match-height">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<!--<h4 class="card-title" id="basic-layout-form-center"><?//= $this->data->pageTitle; ?></h4>-->
										
										<!-- Filter Form Start Here-->
										<!--<form method="post" action="<?=base_url($this->data->controller.'/'.$this->data->method)?>">
											<div class="row">
											<div class="col-md-3">
											<select id="disabledSelect" class="form-select form-control" name="grade">
											<option selected disabled>Choose Financial Year</option>
											<option>2021-2022</option>
											<option>2022-2023</option>
											</select>
											</div>
											<div class="col-md-9">
											<button class="btn btn-md btn-success"> <i class="fa fa-filter"></i> Filter</button> 
											</div>
											</div>
										</form>	-->
										<!-- Filter Form Start Here-->
										<form method="post" action="<?=base_url($this->data->controller.'/'.$this->data->method)?>">
											<span><b>From</b></span> &ensp;<input type="date" name='fromdate'> &ensp;&ensp;<span><b>To</b></span> &ensp;<input type="date" name="todate"> &emsp;<button class="btn btn-md btn-success"> <i class="fa fa-filter"></i> Filter</button>
										</form><br>
										<!-- Filter Form End Here-->
										<!-- Filter Form End Here-->
										
										<hr>
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body">
											
											<div class="row mb-2 mt-2">
												<div class="col-md-2"></div>
												<div class="col-md-8">
													<h5 class="text-center">TRIAL - BALANCE</h5>
													<span><p class="text-center"><b>*****</b> FY = (As on 
														<?php 
															if (date('m') < 4) {//Upto June 2022-2023
																echo $financial_year = (date('Y')-1) . '-' . date('Y');
																} else {//After June 2023-2024
																echo $financial_year = date('Y') . '-' . (date('Y') + 1);
															}	
														?>
													) <b>*****</b></p></span>
													
													<span><p class="text-center">PCF Employees Cooperative Soceity Ltd. as on <?php echo date("d/m/Y"); ?></p></span>
												</div>
												<div class="col-md-2"></div>
											</div>
											
											<!--table start here -->
											<table style="width:100%">
												<thead style="border-top-style: dotted;border-bottom-style: dotted;">
													<th>SNO</th>
													<th>PARTICULARS</th>
													<th>Dr.</th>
													<th>Cr.</th>
												</thead>
												<tbody>
													<?php
														
														$totaldebit =0;
														$totalcredit =0;
														$srno = 1;
														foreach ($list as $item)
														{
															$entrycode = $item->entrycode;
															$query = "select SUM(credit) as totalcredit from tbl_entry where entrycode='$entrycode'";
															
															
															$credit = $this->db->query($query)->row();
															
															$totalcredit+= $credit->totalcredit;
															
															$query1 = "select SUM(debit) as totaldebit from tbl_entry where entrycode='$entrycode'";
															
															$debit = $this->db->query($query1)->row();
															
															$totaldebit+= $debit->totaldebit;
															
															
															
														?>
														<tr>
															<td width="10%"><?= $srno; ?></td>
															<td><?= $item->entrycode; ?> &ensp;<?= $item->entrydesc; ?></td>
															<td width="16%">
																<?php 
																	if(!empty($debit->totaldebit))
																	{
																		echo number_format($debit->totaldebit, 2, '.', '');
																	}
																	else 
																	{
																		echo "0.00";
																	}
																?>
															</td>
															<td width="16%">
																<?php 
																	if(!empty($credit->totalcredit))
																	{
																		echo number_format($credit->totalcredit, 2, '.', '');
																	}
																	else 
																	{
																		echo "0.00";
																	}
																?>
															</td>
														</tr>
														<?php 
															$srno++;
														} 
													?>
													<tr style="border-top:dotted;border-bottom:dotted;">
														<td></td>
														<td>
															<span>T O T A L (As on <?= date('d/m/Y')?>)</span>	
														</td>
														<td><? echo number_format($totaldebit, 2, '.', '');?>	</td>
														<td><? echo number_format($totalcredit, 2, '.', '');?></td>
													</tr>
												</tbody>
											</table>
											<!--table end here -->
											
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