<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {
		
	private $_mConfig;
	
	public function __construct() {
		parent::__construct();
		
		$params = array('admin_uname', 'admin_islog', 'admin_fullname');
		$this->sessionbrowser->getInfo($params);
		$arr = $this->sessionbrowser->mData;
		
		//call_debug($arr);
		
		// authorizes access
		authUser(array('section' => 'login/admin', 'sessvar' => array('admin_uname', 'admin_islog', 'admin_fullname')));
				
		// sets default prefs
		$this->_mConfig = array('full_tag_open' => '<div class="pagination">', 'full_tag_close' => '</div>', 'first_link' => 'First', 'last_link' => 'Last', 'next_link' => '»', 'prev_link' => '«');

	}
	
	public function index() {
		$this->section();
	}
	
	public function section() {
		
		$section = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		
		switch($section) {
			case 'advertisers':
				$this->_advertisers();
				break;
			case 'categories':
				$this->_categories();
				break;
			case 'newcategory':
				$this->_newcategory();
				break;
			case 'editcategory':
				$this->_editcategory();
				break;
			case 'deletecategory':
				$this->_deletecategory();
				break;
			case 'subcategories':
				$this->_subcategories();
				break;
			case 'newsubcategory':
				$this->_newsubcategory();
				break;
			case 'editsubcategory':
				$this->_editsubcategory();
				break;
			case 'deletesubcategory':
				$this->_deletesubcategory();
				break;
			case 'products':
				$this->_products();
				break;
			case 'newproduct':
				$this->_newproduct();
				break;
			case 'editproduct':
				$this->_editproduct();
				break;
			case 'deleteproduct':
				$this->_deleteproduct();
				break;
			case 'listings':
				$this->_listings();					
				break;
			case 'states':
				$this->_states();
				break;
			case 'newstate':
				$this->_newstate();
				break;
			case 'editstate':
				$this->_editstate();
				break;
			case 'deletestate':
				$this->_deletestate();
				break;
			case 'countries':
				$this->_countries();
				break;
			case 'newcountry':
				$this->_newcountry();
				break;
			case 'editcountry':
				$this->_editcountry();
				break;
			case 'deletecountry':
				$this->_deletecountry();
				break;
			case 'newarticle':
				$this->_newarticle();
				break;
			case 'allarticles':
				$this->_allarticles();
				break;
			case 'editarticle':
				$this->_editarticle();
				break;
			case 'sections':
				$this->_sections();
				break;	
			case 'newsection':
				$this->_newsection();
				break;
			case 'editsection':
				$this->_editsection();
				break;
			case 'users':
				$this->_users();
				break;
			case 'newuser':
				$this->_newuser();
				break;
			case 'edituser':
				$this->_edituser();
				break;
			case 'deleteuser':
				$this->_deleteuser();
				break;
			case 'generalsetttings':
				$this->_generalsetttings();
				break;
			case 'emails':
				$this->_emails();
				break;
			case 'newemail':
				$this->_newemail();
				break;
			case 'editemail':
				$this->_editemail();
				break;
			default:
				$this->_advertisers();
		}			
		
	}
	
	public function validateeditemail() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('email', 'Email', 'required|valid_email');
		$validation->set_rules('description', 'Description');
		
		if($validation->run() === FALSE) {
			$this->_editemail();
		} else {
			
			$strQry = sprintf("UPDATE emails SET email='%s', description='%s' WHERE e_id=%d", mysql_escape_string($this->input->post('email')), mysql_escape_string($this->input->post('description'), $this->input->post('email_id')));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if(! $this->mdldata->insert($params))
				echo 'Updating existing record failed.';
			else
				redirect(base_url("admin/panel/section/emails"));
		}
		
	}
	public function validatenewemail() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('email', 'Email', 'required|valid_email');
		$validation->set_rules('description', 'Description');
		
		if($validation->run() ===  FALSE) {
			$this->_newemail();
		} else {
			
			$strQry = sprintf("INSERT INTO emails SET email='%s', description='%s'", mysql_escape_string($this->input->post('email')), mysql_escape_string($this->input->post('description')));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if(! $this->mdldata->insert($params))
				echo 'Insert new record failed.';
			else 
				redirect(base_url("admin/panel/section/emails"));
		}
		
	}
	
	private function _editemail() {
		
		$email_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : (($this->input->post('state_id')) ? $this->input->post('state_id'): 0);
		
		$strQry = sprintf("SELECT * FROM emails WHERE e_id=%d", $email_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['emails'] = $this->mdldata->_mRecords;		
		$data['email_id'] = $email_id;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		$data['superadmin'] = ''; //$this->_isSuperAdmin();
		
		$data['main_content'] = 'admin/emails/editemail_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _newemail() {
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		$data['superadmin'] ='';// $this->_isSuperAdmin(); // for super admin only
		
		$data['main_content'] = 'admin/emails/newemail_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _emails() {

		$strQry = sprintf("SELECT * FROM emails");	
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['emails'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		$data['superadmin'] = $this->_isSuperAdmin();
		
		$data['main_content'] = 'admin/emails/emails_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	public function validateeditsettings() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('currency', 'Currency', 'required');
		$validation->set_rules('timezone', 'Timezone', 'required');
		$validation->set_rules('siteurl', 'Site URL', 'required');
		$validation->set_rules('encriptionkey', 'Encription Key', 'required');
		$validation->set_rules('cookiename', 'Cookie Name', 'required');
		$validation->set_rules('paypalaccount', 'Paypal Account');
		$validation->set_rules('merchantaccount', 'Merchant Account');
		
		if($validation->run() === FALSE) {
			$this->_generalsetttings();
		} else {

			// updates database
			// currency
			$strQry = sprintf("UPDATE settings SET `value`='%s' WHERE setting LIKE '%ccurrency%c'", $this->input->post('currency'), 37,37);			
			$this->db->query($strQry);

			// timezone
			$strQry = sprintf("UPDATE settings SET `value`='%s' WHERE setting LIKE '%ctimezone%c'", $this->input->post('timezone'), 37,37);
			$this->db->query($strQry);
			
			// paymethods
			$paymethod = (isset($_POST['paymethod'])) ? implode(',', $_POST['paymethod']) : '';		
			$strQry = sprintf("UPDATE settings SET `value`='%s' WHERE setting LIKE '%cpaymethods%c'", $paymethod, 37,37);
			$this->db->query($strQry);
			
			// siteurl
			$strQry = sprintf("UPDATE settings SET `value`='%s' WHERE setting LIKE '%csiteurl%c'", $this->input->post('siteurl'), 37,37);
			$this->db->query($strQry);
			
			// encriptionkey
			$strQry = sprintf("UPDATE settings SET `value`='%s' WHERE setting LIKE '%cencryption_key%c'", $this->input->post('encriptionkey'), 37,37);
			$this->db->query($strQry);
			
			// cookiename
			$strQry = sprintf("UPDATE settings SET `value`='%s' WHERE setting LIKE '%csess_cookie_name%c'", $this->input->post('cookiename'), 37,37);
			$this->db->query($strQry);
			
			// paypalaccount
			$strQry = sprintf("UPDATE settings SET `value`='%s' WHERE setting LIKE '%cpaypalaccount%c'", $this->input->post('paypalaccount'), 37,37);
			$this->db->query($strQry);
			
			// merchantaccount
			$strQry = sprintf("UPDATE settings SET `value`='%s' WHERE setting LIKE '%cmerchantaccount%c'", $this->input->post('merchantaccount'), 37,37);
			$this->db->query($strQry);
			
			// site offline
			// preps data
			$offline = (strtolower($this->input->post('offline') == 'offline') ? '1' : '0');
			$strQry = sprintf("UPDATE settings SET `value`='%d' WHERE setting LIKE '%csiteoffline%c'", $offline, 37,37);
			$this->db->query($strQry);
			
			// show affiliate program on business profile page.
			$showadsonbusprofpage = ($this->input->post('showaffiliateprogram')) ? '1' : '0';
			$strQry = sprintf("UPDATE settings SET `value`='%s' WHERE setting LIKE '%cshowaffiliateprogram%c'", $showadsonbusprofpage, 37,37);
			$this->db->query($strQry);
			
			$this->_updatedsettings();
			
		}
		
		
	}
	
	private function _updatedsettings() {
		
		$data['main_content'] = 'admin/generalsettings/updatesettings_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _generalsetttings() {
		
		$strQry = sprintf("SELECT * FROM currencies ORDER BY code ASC");
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['currencies'] = $this->mdldata->_mRecords;
		
		$strQry = sprintf("SELECT * FROM settings");
		$params['querystring'] = $strQry;
		$this->mdldata->reset();
		$this->mdldata->select($params);
		$data['settings'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		$data['superadmin'] = $this->_isSuperAdmin(); // for super admin only
		
		$data['main_content'] = 'admin/generalsettings/generalsettings_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	
	public function validatenewuser() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('fname', 'First Name', 'required');
		$validation->set_rules('lname', 'Last Name', 'required');
		$validation->set_rules('uname', 'Username', 'required');
		$validation->set_rules('email', 'Email', 'required');
		$validation->set_rules('pword', 'Password', 'required|min_length[6]');
		$validation->set_rules('pword2', 'Confirm Password', 'required|matches[pword]');
		$validation->set_rules('ulevel', 'Access Level', 'required');
		
		if($validation->run() === FALSE) {
			$this->_newuser();
		} else {
			$strQry = sprintf("INSERT INTO `user` SET fname='%s', lname='%s', uname='%s', pword='%s', email='%s', ulevel='%s'",
					$this->input->post('fname'),
					$this->input->post('lname'),
					$this->input->post('uname'),
					md5($this->input->post('pword')),
					$this->input->post('email'),
					$this->input->post('ulevel')					
				);	
			
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if( ! $this->mdldata->insert($params))
				echo 'Error on updating some record.';
			else
				redirect(base_url("admin/panel/section/users"));
		}
		
	}
	private function _newuser() {
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		$data['superadmin'] = $this->_isSuperAdmin(); // for super admin only
		
		$data['main_content'] = 'admin/users/newuser_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _deleteuser() {
		$user_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$strQry = sprintf("UPDATE `user` SET `active`='0' WHERE us_id=%d", $user_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		
		if(! $this->mdldata->update($params))
			echo 'Deleting existing record failded.';
		
		redirect(base_url("admin/panel/section/users"));
		
	}
	
	private function _edituser() {
		
		$usr_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : (($this->input->post('usr_id')) ? $this->input->post('usr_id') : 0);
		
		$strQry = sprintf("SELECT * FROM `user` WHERE us_id=%d", $usr_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['users'] = $this->mdldata->_mRecords;
		$data['usr_id'] = $usr_id;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		$data['superadmin'] = $this->_isSuperAdmin(); // for super admin only
		
		$data['main_content'] = 'admin/users/edituser_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	public function validateedituser() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		
		$validation->set_rules('fname', 'First Name', 'required');
		$validation->set_rules('lname', 'Last Name', 'required');
		$validation->set_rules('uname', 'Username', 'required');
		$validation->set_rules('email', 'Email', 'required');
		$validation->set_rules('ulevel', 'Access Level', 'required');
		
		if($validation->run() === FALSE) {
			$this->_edituser();
		} else {
			$strQry  = sprintf("UPDATE `user` SET fname='%s', lname='%s', uname='%s', email='%s', ulevel='%s' WHERE us_id=%d", 
					$this->input->post('fname'),
					$this->input->post('lname'),
					$this->input->post('uname'),
					$this->input->post('email'),
					$this->input->post('ulevel'),					
					$this->input->post('usr_id')
				);
			
			$this->load->model('mdldata');
			$params['querystring']= $strQry;
			
			if(! $this->mdldata->insert($params))
				echo 'Error on updating some record.';
			else
				redirect(base_url("admin/panel/section/users"));
		}
		
	}
	
	private function _users() {
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/users");
		$config['total_rows'] = $this->db->query("SELECT us_id, uname, email, IF(ASCII(fname) !=0 AND ASCII(lname) !=0, CONCAT(fname, ' ', lname), 'no complete name provided') AS fullname FROM `user` WHERE active='1'")->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf("SELECT us_id, uname, email, IF(ASCII(fname) !=0 AND ASCII(lname) !=0, CONCAT(fname, ' ', lname), 'no complete name provided') AS fullname FROM `user`  WHERE active='1' LIMIT %d, %d",$this->uri->segment($config['uri_segment']), $config['per_page']);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['users'] = $this->mdldata->_mRecords;
				
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		$data['superadmin'] = $this->_isSuperAdmin(); // for super admin only
		
		$data['main_content'] = 'admin/users/users_view';
		$this->load->view('includes/admin/template', $data);
	}
	
	private function _editsection() {
		
		$sec_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : (($this->input->post('sec_id')) ? $this->input->post('sec_id') : 0);
		
		$strQry = sprintf("SELECT * FROM sections WHERE sec_id=%d", $sec_id);
		$this->load->model('mdldata');
		$params['querystring']  = $strQry;
		$this->mdldata->select($params);
		$data['sections'] = $this->mdldata->_mRecords;
		$data['sec_id'] = $sec_id;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/sections/editsection_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _newsection() {
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/sections/newsection_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _sections() {
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/sections");
		$config['total_rows'] = $this->db->query("SELECT * FROM sections WHERE `status`='1'")->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf("SELECT * FROM sections WHERE status='1' LIMIT %d, %d", $this->uri->segment($config['uri_segment']), $config['per_page']);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['sections'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/sections/sections_view';
		$this->load->view('includes/admin/template', $data);
	}
	
	private function _deleteproduct() {
		
		$prod_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$strQry = sprintf("UPDATE products SET `status`='0' WHERE prod_id=%d", $prod_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		
		if( ! $this->mdldata->update($params))
			echo 'Deleting existing record failed.';
		
		redirect("admin/panel/section/products");
		
	}
	public function validateeditproduct() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('product', 'Name', 'required');
		$validation->set_rules('price', 'Price', 'required|decimal');
		
		if($validation->run() === FALSE) {
			$this->_editproduct();
		} else {
			$strQry = sprintf("UPDATE products SET name='%s', price=%f WHERE prod_id=%d", $this->input->post('product'), $this->input->post('price'), $this->input->post('prod_id'));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if( ! $this->mdldata->update($params))
				echo 'Updating existing record failed';
			
			redirect("admin/panel/section/products");
		}
		
	}
	
	private function _editproduct() {
		
		$prod_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : (($this->input->post('prod_id')) ? $this->input->post('prod_id') : 0);
		
		$strQry = sprintf("SELECT * FROM products WHERE prod_id=%d", $prod_id);
		$this->load->model('mdldata');
		$params['querystring']  = $strQry;
		$this->mdldata->select($params);
		$data['products'] = $this->mdldata->_mRecords;
		$data['prod_id'] = $prod_id;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/products/editproduct_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	public function validatenewproduct() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('product', 'Product', 'required');
		$validation->set_rules('price', 'Price', 'required|decimal');
		
		if($validation->run() === FALSE) {
			$this->_newproduct();
		} else {
			$strQry =  sprintf("INSERT INTO products SET name='%s', price=%f", $this->input->post('product'), $this->input->post('price'));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if( ! $this->mdldata->insert($params))
				echo 'Insertin new record failed.'; //@mnc_todo: redirect to a descent error handler form
			
			redirect('admin/panel/section/products');
		}
		
	}
	
	private function _newproduct() {
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/products/newproduct_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _deletestate() {
		
		$state_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;		
		$strQry = sprintf("UPDATE state SET `status`='0' WHERE s_id=%d", $state_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		
		if(! $this->mdldata->update($params))
			echo 'Deleting existing record failed'; //mnc_todo: redirect this to a descent error handler form.
		
		redirect("admin/panel/section/states");
		
	}
	
	public function validatenewstate() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('code', 'Code', 'required');
		$validation->set_rules('state', 'State', 'required');
		
		if($validation->run() === FALSE) {
			$this->_newstate();
		} else {
			
			$strQry = sprintf("INSERT INTO state SET code='%s', name='%s'", $this->input->post('code'), $this->input->post('state'));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if(! $this->mdldata->insert($params))
				echo 'Inserting new record failed.';
			
			redirect(base_url("admin/panel/section/states"));
			
		}
		
	}
	
	public function validateeditstate() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('code', 'Code', 'required');
		$validation->set_rules('state', 'State', 'required');
		
		if($validation->run() === FALSE) {
			$this->_editstate();
		} else {
			
			$strQry = sprintf("UPDATE state SET code='%s', name='%s' WHERE s_id=%d", $this->input->post('code'), $this->input->post('state'), $this->input->post('state_id'));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if(! $this->mdldata->update($params))
				echo 'Editing record failed.'; // @mnc_todo: redirect to a descent error handler form
			else
				redirect('admin/panel/section/states');
		} 
		
	}
	
	private function _editstate() {
		
		$state_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : (($this->input->post('state_id')) ? $this->input->post('state_id'): 0);		
		$strQry = sprintf("SELECT * FROM state WHERE s_id=%d", $state_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['states'] = $this->mdldata->_mRecords;
		$data['state_id'] = $state_id;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/states/editstate_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _newstate() {
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/states/newstate_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _deletesubcategory() {
		
		$scateg_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$strQry = sprintf("UPDATE subcategories SET `status`='0' WHERE scat_id=%d", $scateg_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		if( !$this->mdldata->update($params))
			echo 'Deleting existing record failed.';
		
		redirect(base_url("admin/panel/section/subcategories"));
		
	}
	
	private function _editsubcategory() {
		
		$strQry = sprintf("SELECT * FROM maincategories WHERE `status`='1' ORDER BY category ASC");
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['mcategories'] = $this->mdldata->_mRecords;
		
		$scateg_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : (($this->input->post('subcateg_id')) ? $this->input->post('subcateg_id') : 0);
		
		
		$strQry = sprintf("SELECT * FROM subcategories WHERE scat_id=%d AND `status`='1'", $scateg_id);
		$params['querystring'] = $strQry;
		$this->mdldata->reset();
		$this->mdldata->select($params);
		$data['subcategories'] = $this->mdldata->_mRecords;
		$data['subcateg_id'] = $scateg_id;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/subcategories/editsubcategory_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	public function validateeditsubcategory() {
		 
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('maincategory', 'Main Category', 'required');
		$validation->set_rules('subcategory', 'Sub Category', 'required');
		
		if($validation->run() === FALSE) {
			$this->_editsubcategory();
		} else {
			$strQry = sprintf("UPDATE subcategories SET mcat_id=%d, sub_category='%s' WHERE scat_id=%d", $this->input->post('maincategory'), $this->input->post('subcategory'), $this->input->post('subcateg_id'));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if( ! $this->mdldata->update($params))
				echo 'Update existing record failed.';
			
			redirect("admin/panel/section/subcategories");
			
		}
		
	}
	
	public function validatenewsubcategory() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('maincategory', 'Main Category', 'required');
		$validation->set_rules('subcategory', 'Sub Category', 'required');
		
		if($validation->run() === FALSE) {
			$this->_newsubcategory();
		} else {			
			$strQry = sprintf("INSERT INTO subcategories SET sub_category='%s', mcat_id='%s'", $this->input->post('subcategory'), $this->input->post('maincategory'));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if(! $this->mdldata->insert($params))
				echo 'Inserting new record failed.';
			
			redirect(base_url('admin/panel/section/subcategories'));
			
		}
		
	}
	private function _newsubcategory() {
		
		$strQry = sprintf("SELECT * FROM maincategories WHERE `status`='1' ORDER BY category ASC");
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['mcategories'] = $this->mdldata->_mRecords; 
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/subcategories/newsubcategory_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	private function _deletecountry() {
		
		$country_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$strQry = sprintf("UPDATE country SET `status`='0' WHERE c_id=%d", $country_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		
		if(! $this->mdldata->update($params))
			echo 'Deleting existing record failded.';
		
		redirect(base_url("admin/panel/section/countries"));		
		
	}
	private function _editcountry() {
		
		$country_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : (($this->input->post('country_id')) ? $this->input->post('country_id') : 0);		
		$strQry = sprintf("SELECT * FROM country WHERE c_id=%d", $country_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['countries'] = $this->mdldata->_mRecords;
		$data['country_id'] = $country_id;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/countries/editcountry_view';
		$this->load->view("includes/admin/template", $data);
		
	}
	
	public function validateeditcountry() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('code', 'Code', 'required');
		$validation->set_rules('country', 'Country', 'required');
		
		if($validation->run() === FALSE) {
			$this->_editcountry();			
		} else {
			$strQry = sprintf("UPDATE country SET code='%s', name='%s' WHERE c_id=%d", $this->input->post('code'), $this->input->post('country'), $this->input->post('country_id'));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if( ! $this->mdldata->update($params))
				echo 'Update existing record failed.';
			
			redirect("admin/panel/section/countries");
			
		}
		
	}
	
	public function validatenewcountry() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('code', 'Code', 'required');
		$validation->set_rules('country', 'Country', 'required');
		
		if($validation->run() === FALSE) {
			$this->_newcountry();
		} else {
			$strQry = sprintf("INSERT INTO country SET code='%s', name='%s'", $this->input->post('code'), $this->input->post('country'));			
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if( ! $this->mdldata->insert($params))
				echo 'Inserting new record failed.';
			
			redirect(base_url("admin/panel/section/countries"));
		}
		
		
	}
	private function _newcountry() {
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/countries/newcountry_view';
		$this->load->view('includes/admin/template', $data);
		
		
	}
	
	private function _deletecategory() {
		
		$categ_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$strQry = sprintf("UPDATE maincategories SET `status`='0' WHERE mcat_id=%d", $categ_id);
		$params['querystring'] = $strQry;
		$this->load->model('mdldata');
		if(! $this->mdldata->update($params))
			echo 'Deleting existing record failed.';
		
		redirect(base_url("admin/panel/section/categories"));
		
	}
	
	private function _editcategory() {
		
		$categ_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : (($this->input->post('categ_id')) ? $this->input->post('categ_id') : 0);
		
		$strQry = sprintf("SELECT * FROM maincategories WHERE mcat_id=%d", $categ_id);
		$params['querystring'] = $strQry;
		$this->load->model('mdldata');
		$this->mdldata->select($params);
		$data['categories'] = $this->mdldata->_mRecords;
		$data['categ_id'] = $categ_id;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/categories/editcatogry_view';
		$this->load->view('includes/admin/template', $data);
	}
	
	public function validatenewsection() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('section', 'Name', 'required');
		
		if($validation->run() === FALSE) {
			$this->_newsection();
		} else {
			$strQry = sprintf("INSERT INTO sections SET name='%s'", $this->input->post('section'));
			
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if(! $this->mdldata->insert($params))
				echo 'Update existing record failed';
			
			redirect("admin/panel/section/sections");
			
		}
		
	}
	
	public function validateeditsection() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('section', 'Name', 'required');
		
		if($validation->run() === FALSE) {
			$this->_editsection();
		} else {
			$strQry = sprintf("UPDATE sections SET name='%s' WHERE sec_id=%d", $this->input->post('section'), $this->input->post('sec_id'));
			
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			if(! $this->mdldata->update($params))
				echo 'Update existing record failed';
			
			redirect("admin/panel/section/sections");
		}
	}
	
	public function validateeditcategory() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('category', 'Category', 'required');
		
		if($validation->run() === FALSE) {
			$this->_editcategory();
		} else {
			$strQry = sprintf("UPDATE maincategories SET category='%s' WHERE mcat_id=%d", $this->input->post('category'), $this->input->post('categ_id'));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			
			if( ! $this->mdldata->update($params))
				echo 'Updating existing record failed.';
			
			redirect("admin/panel/section/categories");
			
		}
		
	}
	
	public function validateeditarticle() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('articletitle', 'Title', 'required');
		$validation->set_rules('editor', 'Content', 'required');
		
		
		if($validation->run() === FALSE) {
			$this->_editarticle();
		} else {			
			$strQry = sprintf("UPDATE articles SET title='%s', article='%s', edited=NOW(), mkeywords='%s', mdescription='%s', section=%d WHERE arcle_id=%d", 
								mysql_escape_string($this->input->post('articletitle')),
								mysql_escape_string($this->input->post('editor')), 
								mysql_escape_string($this->input->post('keyword')), 
								mysql_escape_string($this->input->post('description')), 
								mysql_escape_string($this->input->post('section')),
					 			mysql_escape_string($this->input->post("arcle_id")));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			if( ! $this->mdldata->update($params))
				echo 'Update existing record failed.';
			
			redirect("admin/panel/section/allarticles");
		}
		
	}
	
	public function validatenewarticle() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		
// 		call_debug($_POST);
		$validation->set_rules('articletitle', 'Title', 'required');
		$validation->set_rules('editor', 'Content', 'required');
	
		if($validation->run() === FALSE) {
			$this->_newarticle();
		} else {
			$strQry = sprintf("INSERT INTO articles SET title='%s', article='%s', created=NOW(), mkeywords='%s', mdescription='%s', section=%d", mysql_escape_string($this->input->post('articletitle')), mysql_escape_string($this->input->post('editor')), mysql_escape_string($this->input->post('keyword')), mysql_escape_string($this->input->post('description')), mysql_escape_string($this->input->post('section')));
			
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			if( ! $this->mdldata->insert($params))
				echo 'Inserting new record failed';
			
			redirect("admin/panel/section/allarticles");
		}
		
	}
	
	public function validatenewcategory() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		// sets rules
		$validation->set_rules('category', 'Category', 'required');
		
		if($validation->run() === FALSE) {
			$this->_newcategory();			
		} else {
			$strQry = sprintf("INSERT INTO maincategories SET category='%s'", $this->input->post('category'));
			$this->load->model('mdldata');
			$params['querystring'] = $strQry;
			if(! $this->mdldata->insert($params))
				echo 'Inserting new record failed';
			redirect(base_url("admin/panel/section/categories"));
		}
				
	}
	
	private function _newcategory() {
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/categories/category_new_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _countries() {
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/countries");
		$config['total_rows'] = $this->db->query("SELECT * FROM country WHERE name NOT LIKE '%UNKNOWN%' AND `status`='1' ")->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf("SELECT * FROM country WHERE name NOT LIKE '%s' AND `status`='1' ORDER BY name LIMIT %d, %d", "%UNKNOWN%",$this->uri->segment($config['uri_segment']), $config['per_page']);
// 		call_debug($strQry);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['countries'] = $this->mdldata->_mRecords;		
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/countries/countries_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _states() {
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/states");
		$config['total_rows'] = $this->db->query("SELECT * FROM state WHERE name NOT LIKE '%UNKNOWN%' AND `status`='1'")->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf("SELECT * FROM state WHERE `status`='1' ORDER BY name LIMIT %d, %d",$this->uri->segment($config['uri_segment']) , $config['per_page']);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['states'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/states/states_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _listings() {
		
		$this->db->query("CALL sp_admin_listing");
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/listings");
		$config['total_rows'] = $this->db->query("SELECT * FROM tmpadminlistingtbl")->num_rows();
		$config['per_page'] = 3;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf("SELECT * FROM tmpadminlistingtbl ORDER BY expired DESC LIMIT %d, %d", $this->uri->segment($config['uri_segment']), $config['per_page']);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['listings'] = $this->mdldata->_mRecords;

		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/listings/listings_view';
		$this->load->view('includes/admin/template', $data);
	}
	
	private function _products() {
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/products");
		$config['total_rows'] = $this->db->query("SELECT * FROM products WHERE `status`='1'")->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf("SELECT * FROM products WHERE `status`='1' LIMIT %d, %d",$this->uri->segment($config['uri_segment']) , $config['per_page']);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['products'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/products/products_view';
		$this->load->view('includes/admin/template', $data);
	}
	
	private function _subcategories() {
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/subcategories");
		$config['total_rows'] = $this->db->query("SELECT * FROM subcategories WHERE sub_category NOT LIKE '%UNKNOWN%' AND `status`='1'")->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf('SELECT s.scat_id, s.sub_category, m.category FROM subcategories s LEFT JOIN maincategories m ON s.mcat_id=m.mcat_id WHERE sub_category NOT LIKE "%s" AND s.`status`="1" ORDER BY sub_category ASC LIMIT %d, %d', '%UNKNOWN%', $this->uri->segment($config['uri_segment']), $config['per_page']);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['subcategories'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/subcategories/subcategories_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _categories() {
		on_watch('>>> ' . $this->session->userdata('ADVR_USERNAME'));
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/categories");
		$config['total_rows'] = $this->db->query("SELECT * FROM maincategories WHERE category NOT LIKE '%UNKNOWN%' AND `status`='1'")->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf('SELECT * FROM maincategories WHERE category NOT LIKE "%s" AND `status`="1" ORDER BY category LIMIT %d, %d', '%UNKNOWN%', $this->uri->segment($config['uri_segment']), $config['per_page']);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['categories'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/categories/categories_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _advertisers() {		
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/advertisers");
		$config['total_rows'] = $this->db->query("SELECT * FROM advertiser")->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf('SELECT a.ad_id, CONCAT(a.fname, " ", a.lname) AS `fullname`, CONCAT(a.address, ", ", a.suburb, ", ", a.postcode, ", ", s.name, ", ", c.name) AS `address`, IF(ASCII(IF(ASCII(a.phone) <> 0, a.phone, a.phone2)) <> 0, IF(ASCII(a.phone) <> 0, a.phone, a.phone2), "phone not provided") AS `phone`, IF(STRCMP(a.status, "1") <> 0, "Activate", "Deactivate") as `status`  FROM ((advertiser a LEFT JOIN state s ON a.state=s_id) LEFT JOIN country c ON a.country=c.c_id) ORDER BY lname, fname LIMIT %d, %d', $this->uri->segment($config['uri_segment']), $config['per_page']);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['advertisers'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/masterfiles/advertisers/advertisers_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _editarticle() {
		
		$arcle_id = ($this->uri->segment(5)) ? $this->uri->segment(5) : (($this->input->post('arcle_id')) ? $this->input->post('arcle_id') : 0);
		
		$strQry = sprintf("SELECT * FROM articles WHERE arcle_id=%d", $arcle_id);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['articles'] = $this->mdldata->_mRecords;
		$data['arcle_id'] = $arcle_id;
		
		$strQry = sprintf("SELECT * FROM sections");
		$params['querystring'] = $strQry;
		$this->mdldata->reset();
		$this->mdldata->select($params);
		$data['sections'] = $this->mdldata->_mRecords;
		

		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/articles/editarticle_view';
		$this->load->view('includes/admin/template', $data);
	}
	
	private function _allarticles() {
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url("admin/panel/section/allarticles");
		$config['total_rows'] = $this->db->query("SELECT * FROM articles")->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		$config = array_merge($config, $this->_mConfig);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$strQry = sprintf("SELECT * FROM articles LIMIT %d, %d", $this->uri->segment($config['uri_segment']), $config['per_page']);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['articles'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/articles/articles_view';
		$this->load->view('includes/admin/template', $data);
		
	}
	
	private function _newarticle() {
		
		$strQry = sprintf("SELECT * FROM sections WHERE `status`='1'");
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['sections'] = $this->mdldata->_mRecords;
		
		$data['advertisersCount'] = $this->_getOLAdvertiser();
		$data['webAdminCount'] = $this->_getWebAdmin();
		
		$data['main_content'] = 'admin/articles/addnew_articles_view';
		$this->load->view('includes/admin/template', $data);
	}
	
	
	private function _getOLAdvertiser() {
		
		$strQry = sprintf("SELECT COUNT(username) AS `advertiserCount` FROM advertiser WHERE loggedin='1'");
		$this->load->model('mdldata');
		$params["querystring"] = $strQry;
		$this->mdldata->select($params);
		$record = $this->mdldata->_mRecords;

		if($record)
			return $record[0]->advertiserCount;		
		
	}
	
	private function _getWebAdmin() {
		
		$strQry = sprintf("SELECT COUNT(uname) AS `webAdminCount` FROM `user` WHERE loggedin='1'");
		$this->load->model('mdldata');
		$params["querystring"] = $strQry;
		$this->mdldata->select($params);
		$record = $this->mdldata->_mRecords;

		if($record)
			return $record[0]->webAdminCount;		
		
	}
	
	
	private function _isSuperAdmin() {
		
		$params = array('admin_uname');
 		$this->sessionbrowser->getInfo($params);
 		$arr = $this->sessionbrowser->mData;
		
 		$strQry = sprintf("SELECT ulevel FROM `user` WHERE uname='%s'", $arr['admin_uname']);
		$this->load->model('mdldata');
		$params["querystring"] = $strQry;
		$this->mdldata->select($params);
		
		if($this->mdldata->_mRecords[0]->ulevel == '1')
			return FALSE;
			
		return TRUE;
	}
	
}
