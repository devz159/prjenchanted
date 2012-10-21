<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxproper extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function addcategory() {
		$this->load->model('mdldata');
		
		$params = array('table' => array('name' => 'maincategories', 'order_by' => 'category:asc'));
		$this->mdldata->select($params);
		$data['mcategories'] = $this->mdldata->_mRecords;
		$data['id'] = intval($this->input->post('id'));
		$this->load->view('ajax/addcategory_view', $data);
		
	}
	
	public function addsubcategory() {
		$this->load->model('mdldata');
		
		$params = array('table' => array('name' => 'subcategories', 'order_by' => 'sub_category:asc', 'criteria' => 'mcat_id', 'criteria_value' => $this->input->post('cat_id')));
		$this->mdldata->select($params);
		$data['scategories'] = $this->mdldata->_mRecords;
		
		$this->load->view('ajax/addsubcategory_view', $data);
		
	}
	
}
