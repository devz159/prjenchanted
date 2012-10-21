<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller {
	
	public  function subcategories() {
		$output = array();
		
		$name = $_GET['name_startsWith'];
		
		$this->load->model('mdldata');
		$params['querystring'] = "SELECT * FROM subcategories WHERE sub_category LIKE'%" . $name . "%'";
		
		$this->mdldata->select($params);
		
		foreach($this->mdldata->_mRecords as $rec) {
			$output[] = array('name' => $rec->sub_category);
		}
		
		$response = $_GET['callback'] . "(" . json_encode($output) . ')';

		echo $response;
		
	}
}
