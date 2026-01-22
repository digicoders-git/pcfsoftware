<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
	
	<head>
		<?php require APPPATH . 'views/Auth/CssLinks.php'; ?>
		<style>
			h4,h5 {
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
					
					<div class="content-body" ><!-- Stats -->
						
						<div class="row match-height">
							<div class="col-md-12">
								<div class="card" id="printableArea">
									<div class="card-header">
										<h4 class="card-title" id="basic-layout-form-center">Subsidiary Shares Ledger <span> (As on <?php echo date('31/03/2023');?>)</span></h4>
										<br>
										
										<!-- Filter Form Start Here-->
										<form method="post" action="<?=base_url('Admin/SubsidiarySharesLedger')?>">
											<span><b>From</b></span> &ensp;<input type="date" name='fromdate' value="<?php if(!empty($fromdate))
												{
													echo $fromdate;
												}?>"> &ensp;&ensp;<span><b>To</b></span> &ensp;<input type="date" name="todate" value="<?php if(!empty($todate))
												{
													echo $todate;
												}?>"> &emsp;<button class="btn btn-md btn-success"> <i class="fa fa-filter"></i> Filter</button>
										</form><br>
										<!-- Filter Form End Here-->
										
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body">
											
											<!--table start here -->
											<table style="width:100%">
												<thead style="border-top-style: dotted;border-bottom-style: dotted;">
													<th>S.No.</th>
													<th>PF Number</th>
													<th>Shares</th>
												</thead>
												
												<tbody>
													<?php
														$sr=1;
														$total_shares = 0; 
														foreach ($list as $item)
														{
															$credit = $item->total_credit;
															$debit = $item->total_debit;
															
															// for saving interest all members 
															if(!empty($item->total_credit))
															{
																$total_shares+=$credit-$debit;
															}
															
															$pf_no = $item->pf_no;
															$memerData = $this->db->get_where('members',['pf_number'=>$pf_no])->row();
															if(!empty($memerData))
															{
																$name = $memerData->name;
															}
															
															// $credit = $item->total_credit;
															// $debit = $item->total_debit;
														?>
														<tr>
															
															<td><?= $sr;?></td>
															<td>
																<?php 
																	echo $item->pf_no." - ".$name; 
																?>
															</td>
															<td>
																<?php 
																	// $item->credit
																	if(!empty($credit))
																	{
																		// echo number_format($item->total_credit, 2, '.', '');
																		echo number_format($credit-$debit, 2, '.', '');
																	}
																	else 
																	{
																		echo "0.00";
																	}
																?>
															</td>
														</tr>
														<?php 
															$sr++;
														}
													?>
													<tr style="border-top:dotted;border-bottom:dotted;">
														<td></td>
														<td>
															<b><span>T O T A L (As on <?= date('31/03/2023')?>)</span></b>
														</td>
														<td><b><?php echo number_format($total_shares, 2, '.', ''); ?></b></td>
														<td></td>
													</tr>
												</tbody>
											</table>
											<br><br><br>
											
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