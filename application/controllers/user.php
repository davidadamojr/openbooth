<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('abstract_userlogin_model', 'users');
	}

	/**
	* checks the login code and role and determines whether to grant the user access
	*/
	public function authenticate()
	{
		$loggedin = $this->users->validate_userlogin();
		if ($loggedin){
			echo '1';
		} else {
			echo '0';
		}
	}


	/**
	* logs a user out and removes session variables
	*/
	public function logout()
	{
		$this->users->logout();
		redirect('kitchen');
	}
}