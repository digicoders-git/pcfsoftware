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
										<form method="post" action="<?=base_url($this->data->controller.'/'.$this->data->method)?>">
											<span><b>From</b></span> &ensp;<input type="date" name='fromdate' value="<?php if(!empty($fromdatenew))
												{
													echo $fromdatenew;
												}?>"> &ensp;&ensp;<span><b>To</b></span> &ensp;<input type="date" name="todate" value="<?php if(!empty($enddatenew))
												{
													echo $enddatenew;
												}?>"> &emsp;<button class="btn btn-md btn-success"> <i class="fa fa-filter"></i> Filter</button>
										</form><br>
										<!-- Filter Form End Here-->
										
									</div>
									<div class="card-content collapse show " style="margin-top:-40px;">
										<div class="card-body" id="printableArea">
											<h4 class="card-title" id="basic-layout-form-center">All Entries
											</h4>
											<!--table start here -->
											<table style="width:100%">
												<thead style="border-top-style: dotted;border-bottom-style: dotted;">
													<th>V.NO.</th>
													<th>V-TYPE</th>
													<th>DATE</th>
													<th>PF Number</th>
													<th>Name</th>
													<th>District</th>
													<th>Entry Code</th>
													<th>Entry Description</th>
													<th style="text-align: right;">Debit</th>
													<th style="text-align: right;">Credit &ensp;</th>
													<th>Action</th>
												</thead>
												<tbody>
													<?php
														// echo "<pre>";
														// print_r($list);
														// die();
														$sr=1;
														if(!empty($list))
														{
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
																<td>
																<?php 
																	if(!empty($item->districtcode))
																		{
																			echo $item->districtcode;
																		}
																		else 
																		{
																			echo "-";
																		}
																?>
																</td>
																<td><?= $item->entrycode?></td>
																<td><?= $item->entrydesc?></td>
																<td style="text-align: right;">
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
																<td style="text-align: right;">
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
																<!-- Edit Start Here-->
																<td>
																	<a href="javascript:void(0);" class="action_btn mr_10" onclick="Edit('<?= $item->id; ?>')"> <i class="fa fa-edit text-primary"></i> </a>
																	
																	<!-- Delete Code Start Here -->
																	<a href="javascript:void(0);"  class="btn btn-sm btn-outline-danger waves-effect waves-light" onclick="return Delete(this,'<?= $this->data->table; ?>','id','<?= $item->id; ?>')"> <i class="fa fa-trash"></i> </a>
																	<!-- Delete Code End Here -->
																</td>
																<!-- Edit End Here-->
																
															</tr>
															<?php 
																$sr++;
															} 
														}
													?>
													
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
		
		<!--Modal Start Edit Modal-->
		<div class="modal fade" id="EditModal">
			<div class="modal-dialog">
				<div class="modal-content border-primary">
					<div class="modal-header p-1" style="background-color:#4da7ff">
						<h5 class="modal-title text-white">Edit <?= $this->data->key; ?></h5>
						<button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form action="<?php echo base_url($this->data->controller . '/' . $this->data->method . '/Update'); ?>" method="post" enctype="multipart/form-data" id="updateForm">
						<div class="modal-body">
							
						</div>
						<div class="modal-footer d-block p-1">
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
							<button type="submit" class="btn" style="background-color:#4da7ff;color:white" id="updateBtn"> <i class="fa fa-check-circle"></i> Update <i class="fa fa-spin fa-spinner" id="updateSpin" style="display:none;"></i></button>
						</div>
					</form>
					
				</div>
			</div>
		</div>
		<!--Modal Edit Modal End-->
		
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