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

if(! function_exists('mysqlPaginateLimit')) {
	function mysqlPaginateLimit($qry, $offset = '', $limit) {

		if($offset == ''):
			return  sprintf("%s LIMIT 0, %d", $qry, $limit);
		else:
			return sprintf("%s LIMIT %d, %d", $qry, $offset, $limit);
		endif;
	}
}

if (! function_exists('generatePagination')) {
	function generatePagination($siteurl, $qry, $uri_segment = 7, $per_page = 10, $numlinks = 2) {
		// includes database.php
		require APPPATH .'config/config.php';
		
		$CI =& get_instance();
		$baseurl = $config['base_url'];
		
		/* pagination */
		$CI->load->library('pagination');
	
		$config['base_url'] = $siteurl;
		$config['total_rows'] = $CI->db->query($qry)->num_rows();
		$config['uri_segment'] = $uri_segment;
		$config['per_page'] = $per_page;
		$config['num_links'] = $numlinks;
		$config['cur_tag_open'] = '<li class="disabled">';
		$config['cur_tag_close'] = '</li>';
		$config['anchor_class'] = 'class="ext_disabled"';		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$CI->pagination->initialize($config);
		
		$data['paginate'] = paginate_helper($CI->pagination->create_links());
		$record = $CI->db->query(mysqlPaginateLimit($qry, $CI->uri->segment($uri_segment), $per_page));
		$data['serps'] = $record->result();
		$data['numrows'] = $record->num_rows;
		/* end pagination */
		return $data;
	}
}

function getPositionPagination($segment = 7, $perpage = 2) {
		
	// includes database.php
	require APPPATH .'config/config.php';
	
	$CI =& get_instance();
	$baseurl = $config['base_url'];
	
	$pos = $CI->uri->segment($segment);
		
	if($pos == "") {
		return sprintf("%d - %d", 1, $perpage);
	} else {
		return sprintf("%d - %d", ($pos + 1), (($pos) + $perpage));
	}
		
}


?>