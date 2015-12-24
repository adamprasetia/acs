<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_report_calculate extends CI_Model {
	var $tbl_name = 'individual';
	function __construct(){
		parent::__construct();
	}
	function city(){
		$this->filter();
		$this->db->select('count(*) as `atot`');
		$this->db->select_sum('if(city = "BANDUNG",1,0)','aban');
		$this->db->select_sum('if(city like "%JAKARTA%",1,0)','ajak');
		$this->db->select_sum('if(city = "MEDAN",1,0)','amed');
		$this->db->select_sum('if(city = "PALEMBANG",1,0)','apal');
		$this->db->select_sum('if(city = "SURABAYA",1,0)','asur');
		$this->db->select_sum('if(city = "YOGYAKARTA",1,0)','ayog');
		$this->db->select_sum('if(city = "PADANG",1,0)','apad');
		$this->db->select_sum('if(city = "LAMPUNG",1,0)','alam');
		$this->db->select_sum('if(city = "SEMARANG",1,0)','asem');
		$this->db->select_sum('if(city = "DENPASAR",1,0)','aden');
		$this->db->select_sum('if(city = "MAKASSAR",1,0)','amak');
		$this->db->select_sum('if(city not like "%JAKARTA%" and city not in("BANDUNG","MEDAN","PALEMBANG","SURABAYA","YOGYAKARTA","PADANG","LAMPUNG","SEMARANG","DENPASAR","MAKASSAR"),1,0)','aoth');
		return $this->db->get($this->tbl_name);			
	}
	function city_age(){
		$this->filter();
		$this->db->select(
			array('city'
				,'count(city) as count'
				,'sum(if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 < 18,1,0)) as ank'
				,'sum(if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 18 and 24,1,0)) as rem'
				,'sum(if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 25 and 29,1,0)) as dew1'
				,'sum(if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 30 and 34,1,0)) as dew2'
				,'sum(if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 35 and 40,1,0)) as dew3'
				,'sum(if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 > 40,1,0)) as tua'
				,'sum(if(dob="0000-00-00" or dob="",1,0)) as oth'
			)
		);
		$this->db->group_by('city');
		$this->db->order_by('city','asc');
		return $this->db->get($this->tbl_name);
	}
	function brand(){
		$this->filter();
		$this->db->select('count(*) as `atot`');
		$this->db->select_sum('if(brand like "%A MILD%",1,0)','aaml');
		$this->db->select_sum('if(brand like "%AVOLUTION%",1,0)','aavo');
		$this->db->select_sum('if(brand like "%DJARUM%",1,0)','adja');
		$this->db->select_sum('if(brand like "%DUNHILL%",1,0)','adun');
		$this->db->select_sum('if(brand like "%GUDANG GARAM%",1,0)','agdg');
		$this->db->select_sum('if(brand like "L.A%" or brand like "LA%",1,0)','ala');
		$this->db->select_sum('if(brand not like "%A MILD%" and brand not like "%AVOLUTION%" and brand not like "%DJARUM%" and brand not like "%DUNHILL%" and brand not like "%GUDANG GARAM%" and brand not like "L.A%" and brand not like "LA%",1,0)','aoth');
		return $this->db->get($this->tbl_name);					
	}
	function age(){
		$this->filter();
		$this->db->select('count(*) as `atot`');
		$this->db->select_sum('if(dob="0000-00-00" or dob="",1,0)','aoth');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 < 18,1,0)','aank');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 18 and 24,1,0)','arem');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 25 and 29,1,0)','adew1');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 30 and 34,1,0)','adew2');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 35 and 40,1,0)','adew3');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0>40,1,0)','atua');
		return $this->db->get($this->tbl_name);	
	}
	function sba(){
		$this->filter();
		$this->db->select(array('sba_name','sba.city'));
		$this->db->select('count(*) as `count`');
		$this->db->group_by('sba_name');
		$this->db->order_by('city','asc');
		$this->db->order_by('sba_name','asc');
		$this->db->join('sba','individual.source_user=sba.email','left');
		return $this->db->get($this->tbl_name);	
	}
	function week(){
		$this->filter();
		$this->filter_week();
		$this->db->select(array('upload_date'));
		$this->db->select('count(*) as `count`');
		return $this->db->get($this->tbl_name);	
	}
	function field($field){
		$this->filter();
		$this->db->select($field.',count('.$field.') as `count`');
		$order_column = ($this->input->get('order_column')<>''?$this->input->get('order_column'):$field);
		$order_type = ($this->input->get('order_type')<>''?$this->input->get('order_type'):'asc');
		$this->db->order_by($order_column,$order_type);
		$this->db->group_by($field);
		return $this->db->get($this->tbl_name);			
	}
	function where_date($id){
		$from = $this->input->get($id.'_from');
		$to = $this->input->get($id.'_to');
		$data = '';
		if($from <> '' && $to <> ''){
			$data[] = $this->db->where($id.' >=',format_tanggal_barat($from));
			$data[] = $this->db->where($id.' <=',format_tanggal_barat($to));
		}		
		return $data;
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
	function filter(){
		$data = '';
		$data[] = $this->where('campaign_id');
		$data[] = $this->where('sex');
		$data[] = $this->where('source_type');
		$data[] = $this->where_date('survey_date');
		$data[] = $this->where_date('upload_date');
		$data[] = $this->where_date('entry_date');
		$data[] = $this->where_date('verifikasi_date');
		$data[] = $this->where('status_verifikasi');
		return $data;
	}
	function filter_week(){
		$value = $this->input->get('week');
		if($value <> ''){
			return $this->db->group_by(array('yearweek(upload_date+interval '.$value.' day)'));
		}	
	}

}
