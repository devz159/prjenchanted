<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * Monitors the lists of registered purchases
 *  
 * @package			CodeIgniter
 * @subpackage    	Application/Libraries
 * @category        Libraries
 * @author Kenneth "digiArtist" P. Vallejos
 * @link			http://n2esolutions.org
 * @version			1.0.1
 *
 */
class Register {
	
	private $_mConfig;
	
	public function __construct($config = array()) {
		
		echo 'Initialising Register class...';
		
		// initializes some variables.
		$this->_mConfig = null;
		
		if(!empty($config))
			$this->initialize($config);
	}
	
	public function initialize($config) {
		$this->_mConfig = $config;
	}
	
	
	public function readPackage() {
		
			
		return TRUE;
	}
	
	/**
	 * watch_list
	 * This function is a form of service running on the server as a thread
	 * 
	 */
	public function watch_list() {
		
	}
}