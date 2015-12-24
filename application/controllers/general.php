<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	function sidebar_toggle(){
		$sidebar = $this->session->userdata('sidebar');
		if($sidebar=='0'){
			$this->session->set_userdata('sidebar','1');
		}else{
			$this->session->set_userdata('sidebar','0');
		}
	}
}
