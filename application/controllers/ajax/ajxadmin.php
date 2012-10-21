<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajxadmin extends  CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function toogleAdvertiserStatus() {
		
		$status = ($this->input->post('status')) ? $this->input->post('status') : '0';
		$advr = ($this->input->post('advr')) ? $this->input->post('advr') : '0';
		
		$this->db->query("SET @success=0");
		$strQry = sprintf("CALL sp_advertiser_deactivate(%d, %d, @success)", $status, $advr);
		$this->db->query($strQry);
		$params['querystring'] = "SELECT @success AS result";
		$this->load->model('mdldata');
		$this->mdldata->select($params);
		
		if($this->mdldata->_mRecords[0]->result == 1)
			echo 'succeed';
		else
			echo 'failed';
		
	}
	
}

