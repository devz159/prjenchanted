<?php  if(!defined("BASEPATH")) exit("No direct script access allowed");
 
class Settings {

	private $CI;
	private $session;
	private $sb_settings;
	
	const sbsettings = 'SBSETTINGS';
	const sballenabled = 15; // 0xf
	
	public function __construct() {
		//echo 'Iniitalizing Settings Class...<br />';

		// initializes some member variables.
		$this->CI =& get_instance();
		$config = array(
				'sess_cookie_name' => 'session_settings',
				'sess_expiration' => 0,
				'sess_use_database' => FALSE,
				'sess_encrypt_cookie' => TRUE
		);
		
		$this->CI->load->library('session', $config, 'session_settings');
		$this->session = $this->CI->session_settings;

	}
	
	public function readSideBar() {
		
		if($this->session->userdata(self::sbsettings) == '')
			$this->session->set_userdata(self::sbsettings, self::sballenabled);
		
		return $this->session->userdata(self::sbsettings);
	}
	
	
	public function writeSideBar($settings) {
		
// 		on_watch($settings);
		$this->session->set_userdata(self::sbsettings, $settings);
	}
	
	public function showall() {
		return $this->sb_settings;
	}
	
	
	
}

