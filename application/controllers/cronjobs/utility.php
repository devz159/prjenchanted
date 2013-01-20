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
		
		// open orders table
		//$strQry = sprintf("SELECT SUBSTRING_INDEX(itemnumber, '-', 1) AS lst_id, itemnumber, email, amount, `status`, created_at, CURTIME() FROM orders o WHERE DATE(created_at)=CURDATE() AND (TIME(created_at)<=CURTIME())");
		$this->db->query("CALL sp_expireads()");
		
		// retrieve all record that is expired on the day
		// execute sp to expire all those ads
		
	}
	
	public function notifyexpiringads() {
		
		// open orders table
		// retrieve all record that is about to expire w/in one week (notify them twice within the period of that one week)
		// send emails to respective recepients
		
	}
	
	private function scanads() {
		
	}
	
}
