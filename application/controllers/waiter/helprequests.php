<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class HelpRequests extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['header'] = $this->load->view('waiter/header', '', TRUE);

		$this->load->model('tabletnotification_model', 'tabletnotifications');
	}

	public function index()
	{
		$this->data['unacceptedrequests'] = $this->tabletnotifications->get_unaccepted_help_requests();
		$this->data['acceptedrequests'] = $this->tabletnotifications->get_accepted_help_requests();
		$this->load->view('waiter/helprequests', $this->data);
	}

	public function accept()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/helprequests');
		}

		$this->tabletnotifications->accept_notification();

		echo '1';
	}


	public function resolve()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/helprequests');
		}

		$this->tabletnotifications->resolve_notification();

		echo '1';
	}
}