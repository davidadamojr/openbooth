<?php
class OrderVO {
	var $CI;

	public function __construct()
	{
		//gets a reference to the codeigniter super object to give access to models, etc.
		$this->CI =& get_instance();
	}

	/**
	* Get the items in this order
	*/
	public function getOrderedItems()
	{
		$this->CI->db->select('menuitem.name AS itemname');
		$this->CI->db->from('orderitem');
		$this->CI->db->join('menuitem', 'orderitem.menuid = menuitem.id');
		$this->CI->db->where('orderitem.orderid', $this->id);
		$query = $this->CI->db->get();
		return $query->result();
	}

	/* checks if payment has been completed for this particular order */
	public function checkPaymentComplete()
	{
		$this->CI->db->select('id');
		$this->CI->db->from('orderitem');
		$this->CI->db->where('orderid', $this->id);
		$this->CI->db->where('paymentid', null);
		$query = $this->CI->db->get();
		if ($query->num_rows() > 0){
			return false;
		} else {
			return true;
		}
	}
}
?>