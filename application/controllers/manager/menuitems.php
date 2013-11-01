<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class MenuItems extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['header'] = $this->load->view('manager/header', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);

		$this->load->model('menuitem_model', 'menuitems');
	}

	public function index()
	{
		$this->data['menuitems'] = $this->menuitems->get_all_menuitems();
		$this->load->view('manager/menuitems', $this->data);
	}
	
	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('calories', 'calories', 'required');
		$this->form_validation->set_rules('type', 'item type', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('manager/additem', $this->data);
		} else {
			//insert the menu item into the database
			$menuitemid = $this->menuitems->insert_menuitem();
			//insert ingredients
			if (trim($this->input->post('ingredients')) != ''){
				//there are optional ingredients
				$ingredients = explode(',', $this->input->post('ingredients'));
				foreach ($ingredients as $ingredient){
					$data = array('menuItemid'=>$menuitemid, 'name'=>ucfirst(trim($ingredient)));
					$this->db->insert('ingredient', $data);
				}
			}

			if ($this->do_upload($menuitemid)){
				//file upload was successful
				//update the image field of the menuitem
				$this->menuitems->update_image($menuitemid);
			} else {
				//file upload failed
				$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
			}

			$this->session->set_flashdata('successmsg', "New menu item successfully created.");
			redirect('manager/menuitems');
		}
	}

	//uploads the image for the menu item
	public function do_upload($menuitemid)
	{
		$config['upload_path'] = $this->config->item('img_upload');	
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['file_name'] = $menuitemid . '.jpg';

		$this->load->library('upload', $config);

		return $this->upload->do_upload();
	}

	public function edit($menuitemid)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('calories', 'calories', 'required');
		$this->form_validation->set_rules('type', 'item type', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->data['menuitem'] = $this->menuitems->get_menuitem($menuitemid);
			$this->load->view('manager/edititem', $this->data);
		} else {
			//insert the menu item into the database
			$this->menuitems->edit_menuitem($menuitemid);
			
			//update ingredients - delete first
			$this->load->model('ingredient_model', 'ingredients');
			$this->ingredients->remove_ingredient_by_id($menuitemid);

			if (trim($this->input->post('ingredients')) != ''){
				//there are optional ingredients
				$ingredients = explode(',', $this->input->post('ingredients'));
				foreach ($ingredients as $ingredient){
					$data = array('menuItemid'=>$menuitemid, 'name'=>ucfirst(trim($ingredient)));
					$this->db->insert('ingredient', $data);
				}
			}

			//update image
			if ($this->do_upload($menuitemid)){
				//file upload was successful
				//update the image field of the menuitem
				$this->menuitems->update_image($menuitemid);
			} else {
				//file upload failed
				$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
			}

			$this->session->set_flashdata('successmsg', "Menu item successfully updated.");
			redirect('manager/menuitems');
		}
	}

	function delete($menuitemid)
	{
		$this->menuitems->delete_menuitem($menuitemid);

		$this->session->set_flashdata('successmsg', 'Menu item successfully deleted.');
		redirect('manager/menuitems');
	}
}