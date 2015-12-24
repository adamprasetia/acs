<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_individual extends CI_Model {
	var $tbl_name = 'individual';
	function __construct(){
		parent::__construct();
	}
	function query(){
		$data = '';
		$data[] = $this->search();
		$data[] = $this->where('campaign_id');
		$data[] = $this->where('id');
		$data[] = $this->where('mop_id');
		$data[] = $this->like('firstname');
		$data[] = $this->like('lastname');
		$data[] = $this->like('nickname');
		$data[] = $this->where('sex');
		$data[] = $this->where_date('dob','dob');
		$data[] = $this->where('id_type');
		$data[] = $this->where('id_number');
		$data[] = $this->where('tlp');
		$data[] = $this->where('email');
		$data[] = $this->like('fb');
		$data[] = $this->like('tw');
		$data[] = $this->like('address');
		$data[] = $this->where('city');
		$data[] = $this->where('pos_code');
		$data[] = $this->where('brand');
		$data[] = $this->where('brand_');
		$data[] = $this->where('source_type');
		$data[] = $this->where('source_user');
		$data[] = $this->where_date('survey_date','survey_date');
		$data[] = $this->where_date('upload_date','upload_date');
		$data[] = $this->where_date('entry_date','entry_date');
		$data[] = $this->where_date('verifikasi_date','verifikasi_date');
		$data[] = $this->where('referred');
		$data[] = $this->where('drn_number');
		$data[] = $this->where('status_verifikasi');
		return $data;
	}
	function get(){
		$this->query();
		$this->order();
		$this->limit();
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
	function export(){
		$this->query();
		$this->order();
		return $this->db->get($this->tbl_name);
	}
	function add($data){
		$id = $this->db->insert($this->tbl_name,$data);
		return $this->db->insert_id();
	}
	function import($data){
		$this->db->insert_batch($this->tbl_name,$data);
	}
	function edit($id,$data){
		$this->db->where('id',$id);
		$this->db->update($this->tbl_name,$data);
	}
	function update($id,$data){
		$this->db->update_batch($this->tbl_name,$data,$id);
	}
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete($this->tbl_name);
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
			return $this->db->where('(firstname like "%'.$value.'%" or lastname like "%'.$value.'%" or id_number like "%'.$value.'%" or email like "%'.$value.'%")');
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
	function autocomplete($id){
		$this->db->select($id);
		$this->db->group_by($id);
		$this->db->order_by($id,'asc');
		$result = $this->db->get($this->tbl_name)->result_array();	
		foreach($result as $r){
			$data[] = $r[$id];
		}
		return $data;
	}	
	function dropdown($id){
		$this->db->select($id);
		$this->db->group_by($id);
		$this->db->order_by($id,'asc');
		$result = $this->db->get($this->tbl_name)->result_array();	
		$data[''] = '';
		foreach($result as $r){
			$data[$r[$id]] = $r[$id];
		}
		return $data;
	}	

}
