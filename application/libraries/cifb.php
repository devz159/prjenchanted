<?php 

require_once "firephp/fb.php";
	
class Cifb extends FB {
	
	public function __construct() {
		
		//echo 'Initialising firephp library<br/ >';
		
		// sets some defaults
		ob_start();
		FB::setEnabled(FALSE);
		
	}
	
	public function goEnable() {
		
		FB::setEnabled(TRUE);
		
	}
}
