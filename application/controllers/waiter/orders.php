<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Orders extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['header'] = $this->load->view('waiter/header', '', TRUE);
		$this->data['comporder'] = $this->load->view('waiter/comporder', '', TRUE);
		$this->data['makepayment'] = $this->load->view('waiter/makepayment', '', TRUE);

		$this->load->model('order_model', 'orders');
		$this->load->model('orderitem_model', 'ordereditems');
		$this->load->model('payment_model', 'payments');
	}

	public function index()
	{
		$this->data['orders'] = $this->orders->get_orders();
		$this->load->view('waiter/orders', $this->data);
	}

	public function setasdelivered()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/orders');
		}

		$this->orders->update_order_status();
		echo 1;
	}

	public function makePayment()
	{
		//call model and make payment
		$this->payments->make_cash_payment();
		$this->session->set_flashdata('successmsg', 'Payment successful');
		redirect('waiter/orders');
	}

	public function getorderitems()
	{
		$ordereditems = $this->ordereditems->get_orderitems_by_orderid();
		$comp_html = '<table class="form">';
		foreach ($ordereditems as $ordereditem){
			$comp_html .= "<tr><td class='formlabel'>" . $ordereditem->name . "</td><td>$ <input type='text' id='price_" . $ordereditem->id . "' class='span1' value='" . $ordereditem->price . "' /></td>
						<td style='vertical-align:top;'><a href='#' onclick='compItem(event)' itemid='" . $ordereditem->id . "' class='btn'>Comp</a></td></tr>";
		}
		$comp_html .= '</table>';

		echo $comp_html;
	}

	public function compitem()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/orders');
		}

		$this->ordereditems->comp_item();

		echo 1;
	}

}