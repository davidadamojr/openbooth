<?php
class staff_model extends CI_Model{
    //__construct
    //Constructor for staff
    public function __construct(){
       // $this->load->database();
    }
    
    //get_staff_members
    // get information of all staff
    public function get_staff_members(){
           $query= $this->db->get('staff');
           return $query->result();
    }
    //get_staff_by_id
    //get all information on staff by id
    public function get_staff_by_id($userid){
	   $query = $this->db->get_where('staff', array('id' => $userid));
        return $query->row();
    }
    //get_staff_by_login
    //get all information on staff by logincode
    public function get_staff_by_logincode(){
        $query = $this->db->get_where('staff', array('logincode' =>$this->input->post('logincode')));
            return $query->row();
    
    }
    
    //insert_new_staff_member
    //add new staff member
    public function insert_new_staff_member(){
        //generate six digit login code for the new staff member
        $continue = true;
        $code;
        while($continue){
            $code =  rand(100000, 999999);
            $check = $this->db->get_where('staff',array('logincode'=>$code));
            if($check->num_rows() <=0){$continue = false;}
        }

        $data = array(
            'fname'     =>   $this->input->post('fname'),
            'lname'     =>   $this->input->post('lname'),
            'role'      =>   $this->input->post('role'),
            'logincode' =>   $code
        );

        return $this->db->insert('staff', $data); 
        
    }

    function edit_account($userid)
    {
        $data = array('fname'=>$this->input->post('fname'), 'lname'=>$this->input->post('lname'), 'role'=>$this->input->post('role'));
        $this->db->where('id', $userid);
        $this->db->update('staff', $data);
    }
    
    //remove_staff_by_logincode
    public function remove_staff_by_logincode(){
	$this->db->delete('staff', array('logincode' => $this->input->post('logincode')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;        
    }
    
    //remove_staff_by_id
    public function delete_account($userid){
	   return $this->db->delete('staff', array('id' => $userid)); 
    }
    
    //get_staff_in_role
    //get all information on staff by id
    public function get_staff_by_role(){
	$query = $this->db->get_where('staff', array('role' => $this->input->post('role')));
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }    
    
   

}
?>
