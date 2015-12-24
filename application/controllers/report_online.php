<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_online extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_campaign');
		$this->load->model('mdl_individual');
		$this->load->model('mdl_report_online');
		$this->load->library('lib_report_online');
		$this->load->library('lib_export_online');
	}
	function index(){
		$page = ($this->input->get('page')<>''?$this->input->get('page'):'day');
		$data['heading'] = $this->heading();
		$data['breadcrumb'] = 'report_online/filter'.$this->_filter();
		$data['title'] = 'ACS - Online Report';
		$data['action'] = 'report_online/search'.$this->_filter();
		$data['export_btn'] = anchor('report_online/export'.$this->_filter(),'<span class="glyphicon glyphicon-export"></span> Export Excel 2007',array('class'=>'btn btn-primary btn-sm'));
		
		if($page=='day'){
			$data['table'] = $this->lib_report_online->day();
		}else if($page=='week'){
			$data['table'] = $this->lib_report_online->week();
		}else if($page=='sex'){
			$data['table'] = $this->lib_report_online->sex();
		}else if($page=='city_gap'){
			$data['table'] = $this->lib_report_online->city_gap();
		}else if($page=='brand_gap'){
			$data['table'] = $this->lib_report_online->brand_gap();
		}else if($page=='brand_umild'){
			$data['table'] = $this->lib_report_online->brand_umild();
		}else if($page=='age_gap'){
			$data['table'] = $this->lib_report_online->age_gap();
		}else if($page=='age_umild'){
			$data['table'] = $this->lib_report_online->age_umild();
		}
		
		$this->template->display('report_online',$data);
	}
	function heading(){
		$data = '<ul class="nav nav-tabs">';
		$data .= '<li role="presentation" class="'.($this->input->get('page')=='day' || $this->input->get('page')==''?"active":"").'">'.anchor('report_online'.$this->_filter(array('page'=>'day')),'Day').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('page')=='week'?"active":"").'">'.anchor('report_online'.$this->_filter(array('page'=>'week')),'Week').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('page')=='sex'?"active":"").'">'.anchor('report_online'.$this->_filter(array('page'=>'sex')),'Sex').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('page')=='city_gap'?"active":"").'">'.anchor('report_online'.$this->_filter(array('page'=>'city_gap')),'City GAP/MOVE').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('page')=='brand_gap'?"active":"").'">'.anchor('report_online'.$this->_filter(array('page'=>'brand_gap')),'Brand GAP/MOVE').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('page')=='brand_umild'?"active":"").'">'.anchor('report_online'.$this->_filter(array('page'=>'brand_umild')),'Brand U Mild').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('page')=='age_gap'?"active":"").'">'.anchor('report_online'.$this->_filter(array('page'=>'age_gap')),'Age GAP/MOVE').'</li>';
		$data .= '<li role="presentation" class="'.($this->input->get('page')=='age_umild'?"active":"").'">'.anchor('report_online'.$this->_filter(array('page'=>'age_umild')),'Age U Mild').'</li>';
		$data .= '</ul>';
		return $data;
	}
	function search(){
		$data = array(
			'campaign_id'=>$this->input->post('campaign_id')
			,'entry_date_from'=>$this->input->post('entry_date_from')
			,'entry_date_to'=>$this->input->post('entry_date_to')
			,'week'=>$this->input->post('week')			
		);
		redirect('report_online'.$this->_filter($data));
	}
	function filter(){
		$this->form_validation->set_rules('campaign_id','Campaign','trim');
		if($this->form_validation->run()===false){
			$data['title'] = 'ACS - Online Report';
			$data['action'] = form_open('report_online/filter'.$this->_filter());
			$this->template->display('report_online_filter',$data);			
		}else{
			$data = array(
				'campaign_id'=>$this->input->post('campaign_id')
				,'entry_date_from'=>$this->input->post('entry_date_from')
				,'entry_date_to'=>$this->input->post('entry_date_to')
				,'week'=>$this->input->post('week')
			);
			redirect('report_online'.$this->_filter($data));			
		}
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array(
			'campaign_id'=>0
			,'entry_date_from'=>0
			,'entry_date_to'=>0
			,'page'=>0
			,'week'=>0
		);
		$result = array_diff_key($data,$add);
		foreach($result as $r => $val){			
			if($this->input->get($r)<>''){
				$str .="&$r=".$this->input->get($r);
			}
		}
		if($add<>''){
			foreach($add as $r => $val){
				$str .="&$r=".$val;
			}
		}
		return $str;
	}
	function export(){
		$page = ($this->input->get('page')<>''?$this->input->get('page'):'day');
		if($page=='day'){
			$this->lib_export_online->day();
		}else if($page=='week'){
			$this->lib_export_online->week();
		}else if($page=='sex'){
			$this->lib_export_online->sex();
		}else if($page=='city_gap'){
			$this->lib_export_online->city_gap();
		}else if($page=='city_gap'){
			$this->lib_export_online->city_gap();
		}else if($page=='brand_gap'){
			$this->lib_export_online->brand_gap();
		}else if($page=='brand_umild'){
			$this->lib_export_online->brand_umild();
		}else if($page=='age_gap'){
			$this->lib_export_online->age_gap();
		}else if($page=='age_umild'){
			$this->lib_export_online->age_umild();
		}		
	}
}