<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajxpackagetype extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	
	public function packageType() {
		$data['type'] = $this->input->post('type');
		$this->load->view('ajax/ajxpackage_type_view', $data);
	}
	
}
