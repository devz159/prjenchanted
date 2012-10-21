<?php if ( !defined('BASEPATH')) exit('No direct script access allowed'); 

class Login extends CI_Controller {
	
	private $_mfullname;
	private $_mAdminFullname;
	private $_mMyLoginError;
	
	public function __construct(){
		parent::__construct();
		
		// initializes some member variables
		$this->_mfullname = '';
		$this->_mMyLoginError = null;
		
	}
	
	public function index() {		
		$this->advertiser();		
	}
	
	public function admin() {
		
		$data['main_content'] = 'login/admin/admin_login_view';
		$this->load->view('includes/login/template', $data);
		
	}
	
	public function advertiser() {
		
		if(isset($this->_mMyLoginError)) 
			$data['accnterror'] = TRUE;
		
		$data['main_content'] = 'login/advertiser/advertiser_login_view';
		$this->load->view('includes/login/template', $data);
	}
	
	public function validate_admin_login() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('uname', 'Username',  'required');
		$validation->set_rules('pword', 'Password', 'required');
		
		//call_debug($_POST);
		
		if($validation->run() === FALSE) {
			$this->admin();
		} else {
			if($this->__isAdminExists()) {
				$params = array(
						'admin_uname' => $this->input->post('uname'),
						'admin_islog' => TRUE,
						'admin_fullname' => $this->_mfullname
				);
				
				// loads the sessionbrowser
				//$this->load->library('sessionbrowser');
				
				$this->sessionbrowser->setInfo($params);
				
				$params = array('admin_uname', 'admin_islog', 'admin_fullname');
				$this->sessionbrowser->getInfo($params);
				$arr = $this->sessionbrowser->mData;
				
				//call_debug($arr);
				
				//change the admin's login status to TRUE
				$this->_toggleLogIn('1', $this->input->post('uname'), TRUE);
				
				//call_debug($_POST);
				
				redirect(base_url() . 'admin/panel');
				
			} else {
				$this->admin();
			}
						
		}
		
	}
	
	public function validate_my_login() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('uname', 'Username',  'required');		
		$validation->set_rules('pword', 'Password', 'required');
		
		
// 		call_debug($_POST);
		if($validation->run() === FALSE) {
			$this->advertiser();
		} else {
			// stores currently loggedin user into sessionbrowser's sessoin variables
			if($this->_isUserExists()) {
				$params = array(
									'advr_uname' => $this->input->post('uname'),
									'advr_islog' => TRUE,
									'advr_fullname' => $this->_mfullname
								);
				
				$this->sessionbrowser->setInfo($params);
				
				//change the advertiser's login status to TRUE
				$this->_toggleLogIn('1', $this->input->post('uname'), FALSE);
					
				redirect(base_url() . 'advertiser/my');
						
			} else {
				$this->_mMyLoginError = TRUE;
				$this->advertiser();
			}

		}
		
	}
	
	public function my_signout() {
					
		// getInfo();
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');
 		$this->sessionbrowser->getInfo($params); // returns TRUE if successful, otherwise FALSE
		$arr = $this->sessionbrowser->mData;
		
		//change the advertiser's login status to TRUE
 		$this->_toggleLogIn('0', $arr['advr_uname'], FALSE);
 		
 		$this->sessionbrowser->destroy($params);
 		
 		redirect(base_url() . 'login');
 		
	}
	
	public function admin_signout() {
		
		$params = array('admin_uname', 'admin_islog', 'admin_fullname');
		$this->sessionbrowser->getInfo($params); // returns TRUE if successful, otherwise FALSE
		$arr = $this->sessionbrowser->mData;
		
		//change the advertiser's login status to TRUE
 		$this->_toggleLogIn('0', $arr['admin_uname']);
 		
		$this->sessionbrowser->destroy($params);
		
		redirect(base_url() . 'login/admin');
		
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
	
	private function __isAdminExists() {
		
		$strQry = sprintf("SELECT * FROM `user` WHERE uname='%s' AND pword='%s'", $this->input->post('uname'), MD5($this->input->post('pword')));
		
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		
		if($this->mdldata->_mRowCount < 1)
			return FALSE;
		
		foreach($this->mdldata->_mRecords as $rec) {
			$this->_mAdminFullname = $rec->fname . ' ' . $rec->lname;
		}
		
		return TRUE;
	}
	
	private function _toggleLogIn($flag, $user, $admin = TRUE ) {	
		
		if(! $admin)
			$strQry = sprintf("UPDATE advertiser SET loggedin='%s' WHERE username='%s'", $flag, $user);
		else 
			$strQry = sprintf("UPDATE `user` SET loggedin='%s' WHERE uname='%s'", $flag, $user);
			
		$this->load->model('mdldata');
		$params["querystring"] = $strQry;
		
		// executes the query
		$this->mdldata->update($params);
				
	}	
		
}