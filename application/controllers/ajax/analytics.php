<?php  if(!defined("BASEPATH")) exit("No direct script access allowed");
 
class Analytics extends CI_Controller  {

	function __construct() {
		parent::__construct();
		
	}
	
	public function perclick() {
		$link = $this->input->post('link');
		$id = $this->input->post('id');
		
		if(!$this->db->query("CALL sp_inccount(?, ? )", array($link, $id)))
			echo 'false';
		else
			echo 'true';
		
	}
}

