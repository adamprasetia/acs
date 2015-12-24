<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_absent extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('mod_helper');
		$this->load->model('mdl_mod_absent');
	}
	function index(){
		$data['title'] = 'ACS - Absent';
		$data['heading'] = 'Absent';
		$data['action'] = 'mod_absent/search'.$this->_filter();
		$data['action_update'] = 'mod_absent/update'.$this->_filter();
		$data['clear_btn'] = anchor('mod_absent/delete'.$this->_filter(),'<span class="glyphicon glyphicon-trash"></span> Clear',array('class'=>'btn btn-sm btn-danger','onclick'=>"return confirm('are you sure')"));
		$data['auto_btn'] = anchor('mod_absent/update_auto'.$this->_filter(),'<span class="glyphicon glyphicon-edit"></span> Auto Absent',array('class'=>'btn btn-sm btn-warning','onclick'=>"return confirm('are you sure')"));
		$data['fee_btn'] = anchor('mod_fee'.$this->_filter(),'<span class="glyphicon glyphicon-print"></span> Fee Weekly',array('class'=>'btn btn-sm btn-default'));
		$data['fee_senior_btn'] = anchor('mod_fee/fee_senior'.$this->_filter(),'<span class="glyphicon glyphicon-print"></span> Fee Monthly',array('class'=>'btn btn-sm btn-default'));
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		if($date_from <> '' && $date_to <> ''){
			$this->table->set_template(tbl_tmp());
			$from = date_create(format_tanggal_barat($date_from));
			$to = date_create(format_tanggal_barat($date_to));
			$head[] = 'No';
			$head[] = 'Moderator';
			while($from <= $to){
				$head[] = get_nama_hari(date_format($from,'N')).'<br/>'.date_format($from,'d/m/Y');
				date_add($from, date_interval_create_from_date_string('1 days'));
			}	
			$this->table->set_heading($head);
			
			$result = moderator();
			$i=1;
			foreach($result as $r){
				$from = date_create(format_tanggal_barat($date_from));
				$to = date_create(format_tanggal_barat($date_to));
				$row[] = $i++;
				$row[] = $r[1];
				$j=1;
				while($from <= $to){
					$value = $this->mdl_mod_absent->get(date_format($from,'Y-m-d'),$r[0]);
					$row[] = form_dropdown($r[0].'_'.date_format($from,'dmy'),array(''=>'','SIANG'=>'SIANG','MALAM'=>'MALAM','TRAINING'=>'TRAINING'),$value);
					date_add($from, date_interval_create_from_date_string('1 days'));
					$j++;
				}	
				$this->table->add_row($row);
				unset($row);
				if($i==7){
					$this->table->add_row(array('data'=>'BEAT Moderator','colspan'=>$j+1,'class'=>'text-center'));
				}
				if($i==10){
					$this->table->add_row(array('data'=>'MOVE Moderator','colspan'=>$j+1,'class'=>'text-center'));
				}

			}
		}
		$data['table'] = $this->table->generate();
		$this->template->display('mod_absent',$data);
	}
	function update(){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		if($date_from <> '' && $date_to <> ''){
			$result = moderator();
			foreach($result as $r){
				$from = date_create(format_tanggal_barat($date_from));
				$to = date_create(format_tanggal_barat($date_to));
				while($from <= $to){
					$value = $this->input->post($r[0].'_'.date_format($from,'dmy'));
					if($value <> ''){
						$data[] = array(
							'user_code'=>$r[0]
							,'absen_date'=>date_format($from,'Y-m-d')
							,'absen_type'=>$value
						);
					}
					date_add($from, date_interval_create_from_date_string('1 days'));
				}	
			}
			$this->mdl_mod_absent->set($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete!!!</div>');
		}else{
			$this->session->set_flashdata('alert','<div class="alert alert-danger">Date Empty!!!</div>');
		}
		redirect('mod_absent'.$this->_filter());		
	}
	function update_auto(){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		if($date_from <> '' && $date_to <> ''){
			$from = date_create(format_tanggal_barat($date_from));
			$to = date_create(format_tanggal_barat($date_to));
			while($from <= $to){
				$user_code = get_moderator(siang(date_format($from,'Y-m-d')));
				if($user_code <> ''){
					$data[] = array(
						'user_code'=>$user_code[0]
						,'absen_date'=>date_format($from,'Y-m-d')
						,'absen_type'=>'SIANG'
					);
				}
				$user_code = get_moderator(siang2(date_format($from,'Y-m-d')));
				if($user_code <> ''){
					$data[] = array(
						'user_code'=>$user_code[0]
						,'absen_date'=>date_format($from,'Y-m-d')
						,'absen_type'=>'SIANG'
					);
				}
				$user_code = get_moderator(siang_beat(date_format($from,'Y-m-d')));
				if($user_code <> ''){
					$data[] = array(
						'user_code'=>$user_code[0]
						,'absen_date'=>date_format($from,'Y-m-d')
						,'absen_type'=>'SIANG'
					);
				}
				$user_code = get_moderator(siang_move(date_format($from,'Y-m-d')));
				if($user_code <> ''){
					$data[] = array(
						'user_code'=>$user_code[0]
						,'absen_date'=>date_format($from,'Y-m-d')
						,'absen_type'=>'SIANG'
					);
				}
				$user_code = get_moderator(malam(date_format($from,'Y-m-d')));
				if($user_code <> ''){
					$data[] = array(
						'user_code'=>$user_code[0]
						,'absen_date'=>date_format($from,'Y-m-d')
						,'absen_type'=>'MALAM'
					);
				}
				$user_code = get_moderator(malam2(date_format($from,'Y-m-d')));
				if($user_code <> ''){
					$data[] = array(
						'user_code'=>$user_code[0]
						,'absen_date'=>date_format($from,'Y-m-d')
						,'absen_type'=>'MALAM'
					);
				}
				$user_code = get_moderator(malam_beat(date_format($from,'Y-m-d')));
				if($user_code <> ''){
					$data[] = array(
						'user_code'=>$user_code[0]
						,'absen_date'=>date_format($from,'Y-m-d')
						,'absen_type'=>'MALAM'
					);
				}
				$user_code = get_moderator(malam_move(date_format($from,'Y-m-d')));
				if($user_code <> ''){
					$data[] = array(
						'user_code'=>$user_code[0]
						,'absen_date'=>date_format($from,'Y-m-d')
						,'absen_type'=>'MALAM'
					);
				}
				date_add($from, date_interval_create_from_date_string('1 days'));
			}	
			$this->mdl_mod_absent->set($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete!!!</div>');
		}else{
			$this->session->set_flashdata('alert','<div class="alert alert-danger">Date Empty!!!</div>');
		}
		redirect('mod_absent'.$this->_filter());				
	}
	function delete(){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		if($date_from <> '' && $date_to <> ''){
			$this->mdl_mod_absent->delete();
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete!!!</div>');
		}else{
			$this->session->set_flashdata('alert','<div class="alert alert-danger">Date Empty!!!</div>');
		}
		redirect('mod_absent'.$this->_filter());				
	}
	function search(){
		$data = array(
			'date_from'=>$this->input->post('date_from')
			,'date_to'=>$this->input->post('date_to')
		);
		redirect('mod_absent'.$this->_filter($data));
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array('date_from'=>0,'date_to'=>0);
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
}