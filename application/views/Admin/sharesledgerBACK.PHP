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
										<h4 class="card-title" id="basic-layout-form-center">Shares Ledger <span> (As on <?php echo date('31/03/2023');?>)</span></h4>
										<br>
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
														// for saving interest all members 
															if(!empty($item->shares))
															{
																$total_shares+=$item->shares;
															}
														?>
														<tr>
															
															<td><?= $sr;?></td>
															<td>
																<?php 
																	echo $item->pf_number." - ".$item->name; 
																?>
															</td>
															<td>
																<?php 
																	// $item->credit
																	if(!empty($item->shares))
																	{
																		echo number_format($item->shares, 2, '.', '');
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