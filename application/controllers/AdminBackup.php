<?php defined('BASEPATH') or exit('No direct script access allowed');
	class Admin extends Admin_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->roleData = $this->Auth_model->getRole($this->data->role_id);
			
			if (empty($this->session->get_userdata()[$this->roleData->session]))
			{
				redirect(base_url('Auth/AdminLogin'));
			}
			else
			{
				$this->user_id = $this->session->get_userdata()[$this->roleData->session]->id;
				$userData = $this->Auth_model->isValid($this->roleData->table_name, $this->user_id);
				if($userData)
				{
					$this->userData = $userData;
				}
				else
				{
					redirect(base_url($this->data->controller . '/AccountSettings/Logout'));
				}
			}
		}
		
		public function _remap($method, $params = array())
		{
			if (method_exists($this, $method))
			{
				return call_user_func_array(array($this, $method), $params);
			}
			else
			{
				$this->index();
			}
		}
		
		
		public function Test()
		{
			// $res = $this->db->get('admin')->result();
			// $res = $this->db->order_by('id','desc')->get('tbl_saving_bal')->result();
			// $res = $this->db->order_by('id','desc')->get('entriesmaster')->result();
			$res = $this->db->order_by('id','asc')->get('tbl_entry')->result();
			// $res = $this->db->query("update tbl_entry set credit='17000' where id='1424'");
			// $res = $this->db->order_by('id','asc')->get('members')->result();
			
			// $res = $this->db->query("UPDATE members SET saving_interest = -saving_interest WHERE saving_interest < 0");
			echo "<pre>";
			var_dump($res);
			die();
		}
		
		
		
		// cancel start here 
		public function ActiveInactiveMembers()
		{
			$id = $this->input->post("where_value");
			
			$userdata = $this->db->get_where('members', array('id' => $id))->row();
			
			if ($userdata->is_deleted == "false")
			{
				$staus = "true";
			}
			else
			{
				$staus = "false";
			}
			
			if ($this->db->where(array("id" => $id))->update('members', array('is_deleted' => $staus)))
			{
				echo true;
			}
			else
			{
				echo false;
			}
		}
		// cancel end here
		
		// Add Member Start Here
		public function AddMember()
		{
			$this->data->table = 'members';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Members';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							// $data["action"] = "EditCategory";
							$data["action"] = "EditMember1";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Add')
					{
						if (!empty($this->input->post()))
						{
							if ($this->form_validation->run($this->data->key) == FALSE)
							{
							    $msg = explode('</p>', validation_errors());
							    $output['msg'] = str_ireplace('<p>', '', $msg[0]);
							}
							else
							{
								$check = $this->db->get_where('members', ['pf_number' => $this->input->post('pf_number')]);
								if ($check->num_rows() > 0)
								{
									$output['res'] = 'error';
									$output['msg'] = 'PF Number Is Unique';
								}
								else
								{
									$shares = $this->input->post('shares');
									$savings = $this->input->post('savings');
									$loan = $this->input->post('loan');
									$loan_credit = $this->input->post('loan_credit');
									$ho_status = $this->input->post('ho_status');
									
									if($ho_status=='true')
									{
										$status = 'true';
									}
									else 
									{
										$status = 'false';
									}
									
									$insertData = [
									'pf_number' => $this->input->post('pf_number'),
									'name' => $this->input->post('name'),
									'savings' => $this->input->post('savings'),
									'loan' => $this->input->post('loan'),
									'loan_credit' => $this->input->post('loan_credit'),
									// 'loan_interest' => $loan_interest,
									'loan_interest' => 0,
									// 'saving_interest' => $saving_interest,
									'saving_interest' => 0,
									'shares' => $this->input->post('shares'),
									'pm_saving' => $this->input->post('pm_saving'),
									'is_status' => 'true',
									// 'ho_status' => 'false',
									'ho_status' => $status,
									'is_verified' => 'true',
									'created_at' => $this->data->timestamp,
									'modified_at' => $this->data->timestamp
									];
									$insertData = $this->security->xss_clean($insertData);
									if ($this->db->insert($this->data->table, $insertData))
									{
										// shares for tbl_entry insert data
										if($shares>0)
										{
											$entryData2 = [
											'pf_no' => $this->input->post('pf_number'),
											'entrycode' => 'SHAACC',
											'entrydesc' => 'TO OP.BAL. B/F 01/04/2022',
											'credit' => $this->input->post('shares'),
											'date_time' => '2022-04-01',
											'created_at' => $this->data->timestamp
											];
											$InsertData2 = $this->security->xss_clean($entryData2);
											$this->db->insert('tbl_entry', $InsertData2);
										}
										
										// saving for tbl_entry insert data
										if($savings>0)
										{
											$entryData3 = [
											'pf_no' => $this->input->post('pf_number'),
											'entrycode' => 'SAVACC',
											'entrydesc' => 'TO OP.BAL. B/F 01/04/2022',
											'credit' => $this->input->post('savings'),
											'date_time' => '2022-04-01',
											'created_at' => $this->data->timestamp
											];
											$InsertData3 = $this->security->xss_clean($entryData3);
											$this->db->insert('tbl_entry', $InsertData3);
										}
										
										// loan for tbl_entry insert data
										if($loan>0)
										{
											$entryData1 = [
											'pf_no' => $this->input->post('pf_number'),
											'entrycode' => 'LONACC',
											'entrydesc' => 'TO OP.BAL. B/F 01/04/2022',
											// 'debit' => $this->input->post('loan'),
											'debit' => $loan,
											'date_time' => '2022-04-01',
											'created_at' => $this->data->timestamp
											];
											
											$InsertData1 = $this->security->xss_clean($entryData1);
											$this->db->insert('tbl_entry', $InsertData1);
										}
										
										// loan_credit for tbl_entry insert here 
										if($loan_credit>0)
										{
											$entryData1 = [
											'pf_no' => $this->input->post('pf_number'),
											'entrycode' => 'LONACC',
											'entrydesc' => 'TO OP.BAL. B/F 01/04/2022',
											'credit' => $loan_credit,
											'date_time' => '2022-04-01',
											'created_at' => $this->data->timestamp
											];
											
											$InsertData1 = $this->security->xss_clean($entryData1);
											$this->db->insert('tbl_entry', $InsertData1);
										}
										
										$output['res'] = 'success';
										$output['msg'] = 'Data Added Successfully.';
										
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
								}
								
							}
						}
						echo json_encode([$output]);
					}
					else if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									// if ($this->form_validation->run($this->data->key) == FALSE)
									// {
									//     $msg = explode('</p>', validation_errors());
									//     $output['msg'] = str_ireplace('<p>', '', $msg[0]);
									// }
									// else
									// {
									$updateData = [
                                    // 'pf_number' => $this->input->post('pf_number'),
                                    'name' => $this->input->post('name'),
                                    'grade' => $this->input->post('grade'),
                                    'designation' => $this->input->post('designation'),
                                    'mobile' => $this->input->post('mobile'),
                                    // 'saving' => 0,
                                    'is_status' => 'true',
                                    'is_verified' => 'true',
                                    'created_at' => $this->data->timestamp,
                                    'modified_at' => $this->data->timestamp
									];
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									if ($result)
									{
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
									// }
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				// $query = $this->db->order_by("id", "DESC")->where('is_deleted', 'false')->get($this->data->table);
				$query = $this->db->order_by("id", "DESC")->get($this->data->table);
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		// Add Member End Here
		
		
		
		# Add Member Start Here
		// Add Member Start Here
		
		# Add Member End Here
		
		
		
		# All members 
		public function AllMembers()
		{
			$this->data->table = 'members';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Members';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditMember";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									
									// if ($this->form_validation->run($this->data->key) == FALSE)
									// {
									//     $msg = explode('</p>', validation_errors());
									//     $output['msg'] = str_ireplace('<p>', '', $msg[0]);
									// }
									// else
									// {
									$updateData = [
                                    'name' => $this->input->post('name'),
                                    // 'shares' => $this->input->post('shares'),
                                    // 'loan' => $this->input->post('loan'),
                                    // 'savings' => $this->input->post('savings'),
                                    'pm_saving' => $this->input->post('pm_saving'),
                                    // 'is_status' => 'true',
                                    'is_verified' => 'true',
                                    'created_at' => $this->data->timestamp,
                                    'modified_at' => $this->data->timestamp
									];
									
									
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									
									if ($result)
									{
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
									// }
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				$query = $this->db->order_by("id", "DESC")->where('is_status', 'true')->get($this->data->table);
				$data["list"] = $query->result();
				
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		
		
		
		// public function AllMembers()
		// {
		// $this->data->table = 'members';
		// $query = $this->db->order_by("id", "DESC")->where('is_deleted', 'false')->get($this->data->table);
		// $data["list"] = $query->result();
		// $this->load->view($this->data->controller . '/' . $this->data->method, $data);
		// }
		
		
		// public function ManageSavings()
		public function Savings()
		{
			// get here from ManageSavings Form 
			$pf_no = $this->input->post("pf_no");
			$entrycode = $this->input->post("entrycode");
			
			$f_date1 = $this->input->post("date1");
			$t_date2 = $this->input->post("date2");
			
			if ($f_date1 !== null) {
				$n_fear = date('Y-m-d', strtotime('+1 year', strtotime($f_date1)));
				$n_f_date = date('Y-m-d', strtotime('-1 day', strtotime('+1 year', strtotime($f_date1))));
			}
			
			if(!empty($this->input->post()))
			{
				// $query = $this->db->query("SELECT * FROM tbl_entry
				// WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$f_date1' and '$t_date2' ORDER BY date_time ASC, entry_type ASC");
				
				if($t_date2>$n_f_date){
					
					$query = $this->db->query("SELECT * FROM tbl_entry
					WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$f_date1' and '$n_f_date' ORDER BY date_time ASC, entry_type ASC");
					
					$data["newtodate"] = $n_f_date;
					$data["t_date2"] = $t_date2;	
					
					$data['list_2'] = $this->db->query("SELECT * FROM tbl_entry
					WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$n_fear' and '$t_date2' ORDER BY date_time ASC, entry_type ASC")->result();
				}
				else{
					
					$query = $this->db->query("SELECT * FROM tbl_entry
					WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$f_date1' and '$t_date2' ORDER BY date_time ASC, entry_type ASC");
					$data["newtodate"] = $t_date2;
					
					$data["t_date2"] = $t_date2;
					$data["n_fear"] = $n_fear;
					
					$data['list_2'] = [];
				}
				
				$data["list1"] = $query->row();
				$data["status"] = 'true';
				$data["newtodate1"] = $t_date2;
				$data["pf_no"] = $pf_no;
				$data["n_fear"] = $n_fear;
				$data["list"] = $query->result();
				
				// $data["list1"] = $query->row();
				// $data["newtodate"] = $t_date2;
				// $data["status"] = 'true';
				// $data["list"] = $query->result();
			}
			else
			{
				$data["status"] = 'false';
			}
			
			$this->load->view($this->data->controller . '/' . $this->data->method,$data);
		}
		
		
		
		# Manage Loan 
		public function Loan()
		{
			// get here from ManageLoan Form 
			$pf_no = $this->input->post("pf_no");
			$entrycode = $this->input->post("entrycode");
			
			$f_date1 = $this->input->post("date1");
			$t_date2 = $this->input->post("date2");
			if ($f_date1 !== null) {
				$n_fear = date('Y-m-d', strtotime('+1 year', strtotime($f_date1)));
				$n_f_date = date('Y-m-d', strtotime('-1 day', strtotime('+1 year', strtotime($f_date1))));
			}
			
			if(!empty($this->input->post()))
			{
				
				if($t_date2>$n_f_date){
					// this code is after 2023-04-01 to any date  
					$query = $this->db->query("SELECT * FROM tbl_entry
					WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$f_date1' and '$n_f_date' ORDER BY date_time ASC, entry_type ASC");
					$data["newtodate"] = $n_f_date;
					$data["t_date2"] = $t_date2;
					
					$data["fromdate"] = $f_date1;   // this date is anydate
					
					
					// this code is bottom after 1 Apr 
					$data['list_2'] = $this->db->query("SELECT * FROM tbl_entry
					WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$n_fear' and '$t_date2' ORDER BY date_time ASC, entry_type ASC")->result();
				}
				else
				{
					// this code is 2022-04-01 to 2023-03-31 
					$query = $this->db->query("SELECT * FROM tbl_entry
					WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$f_date1' and '$t_date2' ORDER BY date_time ASC, entry_type ASC");
					$data["newtodate"] = $t_date2;
					$data["t_date2"] = $t_date2;
					$data["n_fear"] = $n_fear;
					$data['list_2'] = []; 
					
					$data["fromdate"] = $f_date1;  // this date is anydate 
				}
				
				$data["list1"] = $query->row();
				// $data["newtodate"] = $n_f_date;
				$data["status"] = 'true';
				$data["newtodate1"] = $t_date2;
				$data["pf_no"] = $pf_no;
				$data["n_fear"] = $n_fear;
				$data["list"] = $query->result();
			}
			else 
			{
				$data["status"] = 'false';
			}
			$this->load->view($this->data->controller . '/' . $this->data->method,$data);
		}
		
		
		# Manage Shares 
		public function Shares()
		{
			// get here from ManageShares Form 
			$pf_no = $this->input->post("pf_no");
			$entrycode = $this->input->post("entrycode");
			
			$f_date1 = $this->input->post("date1");
			$t_date2 = $this->input->post("date2");
			
			if ($f_date1 !== null) {
				$n_fear = date('Y-m-d', strtotime('+1 year', strtotime($f_date1)));
				$n_f_date = date('Y-m-d', strtotime('-1 day', strtotime('+1 year', strtotime($f_date1))));
			}
			
			if(!empty($this->input->post())){
				
				// $query = $this->db->query("SELECT * FROM tbl_entry
				// WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$f_date1' and '$t_date2' ORDER BY id ASC");
				
				if($t_date2>$n_f_date){
					// this code is after 2023-04-01 to any date  
					$query = $this->db->query("SELECT * FROM tbl_entry
					WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$f_date1' and '$n_f_date' ORDER BY date_time ASC, entry_type ASC");
					$data["newtodate"] = $n_f_date;
					$data["t_date2"] = $t_date2;
					
					// this code is bottom after 1 Apr 
					$data['list_2'] = $this->db->query("SELECT * FROM tbl_entry
					WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$n_fear' and '$t_date2' ORDER BY date_time ASC, entry_type ASC")->result();
					
				}
				else
				{
					// this code is 2022-04-01 to 2023-03-31 
					$query = $this->db->query("SELECT * FROM tbl_entry
					WHERE pf_no='$pf_no' and entrycode='$entrycode' and date_time BETWEEN '$f_date1' and '$t_date2' ORDER BY date_time ASC, entry_type ASC");
					$data["newtodate"] = $t_date2;
					
					$data["t_date2"] = $t_date2;
					$data["n_fear"] = $n_fear;
					
					$data['list_2'] = [];
				}
				
				$data["list1"] = $query->row();
				$data["status"] = 'true';
				$data["newtodate1"] = $t_date2;
				$data["pf_no"] = $pf_no;
				$data["n_fear"] = $n_fear;
				$data["list"] = $query->result();
				
				
				
				// $data["list1"] = $query->row();
				// $data["newtodate"] = $t_date2;
				// $data["newtodate1"] = $t_date2;
				// $data["status"] = 'true';
				// $data["list"] = $query->result();
			}
			else 
			{
				$data["status"] = 'false';
			}
			$this->load->view($this->data->controller . '/' . $this->data->method,$data);
		}
		
		
		# Manage TodayEntries
		public function TodayEntries()
		{
			// $todaydate=date('d/m/Y');
			$todaydate=date('Y-m-d');
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time='$todaydate' order by vno ASC");
			$data["list"] = $query->result();
			$this->load->view($this->data->controller.'/'.$this->data->method,$data);
		}
		
		# SavingsLedger Start Here
		public function SavingsLedger()
		{
			$query = $this->db->query("SELECT * FROM `members` where saving_interest!=0 order by pf_number asc");
			$data["list"] = $query->result();
			$this->load->view($this->data->controller.'/'.$this->data->method,$data);
		}
		
		
		
		# SharesLedger Start Here
		// public function SharesLedger()
		// {
		// $query = $this->db->query("SELECT * FROM `members` where shares>0 order by pf_number asc");
		// $data["list"] = $query->result();
		// $this->load->view($this->data->controller.'/'.$this->data->method,$data);
		// }
		
		public function SubsidiarySharesLedger()
		{
			
			if(empty($this->input->post()))
			{ 
				// $query = $this->db->query("SELECT *, SUM(credit) AS total_credit FROM tbl_entry WHERE (date_time >= '2022-04-01' AND date_time <= '2023-03-31') AND entrycode = 'SHAACC' GROUP BY pf_no");
				$query = $this->db->query("SELECT *, SUM(credit) AS total_credit, SUM(debit) AS total_debit FROM tbl_entry WHERE (date_time >= '2022-04-01' AND date_time <= '2023-03-31') AND entrycode = 'SHAACC' GROUP BY pf_no");
				
			}
			else
			{
				$start=date("Y-m-d",strtotime($this->input->post('fromdate')));
				$todate=date("Y-m-d",strtotime($this->input->post('todate')));
				
				// $query = $this->db->query("SELECT *,SUM(credit) AS total_credit FROM tbl_entry WHERE (date_time >= '$start' AND date_time <= '$todate') AND entrycode = 'SHAACC' GROUP BY pf_no");
				
				$query = $this->db->query("SELECT *,SUM(credit) AS total_credit, SUM(debit) AS total_debit FROM tbl_entry WHERE (date_time >= '$start' AND date_time <= '$todate') AND entrycode = 'SHAACC' GROUP BY pf_no");
				$data["fromdate"] = $start;
				$data["todate"] = $todate;
			}
			$data["list"] = $query->result();
			$this->load->view($this->data->controller.'/'.$this->data->method,$data);
		}
		
		
		# SubsidiaryLoanLedger Start Here 
		public function SubsidiaryLoansLedger()
		{
			
			if(empty($this->input->post())){ 
				// $query = $this->db->query("SELECT *, SUM(debit) AS total_debit FROM tbl_entry WHERE (date_time >= '2022-04-01' AND date_time <= '2023-03-31') AND entrycode = 'LONACC' GROUP BY pf_no");
				
				$query = $this->db->query("SELECT *, SUM(debit) AS total_debit, SUM(credit) AS total_credit FROM tbl_entry WHERE (date_time >= '2022-04-01' AND date_time <= '2023-03-31') AND entrycode = 'LONACC' GROUP BY pf_no");
			}
			else
			{
				$start=date("Y-m-d",strtotime($this->input->post('fromdate')));
				$todate=date("Y-m-d",strtotime($this->input->post('todate')));
				
				// $query = $this->db->query("SELECT *,SUM(debit) AS total_debit FROM tbl_entry WHERE (date_time >= '$start' AND date_time <= '$todate') AND entrycode = 'LONACC' GROUP BY pf_no");
				$query = $this->db->query("SELECT *,SUM(debit) AS total_debit, SUM(credit) AS total_credit FROM tbl_entry WHERE (date_time >= '$start' AND date_time <= '$todate') AND entrycode = 'LONACC' GROUP BY pf_no");
				$data["fromdate"] = $start;
				$data["todate"] = $todate;
			}
			$data["list"] = $query->result();
			$this->load->view($this->data->controller.'/'.$this->data->method,$data);
		}
		
		
		# SubsidiarySavingsLedger Start Here 
		public function SubsidiarySavingsLedger()
		{
			
			if(empty($this->input->post())){ 
				$query = $this->db->query("SELECT *, SUM(credit) AS total_credit FROM tbl_entry WHERE (date_time >= '2022-04-01' AND date_time <= '2023-03-31') AND entrycode = 'SAVACC' GROUP BY pf_no");
				$data["fromdate"] = '2022-04-01';
				$data["todate"] = '2023-03-31';
			}
			else
			{
				$start=date("Y-m-d",strtotime($this->input->post('fromdate')));
				$todate=date("Y-m-d",strtotime($this->input->post('todate')));
				
				$query = $this->db->query("SELECT *,SUM(credit) AS total_credit FROM tbl_entry WHERE (date_time >= '$start' AND date_time <= '$todate') AND entrycode = 'SAVACC' GROUP BY pf_no");
				$data["fromdate"] = $start;
				$data["todate"] = $todate;
			}
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller.'/'.$this->data->method,$data);
		}
		
		
		
		
		
		
		
		
		# MemberLedger Start Here 
		public function MemberLedger()
		{
			$query = $this->db->query("SELECT * FROM `members` order by id desc");
			$data["list"] = $query->result();
			$this->load->view($this->data->controller.'/'.$this->data->method,$data);
		}
		
		
		# Manage MemberDetails 
		public function MemberDetails()
		{
			// get here from Member Details Form 
			$pf_no = $this->input->post("pf_no");
			$entrycode = $this->input->post("entrycode");
			if(!empty($this->input->post())){
				$query = $this->db->query("SELECT * FROM tbl_entry
				WHERE pf_no='$pf_no' and entrycode='$entrycode' ORDER BY id ASC");
				$data["list1"] = $query->row();
				$data["status"] = 'true';
				$data["list"] = $query->result();
			}
			else 
			{
			 	$data["status"] = 'false';
			}
			$this->load->view($this->data->controller . '/' . $this->data->method,$data);
		}
		
		
		
		
		# LoanAcLedger Start Here 
		public function LoanAcLedger()
		{
			$fromdate = $this->input->post('fromdate');
			$todate = $this->input->post('todate');
			if(!empty($fromdate) && !empty($todate)){
				$f_date1=date("Y-m-d",strtotime($fromdate));
				$f_date2=date("Y-m-d",strtotime($todate));
			}
			
			
			$entrycode = $this->input->post("entrycode");
			
			if(!empty($this->input->post())){
				
				$data["list_members"] = $this->db->order_by("pf_number", "ASC")->where('is_status', 'true')->get("members")->result();
				
				// $data["start"]=$start;
				// $data["todate"]=$todate;
				
				$data["start"]=$f_date1;
				$data["newtodate"]=$f_date2;
				$data["entrycode"]=$entrycode;
				$data["status"] = 'true';
			}
			else 
			{
			 	$data["status"] = 'false';
			}
			
			$this->load->view($this->data->controller . '/' . $this->data->method,$data);
		}
		
		# SavingsAcLedger Start Here 
		public function SavingsAcLedger()
		{
			$fromdate = $this->input->post('fromdate');
			$todate = $this->input->post('todate');
			if(!empty($fromdate) && !empty($todate)){
				$f_date1=date("Y-m-d",strtotime($fromdate));
				$f_date2=date("Y-m-d",strtotime($todate));
			}
			
			$entrycode = $this->input->post("entrycode");
			
			if(!empty($this->input->post())){
				
				$data["list_members"] = $this->db->order_by("pf_number", "ASC")->where('is_status', 'true')->get("members")->result();
				$data["start"]=$f_date1;
				$data["newtodate"]=$f_date2;
				$data["entrycode"]=$entrycode;
				$data["status"] = 'true';
			}
			else 
			{
			 	$data["status"] = 'false';
			}
			$this->load->view($this->data->controller . '/' . $this->data->method,$data);
		}
		
		
		# SharesAcLedger Start Here 
		public function SharesAcLedger()
		{
			
			$fromdate = $this->input->post('fromdate');
			$todate = $this->input->post('todate');
			if(!empty($fromdate) && !empty($todate)){
				$f_date1=date("Y-m-d",strtotime($fromdate));
				$f_date2=date("Y-m-d",strtotime($todate));
			}
			
			$entrycode = $this->input->post("entrycode");
			
			if(!empty($this->input->post())){
				
				$data["list_members"] = $this->db->order_by("pf_number", "ASC")->where('is_status', 'true')->get("members")->result();
				$data["start"]=$f_date1;
				$data["todate"]=$f_date2;
				$data["entrycode"]=$entrycode;
				$data["status"] = 'true';
			}
			else 
			{
			 	$data["status"] = 'false';
			}
			
			$this->load->view($this->data->controller . '/' . $this->data->method,$data);
		}
		
		
		
		# Manage TrialBalance 
		public function TrialBalance()
		{
			// $fin_years=$this->getFinancialYear();
			// $start=$fin_years[0];
			// $todate=$fin_years[1];
			
			// $this->data->table = 'entriesmaster';
			$this->data->table = 'tbl_balance';
			$query = $this->db->order_by("entrycode", "ASC")->get($this->data->table);
			$data["list"] = $query->result();
			// echo "<pre>";print_r($data["list"]);die();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		# Active Members Here 
		public function ActiveMembers()
		{
			$this->data->table = 'members';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Members';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE && !is_numeric($this->uri->segment(3)))
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditMember";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									
									// if ($this->form_validation->run($this->data->key) == FALSE)
									// {
									//     $msg = explode('</p>', validation_errors());
									//     $output['msg'] = str_ireplace('<p>', '', $msg[0]);
									// }
									// else
									// {
									$updateData = [
                                    'pf_number' => $this->input->post('pf_number'),
                                    'name' => $this->input->post('name'),
									'pm_saving' => $this->input->post('pm_saving'),
									'shares' => $this->input->post('shares'),
                                    'loan' => $this->input->post('loan'),
                                    'loan_credit' => $this->input->post('loan_credit'),
                                    'savings' => $this->input->post('savings'),
                                    // 'is_status' => 'true',
                                    'is_verified' => 'true',
                                    'created_at' => $this->data->timestamp,
                                    'modified_at' => $this->data->timestamp
									];
									
									
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									if ($result)
									{
										
										// savings 
										$this->db->where(array('pf_no'=>$this->input->post('pf_number'),'entrydesc'=>'TO OP.BAL. B/F 01/04/2022','entrycode'=>'SAVACC'))->update('tbl_entry',array('credit'=>$this->input->post('savings')));
										
										// loan debit 
										if(!empty($this->input->post('loan')))
										{
											$this->db->where(array('pf_no'=>$this->input->post('pf_number'),'entrydesc'=>'TO OP.BAL. B/F 01/04/2022','entrycode'=>'LONACC'))->update('tbl_entry',array('debit'=>$this->input->post('loan')));
										}
										if(!empty($this->input->post('loan_credit')))
										{
											$this->db->where(array('pf_no'=>$this->input->post('pf_number'),'entrydesc'=>'TO OP.BAL. B/F 01/04/2022','entrycode'=>'LONACC'))->update('tbl_entry',array('credit'=>$this->input->post('loan_credit')));
										}
										// loan credit 
										
										
										// shares 
										$this->db->where(array('pf_no'=>$this->input->post('pf_number'),'entrydesc'=>'TO OP.BAL. B/F 01/04/2022','entrycode'=>'SHAACC'))->update('tbl_entry',array('credit'=>$this->input->post('shares')));
										
										
										// var_dump($members);die();
										
										// end here 
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Saving.';
									}
									// }
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				// $this->data->table = 'members';
				// $query = $this->db->order_by("pf_number", "ASC")->where('is_status','true')->get($this->data->table);
				// $data["list"] = $query->result();
				// $this->load->view($this->data->controller . '/' . $this->data->method, $data);
				
				
				if($this->uri->segment(3)=='3' && is_numeric($this->uri->segment(3)))
				{
					$id = $this->uri->segment(3);
					$search = $this->input->post("search");
					
					$this->load->library('pagination');
					$config1=[
					'base_url'=>base_url('Admin/ActiveMembers'),
					'per_page'=>15, // pass limit number of rows in database
					'total_rows'=>$this->db->query("SELECT * FROM members WHERE pf_number LIKE '%$search%' OR name LIKE '%$search%' OR pm_saving LIKE '%$search%' OR loan_interest LIKE '%$search%' OR  saving_interest LIKE '%$search%' OR savings LIKE '%$search%' OR loan LIKE '%$search%' OR loan_credit LIKE '%$search%' OR shares LIKE '%$search%' order by pf_number ASC")->num_rows(),
					'num_links' => 1,
					'next_link' => 'Next >',
					'prev_link' => '< Previous',
					'full_tag_open'=>"<ul class='pagination pagination-circular'>",
					'full_tag_close'=>"</ul>",
					'next_tag_open'=>"<li id='next'>",
					'next_tag_close'=>"</li>",
					'prev_tag_open'=>"<li id='previous'>",
					'prev_tag_close'=>"</li>",
					'num_tag_open'=>"<li>",
					'num_tag_close'=>"</li>",
					'cur_tag_open'=>"<li class='active current'><a>",
					'cur_tag_close'=>"</a></li>",
					];
					$this->pagination->initialize($config1); //pass as a offset
					
					// var_dump($lim);die();
					$lim=$this->uri->segment(4);
					if(empty($lim)){
						$lim = 0;
					}
					
					$data['list'] = $this->db->query("SELECT * FROM members WHERE pf_number LIKE '%$search%' OR name LIKE '%$search%' OR pm_saving LIKE '%$search%' OR loan_interest LIKE '%$search%' OR  saving_interest LIKE '%$search%' OR savings LIKE '%$search%' OR loan LIKE '%$search%' OR loan_credit LIKE '%$search%' OR shares LIKE '%$search%' order by pf_number ASC LIMIT $lim,$config1[per_page] ")->result();
					// var_dump($data);die();
					
					$data['members']= $this->db->query("select * from members ")->result();
					
					
					// Start Here 
					$totalvalue = $data['members'];
					$total_savings = 0;
					$total_loan = 0;
					$total_shares = 0;
					$total_loan_int = 0;
					$total_saving_int = 0;
					$total_loan_credit = 0;
					
					foreach ($totalvalue as $item)
					{
						if(!empty($item->savings))
						{
							$total_savings+=$item->savings;
							
						}
						if(!empty($item->loan))
						{
							$total_loan+=$item->loan;
						}
						if(!empty($item->shares))
						{
							$total_shares+=$item->shares;
						}
						if(!empty($item->loan_interest))
						{
							$total_loan_int+=$item->loan_interest;
						}
						if(!empty($item->saving_interest))
						{
							$total_saving_int+=$item->saving_interest;
						}
						if(!empty($item->loan_credit))
						{
							$total_loan_credit+=$item->loan_credit;
						}
					}
					$data['total_savings'] = $total_savings;
					$data['total_loan'] = $total_loan;
					$data['total_shares'] = $total_shares;
					$data['total_loan_int'] = $total_loan_int;
					$data['total_saving_int'] = $total_saving_int;
					$data['total_loan_credit'] = $total_loan_credit;
					
					$this->load->view($this->data->controller . '/' . $this->data->method, $data);
					
					
					
					
					// echo "<pre>";print_r($query);die();
				}
				else
				{
					$this->load->library('pagination');
					$config=[
					'base_url'=>base_url('Admin/ActiveMembers'),
					'per_page'=>15, // pass limit number of rows in database
					'total_rows'=>$this->db->get('members')->num_rows(),
					'num_links' => 1,
					'next_link' => 'Next >',
					'prev_link' => '< Previous',
					'full_tag_open'=>"<ul class='pagination pagination-circular'>",
					'full_tag_close'=>"</ul>",
					'next_tag_open'=>"<li id='next'>",
					'next_tag_close'=>"</li>",
					'prev_tag_open'=>"<li id='previous'>",
					'prev_tag_close'=>"</li>",
					'num_tag_open'=>"<li>",
					'num_tag_close'=>"</li>",
					'cur_tag_open'=>"<li class='active current'><a>",
					'cur_tag_close'=>"</a></li>",
					];
					$this->pagination->initialize($config); //pass as a offset
					$lim=$this->uri->segment(3);
					if(empty($lim)){
						$lim = 0;
					}
					
					$data['list']= $this->db->query("select * from members order by pf_number ASC  LIMIT $lim, $config[per_page]")->result();
					
					$data['members']= $this->db->query("select * from members ")->result();
					
					
					// Start Here 
					$totalvalue = $data['members'];
					$total_savings = 0;
					$total_loan = 0;
					$total_shares = 0;
					$total_loan_int = 0;
					$total_saving_int = 0;
					$total_loan_credit = 0;
					
					foreach ($totalvalue as $item)
					{
						if(!empty($item->savings))
						{
							$total_savings+=$item->savings;
							
						}
						if(!empty($item->loan))
						{
							$total_loan+=$item->loan;
						}
						if(!empty($item->shares))
						{
							$total_shares+=$item->shares;
						}
						if(!empty($item->loan_interest))
						{
							$total_loan_int+=$item->loan_interest;
						}
						if(!empty($item->saving_interest))
						{
							$total_saving_int+=$item->saving_interest;
						}
						if(!empty($item->loan_credit))
						{
							$total_loan_credit+=$item->loan_credit;
						}
					}
					$data['total_savings'] = $total_savings;
					$data['total_loan'] = $total_loan;
					$data['total_shares'] = $total_shares;
					$data['total_loan_int'] = $total_loan_int;
					$data['total_saving_int'] = $total_saving_int;
					$data['total_loan_credit'] = $total_loan_credit;
					$this->load->view($this->data->controller . '/' . $this->data->method, $data);
				}
				// $this->load->view($this->data->controller . '/' . $this->data->method, $data);
				
			}
		}
		
		# UserDetails Here 
		public function UserFullDeatils()
		{
			$this->data->table = 'members';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Members';
			$this->data->file_column = 'icon';
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$udata= $this->db->get_where('members',array('id'=>$id))->row();
				$pfno=$udata->pf_number;
				$data['list'] =$udata;
				$data['list1'] = $this->db->get_where('members',array('id'=>$id))->result();
				$data['loan'] = $this->db->get_where('tbl_loans',array('pf_number'=>$pfno))->result();
				
				$data["txn_list"] = $this->db->order_by("id", "DESC")->get_where('tbl_entry',array('pf_no'=>$pfno))->result();
				$this->load->view('Admin/UserFullDeatils', $data);
			}
		}
		
		// Admin/UserFullDetails End Here 
		
		
		
		# Inactive Members Here 
		public function InactiveMembers()
		{
			$this->data->table = 'members';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Members';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditMember";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									
									// if ($this->form_validation->run($this->data->key) == FALSE)
									// {
									//     $msg = explode('</p>', validation_errors());
									//     $output['msg'] = str_ireplace('<p>', '', $msg[0]);
									// }
									// else
									// {
									$updateData = [
                                    'name' => $this->input->post('name'),
                                    'pm_saving' => $this->input->post('pm_saving'),
                                    // 'grade' => $this->input->post('grade'),
                                    // 'designation' => $this->input->post('designation'),
                                    // 'mobile' => $this->input->post('mobile'),
                                    // 'is_status' => 'true',
                                    'is_verified' => 'true',
                                    'created_at' => $this->data->timestamp,
                                    'modified_at' => $this->data->timestamp
									];
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									if ($result)
									{
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
									// }
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				$this->data->table = 'members';
				$query = $this->db->order_by("id", "DESC")->where('is_status','false')->get($this->data->table);
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		
		
		// Inactive Members Show Here
		
		// public function InactiveMembers()
		// {
		// $this->data->table = 'members';
		// $this->data->key = 'Members';
		// $query = $this->db->order_by("id", "DESC")->where('is_deleted', 'true')->get($this->data->table);
		// $data["list"] = $query->result();
		// $this->load->view($this->data->controller . '/' . $this->data->method, $data);
		// }
		
		// Inactive Members  End Here
		
		
		// Manage Member Start Here
		public function ManageMember()
		{
			$this->data->table = 'members';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Members';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							// $data["action"] = "EditCategory";
							$data["action"] = "EditMember";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Add')
					{
						if (!empty($this->input->post()))
						{
							// if ($this->form_validation->run($this->data->key) == FALSE)
							// {
							//     $msg = explode('</p>', validation_errors());
							//     $output['msg'] = str_ireplace('<p>', '', $msg[0]);
							// }
							// else
							// {
							$check = $this->db->get_where('members', ['pf_number' => $this->input->post('pf_number')]);
							if ($check->num_rows() > 0)
							{
								$output['res'] = 'error';
								$output['msg'] = 'PF Number Is Unique';
							}
							else
							{
								$insertData = [
                                'pf_number' => $this->input->post('pf_number'),
                                'name' => $this->input->post('name'),
                                'grade' => $this->input->post('grade'),
                                'desigination' => $this->input->post('desigination'),
                                'mobile' => $this->input->post('mobile'),
                                'saving' => 0,
                                'is_status' => 'true',
                                'is_verified' => 'true',
                                'created_at' => $this->data->timestamp,
                                'modified_at' => $this->data->timestamp
								];
								$insertData = $this->security->xss_clean($insertData);
								if ($this->db->insert($this->data->table, $insertData))
								{
									$output['res'] = 'success';
									$output['msg'] = 'Data Added Successfully.';
								}
								else
								{
									$output['res'] = 'error';
									$output['msg'] = 'Something went wrong in Data Shaving.';
								}
							}
							
							// }
						}
						echo json_encode([$output]);
					}
					else if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									// if ($this->form_validation->run($this->data->key) == FALSE)
									// {
									//     $msg = explode('</p>', validation_errors());
									//     $output['msg'] = str_ireplace('<p>', '', $msg[0]);
									// }
									// else
									// {
									$updateData = [
                                    'pf_number' => $this->input->post('pf_number'),
                                    'name' => $this->input->post('name'),
                                    'grade' => $this->input->post('grade'),
                                    'desigination' => $this->input->post('desigination'),
                                    'mobile' => $this->input->post('mobile'),
                                    'saving' => 0,
                                    'is_status' => 'true',
                                    'is_verified' => 'true',
                                    'created_at' => $this->data->timestamp,
                                    'modified_at' => $this->data->timestamp
									];
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									if ($result)
									{
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
									// }
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				$query = $this->db->order_by("id", "DESC")->where('is_deleted', 'false')->get($this->data->table);
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		// Manage Member End Here
		
		
		
		
		public function index()
		{
			redirect(base_url($this->data->controller . '/Dashboard'));
		}
		
		
		#Dashboard
		
		public function Dashboard()
		{
			$data['action'] = 'Dashboard';
			$data['totalmembers']=$this->db->get('members')->num_rows();
			$data['activemembers']=$this->db->get_where('members',['is_status'=>'true'])->num_rows();
			$data['inactivemembers']=$this->db->get_where('members',['is_status'=>'false'])->num_rows();
			$members=$this->db->get('members');
            $total_savings=0;
            $total_loan=0;
            $loan_credit=0;
            $total_shares=0;
            foreach($members->result_array() as $row){
				if(!empty($row['savings']))
				{
					$total_savings+=$row['savings'];
				}
                
				if(!empty($row['loan']))
				{
					$total_loan+=$row['loan'];
				}
				
				if(!empty($row['loan_credit']))
				{
					$loan_credit+=$row['loan_credit'];
				}
				if(!empty($row['shares']))
				{
					$total_shares+=$row['shares'];
				}
                
			}
            $data['totalsavings']=$total_savings;
            $data['totalloan']=$total_loan;
            $data['loan_credit']=$loan_credit;
            $data['totalshares']=$total_shares;
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		public function ShowData()
		{
			$data['list'] = $this->db->get_where('datavalue', ['id' => base64_decode($_REQUEST['id'])])->row();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		public function UpdateProsopography()
		{
			$this->data->key = 'Proposopography';
			$data['list'] = $this->db->get_where('datavalue', ['id' => base64_decode($_REQUEST['id'])])->row();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		public function ManageProsopography()
		{
			$this->data->table = 'datavalue';
			$this->data->folder = 'category';
			$this->data->key = 'Prosopography';
			$this->data->file_column = 'icon';
			if ($this->uri->segment(3) == TRUE)
			{
				if ($this->uri->segment(3) == 'FilterDraft')
				{
					if (!empty($this->input->post($this->input->get())))
					{
						$class = $this->input->get('classid');
						$section = $this->input->get('sectionid');
						$branch = $this->input->get('branch');
						$data['list'] = $this->db->order_by('id', 'DESC')->get_where('datavalue', ['draft_status' => 'false'])->result_array();
						$data['final'] = $this->db->order_by('id', 'DESC')->get_where('datavalue', ['draft_status' => 'true', 'branch' => $branch, 'class' => $class, 'section' => $section])->result_array();
						$this->load->view($this->data->controller . '/' . $this->data->method, $data);
					}
				}
				else if ($this->uri->segment(3) == 'FilterFinal')
				{
					if (!empty($this->input->post($this->input->get())))
					{
						$class = $this->input->get('classid');
						$section = $this->input->get('sectionid');
						$branch = $this->input->get('branch');
						$data['list'] = $this->db->order_by('id', 'DESC')->get_where('datavalue', ['draft_status' => 'false', 'branch' => $branch, 'class' => $class, 'section' => $section])->result_array();
						$data['final'] = $this->db->order_by('id', 'DESC')->get_where('datavalue', ['draft_status' => 'true'])->result_array();
						$this->load->view($this->data->controller . '/' . $this->data->method, $data);
					}
				}
			}
			else
			{
				$data['list'] = $this->db->order_by('id', 'DESC')->get_where('datavalue', ['branch' => $_REQUEST['branch'], 'draft_status' => 'false'])->result_array();
				$data['final'] = $this->db->order_by('id', 'DESC')->get_where('datavalue', ['branch' => $_REQUEST['branch'], 'draft_status' => 'true'])->result_array();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		public function TotalProsopography()
		{
			$this->data->table = 'datavalue';
			$this->data->folder = 'category';
			$this->data->key = 'Prosopography';
			$this->data->file_column = 'icon';
			$data['list'] = $this->db->order_by('id', 'DESC')->get_where('datavalue', ['draft_status' => 'false'])->result_array();
			$data['final'] = $this->db->order_by('id', 'DESC')->get_where('datavalue', ['draft_status' => 'true'])->result_array();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		public function AddProsopography()
		{
			$this->data->table = 'datavalue';
			$this->data->folder = 'category';
			$this->data->key = 'Prosopography';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$class = $this->uri->segment(4);
					$section = $this->uri->segment(5);
					$branch = $this->uri->segment(6);
					$query = $this->db->where(['class' => $class, 'section' => $section, 'branch' => $branch])->get($this->data->table);
					if ($query->num_rows())
					{
						
						$data["list"] = $$query->result_array();
						if ($action == 'Edit')
						{
							$data["action"] = "Datanotfound";
							$this->load->view($this->data->controller . '/GetData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						$data["action"] = "Datanotfound";
						$this->load->view($this->data->controller . '/GetData', $data);
					}
				}
				else
				{
					if ($action == 'Add')
					{
						if (!empty($this->input->post()))
						{
							if (!empty($this->input->post('draft')))
							{
								$draft_status = 'true';
							}
							else
							{
								$draft_status = 'false';
							}
							
							$classsection = explode('-', $this->input->post('classsection'));
							$class = $classsection[0];
							$section = $classsection[1];
							
							$insertData = [
                            'class' => $class,
                            'section' => $section,
                            'studentname' => $this->input->post('studentname'),
                            'srnumber' => $this->input->post('srnumber'),
                            'joining' => $this->input->post('joining'),
                            'branch' => $this->input->post('branch'),
                            'class1' => $this->input->post('class1'),
                            'class2' => $this->input->post('class2'),
                            'class3' => $this->input->post('class3'),
                            'class4' => $this->input->post('class4'),
                            'workhabit1' => implode('; ', empty($this->input->post('workhabit1')) ? array() : $this->input->post('workhabit1')),
                            'workhabit2' => implode('; ', empty($this->input->post('workhabit1')) ? array() : $this->input->post('workhabit1')),
                            'workhabit3' => implode('; ', empty($this->input->post('workhabit1')) ? array() : $this->input->post('workhabit1')),
                            'workhabit4' => implode('; ', empty($this->input->post('workhabit1')) ? array() : $this->input->post('workhabit1')),
                            'generalbehaviour1' => implode('; ', empty($this->input->post('generalbehaviour1')) ? array() : $this->input->post('generalbehaviour1')),
                            'generalbehaviour2' => implode('; ', empty($this->input->post('generalbehaviour2')) ? array() : $this->input->post('generalbehaviour2')),
                            'generalbehaviour3' => implode('; ', empty($this->input->post('generalbehaviour3')) ? array() : $this->input->post('generalbehaviour3')),
                            'generalbehaviour4' => implode('; ', empty($this->input->post('generalbehaviour4')) ? array() : $this->input->post('generalbehaviour4')),
                            'physicalhealth1' => implode('; ', empty($this->input->post('physicalhealth1')) ? array() : $this->input->post('physicalhealth1')),
                            'physicalhealth2' => implode('; ', empty($this->input->post('physicalhealth2')) ? array() : $this->input->post('physicalhealth2')),
                            'physicalhealth3' => implode('; ', empty($this->input->post('physicalhealth3')) ? array() : $this->input->post('physicalhealth3')),
                            'physicalhealth4' => implode('; ', empty($this->input->post('physicalhealth4')) ? array() : $this->input->post('physicalhealth4')),
                            'lifeskill1' => implode('; ', empty($this->input->post('lifeskill1')) ? array() : $this->input->post('lifeskill1')),
                            'lifeskill2' => implode('; ', empty($this->input->post('lifeskill2')) ? array() : $this->input->post('lifeskill2')),
                            'lifeskill3' => implode('; ', empty($this->input->post('lifeskill3')) ? array() : $this->input->post('lifeskill3')),
                            'lifeskill4' => implode('; ', empty($this->input->post('lifeskill4')) ? array() : $this->input->post('lifeskill4')),
                            'interpersonalskill1' => implode('; ', empty($this->input->post('interpersonalskill1')) ? array() : $this->input->post('interpersonalskill1')),
                            'interpersonalskill2' => implode('; ', empty($this->input->post('interpersonalskill2')) ? array() : $this->input->post('interpersonalskill2')),
                            'interpersonalskill3' => implode('; ', empty($this->input->post('interpersonalskill3')) ? array() : $this->input->post('interpersonalskill3')),
                            'interpersonalskill4' => implode('; ', empty($this->input->post('interpersonalskill4')) ? array() : $this->input->post('interpersonalskill4')),
                            'learningskill1' => implode('; ', empty($this->input->post('learningskill1')) ? array() : $this->input->post('learningskill1')),
                            'learningskill2' => implode('; ', empty($this->input->post('learningskill2')) ? array() : $this->input->post('learningskill2')),
                            'learningskill3' => implode('; ', empty($this->input->post('learningskill3')) ? array() : $this->input->post('learningskill3')),
                            'learningskill4' => implode('; ', empty($this->input->post('learningskill4')) ? array() : $this->input->post('learningskill4')),
                            'attitude1' => implode('; ', empty($this->input->post('attitude1')) ? array() : $this->input->post('attitude1')),
                            'attitude2' => implode('; ', empty($this->input->post('attitude2')) ? array() : $this->input->post('attitude2')),
                            'attitude3' => implode('; ', empty($this->input->post('attitude3')) ? array() : $this->input->post('attitude3')),
                            'attitude4' => implode('; ', empty($this->input->post('attitude4')) ? array() : $this->input->post('attitude4')),
                            'scientific1' => implode('; ', empty($this->input->post('scientific1')) ? array() : $this->input->post('scientific1')),
                            'scientific2' => implode('; ', empty($this->input->post('scientific2')) ? array() : $this->input->post('scientific2')),
                            'scientific3' => implode('; ', empty($this->input->post('scientific3')) ? array() : $this->input->post('scientific3')),
                            'scientific4' => implode('; ', empty($this->input->post('scientific4')) ? array() : $this->input->post('scientific4')),
                            'acadmic1' => $this->input->post('acadmic1'),
                            'acadmic2' => $this->input->post('acadmic2'),
                            'acadmic3' => $this->input->post('acadmic3'),
                            'acadmic4' => $this->input->post('acadmic4'),
                            'participationinactivity1' => $this->input->post('participationinactivity1'),
                            'participationinactivity2' => $this->input->post('participationinactivity2'),
                            'participationinactivity3' => $this->input->post('participationinactivity3'),
                            'participationinactivity4' => $this->input->post('participationinactivity4'),
                            'achivement1' => $this->input->post('achivement1'),
                            'achivement2' => $this->input->post('achivement2'),
                            'achivement3' => $this->input->post('achivement2'),
                            'achivement4' => $this->input->post('achivement4'),
                            'areaofinterest1' => $this->input->post('areaofinterest1'),
                            'areaofinterest2' => $this->input->post('areaofinterest2'),
                            'areaofinterest3' => $this->input->post('areaofinterest3'),
                            'areaofinterest4' => $this->input->post('areaofinterest4'),
                            'anyotherremark1' => $this->input->post('anyotherremark1'),
                            'anyotherremark2' => $this->input->post('anyotherremark2'),
                            'anyotherremark3' => $this->input->post('anyotherremark3'),
                            'anyotherremark4' => $this->input->post('anyotherremark4'),
                            'nameofteacher1' => $this->input->post('nameofteacher1'),
                            'nameofteacher2' => $this->input->post('nameofteacher2'),
                            'nameofteacher3' => $this->input->post('nameofteacher3'),
                            'nameofteacher4' => $this->input->post('nameofteacher4'),
                            'draft_status' => $draft_status,
                            'created_at' => $this->data->timestamp,
                            'is_status' => 'true'
							];
							
							$insertData = $this->security->xss_clean($insertData);
							if (!empty($this->input->post('id')))
							{
								$data = $this->db->where(['id' => $this->input->post('id')])->update($this->data->table, $insertData);
								$output['res'] = 'success';
								$output['msg'] = 'Data Updated Successfully.';
							}
							else
							{
								$data = $this->db->insert($this->data->table, $insertData);
								$output['res'] = 'success';
								$output['msg'] = 'Data Added Successfully.';
							}
						}
						echo json_encode([$output]);
					}
					else if ($action == 'Edit')
					{
						$data["action"] = "Datanotfound";
						$this->load->view($this->data->controller . '/GetData', $data);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				$this->load->view($this->data->controller . '/' . $this->data->method);
			}
		}
		
		#Manage Categories
		
		public function ManageCategories()
		{
			$this->data->table = 'interest_categories';
			$this->data->folder = 'category';
			$this->data->key = 'Category';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditCategory";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Add')
					{
						if (!empty($this->input->post()))
						{
							if (empty($_FILES['icon']['name']))
							{
								// $this->form_validation->set_rules('icon', 'Icon', 'required');
								$filename = 'logo.png';
							}
							else
							{
								$extension = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
								$filename = time() . rand() . "." . $extension;
							}
							if ($this->form_validation->run($this->data->key) == FALSE)
							{
								$msg = implode('</p>', validation_errors());
								$output['msg'] = str_ireplace('<p>', '', $msg[0]);
							}
							else
							{
								$insertData = [
                                'name' => $this->input->post('name'),
                                'url' => $this->input->post('url'),
                                'description ' => $this->input->post('name'),
                                'icon' => $filename,
                                'is_status' => 'true',
                                'created_at' => $this->data->timestamp,
                                'modified_at' => $this->data->timestamp
								];
								$insertData = $this->security->xss_clean($insertData);
								if ($this->db->insert($this->data->table, $insertData))
								{
									$output['res'] = 'success';
									$output['msg'] = 'Data Added Successfully.';
									if (!empty($_FILES['icon']['name']))
									{
										$upload_errors           = array();
										$config['upload_path']   = './uploads/' . $this->data->folder . '/';
										$config['allowed_types'] = 'gif|jpg|png|jpeg';
										$config['max_size']      = 2048;
										$config['file_name']     = $filename;
										$this->load->library('upload', $config);
										if (!$this->upload->do_upload($this->data->file_column))
										{
											array_push($upload_errors, array(
                                            'error_upload' => $this->upload->display_errors()
											));
											$output['msg'] = 'Data saved but error in file upload.';
										}
									}
								}
								else
								{
									$output['msg'] = 'Something went wrong in Data Shaving.';
								}
							}
						}
						echo json_encode([$output]);
					}
					else if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									if ($this->form_validation->run($this->data->key) == FALSE)
									{
										$msg = implode('</p>', validation_errors());
										$output['msg'] = str_ireplace('<p>', '', $msg[0]);
									}
									else
									{
										$old_filename = $data['list'][0]->icon;
										$filename = $old_filename;
										if (!empty($_FILES['icon']['name']))
										{
											$extension = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
											$filename = time() . rand() . "." . $extension;
										}
										$updateData = [
                                        'name' => $this->input->post('name'),
                                        'url' => $this->input->post('url'),
                                        'description ' => $this->input->post('name'),
                                        'icon' => $filename,
                                        'modified_at' => $this->data->timestamp
										];
										$updateData = $this->security->xss_clean($updateData);
										$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
										if ($result)
										{
											$output['res'] = 'success';
											$output['msg'] = 'Data Updated Successfully.';
											if (!empty($_FILES['icon']['name']))
											{
												$upload_errors           = array();
												$config['upload_path']   = './uploads/' . $this->data->folder . '/';
												$config['allowed_types'] = 'gif|jpg|png|jpeg';
												$config['max_size']      = 2048;
												$config['file_name']     = $filename;
												$this->load->library('upload', $config);
												if (!$this->upload->do_upload($this->data->file_column))
												{
													array_push($upload_errors, array(
                                                    'error_upload' => $this->upload->display_errors()
													));
													$output['msg'] = 'Data saved but error in file upload.';
												}
												if (file_exists('./uploads/' . $this->data->folder . '/' . $old_filename))
												
												{
													unlink('./uploads/' . $this->data->folder . '/' . $old_filename);
												}
											}
										}
										else
										{
											$output['msg'] = 'Something went wrong in Data Shaving.';
										}
									}
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				$query = $this->db->order_by("id", "DESC")->get($this->data->table);
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		
		#Manage Subcategories
		
		public function ManageSubcategories()
		{
			$this->data->table = 'interest_subcategories';
			$this->data->folder = 'subcategory';
			$this->data->key = 'Subcategory';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			
			$data["categoryList"] = $this->db->where('is_status', 'true')->order_by("id", "DESC")->get('interest_categories')->result();
			
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditSubcategory";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Add')
					{
						if (!empty($this->input->post()))
						{
							if (empty($_FILES['icon']['name']))
							{
								// $this->form_validation->set_rules('icon', 'Icon', 'required');
								$filename = 'logo.png';
							}
							else
							{
								$extension = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
								$filename = time() . rand() . "." . $extension;
							}
							if ($this->form_validation->run($this->data->key) == FALSE)
							{
								$msg = implode('</p>', validation_errors());
								$output['msg'] = str_ireplace('<p>', '', $msg[0]);
							}
							else
							{
								$insertData = [
                                'category_id' => $this->input->post('category_id'),
                                'name' => $this->input->post('name'),
                                'url' => $this->input->post('url'),
                                'description ' => $this->input->post('name'),
                                'icon' => $filename,
                                'is_status' => 'true',
                                'created_at' => $this->data->timestamp,
                                'modified_at' => $this->data->timestamp
								];
								$insertData = $this->security->xss_clean($insertData);
								if ($this->db->insert($this->data->table, $insertData))
								{
									$output['res'] = 'success';
									$output['msg'] = 'Data Added Successfully.';
									if (!empty($_FILES['icon']['name']))
									{
										$upload_errors           = array();
										$config['upload_path']   = './uploads/' . $this->data->folder . '/';
										$config['allowed_types'] = 'gif|jpg|png|jpeg';
										$config['max_size']      = 2048;
										$config['file_name']     = $filename;
										$this->load->library('upload', $config);
										if (!$this->upload->do_upload($this->data->file_column))
										{
											array_push($upload_errors, array(
                                            'error_upload' => $this->upload->display_errors()
											));
											$output['msg'] = 'Data saved but error in file upload.';
										}
									}
								}
								else
								{
									$output['msg'] = 'Something went wrong in Data Shaving.';
								}
							}
						}
						echo json_encode([$output]);
					}
					else if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									if ($this->form_validation->run($this->data->key) == FALSE)
									{
										$msg = implode('</p>', validation_errors());
										$output['msg'] = str_ireplace('<p>', '', $msg[0]);
									}
									else
									{
										$old_filename = $data['list'][0]->icon;
										$filename = $old_filename;
										if (!empty($_FILES['icon']['name']))
										{
											$extension = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
											$filename = time() . rand() . "." . $extension;
										}
										$updateData = [
                                        'category_id' => $this->input->post('category_id'),
                                        'name' => $this->input->post('name'),
                                        'url' => $this->input->post('url'),
                                        'description ' => $this->input->post('name'),
                                        'icon' => $filename,
                                        'modified_at' => $this->data->timestamp
										];
										$updateData = $this->security->xss_clean($updateData);
										$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
										if ($result)
										{
											$output['res'] = 'success';
											$output['msg'] = 'Data Updated Successfully.';
											if (!empty($_FILES['icon']['name']))
											{
												$upload_errors           = array();
												$config['upload_path']   = './uploads/' . $this->data->folder . '/';
												$config['allowed_types'] = 'gif|jpg|png|jpeg';
												$config['max_size']      = 2048;
												$config['file_name']     = $filename;
												$this->load->library('upload', $config);
												if (!$this->upload->do_upload($this->data->file_column))
												{
													array_push($upload_errors, array(
                                                    'error_upload' => $this->upload->display_errors()
													));
													$output['msg'] = 'Data saved but error in file upload.';
												}
												unlink('./uploads/' . $this->data->folder . '/' . $old_filename);
											}
										}
										else
										{
											$output['msg'] = 'Something went wrong in Data Shaving.';
										}
									}
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				$query = $this->db->order_by("id", "DESC")->get($this->data->table);
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		
		
		# Account Settings
		public function AccountSettings()
		{
			$this->data->table = $this->roleData->table_name;
			$data['profile'] = $this->userData;
			$this->data->folder = 'profile_pic';
			$this->data->key = 'ChangePassword';
			$this->data->file_column = 'profile_pic';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($action == 'Logout')
				{
					$this->Auth_model->logout($this->roleData->table_name, $this->user_id);
					$this->session->unset_userdata($this->roleData->session);
					$this->session->set_flashdata(['res' => 'success', 'msg' => 'Logout Successfully.']);
					redirect(base_url('Auth/AdminLogin'));
				}
				else if ($action == 'ChangePassword')
				{
					if (!empty($this->input->post()))
					{
						if ($this->form_validation->run($this->data->key) == FALSE)
						{
							$msg = implode('</p>', validation_errors());
							$output['msg'] = str_ireplace('<p>', '', $msg[0]);
						}
						else
						{
							$opass = $this->input->post('opass');
							$npass = $this->input->post('npass');
							$cpass = $this->input->post('cpass');
							
							$user_id = $this->user_id;
							
							$result = $this->db->where('id', $user_id)->get($this->data->table);
							$values = $result->row();
							if ($values->password == $opass)
							{
								if ($npass == $cpass)
								{
									$result = $this->db->where('id', $user_id)->update($this->data->table, ['password' => $npass]);
									if ($result)
									{
										$output['res'] = 'success';
										$output['msg'] = 'Password Changed.';
									}
									else
									{
										$output['msg'] = 'Failed !';
									}
								}
								else
								{
									
									$output['msg'] = 'New and Confirm Password are not match.';
								}
							}
							else
							{
								$output['msg'] = 'Invalid Current Password';
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						$this->load->view($this->data->controller . '/ChangePassword', $data);
					}
				}
				else if ($action == 'UpdateProfile')
				{
					if (!empty($this->input->post('name')))
					{
						$user_id = $this->user_id;
						
						$query = $this->db->where('id', $user_id)->get($this->data->table);
						$data['list'] = $query->result();
						$old_filename = $data['list'][0]->icon;
						$filename = $old_filename;
						if (!empty($_FILES['icon']['name']))
						{
							$extension = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
							$filename = time() . rand() . "." . $extension;
						}
						$updateData = [
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'mobile' => $this->input->post('mobile'),
                        'icon' => $filename,
                        'modified_at' => $this->data->timestamp
						];
						$updateData = $this->security->xss_clean($updateData);
						$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
						if ($result)
						{
							$output['res'] = 'success';
							$output['msg'] = 'Profile Updated Successfully.';
							if (!empty($_FILES['icon']['name']))
							{
								$upload_errors           = array();
								$config['upload_path']   = './uploads/' . $this->data->folder . '/';
								$config['allowed_types'] = 'gif|jpg|png|jpeg';
								$config['max_size']      = 2048;
								$config['file_name']     = $filename;
								$this->load->library('upload', $config);
								if (!$this->upload->do_upload('icon'))
								{
									array_push($upload_errors, array(
                                    'error_upload' => $this->upload->display_errors()
									));
									$output['msg'] = 'Data saved but error in file upload.';
								}
								unlink('./uploads/' . $this->data->folder . '/' . $old_filename);
							}
						}
						else
						{
							$output['msg'] = 'Something went wrong in Data Shaving.';
						}
						echo json_encode([$output]);
					}
					else
					{
						$this->load->view($this->data->controller . '/UpdateProfile', $data);
					}
				}
				else
				{
					redirect(base_url($this->data->controller . '/' . $this->data->method));
				}
			}
			else
			{
				$data["activitiesList"] = $this->Auth_model->getResultDesc('activities', ['role_role_id' => $this->roleData->id, 'user_user_id' => $this->userData->id], 'id');
				
				$i = 0;
				$return = [];
				foreach ($data["activitiesList"] as $item)
				{
					$return[$i] = $item;
					$roleData = $this->Auth_model->getRole($item->role_id);
					$return[$i]->user = $this->db->where('id', $item->user_id)->get($roleData->table_name)->row();
					$i++;
				}
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		
		
		# Ajax Entry Code Start Here 
		public function getEntry()
		{
			$id = $this->input->post('id');
			if(!empty($id))
			{
				// $get = $this->db->get_where('entriesmaster',array('entrycode'=>$id))->row();
				// echo $get->entrydesc;
				
				$get = $this->db->get_where('entriesmaster',array('entrycode'=>$id))->row();
				if(!empty($get))
				{
					echo $get->entrydesc;
				}
			}
		}
		
		
		# Ajax District Start Here 
		public function getDistrict()
		{
			$id = $this->input->post('id');
			if(!empty($id))
			{
				$get = $this->db->like('district',$id,'after')->get('districts')->row();
				//echo $get->district;
				
				$name = substr($get->district, 0, 6);
				$name=strtoupper($name);
				echo $name;
				
			}
		}
		
		
		# Ajax Start Here For getPFNO
		public function getPFNO()
		{
			$id = $this->input->post('id');
			if(!empty($id))
			{
				$get = $this->db->get_where('members',array('pf_number'=>$id))->result();
				foreach($get as $value)
				{
					echo $value->name;
				}
			}
		}
		
		
		# Ajax Start Here For getPFNO1
		public function getPFNO1()
		{
			$id = $this->input->post('id');
			if(!empty($id))
			{
				$get = $this->db->get_where('members',array('pf_number'=>$id))->result();
				foreach($get as $value)
				{
					echo $value->name;
				}
			}
		}
		
		
		// Add Entry Start Here
		public function NewEntry()
		{
			$this->data->table = 'tbl_entry';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Entry';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditMember";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Add')
					{
						$vno = $this->input->post('vno');
						$date = $this->input->post('date');
						$entrycode = $this->input->post('entrycode');
						$pfno = $this->input->post('pfno');
						$entrydesc = $this->input->post('entrydesc');
						$debit = $this->input->post('debit');
						$credit = $this->input->post('credit');
						$entry_type = $this->input->post('entry_type');
						$districtcode=$this->input->post("districtcode");
						
						
						
						$total_entries=count($vno);
						
						$insert_status=false;
						
						for($i=0; $i<$total_entries; $i++)
						{	
							// again variable create
							$credit2[$i]= "";
							
							$memberData = $this->db->get_where('members',array('pf_number'=>$pfno[$i]))->row();
							if($entrycode[$i]=="LONACC")
							{
								if($debit[$i])
								{
									$debit[$i] = $debit[$i];
								}
								else
								{
									// $entrydesc[$i]=trim($entrydesc[$i]);
									
									if($entrydesc[$i]!="BY AMT.CHQ" AND $entrydesc[$i]!="BY AMT.ADJ")
									{
										// $credit2[$i] = $credit[$i];
										$credit2[$i] = $credit[$i]-$memberData->pm_saving;
									}
									else
									{
										// $credit2[$i] = $credit[$i]-$memberData->pm_saving;
										$credit2[$i] = $credit[$i];
									}
									
									// $credit2[$i] = $credit[$i]-$memberData->pm_saving;
									
								}
								
							}
							else 
							{
								$credit2[$i] = $credit[$i];
							}
							
							
							$insertData=array();
							// this code is cashbook and journal 
							if(!empty($districtcode[$i])){
								$insertData = [
								'vno' => $vno[$i],
								'date_time' => $date[$i],
								'entrycode' => $entrycode[$i],
								'entrydesc' => $entrydesc[$i],
								'pf_no' => $pfno[$i],
								'debit' => $debit[$i],
								'credit' => $credit2[$i],
								'entry_type' => $entry_type,
								'districtcode' => $districtcode[$i],
								'created_at' => $this->data->timestamp,
								];
							}
							else 
							{
								$insertData = [
								'vno' => $vno[$i],
								'date_time' => $date[$i],
								'entrycode' => $entrycode[$i],
								'entrydesc' => $entrydesc[$i],
								'pf_no' => $pfno[$i],
								'debit' => $debit[$i],
								'credit' => $credit2[$i],
								'entry_type' => $entry_type,
								'districtcode' => "",
								'created_at' => $this->data->timestamp,
								];
								
							}
							
							// this code is cashbook and journal end here
							
							$memberData = $this->db->get_where('members',array('pf_number'=>$pfno[$i]))->row();
							
							$insertData = $this->security->xss_clean($insertData);
							if ($this->db->insert($this->data->table, $insertData))
							{
								if($entrycode[$i]=="LONACC")
								{
									
									if($entrydesc[$i]!="BY AMT.CHQ" AND $entrydesc[$i]!="BY AMT.ADJ")
									{
										if(!empty($credit[$i]))
										{
											$credit1[$i] = $memberData->pm_saving;
											
											$insertData1=array();
											// this code is cashbook and journal
											if(!empty($districtcode[$i])){
												$insertData1 = [
												'vno' => $vno[$i],
												'date_time' => $date[$i],
												'entrycode' => 'SAVACC',
												'entrydesc' => $entrydesc[$i],
												'pf_no' => $pfno[$i],
												'debit' => '',
												// 'debit' => $debit[$i],
												'credit' => $credit1[$i],
												'entry_type' => $entry_type,
												'districtcode' => $districtcode[$i],
												'created_at' => $this->data->timestamp,
												// 'date_time' => date('Y-m-d'),
												];
											}
											else 
											{
												$insertData1 = [
												'vno' => $vno[$i],
												'date_time' => $date[$i],
												'entrycode' => 'SAVACC',
												'entrydesc' => $entrydesc[$i],
												'pf_no' => $pfno[$i],
												'debit' => '',
												// 'debit' => $debit[$i],
												'credit' => $credit1[$i],
												'entry_type' => $entry_type,
												'districtcode' => "",
												'created_at' => $this->data->timestamp,
												// 'date_time' => date('Y-m-d'),
												];
											}
											
											$insertData1 = $this->security->xss_clean($insertData1);
											$this->db->insert('tbl_entry', $insertData1);
										}
										
									}
								}
								
								
								// end here 
								
								
								$insert_status=true;
								
								// Entry Code Wise 
								
								if($entrycode[$i]=="SAVACC")
								{
									// for Saving Account Conditions
									if(!empty($debit[$i])) {
										// debit case condition
										$this->db->where('pf_number', $pfno[$i])->update('members',array('savings'=>(float)$memberData->savings-(float)$debit[$i]));
									}
									if(!empty($credit[$i])) {
										// credit case condition
										
										$this->db->where('pf_number', $pfno[$i])->update('members',array('savings'=>(float)$memberData->savings+(float)$credit[$i]));
									}
								}
								else if($entrycode[$i]=="SHAACC")
								{
									// for Share Account Conditions
									
									if(!empty($debit[$i])) {
										// debit case condition
										$this->db->where('pf_number', $pfno[$i])->update('members',array('shares'=>(float)$memberData->shares-(float)$debit[$i]));
									}
									if(!empty($credit[$i])) {
										// credit case condition
										$this->db->where('pf_number', $pfno[$i])->update('members',array('shares'=>(float)$memberData->shares+(float)$credit[$i]));
									}
								}
								else if($entrycode[$i]=="LONACC")
								{
									// for Loan Account Conditions
									if(!empty($debit[$i])) 
									{
										// debit case condition
										// if($debit[$i]>$memberData->loan) 
										// {
										
										$this->db->where('pf_number', $pfno[$i])->update('members',array('loan'=>$memberData->loan+$debit[$i]));
										// }
										
									}
									if(!empty($credit[$i])) 
									{
										
										// credit case condition
										// if(!empty($memberData->loan_credit))
										// {
										if($entrydesc[$i]!="BY AMT.CHQ" AND $entrydesc[$i]!="BY AMT.ADJ")
										{
											$credit[$i] = $credit[$i]-$memberData->pm_saving;
											
											$this->db->where('pf_number', $pfno[$i])->update('members',array('loan_credit'=>$memberData->loan_credit+$credit[$i],'savings'=>$memberData->savings+$memberData->pm_saving));
											
										}
										else
										{
											$this->db->where('pf_number', $pfno[$i])->update('members',array('loan_credit'=>$memberData->loan_credit+$credit[$i],'savings'=>$memberData->savings));
											
										}
										
										
										// end here 
										// }
										// else 
										// {
										$insert_status=true;
										// }
									}
									
								}
								else if($entrycode[$i]=="SALACC")
								{
									// for Salary Account Conditions
									
									if(!empty($debit[$i])) {
										// debit case condition
										
									}
									if(!empty($credit[$i])) {
										// credit case condition
										
									}
									
								}
								// end if condition here 	
							}
							else
							{
								$insert_status=false;
								break;
							}
						}
						
						if ($insert_status == true)
						{
							$output['res'] = 'success';
							$output['msg'] = 'Entry Added Successfully.';
							
						}
						else
						{
							$output['res'] = 'error';
							$output['msg'] = 'Something went wrong in Data Shaving.';
						}
						
						echo json_encode([$output]);
					}
					// next action here 
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				$query = $this->db->order_by("id", "DESC")->get($this->data->table);
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}	
		}
		// Add Entry End Here
		
		
		
		
		# HODeduction Start Here
		public function HODeduction()
		{
			$this->data->table = 'tbl_entry';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Entry';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditMember";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Add')
					{
						$id = $this->input->post('id');
						$ho_deduction = $this->input->post('ho_deduction');
						$vno = $this->input->post('vno');
						$date = $this->input->post('date');
						$entrydesc = $this->input->post('entrydesc');
						$pfno = $this->input->post('pfno');
						$debit = $this->input->post('debit');
						$credit = $this->input->post('credit');
						
						$total_entries=count($pfno);
						
						$insert_status=false;
						
						// start here 
						$insertData2=array();
						if(!empty($ho_deduction))
						{
							$insertData2 = [
							'vno' => $vno,
							'date_time' => $date,
							'entrycode' => 'PCFHEA',
							'entrydesc' => $entrydesc,
							'debit' => $ho_deduction,
							'entry_type' => 'J-SO',
							'created_at' => $this->data->timestamp,
							];
							
							$insertData2 = $this->security->xss_clean($insertData2);
							$this->db->insert('tbl_entry', $insertData2);
						}
						// end here 
						
						
						for($i=0; $i<$total_entries; $i++)
						{	
							// var_dump($credit[$i]);
							
							$memberData = $this->db->get_where('members',array('pf_number'=>$pfno[$i]))->row();
							
							$debit1[$i]=0;
							
							$insertData=array();
							if(!empty($debit[$i]))
							{
								$debit1[$i] = $debit[$i]-$memberData->pm_saving;
								
								// this code is journal
								$insertData = [
								'vno' => $vno,
								'date_time' => $date,
								'entrycode' => 'LONACC',
								'entrydesc' => $entrydesc,
								'pf_no' => $pfno[$i],
								// 'debit' => $ho_deduction[$i],
								'credit' => $debit1[$i],
								'entry_type' => 'J-SO',
								'created_at' => $this->data->timestamp,
								];
							}
							else
							{
								$insertData = [
								'vno' => $vno,
								'date_time' => $date,
								'entrycode' => 'SAVACC',
								'entrydesc' => $entrydesc,
								'pf_no' => $pfno[$i],
								'credit' => $credit[$i],
								'entry_type' => 'J-SO',
								'created_at' => $this->data->timestamp,
								];
							}
							
							// this code is cashbook and journal end here
							
							$memberData = $this->db->get_where('members',array('pf_number'=>$pfno[$i]))->row();
							
							$insertData = $this->security->xss_clean($insertData);
							if ($this->db->insert($this->data->table, $insertData))
							{
								$credit2[$i] ='';
								
								$insertData1=array();
								if(!empty($debit[$i]))
								{
									$credit2[$i] = $memberData->pm_saving;
									
									$insertData1 = [
									'vno' => $vno,
									'date_time' => $date,
									'entrycode' => 'SAVACC',
									'entrydesc' => $entrydesc,
									'pf_no' => $pfno[$i],
									// 'debit' => $debit[$i],
									'credit' => $credit2[$i],
									'entry_type' => 'J-SO',
									'created_at' => $this->data->timestamp,
									];
									
									$insertData1 = $this->security->xss_clean($insertData1);
									$this->db->insert('tbl_entry', $insertData1);
								}
								
								#second 
								
								// end here 
								
								$insert_status=true;
								
								// Entry Code Wise 
								if(!empty($credit[$i])) {
									// credit case condition
									$this->db->where('pf_number', $pfno[$i])->update('members',array('savings'=>$memberData->savings+$credit[$i]));
								}
								else
								{
									
									$this->db->where('pf_number', $pfno[$i])->update('members',array('savings'=>$memberData->savings+$memberData->pm_saving,'loan_credit'=>$memberData->loan_credit+$debit1[$i]));
								}
								
								// end if condition here 	
							}
							else
							{
								$insert_status=false;
								break;
							}
						}
						
						// this code is pnb type start here 
						// $insertData2=array();
						// if(!empty($ho_deduction))
						// {
						// $insertData2 = [
						// 'vno' => $vno,
						// 'date_time' => $date,
						// 'entrycode' => 'PCFHEA',
						// 'entrydesc' => $entrydesc,
						// 'debit' => $ho_deduction,
						// 'entry_type' => 'J-SO',
						// 'created_at' => $this->data->timestamp,
						// ];
						
						// $insertData2 = $this->security->xss_clean($insertData2);
						// $this->db->insert('tbl_entry', $insertData2);
						// }
						
						// end here pnb type code 
						
						if ($insert_status == true)
						{
							$output['res'] = 'success';
							$output['msg'] = 'Entry Added Successfully.';
							
						}
						else
						{
							$output['res'] = 'error';
							$output['msg'] = 'Something went wrong in Data Shaving.';
						}
						
						echo json_encode([$output]);
					}
					// next action here 
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				// $query = $this->db->order_by("id", "DESC")->get($this->data->table);
				$query = $this->db->order_by("id", "DESC")->get($this->data->table);
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}	
		}
		
		# HODeduction End Here 
		
		
		
		
		
		
		
		# Manage ThisMonthEntries 
		public function ThisMonthEntries()
		{
			// Current This Month Filter Here Code
			$currentMonthStart= date("Y-m-01");
			$currentMonthEnd= date("Y-m-t");
			// $query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$currentMonthStart' AND '$currentMonthEnd'");
			
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$currentMonthStart' AND '$currentMonthEnd' order by vno ASC");
			$data['list'] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		# All members 
		public function AllEntries()
		{
			$this->data->table = 'tbl_entry';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Entry';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditEntry";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									
									// start 
									$pf_no = $this->input->post('pf_no');
									$vno = $this->input->post('vno');
									$entry_type = $this->input->post('entry_type');
									$entrycode = $this->input->post('entrycode');
									$entrydesc = $this->input->post('entrydesc');
									$debit = $this->input->post('debit');
									$credit = $this->input->post('credit');
									
									// end 
									
									$updateData = [
                                    'vno' => $vno,
                                    'pf_no' => $pf_no,
                                    'entry_type' => $entry_type,
                                    'entrycode' => $entrycode,
                                    'entrydesc' => $entrydesc,
                                    'debit' => $debit,
                                    'credit' => $credit
									];
									// var_dump($updateData);die();
									
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									if ($result)
									{
										
										$memberData = $this->db->get('members',array('pf_number'=>$pf_no))->row();
										if($entrycode=="SAVACC")
										{
											$this->db->where('id', $data['list'][0]->id)->update('members',array('savings'=>$memberData->savings+$credit));
										}
										
										
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{	
				// start Date Filter Here
				if(empty($this->input->post())){ 
					$fin_years=$this->getFinancialYear();
					$start=$fin_years[0];
					$todate=$fin_years[1];
					$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$start' AND '$todate' order by cast(`vno` as UNSIGNED) asc");
					// $query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$start' AND '$todate'");
					// $query = $this->db->query("SELECT * FROM `tbl_entry`");
				}
				else
				{
					$start=date("Y-m-d",strtotime($this->input->post('fromdate')));
					$todate=date("Y-m-d",strtotime($this->input->post('todate')));
					
					// selected date 
					$fromdatenew=date("Y-m-d",strtotime($this->input->post('fromdate')));
					$enddatenew=date("Y-m-d",strtotime($this->input->post('todate')));
					
					$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$start' AND '$todate' order by cast(`vno` as UNSIGNED) asc");
					$data["fromdatenew"] = $fromdatenew;
					$data["enddatenew"] = $enddatenew;
				}
				
				$data["list"] = $query->result();
				
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		
		
		
		# Start LoanAccount Function Here 
		public function LoanAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='LONACC' order by `date_time` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
						}else{
						if($fixed_date->entry_type!='C-SO' AND $fixed_date->entry_type!='J-SO' AND $fixed_date->entry_type!='12B'){
							$debit_amount += (float)$fixed_date->debit;
							$credit_amount += (float)$fixed_date->credit;
						}
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# Start LoanAccountnew Function Here 
		public function LoanAccountnew()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='LONACC' AND(entry_type!='C-SO' AND entry_type!='J-SO' AND entry_type!='12B') order by `pf_no` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
					}else
					{
						if(($fixed_date->entry_type!='C-SO') || ($fixed_date->entry_type!='J-SO') || ($fixed_date->entry_type!='12B')){
							$debit_amount += (float)$fixed_date->debit;
							$credit_amount += (float)$fixed_date->credit;
						}
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		# Loan Account 2023-2024 Testing Here 
		public function LoanAccountSub()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2023-04-01' AND '2024-03-31' AND entrycode='LONACC' AND(entry_type!='C-SO' AND entry_type!='J-SO' AND entry_type!='12B') order by `pf_no` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2023"){
					if($fixed_date == null){
						continue;
					}else
					{
						if(($fixed_date->entry_type!='C-SO') || ($fixed_date->entry_type!='J-SO') || ($fixed_date->entry_type!='12B')){
							$debit_amount += (float)$fixed_date->debit;
							$credit_amount += (float)$fixed_date->credit;
						}
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		
		
		
		
		# Start SavingAccountnew Function Here 
		public function SavingAccountnew()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='SAVACC' AND(entry_type!='C-SO' AND entry_type!='J-SO' AND entry_type!='12B') order by `pf_no` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
					}
					else
					{
						if(($fixed_date->entry_type!='C-SO') || ($fixed_date->entry_type!='J-SO') || ($fixed_date->entry_type!='12B')){
							$debit_amount += (float)$fixed_date->debit;
							$credit_amount += (float)$fixed_date->credit;
						}
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		# Subsidiary Ledger Start Here 
		public function Subsidiaryledgersaving()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='SAVACC' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		
		
		
		
		
		
		
		
		# Start ShareAccountnew Function Here 
		public function ShareAccountnew()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='SHAACC' AND(entry_type!='C-SO' AND entry_type!='J-SO' AND entry_type!='12B') order by `pf_no` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
					}else
					{
						if(($fixed_date->entry_type!='C-SO') || ($fixed_date->entry_type!='J-SO') || ($fixed_date->entry_type!='12B')){
							$debit_amount += (float)$fixed_date->debit;
							$credit_amount += (float)$fixed_date->credit;
						}
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		# Start PnbcAccount Function Here 
		public function PnbcAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='PNBC/A' order by `date_time` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
						}else{
						$debit_amount += (float)$fixed_date->debit;
						$credit_amount += (float)$fixed_date->credit;
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		
		# Start SavingAccount Function Here 
		public function SavingAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='SAVACC' order by `date_time` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
						}else{
						$debit_amount += (float)$fixed_date->debit;
						$credit_amount += (float)$fixed_date->credit;
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		# AdvanceDeducted Start Here 
		public function AdvanceDeducted()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='ADVTAX' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# BadDebtsReserve Start Here 
		public function BadDebtsReserve()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='BADRES' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# CashInHand Start Here 
		public function CashInHand()
		{
			// $query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND (entrycode='PNBC/A' AND entrydesc LIKE '%WIT%') OR entrycode='CONCHA' OR entrycode='ENTEXP' OR  entrycode='PRISTA' OR (entrycode='DIVOUT' AND entrydesc LIKE '%CASH%') order by `date_time` ASC");
			
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND (entrycode='PNBC/A' AND entrydesc LIKE '%WIT%') OR entrycode='CONCHA' OR entrycode='BALSOC' OR entrycode='ENTEXP' OR  entrycode='PRISTA' OR (entrycode='DIVOUT' AND entrydesc LIKE '%CASH%') order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		// public function CashInHand()
		// {
		// $query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='BALSOC' order by `date_time` ASC");
		
		// $data["list"] = $query->result();
		// $this->load->view($this->data->controller . '/' . $this->data->method, $data);
		// }
		
		# BankChargeAccount Start Here 
		public function BankChargeAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='BANKCH' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# BuildingFundAccount Start Here 
		public function BuildingFundAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='BUIFUN' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		# ConveyanceCharge Start Here 
		public function ConveyanceCharge()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='CONCHA' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# MISCELLANEOUS Start Here 
		public function Miscellaneous()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='MISCEL' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# CreditorsExpenses Start Here 
		public function CreditorsExpenses()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='CREEXP' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		# DeadStockAccount Start Here 
		public function DeadStockAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='DEASTO' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# DepriciationCharges Start Here 
		public function DepriciationCharges()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='DEPCHA' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		# DevelopmentFund Start Here 
		public function DevelopmentFund()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='DEVFUN' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# SundryDebtors Start Here 
		public function SundryDebtors()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='DIVACC' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# LoanLedger Start Here
		public function LoanLedger()
		{
			$query = $this->db->query("SELECT * FROM `members` where loan_interest>0 order by pf_number asc");
			$data["list"] = $query->result();
			$this->load->view($this->data->controller.'/'.$this->data->method,$data);
		}
		
		
		# DividentOutstanding Start Here 
		public function DividentOutstanding()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='DIVOUT' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# EmployeeSecurity Start Here 
		public function EmployeeSecurity()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='EMPSEC' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# InvestInFdr Start Here 
		public function InvestInFdr()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='INVFOR' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		# InvestInShares Start Here 
		public function InvestInShares()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='INVSHA' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		# OtherReserveFund Start Here 
		public function OtherReserveFund()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='OTHRES' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		# PrintingStationary Start Here 
		public function PrintingStationary()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='PRISTA' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		# ProfitLossApropriation Start Here 
		public function ProfitLossApropriation()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='PROLOS' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		# ReserveFund Start Here 
		public function ReserveFund()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='RESFUN' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		# StateBankPatiala Start Here 
		public function StateBankPatiala()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='SBOPCA' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		# SecurityFund Start Here 
		public function SecurityFund()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='SECFUN' order by `date_time` ASC");
			
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		
		
		
		# Start ShareAccount Function Here 
		public function ShareAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='SHAACC' order by `date_time` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
						}else{
						$debit_amount += (float)$fixed_date->debit;
						$credit_amount += (float)$fixed_date->credit;
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		
		# Start HeadOfficeAccount Function Here 
		public function HeadOfficeAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='PCFHEA' order by `date_time` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
						}else{
						$debit_amount += (float)$fixed_date->debit;
						$credit_amount += (float)$fixed_date->credit;
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# Start SalaryAccount Function Here 
		public function SalaryAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='SALACC' order by `date_time` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
						}else{
						$debit_amount += (float)$fixed_date->debit;
						$credit_amount += (float)$fixed_date->credit;
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		# Start ExpensesAccount Function Here 
		public function EntertainmentExpenses()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='ENTEXP' order by `date_time` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
						}else{
						$debit_amount += (float)$fixed_date->debit;
						$credit_amount += (float)$fixed_date->credit;
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		# Start LegalExpensesAccount Function Here 
		public function LegalExpensesAccount()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='LEGEXP' order by `date_time` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
						}else{
						$debit_amount += (float)$fixed_date->debit;
						$credit_amount += (float)$fixed_date->credit;
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		# Start MemberRegistraton Function Here 
		public function MemberRegistraton()
		{
			$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE date_time BETWEEN '2022-04-01' AND '2023-03-31' AND entrycode='MEMFEE' order by `date_time` ASC");
			$debit_amount = 0;
			$credit_amount = 0;
			foreach($query->result() as $fixed_date){
				
				if(date('d-m-Y',strtotime($fixed_date->date_time)) == "01-04-2022"){
					if($fixed_date == null){
						continue;
						}else{
						$debit_amount += (float)$fixed_date->debit;
						$credit_amount += (float)$fixed_date->credit;
					}
				}
				else{
					continue;
				}
			}
			
			$data["total_debit_amount"] = $debit_amount;
			$data["total_credit_amount"] = $credit_amount;
			$data["list"] = $query->result();
			$this->load->view($this->data->controller . '/' . $this->data->method, $data);
		}
		
		
		
		
		
		
		
		# Start CashbookEntries Function Here 
		public function CashbookEntries()
		{
			$this->data->table = 'tbl_entry';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Entry';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditCashbook";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									
									// start 
									$pf_no = $this->input->post('pf_no');
									$vno = $this->input->post('vno');
									$entry_type = $this->input->post('entry_type');
									$entrycode = $this->input->post('entrycode');
									$entrydesc = $this->input->post('entrydesc');
									$debit = $this->input->post('debit');
									$credit = $this->input->post('credit');
									
									// end 
									
									$updateData = [
                                    'vno' => $vno,
                                    'pf_no' => $pf_no,
                                    'entry_type' => $entry_type,
                                    'entrycode' => $entrycode,
                                    'entrydesc' => $entrydesc,
                                    'debit' => $debit,
                                    'credit' => $credit
									];
									// var_dump($updateData);die();
									
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									if ($result)
									{
										
										$memberData = $this->db->get('members',array('pf_number'=>$pf_no))->row();
										if($entrycode=="SAVACC")
										{
											$this->db->where('id', $data['list'][0]->id)->update('members',array('savings'=>$memberData->savings+$credit));
										}
										
										
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				// start Date Filter Here
				if(empty($this->input->post())){ 
					$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '2022-04-01' AND '2023-03-31' AND entry_type='C-SO' order by cast(`vno` as UNSIGNED) asc");
					// $query = $this->db->query("SELECT * FROM `tbl_entry` WHERE  entry_type='C-SO' order by date_time asc");
				}
				else
				{
					$start=date("Y-m-d",strtotime($this->input->post('fromdate')));
					$todate=date("Y-m-d",strtotime($this->input->post('todate')));
					
					// selected date column 
					$fromdatenew=date("Y-m-d",strtotime($this->input->post('fromdate')));
					$enddatenew=date("Y-m-d",strtotime($this->input->post('todate')));
					
					$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$start' AND '$todate' AND entry_type='C-SO' order by cast(`vno` as UNSIGNED) asc");
					$data["fromdatenew"] = $fromdatenew;
					$data["enddatenew"] = $enddatenew;
				}
				
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		
		
		
		
		
		
		
		# Start 12BEntries Function Here 
		public function B12Entries()
		{
			$this->data->table = 'tbl_entry';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Entry';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "Edit12B";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									
									// start 
									$pf_no = $this->input->post('pf_no');
									$vno = $this->input->post('vno');
									$entry_type = $this->input->post('entry_type');
									$entrycode = $this->input->post('entrycode');
									$entrydesc = $this->input->post('entrydesc');
									$debit = $this->input->post('debit');
									$credit = $this->input->post('credit');
									
									// end 
									
									$updateData = [
                                    'vno' => $vno,
                                    'pf_no' => $pf_no,
                                    'entry_type' => $entry_type,
                                    'entrycode' => $entrycode,
                                    'entrydesc' => $entrydesc,
                                    'debit' => $debit,
                                    'credit' => $credit
									];
									// var_dump($updateData);die();
									
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									if ($result)
									{
										
										$memberData = $this->db->get('members',array('pf_number'=>$pf_no))->row();
										if($entrycode=="SAVACC")
										{
											$this->db->where('id', $data['list'][0]->id)->update('members',array('savings'=>$memberData->savings+$credit));
										}
										
										
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				if(empty($this->input->post())){ 
					$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '2022-04-01' AND '2023-03-31' AND entry_type='12B' order by cast(`vno` as UNSIGNED) asc");
					// $query = $this->db->query("SELECT * FROM `tbl_entry` WHERE entry_type='12B' order by date_time asc");
				}
				else
				{
					$start=date("Y-m-d",strtotime($this->input->post('fromdate')));
					$todate=date("Y-m-d",strtotime($this->input->post('todate')));
					
					// selected date column 
					$fromdatenew=date("Y-m-d",strtotime($this->input->post('fromdate')));
					$enddatenew=date("Y-m-d",strtotime($this->input->post('todate')));
					
					// $query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$start' AND '$todate' AND entry_type='12B' order by cast(`vno` as UNSIGNED) asc");
					$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$start' AND '$todate' AND entry_type='12B' order by cast(`vno` as UNSIGNED) asc");
					$data["fromdatenew"] = $fromdatenew;
					$data["enddatenew"] = $enddatenew;
				}
				
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		
		# Start TransferJournalEntries Function Here 
		public function TransferJournalEntries()
		{
			$this->data->table = 'tbl_entry';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Entry';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "Edit12B";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									
									// start 
									$pf_no = $this->input->post('pf_no');
									$vno = $this->input->post('vno');
									$entry_type = $this->input->post('entry_type');
									$entrycode = $this->input->post('entrycode');
									$entrydesc = $this->input->post('entrydesc');
									$debit = $this->input->post('debit');
									$credit = $this->input->post('credit');
									
									// end 
									
									$updateData = [
                                    'vno' => $vno,
                                    'pf_no' => $pf_no,
                                    'entry_type' => $entry_type,
                                    'entrycode' => $entrycode,
                                    'entrydesc' => $entrydesc,
                                    'debit' => $debit,
                                    'credit' => $credit
									];
									// var_dump($updateData);die();
									
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									if ($result)
									{
										
										$memberData = $this->db->get('members',array('pf_number'=>$pf_no))->row();
										if($entrycode=="SAVACC")
										{
											$this->db->where('id', $data['list'][0]->id)->update('members',array('savings'=>$memberData->savings+$credit));
										}
										
										
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
			}
			else
			{
				if(empty($this->input->post())){ 
					$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '2022-04-01' AND '2023-03-31' AND entry_type='J-SO' order by cast(`vno` as UNSIGNED) asc");
					
					// $query = $this->db->query("SELECT * FROM `tbl_entry` WHERE entry_type='J-SO' order by date_time asc");
				}
				else
				{
					$start=date("Y-m-d",strtotime($this->input->post('fromdate')));
					$todate=date("Y-m-d",strtotime($this->input->post('todate')));
					
					// selected date column 
					$fromdatenew=date("Y-m-d",strtotime($this->input->post('fromdate')));
					$enddatenew=date("Y-m-d",strtotime($this->input->post('todate')));
					
					// $query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$start' AND '$todate' AND entry_type='J-SO' order by cast(`vno` as UNSIGNED) asc");
					$query = $this->db->query("SELECT * FROM `tbl_entry` WHERE `date_time` BETWEEN '$start' AND '$todate' AND entry_type='J-SO' order by cast(`vno` as UNSIGNED) asc");
					$data["fromdatenew"] = $fromdatenew;
					$data["enddatenew"] = $enddatenew;
				}
				
				$data["list"] = $query->result();
				$this->load->view($this->data->controller . '/' . $this->data->method, $data);
			}
		}
		
		
		# Start Financial Year Function Here 
		public function getFinancialYear()
		{
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
			
			$date1= $year1."-04-01";
			$date2= $year2."-03-31";
			
			$financial_year=array($date1, $date2);
			
			return $financial_year;
		}
		# End Financial Year Function Here 
		
		
		
		#Start here Loans 
		public function Loans()
		{
			$this->data->table = 'tbl_loans';
			$this->data->folder = 'profile_pic';
			$this->data->key = 'Loans';
			$this->data->file_column = 'icon';
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($this->uri->segment(4) == TRUE)
				{
					$id = $this->uri->segment(4);
					$query = $this->db->where('id', $id)->get($this->data->table);
					if ($query->num_rows())
					{
						$data["list"] = $query->result();
						if ($action == 'Edit')
						{
							$data["action"] = "EditLoan";
							$this->load->view($this->data->controller . '/UpdateData', $data);
						}
						else
						{
							redirect(base_url($this->data->controller . '/' . $this->data->method));
						}
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method));
					}
				}
				else
				{
					if ($action == 'Add')
					{
						if (!empty($this->input->post()))
						{
							$id = (int)$this->input->post('id');
							$pfno = $this->input->post('pf_number');
							$loan = $this->input->post('loan');
							$loan_amount = $this->input->post('loan_amount');
							
							$insertData = [
							'pf_number' => $pfno,
							'loan_amount' => $loan_amount,
							'no_of_months' => $this->input->post('no_of_months'),
							'interest' => $this->input->post('interest'),
							'emi_amount' => $this->input->post('emi_amount'),
							'remark' => $this->input->post('remark'),
							'created_at' => $this->data->timestamp
							];
							
							
							// tbl_entry table insert start when loan sanctioned credit here  
							$entryData = [
							'pf_no' => $pfno,
							'entrycode' => 'LONACC',
							'entrydesc' => 'LOAN ACCOUNT',
							// 'debit' => $loan_amount,
							'credit' => ($loan_amount)*10/100,
							'date_time' => date('d/m/Y'),
							'created_at' => $this->data->timestamp
							];
							
							$EntryInsertData = $this->security->xss_clean($entryData);
							if ($this->db->insert('tbl_entry', $EntryInsertData))
							{
								// tbl_entry table insert start when loan for debit 
								$entryData1 = [
								'pf_no' => $pfno,
								'entrycode' => 'LONACC',
								'entrydesc' => 'LOAN ACCOUNT',
								'debit' => $loan_amount,
								'date_time' => date('d/m/Y'),
								'created_at' => $this->data->timestamp
								];
								$InsertData1 = $this->security->xss_clean($entryData1);
								if ($this->db->insert('tbl_entry', $InsertData1))
								{
									$output['res'] = 'success';
									$output['msg'] = 'Data debit Added Successfully.';
								}
								else 
								{
									$output['res'] = 'error';
									$output['msg'] = 'Something went wrong debit.';
								}
							}
							else
							{
								$output['res'] = 'error';
								$output['msg'] = 'Something went wrong in Data Loans.';
							}
							// tbl_entry table insert end when loan sanctioned here
							
							
							// get data from members table 
							$update_pf = $this->db->get_where('members',array('pf_number'=>$pfno))->row();
							
							// 10% for members shares
							$shares = $update_pf->shares+($loan_amount)*10/100;
							
							$this->db->where('pf_number', $pfno)->update('members',array('loan'=>$loan,'shares'=>$shares));
							
							// end update code here
							
							$insertData = $this->security->xss_clean($insertData);
							if ($this->db->insert($this->data->table, $insertData))
							{
								$output['res'] = 'success';
								$output['msg'] = 'Data Added Successfully.';
							}
							else
							{
								$output['res'] = 'error';
								$output['msg'] = 'Something went wrong in Data Shaving.';
							}
						}
						echo json_encode([$output]);
					}
					else if ($action == 'Update')
					{
						if (!empty($this->input->post()))
						{
							if (empty($this->input->post("id")))
							{
								$output['msg'] = 'ID is required.';
							}
							else
							{
								$query = $this->db->where('id', $this->input->post("id"))->get($this->data->table);
								if ($query->num_rows())
								{
									$data['list'] = $query->result();
									// if ($this->form_validation->run($this->data->key) == FALSE)
									// {
									//     $msg = explode('</p>', validation_errors());
									//     $output['msg'] = str_ireplace('<p>', '', $msg[0]);
									// }
									// else
									// {
									$updateData = [
                                    // 'pf_number' => $this->input->post('pf_number'),
									'loan_amount' => $this->input->post('loan_amount'),
									'no_of_months' => $this->input->post('no_of_months'),
									'interest' => $this->input->post('interest'),
									'emi_amount' => $this->input->post('emi_amount'),
									'urgestment' => $this->input->post('urgestment'),
									'due' => $this->input->post('due'),
									'remark' => $this->input->post('remark'),
									'created_at' => $this->data->timestamp
									];
									$updateData = $this->security->xss_clean($updateData);
									$result = $this->db->where('id', $data['list'][0]->id)->update($this->data->table, $updateData);
									if ($result)
									{
										$output['res'] = 'success';
										$output['msg'] = 'Data Updated Successfully.';
									}
									else
									{
										$output['res'] = 'error';
										$output['msg'] = 'Something went wrong in Data Shaving.';
									}
									// }
								}
							}
						}
						echo json_encode([$output]);
					}
					else
					{
						redirect(base_url($this->data->controller . '/' . $this->data->method.'/'.$id));
					}
				}
			}
			else
			{
				$uid = $this->uri->segment(3);
				$userid = $this->db->get_where('members',array('id'=>$uid))->row();
				$pfno= $userid->pf_number;
				$data["loan"] = $this->db->order_by("id", "DESC")->get_where('tbl_loans',array('pf_number'=>$pfno))->result();
				
				$this->load->view('Admin/UserFullDeatils/'.$uid, $data);
			}
		}
		
		
		// end here
		
	}
