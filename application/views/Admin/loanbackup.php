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
			margin-top: -30px;
			margin-bottom: 0px;
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
					</div>
				</div>
				<!--extra added here-->
				<div class="content-body">
					<!-- Stats -->
					<div class="row match-height">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title" id="basic-layout-form-center">Loan</h4>
									<hr>
								</div>
								<div class="card-content collapse show " style="margin-top:-40px;">
									<div class="card-body">
										<!--Form start here -->
										<form id="memberform" action="<?php echo base_url('Admin/Loan'); ?>" method="post">
											<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
											<div class="row justify-content-md-center">
												<div class="col-md-12">
													<div class="form-body">
														<div class="form-row">
															<div class="form-group col-md-2">
																<label class="col-form-label">PF Number <span class="text-danger">*</span></label>
																<input type="text" class="form-control" minlength="6" maxlength="6" name="pf_no" placeholder="PF Number" value="<?php echo set_value('pf_no'); ?>" required>
															</div>
															
															<div class="form-group col-md-2">
																<label class="col-form-label">AGANIST GL-HEAD <span class="text-danger">*</span></label>
																<select id="disabledSelect" class="form-select form-control" name="entrycode" required>
																	<option <?php echo  set_select('entrycode', 'LONACC'); ?>>LONACC</option>
																</select>
															</div>
															
															<?php 
																
																$inputDate=date("Y-m-d");
																$format="Y";
																$year1=0;
																$year2=0;
																$date=date_create($inputDate);
																if (date_format($date,"m") >= 4) {//On or After April (FY is current year - next year)
																	$year1 = date_format($date,$format);
																	$year2 = date_format($date,$format)+1;
																	} else {//On or Before March (FY is previous year - current year)
																	$year1 = date_format($date,$format)-1;
																	$year2 = date_format($date,$format);
																}
																
																$fromdate= "2022-04-01";
																// $fromdate= $year1."-04-01";
																// $todate= $year2."-03-31";
																// $todate= $newtodate;
															?>
															<div class="form-group col-md-2">
																<label class="col-form-label">From Date <span class="text-danger">*</span></label>
																<input type="date" value="<?php echo $fromdate; ?>" name="date1" class="form-control"  required>
															</div>
															
															
															<div class="form-group col-md-2">
																<label class="col-form-label">To Date <span class="text-danger">*</span></label>
																<input type="date" name="date2" value="<?php if(!empty($newtodate))
																	{
																		echo $newtodate;
																	}?>"  class="form-control"  required>
															</div>
															
															<div class="form-group col-md-2">
																<div class="" style="margin-top:40px">
																	<button type="submit" class="btn searchbtn" style="background-color:#4da7ff;color:white"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
																</div>
															</div>
															<div class="form-group col-md-6"></div>
														</div>
													</div>
												</div>
											</div>
										</form>
										<!--form end here -->
										<?php 
											if($status=='true'){
												if(!empty($list))
												{
												?>
												<div id="printableArea">
													<p style="font-size:17px;"><span style="border-bottom-style:dotted">SUBSIDIARY - LEDGER PCF EMPL.COOP.Society Ltd.</span>   <?//php echo date('d/m/Y'); ?> <span style="margin-left:370px;">Index No:
														<?php
															$pf = $list1->pf_no;
															$indexno = $this->db->get_where('members',array('pf_number'=>$pf))->row();
															echo $indexno->id;
														?>
													</span>
													</p>
													<span>G.L.Head : 
														<?php 
															if(!empty($list1->entrycode))
															{
																echo "<b>".$list1->entrycode."</b>";
															}else
															{
																echo "...";
															}
														?>
													</span>
													
													<span style="margin-left:260px"><b>S.L.DESCR :  
														<?php 
															if(!empty($list1->pf_no))
															{
																$pf = $list1->pf_no;
																$name = $this->db->get_where('members',array('pf_number'=>$pf))->row();
																echo strtoupper($name->name);
															}
															else 
															{
																echo "...";
															}
														?>
														<?php 
															if(!empty($list1->pf_no))
															{
																echo ", ".$list1->pf_no."</b>";
															}
															else
															{
																echo "...";
															}	
														?>
													</span>
													<!--table start here -->
													<table style="width:100%">
														<thead style="border-top-style: dotted;border-bottom-style: dotted;">
															<th>V.NO.</th>
															<th>V-TYPE</th>
															<th>DATE</th>
															<th>PARTICULARS</th>
															<th style="text-align: right;">Dr.</th>
															<th style="text-align: right;">Cr. &ensp;</th>
															<th style="text-align: right;">BALANCE</th>
														</thead>
														<tbody>
															
															<?php
																$totalsum = 0;
																$interest = 0;
																$totalinterest =0;
																$totaldebit =0;
																$totalcredit =0;
																$sr=1;
																// foreach ($list as $item)
																$total_item=count($list);
																$total_days=0;
																for($i=0; $i<$total_item; $i++)
																{
																	$item=$list[$i];
																	$j=$i+1;
																	
																	$memberdata = $this->db->get_where('members',['pf_number'=>$item->pf_no])->row();
																	
																	// total interest for loan interest 
																	$totalinterest = $memberdata->loan_interest;
																	
																	$totaldebit+=(float)$item->debit;
																	$totalcredit+=(float)$item->credit;
																	
																	$total = $totaldebit-$totalcredit;
																	
																	$date1 = $item->date_time;
																	// $date2 = "2023-03-31";
																	$date2 = $newtodate;
																	
																	// $date2 = date('Y-m-d');
																	
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
																	// echo $total_days;
																?>
																<tr>
																	<td width="12%"><?= $item->vno?></td>
																	<td width="12%"><?= $item->entry_type?></td>
																	<td width="12%">		
																		<?php 
																			
																			$date_time =$item->date_time;
																			$date = date("d/m/Y",strtotime($date_time));
																			echo $date;
																			// echo "(<b>$day</b>)";
																		?>
																	</td>
																	<td width="24%">
																		<?php 
																			if($item->entry_type=="12B")
																			{
																				$val = $item->districtcode;
																			}
																			else
																			{  
																				$val = "";
																			}
																			if($item->debit)
																			{
																				echo $item->entrydesc." - ".$val;
																				
																			}
																			else 
																			{
																				echo $item->entrydesc." - ".$val;
																				
																			}
																		?>
																	</td>
																	<td width="15%" style="text-align: right;">
																		<?php 
																			if(!empty($item->debit))
																			{
																				echo number_format(abs($item->debit), 2, '.', '');
																			}
																			else 
																			{
																				echo "0.00";
																			}
																		?>	
																	</td>
																	<td width="15%" style="text-align: right;">
																		<?php 
																			if(!empty($item->credit))
																			{
																				echo number_format(abs($item->credit), 2, '.', '');
																			}
																			else 
																			{
																				echo "0.00";
																			}
																		?>&ensp;
																	</td>
																	
																	<!-- This Code Is Balance Start per month interest here -->
																	
																	<td width="10%" style="text-align: right;">
																		<?php
																			
																			if($totaldebit>$totalcredit)
																			{
																				echo number_format(abs($total), 2, '.', '')." Dr.";
																				
																				$interest = ($total*$day*9)/36500;
																				$totalsum += $interest;
																			}
																			else
																			{
																				echo number_format(abs($total), 2, '.', '')." Cr."; 
																			}
																			
																			
																			$interest1=number_format($interest, 2, '.', '');
																			// per month interest here
																			// echo "(<u>$interest1</u>)";
																			
																		?>	
																	</td>
																	<!-- This Code Is Balance End -->
																	
																	
																</tr>
																<?php 
																	$sr++;
																}
															?>
															
															<tr>
																<td colspan="2">
																</td>
																<td colspan="1">
																	
																	<?php
																		$newtodate1 = date('d/m/Y',strtotime($newtodate));
																		echo $newtodate1;
																	?>
																</td>
																<td colspan="3">
																	TO. AMT. Intt. Yr. 
																	<?php
																		echo "2022".'-'.'2023';
																		// if (date('m') <= 3) { 
																		// echo $financial_year = (date('Y')-1) . '-' . date('Y');
																		// } else {
																		// echo $financial_year = date('Y') . '-' . (date('Y') + 1);
																		// }
																		
																	?>
																	&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
																	<?php
																		
																		// $final_interest=number_format($totalsum, 2, '.', '');
																		// echo "(<b>$final_interest - $total_days </b>)";
																		
																		$final_interest=number_format(abs($totalsum), 2, '.', '');
																		
																		
																		// this interest is loan_interest from members table 
																		
																		$totalinterest=$final_interest;
																		
																		echo $totalinterest;
																		
																	?>	
																</td>
																
															</tr>
															
															<tr style="border-top:dotted;border-bottom:dotted;">
																<td colspan="3">
																	<span>T O T A L = (As on 
																		<?php echo $newtodate;
																		?>)</span>	
																</td>
																<td>
																	
																</td>
																<td>
																	
																</td>
																<td>
																	
																</td>
																<td style="text-align: right;">
																	<!-- This Code is Total Balance Print Here -->
																	<b style="font-size:15px"><?php
																		if($totaldebit>$totalcredit)
																		{
																			echo number_format(abs(($totaldebit-$totalcredit)+$totalinterest), 2, '.', '')." Dr."; 
																		}
																		else
																		{
																			echo number_format(abs(($totaldebit-$totalcredit)+$totalinterest), 2, '.', '')." Cr."; 
																		}
																	?>
																	</b>	
																</td>
															</tr>
														</tbody>
													</table>
													<br><br><br>
													</div>
													<!-- Print Button Start Here -->
													<button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" id="print_btn"><i class="fa fa-print noPrint"></i> Print</button>
													<!-- Print Button End Here -->
													<?php
													}
													else 
													{
													?>
													<center>
														<p><img src="<?= base_url()?>/uploads/no.gif" style="width:55%;"/></p>
													</center>
													<?php 
													}
												}
											?>
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
		<script>
			function printDiv(divName) {
				var printContents = document.getElementById(divName).innerHTML;
				var originalContents = document.body.innerHTML;
				document.body.innerHTML = printContents;
				window.print();
				document.body.innerHTML = originalContents;
			}
			
			// $(".searchbtn").on("click", function (e) { 
			// location.reload().delay(1000);
			// });
		</script>																																	