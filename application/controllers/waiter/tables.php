<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Tables extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['header'] = $this->load->view('waiter/header', '', TRUE);
		$this->data['comporder'] = $this->load->view('waiter/comporder', '', TRUE);

		$this->load->model('table_model', 'tables');
	}

	public function index()
	{
		$this->data['tables'] = $this->tables->get_tables();
		$this->load->view('waiter/tables', $this->data);
	}
}