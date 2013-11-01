<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Welcome extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->checkTableIdentity();
		
		$this->data['callwaiter'] = $this->load->view('customer/callwaiter', '', TRUE);

		$this->load->model('table_model', 'tables');
	}

	public function index()
	{
		$this->load->view('customer/welcome', $this->data);
	}

	/**
	* Sets the name of the customer in a session variable and sets the status of the table to in use
	*/
	public function setname()
	{
		//set the user's name in the session
		$customername = $this->input->post('customername');
		$this->session->set_userdata(array('customername'=>$customername));
		$this->tables->table_status_update(1);

		redirect('customer/menu', 'refresh');
	}
}