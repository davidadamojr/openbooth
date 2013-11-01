<?php
class calculations extends CI_Model{
    var $taxValue = 1.08;
    public function get_values(){
        $tax = 1.08;
        $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
        $query = "SELECT FORMAT(SUM(orderitem.price*$tax), 2) AS total, FORMAT(SUM(orderitem.price),2) AS subtotal, 
                FORMAT(SUM(orderitem.price*0.08), 2) AS tax FROM (orderitem JOIN `order` ON orderitem.orderid = order.id) 
                WHERE order.tablenumber = $tablenumber AND order.tabletnumber = $tabletnumber AND orderitem.paymentid IS NULL";
        $result = $this->db->query($query);
        return $result->row();
    }
    
}
?>
