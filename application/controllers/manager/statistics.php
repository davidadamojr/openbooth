<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Statistics extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['header'] = $this->load->view('manager/header', '', TRUE);
		$this->data['sidebar'] = $this->load->view('manager/statsidebar', '', TRUE);
                
                $this->data['cpd']=$this->load->view('manager/statTabs/cpd','',true);
                $this->data['icpw'] =$this->load->view('manager/statTabs/icpw','',true);
                $this->data['gr'] =$this->load->view('manager/statTabs/gr','',true);
                $this->data['fh'] =$this->load->view('manager/statTabs/fh','',true);

	}

	public function index()
	{
		$this->load->view('manager/statistics', $this->data);
	}
}