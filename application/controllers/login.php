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

	public function admin($error = '') {
		
		$data['error'] = $error;
		$data['main_content'] = 'login/admin/admin_login_view';
		$this->load->view('includes/login/template', $data);

	}

	public function advertiser($error = '') {

		$data['error'] = $error;
		$data['main_content'] = 'login/advertiser/advertiser_login_view';
		$this->load->view('includes/login/template', $data);
	}

	public function validate_admin_login() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;

		$validation->set_rules('username', 'Username',  'required');
		$validation->set_rules('password', 'Password', 'required');

		if($validation->run() === FALSE) {
			$this->admin();
		} else {
			if($this->__isAdminExists()) {
				$params = array(
						'admin_uname' => $this->input->post('username'),
						'admin_islog' => TRUE,
						'admin_fullname' => $this->_mfullname
				);

				$this->sessionbrowser->setInfo($params);

				$params = array('admin_uname', 'admin_islog', 'admin_fullname');
				$this->sessionbrowser->getInfo($params);
				$arr = $this->sessionbrowser->mData;

				$this->_toggleLogIn('1', $this->input->post('username'), TRUE);

				redirect(base_url() . 'admin/panel');

			} else {
				$this->admin("Username and password doesn't match");
			}

		}

	}

	public function validate_my_login() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;

		$validation->set_rules('username', 'Username',  'required');
		$validation->set_rules('password', 'Password', 'required');


		// 		call_debug($_POST);
		if($validation->run() === FALSE) {
			$this->advertiser();
		} else {
			// stores currently loggedin user into sessionbrowser's sessoin variables
			if($this->_isUserExists()) {
				$params = array(
									'advr_uname' => $this->input->post('username'),
									'advr_islog' => TRUE,
									'advr_fullname' => $this->_mfullname
				);

				$this->sessionbrowser->setInfo($params);

				//change the advertiser's login status to TRUE
				$this->_toggleLogIn('1', $this->input->post('username'), FALSE);
					
				redirect(base_url() . 'advertiser/my');

			} else {
				$this->_mMyLoginError = TRUE;
				$this->advertiser("Username and password doesn't match");
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

	public function forgetpassword() {

		// gets what type of user is requesting for password retrieval process
		$user = ($this->uri->segment(3)) ? $this->uri->segment(3): $this->input->post('user');

		switch(strdecode($user)) {
			case 'advertiser':
				$this->_forgotPasswordAdvertiser($user);
				break;
			default:
				$this->_forgotPasswordAdmin($user);
		}

	}

	public function validateemailadvr() {

		$user = ($this->input->post('user')) ? $this->input->post('user') : strencode('advertiser');
		$this->load->library('form_validation');
		$validation  = $this->form_validation;

		// sets rules
		$validation->set_rules('email', 'Email', 'required|valid_email');

		if($validation->run() === FALSE) {
			$this->_forgotPasswordAdvertiser($user);
		} else {
				
			// checks if the supplied email exist in the database.
			$this->load->helper('util');
			$userInfo = getUser($this->input->post('email'));
			if(is_array($userInfo) && array_key_exists('advertiser', $userInfo)) {
				$ulink = '';
					
				// composes email link for confirmation
				$ulink .= base_url('login/processforgotpassword') . '/';
				$ulink .= $this->input->post('sessid') . '/';
				$ulink .= strencode('advertiser') . '/';
				$ulink .= strencode($this->input->post('email'), TRUE) . '/';
					
				//call_debug($userInfo);

				$outputmsg = '';
				$outputmsg .= "Hello " . $userInfo['fname'] . " " . $userInfo['lname'] . ",<br /><br />";
				$outputmsg .= 'You have requested a password retrieval. ';
				$outputmsg .= 'To complete your password retrieval process please click the link below.<br /> ' . '<a target="_blank" href="' . $ulink . '">' . $ulink . '</a><br /><br />';
				$outputmsg .= 'Web Admin<br />';
				$outputmsg .= '<a href="http://www.aus-newcastle.com">aus-newcastle.com</a>';
					
				$param = array('msg' => $outputmsg);
					
				if($this->_sendEmail($param)) {
					$this->_checkmailpasswordretrieval();
				} else {
					$this->_sendingmailpasswordretvalfailed();
				}
			} else {
				$this->_emailnotfound();
			}
		}
			
	}

	public function validateemailadmin() {

		$user = ($this->input->post('user')) ? $this->input->post('user') : strencode('admin');
		$this->load->library('form_validation');
		$validation  = $this->form_validation;

		// sets rules
		$validation->set_rules('email', 'Email', 'required|valid_email');

		if($validation->run() === FALSE) {
			$this->_forgotPasswordAdmin($user);
		} else {
			echo 'success';
		}

	}

	public function processforgotpassword() {
		
		$sessId = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
		$userType = ($this->uri->segment(4)) ? strdecode($this->uri->segment(4)) : '';
		$email = ($this->uri->segment(5)) ? strdecode($this->uri->segment(5)) : '';

		// get_user credentials
		$this->load->helper('util');
		//call_debug(getUser($email), FALSE);
		$userInfo = getUser($email);

		if($sessId == "" || $userType == "" || $email == "") {
			echo "There's nothing to process here.";
		} else {
			// checks session if it's not yet expired
			if(!isValidSession($sessId)) {
				echo 'Your session has been expired! Please ask for another password retrieval ticket.' . anchor(base_url('login/forgetpassword/' . strencode('advertiser')), ' Click here.') ;
			} else {
				// direct to final process form
				$this->_processpwordretrievalfinal();
			}
		}

	}
	
	public function validatepasswordretrieval() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		// sets rules
		$validation->set_rules('password', 'Password', 'required');
		$validation->set_rules('password2', 'Confirm Password', 'matches[password]|required');
		
		if($validation->run() === FALSE) {
			$this->_processpwordretrievalfinal();
		} else {
			// updates password of the user into the database
			if(strdecode($this->input->post('user')) == 'advertiser')
				$strQry = sprintf("UPDATE advertiser SET password='%s' WHERE email='%s'", md5($this->input->post('password')), $this->input->post('email'));
			else
				$strQry = sprintf("UPDATE `user` SET pword='%s' WHERE email='%s'", md5($this->input->post('password')), $this->input->post('email'));
			
			// executes query
			$params['querystring'] = $strQry;
			$this->load->model('mdldata');
			
			if($this->mdldata->update($params))
				echo 'Your password has been successfully changed.';
			else
				echo 'Password change failed';
		}
		
		
	}
	
	private function _sendingmailpasswordretvalfailed() {
		
		$data['main_content'] = 'login/passwordretrieval/advertiser/emailsendfailed_view';
		$this->load->view('includes/login/template', $data);
		
	}
	
	private function _emailnotfound() {
		
		$data['email'] = $this->input->post('email');
		$data['main_content'] = 'login/passwordretrieval/advertiser/emailnotfound_view';
		$this->load->view('includes/login/template', $data);
		
	}
	
	private function _checkmailpasswordretrieval() {
		
		$data['main_content'] = 'login/passwordretrieval/advertiser/checkemailpasswordretrieval_view';
		$this->load->view('includes/login/template', $data);
		
	}
	
	private function _processpwordretrievalfinal() {
		
		$email = ($this->uri->segment(5)) ? strdecode($this->uri->segment(5)) : $this->input->post('email');
		$sessId = ($this->uri->segment(3)) ? $this->uri->segment(3) : $this->input->post('sessid');
		$userType = ($this->uri->segment(4)) ? strdecode($this->uri->segment(4)) : $this->input->post('user');
		$userInfo = getUser($email);
		$data['userInfo'] = $userInfo;
		$data['session_id'] = $sessId;
		$data['fullname'] = (isset($userInfo['fname']) AND isset($userInfo['lname'])) ? $userInfo['fname'] . ' ' . $userInfo['lname'] : '' ;
		$data['email'] = $userInfo['email'];
		$data['user'] = $userType;
		 
		$data['main_content'] = 'login/passwordretrieval/advertiser/processforgotpasswordadvr_view';
		$this->load->view('includes/login/template', $data);
		
	}
	
	private function _sendEmail($param) {
		
		$subject = 'Password Retrieval';
		$msg = (array_key_exists('msg', $param)) ? $param['msg'] : 'My message';
		$receiver = $this->input->post('email');
		$sender = '';

		$config = array(
			'sender' => $sender,
  			'receiver' => $receiver,
  			'from_name' => 'Web Master', // OPTIONAL  			
  			'subject' => $subject, // OPTIONAL
  			'msg' => $msg, // OPTIONAL
  			'email_temp_account' => TRUE, // OPTIONAL. Uses your specified google account only. Please see this method "_tmpEmailAccount" below (line 111).  			
		);

		$this->load->library('emailutil', $config);
		if(! $this->emailutil->send())
			return FALSE;
			
		return TRUE;

	}

	private function _forgotPasswordAdvertiser($user) {

		$data['user'] = $user;
		$data['main_content'] = 'login/passwordretrieval/advertiser/passwordretrievaladvr_view';
		$this->load->view('includes/login/template', $data);

	}

	private function _forgotPasswordAdmin($user) {

		$data['user'] = $user;
		$data['main_content'] = 'login/passwordretrieval/admin/passwordretrievaadminl_view';
		$this->load->view('includes/login/template', $data);

	}

	/**
	 * utility methods
	 */
	private function _isUserExists() {

		$params = array('table' => array('name' => 'advertiser', 'criteria_phrase' => 'username="' . $this->input->post('username') . '" and password="' . md5($this->input->post('password')) .'"'));

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

		$strQry = sprintf("SELECT * FROM `user` WHERE uname='%s' AND pword='%s'", $this->input->post('username'), MD5($this->input->post('password')));

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