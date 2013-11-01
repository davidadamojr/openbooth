<?php
class menuitem_model extends CI_Model{
    //__construct
    //Constructor for menutitem
    public function __construct(){
        //$this->load->database();
    }
    
    //get_menutitems
    //returns all menuitems
    public function get_menuitems($type=0){
        $query= $this-> db->get_where('menuitem', "type = $type");
        return $query->result();
    }

    public function get_all_menuitems()
    {
        $query = $this->db->get('menuitem');
        return $query->result();
    }

    //get_menutitems
    //returns all menuitems
    public function get_available_menuitems(){
        $query = $this->db->get_where('menuitem', array('available' => 1));
        return $query->result();
    }
    //insert_menuitem
    //add menuitem
    //Note that since we can add the duplicate items,
    //We don't check to see if there any duplicate
    public function insert_menuitem(){
        $data = array(
            'price' => $this->input->post('price'),
            'name' =>$this->input->post('name'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'calories' => $this->input->post('calories'),
            'available' =>$this->input->post('available'),
            'keywords' => $this->input->post('ingredients')
        );
        
        $this->db->insert('menuitem', $data);
        return $this->db->insert_id();
        
    }

    public function update_image($menuitemid)
    {
        $filename = $menuitemid . '.jpg';
        $data = array('picturepath'=>$filename);
        $this->db->where('id', $menuitemid);
        return $this->db->update('menuitem', $data);
    }

    public function search_by_title(){
        $this->db->select('*');
        $this->db->from('menuitem');
        //$this->db->join('ingredient', 'menuitem.id =  ingredient.menuItemid');
        $array = array('menuitem.name' => $this->input->post('search'));
          //  'ingredient.name' => $this->input->post('search') );
        $this->db->like($array); 
        return $this->db->get()->result();
    
    }
    //remove_menuitem_by_id
    // remove menuitem by id
    public function delete_menuitem($menuitemid){
	    $this->db->delete('menuitem', array('id' => $menuitemid));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;      
    }
    //0 -appetizer
    //1 - main dish
    //2 - dessert
    //3 - nonalcoholic drinks
    //4 - alcoholic drinks 
    public function get_menuitem_by_type($type){
	   $query = $this->db->get_where('menuitem', array('type' => $type, 'available'=>1));
       return $query->result();
    }
    
    //update_menuitem_by_id
    //update menuitem by id
    public function edit_menuitem($menuitemid){
        $data = array(
            'price' => $this->input->post('price'),
            'name' =>$this->input->post('name'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'calories' => $this->input->post('calories'),
            'available' =>$this->input->post('available'),
            'keywords' => $this->input->post('ingredients')
        );

        $this->db->where('id', $menuitemid);
        $this->db->update('menuitem', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }

    public function get_menuitem_by_id(){
        $query = $this->db->get_where('menuitem', array('id' => $this->input->post('id')));
        return $query->row();
    }

    public function get_menuitem($menuitemid){
        $query = $this->db->get_where('menuitem', array('id' => $menuitemid));
        return $query->row();
    }

    public function set_availability(){
        $available = $this->input->post('available');
        $data = array('available'=>$available);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('menuitem', $data);
    }
    public function get_leastOrderItem(){
        $query=$this->db->query(
            "SELECT menuitem. * , COUNT( * ) AS sells
            FROM menuitem, orderitem
            WHERE orderitem.menuid = menuitem.id
            GROUP BY menuitem.id
            Order By sells
            LIMIT 0,1");
        return $query->result();
        
    }

}
?>
