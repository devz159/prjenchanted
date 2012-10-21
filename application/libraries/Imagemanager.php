<?php  if(!defined("BASEPATH")) exit("No direct script access allowed");
 
class Imagemanager {
	
	private $CI;
	
	public function __construct() {
// 		echo 'Initializing Imagemanager Class...<br />';
		
		// initializes some member variables
		$this->CI =& get_instance();
		
	}
	
	public function manage($images, $source = './uploaded/', $destination = './ads/test/') {
	
		// assures that there are trailing forward slashes on the path	
		(preg_match('/(?<=[^\/])\/$/', $source) ? $source : $source . '/');		
		(preg_match('/(?<=[^\/])\/$/', $destination) ? $destination : $destination . '/');

// 		on_watch($source . ' - ' . $destination, FALSE);
// 		on_watch($images);
		
		if($images == '')
			return FALSE;
			
		if(null == $this->_convertToArray($images))
			return FALSE;
		else
			$images = $this->_convertToArray($images);
				
		foreach($images as $img) {
			if(! $this->_transfer_file($img, $source, $destination))
				return FALSE;
		}
		
		return TRUE;
	}
	
	public function deleteImages($images, $source = './ads/') {
		
		// assures that there are trailing forward slashes on the path
		(preg_match('/(?<=[^\/])\/$/', $source) ? $source : $source . '/');
		
		
		if($images == '')
			return FALSE;
			
		if(null == $this->_convertToArray($images))
			return FALSE;
		else
			$images = $this->_convertToArray($images);
		
		foreach($images as $img) {
			if(! $this->_delete_images($img, $source))
				return FALSE;
		}
		
		return TRUE;
	}
	
	private function _file_exists($file) {				
				
		if(! preg_match('/[\w\/\.-_,]+\.\w{1,4}\b/', $file))
			return FALSE;
		
		// $file = './path/to/foo.txt';
		if (! file_exists($file)) {
			return FALSE;
		}
		
		return TRUE;
	}
	
	private function _directory_exists($dir) {
		
		if(preg_match('/[\w\/\.-_,]+\.\w{1,4}\b/', $dir))
			return FALSE;
		
		if(! file_exists($dir))
			return FALSE;
		
		return TRUE;
	}
	
	private function _directory_writeable($dir) {
		
		if (! is_writable($dir))
			return FALSE;
		
		return TRUE;
	}
	
	private function _delete_images($file, $source) {
		
		// checks if file exists
		if(! $this->_file_exists($source.$file))
			return FALSE;
		
		// deletes large and thumbs images
		unlink($source.$file);
		unlink($source . 'thumbs/' . $file);
		
		return TRUE;
	}
	
	private function _transfer_file($file,$source, $destination) {
		
		// checks if file exists
		if(! $this->_file_exists($source.$file))
			return FALSE;
		
		// checks if destination folders are existing
		if(! $this->_directory_exists($destination))
			mkdir($destination, 0777);
		
		// checks if the destination folders are writeable
		if(! $this->_directory_writeable($destination))
			return FALSE;
		
		// transfers file into destination folder/s
// 		if(!copy($source . $file, $destination . $file)) // @neerevisit: maybe not this is not needed anymore
// 			return FALSE;
		$this->_resize_imageX($file, $source, $destination, 244, 222);
		
		// creates thumbnails of the image
		$this->_resize_image($file, $source, $destination);
		
		
		// deletes the original file from the source folder/s
		if(! unlink($source.$file))
			return FALSE;	
			
		return TRUE;
	}
	
	private function _convertToArray($str) {
		
		$arr = preg_split('/,/', $str, -1, PREG_SPLIT_NO_EMPTY);
		
		if(empty($arr))
			return null;
		
		return $arr;
	}
	
	private function _resize_image($img, $source, $destination) {
		
		// loads the image manipulation library
		$this->CI->load->library('image_lib');
		
		// creates thumbs folder if it doesn't exists yet
		if(! $this->_directory_exists($destination.'thumbs'))
			mkdir($destination.'thumbs', 0777);
		
// 		on_watch($img);
		
		// resizes the image into smaller version (thumbnails)
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source . $img;
		$config['new_image'] = $destination . 'thumbs/' . $img;
		$config['create_thumb'] = TRUE;
		$config['thumb_marker'] = '';
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 96;
		$config['height'] = 78;
			
		$this->CI->image_lib->initialize($config);
		
		$this->CI->image_lib->resize();
		
		return TRUE;
	}
	
	private function _resize_imageX($img, $source, $destination, $width = 96, $height = 78, $thumbs = FALSE) {
	
		// loads the image manipulation library
		$this->CI->load->library('image_lib');
	
		// creates thumbs folder if it doesn't exists yet
		if($thumbs) {
			if(! $this->_directory_exists($destination.'thumbs'))
				mkdir($destination.'thumbs', 0777);
		}
	
		// 		on_watch($img);
	
		// resizes the image into smaller version (thumbnails)
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source . $img;
		$config['new_image'] = $destination . ($thumbs ? 'thumbs/' . $img : $img);
		$config['create_thumb'] = TRUE;
		$config['thumb_marker'] = '';
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
			
		$this->CI->image_lib->initialize($config);
	
		$this->CI->image_lib->resize();
	
		return TRUE;
	}
	
	
}