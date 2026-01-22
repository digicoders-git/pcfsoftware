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
									<h4 class="card-title" id="basic-layout-form-center">Loan Ac Ledger</h4>
									<hr>
								</div>
								<div class="card-content collapse show " style="margin-top:-40px;">
									<div class="card-body">
										<!--Form start here -->
										<form id="memberform" action="<?php echo base_url('Admin/LoanAcLedger'); ?>" method="post">
											<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
											<div class="row justify-content-md-center">
												<div class="col-md-12">
													<div class="form-body">
														<div class="form-row">
															<?php
																$fromdate= "2024-04-01";
																$todate= "2025-03-31";
																// $todate= "2023-05-31";
															?>
															<div class="form-group col-md-2">
																<label class="col-form-label">From Date <span class="text-danger">*</span></label>
																<input type="date" value="<?php echo $fromdate; ?>" name='fromdate' class="form-control" required>
															</div>
															<div class="form-group col-md-2">
																<label class="col-form-label">To Date <span class="text-danger">*</span></label>
																<input type="date" value="<?php if(!empty($newtodate))
																	{
																		echo $newtodate;
																	} else { echo $todate; }?>"  name="todate" class="form-control"  required>
															</div>
															<div class="form-group col-md-2">
																<label class="col-form-label">AGANIST GL-HEAD <span class="text-danger">*</span></label>
																<select id="disabledSelect" class="form-select form-control" name="entrycode" required>
																	<option <?php echo  set_select('entrycode', 'LONACC'); ?>>LONACC</option>
																</select>
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
										<!--form end here -->
										<div id="printableArea">
											<?php 
												if($status=='true')
												{
													$srno = 1;
													foreach($list_members as $member)
													{
														$pf_no=$member->pf_number;
														
														$query = $this->db->query("SELECT * FROM tbl_entry WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$start' and '$newtodate' ORDER BY date_time ASC, entry_type ASC");
														
														if($query->num_rows()>0)
														{
														?>
														<p style="font-size:17px;"><span style="border-bottom-style:dotted">SUBSIDIARY - LEDGER PCF EMPL.COOP.Society Ltd.</span><?//php echo date('d/m/Y'); ?><span style="margin-left:370px;">Index No:
															<?php
																// echo $member->id;
																echo $srno;
															?>
														</span>
														</p>
														<span>G.L.Head : 
															<?php
																echo "<b>".$entrycode."</b>";
															?>
														</span>
														<span style="margin-left:260px"><b>S.L.DESCR :  
															<?php 
																echo strtoupper($member->name);
															?>
															<?php
																echo ", ".$member->pf_number."</b>";
															?>
														</span>
														<!--
															<span>
															<?//= $start ?> : 
															<?//= $newtodate ?> : 
															</span>
														-->
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
																	
																	$list=$query->result();
																	
																	$total_item=count($list);
																	// var_dump($total_item);die();
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
																		
																		// if($newtodate > '2023-03-31')
																		// {
																		// $total = $member->lfy_loan;
																		// var_dump($total);
																		// }
																		// else 
																		// {
																		// $total = $totaldebit-$totalcredit;
																		// }
																		
																		$total = $totaldebit-$totalcredit;
																		
																		$date1 = $item->date_time;
																		
																		$date2 = $newtodate;
																		
																		if($j<$total_item) 
																		{
																			$item1=$list[$j];
																			$date2 =$item1->date_time;
																		}
																		
																		$date1=date_create($date1);
																		$date2=date_create($date2);
																		
																		if($date1 == false || $date2 == false){
																			continue;
																			}else{
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
																					// echo $item->date_time
																					$date_time =$item->date_time;
																					$date = date("d/m/Y",strtotime($date_time));
																					echo $date;
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
																					// $item->debit
																					
																					// if($newtodate > '2023-03-31')
																					// {
																					// $total1 = $member->lfy_loan;
																					// var_dump($total1);
																					// }
																					// else
																					// {
																					
																					// if(!empty($item->debit))
																					// {
																					// echo number_format($item->debit, 2, '.', '');
																					// }
																					// else 
																					// {
																					// echo "0.00";
																					// }
																					// }
																					
																					
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
																			<td width="15%" style="text-align: right;">
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
																				?>&ensp;
																			</td>
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
																						// $interest = 0;
																						// $totalsum += $interest;
																					}
																					
																					$interest1=number_format($interest, 2, '.', '');
																					// per month interest here
																					// echo "(<u>$interest1</u>)";
																					
																				?>	
																			</td>
																		</tr>
																		<?php 
																			$sr++;
																		}
																		// end 
																	}
																?>
																<tr>
																	<td colspan="2">
																	</td>
																	<td colspan="1">
																		<?php
																			// var_dump($newtodate);
																			$newtodate1 = date('d/m/Y',strtotime($newtodate));
																			echo $newtodate1;
																		?>
																	</td>
																	
																	<td colspan="3" >
																		TO. AMT. Intt. Yr. 
																		<?php 
																			// if (date('m') <= 3) { 
																			// echo $financial_year = (date('Y')-1) . '-' . date('Y');
																			// } else {
																			// echo $financial_year = date('Y') . '-' . (date('Y') + 1);
																			// }
																			echo "2023-2024";
																		?>
																		&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
																		<?php
																			$final_interest=number_format($totalsum, 2, '.', '');
																			
																			// this code is update loan_interest
																			
																			//$this->db->where('pf_number', $item->pf_no)->update('members',array('loan_interest2'=>$final_interest));
																			
																			// this interest is loan_interest to members table 
																			$totalinterest=$final_interest;
																			
																			echo $totalinterest;
																		?>	
																	</td>
																	
																	</tr>
																<tr style="border-top:dotted;border-bottom:dotted;">
																	<td colspan="3">
																		<b><span>T O T A L = (As on <?php echo date('31/03/2024');?>)</span></b>	
																	</td>
																	<td>
																	</td>
																	<td>
																	</td>
																	<td>
																	</td>
																	<td style="text-align: right;">
																		<b><?php
																			if($totaldebit>$totalcredit)
																			{
																				$tot = ($totaldebit-$totalcredit)+$totalinterest;
																				echo number_format(abs($tot), 2, '.', '')." Dr."; 
																				// echo $totalint = number_format(abs(($totaldebit-$totalcredit)+$totalinterest), 2, '.', '')." Dr."; 
																				
																				// $this->db->where('pf_number', $item->pf_no)->update('members',array('lfy_loan_dr'=>abs($tot)));
																				
																				
																				// closing ko opening bnane ke liye
																				
																				
																				// $entryData1 = [
																				// 'pf_no' => $member->pf_number,
																				// 'entrycode' => 'LONACC',
																				// 'entrydesc' => 'TO OP.BAL. B/F 01/04/2025',
																				// // 'debit' => $this->input->post('loan'),
																				// 'debit' => number_format(abs($tot), 2, '.', ''),
																				// 'date_time' => '2025-04-01',
																				// 'created_at' => $this->data->timestamp
																				// ];
																				
																				// $InsertData1 = $this->security->xss_clean($entryData1);
																				// $this->db->insert('tbl_entry', $InsertData1);
																				
																				
																			}
																			else
																			{
																				
																				$tot = ($totalcredit-$totaldebit)-$totalinterest;
																				echo number_format(abs($tot), 2, '.', '')." Cr."; 
																				// echo $totalint = number_format(abs(($totaldebit-$totalcredit)+$totalinterest), 2, '.', '')." Cr."; 
																				
																				// $this->db->where('pf_number', $item->pf_no)->update('members',array('lfy_loan_cr'=>abs($tot)));
																				
																				
																				// closing ko opening bnane ke liye
																				
																				
																				// $entryData1 = [
																				// 'pf_no' => $member->pf_number,
																				// 'entrycode' => 'LONACC',
																				// 'entrydesc' => 'TO OP.BAL. B/F 01/04/2025',
																				// // 'debit' => $this->input->post('loan'),
																				// 'credit' => number_format(abs($tot), 2, '.', ''),
																				// 'date_time' => '2025-04-01',
																				// 'created_at' => $this->data->timestamp
																				// ];
																				
																				// $InsertData1 = $this->security->xss_clean($entryData1);
																				// $this->db->insert('tbl_entry', $InsertData1);
																				
																				
																			}
																			
																		?></b>
																	</td>
																</tr>
															</tbody>
														</table>
														<br><br><br>
														<?php
															$srno++;
														}
														else 
														{
															/*
																?>
																<center>
																<p><img src="<?= base_url()?>/uploads/no.gif" style="width:55%;"/></p>
																</center>
																<?php 
															*/
														} 
														}
													?>
													<!-- Print Button Start Here -->
													<button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" id="print_btn"><i class="fa fa-print noPrint"></i> Print</button>
													<!-- Print Button End Here -->
													<?php
													}
												?>
											</div>
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