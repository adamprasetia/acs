<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_sche extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('mod_helper');
	}
	function index(){		
		$data['title'] = 'ACS - Moderation Schedule';
		//--HARI INI--//
		$this->table->set_template(tbl_tmp());
		$this->table->set_heading(array('data'=>'SHIFT','width'=>20),'MODERATOR');
		$shift_siang = get_moderator(siang(date('Y-m-d')));
		$shift_siang2 = get_moderator(siang2(date('Y-m-d')));
		$shift_malam = get_moderator(malam(date('Y-m-d')));
		$shift_malam2 = get_moderator(malam2(date('Y-m-d')));
		$this->table->add_row(array('data'=>"<b>SIANG</b>",'rowspan'=>2),array('data'=>$shift_siang[1]));
		$this->table->add_row(array('data'=>$shift_siang2[1]));
		$this->table->add_row(array('data'=>"<b>MALAM</b>",'rowspan'=>2),array('data'=>$shift_malam[1]));
		$this->table->add_row(array('data'=>$shift_malam2[1]));
		$data['table_sekarang'] = $this->table->generate();

		//--BULAN LALU--//
		unset($heading);
		$total_hari = date('d',strtotime('last day of last month'));
		$heading[] = array('data'=>'SHIFT','rowspan=2');
		for($i=1;$i<=$total_hari;$i++){
			$heading[] = (date_format(date_create(date('Y-m-',strtotime('last day of last month')).$i),"N")==6 || date_format(date_create(date('Y-m-',strtotime('last day of last month')).$i),"N")==7?"<span style='color:red'>".get_hari(date_format(date_create(date('Y-m-',strtotime('last day of last month')).$i),"N"))."</span>":get_hari(date_format(date_create(date('Y-m-',strtotime('last day of last month')).$i),"N")))."<br/>".$i;
		}
		$this->table->set_heading($heading);
		unset($row);
		$row[] = array('data'=>"<b>SIANG</b>",'rowspan'=>2);
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-',strtotime('last day of last month')).$i),"Y-m-d");
			$shift = get_moderator(siang($date));
			$shift2 = get_moderator(siang2($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.siang($date));
			$row2[] = array('data'=>$shift2[0],'class'=>'mod_'.siang2($date));
		}
		$this->table->add_row($row);
		$this->table->add_row($row2);
		unset($row);
		unset($row2);
		$row[] = array('data'=>"<b>MALAM</b>",'rowspan'=>2);
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-',strtotime('last day of last month')).$i),"Y-m-d");
			$shift = get_moderator(malam($date));
			$shift2 = get_moderator(malam2($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.malam($date));
			$row2[] = array('data'=>$shift2[0],'class'=>'mod_'.malam2($date));
		}
		$this->table->add_row($row);
		$this->table->add_row($row2);
		unset($row);
		unset($row2);
		$data['table_bulan_lalu'] = $this->table->generate();
		
		//--BULAN INI--//
		unset($heading);
		$total_hari = date('d',strtotime('last day of this month'));
		$heading[] = array('data'=>'SHIFT','rowspan=2');
		for($i=1;$i<=$total_hari;$i++){
			$heading[] = (date_format(date_create(date('Y-m-').$i),"N")==6 || date_format(date_create(date('Y-m-').$i),"N")==7?"<span style='color:red'>".get_hari(date_format(date_create(date('Y-m-').$i),"N"))."</span>":get_hari(date_format(date_create(date('Y-m-').$i),"N")))."<br/>".$i;
		}
		$this->table->set_heading($heading);
		$row[] = array('data'=>"<b>SIANG</b>",'rowspan'=>2);
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-').$i),"Y-m-d");
			$shift = get_moderator(siang($date));
			$shift2 = get_moderator(siang2($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.siang($date));
			$row2[] = array('data'=>$shift2[0],'class'=>'mod_'.siang2($date));
		}
		$this->table->add_row($row);
		$this->table->add_row($row2);
		unset($row);
		unset($row2);
		$row[] = array('data'=>"<b>MALAM</b>",'rowspan'=>2);
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-').$i),"Y-m-d");
			$shift = get_moderator(malam($date));
			$shift2 = get_moderator(malam2($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.malam($date));
			$row2[] = array('data'=>$shift2[0],'class'=>'mod_'.malam2($date));
		}
		$this->table->add_row($row);	
		$this->table->add_row($row2);	
		unset($row);
		unset($row2);
		$data['table_bulan_ini'] = $this->table->generate();

		//--BULAN DEPAN--//
		unset($heading);
		$total_hari = date('d',strtotime('last day of next month'));
		$heading[] = array('data'=>'SHIFT','rowspan=2');
		for($i=1;$i<=$total_hari;$i++){
			$heading[] = (date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")==6 || date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")==7?"<span style='color:red'>".get_hari(date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N"))."</span>":get_hari(date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")))."<br/>".$i;
		}
		$this->table->set_heading($heading);
		$row[] = array('data'=>"<b>SIANG</b>",'rowspan'=>2);
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"Y-m-d");
			$shift = get_moderator(siang($date));
			$shift2 = get_moderator(siang2($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.siang($date));
			$row2[] = array('data'=>$shift2[0],'class'=>'mod_'.siang2($date));
		}
		$this->table->add_row($row);
		$this->table->add_row($row2);
		unset($row);
		unset($row2);
		$row[] = array('data'=>"<b>MALAM</b>",'rowspan'=>2);
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"Y-m-d");
			$shift = get_moderator(malam($date));
			$shift2 = get_moderator(malam2($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.malam($date));
			$row2[] = array('data'=>$shift2[0],'class'=>'mod_'.malam2($date));
		}
		$this->table->add_row($row);
		$this->table->add_row($row2);
		unset($row);
		unset($row2);
		
		$data['table_bulan_depan'] = $this->table->generate();
		$this->template->display('mod_sche',$data);
	}
}