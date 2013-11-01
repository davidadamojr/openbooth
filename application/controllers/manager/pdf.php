<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class pdf extends CI_Controller {
          
	public function __construct(){
            parent::__construct();
        }
        public function cpd(){
            $this->load->model('statistics_model');
            $data['data'] = $this->statistics_model->compensations_per_day();
            $data['header'] = array('#Of Comps', 'Date');
            $this->load->view('pdf/pdf',$data);
        } 
        public function icpw(){
            $this->load->model('statistics_model');
            $data['data'] = $this->statistics_model->items_compensated_per_waiter();
            $data['header'] = array('Items comp per waiter','First Name','Last Name');
            $this->load->view('pdf/pdf',$data);
        }         
        public function gr(){
            $this->load->model('statistics_model');
            $data['data'] = $this->statistics_model->gross_revenue();
            $data['header'] = array('Gross Revenue','Number of orders','DATE');
            $this->load->view('pdf/pdf',$data);
        }
        public function fh(){
            $this->load->model('statistics_model');
            $data['data'] = $this->statistics_model->frequency_hourly();
            $data['header'] = array('Number of Menu Item','Menu Item','Time');
            $this->load->view('pdf/pdf',$data);
        }     
}