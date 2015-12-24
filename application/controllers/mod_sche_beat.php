<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_sche_beat extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('mod_helper');
	}
	function index(){		
		$data['title'] = 'ACS - Moderation Schedule BEAT';
		//--HARI INI--//
		$this->table->set_template(tbl_tmp());
		$this->table->set_heading(array('data'=>'SHIFT','width'=>20),'MODERATOR');
		$shift_siang = get_moderator(siang_beat(date('Y-m-d')));
		$shift_malam = get_moderator(malam_beat(date('Y-m-d')));
		$this->table->add_row(array('data'=>"<b>SIANG</b>"),array('data'=>$shift_siang[1]));
		$this->table->add_row(array('data'=>"<b>MALAM</b>"),array('data'=>$shift_malam[1]));
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
		$row[] = array('data'=>"<b>SIANG</b>");
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-',strtotime('last day of last month')).$i),"Y-m-d");
			$shift = get_moderator(siang_beat($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.siang_beat($date));
		}
		$this->table->add_row($row);
		unset($row);
		$row[] = array('data'=>"<b>MALAM</b>");
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-',strtotime('last day of last month')).$i),"Y-m-d");
			$shift = get_moderator(malam_beat($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.malam_beat($date));
		}
		$this->table->add_row($row);
		unset($row);
		$data['table_bulan_lalu'] = $this->table->generate();
		
		//--BULAN INI--//
		unset($heading);
		$total_hari = date('d',strtotime('last day of this month'));
		$heading[] = array('data'=>'SHIFT','rowspan=2');
		for($i=1;$i<=$total_hari;$i++){
			$heading[] = (date_format(date_create(date('Y-m-').$i),"N")==6 || date_format(date_create(date('Y-m-').$i),"N")==7?"<span style='color:red'>".get_hari(date_format(date_create(date('Y-m-').$i),"N"))."</span>":get_hari(date_format(date_create(date('Y-m-').$i),"N")))."<br/>".$i;
		}
		$this->table->set_heading($heading);
		$row[] = array('data'=>"<b>SIANG</b>");
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-').$i),"Y-m-d");
			$shift = get_moderator(siang_beat($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.siang_beat($date));
		}
		$this->table->add_row($row);
		unset($row);
		$row[] = array('data'=>"<b>MALAM</b>");
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-').$i),"Y-m-d");
			$shift = get_moderator(malam_beat($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.malam_beat($date));
		}
		$this->table->add_row($row);	
		unset($row);
		$data['table_bulan_ini'] = $this->table->generate();

		//--BULAN DEPAN--//
		unset($heading);
		$total_hari = date('d',strtotime('last day of next month'));
		$heading[] = array('data'=>'SHIFT','rowspan=2');
		for($i=1;$i<=$total_hari;$i++){
			$heading[] = (date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")==6 || date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")==7?"<span style='color:red'>".get_hari(date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N"))."</span>":get_hari(date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"N")))."<br/>".$i;
		}
		$this->table->set_heading($heading);
		$row[] = array('data'=>"<b>SIANG</b>");
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"Y-m-d");
			$shift = get_moderator(siang_beat($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.siang_beat($date));
		}
		$this->table->add_row($row);
		unset($row);
		$row[] = array('data'=>"<b>MALAM</b>");
		for($i=1;$i<=$total_hari;$i++){
			$date = date_format(date_create(date('Y-m-',strtotime('last day of next month')).$i),"Y-m-d");
			$shift = get_moderator(malam_beat($date));
			$row[] = array('data'=>$shift[0],'class'=>'mod_'.malam_beat($date));
		}
		$this->table->add_row($row);
		unset($row);
		
		$data['table_bulan_depan'] = $this->table->generate();
		$this->template->display('mod_sche',$data);
	}
}