<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta"); 
		if($this->session->userdata('user_login')==''){
			redirect('login');
		}	
		if(!$this->check_auth($this->uri->segment(1),$this->uri->segment(2),$this->session->userdata('user_level'))){
			redirect('dashboard/block');
		}
	}
	function check_auth($c,$m,$l) {
		if($m==''){
			$m='index';
		}
		$auth = array(
			'user'=>array(
						'index'=>array(1)
						,'add'=>array(1)
						,'edit'=>array(1)
						,'delete'=>array(1)
						,'search'=>array(1)
					)
			,'campaign'=>array(
						'index'=>array(1,2)
						,'add'=>array(1,2)
						,'edit'=>array(1,2)
						,'delete'=>array(1,2)
						,'search'=>array(1,2)
					)
			,'individual'=>array(
						'index'=>array(1,2,3)
						,'add'=>array(1,2,3)
						,'edit'=>array(1,2,3)
						,'delete'=>array(1,2)
						,'search'=>array(1,2,3)
						,'import'=>array(1,2,3)
						,'update'=>array(1,2,3)
						,'export'=>array(1,2,3)
						,'export_xls'=>array(1,2,3)
						,'filter'=>array(1,2,3)
						,'query'=>array(1,2,3)
						,'autocomplete'=>array(1,2,3)
					)
			,'report_calculate'=>array(
						'index'=>array(1,2,3)
						,'filter'=>array(1,2,3)
						,'export'=>array(1,2,3)
					)
			,'report_online'=>array(
						'index'=>array(1,2,3)
						,'search'=>array(1,2,3)
						,'filter'=>array(1,2,3)
						,'export'=>array(1,2,3)
					)
			,'vendor'=>array(
						'index'=>array(1,2)
						,'add'=>array(1,2)
						,'edit'=>array(1,2)
						,'delete'=>array(1,2)
						,'search'=>array(1,2)
						,'export'=>array(1,2)
					)
			,'barang'=>array(
						'index'=>array(1,2)
						,'add'=>array(1,2)
						,'edit'=>array(1,2)
						,'delete'=>array(1,2)
						,'search'=>array(1,2)
						,'export'=>array(1,2)
					)
			,'barang_masuk'=>array(
						'index'=>array(1,2)
						,'add'=>array(1,2)
						,'edit'=>array(1,2)
						,'delete'=>array(1,2)
						,'search'=>array(1,2)
						,'export'=>array(1,2)
					)
			,'barang_keluar'=>array(
						'index'=>array(1,2)
						,'add'=>array(1,2)
						,'edit'=>array(1,2)
						,'delete'=>array(1,2)
						,'search'=>array(1,2)
						,'export'=>array(1,2)
					)
			,'mod_sche'=>array(
						'index'=>array(1,2)
					)
			,'mod_sche_beat'=>array(
						'index'=>array(1,2)
					)
			,'mod_sche_move'=>array(
						'index'=>array(1,2)
					)
			,'mod_absent'=>array(
						'index'=>array(1,2)
						,'update'=>array(1,2)
						,'update_auto'=>array(1,2)
						,'delete'=>array(1,2)
						,'search'=>array(1,2)
					)
			,'mod_fee'=>array(
						'index'=>array(1,2)
						,'fee_senior'=>array(1,2)
					)
			,'profile'=>array(
						'index'=>array(1,2,3)
					)
			,'change_password'=>array(
						'index'=>array(1,2,3)
					)
			,'chat'=>array(
						'get'=>array(1,2,3)
						,'set'=>array(1,2,3)
					)
			
		);
		foreach($auth as $key=>$value) {
			if($key==$c){
				foreach($value as $ke=>$va) {
					if($ke==$m){
						foreach($va as $k) {
							if($k==$l){
								return true;
							}
						}
					}
				}
			}
		}
		return false;
	}		
}