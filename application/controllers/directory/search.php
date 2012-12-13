<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
	private $_mUserName;
	private $_mFullName;
	
	public function __construct() {
		parent::__construct();
		$this->load->library('favlist');
		$this->load->library('settings');
		
		$this->_mFullName;
		$this->_mUserName = '';
		//echo $this->googleadsense->test();
		//die();
// 		call_debug($this->settings->showall());
	}
	
	public function my_signout() {
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');
		$this->sessionbrowser->destroy($params);
		redirect(base_url() . 'directory/search');
	}
	
	public function index() {
			
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		
		// the search button has been pressed
		if(isset($_POST['searchquery'])) {
			$strSearch = $_POST['searchquery'];
			
			//$params['querystring'] = "SELECT lst_id as id, title, description, address, phone FROM listing WHERE MATCH(title, description) AGAINST('" . $this->input->post('searchquery') . "') ORDER BY title DESC";
			$params['querystring'] = "SELECT l.advr, l.lst_id as id, l.title AS `title`, l.description AS `description`, l.address AS `address`, l.phone AS `phone`, l.postcode AS `postcode`, l.images AS images, s.name AS `state`, c.name as `country` FROM ((listing l LEFT JOIN country c ON l.country=c.c_id)  INNER JOIN state s ON l.state=s.s_id ) WHERE ( MATCH(title, description) AGAINST('" . $this->input->post('searchquery') . "') AND l.status='1' AND l.expired='0') ORDER BY title DESC";
						
			$this->load->model('mdldata');			
			$this->mdldata->select($params);
			$data['serps'] = $this->mdldata->_mRecords;

			$data['serpscount'] = $this->mdldata->_mRowCount;
			$data['searchkeyword'] = $this->input->post('searchquery');
			
		}			

		// $this->db->query('CALL sp_categories_count()');
		$this->db->query('CALL sp_filtered_categories_count()');
		// $db = $this->db->query('SELECT COUNT(m.mcat_id) AS `count`, m.mcat_id, s.sub_category AS `subcategory`, m.category AS `maincategory` FROM ((tmpcateg_count t LEFT JOIN subcategories s ON t.subcategories=s.scat_id) LEFT JOIN maincategories m ON s.mcat_id=m.mcat_id) GROUP BY m.category;');
		$db = $this->db->query("SELECT COUNT(mcat_id) AS `count`, mcat_id, maincategory FROM tmp_filtered_categ_count GROUP BY mcat_id");
		$records = $db->result();
		
		// call_debug($records);
		
		$data['sbsettings'] = $this->settings->readSideBar();
// 		on_watch($data['sbsettings']);
		$data['favorites'] = getFavItemsResultSet();		
		$data['maincategories'] = $records;
		$data['locations'] = $this->db->query("SELECT COUNT(s.name) AS count, s.s_id, s.code, s.name FROM listing l LEFT JOIN state s ON l.state=s.s_id WHERE l.status='1' AND l.expired='0' GROUP BY s.name")->result();
		$data['main_content'] = 'directory/search/search_view';
		$this->load->view('includes/directory/template', $data);
	}
	
	public function search_location () {
		
		$idLoc = $this->uri->segment(4);
		$nameLoc = $this->uri->segment(5);
		
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		
		$strQry = sprintf("SELECT  l.advr, l.lst_id as id, l.title AS `title`, l.description AS `description`, l.address AS `address`, l.phone AS `phone`, l.postcode AS `postcode`, l.images AS images, s.name AS `state`, c.name as `country` FROM ((listing l LEFT JOIN country c ON l.country=c.c_id)  INNER JOIN state s ON l.state=s.s_id ) WHERE state=%d AND l.status='1' AND l.expired='0'", $idLoc);
		$params['querystring'] = $strQry; 
					
		$this->load->model('mdldata');			
		$this->mdldata->select($params);
		$data['serps'] = $this->mdldata->_mRecords;
		
		$data['serpscount'] = $this->mdldata->_mRowCount;
		//call_debug($data['serpscount']);
		$data['searchkeyword'] = $nameLoc;
			

		// $this->db->query('CALL sp_categories_count()');
		$this->db->query('CALL sp_filtered_categories_count()');
		// $db = $this->db->query('SELECT COUNT(m.mcat_id) AS `count`, m.mcat_id, s.sub_category AS `subcategory`, m.category AS `maincategory` FROM ((tmpcateg_count t LEFT JOIN subcategories s ON t.subcategories=s.scat_id) LEFT JOIN maincategories m ON s.mcat_id=m.mcat_id) GROUP BY m.category;'); // @neefixme: need to change the criteria. include the status='2' and expired='1'
		$db = $this->db->query("SELECT COUNT(mcat_id) AS `count`, mcat_id, maincategory FROM tmp_filtered_categ_count GROUP BY mcat_id");
		$records = $db->result();
		
		$data['sbsettings'] = $this->settings->readSideBar();
		$data['favorites'] = getFavItemsResultSet();
		$data['maincategories'] = $records;
		$data['locations'] = $this->db->query("SELECT COUNT(s.name) AS count, s.s_id, s.code, s.name FROM listing l LEFT JOIN state s ON l.state=s.s_id WHERE l.status='1' AND l.expired='0' GROUP BY s.name")->result();
		$data['main_content'] = 'directory/search/search_view';
		$this->load->view('includes/directory/template', $data);
	}
	
	
	public function search_categories () {

		$idCateg = $this->uri->segment(4);
		$nameCateg = $this->uri->segment(5);
		
		// gets the currently logged in user
		$this->_getUser();
		$data['user'] = $this->_mFullName;
		
		// preps some data
		$nameCateg = preg_replace('/_/', ' ', $nameCateg);
		
		$strQry = sprintf("SELECT l.advr, l.lst_id as id, l.title AS `title`, l.description AS `description`, l.address AS `address`, l.phone AS `phone`, l.postcode AS `postcode`, l.images AS images, s.name AS `state`, c.name as `country`, l.subcategory, t.subcategories, sc.mcat_id FROM ((((listing l LEFT JOIN country c ON l.country=c.c_id)  INNER JOIN state s ON l.state=s.s_id ) LEFT JOIN tmpcateg_count t ON l.lst_id=t.listid) LEFT JOIN subcategories sc ON t.subcategories=sc.scat_id) WHERE sc.mcat_id=%d AND l.status='1' AND l.expired='0' GROUP BY t.listid", $idCateg);
		$params['querystring'] = $strQry;
	
		$this->load->model('mdldata');
		$this->db->query('CALL sp_categories_count()');
		$this->mdldata->select($params);
		$data['serps'] = $this->mdldata->_mRecords;
	
		$data['serpscount'] = $this->mdldata->_mRowCount;
		$data['searchkeyword'] = $nameCateg;
			
		// 		}
	
		// $this->db->query('CALL sp_categories_count()');
		$this->db->query('CALL sp_filtered_categories_count()');
		// $db = $this->db->query('SELECT COUNT(m.mcat_id) AS `count`, m.mcat_id, s.sub_category AS `subcategory`, m.category AS `maincategory` FROM ((tmpcateg_count t LEFT JOIN subcategories s ON t.subcategories=s.scat_id) LEFT JOIN maincategories m ON s.mcat_id=m.mcat_id) GROUP BY m.category;');
		$db = $this->db->query("SELECT COUNT(mcat_id) AS `count`, mcat_id, maincategory FROM tmp_filtered_categ_count GROUP BY mcat_id");
		$records = $db->result();
		
		$data['sbsettings'] = $this->settings->readSideBar();
		$data['favorites'] = getFavItemsResultSet();
		$data['maincategories'] = $records;
		$data['locations'] = $this->db->query("SELECT COUNT(s.name) AS count, s.s_id, s.code, s.name FROM listing l LEFT JOIN state s ON l.state=s.s_id WHERE l.status='1' AND l.expired='0' GROUP BY s.name")->result();
		$data['main_content'] = 'directory/search/search_view';
		$this->load->view('includes/directory/template', $data);
		
	}
	

/* 	public function index() {
		
		$this->load->view('home/search_page_view');
		
	}
	 */
	public function test() {
		//$this->load->view("directory/search/autocomplete_view");
		
		//$arr = $this->db->query("CALL sp_search('australia')")->result();
		
		$this->load->model('mdldata');
		$params = array('australia');
		//$params = array('fname' => 'Megan');
		
		$this->mdldata->executeSP('sp_search', $params);
		$arr = $this->mdldata->_mRecords;
		
		call_debug($arr);
		
	}
	
	private function _getUser() {
		$params = array('advr_uname', 'advr_islog', 'advr_fullname');
		$this->sessionbrowser->getInfo($params);
			
		$arr = $this->sessionbrowser->mData;
			
		$this->_mUserName = $arr['advr_uname'];
		$this->_mFullName = $arr['advr_fullname'];
	
	}
	
	private function _loadCategories() {
		$this->load->model('mdldata');
	
		$params = array(
				'table' => array(
						'name' => 'maincategories'
				)
		);
		
		$this->mdldata->select($params);
	
		return $this->mdldata->_mRecords;
	}
	
}
