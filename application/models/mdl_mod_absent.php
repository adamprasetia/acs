<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_mod_absent extends CI_Model {
	var $tbl_name = 'mod_absen';
	function __construct(){
		parent::__construct();
	}
	function get($date,$user){
		$this->db->where('absen_date',$date);
		$this->db->where('user_code',$user);
		$result = $this->db->get($this->tbl_name);	
		if($result->num_rows()>0){
			$data = $result->row()->absen_type;
		}else{
			$data = '';	
		}
		return $data;
	}
	function delete(){
		$date_from = format_tanggal_barat($this->input->get("date_from"));
		$date_to = format_tanggal_barat($this->input->get("date_to"));
		$this->db->where('absen_date >= ',$date_from);
		$this->db->where('absen_date <= ',$date_to);
		$this->db->delete($this->tbl_name);		
	}
	function set($data){
		$this->delete();
		$this->db->insert_batch($this->tbl_name,$data);
	}	
	function fee($date,$user,$type){
		$this->db->where('absen_date',$date);
		$this->db->where('user_code',$user);
		$this->db->where('absen_type',$type);
		return $this->db->count_all_results($this->tbl_name);		
	}
	function fee_senior($date,$user){
		$this->db->where('absen_date',$date);
		$this->db->where('user_code',$user);
		$result = $this->db->get($this->tbl_name);	
		if($result->num_rows()>0){
			$data = '1';
		}else{
			$data = '0';	
		}
		return $data;
	}
}
