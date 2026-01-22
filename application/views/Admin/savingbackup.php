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
									<h4 class="card-title" id="basic-layout-form-center">Savings</h4>
									<hr>
								</div>
								<div class="card-content collapse show " style="margin-top:-40px;">
									<div class="card-body">
										<!--Form start here -->
										<form id="memberform" action="<?php echo base_url('Admin/Savings'); ?>" method="post">
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
																	<option <?php echo  set_select('entrycode', 'SAVACC'); ?>>SAVACC</option>
																</select>
															</div>
															
															<!-- Start Here -->
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
															<!-- End Here -->
															
															
															<div class="form-group col-md-2">
																<div class="" style="margin-top:40px">
																	<button type="submit" class="btn" style="background-color:#4da7ff;color:white"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
																</div>
															</div>
															<div class="form-group col-md-6">
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--<div class="form-actions center">
												<button type="submit" class="btn" style="background-color:#4da7ff;color:white" id="addBtn"> <i class="fa fa-check-circle"></i> Submit <i class="fa fa-spin fa-spinner" id="addSpin" style="display:none;"></i></button>
												
											</div>-->
										</form>
										<!--form end here -->
										<!--<h5><b>PCF EMPL.Coop.Society Ltd.32,Station Road Lucknow.</b></h5>-->
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
															}else
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
															<th>Dr.</th>
															<th>Cr.</th>
															<th>BALANCE</th>
														</thead>
														<tbody>
															<?php
																// $saving_interest =0;
																// $totaldebit =0;
																// $totalcredit =0;
																// $sr=1;
																// foreach ($list as $item)
																// {
																	// $memberdata = $this->db->get_where('members',['pf_number'=>$item->pf_no])->row();
																	// $saving_interest =$memberdata->saving_interest;
																	
																	// $totaldebit+=(float)$item->debit;
																	// $totalcredit+=(float)$item->credit;
																	
																	
																?>
																
																<?php
																$saving_interest =0;
																$totalsum = 0;
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
																	
																	$saving_interest =$memberdata->saving_interest;
																	
																	// total interest for loan interest 
																				
																	$totaldebit+=(float)$item->debit;
																	$totalcredit+=(float)$item->credit;
																	
																	// $total = $totaldebit-$totalcredit;
																	// $total1 = $totalcredit-$totaldebit;
																	
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
																	<td width="15%">
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
																	<td width="15%">
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
																	<td width="10%">
																		<?php
																			if($totaldebit>$totalcredit)
																			{
																			// $total = $totaldebit-$totalcredit;
																			// $totalcredit;
																				echo number_format($totalcredit, 2, '.', '')." Dr."; 
																				}
																			elseif($totalcredit>$totaldebit)
																			{
																			// $total = $totalcredit-$totaldebit;
																				echo number_format($totalcredit, 2, '.', '')." Cr."; 
																			}
																			
																			$interest = ($totalcredit*$day*7)/36500;
																			$totalsum += $interest;
																			
																			$interest1=number_format($interest, 2, '.', '');
																		
																			// echo "(<u>$interest1</u>)";
																			
																		?>	
																	</td>  
																	
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
																		
																		// $date_time =$item->date_time;
																		// $date = date('t/m/Y', strtotime('+1 month', strtotime($date_time)));
																		// echo $date;
																		
																		$newtodate = date('d/m/Y',strtotime($newtodate));
																			echo $newtodate;
																	?>
																</td>
																<td colspan="3">
																	TO. AMT. Intt. Yr. 
																	<?php 
																		if (date('m') <= 3) {//Upto March 
																			echo $financial_year = (date('Y')-1) . '-' . date('Y');
																			} else {//After 
																			echo $financial_year = date('Y') . '-' . (date('Y') + 1);
																		}
																		
																	?>
																	&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
																	<?php
																		
																		// $final_interest=number_format($totalsum, 2, '.', '');
																		// echo "(<b>$final_interest - $total_days </b>)";
																		
																		
																		// this code is saving_interest from members table 
																		$final_interest=number_format($totalsum, 2, '.', '');
																		
					$this->db->where('pf_number', $item->pf_no)->update('members',array('saving_interest'=>$final_interest));
																		$saving_interest=$final_interest;
																		echo $saving_interest;
																	?>	
																</td>
															</tr>
															
															
															<tr style="border-top:dotted;border-bottom:dotted;">
																<td colspan="3">
																	<span>T O T A L = (As on <?php echo $newtodate;?>)</span>	
																</td>
																<td>
																	
																</td>
																<td>
																	
																</td>
																<td>
																	
																</td>
																<td>
																	<?php
																		if($totaldebit>$totalcredit)
																		{
																			echo number_format(($totalcredit)+$totalsum, 2, '.', '')." Dr."; 
																		}
																		elseif($totalcredit>$totaldebit)
																		{
																			echo number_format(($totalcredit)+$totalsum, 2, '.', '')." Cr."; 
																		}
																		elseif($totalcredit==$totaldebit)
																		{
																			echo "NILL";	
																		}
																		else
																		{
																			echo "0.00";
																		}
																	?>	
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