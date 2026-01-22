<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
	
	<head>
		<?php require APPPATH . 'views/Auth/CssLinks.php'; ?>
		<style>
			h4, h5 {
				font-family:verdana;
			}
			
			#print_btn 
			{
				position: relative;
				margin-left: 475px;
				margin-top: -100px;
				margin-bottom: 40px;
			}
		</style>
	</head>
	<!-- END: Head-->
	
	<!-- BEGIN: Body-->
	
	<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
		
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
										
										<!-- Filter Form Start Here
										<form method="post" action="<?=base_url($this->data->controller.'/'.$this->data->method)?>">
											<span><b>From</b></span> &ensp;<input type="date" name='fromdate'> &ensp;&ensp;<span><b>To</b></span> &ensp;<input type="date" name="todate"> &emsp;<button class="btn btn-md btn-success"> <i class="fa fa-filter"></i> Filter</button>
										</form><br>
										
										Filter Form End Here-->
										<!-- Filter Form End Here-->
										
										<hr>
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body" id="printableArea">
											
											<div class="row mb-2 mt-2">
												<div class="col-md-2"></div>
												<div class="col-md-8">
													<h5 class="text-center">TRIAL - BALANCE</h5>
													<span><p class="text-center"><b>*****</b> FY = (As on 
														<?php 
															// if (date('m') < 4) {
															// echo $financial_year = (date('Y')-1) . '-' . date('Y');
															// } else {
															// echo $financial_year = date('Y') . '-' . (date('Y') + 1);
															// }	
															echo "2023 - 2024";
														?>
													) <b>*****</b></p></span>
													
													<span><p class="text-center">PCF EMPLOYEES COOPERATIVE SOCIETY LTD. AS ON <?php echo date("31/03/Y"); ?></p></span>
												</div>
												<div class="col-md-2"></div>
											</div>
											
											<!--table start here -->
											<table style="width:100%">
												<thead style="border-top-style: dotted;border-bottom-style: dotted;">
													<th>SNO</th>
													<th colspan="2">PARTICULARS</th>
													<th style="text-align: right;">Dr.</th>
													<th style="text-align: right;">Cr.</th>
												</thead>
												<tbody>
													<?php
														// echo "<pre>";print_r($data["list"]);die();
														// $totaldebit =0;
														// $totalcredit =0;
														$srno = 1;
														
														$totalamountdebit = 0;
														$totalamountcredit = 0;
														foreach ($list as $item)
														{
															$entrycode = $item->entrycode;
															$entrydata = $this->db->get_where('entriesmaster',array('entrycode'=>$entrycode))->row();
															$entrydesc = $entrydata->entrydesc;
															
															if($item->type=='debit')
															{
																$totalamountdebit+=(float)$item->amount;
															}
															elseif($item->type=='credit')
															{
																$totalamountcredit+=(float)$item->amount;
															}
															
														?>
														<tr>
															<td width="10%"><?= $srno; ?></td>
															<td style="width:4%" ><?= $item->entrycode; ?></td>
															
															<td><?= $entrydesc; ?></td>
															
															<td width="16%" style="text-align: right;">
																<?php 
																if($item->type=='debit')
																{
																	if(!empty($item->amount))
																	{
																		// echo number_format($item->entrycode, 2, '.', '');
																		// echo $item->amount;
																		echo sprintf('%0.2f', abs($item->amount));
																	}
																}
																else
																{
																	echo "0.00";
																}
															?>
															</td>
															<td width="16%" style="text-align: right;">
																<?php 
																	if($item->type=='credit')
																	{
																		if(!empty($item->amount))
																		{
																			// echo number_format($item->entrycode, 2, '.', '');
																			// echo $item->amount;
																			echo sprintf('%0.2f', abs($item->amount));
																			}else{
																			echo $item->amount.'.00';
																		}
																		
																		}else{
																		echo '0.00';
																	}
																?>
															</td>
														</tr>
														<?php 
															$srno++;
														} 
													?>
													<tr style="border-top:dotted;border-bottom:dotted;">
														
														<td>
														</td>
														<td colspan="2">
															<span>T O T A L (As on <?= date("31/03/Y");?>)</span>	
														</td>
														<td style="text-align: right;"><?= $totalamountdebit; ?></td>
														<td style="text-align: right;"><?= $totalamountcredit; ?></td>
													</tr>
												</tbody>
											</table><br><br><br>
											<!--table end here -->
										</div>
									</div>
								</div>
								
								<!-- Print Button Start Here -->
									<button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" id="print_btn"><i class="fa fa-print noPrint"></i> Print</button>
									<!-- Print Button End Here -->
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
		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}	
	</script>
</html>			