<?php  if(!defined("BASEPATH")) exit("No direct script access allowed");

class Ajxlistingdetails extends CI_Controller {
	
	public function toggleMenuTab() {
		
		$data['tab'] = $this->input->post('tab');	
		$id = $this->input->post('id');
		$data['listing'] = $this->_getListingDetails($id);
		$data['mapdata'] = $this->_mapdata($data['listing']);
		
		$this->load->view('ajax/ajxlisting_details_menu_tab', $data);
		
	}

	
	
}