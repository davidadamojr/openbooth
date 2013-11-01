<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Payment extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->checkTableIdentity();

		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['paymentheader'] = $this->load->view('customer/paymentheader', '', TRUE);
		$this->data['callwaiter'] = $this->load->view('customer/callwaiter', '', TRUE);
		$this->data['cashpayment'] = $this->load->view('customer/cashpayment', '', TRUE);
		$this->data['game'] = $this->load->view('customer/game', '', TRUE);

		$this->load->model('orderitem_model', 'orderitems');
		$this->load->model('calculations');
		$this->load->model('coupon_model', 'coupons');
		$this->load->model('payment_model', 'payments');
		$this->load->model('coupon_model', 'coupons');
	}

	public function index()
	{
		$this->data['unpaid_items'] = $this->orderitems->get_unpaid_items();
		$unpaid_ids = "";
		foreach ($this->data['unpaid_items'] as $unpaid_item){
			if ($unpaid_ids == ""){
				$unpaid_ids = $unpaid_ids . $unpaid_item->id;
			} else {
				$unpaid_ids = $unpaid_ids . ',' . $unpaid_item->id;
			}
		}
		$this->data['unpaid_ids'] = $unpaid_ids;
		$this->data['values'] = $this->calculations->get_values();
		$this->load->view('customer/payment', $this->data);
	}

	/**
	* Shows the pages that informs the user that a payment was successful
	*/
	public function success()
	{
		$paymenttype = 0; //credit/debit card
		$paymentid = $this->payments->insert_payment($paymenttype);

		//update the items paid for
		$this->payments->insert_payments($paymentid);

		//get the items paid for
		$receipt_data['receiptitems'] = $this->payments->getPaymentItems($paymentid);
		$receipt_data['amounts'] = $this->payments->getAmounts($paymentid);
		$this->data['receipt'] = $this->load->view('customer/receipt', $receipt_data, TRUE);

		$this->data['outstanding'] = $this->payments->getOutstanding();

		$this->load->view('customer/paymentsuccess', $this->data);
	}

	public function redeemcode()
	{
		$valid = $this->coupons->validate_coupon();
		if ($valid){
			echo 1;
		} else {
			echo 0;
		}
	}

	public function getcoupon()
	{
		$alreadyplayed = $this->recordplay();
		if ($alreadyplayed == 'duplicate'){
			echo 'duplicate';
		} else {
			$coupon_code = $this->coupons->insert_coupon();
			echo $coupon_code;
		}		
	}

	public function recordplay()
	{
		//keeps count of how many times the user has played the game
		if ($this->session->userdata('playedgame') == 'played'){
			//user has already played the game before
			$playedtimes = $this->session->userdata('playedtimes');
			if ($playedtimes < 3){
				echo $playedtimes;
				$playedtimes = $playedtimes + 1;
				$this->session->set_userdata('playedtimes', $playedtimes); 
				echo '';
				return '';
			} else {
				echo "duplicate";
				return "duplicate"; //the user cannot play again
			}
		} else {
			$this->session->set_userdata('playedgame', 'played');
			$this->session->set_userdata('playedtimes', 1);
			echo '';
			return '';
		}

	}

}