<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_chat extends CI_Model {
	var $tbl_name = 'chat';
	function __construct(){
		parent::__construct();
	}
	function get(){
		$this->db->select(array('chat.id','fullname','date','chat','photo'));
		$this->db->order_by('date','desc');
		$this->db->join('user','chat.username=user.username','left');
		return $this->db->get($this->tbl_name,20,0);	
	}
	function get_from_field($field,$val){
		$this->db->where($field,$val);
		$this->db->join('user','chat.username=user.username','left');
		return $this->db->get($this->tbl_name);	
	}
	function add($data){
		$id = $this->db->insert($this->tbl_name,$data);
		return $this->db->insert_id();
	}
	function edit($id,$data){
		$this->db->where('id',$id);
		$this->db->update($this->tbl_name,$data);
	}
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete($this->tbl_name);
	}
	function count_all(){
		return $this->db->count_all_results($this->tbl_name);
	}
}
