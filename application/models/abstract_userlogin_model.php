<?php
class abstract_userlogin_model extends CI_Model{
    //__construct
    //Constructor of abstract_userlogin_model
    public function __construct() {
       // $this->load->database();
    }
    //validate_userlogin
    //Staff login Validation
    //Takes  in the login code and the desired login code
    //returns object if sucessful
    // 0-> waiter
    // 1-> kitchen
    // 2-> manager
    public function validate_userlogin(){
        $query = $this->db->get_where('staff', array(
                    'logincode' =>$this->input->post('logincode'),
                    'role' => $this->input->post('role'))
                );
        if ($query->num_rows() == 1){
            //set necessary session variables
            $user = $query->row();
            $this->session->set_userdata('userid', $user->id);
            $this->session->set_userdata('role', $user->role);
            return true;
        } else {
            return false;
        }
    }

    /**
    * Checks whether a user is currently logged in or not
    * Determines whether certain sections of the application can be accessed
    */
    public function checkLoggedIn()
    {

    }

    /**
    * Unsets all session variables for a user - logout
    */
    public function logout()
    {
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('role');
    }    

    public function checkTableIdentity()
    {
        if (!$this->session->userdata('tablenumber') || !$this->session->userdata('tabletnumber')){
            //the tablenumber and tablet number for this customer has not yet been set
            redirect('tablesetup');
        }
    }
}
?>
