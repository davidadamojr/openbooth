<?php
class table_model extends CI_Model{
    //__construct
    //Constructor for table
    public function __construct() {
        //$this->load->database();
        require_once('application/models/vo/TableVO.php');
    }

    //get_tables
    //Get information on all tables
    public function get_tables(){
        $query_str = "SELECT DISTINCT tablenumber FROM `table`";
        $query = $this->db->query($query_str);
        return $query->result('TableVO');
    }

    //insert_table
    //insert table
    public function insert_table(){
        $data = array(
            'tablenumber'=>trim($this->input->post('tablenumber')),
            'tabletnumber'=> trim($this->input->post('tabletnumber')) 
            );
        $check = $this->db->get_where('table', array(
            'tablenumber'=>trim($this->input->post('tablenumber')),
            'tabletnumber'=> trim($this->input->post('tabletnumber'))
        ));
        if($check->num_rows() <= 0){
            $this->db->insert('table',$data); 
            $information = $this->db->get_where('table',$data)->row();
            return $information;   
        }
        return false;
    }
    //remove_table_by_id
    // remove table by id
    public function remove_table_by_id(){
	$this->db->delete('table', array('id' => $this->input->post('id')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;       
    }
    //remove_table_by_set
    //remove table by set
    public function remove_table_by_set(){
	$this->db->delete('table', array(
            'tablenumber'     =>   $this->input->post('tablenumber'),
            'tabletnumber'     =>   $this->input->post('tabletnumber')
         ));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }
    //update_table
    //update table to available
    public function update_table_available(){
        $data = array('inuse' => '0');
        $this->db->update('table', $data,array(
            'tablenumber'     =>   $this->session->userdata('tablenumber'),
            'tabletnumber'     =>   $this->session->userdata('tabletnumber')
            )
        ); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;   
    }
    //update_table
    //update table to unavailable
    public function update_table_unavailable(){
        $data = array('inuse' => '1');
        $this->db->update('table', $data,array(
            'tablenumber'     =>   $this->input->post('tablenumber'),
            'tabletnumber'     =>   $this->input->post('tabletnumber')
        )
                ); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }
    
    public function get_tables_by_inuse(){
        $query = $this->db->get_where('table', array('inuse' =>$this->input->post('inuse')));
        return $query->result(); 
    }
    
    
    //insert_table
    //add table
    public function set_identity(){
        $query = $this->db->get_where('staff', array('logincode' => trim($this->input->post('logincode'))));
        if($query->num_rows == 0 ){
            return FALSE;
        }
        else{
            $data = array(
                'tablenumber'     =>   trim($this->input->post('tablenumber')),
                'tabletnumber'     =>   trim($this->input->post('tabletnumber')),

            );
            $this->insert_table();
            $this->session->set_userdata($data);
            return TRUE;
            //return $this->db->insert('table', $data);
        }
    }
    
    // table_status_update
    // Updated inuse field
    // 0 -> noone
    // 1 -> someone
    public function table_status_update($inuse){   
        $data = array('inuse' => trim($inuse));
        $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
        $conditions = array(
            'tablenumber'     =>   $tablenumber,
            'tabletnumber'     =>   $tabletnumber
        );
        return  $this->db->update('table',$data,$conditions );
    }
    
}
?>
