<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_report_online extends CI_Model {
	var $tbl_name = 'individual';
	function __construct(){
		parent::__construct();
	}
	function day(){
		$this->filter();
		$this->db->select('entry_date');
		$this->db->select('count(*) as `count`');
		$this->db->select_sum('if(status_verifikasi="VERIFIED ONLINE",1,0)','vo');
		$this->db->select_sum('if(status_verifikasi="VERIFIED WEBMAIL",1,0)','vw');
		$this->db->select_sum('if(status_verifikasi="GIID COPY IS NOT LEGIBLE",1,0)','leg');
		$this->db->select_sum('if(status_verifikasi="GIID DOESNT MATCH",1,0)','mat');
		$this->db->select_sum('if(status_verifikasi="IMAGE IS NOT ID",1,0)','id');
		$this->db->select_sum('if(status_verifikasi="DID NOT ATTACH IMAGE",1,0)','img');
		$this->db->select_sum('if(status_verifikasi in ("GIID COPY IS NOT LEGIBLE","GIID DOESNT MATCH","IMAGE IS NOT ID","DID NOT ATTACH IMAGE"),1,0)','un');
		$this->db->order_by('entry_date','asc');
		$this->db->group_by('entry_date');
		return $this->db->get($this->tbl_name);	
	}
	function week(){
		$this->filter();
		$this->filter_week();
		$this->db->select('entry_date');
		$this->db->select('count(*) as `count`');
		$this->db->select_sum('if(status_verifikasi="VERIFIED ONLINE",1,0)','vo');
		$this->db->select_sum('if(status_verifikasi="VERIFIED WEBMAIL",1,0)','vw');
		$this->db->select_sum('if(status_verifikasi="GIID COPY IS NOT LEGIBLE",1,0)','leg');
		$this->db->select_sum('if(status_verifikasi="GIID DOESNT MATCH",1,0)','mat');
		$this->db->select_sum('if(status_verifikasi="IMAGE IS NOT ID",1,0)','id');
		$this->db->select_sum('if(status_verifikasi="DID NOT ATTACH IMAGE",1,0)','img');
		$this->db->select_sum('if(status_verifikasi in ("GIID COPY IS NOT LEGIBLE","GIID DOESNT MATCH","IMAGE IS NOT ID","DID NOT ATTACH IMAGE"),1,0)','un');
		$this->db->order_by('entry_date','asc');
		return $this->db->get($this->tbl_name);	
	}
	function sex(){
		$this->filter();
		$this->filter_week();
		$this->db->select('entry_date');
		$this->db->select('count(*) as `count`');
		$this->db->select_sum('if(sex="M",1,0)','m');
		$this->db->select_sum('if(sex="F",1,0)','f');
		$this->db->order_by('entry_date','asc');
		return $this->db->get($this->tbl_name);	
	}
	function city_gap(){
		$this->filter();
		$this->filter_week();
		$this->db->select('entry_date');
		$this->db->select('count(*) as `atot`');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL"),1,0)','vtot');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "BANDUNG",1,0)','vbdg');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city like "%JAKARTA%",1,0)','vjkt');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "MEDAN",1,0)','vmdn');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "PALEMBANG",1,0)','vplmbg');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "SURABAYA",1,0)','vsby');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "YOGYAKARTA",1,0)','vyogya');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "PADANG",1,0)','vpdg');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "LAMPUNG",1,0)','vlmpg');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "SEMARANG",1,0)','vsmg');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "DENPASAR",1,0)','vdps');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city = "MAKASSAR",1,0)','vmks');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and city not like "%JAKARTA%" and city not in("BANDUNG","MEDAN","PALEMBANG","SURABAYA","YOGYAKARTA","PADANG","LAMPUNG","SEMARANG","DENPASAR","MAKASSAR"),1,0)','voth');

		$this->db->select_sum('if(city = "BANDUNG",1,0)','abdg');
		$this->db->select_sum('if(city like "%JAKARTA%",1,0)','ajkt');
		$this->db->select_sum('if(city = "MEDAN",1,0)','amdn');
		$this->db->select_sum('if(city = "PALEMBANG",1,0)','aplmbg');
		$this->db->select_sum('if(city = "SURABAYA",1,0)','asby');
		$this->db->select_sum('if(city = "YOGYAKARTA",1,0)','ayogya');
		$this->db->select_sum('if(city = "PADANG",1,0)','apdg');
		$this->db->select_sum('if(city = "LAMPUNG",1,0)','almpg');
		$this->db->select_sum('if(city = "SEMARANG",1,0)','asmg');
		$this->db->select_sum('if(city = "DENPASAR",1,0)','adps');
		$this->db->select_sum('if(city = "MAKASSAR",1,0)','amks');
		$this->db->select_sum('if(city not like "%JAKARTA%" and city not in("BANDUNG","MEDAN","PALEMBANG","SURABAYA","YOGYAKARTA","PADANG","LAMPUNG","SEMARANG","DENPASAR","MAKASSAR"),1,0)','aoth');
		$this->db->order_by('entry_date','asc');
		return $this->db->get($this->tbl_name);	
	}
	function brand_gap(){
		$this->filter();
		$this->filter_week();
		$this->db->select('entry_date');
		$this->db->select('count(*) as `atot`');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL"),1,0)','vtot');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and brand like "%A MILD%",1,0)','vaml');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and brand like "%AVOLUTION%",1,0)','vavo');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and brand like "%DJARUM%",1,0)','vdja');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and brand like "%DUNHILL%",1,0)','vdun');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and brand like "%GUDANG GARAM%",1,0)','vgdg');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and (brand like "L.A%" or brand like "LA%"),1,0)','vla');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and brand not like "%A MILD%" and brand not like "%AVOLUTION%" and brand not like "%DJARUM%" and brand not like "%DUNHILL%" and brand not like "%GUDANG GARAM%" and brand not like "L.A%" and brand not like "LA%",1,0)','voth');

		$this->db->select_sum('if(brand like "%A MILD%",1,0)','aaml');
		$this->db->select_sum('if(brand like "%AVOLUTION%",1,0)','aavo');
		$this->db->select_sum('if(brand like "%DJARUM%",1,0)','adja');
		$this->db->select_sum('if(brand like "%DUNHILL%",1,0)','adun');
		$this->db->select_sum('if(brand like "%GUDANG GARAM%",1,0)','agdg');
		$this->db->select_sum('if(brand like "L.A%" or brand like "LA%",1,0)','ala');
		$this->db->select_sum('if(brand not like "%A MILD%" and brand not like "%AVOLUTION%" and brand not like "%DJARUM%" and brand not like "%DUNHILL%" and brand not like "%GUDANG GARAM%" and brand not like "L.A%" and brand not like "LA%",1,0)','aoth');
		$this->db->order_by('entry_date','asc');
		return $this->db->get($this->tbl_name);	
	}
	function brand_umild(){
		$this->filter();
		$this->filter_week();
		$this->db->select('entry_date');
		$this->db->select('count(*) as `tot`');
		$this->db->select_sum('if(brand like "U MILD%",1,0)','uml');
		$this->db->select_sum('if(brand like "A MILD%",1,0)','aml');
		$this->db->select_sum('if(brand like "AVOLUTION%",1,0)','avo');
		$this->db->select_sum('if(brand like "DJI SAM SOE%" and brand <> "DJI SAM SOE KRETEK MAGNUM",1,0)','dji');
		$this->db->select_sum('if(brand like "MARLBORO%",1,0)','mar');
		$this->db->select_sum('if(brand = "DJI SAM SOE KRETEK MAGNUM",1,0)','mag');
		$this->db->select_sum('if((brand like "L.A%" or brand like "LA%"),1,0)','la');
		$this->db->select_sum('if(brand like "GUDANG GARAM SURYA%",1,0)','sur');
		$this->db->select_sum('if(brand like "DJARUM SUPER%",1,0)','dja');
		$this->db->select_sum('if(brand like "GUDANG GARAM%" and brand not like "GUDANG GARAM SURYA%",1,0)','gud');
		$this->db->select_sum('if(brand not like "U MILD%" and brand not like "A MILD%" and brand not like "AVOLUTION%" and brand not like "DJI SAM SOE%" and brand not like "MARLBORO%" and brand not like "DJARUM SUPER%" and brand not like "GUDANG GARAM%" and brand not like "L.A%" and brand not like "LA%",1,0)','oth');		
		$this->db->order_by('entry_date','asc');
		return $this->db->get($this->tbl_name);	
	}
	function age_gap(){
		$this->filter();
		$this->filter_week();
		$this->db->select('entry_date');
		$this->db->select('count(*) as `atot`');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL"),1,0)','vtot');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 18 and 24,1,0)','vrem');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 25 and 29,1,0)','vdew');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0>29,1,0)','vtua');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 18 and 24,1,0)','arem');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 25 and 29,1,0)','adew');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0>29,1,0)','atua');
		$this->db->order_by('entry_date','asc');
		return $this->db->get($this->tbl_name);	
	}	
	function age_umild(){
		$this->filter();
		$this->filter_week();
		$this->db->select('entry_date');
		$this->db->select('count(*) as `atot`');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL"),1,0)','vtot');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 18 and 24,1,0)','vrem');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 25 and 29,1,0)','vdew1');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 30 and 34,1,0)','vdew2');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 35 and 40,1,0)','vdew3');
		$this->db->select_sum('if(status_verifikasi in ("VERIFIED ONLINE","VERIFIED WEBMAIL") and DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0>40,1,0)','vtua');
		
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 18 and 24,1,0)','arem');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 25 and 29,1,0)','adew1');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 30 and 34,1,0)','adew2');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0 between 35 and 40,1,0)','adew3');
		$this->db->select_sum('if(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), \'%Y\')+0>40,1,0)','atua');
		$this->db->order_by('entry_date','asc');
		return $this->db->get($this->tbl_name);	
	}	
	function filter(){
		$data = '';
		$data[] = $this->where('campaign_id');
		$data[] = $this->where_date('entry_date');
		$data[] = $this->db->where('source_type','online');
		return $data;
	}
	function filter_week(){
		$value = $this->input->get('week');
		if($value <> ''){
			return $this->db->group_by(array('yearweek(entry_date+interval '.$value.' day)'));
		}	
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
}
