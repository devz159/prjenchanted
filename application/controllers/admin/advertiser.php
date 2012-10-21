<?php  if(!defined("BASEPATH")) exit("No direct script access allowed");
 
class Advertiser extends CI_Controller  {

	function __construct() {
		parent::__construct();
		
	}
	
	public function index() {
		
		$this->section();
	
	}
	
	public function section() {
		
		$section = ($this->uri->segment(4)=='') ? '' : '';
		
		switch($section) {
			case 'advertisers':
				$this->_advertisers();
				break;
			
			case 'add_new':
				break;
			
			default:
				
		}
	}
	
	private function _advertisers() {
		
		$data['main_content'];
		$this->load->view('includes/admin/template', $data);
		
	}
	
	
}

