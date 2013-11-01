<?php
class tabletnotification_model extends CI_Model{
    //constructor
    //constructor for table notification
    public function __construct(){
        //$this->load->database();
        require_once('application/models/vo/RefillVO.php');
    }
    
    public function get_tabletnotifications(){
        $query = $this->db->get('tabletnotification');
        return $query->result();
    }

    public function insert_tabletnotification(){
	$tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
        if($tablenumber== false || $tabletnumber== false){return false;}
           $data = array(
                'tablenumber'     =>   $tablenumber,
                'tabletnumber'     =>   $tabletnumber,
                'type'     =>           0,
                'description'      =>   "HELP REQUEST"
            );
           $test = array('tablenumber'=>$tablenumber,'tabletnumber'=>$tabletnumber,'acceptedby' =>null,'type' =>0);
            $testUsed =  $this->db->get_where('tabletnotification',$test);
            if($testUsed->num_rows() == 0 ){$this->db->insert('tabletnotification',$data);}
                
        
    }
    
    public function insert_drinkrefill(){
	    $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
           $data = array(
                'tablenumber'     =>   $tablenumber,
                'tabletnumber'     =>   $tabletnumber,
                'type'     =>           1,
                'description'      =>   "DRINK REFILL"
            );
            $test = array('tablenumber'=>$tablenumber,'tabletnumber'=>$tabletnumber,'acceptedby' =>null,'type' =>1);
            $testUsed =  $this->db->get_where('tabletnotification',$test);
            if($testUsed->num_rows() == 0 ){
                //Validate Drink refill
                $result = $this->db->query("SELECT orderitem.id FROM (orderitem JOIN menuitem ON orderitem.menuid = menuitem.id) WHERE menuitem.type = 3");
                if($result->num_rows() != 0 ){
                    $this->db->insert('tabletnotification',$data);
                    return true;
                }
                else{return false;}
                
             }
             else{return false;}
                
        
    }
    // get_tabletnotification_of_type
    // get notifications by type
    public function get_tabletnotification_of_type(){   
        $query = $this->db->get_where('tabletnotification',array('type'=>$this->input->post('type')));
        return $query->result();
    }
    
    public function accept_notification(){
        $data = array('acceptedby' => $this->session->userdata('userid'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tabletnotification', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }

    public function resolve_notification(){
        $this->db->delete('tabletnotification', array('id' => $this->input->post('id')));
    }

    public function delete_tabletnotification(){
	$this->db->delete('tabletnotification', array($this->get_id_set()));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    }

    /* get help requests */
    public function get_unaccepted_help_requests()
    {
        $this->db->select('*');
        $this->db->from('tabletnotification');
        $this->db->where('type', 0);
        $this->db->where('acceptedby', null);
        $query = $this->db->get();
        return $query->result();
    }

    /* get accepted help request */
    public function get_accepted_help_requests()
    {
        $this->db->select('*');
        $this->db->from('tabletnotification');
        $this->db->where('type', 0);
        $this->db->where('acceptedby IS NOT null');
        $query = $this->db->get();
        return $query->result();
    }

    /* get unaccepted drink refill requests */
    public function get_unaccepted_refills()
    {
        $this->db->select('*');
        $this->db->from('tabletnotification');
        $this->db->where('type', 1);
        $this->db->where('acceptedby', null);
        $query = $this->db->get();
        return $query->result('RefillVO');
    }

    /* get accepted drink refill requests */
    public function get_accepted_refills()
    {
        $this->db->select('*');
        $this->db->from('tabletnotification');
        $this->db->where('type', 1);
        $this->db->where('acceptedby IS NOT null');
        $query = $this->db->get();
        return $query->result('RefillVO');
    }
}
?>
