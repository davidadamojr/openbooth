<?php
class coupon_model extends CI_Model{
    //__construct
    //Constructor for Coupon
    public function __construct() {
       // $this->load->database();
    }
    //get_coupons 
    //Get all coupons
    public function get_coupons(){
        $query =$this->db->get('coupon');
        return  $query->result();
    }  
    //insert_coupon
    //Create new coupon
    public function insert_coupon(){  
        $continue = true;
        $code;
        while($continue){
            $code =  rand(100000, 999999);
            $check = $this->db->get_where('coupon',array('code'=>$code));
            if($check->num_rows() <=0){$continue = false;}
        }
       $data = array(
           'code'=>$code
        );
        $this->db->insert('coupon',$data); 
        return $code;
    }
    //function test coupon 
    public function validate_coupon(){
        $query = $this->db->get_where('coupon', array('code'=>$this->input->post('code'), 'used'=>0));
        if($query->num_rows() > 0){
            return true;
        }
        return false;
    }
    public function set_to_used(){
        $data = array('used' => 1);
        $this->db->where('code', $this->input->post('code'));
        $this->db->update('coupon', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;   
    }
    //Remove coupon for debug
    //This shouldn't be needed
    function debug_remove_coupon(){
        $this->db->delete('coupon',array('code'=>$this->input->post('code')));
        if($this->db->affected_rows()>0) return TRUE;
        return FALSE;
    }
    //function test coupon 
    public function validate_coupon_notused(){
        $this->load->helper('url');
        $query = $this->db->get_where('payment', array('coupon' =>$this->input->post('code') ));
        if($this->db->affected_rows()>0)  $query->row();
        return FALSE;
    }
}
?>