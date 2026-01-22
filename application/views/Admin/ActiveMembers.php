<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
   <head>
      <?php require APPPATH . 'views/Auth/CssLinks.php'; ?>
      <style>
         h4,h5 {
         font-family:verdana;
         }
         .dataTables_filter
         {
         display:none !important;
         }
         .pagination-circular li a{
         margin: 0 2px;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 35px;
         width: 35px;
         background:grey;
         box-shadow: inset 0 2px 4px 0 #ffffff60, inset 0 -3px 3px 0 #00000031, 1px 1px 9px 0 #061d6280;
         /* box-shadow: 1px 1px 9px #00000061; */
         text-transform:uppercase;
         font-size:14px;
         }
         .pagination-circular li #next{
         width:80px;
         background:#6842ff;
         height:45px;
         text-transform:uppercase;
         }
         .pagination-circular li #next:hover{
         background:#7a5deb;
         }
         .pagination-circular #next a{
         width:80px;
         background:blue;
         height:35px;
         text-transform:uppercase;
         }
         .pagination-circular #next a:hover{
         background:lime;
         }
         .pagination-circular li #previous{
         width:100px;
         background:#6842ff;
         height:45px;
         text-transform:uppercase;
         }
         .pagination-circular li #previous:hover{
         background:#7a5deb;
         }
         .pagination-circular #previous a{
         width:110px;
         background:blue;
         height:35px;
         text-transform:uppercase;
         }
         .pagination-circular #previous a:hover{
         /* hjkj */
         background:lime;
         }
         .pagination-circular li.disabled {
         border: 1px solid #cacaca;
         }
         .pagination-circular a {
         color:white;
         text-decoration:none;
         }
         .pagination-circular li:not(.disabled):hover a {
         background:#28293d;
         }
         .pagination-circular li  {
         transition: background 0.15s ease-in, color 0.15s ease-in;
         }
         #table_id_paginate
         {
         display:none !important;
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
                  <h5><a href="<?= base_url($this->data->controller); ?>/Dashboard"><?= $this->data->title; ?></a> / <span>All Members</span></h5>
               </div>
            </div>
            <!--extra added here-->
            <div class="content-body">
               <!-- Stats -->
               <div class="row match-height">
                  <div class="col-md-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title" id="basic-layout-form-center">All Members</h4>
                           <hr>
                        </div>
                        <div class="card-content collapse show " style="margin-top:-40px;">
                           <div class="card-body">
                              <!-- Search Here -->
                              <form action="<?php echo base_url('Admin/ActiveMembers/3'); ?>" method="post">
                                 <div class="row mb-2">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8 d-flex justify-content-end">
                                       <div class="row">
                                          <div class="col-sm-6 p-0">
                                             <input placeholder="Search here..." type="text" name="search" class="form-control"/>
                                          </div>
                                          <div class="col-sm-6 pl-1"><button class="btn btn-success btn-md" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button></div>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                              <!-- Search Here -->
                              <!--table start here -->
                              <table class="table table-striped table-bordered table-responsive" id="table_id" >
                                 <thead>
                                    <tr role="row">
                                       <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 160.828px;">Sr No</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">PF Number</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Member Name</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">PerMonthSavings</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Loan Interest</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Saving Interest</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Savings</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Loan Debit</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Loan Credit</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Balance</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Shares</th>
                                       <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 160.828px;">Status</th>
                                       <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 160.828px;">HO Status</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Ledger</th>
                                       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">Edit</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       // for loan and saving 
                                       // $total_loan_int =0;
                                       // $total_saving_int =0;
                                       
                                       
                                       // $total_savings =0;
                                       // $total_loan = 0;
                                       // $total_loan_credit = 0;
                                       // $total_shares = 0;
                                       $srno = 1;
                                       foreach ($list as $item)
                                       {
                                       	// if(!empty($item->savings))
                                       	// {
                                       	// $total_savings+=$item->savings;
                                       	// }
                                       	// if(!empty($item->loan))
                                       	// {
                                       	// $total_loan+=$item->loan;
                                       	// }
                                       	// $total_savings+=$item->savings;
                                       	// $total_loan+=$item->loan;
                                       	
                                       	// if(!empty($item->loan_credit))
                                       	// {
                                       	// $total_loan_credit+=$item->loan_credit;
                                       	// }
                                       	
                                       	// if(!empty($item->shares))
                                       	// {
                                       	// $total_shares+=$item->shares;
                                       	// }
                                       	
                                       	// for loan interest all members 
                                       	// if(!empty($item->loan_interest))
                                       	// {
                                       	// $total_loan_int+=$item->loan_interest;
                                       	// }
                                       	// for saving interest all members 
                                       	// if(!empty($item->saving_interest))
                                       	// {
                                       	// $total_saving_int+=$item->saving_interest;
                                       	// }
                                       	
                                       	// $total_shares+=$item->shares;
                                       ?>
                                    <tr role="row" class="even">
                                       <td><?= $srno; ?></td>
                                       <td><?= $item->pf_number; ?></td>
                                       <td width="16%"><?= $item->name; ?></td>
                                       <td width="12%"><span>&#8377;</span><?= $item->pm_saving; ?></td>
                                       <td width="12%"><span>&#8377;</span><?= $item->loan_interest; ?></td>
                                       <td width="12%"><span>&#8377;</span><?= $item->saving_interest; ?></td>
                                       <td width="16%"><span>&#8377;</span><?= $item->savings; ?><br>
										  <kbd class="bg-dark"><?= $item->lfy_saving; ?></kbd> 
										  </td>
                                       <td width="16%"><span>&#8377;</span><?= $item->loan; ?><br>
										    <kbd class="bg-dark"><?= $item->lfy_loan_dr; ?></kbd> 
										   </td>
                                       <td width="16%"><span>&#8377;</span><?= $item->loan_credit; ?><br>
										    <kbd class="bg-dark"><?= $item->lfy_loan_cr; ?></kbd> 
										   </td>
                                       <td width="16%"><span>&#8377;</span>
                                          <?php 
                                             $loan = $item->loan;
                                             $credit_loan = $item->loan_credit;
                                             if(!empty($loan) AND !empty($credit_loan))
                                             {
                                             	if($item->loan>$item->loan_credit)
                                             	{
                                             		$balance = $item->loan-$item->loan_credit."Dr";
                                             	}
                                             	else 
                                             	{
                                             		$balance = $item->loan_credit-$item->loan."Cr";
                                             	}
                                             	
                                             	if(!empty($balance))
                                             	{
                                             		echo $balance;
                                             	}
                                             	else
                                             	{
                                             		echo "-";
                                             	}
                                             }
                                             ?>
                                       </td>
                                       <td width="16%"><span>⬤</span> <?= $item->shares; ?><br>
										    <kbd class="bg-dark"><?= $item->lfy_share; ?></kbd>
										   </td>
                                       <td>
                                          <div class="custom-control custom-switch custom-control-inline">
                                             <input type="checkbox" class="custom-control-input"  onchange="return Status(this,'<?= $this->data->table; ?>','id','<?= $item->id; ?>','is_status')"  <?php if($item->is_status == 'true') { echo 'checked'; } ?> id="switch-id<?=$srno;?>">
                                             <label class="custom-control-label mr-1" for="switch-id<?=$srno;?>"></label>
                                          </div>
										  
                                       </td>
                                       <!-- HO Status Start -->
                                       <td>
                                          <div class="custom-control custom-switch custom-control-inline">
                                             <input type="checkbox" class="custom-control-input"  onchange="return HOStatus(this,'<?= $this->data->table; ?>','id','<?= $item->id; ?>','ho_status')"  <?php if($item->ho_status == 'true') { echo 'checked'; } ?> id="switch-id1<?=$srno;?>">
                                             <label class="custom-control-label mr-1" for="switch-id1<?=$srno;?>"></label>
                                          </div>
                                       </td>
                                       <!-- HO Status End  -->
                                       <td width="12%" >
                                          <a href="<?= base_url('Admin/UserFullDeatils/').$item->id ?>" class="btn btn-dark btn-sm" >View Ledger</a>
                                       </td>
                                       <td width="12%" >
                                          <a href="javascript:void(0);" class="action_btn mr_10" onclick="Edit('<?= $item->id; ?>')"> <i class="fa fa-edit text-primary"></i> </a>
                                       </td>
                                    </tr>
                                    <?php $srno++;
                                       } ?>
                                 </tbody>
                                 <!--2nd Tbody Start Here-->
                                 <tbody>
                                    <tr>
                                       <th width="12%">Total Members</th>
                                       <th></th>
                                       <th></th>
                                       <th></th>
                                       <th>Total Loan Interest</th>
                                       <th>Total Saving Interest</th>
                                       <th>Total Savings</th>
                                       <th>Total Loan Debit</th>
                                       <th>Total Loan Credit</th>
                                       <th></th>
                                       <th>Total Shares</th>
                                       <th></th>
                                       <th></th>
                                       <th></th>
                                       <th></th>
                                    </tr>
                                    <?php 
                                       $rows = $this->db->get_where('members',array('is_status'=>'true'));
                                       $data = $rows->num_rows();
                                       ?>
                                    <tr>
                                       <td><?= $data; ?></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><?= $total_loan_int; ?></td>
                                       <td><?= $total_saving_int; ?></td>
                                       <td><?= $total_savings; ?></td>
                                       <td><?= $total_loan; ?></td>
                                       <td><?= $total_loan_credit; ?></td>
                                       <td></td>
                                       <td><?= $total_shares; ?></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                    </tr>
                                 </tbody>
                                 <!--2nd Tbody End Here-->
                              </table>
                              <!--table end here -->
                              <br>
                              <!-- Pagination Start Here Link -->
                              <?= $this->pagination->create_links(); ?>
                              <!-- Pagination End Here Link -->
                           </div>
                        </div>
                     </div>
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
</html>