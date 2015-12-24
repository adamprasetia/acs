<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_barang extends CI_Model {
	var $tbl_name = 'barang';
	function __construct(){
		parent::__construct();
	}
	function query(){
		$data[] = $this->db->select(array('barang.id','barang.name','barang.campaign_id','campaign.name as campaign_name','campaign.brand as campaign_brand'));
		$data[] = $this->db->join('campaign','barang.campaign_id=campaign.id','left');
		$data[] = $this->search();
		$data[] = $this->where('campaign_id');
		return $data;
	}
	function get(){
		$this->query();
		$this->order();
		$this->limit();		
		return $this->db->get($this->tbl_name);	
	}
	function export($order_column,$order_type){
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
		$data[''] = '-Barang-';
		foreach($result as $r){
			$data[$r->id] = $r->name;
		}
		return $data;
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
			return $this->db->where('(barang.name like "%'.$value.'%" or campaign.name like "%'.$value.'%" or campaign.brand like "%'.$value.'%")');
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
