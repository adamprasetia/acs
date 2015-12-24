<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_vendor extends CI_Model {
	var $tbl_name = 'vendor';
	function __construct(){
		parent::__construct();
	}
	function query(){
		$data[] = $this->search();
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
		$this->db->order_by('name','asc');
		$result = $this->db->get($this->tbl_name)->result();
		$data[''] = '-Vendor-';
		foreach($result as $r){
			$data[$r->id] = $r->name;
		}
		return $data;
	}
	function order(){
		$order_column = ($this->input->get('order_column')<>''?$this->input->get('order_column'):'id');
		$order_type = ($this->input->get('order_type')<>''?$this->input->get('order_type'):'asc');
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
			return $this->db->where('(name like "%'.$value.'%" or address like "%'.$value.'%" or tlp like "%'.$value.'%")');
		}		
	}	
}
