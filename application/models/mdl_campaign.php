<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_campaign extends CI_Model {
	var $tbl_name = 'campaign';
	function __construct(){
		parent::__construct();
	}
	function query(){
		$data[] = $this->search();
		$data[] = $this->where('status');
		return $data;
	}
	function get(){
		$this->query();
		$this->order();
		$this->limit();
		return $this->db->get($this->tbl_name);
	}	
	function export(){
		$this->query();
		$this->order();
		return $this->db->get($this->tbl_name);
	}	
	function get_from_field($field,$val){
		$this->db->where($field,$val);
		return $this->db->get($this->tbl_name);	
	}
	function count_all(){
		$this->query();
		return $this->db->get($this->tbl_name)->num_rows();
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
	function dropdown(){
		$this->db->order_by('id','asc');
		$result = $this->db->get($this->tbl_name)->result();
		$data[''] = '-Campaign-';
		foreach($result as $r){
			$data[$r->id] = $r->name;
		}
		return $data;
	}
	function query_builder(){
		$this->db->order_by('id','asc');
		$result = $this->db->get($this->tbl_name)->result();
		$data = array();
		foreach($result as $r){
			$data[$r->id] = $r->name;
		}
		return $data;
	}
	function order(){
		$order_column = ($this->input->get('order_column')<>''?$this->input->get('order_column'):'start');
		$order_type = ($this->input->get('order_type')<>''?$this->input->get('order_type'):'desc');
		return $this->db->order_by($order_column,$order_type);
	}
	function limit(){
		$limit = ($this->input->get('limit')<>''?$this->input->get('limit'):'10');
		$offset = ($this->input->get('offset')<>''?$this->input->get('offset'):'0');
		return $this->db->limit($limit,$offset);
	}
	function search(){
		$value = $this->input->get('search');
		if($value <> ''){
			return $this->db->where('(name like "%'.$value.'%" or brand like "%'.$value.'%")');
		}		
	}
	function where($id){
		$value = $this->input->get($id);
		if($value <> ''){
			return $this->db->where($id,$value);
		}		
	}
	function like($id){
		$value = $this->input->get($id);
		if($value <> ''){
			return $this->db->like($id,$value);
		}		
	}	
	function where_date($id,$field){
		$from = $this->input->get($id.'_from');
		$to = $this->input->get($id.'_to');
		$data = '';
		if($from <> '' && $to <> ''){
			$data[] = $this->db->where($field.' >=',format_tanggal_barat($from));
			$data[] = $this->db->where($field.' <=',format_tanggal_barat($to));
		}		
		return $data;
	}	
}
