<?php if (! defined("BASEPATH")) exit('No direct script access allowed');

class Utility extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		// prevents this controller be accessed from the url
		if(! $this->input->is_cli_request()) show_error("Direct script access not allowed");
	}
	
	public function manageads($user = 'me') {
		
		log_message("error", "This cron is triggered from $user");
		
	}
	
	public function expireads() {
		
		// makes the premium advertising
		$this->db->query("CALL sp_expireads()");
		
		// makes the standard advertising expires
		$this->db->query("CALL sp_expireadsstandard()");
		
	}
	
	public function notifyexpiringads() {
		
		// open orders table
		// retrieve all record that is about to expire w/in one week (notify them twice within the period of that one week)
		// send emails to respective recepients
		
	}
	
	private function scanads() {
		
	}
	
}
