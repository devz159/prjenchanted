<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
 
class Paypal extends CI_Controller  {

	private $_mFullName;
	private $_mUserName;
	private $_mMyLoginError;
	
	function __construct() {
		parent::__construct();
		
		// initializes some member variables
		$this->_mFullName;
		$this->_mUserName = '';
		$this->_mMyLoginError = null;
		
		// @todo: firePHP
		fb::setEnabled(TRUE);
	}
	
	public function xprocess() {
		
		//@mnctodo: open db to get paypal business accnt.
		$pay_receiver = 'kennva_1341307061_biz@gmail.com';
		
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=' . urlencode('_notify-validate');
		
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		
		$ch = curl_init();
		// @mnctodo: open db to get settings for PayPal 
		curl_setopt($ch, CURLOPT_URL, 'https://www.sandbox.paypal.com/cgi-bin/webscr' /*Paypalsettings::env()*/);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.sandbox.paypal.com'/*Paypalsettings::envHost()*/) );
		$res = curl_exec($ch);
		curl_close($ch);
		
		//call_debug(Paypalsettings::envHost());
		// assign posted variables to local variables
		$item_name = $_POST['item_name1'];
		$item_number = $_POST['item_number1'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
// 		echo $_POST['payment_status'];
		
		
		if (strcmp ($res, "VERIFIED") == 0) {
			// check the payment_status is Completed -- DONE
			// check that txn_id has not been previously processed -- DONE
			// check that receiver_email is your Primary PayPal email -- DONE
			// check that payment_amount/payment_currency are correct
			// process payment
			if($_POST['payment_status'] == 'Completed'  
				&& ($this->_isExist_paypal_trnx_id($txn_id) == FALSE) 
			 	&& $pay_receiver == $receiver_email 
			 	&& $payment_amount == $this->_getTotalAmount($item_name)) {
			 		
				if($this->_insertOrders($_POST)) {
					// send email payment confirmation
					$data = array(
								'receiver' => $payer_email,
								'item_name' => $item_name
							);
					$this->_sendPaypalEmail($data);
				}
			}
		}
		else if (strcmp ($res, "INVALID") == 0) {
			// log for manual investigation
		}
		
	}
	
	public function test() {
		/*
		// calls stored procedure
		$this->db->query("CALL sp_test(1)");
		$rec = $this->db->query("SELECT @insertorderstatus AS `status`")->result();
		
		call_debug($rec, FALSE);
		foreach ($rec as $r) {
			if($r->status == 0)
				echo 'record is zero';
			else
				echo 'record is good';

		}
		*/
		
		
	}
	
	public function process() {


		// STEP 1: Read POST data

		// reading posted data from directly from $_POST causes serialization
		// issues with array data in POST
		// reading raw POST data from input stream instead.
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
			$keyval = explode ('=', $keyval);
			if (count($keyval) == 2)
			$myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) {
			$get_magic_quotes_exists = true;
		}
		foreach ($myPost as $key => $value) {
			if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
				$value = urlencode(stripslashes($value));
			} else {
				$value = urlencode($value);
			}
			$req .= "&$key=$value";
		}


		// STEP 2: Post IPN data back to paypal to validate

