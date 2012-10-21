<?php  if(!defined("BASEPATH")) exit("No direct script access allowed");
 
class Ajxsidebar extends CI_Controller  {
	//const sballenabled = 15; // 0xf
	
	function __construct() {
		parent::__construct();
		$this->load->library('settings');
		
	}
	
	public function sbWrite() {
		$cursettings = $this->settings->readSideBar();
		$control = intval($this->input->post('control'));
		$control = $control ^ $cursettings;
		
		$this->settings->writeSideBar(($control == 0) ? 16 : $control);
		
		echo $control;
		
	}
	
}
