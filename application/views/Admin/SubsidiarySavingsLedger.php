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
			margin-left: 450px;
			margin-top: 10px;
			margin-bottom: 10px;
			}
			@media print{
			#print_btn
			{display:none;}
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
						<h5><a href="<?= base_url($this->data->controller); ?>/Dashboard"><?= $this->data->title; ?></a> / SUBSIDIARY SAVINGS LEDGER </h5>
					</div>
				</div>
				<!--extra added here-->
				<div class="content-body">
					<!-- Stats -->
					<div class="row match-height">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title" id="basic-layout-form-center">SUBSIDIARY SAVINGS LEDGER <span> (As on <?php echo date('31/03/2023');?>)</span></h4>
									<hr>
								</div>
								<div class="card-content collapse show " style="margin-top:-40px;">
									<div class="card-body">
										<!--Form start here -->
										<form id="memberform" action="<?php echo base_url('Admin/SubsidiarySavingsLedger'); ?>" method="post">
											<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
											<div class="row justify-content-md-center">
												<div class="col-md-12">
													<div class="form-body">
														<div class="form-row">
															<?php
																// $fromdate= "2022-04-01";
																// $newtodate= "2023-03-31";
															?>
															<div class="form-group col-md-2">
																<label class="col-form-label">From Date <span class="text-danger">*</span></label>
																<input type="date" value="<?php if(!empty($start))
																	{
																		echo $start;
																	}?>" name='fromdate' class="form-control" required>
															</div>
															<div class="form-group col-md-2">
																<label class="col-form-label">To Date <span class="text-danger">*</span></label>
																<input type="date" value="<?php if(!empty($newtodate))
																	{
																		echo $newtodate;
																	}?>" name="todate" class="form-control"  required>
															</div>
															
															<div class="form-group col-md-2">
																<div class="" style="margin-top:40px">
																	<button type="submit" class="btn" style="background-color:#4da7ff;color:white"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
																</div>
															</div>
															
															<div class="form-group col-md-4"></div>
														</div>
													</div>
												</div>
											</div>
										</form>
										<div id="printableArea">
											<table style="width:100%">
												<thead style="border-top-style: dotted;border-bottom-style: dotted;">
													<th width="10%">S.NO.</th>
													<th>PF Number</th>
													<th style="text-align: left;" width="5%">Savings</th>
													<th></th>
												</thead>
											</table>
											<!--form end here -->
											<?php 
												if($status=='true')
												{
													$srno = 1;
													$totalTot = 0;
													foreach($list_members as $member)
													{
														
														$pf_no=$member->pf_number;
														
														$query = $this->db->query("SELECT * FROM tbl_entry WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$start' and '$newtodate' ORDER BY date_time ASC, entry_type ASC");
														
														
														if($query->num_rows()>0)
														{
														?>
														
														<!--table start here -->
														<table style="width:100%">
															
															<tbody>
																<?php
																	// $TOTALSAVINGS = array();
																	$totalsum = 0;
																	// $totalTot = 0;
																	$interest = 0;
																	
																	$saving_interest =0;
																	$totaldebit =0;
																	$totalcredit =0;
																	$sr=1;
																	$list=$query->result();
																	$total_item=count($list);
																	
																	$total_days=0;
																	for($i=0; $i<$total_item; $i++)
																	{
																		// for saving interest 
																		$item=$list[$i];
																		$j=$i+1;
																		
																		$memberdata = $this->db->get_where('members',['pf_number'=>$item->pf_no])->row();
																		
																		$saving_interest =$memberdata->saving_interest;
																		
																		$totaldebit+=(float)$item->debit;
																		$totalcredit+=(float)$item->credit;
																		
																		$total = $totaldebit-$totalcredit;
																		
																		$date1 = $item->date_time;
																		
																		// $date2 = "2023-03-31";
																		$date2 = $newtodate;
																		
																		if($j<$total_item) {
																			$item1=$list[$j];
																			$date2 =$item1->date_time;
																		}
																		
																		$date1=date_create($date1);
																		$date2=date_create($date2);
																		
																		$diff=date_diff($date1,$date2);
																		
																		$day = $diff->format("%a");		
																		if($i==0) {
																			$day=$day+1;
																		}
																		
																		$total_days=$total_days+$day;
																		
																	?>
																	
																	
																	
																	<?php
																		if($totaldebit>$totalcredit)
																		{
																			//echo number_format(abs($total), 2, '.', '')." Dr.";
																			
																		}
																		elseif($totalcredit>$totaldebit)
																		{
																			//echo number_format(abs($total), 2, '.', '')." Cr."; 
																			$interest = ($total*$day*7)/36500;
																			$totalsum += $interest;
																		}
																		$interest1=number_format($interest, 2, '.', '');
																		
																	?>	
																	
																	
																	<?php 
																		$sr++;
																	}
																?>
																<tr>
																	
																	<td colspan="1" style="text-align: right;">
																		<?php
																			
																			
																			$final_interest=number_format($totalsum, 2, '.', '');
																			
																			
																			$saving_interest=$final_interest;
																			// echo sprintf('%0.2f', abs($saving_interest));
																		?>	
																	</td>
																</tr>
																
																
																<!--table start here -->
																<table style="width:100%">
																	
																	<tbody>
																		
																		<tr>
																			<td width="10%"><?= $srno;?></td>
																			<td>
																				<?php 
																					echo $member->pf_number." - ".$member->name; 
																				?>
																			</td>
																			<td style="text-align: right;" width="5%">
																				
																	<?php
																	
																		if(($totaldebit>$totalcredit) || ($totalcredit>$totaldebit))
																		{
																			$tot = ($totaldebit-$totalcredit)+$saving_interest;
																			echo number_format(abs($tot), 2, '.', ''); 
																			
																			$totalTot += $tot;
																			// echo $totalTot;
																		}
																		// elseif($totalcredit>$totaldebit)
																		// {
																		// $tot = ($totaldebit-$totalcredit)+$saving_interest;
																		// echo number_format(abs($tot), 2, '.', '');
																		// $totalTot += $tot;
																		// }
																		elseif($totalcredit==$totaldebit)
																		{
																			echo "0.00";	
																		}
																		else
																		{
																			echo "0.00";
																		}
																		
																	?>
																			</td>
																			<td></td>
																		</tr>
																		
																		
																	</tbody>
																</table>
																<!--table end here -->
																
															</tbody>
														</table>
														<?php
															$srno++;
														}
														else 
														{
															
														}
													}
													
												?>
												<!--<button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" id="print_btn"><i class="fa fa-print noPrint"></i> Print</button>-->
												<?php
													
												}
											?>
											
										</div>
										<!--table end here -->
										
										
										<table style="width:100%">
											
											<tbody>
												<tr style="border-top:dotted;border-bottom:dotted;">
													<td></td>
													<td>
														<b><span>T O T A L (As on 
															<?php
															if(!empty($newtodate)){
																$date = date('d/m/Y',strtotime($newtodate));
																echo $date;
															}else{
															echo "";
															}
															;?>)</span></b>
													</td>
													<td width="5%"><b>
														<?php
														if(!empty($totalTot)){
															echo number_format(abs($totalTot), 2, '.', '');
														}else{
														echo "0.00";
														}?>
															</b></td>
													<td></td>
												</tr>
											</tbody>
										</table>
										
										
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
		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}	
		
	</script>
</html>																					