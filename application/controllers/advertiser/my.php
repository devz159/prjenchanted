<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My extends CI_Controller {
	private $_mUserName;
	private $_mFullName;
	private $_mRowCount;
	
	public function __construct() {
		parent::__construct();
		
		// initializes some member variables
		$this->_mUserName = null;
		$this->_mFullName = null;
		$this->_mRowCount;
	}
	
	public function index() {
		$this->_profile();
	}
		
	public function section() {
		
		$section = ($this->uri->segment(4) !='') ? $this->uri->segment(4) : '';
		$id = $this->uri->segment(5);
		
		switch ($section) {
			case 'profile':
				$this->_profile();
				break;
				
			case 'change_password':
				$this->_change_password();
				break;
				
			case 'active_list';
				$this->_active_list();
				break;
				
			case 'expired_list':
				$this->_expired_list();
				break;
				
			case 'payment':
				$this->_payment();
				break;
				
			case 'edit_list':
				$this->_edit_list($id);
				
			default:
				
		}
				
	}
	
	private function _delete_listing($id) {
		// validates user
		authUser();
		
		$strQry = sprintf("UPDATE listing SET expired='%s', status='%s' WHERE lst_id=%d", '1', '2', $id);
		
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		
		if(! $this->mdldata->update($params))
			return FALSE;
		
		return TRUE;
	}
	
	public function delete_listing() {
		
		$id = $this->input->post('id');
		
		if($this->_delete_listing($id)) {
			$data['listings'] = $this->_getUserListings();
			$data['rowcount'] = $this->_mRowCount;
			$this->load->view('ajax/ajxadvertiser_active_listing', $data);
		} else { 
			echo 'false';
		}
		
	}
		
	
	public function signout() {
		$this->_signout();
	}
	
	private function _signout() {
		redirect(base_url() . 'login/my_signout');
				
	}
		
	private function _profile() {
		
		// validates user
		authUser();
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$data['userprofile'] = $this->_getUserProfile();
		$data['states'] = $this->_loadState();
		$data['countries'] = $this->_loadCountry();
		
		$data['main_content'] = 'advertiser/profile/profile_view';
		$this->load->view('includes/advertiser/template', $data);
		
	}
	
	private function _change_password($result = '') {
		
		// validates user
		authUser();
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$data['result'] = $result;
		$data['main_content'] = 'advertiser/profile/change_pasword_view';
		$this->load->view('includes/advertiser/template', $data);
	}
	
	private function _edit_list($id) {
				
		$params['querystring'] = sprintf("SELECT * FROM listing WHERE lst_id=%d", $id); 
		$this->load->model('mdldata');
		$this->mdldata->select($params);
		
		// validates user
		authUser();
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$data['listing'] = $this->mdldata->_mRecords;
		$data['mcategories'] = $this->_mcategories();
		$data['scategories'] = $this->_scategories();
		$data['states'] = $this->_loadState();
		$data['countries'] = $this->_loadCountry();
		
		if($this->mdldata->_mRowCount > 0) {
			$categories = $data['listing'][0]->subcategory;
			
			if($categories != ''){
				$categories = preg_split('/,/', $categories);
				$output = 'SELECT * FROM subcategories s WHERE';
				foreach($categories as $c) {
					$output .= sprintf(" scat_id=%d or ", $c);
				}
				preg_match('/[\w\W]+(?=\sor)/', $output, $matches);
				$output = trim($matches[0]);
				
				$params['querystring'] = $output;			
				$this->mdldata->reset();
				$this->mdldata->select($params);
				
				$data['listingcategories'] = $this->mdldata->_mRecords;
			}
			
			
			$images = $data['listing'][0]->images;
			
			if($images != '') {
				$images = preg_split('/,/', $images);
				$data['images'] = $images;
			}

		}
		// check the selected listing if exists. redirect otherwise to the active list
				
		$data['main_content'] = 'advertiser/listing/listing_edit_view';
		$this->load->view('includes/advertiser/template', $data);
		
	}
	
	
	private function _active_list() {
		
		// validates user
		authUser();
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$data['listings'] = $this->_getUserListings();
		$data['rowcount'] = $this->_mRowCount;
		
		$data['main_content'] = 'advertiser/listing/my_listing_view';
		$this->load->view('includes/advertiser/template', $data);
		
		return TRUE;
	}
	
	private function _expired_list() {
		
		// validates user
		authUser();
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$data['listings'] = $this->_getUserListings(FALSE);
		$data['rowcount'] = $this->_mRowCount;
		
		$data['main_content'] = 'advertiser/listing/expired_listing_view';
		$this->load->view('includes/advertiser/template', $data);
	}
	
	private function _payment() {

		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$data['tabmenu'] = ($this->uri->segment(4) !='') ? $this->uri->segment(4) : '';

		$strQry = sprintf("CALL sp_payment_history()");
		$this->db->query($strQry);
		
		$params['querystring'] = sprintf("SELECT t.id, t.itemnumber, t.lst_id, t.advr, t.email, t.amount, t.`status`, t.paypal_trans_id, t.created_at, l.title FROM tmp_payment_history_tbl t LEFT JOIN listing l ON t.lst_id=l.lst_id WHERE t.advr=%d", $this->_getUserID());
		$this->load->model('mdldata');
		$this->mdldata->select($params);
		$data['payments'] = $this->mdldata->_mRecords;
		$data['rowcount'] = $this->mdldata->_mRowCount;
		
		$data['main_content'] = 'advertiser/payment/payment_view';
		$this->load->view('includes/advertiser/template', $data);
	}
	
	/*
	public function index() {
		// sentinel
		authUser();
		
		$this->profile();
		
	}
	*/
	public function profile() {
		// sentinel 
		authUser();
		
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$data['userprofile'] = $this->_getUserProfile();
		$data['states'] = $this->_loadState();
		$data['countries'] = $this->_loadCountry();
		
		$data['main_content'] = 'advertiser/my/my_profile_view';
		$this->load->view('includes/advertiser/template', $data);
			
	}
	
	public function listing() {
		// sentinel 
		authUser();
		
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$data['listings'] = $this->_getUserListings();
		$data['rowcount'] = $this->_mRowCount;		
		$data['main_content'] = 'advertiser/my/my_listing_view';
		$this->load->view('includes/advertiser/template', $data);
	}
	
	public function validate_change_password() {
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('oldpword', 'Old Password', 'required');
		$validation->set_rules('newpword', 'New Password', 'required');
		$validation->set_rules('newpword2', 'Confirm New Password', 'required|matches[newpword]');
		
		if($validation->run() === FALSE) {
			$this->_change_password();
		} else {
			if($this->_changePasswordToDB())
				$this->_change_password('You have successfully changed your password.');
			else
				$this->_change_password('<span class="failed">Change password failed. Please try later.</span>');
			// reloads same form
		}
		
	}
	
	public function validate_edit() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('title', 'Business Title', 'required');
		$validation->set_rules('suburb', 'Suburb', 'required');
		$validation->set_rules('postcode', 'Postcode', 'required');
		$validation->set_rules('state', 'State', 'required');
		$validation->set_rules('country', 'Country', 'required');
		$validation->set_rules('phone', 'Phone', 'required');
		$validation->set_rules('email', 'Email', 'required|valid_email');

		
		if($validation->run() === FALSE) {
			$this->_edit_list($this->input->post('id'));
		} else {
			// adds to db
// 			call_debug($_POST, FALSE);
			if($this->_updateEditedListingToDB()) {
				redirect(base_url() . 'advertiser/my/section/edit_list/' . $this->input->post('id'));
			}
				
			
			// redirects			
		}
		
	}
	
	public function validate_profile() {
		
		// sentinel
		authUser();
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('fname', 'First Name', 'required');
		$validation->set_rules('lname', 'Last Name', 'required');
		$validation->set_rules('address', 'Address', 'required');
		$validation->set_rules('suburb', 'Suburb', 'required');
		$validation->set_rules('postcode', 'Postcode', 'required');
		$validation->set_rules('state', 'State', 'required');
		$validation->set_rules('country', 'Country', 'required');
		$validation->set_rules('phone', 'Phone Number (Primary)', 'required');
		$validation->set_rules('phone2', 'Phone Number (Secondary)');
		$validation->set_rules('email', 'Email', 'required|valid_email');
		$validation->set_rules('username', 'Username', 'required');
		$validation->set_rules('url', 'Website');
		
		if($validation->run() === FALSE) {
			$this->_profile();
		} else {
			if($this->_updateProfileInfoToDB())
				$this->index();
			else
				echo 'update failed';
		}
		
	}
	
	/*
	 * Utility methods
	 */
	
	private function _getUser() {
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');
 		$this->sessionbrowser->getInfo($params);
 		
 		$arr = $this->sessionbrowser->mData;
 		
 		$this->_mUserName = $arr['advr_uname'];
 		$this->_mFullName = $arr['advr_fullname'];
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
	
	private function _getUserProfile() {
		$this->_getUser();
		
		$params = array(
						'table' => array(
									'name' => 'advertiser',
									'criteria' => 'username',
									'criteria_value' => $this->_mUserName
								)
					);
		
		$this->load->model('mdldata');
		$this->mdldata->select($params);
		
		return $this->mdldata->_mRecords;
		
	}
	
	private function _updateEditedListingToDB() {

		// preps some data
		$curImages = (isset($_POST['curimages'])) ? $_POST['curimages'] : array();
		$delImages = (isset($_POST['delete'])) ? $_POST['delete'] : array();
		$subcategories = (isset($_POST['subcategory'])) ?  implode(',', $_POST['subcategory']) : '';
		$curdate = date('Y-m-d m:i:s');
		
		// process images
		if(count($curImages) > 0) {
			if(count($delImages) > 0) {
				$curImages = array_diff($curImages, $delImages);				
			}
		}
		
		$uploadimgs = (count($_POST['file_uploader_images']) > 0) ? explode(',', $_POST['file_uploader_images']) :  array();
		
		// merges both arrays
		$uploadimgs = array_merge($uploadimgs, $curImages);
		$tmpArr = array();
		foreach($uploadimgs as $upimg) {
			if($upimg !='')
				$tmpArr[] = $upimg;
		}

		$uploadimgs = $tmpArr;		
		$uploadimgs = implode(',', $uploadimgs);
 
		$strQry = sprintf("UPDATE listing SET 
							title='%s', 
							subcategory='%s', 
							images='%s', 
							advr=%d, 
							ledited='%s',
							description='%s', 
							address='%s', 
							suburb='%s',
				 			postcode='%s', 
							state=%d, 
							country=%d,
							phone='%s',
							phone2='%s',
							email='%s',
							url='%s' 
							WHERE lst_id=%d",
							$this->input->post('title'),
							$subcategories,
							$uploadimgs,
							$this->input->post('advr'),
							$curdate,
							mysql_real_escape_string($this->input->post('editor')),
							$this->input->post('street'),
							$this->input->post('suburb'),
							$this->input->post('postcode'),
							$this->input->post('state'),
							$this->input->post('country'),
							$this->input->post('phone'),
							$this->input->post('phone2'),
							$this->input->post('email'),
							$this->input->post('url'),
							$this->input->post('id')
						);
		
		$params['querystring'] = $strQry;
		$this->load->model('mdldata');		
		
		if(! $this->mdldata->update($params))	
			return FALSE;
		
		// delete images from the fs
		
		if($uploadimgs != '') {
			// transfer uploaded images from 'uploaded' folder into 'ads' folder
			// $this->imagemanager->manage($array, $source, $destination);
			$this->load->library('imagemanager');
						
			$this->imagemanager->manage($uploadimgs, './uploaded/', './ads/' . $this->_getUserID() . '/');
		}
		
		if(count($delImages) > 0) {			
			$delImages = implode(",", $delImages);
			$this->load->library('imagemanager');
			
			$this->imagemanager->deleteImages($delImages, './ads/' . $this->_getUserID() . '/');
		}
		
		return TRUE;		
	}
	

	private function _updateProfileInfoToDB() {
		$this->load->model('mdldata');
		
		$params = array(
					'table' => array('name' => 'advertiser',
									'criteria' => 'ad_id',
									'criteria_value' => $this->_getUserID()
							),
					'fields' => array(
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
								'website' => $this->input->post('url'),
								'username' => $this->input->post('username')														
							)
				);
		
		if(! $this->mdldata->update($params))
			return FALSE;
		
		return TRUE;		
	}
	
	private function _changePasswordToDB() {
			
		$userid = $this->_getUserID();
		
		// retrieves the current password in a hash form
		$strQry = sprintf("SELECT password FROM advertiser WHERE ad_id=%d AND password='%s'", $userid, md5($this->input->post('oldpword')));
		
		if($this->db->query($strQry)->num_rows() == 0)
			return FALSE;
		
		// updates the new password
		$strQry = sprintf("UPDATE advertiser SET password='%s' WHERE ad_id=%d", md5($this->input->post('newpword')), $userid);
		
		if(! $this->db->query($strQry))
			return FALSE;
		
		return TRUE;
		
	}
		
	private function _getUserID() {
		$useid = 0; // sets to default
	
		$this->load->library('sessionbrowser');
	
		$params = array('advr_uname');
	
		$this->sessionbrowser->getInfo($params);
			
		$this->load->model('mdldata');
		
		$params['querystring'] = "SELECT ad_id FROM advertiser WHERE username='" . trim($this->sessionbrowser->mData['advr_uname']) . "'";
			
		if($this->mdldata->select($params)):
		foreach($this->mdldata->_mRecords as $rec):
		$useid = $rec->ad_id;
		endforeach;
		endif;
	
		return intval($useid);
	}
	
	private function _getUserListings($active=TRUE) {
		
		if($active)
			$params['querystring'] = sprintf("SELECT lst_id, advr, title, pgviews, pclicks, uclicks, url, enq, status, package FROM listing WHERE advr=%d AND expired='0' AND (status='1' OR status='0')", $this->_getUserID());
		else
			$params['querystring'] = sprintf("SELECT lst_id, advr, title, pgviews, pclicks, uclicks, url, enq, status FROM listing WHERE advr=%d AND status='2' AND expired='1'", $this->_getUserID());
		
		$this->load->model('mdldata');
		$this->mdldata->select($params);
		
		$this->_mRowCount = $this->mdldata->_mRowCount;
		return $this->mdldata->_mRecords;
		
	}
	
	private function _mcategories () {
		$strQry = sprintf("SELECT * FROM maincategories");
		$params['querystring'] = $strQry;
		$this->load->model('mdldata');

		$this->mdldata->select($params);
		
		return $this->mdldata->_mRecords;
		
	}
	
	private function _scategories() {
		$strQry = sprintf("SELECT * FROM subcategories");
		$params['querystring'] = $strQry;
		$this->load->model('mdldata');
		
		$this->mdldata->select($params);
		
		return $this->mdldata->_mRecords;
	}
	
	
}
