<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajxsignup extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
	}
	
	public function popup_login() {
		$this->load->view('ajax/ajxlogin_popup_view');	
	}
	
	public function load_register() {
		$data['states'] = $this->_loadState();
		$data['countries'] = $this->_loadCountry();
		$this->load->view('ajax/ajxregister_view.php', $data);
	}
	
	public function load_login() {
		$this->load->view('ajax/ajxlogin_view');
		
	}
	
	public function validate_my_login() {
	
		// stores currently loggedin user into sessionbrowser's sessoin variables
		if($this->_isUserExists()) {
			$params = array(
					'advr_uname' => $this->input->post('uname'),
					'advr_islog' => TRUE,
					'advr_fullname' => $this->_mfullname
			);

			$this->sessionbrowser->setInfo($params);
			
			echo 'true';
		} else {
			echo 'false';
		}
	
	}
	
	private function _loadState() {
		$params = array(
				'table' => array('name' => 'state', 'order_by' => 'code:asc'));
	
		$this->mdldata->select($params);
	
		return $this->mdldata->_mRecords;
	}
	
	private function _loadCountry() {
		$params = array(
				'table' => array('name' => 'country', 'order_by' => 'code:asc', 'criteria_phrase' => 'name like "%Austra%"'));
	
		$this->mdldata->select($params);
	
		return $this->mdldata->_mRecords;
	}
	
	/**
	 * utility methods
	 */
	private function _isUserExists() {
	
		$params = array('table' => array('name' => 'advertiser', 'criteria_phrase' => 'username="' . $this->input->post('uname') . '" and password="' . md5($this->input->post('pword')) .'"'));
	
		$this->load->model('mdldata');
		$this->mdldata->select($params);
	
		if($this->mdldata->_mRowCount < 1)
			return FALSE;
	
	
		foreach ($this->mdldata->_mRecords as $rec) {
			$this->_mfullname = $rec->fname . ' ' . $rec->lname;
		}
	
		return TRUE;
	}
}
