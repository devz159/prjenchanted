<?php  if(!defined("BASEPATH")) exit("No direct script access allowed");
 
class Favorites extends CI_Controller  {

	function __construct() {
		parent::__construct();
		
		// loads the favlist library
		$this->load->library('favlist');
		
	}

	public function add() {
		
		$id = $this->input->post('id');	

		// add an item into favlist list			
		$this->favlist->addFav($id);
		
		$data['favorites'] = getFavItemsResultSet();
		$data['action'] = 'add';
		$this->load->view('ajax/ajxfavorites_view', $data);
		
	}
	
	public function remove() {
		$id = $this->input->post('id');
		
		// removes an item into favlist list
		$this->favlist->removeFav($id);
		
		$data['favorites'] = getFavItemsResultSet();
		$data['action'] = 'remove';
		$this->load->view('ajax/ajxfavorites_view', $data);
		 
	}
	
	
}