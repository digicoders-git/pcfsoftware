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
					
					<div class="content-body"><!-- Stats -->
						
						<div class="row match-height">
							<div class="col-md-12">
								<div class="card" >
									<div class="card-header">
										<!-- Filter Form Start Here-->
										<!-- Filter Form End Here-->
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body" id="printableArea">
											<h4 class="card-title" id="basic-layout-form-center">Share Account Testing
											</h4>
											<!--table start here -->
											<table style="width:100%">
												<thead style="border-top-style: dotted;border-bottom-style: dotted;">
													
													<th>DATE</th>
													<th>PF.NO.</th>
													<th>NAME</th>
													<th>PARTICULARS</th>
													<th>DEBIT</th>
													<th>CREDIT</th>
													<th>BALANCE</th>
												</thead>
												<tbody>
													
													<?php
														$sr=1;
														if(!empty($list))
														{
															$total_Debit_value =0; 
															$total_Credit_value =0; 
															
															foreach ($list as $item)
															{
																if(date('d-m-Y',strtotime($item->date_time)) != "01-04-2022"){
																	continue;
																	}else{
																	if($item == null){
																		continue;
																		}else{
																		$total_Debit_value += (float)$item->debit;
																		$total_Credit_value += (float)$item->credit;
																	}
																?>
																<tr>
																	
																	<td>
																		<?php 
																			$date_time =$item->date_time;
																			$date = date("d/m/Y",strtotime($date_time));
																			echo $date;
																		?>	
																	</td>
																	<td><?= $item->pf_no?></td>
																	<td>
																		<?php
																		
																		$pf_no = $item->pf_no;
																		$pf = $this->db->get_where('members',array('pf_number'=>$pf_no))->row();
																		if(!empty($pf))
																		{
																			echo $pf->name;
																		}
																		else 
																		{
																			echo "-";
																		}
																		
																	?>
																	</td>
																	<td>
																		<?php 
																			if($item->entry_type=="12B")
																			{
																				$districtcode = " -".$item->districtcode;
																				}else{
																				$districtcode = "";
																			}
																			echo $item->entrydesc.$districtcode;
																			
																		?>
																	</td>
																	<td>
																		<?php
																			// $item->debit
																			if(!empty($item->debit))
																			{
																				echo number_format($item->debit, 2, '.', '');
																			}
																			else 
																			{
																				echo "0.00";
																			}
																		?>
																	</td>
																	<td>
																		<?php 
																			// $item->credit
																			if(!empty($item->credit))
																			{
																				echo number_format($item->credit, 2, '.', '');
																			}
																			else 
																			{
																				echo "0.00";
																			}
																		?>
																	</td>
																	<td></td>
																	
																</tr>
																<?php 
																	$sr++;
																} 
															}
														}
													?>
													<tr style="border-top:dotted;border-bottom:dotted;">
														<td></td>
														
														<td colspan="3">
															<b><span>BALANCE (As on <?= '31/03/2023'?>)</span>	</b>
														</td>
														<td>
															<b><?php
																$debitSum = $total_Debit_value; 
																echo number_format($debitSum, 2, '.', '')." Dr";
															?></b>
														</td>
														<td>
															<b><?php
																$creditSum = $total_Credit_value; 
																echo number_format($creditSum, 2, '.', '')." Cr";
															?></b>
														</td>
														<td>
															<b><?php 
																// $balance = $debitSum-$creditSum;
																// echo number_format($balance, 2, '.', '')." Dr";
																
																if($debitSum>$creditSum){
																	$balance = $debitSum-$creditSum;
																	echo number_format($balance, 2, '.', '')." Dr";
																}
																else{
																	$balance = $creditSum-$debitSum;
																	echo number_format($balance, 2, '.', '')." Cr";
																}
															?></b>
														</td>
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