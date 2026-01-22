<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	class Auth extends Auth_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Auth_model');
			// $this->load->library('App');
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
		
		public function index()
		{
			redirect(base_url('Auth/AdminLogin'));
		}
		public function Test()
		{
			// $res = $this->db->get('admin')->result();
			// $res = $this->db->order_by('id','desc')->get('tbl_saving_bal')->result();
			// $res = $this->db->order_by('id','desc')->get('entriesmaster')->result();
			$res = $this->db->order_by('id','asc')->get('admin')->result();
			// $res = $this->db->query("update tbl_entry set credit='17000' where id='1424'");
			// $res = $this->db->order_by('id','asc')->get('members')->result();
			
			// $res = $this->db->query("UPDATE members SET saving_interest = -saving_interest WHERE saving_interest < 0");
			echo "<pre>";
			var_dump($res);
			die();
		}
		public function AdminLogin()
		{
			$this->data->role_id = '1';
			$this->load->view($this->data->controller . '/' . $this->data->method);
		}
		public function Authentication()
		{
			$output['res'] = 'error';
			if ($this->uri->segment(3) == TRUE)
			{
				$action = $this->uri->segment(3);
				if ($action == 'Login')
				{
					if (empty($this->input->post()) or $this->form_validation->run('Login') == FALSE)
					{
						$msg = explode('</p>', validation_errors());
						$output['msg'] = str_ireplace('<p>', '', $msg[0]);
					}
					else
					{
						$postData = $this->input->post();
						$postData = $this->security->xss_clean($postData);
						$roleData = $this->Auth_model->getRole($postData['role_id']);
						if ($roleData)
						{
							$query = $this->db->where('username', $postData['username'])->or_where('email', $postData['username'])->or_where('mobile', $postData['username'])->get($roleData->table_name);
							if ($query->num_rows())
							{
								$result = $query->row();
								if ($result->password == $postData['password'])
								{
									
									if ($result->is_status == 'true')
									{
										if ($result->is_verified == 'true')
										{
											$this->load->library('Activities');
											$activitiesData = [
                                            'role_id' => $postData['role_id'],
                                            'user_id' => $result->id,
                                            'role_role_id' => $roleData->id,
                                            'user_user_id' => $result->id,
                                            'ip' => $this->activities->get_ip(),
                                            'device' => $this->activities->get_useragent(),
                                            'os' => $this->activities->get_os(),
                                            'browser' => $this->activities->get_useragent(),
                                            'computer_name' => $this->activities->get_username(),
                                            'mac' => $this->activities->get_mac(),
                                            'created_at' => $this->data->timestamp,
                                            'modified_at' => $this->data->timestamp
											];
											
											$this->db->insert('activities', $activitiesData);
											$updateData = [
                                            'is_login' => 'true',
                                            'visit_count' => ($result->visit_count) + 1,
                                            'login_at' => $this->data->timestamp
											];
											$query = $this->db->where(['id', $result->id])->update($roleData->table_name, $updateData);
											
											if ($query)
											{
												$this->session->set_userdata($roleData->session, $result);
												$output['res'] = 'success';
												$output['msg'] = 'Welcome you are logged in.';
												if (empty($_POST['url']))
												{
													$redirect = base_url($roleData->redirect);
												}
												else
												{
													$redirect = $_POST['url'];
												}
												$output['redirect'] = $redirect;
											}
											else
											{
												$output['msg'] = 'Login failed.';
											}
										}
										else
										{
											$sessionData = (object) ['role_id' => $roleData->id, 'user_id' => $result->id, 'type' => 'Verification'];
											$this->session->set_userdata('OTPVerification', $sessionData);
											$output['res'] = 'success';
											$output['msg'] = 'OTP sent on your mobile no.';
											$output['redirect'] = base_url('Home/OTP');
										}
									}
									else
									{
										$output['msg'] = 'This account is currently inactive.';
									}
								}
								else
								{
									$output['msg'] = 'Password is invalid.';
								}
							}
							else
							{
								$output['msg'] = 'Username is invalid.';
							}
						}
						else
						{
							$output['msg'] = 'Role ID is invalid.';
						}
					}
				}
				else
				{
					$output['msg'] = 'Action is invalid.';
				}
			}
			else
			{
				$output['msg'] = 'Action is required.';
			}
			echo json_encode([$output]);
		}
		
		# Update Status
		public function UpdateStatus()
		{
			if ($this->input->post())
			{
				$data = $this->input->post();
				$result = $this->db->where($data['where_column'], $data['where_value'])->update($data['table'], [$data['column'] => $data['value']]);
				if ($result)
				{
					echo true;
				}
				else
				{
					echo false;
				}
			}
			else
			{
				echo false;
			}
		}
		
		
		
		
		
		# Update HOStatus
		public function HOStatus()
		{
			if ($this->input->post())
			{
				$data = $this->input->post();
				$result = $this->db->where($data['where_column'], $data['where_value'])->update($data['table'], [$data['column'] => $data['value']]);
				if ($result)
				{
					echo true;
				}
				else
				{
					echo false;
				}
			}
			else
			{
				echo false;
			}
		}
		
		
		
		
		# Delete   
		public function Delete()
		{
			if ($this->input->post())
			{
				$data = $this->input->post();
				$unlink_folder = $data['unlink_folder'];
				$unlink_column = $data['unlink_column'];
				$result = $this->db->where($data['where_column'], $data['where_value'])->get($data['table']);
				$resdata = $result->result_array();
				$result = $this->db->where($data['where_column'], $data['where_value'])->delete($data['table']);
				if ($result)
				{
					if (!empty($unlink_column))
					{
						$unlink_column_array = explode(',', $unlink_column);
						for ($i = 0; $i < count($unlink_column_array); $i++)
						{
							$unlink_column_name = $unlink_column_array[$i];
							if (($resdata[0][$unlink_column_name]) != 'logo.png')
							{
								unlink('./uploads/' . $unlink_folder . '/' . $resdata[0][$unlink_column_name]);
							}
						}
					}
					echo true;
				}
				else
				{
					echo false;
				}
			}
			else
			{
				echo false;
			}
		}
		
		
		public function databaseexport()
		{
			// Load the DB utility class
			$this->load->dbutil();
			
			// Backup your entire database and assign it to a variable
			$backup = $this->dbutil->backup();
			
			// Load the file helper and write the file to your server
			$this->load->helper('file');
			write_file('./uploads/mybackup.gz', $backup);
			
			// Load the download helper and send the file to your desktop
			$this->load->helper('download');
			force_download('mybackup.gz', $backup);
		}
		
		
		
		# CronJob Funtion Start Here
		# http://pcf.himanshukashyap.com/Auth/LonCronJob
		
		public function LonCronJob()
		{
			
			$item = $this->db->get_where('members',array('is_status'=>'true'))->result();
			foreach($item as $memberData)
			{
				$pf_number = $memberData->pf_number;
				if(!empty($pf_number))
				{
					$per = ($memberData->loan)*9/100;
					$loan = $per/12;
					
					$this->db->where('pf_number', $pf_number)->update('members',array('loan_interest'=>$memberData->loan_interest+$loan));
					// end 
				}
			}
			
		}
		
		# CronJob Funtion End Here
		
		# SavingCronJob Start Here
		# http://pcf.himanshukashyap.com/Auth/SavingCronJob
		public function SavingCronJob()
		{
			
			$item = $this->db->get_where('members',array('is_status'=>'true'))->result();
			foreach($item as $memberData)
			{
				$pf_number = $memberData->pf_number;
				if(!empty($pf_number))
				{
					
					$per1 = ($memberData->savings)*7/100;
					$per_savings = $per1/12;
					
					$this->db->where('pf_number', $pf_number)->update('members',array('saving_interest'=>$memberData->saving_interest+$per_savings));
					// hi end 
				}
			}
			
		}
		
		# SavingCronJob End Here
		
		
		
		
		
		# DayWiseLoanCronJob Funtion Start Here
		# http://pcf.himanshukashyap.com/Auth/DayWiseLoanCronJob
		
		public function DayWiseLoanCronJob()
		{
			
			$list1 = $this->db->get_where('members',array('is_status'=>'true'))->result();
			foreach($list1 as $item1)
			{
				$pf_no = $item1->pf_number;
				
				$list = $this->db->get_where('tbl_entry',array('pf_no'=>$pf_no))->result();
				
				$totalinterest =0;
				$totaldebit =0;
				$totalcredit =0;
				foreach ($list as $item)
				{
					$memberdata = $this->db->get_where('members',['pf_number'=>$item->pf_no])->row();
					
					$totalinterest =$memberdata->loan_interest;			
					$totaldebit+=(int)$item->debit;
					$totalcredit+=(int)$item->credit;
					
					$total = $totaldebit-$totalcredit;
					
					
					$date_time =$item->date_time;
					$date = date("d/m/Y",strtotime($date_time));
					
					
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
					
					
					if(!empty($item->debit))
					{
						echo number_format($item->debit, 2, '.', '');
					}
					else 
					{
						echo "0.00";
					}
					
					
					if(!empty($item->credit))
					{
						echo number_format($item->credit, 2, '.', '');
					}
					else 
					{
						echo "0.00";
					}
					
					if($totaldebit>$totalcredit)
					{
						echo number_format($totaldebit-$totalcredit, 2, '.', '')." Dr."; 
					}
					else
					{
						echo number_format($totaldebit-$totalcredit, 2, '.', '')." Cr."; 
					}
					
					
				}
				
				if($totalinterest)
				{
					echo number_format($totalinterest, 2, '.', '');
				}
				else 
				{
					echo "0.00";
				}
				
				if($totaldebit>$totalcredit)
				{
					echo number_format(($totaldebit-$totalcredit)+$totalinterest, 2, '.', '')." Dr."; 
				}
				else
				{
					echo number_format(($totaldebit-$totalcredit)+$totalinterest, 2, '.', '')." Cr."; 
				}
				
				// end 
			}
			
		}
		
		# CronJob Funtion End Here
		
		
		
		
		
		public function db_backup()
		{
			$this->load->helper('url');
			$this->load->helper('file');
			$this->load->helper('download');
			$this->load->library('zip');
			$this->load->dbutil();
			
			$db_format = array('format' => 'zip', 'filename' => 'my_db_backup.sql');
			$backup = $this->dbutil->backup($db_format); // Remove reference assignment
			$dbname = 'backup-on-' . date('Y-m-d') . '.zip';
			$save = 'assets/db_backup/' . $dbname;
			
			// Ensure the directory exists, if not create it
			if (!is_dir('assets/db_backup/')) {
				mkdir('assets/db_backup/', 0777, true);
			}
			
			// Ensure the directory is writable
			if (is_writable('assets/db_backup/')) {
				if (write_file($save, $backup)) {
					// Clear any previous output to avoid conflict with download headers
					if (ob_get_level() > 0) {
						ob_end_clean();
					}
					
					// Force download
					force_download($dbname, $backup);
					} else {
					echo 'Unable to write the file.';
				}
				} else {
				echo 'Directory is not writable.';
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		// end here 
	}
