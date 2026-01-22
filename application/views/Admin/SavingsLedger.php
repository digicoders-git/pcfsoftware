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
						<h5><a href="<?= base_url($this->data->controller); ?>/Dashboard"><?= $this->data->title; ?></a> / Interest On Savings</h5>
					
                        
                        <br/>

                        <!--Form start here -->
                        <form action="<?php echo base_url('Admin/SavingsLedger'); ?>" method="post">

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

                    
                    </div>
				</div>
				<!--extra added here-->
				<div class="content-body" >
					<!-- Stats -->
					<div class="row match-height">
						<div class="col-md-12">
							<div class="card" id="printableArea">
								<div class="card-header">
									<h4 class="card-title" id="basic-layout-form-center">Interest On Savings <span> (As on <?php echo date('31/03/2025');?>)</span></h4>
									<br>
								</div>
								<div class="card-content collapse show " style="margin-top:-40px;">
									<div class="card-body">
										<!--table start here -->
										<table style="width:100%">
											<thead style="border-top-style: dotted;border-bottom-style: dotted;">
												<th>S.No.</th>
												<th>PF Number</th>
												<th>Saving Interest</th>
											</thead>
											<tbody>
												<?php
													$sr=1;
													$total_saving_int = 0;
													foreach ($list as $item)
													{
														if($item->pf_number=="") {
															continue;
														}
														// for saving interest all members 
														if(!empty($item->saving_interest2))
														{
															$total_saving_int+=$item->saving_interest2;
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
																if(!empty($item->saving_interest2))
																// if($item->saving_interest2>0)
																{
																	echo number_format(abs($item->saving_interest2), 2, '.', '');
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
															<b><span>T O T A L (As on <?= date('31/03/2025')?>)</span></b>
														</td>
														<td><b><?= abs($total_saving_int); ?></b></td>
														<td></td>
														<?php
															$type = 'debit';
															// $financial_year = '2022-2023';
															$financial_year = '2023-2024';
															$insertData = [
															'entrycode' => 'INTSAV',
															'type' => $type,
															'amount' => abs($total_saving_int),
															'date' => date('Y-m-d'),
															'time' => date('h:i A'),
															'financial_year' => $financial_year,
															];
															
															$query = $this->db->where(['entrycode'=>'INTSAV','financial_year'=>$financial_year])->get('tbl_balance');
															if ($query->num_rows())
															{
																$data['list'] = $query->result();
																$this->db->where('id', $data['list'][0]->id)->update('tbl_balance', $insertData);
															}
															else
															{
																$this->db->insert('tbl_balance', $insertData);
															}
															
														?>
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