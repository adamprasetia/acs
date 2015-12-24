<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_barang_masuk extends CI_Model {
	var $tbl_name = 'barang_masuk';
	function __construct(){
		parent::__construct();
	}
	function query(){
		$data[] = $this->search();
		$data[] = $this->where('campaign_id');
		$data[] = $this->where_date('tanggal','tanggal');
		$data[] = $this->db->select(array('barang_masuk.id as id','barang.name as barang_name','tanggal','banyak','vendor.name as vendor_name','operator','keterangan'));
		$data[] = $this->db->join('vendor','barang_masuk.vendor_id=vendor.id','left');
		$data[] = $this->db->join('barang','barang_masuk.barang_id=barang.id','left');
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
	function banyak($id){
		$this->db->select_sum('banyak','banyak');
		$this->db->where('barang_id',$id);
		return $this->db->get($this->tbl_name);	
	}
	function order(){
		$order_column = ($this->input->get('order_column')<>''?$this->input->get('order_column'):'id');
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
			return $this->db->where('(barang.name like "%'.$value.'%" or vendor.name like "%'.$value.'%")');
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
