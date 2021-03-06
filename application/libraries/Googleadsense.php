<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
/**
 *
 * This is a Google Adsense class,
 * that pulls ads from Google in the page context manner
 *
 * @license GPL
 * @package 	Codeigniter
 * @subpackage	application/libraries
 * @author Kenneth "digiArtist_ph" P. Vallejos
 * @since Thursda, December 13, 2012
 * @version 1.0.1
 *
 * Dependancies:
 *		1. Needs create table schema in the database for its settings to read/write from/into
 *			1.1 Table schema:
 *				CREATE TABLE `settings` (
 * 					`st_id` int(11) NOT NULL AUTO_INCREMENT,
 * 					`setting` varchar(255) NOT NULL,
 * 					`value` varchar(255) DEFAULT NULL,
 * 					PRIMARY KEY (`st_id`)
 *				) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
 *			1.2 Settings
 *				1.2.1 Run this query against the database. INSERT INTO `settings` SET `setting`='google_ad_client', `value`='pub-0000000000000000';
 *
 */
class Googleadsense {

	private $_mImageTest;
	private $_mEnabled;
	private $CI;

	public function __construct() {

		// initializing some member variables
		$this->_mImageTest = 0;
		$this->_mEnabled = 0;
		$this->CI = &get_instance();
		
	}

	public function createAdSense($type, $imageFlag = 0) {
		$imageFlag = $this->_isTestingEnv();

		$this->mImageTest = $imageFlag; // read from db
	
		// checks if the Google Adsense plugin is enabled
		$this->_mEnabled = $this->_isGoogleAdSenseEnable();
		
		// call_debug($this->_mEnabled);
		
		if ( ! $this->_mEnabled)
			return null;
				
		switch ($type) {
			case 1:
				return $this->_display468x60_as($imageFlag);
				break;
			case 2:
				return $this->_display250x250_as($imageFlag);
				break;
			case 3:
				return $this->_display120x240_as($imageFlag);
				break;
			default:
				$this->_display468x60_as($imageFlag);
		}

	}

	private function _display468x60_as($imageFlag = 0) {

		$output = '';
		$imgUrl = base_url("images/googleadsenseimgs/textonly/adsense_185665_adformat-text_468x60_en.png");
		$output = sprintf('<img  src="%s" />', $imgUrl);

		if(! $imageFlag)
		$output = $this->_generateAdSenseScript(468, 60, '468x60_as');
			
		return trim($output);
	}

	private function _display250x250_as($imageFlag = 0) {
		$output = '';
		$imgUrl = base_url("images/googleadsenseimgs/textonly/adsense_185665_adformat-text_250x250_en.png");
		$output = sprintf('<img  src="%s" />', $imgUrl);

		if(! $imageFlag)
		$output = $this->_generateAdSenseScript(250, 250,'250x250_as');
			
		return trim($output);
	}

	private function _display120x240_as($imageFlag = 0) {
		$output = '';
		$imgUrl = base_url("images/googleadsenseimgs/textonly/adsense_185665_adformat-text_120x240_en.png");
		$output = sprintf('<img  src="%s" />', $imgUrl);

		if(! $imageFlag)
		$output = $this->_generateAdSenseScript(120, 240, '120x240_as');
			
		return trim($output);
	}

	private function _generateAdSenseScript($width, $height, $format = '468x60_as') {

		$output = '';
		$output .= '<!-- Start Here -->';
		$output .= '<script type="text/javascript"><!--';
		if($this->_mImageTest)
		$output .= 'google_adtest = "on";';
		$output .= 'google_ad_client = "pub-0000000000000000";'; // @todo: this should be retrieve from the db
		//$output .= '/* 468x60, created 7/17/08 */';
		//$output .= 'google_ad_slot = "7112975069";';
		$output .= sprintf('google_ad_width = %s;', $width);
		$output .= sprintf('google_ad_height = %s;', $height);
		$output .= sprintf('google_ad_format = "%s";', $format);
		$output .= '//-->';
		$output .= '</script>';
		$output .= '<script type="text/javascript"';
		$output .= 'src="http://pagead2.googlesyndication.com/pagead/show_ads.js">';
		$output .= '</script>';
		$output .= '<!-- End Here -->';

		return trim($output);

	}

	private function _isTestingEnv() {

		$strQry = sprintf("SELECT * FROM `settings` WHERE `setting`='%s'", "google_ad_test_env");
		$settings = $this->CI->db->query($strQry)->result();

		foreach($settings as $setting) {
			if($setting->value == '1')
				return 1;
			else
				return 0;
		}
			
		return 0;
	}

	private function _isGoogleAdSenseEnable() {

		$strQry = sprintf("SELECT * FROM `settings` WHERE `setting`='%s'", "google_adsense_enable");
		$settings = $this->CI->db->query($strQry)->result();

		foreach($settings as $setting) {
			if($setting->value == '1')
				return  1;
			else
				return 0;
		}

		return 0;
	}

}

