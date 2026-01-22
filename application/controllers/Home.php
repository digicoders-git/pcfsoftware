<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Home extends CI_Controller
	{
		public function index()
		{
			$this->load->view('home');
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
		
		
	}
