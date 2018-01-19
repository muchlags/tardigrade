<?php if ( ! defined('BASEPATH')) exit('Unauthorized file access not allowed!');
class sample extends Page{

	function __construct(){

		// $this->open_head();
		// $data['current'] = $_SESSION['location'];
		// $this->close_head();
		// $this->load_view(array('presets/login'));
		// $this->end();
		
		$this->load_view(array('sample'));

	}
	
}