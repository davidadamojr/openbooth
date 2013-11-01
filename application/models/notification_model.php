<?php
/*
 * Quentin Mayo
 *
 */
class notification_model extends CI_Model{
    //__construct
    //constructor for notification
    public function __construct(){
        //$this->load->database();
        require_once('application/models/vo/DespatchVO.php');
    }
    
    //get_notiications
    //return all notifications
    public function get_notifications(){
        $query = $this-> db-> get('notification');
        return $query->result();
    }
    
    //insert_notification
    //add notifications
    //description can't be null
    public function insert_notification(){
        $data = array(
            'description'=>"SET FOR DELIVERY",
            'orderid' => $this->input->post('id')
        );
        return $this->db->insert('notification',$data);
    }
    
    //get_notification_of_type
    //return notification of type
    //tabletnotification.description
    //0 -  Help
    //1 - Drink Refill
    public function get_notification_of_type(){
        $query = $this->db->get_where('notification', array('type' =>$this->input->post('type')));
        return $query->result();
    }
    //debug_remove_notification_by_id
    //this method shouldn't be called
    public function debug_remove_notification_by_id(){
        $query = $this->db->delete('notification', array('id' =>$this->input->post('id')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }
    //update_notification_acceptby
    public function accept_notification(){
        $data = array('acceptby' => $this->session->userdata('userid'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('notification', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }
    

    public function resolve_notification(){
        $this->db->delete('notification', array('id' => $this->input->post('id')));
    }

    //get_notifications_not_accepted
    //get notifications not accepted
    public function get_unaccepted_despatch(){
        $this->db->select('notification.id, notification.orderid, order.customername, order.tablenumber');
        $this->db->from('notification');
        $this->db->join('order', 'notification.orderid = order.id');
        $this->db->where('notification.acceptby', null);
        $query = $this->db->get();
        return $query->result('DespatchVO');
    }

    public function get_accepted_despatch(){
       $this->db->select('notification.id, notification.orderid, order.customername, order.tablenumber');
        $this->db->from('notification');
        $this->db->join('order', 'notification.orderid = order.id');
        $this->db->where('notification.acceptby IS NOT null');
        $query = $this->db->get();
        return $query->result('DespatchVO');
    }
}

?>
