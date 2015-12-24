<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_report_calculate {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
	}
	function calculate($key,$name){
		$this->ci->table->set_template(tbl_tmp());

		$head_data = array(
			$key=>$name
			,'count'=>'Count'
		);
		$heading[] = 'No';
		foreach($head_data as $r => $value){
			$heading[] = anchor('report_calculate'.$this->ci->_filter(array('order_column'=>$r,'order_type'=>$this->ci->lib_general->order_type($r))),$value." ".$this->ci->lib_general->order_icon($r));
		}		
		$this->ci->table->set_heading($heading);
		
		$result = $this->ci->mdl_report_calculate->field($key)->result_array();
		$i=1;
		$count=0;
		foreach($result as $r){
			$this->ci->table->add_row(
				$i++
				,$r[$key]
				,number_format($r['count'])
			);
			$count += $r['count'];
		}
		$this->ci->table->add_row(	
			array('data'=>'Total','colspan'=>'2')
			,array('data'=>'<b>'.number_format($count).'</b>')
		);
		return $this->ci->table->generate();				
	}
	function city(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->set_heading('No','City Name','Count');
		
		$row = $this->ci->mdl_report_calculate->city()->row();
		$i=1;
		$this->ci->table->add_row($i++,'BANDUNG',number_format($row->aban));
		$this->ci->table->add_row($i++,'JAKARTA',number_format($row->ajak));
		$this->ci->table->add_row($i++,'MEDAN',number_format($row->amed));
		$this->ci->table->add_row($i++,'PALEMBANG',number_format($row->apal));
		$this->ci->table->add_row($i++,'SURABAYA',number_format($row->asur));
		$this->ci->table->add_row($i++,'YOGYAKARYA',number_format($row->ayog));
		$this->ci->table->add_row($i++,'PADANG',number_format($row->apad));
		$this->ci->table->add_row($i++,'LAMPUNG',number_format($row->alam));
		$this->ci->table->add_row($i++,'SEMARANG',number_format($row->asem));
		$this->ci->table->add_row($i++,'DENPASAR',number_format($row->aden));
		$this->ci->table->add_row($i++,'MAKASSAR',number_format($row->amak));
		$this->ci->table->add_row($i++,'OTHERS',number_format($row->aoth));
		$this->ci->table->add_row(	
			array('data'=>'Total','colspan'=>'2')
			,array('data'=>'<b>'.number_format($row->atot).'</b>')
		);
		return $this->ci->table->generate();					
	}
	function city_age(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->set_heading('No','City Name','<18','18-24','25-29','30-34','35-40','40+','Others','Count');
		
		$result = $this->ci->mdl_report_calculate->city_age()->result();
		$i=1;
		$count=0;
		foreach($result as $r){
			$this->ci->table->add_row(
				$i++
				,$r->city
				,number_format($r->ank)
				,number_format($r->rem)
				,number_format($r->dew1)
				,number_format($r->dew2)
				,number_format($r->dew3)
				,number_format($r->tua)
				,number_format($r->oth)
				,number_format($r->count)
			);	
			$count += $r->count;
		}
		$this->ci->table->add_row(	
			array('data'=>'Total','colspan'=>'9')
			,array('data'=>'<b>'.number_format($count).'</b>')
		);
		return $this->ci->table->generate();					
	}
	function brand(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->set_heading('No','Brand','Count');
		
		$row = $this->ci->mdl_report_calculate->brand()->row();
		$i=1;
		$this->ci->table->add_row($i++,'A MILD',number_format($row->aaml));
		$this->ci->table->add_row($i++,'AVOLUTION',number_format($row->aavo));
		$this->ci->table->add_row($i++,'DJARUM',number_format($row->adja));
		$this->ci->table->add_row($i++,'DUNHILL',number_format($row->adun));
		$this->ci->table->add_row($i++,'GUDANG GARAM',number_format($row->agdg));
		$this->ci->table->add_row($i++,'L.A',number_format($row->ala));
		$this->ci->table->add_row($i++,'OTHERS',number_format($row->aoth));
		$this->ci->table->add_row(	
			array('data'=>'Total','colspan'=>'2')
			,array('data'=>'<b>'.number_format($row->atot).'</b>')
		);
		return $this->ci->table->generate();							
	}
	function age(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->set_heading('No','Age','Count');
		
		$row = $this->ci->mdl_report_calculate->age()->row();
		$i=1;
		$this->ci->table->add_row($i++,'<18',number_format($row->aank));
		$this->ci->table->add_row($i++,'18-24',number_format($row->arem));
		$this->ci->table->add_row($i++,'25-29',number_format($row->adew1));
		$this->ci->table->add_row($i++,'30-34',number_format($row->adew2));
		$this->ci->table->add_row($i++,'35-40',number_format($row->adew3));
		$this->ci->table->add_row($i++,'>40',number_format($row->atua));
		$this->ci->table->add_row($i++,'OTHERS',number_format($row->aoth));
		$this->ci->table->add_row(	
			array('data'=>'Total','colspan'=>'2')
			,array('data'=>'<b>'.number_format($row->atot).'</b>')
		);
		return $this->ci->table->generate();							
	}
	function sba(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->set_heading('No','City','SBA','Count');
		
		$result = $this->ci->mdl_report_calculate->sba()->result();
		$i=1;
		$total = 0;
		foreach($result as $r){
			$this->ci->table->add_row(
				$i++
				,$r->city
				,$r->sba_name
				,number_format($r->count)
			);
			$total += $r->count;		
		}
		$this->ci->table->add_row(	
			array('data'=>'Total','colspan'=>'3')
			,array('data'=>'<b>'.number_format($total).'</b>')
		);
		return $this->ci->table->generate();							
	}
	function week(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->set_heading('No','Week','Count');
		
		$result = $this->ci->mdl_report_calculate->week()->result();
		$i=1;
		$total = 0;
		foreach($result as $r){
			$this->ci->table->add_row(
				$i++
				,"Week ".($i-1)
				,number_format($r->count)
			);
			$total += $r->count;		
		}
		$this->ci->table->add_row(	
			array('data'=>'Total','colspan'=>'2')
			,array('data'=>'<b>'.number_format($total).'</b>')
		);
		return $this->ci->table->generate();							
	}

}