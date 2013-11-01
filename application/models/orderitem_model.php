<?php
class orderitem_model extends CI_Model{
    //__construct
    //Constructor for orderitem
    public function __construct() {
       // $this->load->database();
    }
    //get_orderitems
    //get all order items
    public function get_orderitems(){
        $query = $this->db->get('orderitem');
        return $query->result();
    }
    //insert_orderitem
    //add order item
    public function insert_orderitem($menuid,$orderid,$ingredients,$price){
        $this->load->helper('url');
        $data = array(
            'menuid' =>$menuid,
            'orderid' =>$orderid,
            'ingredients' =>$ingredients,
            'price'=>$price
        );
        return $this->db->insert('orderitem',$data);

    }
    
    //get_orderitem_by_id
    //ger order item by id
    public function get_orderitem_information(){
        $query = $this->db->get_where('orderitem', array('id' =>$this->input->post('id')));
        return $query->row(); 
    }
    
    public function get_order_ingredients(){
        $query = $this->db->get_where('ingredient', array('menuItemid' =>$this->input->post('menuItemid')));
        return $query->result();
    }
    public function comp_item(){
        $data = array('comp' => $this->session->userdata('userid'), 'price'=>$this->input->post('price'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('orderitem', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }
    public function update_orderitem_from_payment($paymentid,$orderid){
        $data = array('paymentid' => $paymentid);
        $this->db->where('id', $orderid);
        $this->db->where('paymentid', null);
        $this->db->update('orderitem', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }    
    public function get_price_by_id(){
        $this->db->select('*');
        $this->db->from('menuitem');
        $this->db->join('orderitem', 'menuitem.id = orderitem.menuid');
        $this->db->where('orderitem.id',$this->input->post('id'));
        return $this->db->get()->row()->price;
        
    }
    //debug_remove_orderitem_by_id
    //this method shouldn't be called
    public function remove_orderitem_by_id(){
        $query = $this->db->delete('orderitem', array('id' =>$this->input->post('id')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }   
    
    public function get_orderitems_by_orderid(){
        $this->db->select('orderitem.price AS price, orderitem.id AS id, menuitem.name AS name');
        $this->db->from('orderitem');
        $this->db->join('menuitem', 'orderitem.menuid = menuitem.id');
        $this->db->where('orderitem.orderid', $this->input->post('orderid'));
        $query = $this->db->get();
        return $query->result(); 
    }
    
     public function get_comp_orders(){
        $query = $this->db->get_where('orderitem', array('comp' =>$this->input->post('comp')));
        return $query->result(); 
    }   
    
    public function create_order(){
        //Get json
        $data = $this->input->post('ordereditems');
        $productsArr = json_decode($data); 
        //Get session data
        $this->load->model('order_model');
            
        //Create order
        $order = $this->order_model->insert_order();
        $tempData = array('orderid'=>$order);
        $this->session->set_userdata($tempData);
        //Create order items
        foreach($productsArr as $product){
            $this->load->model('orderitem_model');
            $this->orderitem_model->insert_orderitem($product->menuid, $order, $product->ingredients,$product->price);            
        }
        
    }

    public function get_unpaid_items(){
        $this->db->select('orderitem.id AS id, orderitem.price AS price, menuitem.name AS name');
        $this->db->from('orderitem');
        $this->db->join('menuitem','orderitem.menuid = menuitem.id');
        $this->db->join('order', 'orderitem.orderid = order.id');
        $this->db->where('order.tabletnumber',$this->session->userdata('tabletnumber'));
        $this->db->where('order.tablenumber',$this->session->userdata('tablenumber'));
        $this->db->where('orderitem.paymentid',null);
        return $this->db->get()->result();
    }
}
?>
