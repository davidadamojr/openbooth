<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class UserAccounts extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['header'] = $this->load->view('manager/header', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);

		$this->load->model('staff_model', 'users');
	}

	public function index()
	{
		$this->data['useraccounts'] = $this->users->get_staff_members();
		$this->load->view('manager/useraccounts', $this->data);
	}
	
	public function create()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('fname', 'first name', 'required');
		$this->form_validation->set_rules('lname', 'last name', 'required');
		$this->form_validation->set_rules('role', 'account type', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('manager/createaccount', $this->data);
		} else {
			//add the account to the database
			$this->users->insert_new_staff_member();

			$this->session->set_flashdata('successmsg', "New user account successfully created.");
			redirect('manager/useraccounts');
		}
	}

	public function edit($userid)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('fname', 'first name', 'required');
		$this->form_validation->set_rules('lname', 'last name', 'required');
		$this->form_validation->set_rules('role', 'account type', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->data['useraccount'] = $this->users->get_staff_by_id($userid);
			$this->load->view('manager/editaccount', $this->data);
		} else {
			//update the account
			$this->users->edit_account($userid);

			$this->session->set_flashdata('successmsg', "User account successfully updated.");
			redirect('manager/useraccounts');
		}
	}

	public function delete($userid)
	{
		$this->users->delete_account($userid);

		$this->session->set_flashdata('successmsg', 'User account successfully deleted.');
		redirect('manager/useraccounts');
	}
}