<?php
class order_model extends CI_Model{
    //__construct
    //constructor for order
    public function __construct(){
       // $this->load->database();
        require_once('application/models/vo/OrderVO.php');
    }
    //get_orders
    //get all pending orders - orders that are not delivered or ready for delivery
    public function get_pending_orders(){
        $query = $this->db->get_where('order', 'order.status NOT IN (2, 3)');
        return $query->result('OrderVO');
    }

    public function get_orders(){
        $query = $this->db->get_where('order', 'order.status != 3');
        return $query->result('OrderVO');
    }
    
    //insert_order
    //add order
    public function insert_order(){
        $data = array(
            'tablenumber' => $this->session->userdata('tablenumber'),
            'tabletnumber' => $this->session->userdata('tabletnumber'),
            'customername' => $this->session->userdata('customername'),
            
        );
        $this->db->insert('order', $data);
        
        return $this->db->insert_id();
    }
    //get_order_information
    //get order information base on id
    public function get_order_information_by_id(){
        $this->db->select('menuitem.name AS itemname, orderitem.ingredients AS ingredients');
        $this->db->from('orderitem');
        $this->db->join('menuitem', 'orderitem.menuid = menuitem.id');
        $this->db->where('orderitem.orderid', $this->input->post('id'));
        $query = $this->db->get();
        return $query->result();
    }
    //get_order_information_by_pickuptime
    //get order information base on id
    public function get_order_information_by_pickuptime(){
        $query = $this->db->get_where('order', array('pickuptime' =>$this->input->post('pickuptime')));
        return $query->result();
    }
    //get_order_information_by_status
    //get order information base on status
    public function get_order_information_by_status(){
        $query = $this->db->get_where('order', array('status' =>$this->input->post('status')));
        return $query->result(); 
    }
    
    //update the status of an order
    public function update_order_status(){
        $data = array('status' => $this->input->post('status'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('order', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;   
    }
    
    //debug_remove_order_by_id
    //this method shouldn't be called
    public function remove_order_by_id(){
        $query = $this->db->delete('order', array('id' =>$this->input->post('id')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }    

    
}

?>
