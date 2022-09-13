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

}
