<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct()
	{
	  parent::__construct();
		$this->load->library('session');
	  $this->load->model('app_model');
		$this->load->library('form_validation');
		$this->load->helper(array('url_helper','support_helper','form'));
		$this->data['title'] = 'Admin Dashboard';
		$this->data['version_assets'] = rand(1, 30000);/*HELP TO DEBUG LOCALLY*/
	}
	public function index()
	{

		$this->data['slug'] = 'dashboard';
		$this->data['page_title'] = 'Dashboard';
		$this->data['employees_count'] = $this->app_model->table_count_by_query('select count(*) as count from employees where deleted=0');
		$this->data['todays_attendence_count'] = $this->app_model->table_count_by_query('select count(*) as count from attendence where Date(sign_in)=CURDATE()');
		$this->load->view('pages/dashboard', $this->data);
	}

	public function add_employee()
	{
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

	public function list_attendence($page_no = 1)
	{
		if(intval($page_no) < 1)$page_no = 1;
		$this->data['slug'] = 'list_attendence';
		$this->data['page_title'] = 'Today\'s Attendence';
		$this->data['employees'] = $this->app_model->todays_attendence($page_no);
		$this->load->view('pages/attendence', $this->data);
	}

	public function employee_attendence($id = FALSE)
	{
		if($id === FALSE)redirect(base_url('list_employees/'));
		$this->data['slug'] = 'employee_attendence';
		$this->data['page_title'] = 'Current Month Attendence';
		$this->data['input']['id'] = $id;
		$this->data['employee_details'] = $this->app_model->get_table_row('employees', 'id', id_encrypt_decrypt($this->data['input']['id'],'decrypt'));
		if(!$this->data['employee_details'])redirect(base_url('list_employees/'));
		$this->data['employee'] = $this->app_model->get_query_result("select a.id,a.name,a.mobile,a.email,b.status,b.sign_in from employees as a left join attendence as b on a.id=b.emp_id where a.id=".$this->data['employee_details']['id']." and a.deleted=0 and month(sign_in) =".date("m").' and YEAR(sign_in) = '.date("Y"));
		$this->load->view('employee/attendence', $this->data);
	}
}
