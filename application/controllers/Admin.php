<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends CI_Controller {

		public function __construct()
		{
			parent:: __construct();
			$admin_id=$this->session->set_userdata('id');
			if($admin_id != NULL)
			{
				redirect('administrator','refresh');
			}
		}
		
		public function index()
		{
			$data=array();
			$data['title']='Login';
			$this->load->view('admin/admin_login');
		}
		
		public function admin_login_check()
		{
			$admin_email_address=$this->input->post('admin_email_address');
			$admin_password=$this->input->post('admin_password');
			$result=$this->admin_model->check_admin_login_info($admin_email_address,$admin_password);
			
			$sdata=array();
			if($result){
				$sdata['admin_name']=$result->admin_name;
				$sdata['id']=$result->id;
				$this->session->set_userdata($sdata);
				redirect('administrator','refresh');
			}else{
				$sdata['exception']='Admin Email / Password Invalid!';
				$this->session->set_userdata($sdata);
				redirect('admin','refresh');
			}
		}
	}
	
	
?>