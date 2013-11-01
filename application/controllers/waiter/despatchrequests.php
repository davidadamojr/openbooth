<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class DespatchRequests extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['header'] = $this->load->view('waiter/header', '', TRUE);

		$this->load->model('notification_model', 'notifications');
	}

	public function index()
	{
		$this->data['unaccepted_despatch'] = $this->notifications->get_unaccepted_despatch();
		$this->data['accepted_despatch'] = $this->notifications->get_accepted_despatch();
		$this->load->view('waiter/despatchrequests', $this->data);
	}

	public function accept()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/despatchrequests');
		}

		$this->notifications->accept_notification();

		echo '1';
	}


	public function resolve()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/despatchrequests');
		}

		$this->notifications->resolve_notification();

		echo '1';
	}
}