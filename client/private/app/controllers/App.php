<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct()
	{
	  parent::__construct();
	  $this->load->model('app_model');
		$this->load->library('session');
		$this->load->helper(array('url','support_helper'));
		$this->data['version_assets'] = rand(1, 30000);/*HELP TO DEBUG LOCALLY*/
		$this->data['user'] = $this->app_model->user_data;
	}

	public function index()
	{
		if(isset($this->data['user']) && !empty($this->data['user']) && isset($this->data['user']['unique_token']) && !empty($this->data['user']['unique_token'])){
			redirect(base_url('sign_out/'));
		}
		$this->data['slug'] = 'sign_in';
		$this->data['title'] = 'Sign In';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('token', 'Sign in Token', 'required');
		if($this->form_validation->run() === TRUE)
		{
			$this->data['input'] = $this->input->post();
			$_result = $this->app_model->sign_in($this->data['input']);
			if($_result['success']){
				$this->session->set_flashdata('success', $_result['msg']);
				$this->form_validation->reset_validation();
				redirect(base_url('sign_out/'));
			}else{
				$this->session->set_flashdata('error', $_result['msg']);
				redirect(base_url());
			}
		}
		$this->load->view('home', $this->data);
	}

	public function sign_out($_logout = FALSE)
	{
		if(isset($this->data['user']) && !empty($this->data['user']) && !isset($this->data['user']['unique_token']) && empty($this->data['user']['unique_token'])){
			redirect(base_url());
		}
		//debug($this->data['user']);
		$this->data['slug'] = 'sign_out';
		$this->data['title'] = 'Sign Out';
		$this->load->helper('form');
		if($_logout){
			$_current_row = $this->app_model->get_table_row('attendence',FALSE,FALSE,array('emp_id'=>$this->data['user']['id'],'DATE(sign_in)' => date('Y-m-d'),'status' => 'open'));
      if(isset($_current_row) && !empty($_current_row)){
        $this->app_model->update_table_row('attendence',array('id'=>$_current_row['id']),array('sign_out'=>date('Y-m-d H:i:s'),'status'=>'closed'));
			}
			$this->session->unset_userdata(array(
				'id','unique_token','logged_in',
			));
			redirect(base_url());
		}
		$this->load->view('sign_out', $this->data);

	}

}
