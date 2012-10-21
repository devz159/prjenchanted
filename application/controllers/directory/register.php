<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->model('mdldata');
		
	}
	
	public function index() {
		$data['states'] = $this->_loadState();
		$data['countries'] = $this->_loadCountry();
		$data['main_content'] = 'directory/register/register_view';
		$this->load->view('includes/directory/template_b', $data);
	}
	
	public function validate_registration() {
		
		if(isset($_POST['cancel'])) redirect(base_url() . 'directory/');
		
		$this->load->library('form_validation');
		
		$validation = $this->form_validation;
		
		$validation->set_rules('uname', 'Username', 'required|callback_username_check');
		$validation->set_rules('pword','Password', 'required');
		$validation->set_rules('pword2', 'Confirm Password', 'required|matches[pword]');
		$validation->set_rules('fname', 'First Name');
		$validation->set_rules('lname', 'Last Name');
		$validation->set_rules('address', 'Address', 'required');
		$validation->set_rules('suburb', 'Suburb');
		$validation->set_rules('state', 'State');
		$validation->set_rules('postcode', 'Postcode');
		$validation->set_rules('country', 'Country');
		$validation->set_rules('phone1', 'Primary Phone', 'required');
		$validation->set_rules('phone2', 'Secondary Phone');
		$validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
		$validation->set_rules('website', 'Website');
		
		if($validation->run() === FALSE) {
			$this->index();
		} else {
			
			// preps some data
			$tmpurl = $this->_prepURL($this->input->post('website'));
			
			$params['table'] = array('name' => 'advertiser'); 
			$params['fields'] = array(
										'fname' => $this->input->post('fname'),
										'lname' => $this->input->post('lname'),
										'address' => $this->input->post('address'),
										'suburb' => $this->input->post('suburb'),
										'postcode' => $this->input->post('postcode'),
										'state' => $this->input->post('state'),
										'country' => $this->input->post('country'),
										'phone' => $this->input->post('phone'),
										'phone2' => $this->input->post('phone2'),
										'email' => $this->input->post('email'),
										'website' => $tmpurl,
										'username' => $this->input->post('username'),
										'password' => $this->input->post('password')										
                                      );
			
			if($this->mdldata->insert($params)) {				
				
				// sends email confirmation
				$params = array(
								'sender' => 'someone@example.com',
								'receiver' => $this->input->post('email'),
								'from_name' => 'Newcastle-Hunter.com',
								'email_temp_account' => TRUE,
								'subject' => 'Congratulations! You successfully listed your ad with us',
								'msg' => '<h2>Congratulations!</h2><p>You\'ve listed your ad in our listing site.</p>'
							);
				
				
				$this->load->library('emailutil', $params);
								
				if($this->emailutil->send() === FALSE) {
					echo $this->emailutil->_mError;
					
				}
				
				echo 'Registration successfull';
				
			} else {
				echo 'Inserting record failed.';
			}
			
		}
		
	}
	
	public function username_check($user) {
		$params = array('table' => array('name' => 'advertiser', 'criteria' => 'username', 'criteria_value' => $user));
		
				
		$this->mdldata->select($params);
		
		if($this->mdldata->_mRowCount > 0):
			$this->form_validation->set_message('username_check', 'This %s has been used already.');
			return FALSE;
		endif;
		
		return TRUE;
	}
	
	public function email_check($email) {
		$params = array('table' => array('name' => 'advertiser', 'criteria' => 'email', 'criteria_value' => $email));
	
	
		$this->mdldata->select($params);
	
		if($this->mdldata->_mRowCount > 0):
			$this->form_validation->set_message('email_check', 'This %s has been associated with another account.');
			return FALSE;
		endif;
	
		return TRUE;
	}
	
	/**
	 * utility methods 
	 */
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
	
	private function _prepURL($str) {
		$output = '';
		$pattern = '/(http:\/\/(www\.)?)|(www\.)|(\\b)/i';
	
		$output .= preg_replace($pattern, "", $str);
	
		return $output;
	
	}
} 

