<table class="table table-striped table-bordered table-responsive">
												<thead>
													<tr role="row">
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">V.No.</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 90.625px;">DATE</th>
														
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 261.281px;">PARTICULARS</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Dr.</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 115.047px;">Cr.</th>
														
													</tr>
												</thead>
												<tbody>
													<?php
														$sr=1;
														foreach ($list as $item)
														{
														?>
														<tr role="row" class="even">
															
															<td width="12%" ><?= $item->vno?></td>
															<td width="12%"><?= $item->date_time?></td>
															<td width="30%"><?= $item->entrydesc?></td>
															<td><?= $item->debit?></td>
															<td><?= $item->credit?></td>
														</tr>
														<?php 
															$sr++;
														}
													?>
												</tbody>
												
											</table>