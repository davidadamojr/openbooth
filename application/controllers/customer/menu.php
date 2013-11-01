<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author David Adamo Jr.
*/
class Menu extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->checkTableIdentity();

		$this->data['menuheader'] = $this->load->view('customer/menuheader', '', TRUE);
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['yourorder'] = $this->load->view('customer/yourorder', '', TRUE);
		$this->data['callwaiter'] = $this->load->view('customer/callwaiter', '', TRUE);
		$this->data['drinkrefill'] = $this->load->view('customer/drinkrefill', '', TRUE);
		$this->data['moreinfo'] = $this->load->view('customer/moreinfo', '', TRUE);
		$this->data['customize'] = $this->load->view('customer/customize', '', TRUE);

		$this->load->model('menuitem_model', 'menuitems');
		$this->load->model('ingredient_model', 'ingredients');
		$this->load->model('table_model', 'table');
		$this->load->model('orderitem_model', 'orderitems');
		$this->load->model('payment_model', 'payments');
	}

	public function index()
	{
		$content_data['menuitems'] = $this->menuitems->get_menuitem_by_type(0);
		$content_data['img_path'] = $this->config->item('img_path');
		$this->data['menucontent'] = $this->load->view('customer/menucontent', $content_data, TRUE);
		$this->data['featureditem'] = $this->menuitems->get_leastOrderItem();

		$this->load->model('news_model');
		$this->data['news'] = $this->news_model->get_news();
		$this->load->view('customer/menu', $this->data);
	}

	public function get_menu_items()
	{
		if (!$this->input->is_ajax_request()){
			redirect('customer/menu', 'refresh');
		}

		$type = $this->input->post('type');
		$menuitems = $this->menuitems->get_menuitem_by_type($type);
		$menuitems_html = '';
		$img_path = $this->config->item('img_path');
		$index = 0;
		foreach ($menuitems as $menuitem){
			if ($index % 2 == 0){
				$menuitems_html .= "<div class='span6 menuitem' style='margin-left:0'>";
				if ($menuitem->picturepath == '' || $menuitem->picturepath == null){
					$menuitems_html .= "<img src='" . base_url() . "assets/img/140x140.gif" . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				} else {
					$menuitems_html .= "<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				}			
				$menuitems_html .= "<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/><a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn' data-toggle='modal'>"; 
				
				if ($menuitem->calories < 1000) 
					$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
				else
					$menuitems_html .= "More Info</a>";
				
				$menuitems_html .= "<br/><br/>
				<a href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
				&nbsp;&nbsp;
				<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
				</div>";
			} else {
				$menuitems_html .= "<div class='span6 menuitem'>";
				if ($menuitem->picturepath == '' || $menuitem->picturepath == null){
					$menuitems_html .= "<img src='" . base_url() . "assets/img/140x140.gif" . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				} else {
					$menuitems_html .= "<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				}		
				$menuitems_html .= "<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/>
				<a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn' data-toggle='modal'>"; 
				
				if ($menuitem->calories < 1000) 
					$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
				else
					$menuitems_html .= "More Info</a>";
				
				$menuitems_html .= "<br/><br/>
				<a href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
				&nbsp;&nbsp;
				<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
				</div>";
			}
			$index = $index + 1;
		}
		echo $menuitems_html;
	}

	public function search()
	{
		if (!$this->input->is_ajax_request()){
			redirect('customer/menu', 'refresh');
		}

		$menuitems = $this->menuitems->search_by_title();
		$img_path = $this->config->item('img_path');
		$menuitems_html = "<h4>Search results for '" . $this->input->post('search') . "'</h4>";
		if (empty($menuitems)){
			$menuitems_html .= "<div class='alert alert-danger'><strong>No search results found.</strong></div>";
		} else {
			$index = 0;
			foreach ($menuitems as $menuitem){
				if ($index % 2 == 0){
					$menuitems_html .= "<div class='span6 menuitem' style='margin-left:0'>
					<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />
					<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/>
					<a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn' data-toggle='modal'>"; 
					
					if ($menuitem->calories < 1000) 
						$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
					else
						$menuitems_html .= "More Info</a>";
					
					$menuitems_html .= "<br/><br/>
					<a href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
					&nbsp;&nbsp;
					<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
					</div>";
				} else {
					$menuitems_html .= "<div class='span6 menuitem'>
					<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />
					<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/>
					<a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn' data-toggle='modal'>"; 
					
					if ($menuitem->calories < 1000) 
						$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
					else
						$menuitems_html .= "More Info</a>";
					
					$menuitems_html .= "<br/><br/>
					<a href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
					&nbsp;&nbsp;
					<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
					</div>";
				}
				$index = $index + 1;	
			}
		}
		echo $menuitems_html;
	}

	public function moreinfo()
	{
		if (!$this->input->is_ajax_request()){
			redirect('customer/menu');
		}

		$img_path = $this->config->item('img_path');
		$iteminfo = $this->menuitems->get_menuitem_by_id();
		$html = "<p><img src='" . $img_path . $iteminfo->picturepath ."' class='img-polaroid menuimg pull-left' />
				<p>" . $iteminfo->description . "</p><p><b>Calories:</b> " . $iteminfo->calories . "</p></p>";

		echo $html;
	}

	public function placeorder()
	{
		if (!$this->input->is_ajax_request()){
			redirect('customer');
		}
		$this->orderitems->create_order();
		
		echo '1';//success
	}

	public function getingredients()
	{
		$ingredients = $this->ingredients->get_ingredients_by_menuitem();
		if (empty($ingredients)){
			$ingredients_html = "<p class='contentbox rounded-4px'>There are no optional ingredients for this menu item.</p>";
		} else {
			$ingredients_html = "<p class='contentbox rounded-4px'>Please indicate the items you do not want by deselecting the appropriate checkeboxes.
							</p>";
			foreach ($ingredients as $ingredient){
				$ingredients_html .= "<div class='ingredientbox'><input class='ingr_box' onclick='selectIngredient(event)' ingrname='" . $ingredient->name . "' type='checkbox' checked/> " . $ingredient->name . "</div>";
			}
		}

		echo $ingredients_html;
	}

	/**
	* Remove the customer's name from the session variable
	* Set the status of the table to unoccupied
	*/
	public function customer_exit()
	{
		$this->table->update_table_available();
		$outstanding_amount = $this->payments->getOutstanding();
		if ($outstanding_amount == 0){
			$this->session->unset_userdata('customername');
			$this->session->unset_userdata('playedgame');
			$this->session->unset_userdata('playedtimes');
			redirect('customer', 'refresh');
		} else {
			//user still has orders to pay for
			$this->session->set_flashdata('outstanding_msg', "You still have outstanding orders to pay for. Please touch or click the 'Make Payments' button to make payments.");	
			redirect('customer/menu', 'refresh');
		}
	}
}