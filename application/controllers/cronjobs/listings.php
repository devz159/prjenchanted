<?php if(! defined('BASEPATH')) exit ('Direct script access not allowed');

class Listings extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		// prevents this controller be accessed from the url
		if(! $this->input->is_cli_request()) show_error("Direct script access not allowed");
				
	}
	
	public function watchlists() {
		log_message('error','watchlist cronjob succesfully executed.');

		// checks listing and advertiser_listing tables. include orders table too
		// listing table is where you expire the ad
	}
	
	
}
