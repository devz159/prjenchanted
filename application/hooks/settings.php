<?php if (! defined("BASEPATH")) exit("No direct script access allowed");

class Settings {
	
	private $mCI;
	private $mSettings;
	
	
	public function __construct() {
		$settings;
		$id; $setkey; $setval; 
		
		// initializes some member variables.
		$this->mSettings = array();
		$this->mCI =& get_instance();
		
		// reads settings from the db.
		$strQry = sprintf("SELECT * FROM settings");
		
		$settings = $this->mCI->db->query($strQry)->result();
		// puts into array form
		foreach($settings as $setting) {
			$this->mSettings[] = array($setting->setting => $setting->value);
		}
		
		// converts into member variables
		foreach($this->mSettings as $key => $val) {
			foreach($val as $k => $v) {
				$this->$k = $v;
			}
		}

	}
	
	public function readSettings() {
		
		// preps data
		$this->emails = (is_null($this->emails)) ? $this->emails = '' : $this->emails;
		$this->currency = (is_null($this->currency)) ? $this->currency = '' : $this->currency; 
		$this->paymethods = (is_null($this->paymethods)) ? $this->paymethods = '' : $this->paymethods;  // prep this data again
		$this->siteurl = (is_null($this->siteurl)) ? $this->siteurl = '' : $this->siteurl; 
		$this->encryption_key = (is_null($this->encryption_key)) ? $this->encryption_key = '' : $this->encryption_key;
		$this->sess_cookie_name = (is_null($this->sess_cookie_name)) ? $this->sess_cookie_name = '' : $this->sess_cookie_name;
		$this->siteoffline = (is_null($this->siteoffline)) ? $this->siteoffline = '' : $this->siteoffline;
		$this->offlinemsg = (is_null($this->offlinemsg)) ? $this->offlinemsg = '' : $this->offlinemsg;
		
		// emails
		
		// currency
		
		// payment methods
		
		// site url or base_url
		$this->mCI->config->set_item('base_url', $this->siteurl);
		
		// encription_key
		$this->mCI->config->set_item('encryption_key', $this->encryption_key);
		
		// sess_cookie_name
		$this->mCI->config->set_item('sess_cookie_name', $this->sess_cookie_name);
		
		// sess_table_name
		$this->mCI->config->set_item('sess_table_name', $this->sess_cookie_name . 's');
		
		// site offline
		$this->mCI->config->set_item('siteoffline', $this->siteoffline);
		
		// offline msg
		$this->mCI->config->set_item('offlinemsg', $this->offlinemsg);
		
		// timezone
		$this->mCI->config->set_item('default_time_zone', $this->timezone);
		
		// sets actual default time zone
		date_default_timezone_set($this->mCI->config->item('default_time_zone'));
		
		//echo 'Today is: ' . date('Y-m-d H:i:s');
		/*echo 'Offline: ' . $this->mCI->config->item('offlinemsg') . '<br />';
		echo 'sess_table_name: ' . $this->mCI->config->item('sess_table_name');*/
	}
	
}