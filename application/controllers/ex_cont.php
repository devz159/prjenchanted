<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Ex_cont extends CI_Controller {
	function elfinder_init()
	{
	  $this->load->helper('path');
	  $opts = array(
		// 'debug' => true, 
		'roots' => array(
		  array( 
			'driver' => 'LocalFileSystem', 
			'path'   => set_realpath('images') . '/', 
			'URL'    => site_url("images") . '/'
			// more elFinder options here
		  ) 
		)
	  );
	  

	  $this->load->library('elfinder_lib', $opts);	
	}
}