		$ch = curl_init(Paypalsettings::env()/*'https://www.sandbox.paypal.com/cgi-bin/webscr'*/);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(Paypalsettings::envHost()/*'Host: www.sandbox.paypal.com'*/));

		// In wamp like environments that do not come bundled with root authority certificates,
		// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
		// of the certificate as shown below.
		// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
		if( !($res = curl_exec($ch)) ) {
			// error_log("Got " . curl_error($ch) . " when processing IPN data");
			curl_close($ch);
			exit;
		}
		curl_close($ch);


		// STEP 3: Inspect IPN validation result and act accordingly

		if (strcmp ($res, "VERIFIED") == 0) {
			// check whether the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your Primary PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment
				
			//@mnctodo: open db to get paypal business accnt.
			$pay_receiver = 'kennva_1341307061_biz@gmail.com';
				
			// assign posted variables to local variables
			$item_name = $_POST['item_name1'];
			$item_number = $_POST['item_number1'];
			$payment_status = $_POST['payment_status']; // Undefined index
			$payment_amount = $_POST['mc_gross_1'];
			$payment_currency = $_POST['mc_currency'];
			$txn_id = $_POST['txn_id'];
			$receiver_email = $_POST['receiver_email'];
			$payer_email = $_POST['payer_email'];
				
			// process payment
			if($_POST['payment_status'] == 'Completed'
			&& ($this->_isExist_paypal_trnx_id($txn_id) == FALSE)
			&& $pay_receiver == $receiver_email
			&& $payment_amount == $this->_getTotalAmount($item_name)
			&& $payment_currency == $this->config->item('currency_code')) {

				if($this->_insertOrders($_POST)) {
					// send email payment confirmation
					$data = array(
								'receiver' => $payer_email,
								'item_name' => $item_name
					);
					log_message("error", "Inserted record succesfully.");
					$this->_sendPaypalEmail($data);
				} else {
					log_message('error', "FAILED INSERTING RECORD into orders table.");
				}
			}
				
		} else if (strcmp ($res, "INVALID") == 0) {
			// log for manual investigation
		}
	}

	public function thankyou() {
		// clears the content of the cart library. this is very necessary
		$this->load->library('cart');
		$this->cart->end();
		
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');
		$this->sessionbrowser->getInfo($params);
		$arr = $this->sessionbrowser->mData;
		
		// authorizes access. to secure if the current session is valid
		authUser(array('section' => 'login', 'sessvar' => array('advr_uname', 'advr_islog', 'advr_fullname')));
		
		$data['main_content'] = 'includes/templates/thankyou/paypal_thank_you_page_tpl'; //'paypal/thankyoupage_view';
		$this->load->view('includes/directory/template_b', $data);

	}
	
	private function _isExist_paypal_trnx_id($id) {
		
		$strQry = sprintf("SELECT * FROM orders WHERE paypal_trans_id='%s'", $id);
		
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		
		$this->mdldata->select($params);
		
		if($this->mdldata->_mRowCount == 0)
			return FALSE;
		
		return TRUE;
	}
	
	private function _insertOrders($param) {
		
		// preps some data		
		$itemnumber = $_POST['item_number1'];
		 
		$item_advr = preg_split('/-/', $itemnumber);
		$advr = 0;
		$lst_id = 0;
		
		if(count($item_advr)) {
			$lst_id = $item_advr[0];
			$advr = $item_advr[1];
		}
		 
		$payer_email = $param['payer_email'];
		$amount = $param['mc_gross'];
		$status = $param['payment_status'];
		$address_state = $param['address_state'];
		$address_zip = $param['address_zip'];
		$address_city = $param['address_city'];
		$address_country = $param['address_country'];
		$paypal_trans_id = $param['txn_id'];
		
		$created = date('Y-m-d H:m:i');
		
		/*
		$strQry = sprintf("INSERT INTO orders SET itemnumber='%s', email='%s', amount=%d, status='%s', state='%s', zip_code='%s', address='%s', country='%s', paypal_trans_id='%s', created_at='%s'",
							$itemnumber,
							$payer_email,
							$amount,
							$status,
							$address_state,
							$address_zip,
							$address_city,
							$address_country,
							$paypal_trans_id,
							$created
						);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		if(! $this->mdldata->insert($params)) // inserts into orders table
			return FALSE;
		*/
		$spParams = array(
			'itemnumber' => $itemnumber,
			'email' => $payer_email,
			'amount' => $amount,
			'status' => $status,
			'state' => $address_state,
			'zip' => $address_zip,
			'city' => $address_city,
			'country' => $address_country,
			'paypaltrxnid' => $paypal_trans_id,
			'created' => $created
		);
		
		// executes the store procedure
		$this->db->query("CALL sp_insert_orders(?,?,?,?,?,?,?,?,?,?,@insertorderstatus)", $spParams);
		
		// checks if the stored procedure executed successfully
		//if($this->db->query("SELECT @insertorderstatus AS `status` WHERE `status`=1")->num_rows() == 0)
			//return FALSE;			
		//$procStatus = $this->db->query("SELECT @insertorderstatus AS `status`")->result();
		
		// checks the status of the sp_insert_orders

		// this has been dropped (advertiser_listing table won't be used anymore)
		//if(! $this->_add_advertiser_listing($advr, $lst_id, $created, $payer_email))
			//return FALSE;
		
		if(! $this->_update_listing($lst_id))
			return FALSE;
		
		return TRUE;
	}
	
	private function _add_advertiser_listing($advr,	$lst_id, $created,$payer_email) {  // this should be in a call_user_func
		
		$this->load->model('mdldata');		
		$strQry = sprintf("INSERT INTO advertiser_listing SET ad_id=%d, lst_id=%d, posted='%s', paypal='%s'",
				$advr,
				$lst_id,
				$created,
				$payer_email
		);
		
		$params['querystring'] = $strQry;
		if(! $this->mdldata->insert($params)) // inserts into advertiser_listing table
			return FALSE;
		
		return TRUE;
		
	}
	
	/**
	 * 
	 $receiver =  'kenn_vall@yahoo.com';//$this->input->post('advr');
		$subject = 'Congratulation You have successfully paid using PayPal'; // @neetodo: hardcoded message.
	
		// preps some data/info here
		$msg = '';
		$msg .= "<h2>Congratulations!</h2> <p>Your payment went through.</p>";
		
		$msg .= "<div>&copy; 2012 newcastlehunter.com</div>";
		// end prep
		$this->load->library('email', $this->_configEmail());
		$this->email->set_newline("\r\n");
	
		$this->email->from('your@example.com', 'Newcastle-Hunter Directory'); // @neerevisit: (FROM) this should retrived from either config.php or db
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
	
	
	private function _sendPaypalEmail($params = array(), $flag = TRUE) {

		// USE Emailutil ON THIS PART
		$subject = 'Congratulation You have successfully added your listing';
		$msg = (array_key_exists('msg', $params)) ? $params['msg'] : 'My message';
		$receiver = 'kenn_vall@yahoo.com'; //$receiver = $params['receiver'];
		$sender = '';
		
		// retrieves the listing name from the db;
		$listing_name = $this->_getListingName($params['item_name']);
		$advertiser_name = $this->_getAdvertiserName($params['receiver']);
		
		// template data
		$tpl = array(
					'list_title' => $listing_name,
					'year' => '2012',
					'customer' => $advertiser_name,
					'site_url' => anchor(base_url("directory"), 'aus-newcastle', array('target' => "_blank"))
				);
		
		$this->load->library('parser');
		$msg = $this->parser->parse('includes/templates/payments/emailConfmStandaPayment_tpl', $tpl, TRUE);
		
		$config = array(
			'sender' => $sender,
  			'receiver' => $receiver,
  			'from_name' => 'Newcastle-Hunter Directory', // OPTIONAL  			
  			'subject' => $subject, // OPTIONAL
  			'msg' => $msg, // OPTIONAL
  			'email_temp_account' => TRUE, // OPTIONAL. Uses your specified google account only. Please see this method "_tmpEmailAccount" below (line 111).  			
		);
		
		$this->load->library('emailutil', $config);
		
		if($flag) {
			if(! $this->emailutil->send()) {
				echo $this->email->print_debugger();
				return FALSE;
			}
		}
		
		return TRUE;
		
	}
	
	private function _getListingName($lstid) {
		
		$strQry = sprintf("SELECT * FROM listing WHERE lst_id=%d", $lstid);		
		$record = $this->db->query($strQry)->result();
		
		foreach($record as $rec):
			return trim($rec->title);
		endforeach;
		
		return '';
	}
	
	private function _getAdvertiserName($email) {
		
		$strQry = sprintf("SELECT fname, lname FROM advertiser WHERE email=%s", $email);
		$record = $this->db->query($strQry)->result();
		
		foreach($record as $rec) :
			return trim(sprintf("%s %s"), $rec->fname, $rec->lname);
		endforeach;
		
		return;
		
	}
	
	private function _update_listing($lst_id) {	 // this should be in a call_user_func
		
		$this->mdldata->reset(); // resets mdldata parameters
		$strQry = sprintf("UPDATE listing SET package='1', status='1', expired='0' WHERE lst_id=%d", $lst_id);
		$params['querystring'] = $strQry;
		
		if(! $this->mdldata->update($params))
			return FALSE;
		
		return TRUE;
		
	}
	
	private function _getTotalAmount($itemcode) {		
		$amount = 0.00;
		$item = '';
		
		// preps data
		if($itemcode!="") {		
			preg_match('/[\S]+(?=\s{1,3}listing|\s{1,3}Listing)/', $itemcode, $matches);
			
			if(count($matches) > 0)
				$item = $matches[0];			
		}
		
		$strQry = sprintf("SELECT price FROM products WHERE name='%s'", $item);
		$this->load->model('mdldata');
		$params['querystring'] = $strQry;
		$this->mdldata->select($params);
		$amount = $this->mdldata->_mRecords[0]->price;
		
		return $amount;
	}
	
	private function _getUser() {
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');
		$this->sessionbrowser->getInfo($params);
			
		$arr = $this->sessionbrowser->mData;
			
		$this->_mUserName = $arr['advr_uname'];
		$this->_mFullName = $arr['advr_fullname'];
		
	}

}
