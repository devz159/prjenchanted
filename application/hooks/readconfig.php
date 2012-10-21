<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('readCurSettings')) {
	function readCurSettings() {
		 
		$CI =& get_instance();
		$settings = array();
		
		// retrieves settings from db
		$result = openDB();
		
		// populates the array $settings
		if(null != $result) {
			while ($setting = mysql_fetch_object($result)) {
				$settings[$setting->setting] = $setting->value;
			}
		}
		
		// implements the configurations
		// preps data
		$settings['emails'] = (is_null($settings['emails'])) ? $settings['emails'] = '' : $settings['emails'];
		$settings['currency'] = (is_null($settings['currency'])) ? $settings['currency'] = '' : $settings['currency']; 	
		$settings['paymethods'] = (is_null($settings['paymethods'])) ? $settings['paymethods'] = '' : $settings['paymethods'];  // prep this data again
		$settings['siteurl'] = (is_null($settings['siteurl'])) ? $settings['siteurl'] = '' : $settings['siteurl']; 
		$settings['encryption_key'] = (is_null($settings['encryption_key'])) ? $settings['encryption_key'] = '' :$settings['encryption_key'];
		$settings['sess_cookie_name'] = (is_null($settings['sess_cookie_name'])) ? $settings['sess_cookie_name'] = '' : $settings['sess_cookie_name'];
		$settings['siteoffline'] = (is_null($settings['siteoffline'])) ? $settings['siteoffline'] = '' : $settings['siteoffline'];
		$settings['offlinemsg'] = (is_null($settings['offlinemsg'])) ? $settings['offlinemsg'] = '' : $settings['offlinemsg'];
		
		// emails
		
		// currency
		$CI->config->set_item('currency_code', strtoupper($settings['currency']));
		
		// payment methods
		$CI->config->set_item('paymentmethod',$settings['paymethods']);
		
		// site url or base_url
		$CI->config->set_item('base_url', $settings['siteurl']);
		
		// encription_key
		$CI->config->set_item('encryption_key', $settings['encryption_key']);
		
		// sess_cookie_name
		$CI->config->set_item('sess_cookie_name', $settings['sess_cookie_name']);
		
		// sess_table_name
		$CI->config->set_item('sess_table_name', $settings['sess_cookie_name'] . 's');
		
		// site offline
		$CI->config->set_item('siteoffline', $settings['siteoffline']);
		
		// offline msg
		$CI->config->set_item('offlinemsg', $settings['offlinemsg']);
		
		// timezone
		$CI->config->set_item('default_time_zone', $settings['timezone']);
		
		// sets actual default time zone
		date_default_timezone_set($CI->config->item('default_time_zone'));

	}
}

function openDB() {

	// includes database.php
	require APPPATH .'config/database.php';

	$server = $db['default']['hostname'];
	$database = $db['default']['database'];
	$username = $db['default']['username'];
	$password = $db['default']['password'];
	
	$link = @mysql_connect($server, $username, $password);
	
	
	// checks the connection if exisit
	if(! $link) {
		log_message("error","Connection failed %s", mysql_error());
	}
	
	// opens table.
	$strQry = sprintf("SELECT * FROM settings");
	$db = @mysql_select_db($database, $link);
	
	// checks the database if it is properly opened
	if(! $db) {
		log_message("error", "Cannot open $database", mysql_error());	
	}
	
	// executes the query
	$result = mysql_query($strQry);
	
	return ($result) ? $result : null;
	
}
