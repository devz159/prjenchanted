<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listing extends CI_Controller {
	
	private $_mFullName;
	private $_mUserName;
	private $_mMyLoginError;
	
	public function __construct() {
		parent::__construct();

		// initializes some member variables
		$this->_mFullName;
		$this->_mUserName = '';
		$this->_mMyLoginError = null;
		$this->load->library('favlist');		
		$this->load->library('settings');
		
		fb::setEnabled(TRUE);
	}
	 
	 public function index() {
	 	
	 	// gets the currently logged in user
	 	$this->_getUser();	 	
	 	$data['user'] = $this->_mFullName;	 	
		$data['states'] = $this->_loadState();		
		$data['countries'] = $this->_loadCountry();
				
		$this->load->library('cart');
		$this->cart->show(); // @mnctodo: this line wasn't here after 20120921
		$data['cart'] = ($this->cart->_mData); 

		//call_debug($data['cart']);
		$data['sbsettings'] = $this->settings->readSideBar();		 
		$data['main_content'] = 'directory/listing/listing_one_view';
		$this->load->view('includes/directory/template_b', $data);
		
	} 
	 

	public function validate_listing_one() {
		$this->load->library('form_validation');
		
		$validation = $this->form_validation;
		
		$validation->set_rules('bname', 'Business Name', 'required');
		$validation->set_rules('address', 'Address');
		$validation->set_rules('suburb', 'Surburb/Town', 'required');
		$validation->set_rules('postcode', 'Postcode', 'required');
		$validation->set_rules('state', 'State', 'required');
		$validation->set_rules('country', 'Country', 'required');
		
		if($validation->run() === FALSE ) {
			$this->index();
		} else {
			// stores values in session
			$params = array(
								'adTitle' => $this->input->post('bname'),
								'adStreetAddress' => $this->input->post('address'),
								'adSuburb' => $this->input->post('suburb'),
								'adPostcode' => $this->input->post('postcode'),
								'adState' => $this->input->post('state'),
								'adCountry' => $this->input->post('country')
							);
			
			$this->load->library('cart');
			
			if(!$this->cart->insert($params)) exit('Error appending values into session variables.');
			
			// proceeds to next form
			$this->_loadListingTwo();
			
		}
		
		
	}
	
	public function validate_listing_two() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('phone1', 'Phone Number (Primary)', 'required');
		$validation->set_rules('phone2', 'Phone Number (Secondary)');
		$validation->set_rules('email', 'Email', 'required|valid_email');
		$validation->set_rules('website', 'Website');
		
		if($validation->run() === FALSE) {
			$this->_loadListingTwo();
			
		} else {
			
			// preps some data
			$tmpurl = $this->_prepURL($this->input->post('website'));
			
			// stores values in session
			$params = array(
					'adPhone1' => $this->input->post('phone1'),
					'adPhone2' => $this->input->post('phone2'),
					'adEmail' => $this->input->post('email'),
					'adUrl' => $tmpurl
			);
				
			$this->load->library('cart');

			if(!$this->cart->insert($params)) exit('Error appending values into session variables.');
			
			// proceeds to the next form
			$this->_loadListtingThree();
		}		
		
	}
	
	public function validate_listing_three() {
		$category = '';
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('editor','Description', 'required'); 
		
		if(isset($_POST['subcategory'])):
			$category = implode(",", $_POST['subcategory']);
			/* foreach($_POST['subcategory'] as $c):
				//echo "$c <br />";
			endforeach; */
		endif;
					
		if($validation->run() === FALSE) {
			$this->_loadListtingThree();
		} else {			
			// stores values in session
			$params = array(
					'adDescription' => $this->input->post('editor'),
					'adCategories' => $category
			);
				
			$this->load->library('cart');

			if(!$this->cart->insert($params)) exit('Error appending values into session variables.');
			$this->_loadListingFour();
		}
		
	}
	
	public function validate_listing_four() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('file_uploader_images', 'Images', 'required');
		
		
		if($validation->run() === FALSE) {
			$this->_loadListingFour();
		} else {
			// stores values in session
			$params = array(
					'adImages' => $this->input->post('file_uploader_images')
			);
			
			$this->load->library('cart');
			
			if(!$this->cart->insert($params)) exit('Error appending values into session variables.');
			
			$this->checkIfSignedUp();
		}
		
	}
	
	public function validate_listing_five() {
		// sentinel
		authUser();
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		if(isset($_POST['paypalaccnt'])) { // premium package -- selected			
			$validation->set_rules('paypalaccnt', 'Paypal Account', 'required');
			
			if($validation->run() === FALSE) {
				$this->_loadListingFive();
			} else {
				// stores values in session
				$params = array(
						'adPackageType' => $this->input->post('listingtype'),
						'adRecurrentType' => $this->input->post('recurrentpay'),
						'adPaypal' => $this->input->post('paypalaccnt')
				);
				
				$this->load->library('cart');
				
				if(!$this->cart->insert($params)) exit('Error appending values into session variables.');

				// add listing to db and send email receipt/confirmation
				if($this->_addListingToDB()) {
					// call custom email helper/library
					$this->cart->show();				

					// transfer uploaded images from 'uploaded' folder into 'ads' folder
					// $this->imagemanager->manage($array, $source, $destination);
					$this->load->library('imagemanager');
					
					$cart = $this->cart->_mData;
					
					$this->imagemanager->manage($cart['adImages'], './uploaded/', './ads/' . $this->_getUserID() . '/');
					
					// redirect to the form that displays the summary
					// copy the $cart object variable
					$this->_new_pay_paypal();					
				}
				
// 				redirect(base_url() . 'advertiser/my');
			}
		} else { // standard package -- selected
			// stores values in session
			$params = array(
					'adPackageType' => $this->input->post('listingtype'),
					'adRecurrentType' => '',
					'adPaypal' => ''
			);
									
			$this->load->library('cart');
			
			if(!$this->cart->insert($params)) exit('Error appending values into session variables.');
			
			if($this->_addListingToDB(FALSE)) { // returns TRUE if successfull, FALSE otherwise
				// call custom email helper/library
				$this->cart->show();
				
				$this->_sendListingEmail($this->cart->_mData);
				//call_debug($params);
				// transfer uploaded images from 'uploaded' folder into 'ads' folder
				// $this->imagemanager->manage($array, $source, $destination);
				$this->load->library('imagemanager');
					
				$cart = $this->cart->_mData;
					
				$this->imagemanager->manage($cart['adImages'], './uploaded/', './ads/' . $this->_getUserID() . '/');
				
			}
			

			
			// destroys all variables from the cart
			$this->cart->end();
			
			redirect(base_url('advertiser/my/section/active_list'));
		}
		
	}
	
	public function validate_repost() {
		// sentinel
		authUser();
		
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		if(isset($_POST['paypalaccnt'])) { // premium package -- selected
			$validation->set_rules('paypalaccnt', 'Paypal Account', 'required');
			
			if($validation->run() === FALSE) {
				$this->_upgrade_repost($this->input->post('lst_id'), $this->input->post('advr'));
			} else {
				// update listing using lst_id from inactive to pending				
				$strQry = sprintf("UPDATE listing SET status='0', package='1', expired='0' WHERE lst_id=%d", $this->input->post('lst_id'));
				$this->load->model('mdldata');
				$params['querystring'] = $strQry;
				if($this->mdldata->insert($params))
					$this->_pay_paypal();
			}			
		} else { // standard package -- selected
			$this->_reposted_free_listing();			
		}
				
	}
	
	public function validate_login() {
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		
		$validation->set_rules('username', 'Username', 'required');
		$validation->set_rules('pword', 'Password', 'required');
		
		if($validation->run() === FALSE) {
			$this->checkIfSignedUp();
		} else {
			
			if($this->_isUserExists()) { // user existed and validated
				if($this->_cartIsEmpty()) // redirects to the first process if the cart is empty
					redirect(base_url() . 'directory/listing');
				
				$this->_setSession(FALSE);
				$this->_loadListingFive();
			} else {
				$this->_mMyLoginError = TRUE; // raises error, so the login form will display a error message
				$this->checkIfSignedUp();
			}
			
		}
	}
	
	public function validate_registration() {				
		$this->load->library('form_validation');
		
		$validation = $this->form_validation;
		
		$validation->set_rules('uname', 'Username', 'required|callback_username_check');
		$validation->set_rules('pword','Password', 'required');
		$validation->set_rules('pword2', 'Confirm Password', 'matches[pword]');
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
			$this->_loadSignup();
		} else {
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
					'website' => $this->input->post('website'),
					'username' => $this->input->post('uname'),
					'password' => md5($this->input->post('pword'))
			);
				
			if($this->mdldata->insert($params)) {
				// assigns user info into sessionbrowser
				$this->_setSession();
				$this->_loadListingFive();				
			} else {
				echo 'Inserting record failed.'; // @todo: back to the $this->_loadSignup();
			}				
		}
		
	}

	public function upgrade() {
		
		$this->_upgrade_repost();
		
	}
	
	public function repost() {
		
		$lst_id = ($this->uri->segment(4) != "") ? $this->uri->segment(4) : '';
		$advr = ($this->uri->segment(5) != "") ? $this->uri->segment(5) : '';
		
		$this->_upgrade_repost($lst_id, $advr);
		return TRUE;
	}
	
	private function _new_pay_paypal() {
		$this->load->library('cart');
		$this->cart->show();
		$cart = $this->cart->_mData;
		
		$data['payer_email'] = $cart['adPaypal'];
		$data['item_name'] = $cart['adRecurrentType'];
		$data['advr'] = $this->_getUserID();
		$data['title'] = $cart['adTitle'];
		
		// gets the lst_id
		$strQry = "SELECT * FROM tmplast_id";
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$data['lst_id'] = ($this->mdldata->_mRecords[0]->lstid) ? $this->mdldata->_mRecords[0]->lstid : 0;
		
		// gets the price of the premium
		$strQry = sprintf("SELECT * FROM products WHERE name='%s'", trim($data['item_name']));
		$params['querystring'] = $strQry;
		$this->mdldata->reset();
		$this->mdldata->select($params);
		$data['amount'] = ($this->mdldata->_mRecords[0]->price) ? $this->mdldata->_mRecords[0]->price : 0;
		$data['qty'] = 1;
		
		// destroys all variables from the cart
		//$this->cart->end();
		
		$data['main_content'] = 'directory/listing/listing_new_paypal';
		$this->load->view('includes/directory/template_b', $data);
	}
	
	private function _reposted_free_listing() {		
		$item_number = $this->input->post('lst_id');
		$advr = $this->input->post('advr');
		$item_name = $this->input->post('listingtype');
		$amount = 0;
		$qty = 1;
		
		$strQry = sprintf("SELECT * FROM products WHERE name='%s'", trim($item_name));
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$amount = $this->mdldata->_mRecords[0]->price;
				
		$data['item_number'] = $item_number;
		$data['advr'] = $advr;
		$data['item_name'] = $item_name;
		$data['amount'] = $amount;
		$data['qty'] = $qty;
		
		$strQry = sprintf("SELECT * FROM listing WHERE lst_id='%s'", $item_number);
		$params['querystring'] = $strQry;
		$this->mdldata->reset();
		$this->mdldata->select($params);
		$data['listing'] = $this->mdldata->_mRecords;
		
		// update listing using lst_id from inactive to active
		// update listing using lst_id from inactive to pending
		$strQry = sprintf("UPDATE listing SET status='1', expired='0' WHERE lst_id=%d", $this->input->post('lst_id'));
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->reset();
		$this->mdldata->insert($params);
		//redirect(base_url() . 'advertiser/my');
		
		$data['main_content'] = 'directory/listing/listing_repost_free';
		$this->load->view('includes/directory/template_b', $data);
	}
	
	private function _pay_paypal() {
		
		$payer_email = $this->input->post('paypalaccnt');
		$item_number = $this->input->post('lst_id');
		$advr = $this->input->post('advr');
		$item_name = $this->input->post('recurrentpay');		
		$amount = 0;
		$qty = 1;
		
		$strQry = sprintf("SELECT * FROM products WHERE name='%s'", trim($item_name));
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$amount = $this->mdldata->_mRecords[0]->price;
		
		$data['payer_email'] = $payer_email;
		$data['item_number'] = $item_number;
		$data['advr'] = $advr;
		$data['item_name'] = $item_name;
		$data['amount'] = $amount;
		$data['qty'] = $qty;
		
		$strQry = sprintf("SELECT * FROM listing WHERE lst_id='%s'", $item_number);
		$params['querystring'] = $strQry;
		$this->mdldata->reset();
		$this->mdldata->select($params);		
		$data['listing'] = $this->mdldata->_mRecords;
			
		$data['main_content'] = 'directory/listing/listing_repost_paypal';
		$this->load->view('includes/directory/template_b', $data);
		
	}
	
	private function _upgrade_repost($lst_id, $advr) {
			
		$data['list_id'] = $lst_id;		
		$data['advr'] = $advr;
		
		$data['main_content'] = 'directory/listing/listing_repost_upgrade_view';
		
		$this->load->view('includes/directory/template_b', $data);
		return TRUE;
		
	}
	
		
	public function details() {
		
		$choice = $this->uri->segment(4);
		
		switch ($choice) {
			case 'overview':
				$data['tab'] = 'overview';
				break;
				
			case 'photos':
				$data['tab'] = 'photos';
				break;
				
			case 'map':
				$data['tab'] = 'map';
				break;
				
			case 'enquiry':
				$data['tab'] = 'enquiry';
				break;
			
			default:
				$data['tab'] = 'overview';
		}
		
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		
		$id = ($this->uri->segment(5) != "") ? $this->uri->segment(5) : '';		
		$data['listing'] = $this->_getListingDetails($id); // gets the selected listing		
		
		// $this->db->query('CALL sp_categories_count()');
		$this->db->query('CALL sp_filtered_categories_count()');
		//$db = $this->db->query('SELECT COUNT(m.mcat_id) AS `count`, m.mcat_id, s.sub_category AS `subcategory`, m.category AS `maincategory` FROM ((tmpcateg_count t LEFT JOIN subcategories s ON t.subcategories=s.scat_id) LEFT JOIN maincategories m ON s.mcat_id=m.mcat_id) GROUP BY m.category;');
		$db = $this->db->query("SELECT COUNT(mcat_id) AS `count`, mcat_id, maincategory FROM tmp_filtered_categ_count GROUP BY mcat_id");
		$records = $db->result();
				
		$data['mapdata'] = $this->_mapdata($data['listing']);
		
		$data['sbsettings'] = $this->settings->readSideBar();
		// 		on_watch($data['sbsettings']);
		$data['favorites'] = getFavItemsResultSet();
		$data['maincategories'] = $records; //$this->_loadCategories();
		$data['locations'] = $this->db->query("SELECT COUNT(s.name) AS count, s.s_id, s.code, s.name FROM listing l LEFT JOIN state s ON l.state=s.s_id WHERE l.status='1' AND l.expired='0' GROUP BY s.name")->result();
		$data['main_content'] = 'directory/listing/listing_details_view';
		$this->load->view('includes/directory/template', $data);
		 	
	}
	
	private function _getListingDetails($id) {
		$strQry = sprintf("SELECT l.lst_id, l.title, l.subcategory, l.images, l.advr, l.description, l.address, l.suburb, l.postcode, s.name AS state, s.code AS state_code, c.name AS country, l.cname, l.phone, l.email, l.url, l.package, l.created, l.ledited, l.images  FROM listing l LEFT JOIN state s ON l.state=s.s_id  LEFT JOIN country c ON l.country=c.c_id  WHERE l.lst_id=%d", $id);
		
		$params['querystring'] = $strQry;
		
		$this->load->model('mdldata');
		$this->mdldata->select($params);
		
		$result = $this->mdldata->_mRecords;
		
		return $result;
		
	}

	private function _getMSCategories($record) {
		$result = array();
		$subcat = preg_split("/,/", $record[0]->subcategory);
		
		foreach ($subcat as $categ) {
			$strQry = sprintf("SELECT CONCAT(m.category, ':', m.mcat_id,  ' => ', s.sub_category, ':', s.scat_id) AS subcategory FROM subcategories s LEFT JOIN maincategories m ON s.mcat_id=m.mcat_id WHERE s.scat_id=%d", $categ);
			$params['querystring'] = $strQry;		
			$this->mdldata->select($params);
			$result[] = $this->mdldata->_mRecords[0]->subcategory;
		}
				
		return  (array)$result;
		
	}
	
	/**
	 * backup _sendListingEmail
		$receiver =  'kenn_vall@yahoo.com';//$this->input->post('advr');
		$subject = 'Congratulation You have successfully added your listing'; // @neetodo: hardcoded message.
		
		// preps some data/info here
		$msg = '';
		$msg .= "<h2>Congratulations!</h2> <p>you have successfully added a listing on our database</p>";
		$msg .= "<p>Listing title: <strong>" . $params['adTitle'] . "</strong></p>";
		$msg .= "<div>&copy; 2012 newcastlehunter.com</div>";
		// end prep
		$this->load->library('email', $this->_configEmail());
		$this->email->set_newline("\r\n");
		
		$this->email->from('your@example.com', ''); // @neerevisit: (FROM) this should retrived from either config.php or db
		$this->email->to($receiver);
		
		$this->email->subject($subject);
		$this->email->message($msg);
		
		if($flag) {
			if($this->email->send() === FALSE) {
				echo $this->email->print_debugger();
				return FALSE;
			}		
		}
		
		return TRUE;
	*/	
	
	private function _sendListingEmail($params = array(), $flag = TRUE) {
		
		// USE Emailutil ON THIS PART
		$subject = 'Congratulation You have successfully added your listing';
		$msg = (array_key_exists('msg', $params)) ? $params['msg'] : 'My message';
		$receiver = 'kenn_vall@yahoo.com';//$this->input->post('advr'); // @todo: remove hardcoded email add
		$sender = '';
		
		// template data
		$tpl = array(
					'list_title' => $params['adTitle'],
					'year' => '2012',
					'customer' => $this->_mFullName,
					'site_url' => anchor(base_url("directory"), 'aus-newcastle', array('target' => "_blank"))
				);
		
		$this->load->library('parser');
		$msg = $this->parser->parse('includes/templates/payments/emailConfmStandaPayment_tpl', $tpl, TRUE);
		
		$config = array(
			'sender' => $sender,
  			'receiver' => $receiver,
  			'from_name' => 'Newcastle-Hunter Directory', // OPTIONAL  // @todo: retrieve this from db			
  			'subject' => $subject, // OPTIONAL
  			'msg' => $msg , // OPTIONAL
  			'email_temp_account' => isLocalEnv() //TRUE, // OPTIONAL. Uses your specified google account only. Please see this method "_tmpEmailAccount" below (line 111).  			
		);
		
		$this->load->library('emailutil', $config);
		
		$bug = array(
				'params' => $params,
				'config' => $config
			);
		
		fb::log($bug, "listing->_sendListingEmail");
		
		if($flag) {
			if(! $this->emailutil->send()) {
				echo $this->email->print_debugger();
				return FALSE;
			}
		}
		
		return TRUE;
	}
		
	private function checkIfSignedUp() {
		// sentinel
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');	
		
	
		if($this->sentinel->goFlag($params, FALSE)) {
			$this->_loadListingFive();
		} else {
			$this->_loadLogin();
		}
		
	}
	
	private function _mapdata($obj) {
		$tmpArr = array();
				
		foreach ($obj as $list) {
			$tmpArr[] = array('name' => $list->title, 'address' => (($list->address != "") ? $list->address . ", " : "") . (($list->suburb !="") ? $list->suburb . ", " : "") . " $list->postcode, $list->state", 'country' => $list->country);		
		}
		
		return $tmpArr;
	}
	
	function do_upload() {
						//call_debug($_POST, FALSE);
						$arr = explode(',', $this->input->post('file_uploader_images'));
		
						//>>> DO FORM/DATA PROCESSING/VALIDATION HERE <<<
						echo 'ci:<br />';
		
// 						call_debug($arr, FALSE);
	}
		
	/**
	 * utility methods
	 */
	private function _loadLogin() {
		
		if(isset($this->_mMyLoginError))
			$data['accnterror'] = TRUE;
		
		$data['main_content'] = 'directory/listing/log_in_view.php';
		$this->load->view('includes/directory/template_b', $data);
		
	}
	
	private function _loadSignup() {
		$data['states'] = $this->_loadState();
		$data['countries'] = $this->_loadCountry();
		$data['main_content'] = 'directory/listing/sign_up_view.php';
		$this->load->view('includes/directory/template_b', $data);
	}
	
	private function _loadListingTwo() {
		
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$this->load->library('cart');
		$this->cart->show();
		$data['cart'] = ($this->cart->_mData);
		
		//call_debug($data['cart'], FALSE);
		
		$data['main_content'] = 'directory/listing/listing_two_view';
		$this->load->view('includes/directory/template_b', $data);
	}
	
	private function _loadListtingThree() {
		
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$this->load->library('cart');
		$this->cart->show();
		$data['cart'] = ($this->cart->_mData);		
		
		$data['main_content'] = 'directory/listing/listing_three_view';
		$this->load->view('includes/directory/template_b', $data);
		
	}
	
	private function _loadListingFour() {
	/* 	$this->load->library('cart');
		$this->cart->show();
		$data['cart'] = ($this->cart->_mData);				
		 */
		
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		$data['main_content'] = 'directory/listing/listing_four_view';
		$this->load->view('includes/directory/template_b', $data);
	}
	
	private function _loadListingFive() {	

		// sentinel
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');
		
		if($this->sentinel->goFlag($params, FALSE)) {
			// gets the currently logged in user
			$this->_getUser();
			$data['user'] = $this->_mFullName;
			$data['main_content'] = 'directory/listing/listing_five_view';
			$this->load->view('includes/directory/template_b', $data);
		} else {
			// redirects back to the first process of listing an ad
			$this->index();
			
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
	
	private function _setSession($signup = TRUE) {
		
		if($signup) { // used for registration process...
			$params = array(
							'advr_uname' => $this->input->post('uname'),
							'advr_islog' => TRUE,
							'advr_fullname' => $this->input->post('fname') . ' ' . $this->input->post('lname')
							);
		} else { // used for loggin in process
			
			$params = array(
					'advr_uname' => $this->input->post('username'),
					'advr_islog' => TRUE,
					'advr_fullname' => $this->_mfullname
			);
		}
				
		$this->sessionbrowser->setInfo($params);
		
	}
	
	private function _isUserExists() {
	
		$params = array('table' => array('name' => 'advertiser', 'criteria_phrase' => 'username="' . $this->input->post('username') . '" and password="' . md5($this->input->post('pword')) .'"'));
	
		$this->load->model('mdldata');
		$this->mdldata->select($params);
	
		if($this->mdldata->_mRowCount < 1)
			return FALSE;
	
	
		foreach ($this->mdldata->_mRecords as $rec) {
			$this->_mfullname = $rec->fname . ' ' . $rec->lname;
		}
	
		return TRUE;
	}
	
	private function _cartIsEmpty() {
		$this->load->library('cart');
		$this->cart->show();
		
		$cart = $this->cart->_mData;
		
		if($cart['adTitle'] != '' and $cart['adSuburb'] != '')
			return FALSE;
		
		return TRUE;
	}
	
	private function _updateListingToDB($premium = TRUE) {
		
	}
	
	private function _addListingToDB( $premium = TRUE) {
		$this->load->library('cart');
		$this->cart->show();
		$cart = $this->cart->_mData;
		$package = '0';

		// preps some data
		switch(strtolower($cart['adPackageType'])) {
			case 'standard':
				$package = '0';
				break;
			case 'premium':
				$package = '1';
				
		}		
		// end preparing data
		
		$this->load->model('mdldata');
		
		$params = array(
					'table' => array(
						'name' => 'listing'						
					),
					'fields' => array(
							'title' => $cart['adTitle'],
							'subcategory' => $cart['adCategories'],
							'images' => $cart['adImages'],
							'advr' => $this->_getUserID(), // advertiser | int
							'description' => mysql_real_escape_string($cart['adDescription']),
							'address' => $cart['adStreetAddress'],
							'suburb' => $cart['adSuburb'],
							'postcode' => $cart['adPostcode'],
							'state' => $cart['adState'],
							'country' => $cart['adCountry'],
							'cname' => $cart['adTitle'], // contact name | varchar
							'phone' => $cart['adPhone1'], // primary phone
							'phone2' => $cart['adPhone2'], // secondary phone
							'email' => $cart['adEmail'],
							'url' => $cart['adUrl'], // website url
							'package' => $package,
							'recurrent' => $cart['adRecurrentType'],
							'paypal' => $cart['adPaypal'],
							'status' =>  (($premium == TRUE) ? '0' : '1') // package type | enum ("0", "1") 0 = FREE, 1 = paid listing // @neerevisit: (STATUS fld should be approved or auto approve ) this should retrived from either config.php or db
							// 0 for premium this is to let the system search for those payments that have gone completed from paypal, otherwise the system will make the listing inactive							
					)
				);
		
// 		call_debug($params['fields']);
// 		$this->mdldata->executeSP('sp_add_listing', $params['fields']); // @neefixme: use a transaction on this coz two tables are involved
		$this->db->query("CALL sp_add_listing(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $params['fields']);
		
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
	
	private function _getUser() {
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');
		$this->sessionbrowser->getInfo($params);
			
		$arr = $this->sessionbrowser->mData;
			
		$this->_mUserName = $arr['advr_uname'];
		$this->_mFullName = $arr['advr_fullname'];
		
	}

	private function _prepURL($str) {
		$output = '';
		$pattern = '/(http:\/\/(www\.)?)|(www\.)|(\\b)/i';
	
		$output .= preg_replace($pattern, "", $str);
	
		return $output;
	
	}
	
	public function signout($curUrl = '') {
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');
		$this->sessionbrowser->destroy($params);
		redirect(base_url() . 'directory/listing');
	}
	
	
	
	private function _configEmail() {
		
		$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'kennvall@gmail.com',
					'smtp_pass' => $this->config->item('gmailpassword'),
					'mailtype' => 'html'
				);
		
		return (array)$config;
		
	}
	
	public function test() {
		$img = './ads/1/VrqBb1pQ5if528764d624db129b32c21fbca0cb8d6.jpg';
		$data       = getimagesize($img);
		
		call_debug($data);
	} 
	
	
}
