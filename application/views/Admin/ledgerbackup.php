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
										<form id="memberform" action="<?php echo base_url('Admin/SavingsAcLedger'); ?>" method="post">
											<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
											<div class="row justify-content-md-center">
												<div class="col-md-12">
													<div class="form-body">
														<div class="form-row">
															<div class="form-group col-md-3">
																<label class="col-form-label">From Date <span class="text-danger">*</span></label>
																<input type="date" value="<?php echo set_value('fromdate'); ?>" name='fromdate' class="form-control" required>
															</div>
															<div class="form-group col-md-3">
																<label class="col-form-label">To Date <span class="text-danger">*</span></label>
																<input type="date" value="<?php echo set_value('todate'); ?>" name="todate" class="form-control"  required>
															</div>
															<div class="form-group col-md-4">
																<label class="col-form-label">AGANIST GL-HEAD <span class="text-danger">*</span></label>
																<select id="disabledSelect" class="form-select form-control" name="entrycode" required>
																	<option <?php echo  set_select('entrycode', 'SAVACC'); ?>>SAVACC</option>
																</select>
															</div>
															<div class="form-group col-md-2">
																<div class="" style="margin-top:40px">
																	<button type="submit" class="btn" style="background-color:#4da7ff;color:white"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
																</div>
															</div>
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
													<p style="font-size:17px;"><span style="border-bottom-style:dotted">SUBSIDIARY - LEDGER PCF EMPL.COOP.Society Ltd.</span>  Dt. <?php echo date('d/m/Y'); ?> <span style="margin-left:200px;">Index No:
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
																$pfno = $this->db->get_where('members',array('pf_number'=>$pf))->row();
																echo $pfno->name;
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
															<th>DATE</th>
															<th>VTY</th>
															<th>VNO</th>
															<th>PARTICULARS</th>
															<th>Dr.</th>
															<th>Cr.</th>
															<th>BALANCE</th>
														</thead>
														<tbody>
															<?php
																$totaldebit =0;
																$totalcredit =0;
																$sr=1;
																foreach ($list as $item)
																{
																	$totaldebit+=(int)$item->debit;
																	$totalcredit+=(int)$item->credit;
																	
																?>
																<tr>
																	<td width="12%">		
																		<?php 
																			// echo $item->date_time
																			$date_time =$item->date_time;
																			$date = date("d/m/Y",strtotime($date_time));
																			echo $date;
																			
																		?>
																	</td>
																	<td width="12%"><?= $item->entry_type?></td>
																	<td width="12%"><?= $item->vno?></td>
																	<td width="24%">
																		<?php 
																			if($item->debit)
																			{
																				echo "TO ".$item->entrydesc;
																			}
																			else 
																			{
																				echo "BY ".$item->entrydesc;
																			}
																		?>
																		<!--<?//= $item->entrydesc?>-->
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
																	<td width="10%"></td>
																</tr>
																<?php 
																	$sr++;
																}
															?>
															<tr style="border-top:dotted;border-bottom:dotted;">
																<td colspan="3">
																	<span>T O T A L = (As on <?php echo date('d/m/Y');?>)</span>	
																</td>
																<td></td>
																<td>
																	<? echo number_format($totaldebit, 2, '.', '');?>
																</td>
																<td>
																	<? echo number_format($totalcredit, 2, '.', '');?>
																</td>
																<td>
																	<? echo number_format($totaldebit-$totalcredit, 2, '.', '');?>	
																</td>
															</tr>
														</tbody>
													</table><br><br><br></div>
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