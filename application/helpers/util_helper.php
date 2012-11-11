<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getUser($email) {
	
	$CI =& get_instance();
	$strQry = sprintf("SELECT * FROM vw_alluser WHERE email LIKE '%c%s%c'", 37, $email, 37);	
	$user = $CI->db->query($strQry)->result();

	// casts into array data type
	$user = (count($user > 0)) ? (array)$user[0] : '';
	
	if($user != '') {
		if(_isAdvertiser($user['email']))
			$user['advertiser'] = TRUE;
	}
	
	//call_debug($user);
	
	return $user;
}

function _isAdvertiser($email) {
	
	$CI =& get_instance();	
	$strQry = sprintf("SELECT * FROM advertiser WHERE email LIKE '%c%s%c'", 37, $email, 37);
	$rowcount = $CI->db->query($strQry)->num_rows();
	
	if($rowcount < 1)
		return FALSE;
		
	return TRUE;
	
}