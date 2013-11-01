<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class TableSetup extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('table_model', 'tables');
		$this->load->model('abstract_userlogin_model', 'users');
	}

	public function index()
	{
		$this->load->view('tablesetup.php');
	}

	public function setidentity()
	{
		if ($this->tables->set_identity()){
			redirect('customer', 'refresh');
		} else {
			$this->session->set_flashdata('errormsg', "Invalid employee code.");
			redirect('tablesetup', 'refresh');
		}

	}
}