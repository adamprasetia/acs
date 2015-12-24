<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_general {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
	}
	function order_type($field){
		$order_column = $this->ci->input->get('order_column');
		$order_type = $this->ci->input->get('order_type');
		if($order_type=='asc' && $order_column==$field){
			return 'desc';	
		}else{
			return 'asc';
		}
	}
	function order_icon($field){
		$order_column = $this->ci->input->get('order_column');
		$order_type = $this->ci->input->get('order_type');
		if($order_column==$field){
			switch($order_type){
				case 'asc':return '<span class="glyphicon glyphicon-chevron-up"></span>';break;
				case 'desc':return '<span class="glyphicon glyphicon-chevron-down"></span>';break;
				default:return "";break;
			}	
		}		
	}	
	function value_get($id,$false){
		$data = $this->ci->input->get($id);
		if($data <> ''){
			return $data;	
		}
		return $false;
	}
}