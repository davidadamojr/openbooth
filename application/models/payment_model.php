<?php
class payment_model extends CI_Model{
    //__construct
    //Constructor for payment
    public function __construct() {
        //$this->load->database();
    }
    
    //get_payments
    //Get all payments
    public function get_payments(){
        $query = $this->db->get('payment');
        return $query->result();
    }
    
    //insert_payment
    //add payment
    public function insert_payment($paymenttype){
        //Since Post data changes from null to 0[false] after post
        ///we manually change it back
        $flag = $this->input->post('couponused');
        $coupon = $this->input->post('couponcode');
        if($flag== '1'){if($coupon == false ){ $coupon = null;}}
        else{$coupon = null;}

        $amount = $this->input->post('total');
        $tipamount = $this->input->post('tipamount');
        $taxamount = $this->input->post('tax');
         $data = array(
            'paymenttype'  =>$paymenttype,
            'amount'       =>$amount,
            'tipamount'    =>$tipamount,
            'couponcode'   =>$coupon,
                   'tax'   =>$taxamount
        );
        $this->db->insert('payment',$data);

        return $this->db->insert_id();
    } 

    //updates the status of the items paid for
    public function insert_payments($paymentid){
        $paymentData = explode(",", $this->input->post('ordereditems'));
            
        foreach($paymentData as $orderitemid){
            //insert_payment($paymenttype,$amount,$tipamount,$order,$orderitem)
            $this->load->model('orderitem_model');
            $this->orderitem_model->update_orderitem_from_payment($paymentid,$orderitemid);            
        }
    }

    //get_payment_information
    //get payment information by id
    public function get_payment_information(){
        $query = $this->db->get_where('payment', array('id' =>$slug));
        return $query->row_array(); 
    }
    //update_menuitem_by_id 
    public function update_payment_amount_by_id(){
        $data = array('amount' => $this->input->post('amount'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ingredient', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }
    public function update_payment_tipamount_by_id(){
        $data = array('tipamount' => $this->input->post('tipamount'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ingredient', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }
    public function remove_payment_by_id(){
        $query = $this->db->delete('payment', array('id' =>$this->input->post('id')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }  

    /* get the items paid for, in a particular payment */
    public function getPaymentItems($paymentid)
    {
        $this->db->select('menuitem.name AS name, orderitem.price AS price');
        $this->db->from('orderitem');
        $this->db->join('menuitem', 'orderitem.menuid = menuitem.id');
        $this->db->where('orderitem.paymentid', $paymentid);
        $query = $this->db->get();
        return $query->result();
    }

    /* gets the amount paid as tax for a particular payment */
    public function getAmounts($paymentid)
    {
        $this->db->select('tax, amount');
        $this->db->from('payment');
        $this->db->where('id', $paymentid);
        $query = $this->db->get();
        return $query->row();
    }

    /* gets outstanding payment amount for a particular device */
    public function getOutstanding()
    {
        $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');

        $this->db->select('sum(orderitem.price) AS outstanding');
        $this->db->from('orderitem');
        $this->db->join('order', 'orderitem.orderid = order.id');
        $this->db->where('paymentid', null);
        $this->db->where('order.tablenumber', $tablenumber);
        $this->db->where('order.tabletnumber', $tabletnumber);
        $query = $this->db->get();
        return $query->row()->outstanding;
    }

    public function make_cash_payment()
    {
        $orderid = $this->input->post('orderid');
        $tax = $this->input->post('tax');
        $amount = $this->input->post('amount');
        $tip = $this->input->post('tip');
        $paymenttype = 1; //cash

        $data = array(
            'paymenttype' => $paymenttype,
            'amount' => $amount,
            'tipamount' => $tip,
            'tax' => $tax
        );

        $this->db->insert('payment', $data);
        $paymentid = $this->db->insert_id();

        //update the ordered items
        $data = array('paymentid'=>$paymentid);
        $this->db->where('orderid', $orderid);
        $this->db->update('orderitem', $data);
    }
}
?>
