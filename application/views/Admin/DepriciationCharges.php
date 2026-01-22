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
						<h5><a href="<?= base_url($this->data->controller); ?>/Dashboard"><?= $this->data->title; ?></a> / DEPRICIATION CHARGES</h5>
					
                        
                        <br/>

                        <!--Form start here -->
                        <form action="<?php echo base_url('Admin/DepriciationCharges'); ?>" method="post">

                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                 
                                 <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                       <div class="form-body">

                                          <div class="form-row">
                                            
                                            <div class="form-group col-md-2">
                                                <label class="col-form-label">FY Year <span class="text-danger">*</span></label>
                                                <select class="form-control" required name="fyyear" >
                                                    <option value="">-Select FY Year-</option>
                                                    <option <?php if(isset($fyyear) && $fyyear=="2022-2023") {echo "selected"; } ?> >2022-2023</option>
                                                    <option <?php if(isset($fyyear) && $fyyear=="2023-2024") {echo "selected"; } ?>>2023-2024</option> 
                                                    <option <?php if(isset($fyyear) && $fyyear=="2024-2025") {echo "selected"; } ?>>2024-2025</option>
                                                </select>  
                                            </div> 

                                             <div class="form-group col-md-2">
                                                <div class="" style="margin-top:40px">
                                                   <button type="submit" class="btn searchbtn" style="background-color:#4da7ff;color:white"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                                </div>
                                             </div>
 
                                            </div>
                                       </div>
                                    </div>
                                 </div>
                              </form>

                    
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
											<h4 class="card-title" id="basic-layout-form-center">DEPRICIATION CHARGES
											</h4>
											<!--table start here -->
											<table style="width:100%">
												<thead style="border-top-style: dotted;border-bottom-style: dotted;">
													
													<th>DATE</th>
													<th>V-TY</th>
													<th>V.NO.</th>
													<th>PARTICULARS</th>
													<th>DEBIT</th>
													<th>CREDIT</th>
													<th>BALANCE</th>
												</thead>
												<tbody>
													
													<?php
														
														$sr=1;
														$total_Debit_value =0; 
														$total_Credit_value =0; 
														if(!empty($list))
														{
															foreach ($list as $item)
															{
																// if(date('d-m-Y',strtotime($item->date_time)) == "01-04-2022"){
																// continue;
																// }else{
																
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
																<td><?= $item->entry_type?></td>
																<td><?= $item->vno?></td>
																
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
																// } 
															}
														}
													?>
													<tr style="border-top:dotted;border-bottom:dotted;">
														<td></td>
														
														<td colspan="3">
															<b><span>BALANCE (As on <?= '31/03/2025'?>)</span>	</b>
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
																// $balance = $creditSum-$debitSum;
																// echo number_format($balance, 2, '.', '')." Cr";
																$type = '';
																if($debitSum>$creditSum){
																$type ='debit';
																	$balance = $debitSum-$creditSum;
																	echo number_format($balance, 2, '.', '')." Dr";
																}
																else{
																$type = 'credit';
																	$balance = $creditSum-$debitSum;
																	echo number_format($balance, 2, '.', '')." Cr";
																}
																
																
																// $financial_year = '2022-2023';
																$financial_year = '2023-2024';
																$insertData = [
																'entrycode' => 'DEPCHA',
																'type' => $type,
																'amount' => $balance,
																'date' => date('Y-m-d'),
																'time' => date('h:i A'),
																'financial_year' => $financial_year,
																];
																
																$query = $this->db->where(['entrycode'=>'DEPCHA','financial_year'=>$financial_year])->get('tbl_balance');
																if ($query->num_rows())
																{
																	$data['list'] = $query->result();
																	$this->db->where('id', $data['list'][0]->id)->update('tbl_balance', $insertData);
																}
																else
																{
																	$this->db->insert('tbl_balance', $insertData);
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