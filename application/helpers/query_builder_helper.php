<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function genString($id,$caption){
	$data = array(
		'id' => $id,
		'label' => $caption,
		'type' => 'string',
		'size' => 50
	);
	return $data;
}
function genInteger($id,$caption){
	$data = array(
		'id' => $id,
		'label' => $caption,
		'type' => 'integer',
		'size' => 50
	);
	return $data;
}
function genSelect($id,$caption,$values){
	$data = array(
		'id' => $id,
		'label' => $caption,
		'type' => 'string',
		'input' => 'select',
		'placeholder' => $caption,
		'values' => $values,
		'operators' => array('equal', 'not_equal', 'is_empty', 'is_not_empty', 'is_null', 'is_not_null')
	);
	return $data;
}

function genDate($id,$caption){
	$data = array(
		'id' => $id,
		'label' => $caption,
		'type' => 'date',
		'validation' => array('format'=>'YYYY-MM-DD'),
		'plugin' => 'datepicker',
		'plugin_config' => array(
			'format' => 'yyyy-mm-dd',
			'todayBtn' => 'linked',
			'todayHighlight' => true,
			'autoclose' => true
    )
	);
	return $data;
}