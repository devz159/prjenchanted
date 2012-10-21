<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index() {
		$data['maincategories'] = $this->_loadCategories();
		$data['main_content'] = 'directory/home_view';
		$this->load->view('includes/directory/template', $data);
		
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
	
	public function copy() {
		$file = './uploaded/Yl5j7IWRMXf528764d624db129b32c21fbca0cb8d6.jpg';
		$newfile = './ads/test/Yl5j7IWRMXf528764d624db129b32c21fbca0cb8d6.jpg';
		
		if (!copy($file, $newfile)) {
			echo "failed to copy $file...\n";
		}	
	}
	
	
	public function test() {
		
		$this->load->library('imagemanager');
		/*
		$filename = './uploaded/1tzI5iDTVhf528764d624db129b32c21fbca0cb8d6.jpg';
		$dir = './uploaded/test';

		if (is_writable($dir)) {
			echo "The directory >>>$dir is writable";
		} else {
			echo "The directory >>>$dir is not writable";
		}*/
		
		$str = 'hypertext language programming';
		$str = 'nqqBz32ULhf528764d624db129b32c21fbca0cb8d6.jpg,TmRCSMU1Mbf528764d624db129b32c21fbca0cb8d6.jpg';
		//$str = '';
		//$chars = preg_split('/,/', $str, -1, PREG_SPLIT_NO_EMPTY);
		//call_debug($chars);
		
		if($this->imagemanager->manage($str))
			echo 'true';
		else
			echo 'false';
	}
}

