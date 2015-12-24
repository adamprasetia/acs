<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Moderator */
function moderator(){
	$data = array(
		'1'=>array('E','Eka',2)
		,'2'=>array('W','Wahyu',2)
		,'3'=>array('N','Wisnu',2)
		,'4'=>array('V','Eva',2)
		,'5'=>array('Y','Yanuar',2)
		,'6'=>array('G','Geo',2)
		,'7'=>array('T','Titi',2)
		,'8'=>array('A','Adi',2)
		,'9'=>array('B','Bayu',2)
		,'10'=>array('M','Martha',1)
		,'11'=>array('Z','Meizan',1)
		,'12'=>array('D','Adit',1)
	);
	return $data;
}
function get_moderator($id){
	$data = moderator();
	return $data[$id];
}

/* Siang */
function siang($tanggal){
	$date = explode("-",$tanggal);
	$data = array(
		'0'=>'2'
		,'1'=>'1'
		,'2'=>'1'
		,'3'=>'1'
		,'4'=>'1'
		,'5'=>'1'
		,'6'=>'3'
		,'7'=>'3'
		,'8'=>'1'
		,'9'=>'1'
		,'10'=>'1'
		,'11'=>'1'
		,'12'=>'1'
		,'13'=>'2'
	);
	return $data[(GregorianToJD($date[1],$date[2],$date[0])+1)%14];
}
function siang2($tanggal){
	$date = explode("-",$tanggal);
	$data = array(
		'0'=>'5'
		,'1'=>'4'
		,'2'=>'4'
		,'3'=>'4'
		,'4'=>'4'
		,'5'=>'4'
		,'6'=>'6'
		,'7'=>'6'
		,'8'=>'4'
		,'9'=>'4'
		,'10'=>'4'
		,'11'=>'4'
		,'12'=>'4'
		,'13'=>'5'
	);
	return $data[(GregorianToJD($date[1],$date[2],$date[0])+1)%14];
}
function siang_beat($tanggal){
	$date = explode("-",$tanggal);
	$data = array(
		'0'=>'8'
		,'1'=>'7'
		,'2'=>'7'
		,'3'=>'7'
		,'4'=>'7'
		,'5'=>'7'
		,'6'=>'9'
		,'7'=>'9'
		,'8'=>'7'
		,'9'=>'7'
		,'10'=>'7'
		,'11'=>'7'
		,'12'=>'7'
		,'13'=>'8'
	);
	return $data[(GregorianToJD($date[1],$date[2],$date[0])+1)%14];
}
function siang_move($tanggal){
	$date = explode("-",$tanggal);
	$data = array(
		'0'=>'11'
		,'1'=>'10'
		,'2'=>'10'
		,'3'=>'10'
		,'4'=>'10'
		,'5'=>'10'
		,'6'=>'12'
		,'7'=>'12'
		,'8'=>'10'
		,'9'=>'10'
		,'10'=>'10'
		,'11'=>'10'
		,'12'=>'10'
		,'13'=>'11'
	);
	return $data[(GregorianToJD($date[1],$date[2],$date[0])+1)%14];
}
/* Malam */
function malam($tanggal){
	$date = explode("-",$tanggal);
	$data = array(
		'0'=>'3'
		,'1'=>'2'
		,'2'=>'2'
		,'3'=>'3'
		,'4'=>'3'
		,'5'=>'2'
		,'6'=>'2'
		,'7'=>'2'
		,'8'=>'3'
		,'9'=>'3'
		,'10'=>'2'
		,'11'=>'2'
		,'12'=>'3'
		,'13'=>'3'
	);
	return $data[(GregorianToJD($date[1],$date[2],$date[0])+1)%14];
}
function malam2($tanggal){
	$date = explode("-",$tanggal);
	$data = array(
		'0'=>'6'
		,'1'=>'5'
		,'2'=>'5'
		,'3'=>'6'
		,'4'=>'6'
		,'5'=>'5'
		,'6'=>'5'
		,'7'=>'5'
		,'8'=>'6'
		,'9'=>'6'
		,'10'=>'5'
		,'11'=>'5'
		,'12'=>'6'
		,'13'=>'6'
	);
	return $data[(GregorianToJD($date[1],$date[2],$date[0])+1)%14];
}
function malam_beat($tanggal){
	$date = explode("-",$tanggal);
	$data = array(
		'0'=>'9'
		,'1'=>'8'
		,'2'=>'8'
		,'3'=>'9'
		,'4'=>'9'
		,'5'=>'8'
		,'6'=>'8'
		,'7'=>'8'
		,'8'=>'9'
		,'9'=>'9'
		,'10'=>'8'
		,'11'=>'8'
		,'12'=>'9'
		,'13'=>'9'
	);
	return $data[(GregorianToJD($date[1],$date[2],$date[0])+1)%14];
}
function malam_move($tanggal){
	$date = explode("-",$tanggal);
	$data = array(
		'0'=>'12'
		,'1'=>'11'
		,'2'=>'11'
		,'3'=>'12'
		,'4'=>'12'
		,'5'=>'11'
		,'6'=>'11'
		,'7'=>'11'
		,'8'=>'12'
		,'9'=>'12'
		,'10'=>'11'
		,'11'=>'11'
		,'12'=>'12'
		,'13'=>'12'
	);
	return $data[(GregorianToJD($date[1],$date[2],$date[0])+1)%14];
}
/* hari */
function hari(){
	$data = array(
		'1'=>'S'
		,'2'=>'S'
		,'3'=>'R'
		,'4'=>'K'
		,'5'=>'J'
		,'6'=>'S'
		,'7'=>'M'
	);
	return $data;
}
function get_hari($id){
	$data = hari();
	return $data[$id];
}
/* nama hari */
function nama_hari(){
	$data = array(
		'1'=>'Senin'
		,'2'=>'Selasa'
		,'3'=>'Rabu'
		,'4'=>'Kamis'
		,'5'=>'Jumat'
		,'6'=>'Sabtu'
		,'7'=>'Minggu'
	);
	return $data;
}
function get_nama_hari($id){
	$data = nama_hari();
	return $data[$id];
}

