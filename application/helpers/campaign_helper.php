<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Campaign Status */
function campaign_status(){
	$data = array(
		'1'=>'PENDING'
		,'2'=>'RUNNING'
		,'3'=>'COMPLETE'
	);
	return $data;
}
function campaign_status_theme(){
	$data = array(
		'1'=>'<span class="label label-danger">PENDING</span>'
		,'2'=>'<span class="label label-warning">RUNNING</span>'
		,'3'=>'<span class="label label-success">COMPLETE</span>'
	);
	return $data;	
}
function get_campaign_status($id){
	$data = campaign_status_theme();
	return $data[$id];
}
function campaign_status_dropdown(){
	$data[''] = '-Status-';
	$status = campaign_status();
	foreach($status as $r =>$val){
		$data[$r]=$val;
	}
	return $data;
}