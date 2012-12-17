<?php // this is a cron job controller sample
class Tools extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		if(! $this->input->is_cli_request()) show_error("Direct script access not allowed");
		
	}
	public function message($to = 'World')
	{
		echo "Hello {$to}!".PHP_EOL;
	}
	
	public function getos() {
		echo php_uname();
		echo PHP_OS;
	}
	
}
?>