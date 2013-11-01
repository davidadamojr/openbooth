<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Notifications extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->checkTableIdentity();	

		$this->load->model('tabletnotification_model', 'tabletnotifications');	
	}

	public function callwaiter()
	{
		if (!$this->input->is_ajax_request()){
			redirect('customer/menu');
		}
		
		$this->tabletnotifications->insert_tabletnotification();
		
		echo "success";
	}

	public function drinkrefill()
	{
		if (!$this->input->is_ajax_request()){
			redirect('customer/menu');
		}
		
		if ($this->tabletnotifications->insert_drinkrefill()){
			echo '1';
		} else {
			echo '0';
		}
	}

}