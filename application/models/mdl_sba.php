<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_sba extends CI_Model {
	var $tbl_name = 'sba';
	function __construct(){
		parent::__construct();
	}
	function get_sba_name($email){
		$this->db->where('email',$email);
		$row = $this->db->get($this->tbl_name);	
		if($row->num_rows()>0){
			$data = $row->row()->sba_name;
		}else{
			$data = $email;
		}
		return $data;
	}
}
