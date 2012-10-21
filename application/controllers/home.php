<?php if (! defined("BASEPATH")) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index() {
 		$data['main_content'] = 'home/home_view';
		$this->load->view('includes/template',$data);
		
	}
	
	public function send() {
		
		$user = "digiArtist_ph";
		$password = "AMRWZHCLgGdFKb";
		$api_id = "3395500";
		$baseurl ="http://api.clickatell.com";
	 
		$text = urlencode("This is an example message sent from clickatell.com");
		$to = "639084920680";
	 
		// auth call
		$url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
	 
		// do auth call
		$ret = file($url);
	 
		// explode our response. return string is on first line of the data returned
		$sess = explode(":",$ret[0]);
		if ($sess[0] == "OK") {
	 
			$sess_id = trim($sess[1]); // remove any whitespace
			$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";
	 
			// do sendmsg call
			$ret = file($url);
			$send = explode(":",$ret[0]);
	 
			if ($send[0] == "ID") {
				echo "successnmessage ID: ". $send[1];
			} else {
				echo "send message failed";
			}
		} else {
			echo "Authentication failure: ". $ret[0];
		}

	}
	
	public function home_template() {
		
		$this->load->view('home/home_template');
		
	}
	
	public function test() {
		$filename = './uploaded/1tzI5iDTVhf528764d624db129b32c21fbca0cb8d6.jpg';

		if (file_exists($filename)) {
			echo "The file $filename exists";
		} else {
			echo "The file $filename does not exist";
		}
	}

	public function favorites() {

		$this->load->library('favlist');
		//$this->favlist->addFav(3);
		$data['favorites'] = getFavItemsResultSet(); //$this->_getFavItemsResultSet();
		$data['main_content'] = 'home/favorites_view';
		$this->load->view('includes/template', $data);
		
	}
	
	/* private function _getFavItemsResultSet() {
		
		$output = '';
		$this->load->library('favlist');
		
		$lists = ($this->favlist->readFav() == '') ? array() : explode(",", $this->favlist->readFav());

		if(count($lists) > 0) {
			foreach ($lists as $lst) {
				$output .= sprintf(" lst_id=%s", trim($lst));
				$output .= ' or ';
				
			}
			
			// preps some string
			preg_match('/[\w\s=]+(?=or)/', $output, $matches);
			$output = trim($matches[0]);
			$output =  sprintf("SELECT * FROM listing WHERE %s ORDER BY title ASC", $output);
			
			$this->load->model('mdldata');
			$params['querystring'] = $output;
			$this->mdldata->select($params);
			
			return $this->mdldata->_mRecords;
		
		} else {
			return null;
		}
		
	}
	 */
	
}
