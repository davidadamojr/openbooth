<?php
 class ingredient_model extends CI_Model{
    //__contruct 
    //ingredient constructor 
    public function __contruct(){
        //$this ->load->database();
    }    
    //get_ingredients
    //Get ingredient
    public function get_ingredients(){
        $query = $this->db->get('ingredient');
        return $query->result();
    }
    
    //insert_ingredient
    //add new ingredient
    public function insert_ingredient(){
        $data = array(
            'name' => $this->input->post('name'),
            'menuitemid' => $this->input->post('menuitemid')
        );

        $check = $this->db->get_where('menuitem', array('id' =>$this->input->post('menuitemid')));
        if($check->num_rows() > 0){
            $this->db->insert('ingredient',$data);
            $information = $this->db->get_where('ingredient',$data)->row();
            return $information;
        }
        return FALSE;
    }
    
    
    //remove_ingredient_by_id
    //remove ingredient by id
    public function remove_ingredient_by_id($id){
	    $this->db->delete('ingredient', array('menuItemid' => $id));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;   
    }
    //update_menuitem_by_id 
    public function update_menuitem_by_id(){
        $data = array(
            'menuitemid' => $this->input->post('menuitemid'),
            'name' =>$this->input->post('name')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ingredient', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }
    //get_ingredients_by_menuitem
    //get all ingredients by menu item
    public function get_ingredients_by_menuitem(){
	$query = $this->db->get_where('ingredient', array('menuitemid' => $this->input->post('menuitemid')));
 
        return $query->result();
  
    }
}

?>