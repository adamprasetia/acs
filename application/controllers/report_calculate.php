<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_calculate extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_campaign');
		$this->load->model('mdl_individual');
		$this->load->model('mdl_report_calculate');
		$this->load->library('lib_report_calculate');
		$this->load->library('lib_export_calculate');
	}
	function heading(){
		$data = '<ul class="nav nav-tabs">';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='status_verifikasi'||$this->input->get('key')==''?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'status_verifikasi','name'=>'Status Verification')),'Status Verification').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='city'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'city','name'=>'City')),'City').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='city_group'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'city_group')),'City Group').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='city_age'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'city_age')),'City Age').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='brand'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'brand','name'=>'Brand')),'Brand').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='brand_group'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'brand_group')),'Brand Group').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='source_type'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'source_type','name'=>'Source Type')),'Source Type').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='source_user'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'source_user','name'=>'Source User')),'Source User').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='sex'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'sex','name'=>'Sex')),'Sex').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='age'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'age')),'Age').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='sba'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'sba')),'SBA').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='upload_date'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'upload_date','name'=>'Upload Date')),'Upload Date').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='entry_date'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'entry_date','name'=>'Entry Date')),'Entry Date').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('key')=='week'?"active":"").'">'.anchor('report_calculate'.$this->_filter(array('key'=>'week','name'=>'week')),'Week by Upload Date').'</li>';
		$data .= '</ul>';
		return $data;
	}
	function index(){
		$data['title'] = 'ACS - Calculate Report';
		$data['heading'] = $this->heading();
		$data['breadcrumb'] = 'report_calculate/filter'.$this->_filter();
		$data['export_btn'] = anchor('report_calculate/export'.$this->_filter(),'<span class="glyphicon glyphicon-export"></span> Export Excel 2007',array('class'=>'btn btn-primary btn-sm'));
		
		$key = ($this->input->get('key')?$this->input->get('key'):'status_verifikasi');
		$name = ($this->input->get('name')?$this->input->get('name'):'Status Verification');
		
		$data['chart'] = '';
		if($key=='city_group'){
			$data['table'] = $this->lib_report_calculate->city();
		}else if($key=='city_age'){
			$data['table'] = $this->lib_report_calculate->city_age();
		}else if($key=='brand_group'){
			$data['table'] = $this->lib_report_calculate->brand();
		}else if($key=='age'){
			$data['table'] = $this->lib_report_calculate->age();
		}else if($key=='sba'){
			$data['table'] = $this->lib_report_calculate->sba();
		}else if($key=='week'){
			$data['table'] = $this->lib_report_calculate->week();
		}else{
			$data['table'] = $this->lib_report_calculate->calculate($key,$name);
		}
		
		$this->template->display('report_calculate',$data);
	}
	function search(){
		$data = array(
			'search'=>$this->input->post('search')
			,'limit'=>$this->input->post('limit')
			,'campaign_id'=>$this->input->post('campaign_id')
			,'offset'=>0
		);
		redirect('individual'.$this->_filter($data));
	}
	function filter(){
		$this->form_validation->set_rules('campaign_id','Campaign','trim');
		if($this->form_validation->run()===false){
			$data['title'] = 'ACS - Calculate Report';
			$data['action'] = form_open('report_calculate/filter'.$this->_filter());
			$data['breadcrumb'] = 'individual'.$this->_filter();
			$this->template->display('report_calculate_filter',$data);			
		}else{
			$data = array(
				'campaign_id'=>$this->input->post('campaign_id')
				,'sex'=>$this->input->post('sex')
				,'source_type'=>$this->input->post('source_type')
				,'survey_date_from'=>$this->input->post('survey_date_from')
				,'survey_date_to'=>$this->input->post('survey_date_to')
				,'upload_date_from'=>$this->input->post('upload_date_from')
				,'upload_date_to'=>$this->input->post('upload_date_to')
				,'entry_date_from'=>$this->input->post('entry_date_from')
				,'entry_date_to'=>$this->input->post('entry_date_to')
				,'verifikasi_date_from'=>$this->input->post('verifikasi_date_from')
				,'verifikasi_date_to'=>$this->input->post('verifikasi_date_to')
				,'status_verifikasi'=>$this->input->post('status_verifikasi')
				,'week'=>$this->input->post('week')
				,'offset'=>0
			);
			redirect('report_calculate'.$this->_filter($data));			
		}
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array(
			'order_column'=>0
			,'order_type'=>0
			,'campaign_id'=>0
			,'sex'=>0
			,'source_type'=>0
			,'survey_date_from'=>0
			,'survey_date_to'=>0
			,'upload_date_from'=>0
			,'upload_date_to'=>0
			,'entry_date_from'=>0
			,'entry_date_to'=>0
			,'verifikasi_date_from'=>0
			,'verifikasi_date_to'=>0
			,'status_verifikasi'=>0
			,'week'=>0
			,'key'=>0
			,'name'=>0
		);
		$result = array_diff_key($data,$add);
		foreach($result as $r => $val){			
			if($this->input->get($r)<>''){
				$str .="&$r=".$this->input->get($r);
			}
		}
		if($add<>''){
			foreach($add as $r => $val){
				if($val<>''){
					$str .="&$r=".$val;
				}
			}
		}
		return $str;
	}
	function export(){
		$key = ($this->input->get('key')?$this->input->get('key'):'status_verifikasi');
		$name = ($this->input->get('name')?$this->input->get('name'):'Status Verification');
		if($key=='city_group'){
			$this->lib_export_calculate->city();
		}else if($key=='city_age'){
			$this->lib_export_calculate->city_age();
		}else if($key=='brand_group'){
			$this->lib_export_calculate->brand();
		}else if($key=='age'){
			$this->lib_export_calculate->age();
		}else if($key=='sba'){
			$this->lib_export_calculate->sba();
		}else if($key=='week'){
			$this->lib_export_calculate->week();
		}else{
			$this->lib_export_calculate->calculate($key,$name);
		}
		
	}
}