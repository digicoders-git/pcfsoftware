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
					</div>
				</div>
				<!--extra added here-->
				<div class="content-body" >
					<!-- Stats -->
					<div class="row match-height">
						<div class="col-md-12">
							<div class="card" id="printableArea">
								<div class="card-header">
									<h4 class="card-title" id="basic-layout-form-center">Today Entries <span> (As on <?php echo date('d/m/Y');?>)</span></h4>
									<br>
								</div>
								<div class="card-content collapse show " style="margin-top:-40px;">
									<div class="card-body">
										<!--table start here -->
										<table style="width:100%">
											<thead style="border-top-style: dotted;border-bottom-style: dotted;">
												<th>V.NO.</th>
												<th>V-TYPE</th>
												<th>DATE</th>
												<th>PF Number</th>
												<th>Name</th>
												<th>Entry Code</th>
												<th>Entry Description</th>
												<th>Debit</th>
												<th>Credit</th>
											</thead>
											<tbody>
												<?php
													$sr=1;
													foreach ($list as $item)
													{
													?>
													<tr>
														<td><?= $item->vno?></td>
														<td><?= $item->entry_type?></td>
														<td>
															<?php 
																// echo $item->date_time
																$date_time =$item->date_time;
																$date = date("d/m/Y",strtotime($date_time));
																echo $date;
															?>	
														</td>
														<td>
															<?php
																if(!empty($item->pf_no))
																{
																	echo $item->pf_no;
																}
																else 
																{
																	echo "-";
																}	
															?>
														</td>
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
														<td><?= $item->entrycode?></td>
														<td><?= $item->entrydesc?></td>
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
													</tr>
													<?php 
														$sr++;
													}
												?>
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