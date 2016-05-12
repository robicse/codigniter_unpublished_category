<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Administrator extends CI_Controller {

		public function __construct()
		{
			parent:: __construct();
			$admin_id=$this->session->userdata('id');
			
			if($admin_id == NULL)
			{
				redirect('admin','refresh');
			}
		}
		
		public function index()
		{
			$data=array();
			$data['admin_main_content']=$this->load->view('admin/dashbord','',true);
			$this->load->view('admin/admin_master',$data);
		}
		
		public function add_category()
		{
			$data=array();
			$data['admin_main_content']=$this->load->view('admin/add_category','',true);
			$this->load->view('admin/admin_master',$data);
		}
		
		public function save_category()
		{
			$data=array();
			$data['category_name']=$this->input->post('category_name',true);
			$data['category_description']=$this->input->post('category_description',true);
			$data['publication_status']=$this->input->post('publication_status',true);
			$this->administrator_model->save_category_info($data);
			$sdata=array();
			$sdata['message']='Save Category Information Successfully !';
			$this->session->set_userdata($sdata);
			redirect('administrator/add_category');
		}
		
		public function manage_category()
		{
			$data=array();
			$data['all_category']=$this->administrator_model->select_all_category();
			$data['admin_main_content']=$this->load->view('admin/category_grid',$data,true);
			$this->load->view('admin/admin_master',$data);
		}
		
		public function logout()
		{
			$this->session->unset_userdata('admin_name');
			$this->session->unset_userdata('id');
			$sdata=array();
			$sdata['message']='You are successfully logout!';
			$this->session->set_userdata($sdata);
			redirect('admin','refresh');
		}
	}
?>