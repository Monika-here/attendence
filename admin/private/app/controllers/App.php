<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct()
	{
	  parent::__construct();
	  $this->load->model('app_model');
		$this->load->library('session');
		$this->load->helper(array('url_helper','support_helper'));
		$this->data['title'] = 'Admin Dashboard';
		$this->data['version_assets'] = rand(1, 30000);/*HELP TO DEBUG LOCALLY*/
	}

	public function add_employee()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Employee Name', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if($this->form_validation->run() === TRUE)
		{
			$this->data['input'] = $this->input->post();
			if($this->app_model->add_employee($this->data['input'])){
				$this->session->set_flashdata('success', 'New Employee Added!');
				$this->form_validation->reset_validation();
				redirect(base_url('list_employees/'));
			}else{
				$this->session->set_flashdata('error', 'Error adding employee! Try again!');
				redirect(base_url('add_employee/'));
			}
		}
		$this->data['slug'] = 'add_employee';
		$this->data['page_title'] = 'Add Employee';

		$this->load->view('employee/add', $this->data);
	}

	public function list_employees($page_no = 1)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		if(intval($page_no) < 1)$page_no = 1;
		$this->data['slug'] = 'list_employees';
		$this->data['page_title'] = 'All Employees';
		$search = ($this->input->get('search') && !empty($this->input->get('search'))) ? $this->input->get('search') : FALSE;
		$this->data['search'] = $search;
		$this->data['employees'] = $this->app_model->list_employees($page_no, $search);
		$this->load->view('employee/list', $this->data);
	}

	public function edit_employee($id = FALSE)
	{
		if($id === FALSE)redirect(base_url('list_employees/'));
		$this->data['input']['id'] = $id;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Employee Name', 'required');
		$this->form_validation->set_rules('status', 'Employee Status', 'required');

		$this->data['employee'] = $this->app_model->get_table_row('employees', 'id', id_encrypt_decrypt($this->data['input']['id'],'decrypt'));
		if(!$this->data['employee'])redirect(base_url('list_employees/'));

		if ($this->form_validation->run() === TRUE)
		{
			$edit_input = $this->input->post();
			$edit_input['id'] = $this->data['employee']['id'];

			if($this->app_model->edit_employee($edit_input)){
				$this->session->set_flashdata('success', 'Employee Details Updated!');
				$this->form_validation->reset_validation();
				redirect(base_url('list_employees/'));
			}else{
				$this->session->set_flashdata('error', 'Error updating employee details! Try again!');
				redirect(base_url('edit_employee/'.$id.'/'));
			}
		}
		$this->data['slug'] = 'edit_employee';
		$this->data['page_title'] = 'Edit Employee';

		$this->load->view('employee/edit', $this->data);
	}

	public function delete_employee($id = FALSE)
	{
		if($id === FALSE)redirect(base_url('list_employees/'));

		$this->data['employee'] = $this->app_model->get_table_row('employees', 'id', id_encrypt_decrypt($id,'decrypt'));

		if($this->data['employee']){
			if($this->app_model->delete_table_row('employees', 'id', $this->data['employee']['id'])){
				$this->session->set_flashdata('success', 'Employee "'.$this->data['employee']['name'].'" Deleted!');
				redirect(base_url('list_employees/'));
			}
		}
		$this->session->set_flashdata('error', 'Error deleting employee! Try again!');
		redirect(base_url('list_employees/'));
	}


}
