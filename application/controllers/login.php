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
			$ulink = '';					
			
			// composes email link for confirmation
			$ulink .= base_url('login/processforgotpassword') . '/';
			$ulink .= $this->input->post('sessid') . '/';
			$ulink .= strencode('advertiser') . '/';
			$ulink .= strencode($this->input->post('email'), TRUE) . '/';						
			
			$this->load->helper('util');
			//call_debug(getUser($email), FALSE);
		
			$outputmsg = '';
			$outputmsg .= 'Hello User,<br />';
			$outputmsg .= 'To complete your passowrd retrieval process please click the link. ' . '<a target="_blank" href="' . $ulink . '">' . $ulink . '</a>';
			
			$param = array('msg' => $outputmsg);
			
			//on_watch($ulink);
			if($this->_sendEmail($param)) {
				echo 'please check your email to complete the password retrieval process.';
			} else {
				echo 'sending failed.';
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
		call_debug(getUser($email), FALSE);
		
		if($sessId == "" || $userType == "" || $email == "") {
			echo "There's nothing to process here.";
		} else {
			on_watch("$sessId, $userType, $email");
		}
		
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