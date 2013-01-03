<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(! function_exists('getUser')) {
	/**
	 * 
	 * Gets user credentials out from database
	 * @param string $email
	 * @return asscociative array
	 * @author Kenneth "digiArtist_ph" P. Vallejos
	 * @since Monday, November 12, 2012
	 * @version 1.0
	 */
	function getUser($email) {
				
		$CI =& get_instance();
		$strQry = sprintf("SELECT * FROM vw_alluser WHERE email LIKE '%c%s%c'", 37, $email, 37);
		$user = $CI->db->query($strQry)->result();

		//call_debug($user);
		
		// casts into array data type
		$user = (! empty($user)) ? (array)$user[0] : $user = '';

		if($user != '') {
			if(_isAdvertiser($user['email']))
			$user['advertiser'] = TRUE;
		}

		//call_debug($user);

		return $user;
	}

}

if(! function_exists('isValidSession')) {
	function isValidSession($sessid) {

		$CI =& get_instance();
		$strQry = sprintf("SELECT * FROM newcastle_sessions WHERE session_id='%s'", $sessid);
		
		if($CI->db->query($strQry)->num_rows() < 1)
			return FALSE;
			
		return TRUE;
		
	}
}

if(! function_exists('_isAdvertiser')) {
	function _isAdvertiser($email) {

		$CI =& get_instance();
		$strQry = sprintf("SELECT * FROM advertiser WHERE email LIKE '%c%s%c'", 37, $email, 37);
		$rowcount = $CI->db->query($strQry)->num_rows();

		if($rowcount < 1)
		return FALSE;

		return TRUE;

	}
}

if ( ! function_exists('isLocalEnv')) {
	function isLocalEnv($env = '') {
		$pattern = '/(?<=\/)localhost/';
		$subject = base_url();
		
		if($env != '')
			$subject = $env;
		
	if( ! preg_match($pattern, $subject))
		return 0;
		
		return 1;
	}
}

if(! function_exists('getCategories')) {
	function getCategories($categories) {
		// includes database.php
		require APPPATH .'config/config.php';
		
		
		$CI =& get_instance();
		$strQry = sprintf("CALL sp_get_categories('%s', %s)", $categories, '@categories');
		$baseurl = $config['base_url'] . 'directory/search/category/';
		$strLink = '';
		
		$CI->db->query($strQry);
		$links = $CI->db->query("SELECT @categories AS categories")->result();
		
		foreach ($links as $link) {
			$strLink = $link->categories;
		}
		
		$strLink = ($strLink != "")? preg_replace('/baseurl/', $baseurl, $strLink) : '';
		
		return $strLink;
		
	}
}