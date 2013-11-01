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
		$this->data['header'] = $this->load->view('kitchen/header', '', TRUE);
		$this->data['orderdetails'] = $this->load->view('kitchen/orderdetails', '', TRUE);

		$this->load->model('order_model', 'orders');
		$this->load->model('notification_model', 'notifications');
	}

	public function index()
	{
		$this->data['orders'] = $this->orders->get_pending_orders();
		$this->load->view('kitchen/orders', $this->data);
	}

	public function completeorder()
	{
		//update status of order to ready for delivery
		//insert a notification for the waiter
		$this->orders->update_order_status();
		$this->notifications->insert_notification();
	}

	public function getorderdetails()
	{
		//first change the status of the order to "being prepared"
		$this->orders->update_order_status();
		$ordereditems = $this->orders->get_order_information_by_id();
		$items_html = '';
		foreach ($ordereditems as $ordereditem){
			$items_html .= "<div class='kitchenorder'><p><b>{$ordereditem->itemname}</b></p>";
			if (trim($ordereditem->ingredients) == ''){
				$items_html .= "<ul><li>No extra ingredients.</li></ul></div>";
			} else if ($ordereditem->ingredients == 'All'){
				$items_html .= "<ul><li>All available ingredients.</li></ul></div>";
			} else {
				$ingredients = explode(',', $ordereditem->ingredients);
				$items_html .= "<ul>";
				foreach ($ingredients as $ingredient){
					$items_html .= "<li>" . ucfirst($ingredient) . "</li>";
				}
				$items_html .= "</ul></div>";
			}
		}
		echo $items_html;
	}
}