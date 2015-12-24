<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_report_online {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
	}
	function day(){
		$this->ci->table->set_template(tbl_tmp());
		
		$this->ci->table->add_row(
			array('data'=>'Periode','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Jumlah Data Masuk','rowspan'=>2,'class'=>'table-header','style'=>'vertical-align:middle')
			,array('data'=>'Verified Online','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Verified Webmail','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Unverified','colspan'=>5,'class'=>'table-header')
		);
		$this->ci->table->add_row(
			array('data'=>'GIID copy is not legible','class'=>'table-header')
			,array('data'=>'GIID doesn\'t match','class'=>'table-header')
			,array('data'=>'Image is not ID','class'=>'table-header')
			,array('data'=>'Did not attach image','class'=>'table-header')
			,array('data'=>'Jumlah unverified','class'=>'table-header')
		);
		$result = $this->ci->mdl_report_online->day()->result();		
		$i=1;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
		foreach($result as $r){
			$this->ci->table->add_row(
				format_tanggal($r->entry_date)
				,number_format($r->count)
				,number_format($r->vo)
				,number_format($r->vw)
				,number_format($r->leg)
				,number_format($r->mat)
				,number_format($r->id)
				,number_format($r->img)
				,number_format($r->un)
			);
			$total[1] += $r->count;
			$total[2] += $r->vo;
			$total[3] += $r->vw;
			$total[4] += $r->leg;
			$total[5] += $r->mat;
			$total[6] += $r->id;
			$total[7] += $r->img;
			$total[8] += $r->un;
			$i++;
		}
		
		$tot[] = array('data'=>'Total','class'=>'table-footer');
		for($i=1;$i<=8;$i++){
			$tot[$i]	= array('data'=>number_format($total[$i]),'class'=>'table-footer');
		}
		$this->ci->table->add_row($tot);
		
		return $this->ci->table->generate();	
	}	
	function week(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->add_row(
			array('data'=>'Periode','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Jumlah Data Masuk','rowspan'=>2,'class'=>'table-header','style'=>'vertical-align:middle')
			,array('data'=>'Verified Online','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Verified Webmail','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Unverified','colspan'=>5,'class'=>'table-header')
		);
		$this->ci->table->add_row(
			array('data'=>'GIID copy is not legible','class'=>'table-header')
			,array('data'=>'GIID doesn\'t match','class'=>'table-header')
			,array('data'=>'Image is not ID','class'=>'table-header')
			,array('data'=>'Did not attach image','class'=>'table-header')
			,array('data'=>'Jumlah unverified','class'=>'table-header')
		);
		$result = $this->ci->mdl_report_online->week()->result();		
		$i=1;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
		foreach($result as $r){
			$this->ci->table->add_row(
				'Week&nbsp;'.$i++
				,number_format($r->count)
				,number_format($r->vo)
				,number_format($r->vw)
				,number_format($r->leg)
				,number_format($r->mat)
				,number_format($r->id)
				,number_format($r->img)
				,number_format($r->un)
			);
			$total[1] += $r->count;
			$total[2] += $r->vo;
			$total[3] += $r->vw;
			$total[4] += $r->leg;
			$total[5] += $r->mat;
			$total[6] += $r->id;
			$total[7] += $r->img;
			$total[8] += $r->un;
		}
		$tot[] = array('data'=>'Total','class'=>'table-footer');
		for($i=1;$i<=8;$i++){
			$tot[$i]	= array('data'=>number_format($total[$i]),'class'=>'table-footer');
		}
		$this->ci->table->add_row($tot);
		
		return $this->ci->table->generate();		
	}
	function sex(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->add_row(
			array('data'=>'Periode','class'=>'table-header')
			,array('data'=>'Jumlah Data Masuk','class'=>'table-header')
			,array('data'=>'Male','class'=>'table-header')
			,array('data'=>'Female','class'=>'table-header')
		);
		$result = $this->ci->mdl_report_online->sex()->result();		
		$i=1;
		$j=1;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
		foreach($result as $r){
			$this->ci->table->add_row(
				'Week&nbsp;'.$i++
				,number_format($r->count)
				,number_format($r->m)
				,number_format($r->f)
			);
			$j=1;
			$total[$j++] += $r->count;
			$total[$j++] += $r->m;
			$total[$j++] += $r->f;
		}
		$tot[] = array('data'=>'Total','class'=>'table-footer');
		for($i=1;$i<$j;$i++){
			$tot[$i] = array('data'=>number_format($total[$i]),'class'=>'table-footer');
		}
		$this->ci->table->add_row($tot);
		
		return $this->ci->table->generate();		
	}
	function city_gap(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->add_row(
			array('data'=>'Week','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Verified','colspan'=>12,'class'=>'table-header')
			,array('data'=>'Total','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'All Status','colspan'=>12,'class'=>'table-header')
			,array('data'=>'Total','rowspan'=>2,'class'=>'table-header')
		);
		$this->ci->table->add_row(
			array('data'=>'BDG','class'=>'table-header')
			,array('data'=>'JKT','class'=>'table-header')
			,array('data'=>'MDN','class'=>'table-header')
			,array('data'=>'PLMBG','class'=>'table-header')
			,array('data'=>'SBY','class'=>'table-header')
			,array('data'=>'YOGYA','class'=>'table-header')
			,array('data'=>'PDG','class'=>'table-header')
			,array('data'=>'LMPG','class'=>'table-header')
			,array('data'=>'SMG','class'=>'table-header')
			,array('data'=>'DPS','class'=>'table-header')
			,array('data'=>'MKS','class'=>'table-header')
			,array('data'=>'OTHERS','class'=>'table-header')
			,array('data'=>'BDG','class'=>'table-header')
			,array('data'=>'JKT','class'=>'table-header')
			,array('data'=>'MDN','class'=>'table-header')
			,array('data'=>'PLMBG','class'=>'table-header')
			,array('data'=>'SBY','class'=>'table-header')
			,array('data'=>'YOGYA','class'=>'table-header')
			,array('data'=>'PDG','class'=>'table-header')
			,array('data'=>'LMPG','class'=>'table-header')
			,array('data'=>'SMG','class'=>'table-header')
			,array('data'=>'DPS','class'=>'table-header')
			,array('data'=>'MKS','class'=>'table-header')
			,array('data'=>'OTHERS','class'=>'table-header')
		);
		$result = $this->ci->mdl_report_online->city_gap()->result();		
		$i=1;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$this->ci->table->add_row(
				'Week&nbsp;'.$i++
				,number_format($r->vbdg)
				,number_format($r->vjkt)
				,number_format($r->vmdn)
				,number_format($r->vplmbg)
				,number_format($r->vsby)
				,number_format($r->vyogya)
				,number_format($r->vpdg)
				,number_format($r->vlmpg)
				,number_format($r->vsmg)
				,number_format($r->vdps)
				,number_format($r->vmks)
				,number_format($r->voth)
				,number_format($r->vtot)
				
				,number_format($r->abdg)
				,number_format($r->ajkt)
				,number_format($r->amdn)
				,number_format($r->aplmbg)
				,number_format($r->asby)
				,number_format($r->ayogya)
				,number_format($r->apdg)
				,number_format($r->almpg)
				,number_format($r->asmg)
				,number_format($r->adps)
				,number_format($r->amks)
				,number_format($r->aoth)
				,number_format($r->atot)
			);
			$total[1] += $r->vbdg;
			$total[2] += $r->vjkt;
			$total[3] += $r->vmdn;
			$total[4] += $r->vplmbg;
			$total[5] += $r->vsby;
			$total[6] += $r->vyogya;
			$total[7] += $r->vpdg;
			$total[8] += $r->vlmpg;
			$total[9] += $r->vsmg;
			$total[10] += $r->vdps;
			$total[11] += $r->vmks;
			$total[12] += $r->voth;
			$total[13] += $r->vtot;
			$total[14] += $r->abdg;
			$total[15] += $r->ajkt;
			$total[16] += $r->amdn;
			$total[17] += $r->aplmbg;
			$total[18] += $r->asby;
			$total[19] += $r->ayogya;
			$total[20] += $r->apdg;
			$total[21] += $r->almpg;
			$total[22] += $r->asmg;
			$total[23] += $r->adps;
			$total[24] += $r->amks;
			$total[25] += $r->aoth;
			$total[26] += $r->atot;
		}
		
		$tot[] = array('data'=>'Total','class'=>'table-footer');
		for($i=1;$i<=26;$i++){
			$tot[$i]	= array('data'=>number_format($total[$i]),'class'=>'table-footer');
		}
		$this->ci->table->add_row($tot);
		
		return $this->ci->table->generate();				
	}
	function brand_gap(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->add_row(
			array('data'=>'Week','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Verified','colspan'=>7,'class'=>'table-header')
			,array('data'=>'Total','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'All Status','colspan'=>7,'class'=>'table-header')
			,array('data'=>'Total','rowspan'=>2,'class'=>'table-header')
		);
		$this->ci->table->add_row(
			array('data'=>'AMILD','class'=>'table-header')
			,array('data'=>'AVOLUTION','class'=>'table-header')
			,array('data'=>'DJARUM','class'=>'table-header')
			,array('data'=>'DUNHILL','class'=>'table-header')
			,array('data'=>'GG','class'=>'table-header')
			,array('data'=>'LA LIGHT','class'=>'table-header')
			,array('data'=>'OTHERS','class'=>'table-header')
			,array('data'=>'AMILD','class'=>'table-header')
			,array('data'=>'AVOLUTION','class'=>'table-header')
			,array('data'=>'DJARUM','class'=>'table-header')
			,array('data'=>'DUNHILL','class'=>'table-header')
			,array('data'=>'GG','class'=>'table-header')
			,array('data'=>'LA LIGHT','class'=>'table-header')
			,array('data'=>'OTHERS','class'=>'table-header')
		);
		$result = $this->ci->mdl_report_online->brand_gap()->result();		
		$i=1;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$this->ci->table->add_row(
				'Week&nbsp;'.$i++
				,number_format($r->vaml)
				,number_format($r->vavo)
				,number_format($r->vdja)
				,number_format($r->vdun)
				,number_format($r->vgdg)
				,number_format($r->vla)
				,number_format($r->voth)
				,number_format($r->vtot)
				,number_format($r->aaml)
				,number_format($r->aavo)
				,number_format($r->adja)
				,number_format($r->adun)
				,number_format($r->agdg)
				,number_format($r->ala)
				,number_format($r->aoth)
				,number_format($r->atot)
			);
			$total[1] += $r->vaml;
			$total[2] += $r->vavo;
			$total[3] += $r->vdja;
			$total[4] += $r->vdun;
			$total[5] += $r->vgdg;
			$total[6] += $r->vla;
			$total[7] += $r->voth;
			$total[8] += $r->vtot;
			$total[9] += $r->aaml;
			$total[10] += $r->aavo;
			$total[11] += $r->adja;
			$total[12] += $r->adun;
			$total[13] += $r->agdg;
			$total[14] += $r->ala;
			$total[15] += $r->aoth;
			$total[16] += $r->atot;			
		}
		
		$tot[] = array('data'=>'Total','class'=>'table-footer');
		for($i=1;$i<=16;$i++){
			$tot[$i]	= array('data'=>number_format($total[$i]),'class'=>'table-footer');
		}
		$this->ci->table->add_row($tot);
		
		return $this->ci->table->generate();				
	}
	function brand_umild(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->add_row(
			array('data'=>'Week','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'U Mild','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'HMS','colspan'=>5,'class'=>'table-header')
			,array('data'=>'Non HMS','colspan'=>5,'class'=>'table-header')
			,array('data'=>'Total','rowspan'=>2,'class'=>'table-header')
		);
		$this->ci->table->add_row(
			array('data'=>'A Mild','class'=>'table-header')
			,array('data'=>'Avolution','class'=>'table-header')
			,array('data'=>'DSS','class'=>'table-header')
			,array('data'=>'Marlboro','class'=>'table-header')
			,array('data'=>'Magnum','class'=>'table-header')
			,array('data'=>'L.A Light','class'=>'table-header')
			,array('data'=>'GG Surya Pro Mild','class'=>'table-header')
			,array('data'=>'Djarum Super','class'=>'table-header')
			,array('data'=>'Gudang Garam','class'=>'table-header')
			,array('data'=>'Others','class'=>'table-header')
		);
		$result = $this->ci->mdl_report_online->brand_umild()->result();		
		$i=1;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$this->ci->table->add_row(
				'Week&nbsp;'.$i++
				,number_format($r->uml)
				,number_format($r->aml)
				,number_format($r->avo)
				,number_format($r->dji)
				,number_format($r->mar)
				,number_format($r->mag)
				,number_format($r->la)
				,number_format($r->sur)
				,number_format($r->dja)
				,number_format($r->gud)
				,number_format($r->oth)
				,number_format($r->tot)
			);
			$j=1;
			$total[$j++] += $r->uml;
			$total[$j++] += $r->aml;
			$total[$j++] += $r->avo;
			$total[$j++] += $r->dji;
			$total[$j++] += $r->mar;
			$total[$j++] += $r->mag;
			$total[$j++] += $r->la;
			$total[$j++] += $r->sur;
			$total[$j++] += $r->dja;
			$total[$j++] += $r->gud;
			$total[$j++] += $r->oth;
			$total[$j++] += $r->tot;
		}
		
		$tot[] = array('data'=>'Total','class'=>'table-footer');
		for($i=1;$i<=12;$i++){
			$tot[$i]	= array('data'=>number_format($total[$i]),'class'=>'table-footer');
		}
		$this->ci->table->add_row($tot);
		
		return $this->ci->table->generate();				
	}
	function age_gap(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->add_row(
			array('data'=>'Week','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Verified','colspan'=>3,'class'=>'table-header')
			,array('data'=>'Total','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'All Status','colspan'=>3,'class'=>'table-header')
			,array('data'=>'Total','rowspan'=>2,'class'=>'table-header')
		);
		$this->ci->table->add_row(
			array('data'=>'18 - 24','class'=>'table-header')
			,array('data'=>'25 - 29','class'=>'table-header')
			,array('data'=>'29+','class'=>'table-header')
			,array('data'=>'18 - 24','class'=>'table-header')
			,array('data'=>'25 - 29','class'=>'table-header')
			,array('data'=>'29+','class'=>'table-header')
		);
		$result = $this->ci->mdl_report_online->age_gap()->result();		
		$i=1;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$this->ci->table->add_row(
				'Week&nbsp;'.$i++
				,number_format($r->vrem)
				,number_format($r->vdew)
				,number_format($r->vtua)
				,number_format($r->vtot)
				,number_format($r->arem)
				,number_format($r->adew)
				,number_format($r->atua)
				,number_format($r->atot)
			);
			$total[1] += $r->vrem;
			$total[2] += $r->vdew;
			$total[3] += $r->vtua;
			$total[4] += $r->vtot;
			$total[5] += $r->arem;
			$total[6] += $r->adew;
			$total[7] += $r->atua;
			$total[8] += $r->atot;
		}
		
		$tot[] = array('data'=>'Total','class'=>'table-footer');
		for($i=1;$i<=8;$i++){
			$tot[$i]	= array('data'=>number_format($total[$i]),'class'=>'table-footer');
		}
		$this->ci->table->add_row($tot);
		
		return $this->ci->table->generate();				
	}
	function age_umild(){
		$this->ci->table->set_template(tbl_tmp());

		$this->ci->table->add_row(
			array('data'=>'Week','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'Verified','colspan'=>5,'class'=>'table-header')
			,array('data'=>'Total','rowspan'=>2,'class'=>'table-header')
			,array('data'=>'All Status','colspan'=>5,'class'=>'table-header')
			,array('data'=>'Total','rowspan'=>2,'class'=>'table-header')
		);
		$this->ci->table->add_row(
			array('data'=>'18 - 24','class'=>'table-header')
			,array('data'=>'25 - 29','class'=>'table-header')
			,array('data'=>'30 - 34','class'=>'table-header')
			,array('data'=>'35 - 40','class'=>'table-header')
			,array('data'=>'40+','class'=>'table-header')
			,array('data'=>'18 - 24','class'=>'table-header')
			,array('data'=>'25 - 29','class'=>'table-header')
			,array('data'=>'30 - 34','class'=>'table-header')
			,array('data'=>'35 - 40','class'=>'table-header')
			,array('data'=>'40+','class'=>'table-header')
		);
		$result = $this->ci->mdl_report_online->age_umild()->result();		
		$i=1;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$this->ci->table->add_row(
				'Week&nbsp;'.$i++
				,number_format($r->vrem)
				,number_format($r->vdew1)
				,number_format($r->vdew2)
				,number_format($r->vdew3)
				,number_format($r->vtua)
				,number_format($r->vtot)
				,number_format($r->arem)
				,number_format($r->adew1)
				,number_format($r->adew2)
				,number_format($r->adew3)
				,number_format($r->atua)
				,number_format($r->atot)
			);
			$j=1;
			$total[$j++] += $r->vrem;
			$total[$j++] += $r->vdew1;
			$total[$j++] += $r->vdew2;
			$total[$j++] += $r->vdew3;
			$total[$j++] += $r->vtua;
			$total[$j++] += $r->vtot;
			$total[$j++] += $r->arem;
			$total[$j++] += $r->adew1;
			$total[$j++] += $r->adew2;
			$total[$j++] += $r->adew3;
			$total[$j++] += $r->atua;
			$total[$j++] += $r->atot;
		}
		
		$tot[] = array('data'=>'Total','class'=>'table-footer');
		for($i=1;$i<$j;$i++){
			$tot[$i]	= array('data'=>number_format($total[$i]),'class'=>'table-footer');
		}
		$this->ci->table->add_row($tot);
		
		return $this->ci->table->generate();				
	}
	
}