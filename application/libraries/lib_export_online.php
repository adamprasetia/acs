<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_export_online {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
	}
	function day(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Online Day Report');
		
		//style
		$active_sheet->getStyle("A1:I2")->getFont()->setBold(true);
		$active_sheet->mergeCells('E1:I1');
		$active_sheet->mergeCells('A1:A2');
		$active_sheet->mergeCells('B1:B2');
		$active_sheet->mergeCells('C1:C2');
		$active_sheet->mergeCells('D1:D2');
		$active_sheet->getStyle("A1:I2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$active_sheet->getStyle("A1:I2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//header
		$active_sheet->setCellValue('A1', 'Periode');
		$active_sheet->setCellValue('B1', 'Jumlah Data Masuk');
		$active_sheet->setCellValue('C1', 'Verified Online');
		$active_sheet->setCellValue('D1', 'Verified Webmail');
		$active_sheet->setCellValue('E1', 'Unverified');
		$active_sheet->setCellValue('E2', 'GIID copy is not legible');
		$active_sheet->setCellValue('F2', 'GIID doesn\'t match');
		$active_sheet->setCellValue('G2', 'Image is not ID');
		$active_sheet->setCellValue('H2', 'Did not attach image');
		$active_sheet->setCellValue('I2', 'Jumlah unverified');

		$result = $this->ci->mdl_report_online->day()->result();		
		$i=3;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->entry_date)));
			$active_sheet->getStyle('A'.$i)->getNumberFormat()->setFormatCode('dd MMM yyyy');		   
			$active_sheet->setCellValue('B'.$i, $r->count);
			$active_sheet->setCellValue('C'.$i, $r->vo);
			$active_sheet->setCellValue('D'.$i, $r->vw);
			$active_sheet->setCellValue('E'.$i, $r->leg);
			$active_sheet->setCellValue('F'.$i, $r->mat);
			$active_sheet->setCellValue('G'.$i, $r->id);
			$active_sheet->setCellValue('H'.$i, $r->img);
			$active_sheet->setCellValue('I'.$i, $r->un);
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
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('B'.$i, $total[1]);
		$active_sheet->setCellValue('C'.$i, $total[2]);
		$active_sheet->setCellValue('D'.$i, $total[3]);
		$active_sheet->setCellValue('E'.$i, $total[4]);
		$active_sheet->setCellValue('F'.$i, $total[5]);
		$active_sheet->setCellValue('G'.$i, $total[6]);
		$active_sheet->setCellValue('H'.$i, $total[7]);
		$active_sheet->setCellValue('I'.$i, $total[8]);
		$active_sheet->getStyle("A".$i.":"."I".$i)->getFont()->setBold(true);		
		
		$filename = 'Online Day Report '.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');		
	}
	function week(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Online Week Report');
		
		//style
		$active_sheet->getStyle("A1:I2")->getFont()->setBold(true);
		$active_sheet->mergeCells('E1:I1');
		$active_sheet->mergeCells('A1:A2');
		$active_sheet->mergeCells('B1:B2');
		$active_sheet->mergeCells('C1:C2');
		$active_sheet->mergeCells('D1:D2');
		$active_sheet->getStyle("A1:I2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$active_sheet->getStyle("A1:I2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//header
		$active_sheet->setCellValue('A1', 'Periode');
		$active_sheet->setCellValue('B1', 'Jumlah Data Masuk');
		$active_sheet->setCellValue('C1', 'Verified Online');
		$active_sheet->setCellValue('D1', 'Verified Webmail');
		$active_sheet->setCellValue('E1', 'Unverified');
		$active_sheet->setCellValue('E2', 'GIID copy is not legible');
		$active_sheet->setCellValue('F2', 'GIID doesn\'t match');
		$active_sheet->setCellValue('G2', 'Image is not ID');
		$active_sheet->setCellValue('H2', 'Did not attach image');
		$active_sheet->setCellValue('I2', 'Jumlah unverified');

		$result = $this->ci->mdl_report_online->week()->result();		
		$i=3;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, 'Week '.($i-2));
			$active_sheet->setCellValue('B'.$i, $r->count);
			$active_sheet->setCellValue('C'.$i, $r->vo);
			$active_sheet->setCellValue('D'.$i, $r->vw);
			$active_sheet->setCellValue('E'.$i, $r->leg);
			$active_sheet->setCellValue('F'.$i, $r->mat);
			$active_sheet->setCellValue('G'.$i, $r->id);
			$active_sheet->setCellValue('H'.$i, $r->img);
			$active_sheet->setCellValue('I'.$i, $r->un);
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
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('B'.$i, $total[1]);
		$active_sheet->setCellValue('C'.$i, $total[2]);
		$active_sheet->setCellValue('D'.$i, $total[3]);
		$active_sheet->setCellValue('E'.$i, $total[4]);
		$active_sheet->setCellValue('F'.$i, $total[5]);
		$active_sheet->setCellValue('G'.$i, $total[6]);
		$active_sheet->setCellValue('H'.$i, $total[7]);
		$active_sheet->setCellValue('I'.$i, $total[8]);
		$active_sheet->getStyle("A".$i.":"."I".$i)->getFont()->setBold(true);		
		
		$filename = 'Online Week Report '.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');		
	}	
	function sex(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Online Sex Report');
		
		//style
		$active_sheet->getStyle("A1:D1")->getFont()->setBold(true);
		$active_sheet->getStyle("A1:D1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$active_sheet->getStyle("A1:D1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//header
		$active_sheet->setCellValue('A1', 'Periode');
		$active_sheet->setCellValue('B1', 'Jumlah Data Masuk');
		$active_sheet->setCellValue('C1', 'Male');
		$active_sheet->setCellValue('D1', 'Female');

		$result = $this->ci->mdl_report_online->sex()->result();		
		$i=2;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, 'Week '.($i-1));
			$active_sheet->setCellValue('B'.$i, $r->count);
			$active_sheet->setCellValue('C'.$i, $r->m);
			$active_sheet->setCellValue('D'.$i, $r->f);
			$total[1] += $r->count;
			$total[2] += $r->m;
			$total[3] += $r->f;
			$i++;
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('B'.$i, $total[1]);
		$active_sheet->setCellValue('C'.$i, $total[2]);
		$active_sheet->setCellValue('D'.$i, $total[3]);
		$active_sheet->getStyle("A".$i.":"."I".$i)->getFont()->setBold(true);		
		
		$filename = 'Online Sex Report '.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');		
	}	
	function city_gap(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Online City Report');
		
		//style
		$active_sheet->getStyle("A1:AA2")->getFont()->setBold(true);
		$active_sheet->mergeCells('A1:A2');
		$active_sheet->mergeCells('B1:M1');
		$active_sheet->mergeCells('N1:N2');
		$active_sheet->mergeCells('O1:Z1');
		$active_sheet->mergeCells('AA1:AA2');
		$active_sheet->getStyle("A1:AA2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$active_sheet->getStyle("A1:AA2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//header
		$active_sheet->setCellValue('A1', 'WEEK');
		$active_sheet->setCellValue('B1', 'VERIFIED');
		$active_sheet->setCellValue('B2', 'BDG');
		$active_sheet->setCellValue('C2', 'JKT');
		$active_sheet->setCellValue('D2', 'MDN');
		$active_sheet->setCellValue('E2', 'PLMBG');
		$active_sheet->setCellValue('F2', 'SBY');
		$active_sheet->setCellValue('G2', 'YOGYA');
		$active_sheet->setCellValue('H2', 'PDG');
		$active_sheet->setCellValue('I2', 'LMPG');
		$active_sheet->setCellValue('J2', 'SMG');
		$active_sheet->setCellValue('K2', 'DPS');
		$active_sheet->setCellValue('L2', 'MKS');
		$active_sheet->setCellValue('M2', 'OTHERS');
		$active_sheet->setCellValue('N1', 'TOTAL');
		$active_sheet->setCellValue('O1', 'ALL STATUS');
		$active_sheet->setCellValue('O2', 'BDG');
		$active_sheet->setCellValue('P2', 'JKT');
		$active_sheet->setCellValue('Q2', 'MDN');
		$active_sheet->setCellValue('R2', 'PLMBG');
		$active_sheet->setCellValue('S2', 'SBY');
		$active_sheet->setCellValue('T2', 'YOGYA');
		$active_sheet->setCellValue('U2', 'PDG');
		$active_sheet->setCellValue('V2', 'LMPG');
		$active_sheet->setCellValue('W2', 'SMG');
		$active_sheet->setCellValue('X2', 'DPS');
		$active_sheet->setCellValue('Y2', 'MKS');
		$active_sheet->setCellValue('Z2', 'OTHERS');
		$active_sheet->setCellValue('AA1', 'TOTAL');

		$result = $this->ci->mdl_report_online->city_gap()->result();		
		$i=3;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, 'Week '.($i-2));
			$active_sheet->setCellValue('B'.$i,$r->vbdg);
			$active_sheet->setCellValue('C'.$i,$r->vjkt);
			$active_sheet->setCellValue('D'.$i,$r->vmdn);
			$active_sheet->setCellValue('E'.$i,$r->vplmbg);
			$active_sheet->setCellValue('F'.$i,$r->vsby);
			$active_sheet->setCellValue('G'.$i,$r->vyogya);
			$active_sheet->setCellValue('H'.$i,$r->vpdg);
			$active_sheet->setCellValue('I'.$i,$r->vlmpg);
			$active_sheet->setCellValue('J'.$i,$r->vsmg);
			$active_sheet->setCellValue('K'.$i,$r->vdps);
			$active_sheet->setCellValue('L'.$i,$r->vmks);
			$active_sheet->setCellValue('M'.$i,$r->voth);
			$active_sheet->setCellValue('N'.$i,$r->vtot);
			
			$active_sheet->setCellValue('O'.$i,$r->abdg);
			$active_sheet->setCellValue('P'.$i,$r->ajkt);
			$active_sheet->setCellValue('Q'.$i,$r->amdn);
			$active_sheet->setCellValue('R'.$i,$r->aplmbg);
			$active_sheet->setCellValue('S'.$i,$r->asby);
			$active_sheet->setCellValue('T'.$i,$r->ayogya);
			$active_sheet->setCellValue('U'.$i,$r->apdg);
			$active_sheet->setCellValue('V'.$i,$r->almpg);
			$active_sheet->setCellValue('W'.$i,$r->asmg);
			$active_sheet->setCellValue('X'.$i,$r->adps);
			$active_sheet->setCellValue('Y'.$i,$r->amks);
			$active_sheet->setCellValue('Z'.$i,$r->aoth);
			$active_sheet->setCellValue('AA'.$i,$r->atot);
				
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
			$i++;
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$nu = 1;
		for($a='B';$a!='Z';$a++){
			$active_sheet->setCellValue($a.$i, $total[$nu]);
			$nu++;
		}
		$active_sheet->setCellValue('Z'.$i, $total[$nu++]);
		$active_sheet->setCellValue('AA'.$i, $total[$nu]);
		$active_sheet->getStyle("A".$i.":"."AA".$i)->getFont()->setBold(true);		
				
		$filename = 'Online City Report (GAP)'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');		
	}
	function brand_gap(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Online Brand Report');
		
		//style
		$active_sheet->getStyle("A1:Q2")->getFont()->setBold(true);
		$active_sheet->mergeCells('A1:A2');
		$active_sheet->mergeCells('B1:H1');
		$active_sheet->mergeCells('I1:I2');
		$active_sheet->mergeCells('J1:P1');
		$active_sheet->mergeCells('Q1:Q2');
		$active_sheet->getStyle("A1:Q2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$active_sheet->getStyle("A1:Q2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//header
		$active_sheet->setCellValue('A1', 'WEEK');
		$active_sheet->setCellValue('B1', 'VERIFIED');
		$active_sheet->setCellValue('B2', 'AMILD');
		$active_sheet->setCellValue('C2', 'AVOLUTION');
		$active_sheet->setCellValue('D2', 'DJARUM');
		$active_sheet->setCellValue('E2', 'DUNHILL');
		$active_sheet->setCellValue('F2', 'GG');
		$active_sheet->setCellValue('G2', 'LA LIGHT');
		$active_sheet->setCellValue('H2', 'OTHERS');
		$active_sheet->setCellValue('I1', 'TOTAL');
		$active_sheet->setCellValue('J1', 'ALL STATUS');
		$active_sheet->setCellValue('J2', 'AMILD');
		$active_sheet->setCellValue('K2', 'AVOLUTION');
		$active_sheet->setCellValue('L2', 'DJARUM');
		$active_sheet->setCellValue('M2', 'DUNHILL');
		$active_sheet->setCellValue('N2', 'GG');
		$active_sheet->setCellValue('O2', 'LA LIGHT');
		$active_sheet->setCellValue('P2', 'OTHERS');
		$active_sheet->setCellValue('Q1', 'TOTAL');

		$result = $this->ci->mdl_report_online->brand_gap()->result();		
		$i=3;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, 'Week '.($i-2));
			$active_sheet->setCellValue('B'.$i,$r->vaml);
			$active_sheet->setCellValue('C'.$i,$r->vavo);
			$active_sheet->setCellValue('D'.$i,$r->vdja);
			$active_sheet->setCellValue('E'.$i,$r->vdun);
			$active_sheet->setCellValue('F'.$i,$r->vgdg);
			$active_sheet->setCellValue('G'.$i,$r->vla);
			$active_sheet->setCellValue('H'.$i,$r->voth);
			$active_sheet->setCellValue('I'.$i,$r->vtot);
			
			$active_sheet->setCellValue('J'.$i,$r->aaml);
			$active_sheet->setCellValue('K'.$i,$r->aavo);
			$active_sheet->setCellValue('L'.$i,$r->adja);
			$active_sheet->setCellValue('M'.$i,$r->adun);
			$active_sheet->setCellValue('N'.$i,$r->agdg);
			$active_sheet->setCellValue('O'.$i,$r->ala);
			$active_sheet->setCellValue('P'.$i,$r->aoth);
			$active_sheet->setCellValue('Q'.$i,$r->atot);
				
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
			$i++;
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$nu = 1;
		for($a='B';$a!='R';$a++){
			$active_sheet->setCellValue($a.$i, $total[$nu]);
			$nu++;
		}
		$active_sheet->getStyle("A".$i.":"."Q".$i)->getFont()->setBold(true);		
				
		$filename = 'Online Brand Report (GAP)'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');		
	}
	function brand_umild(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Online Brand Report');
		
		//style
		$active_sheet->getStyle("A1:M2")->getFont()->setBold(true);
		$active_sheet->mergeCells('A1:A2');
		$active_sheet->mergeCells('B1:B2');
		$active_sheet->mergeCells('C1:G1');
		$active_sheet->mergeCells('H1:L1');
		$active_sheet->mergeCells('M1:M2');
		$active_sheet->getStyle("A1:M2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$active_sheet->getStyle("A1:M2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//header
		$active_sheet->setCellValue('A1', 'WEEK');
		$active_sheet->setCellValue('B1', 'U Mild');
		$active_sheet->setCellValue('C1', 'HMS');
		$active_sheet->setCellValue('C2', 'AMILD');
		$active_sheet->setCellValue('D2', 'AVOLUTION');
		$active_sheet->setCellValue('E2', 'DSS');
		$active_sheet->setCellValue('F2', 'MARLBORO');
		$active_sheet->setCellValue('G2', 'MAGNUM');
		$active_sheet->setCellValue('H1', 'NON HMS');
		$active_sheet->setCellValue('H2', 'L.A LIGHT');
		$active_sheet->setCellValue('I2', 'GG SURYA PRO MILD');
		$active_sheet->setCellValue('J2', 'DJARUM SUPER');
		$active_sheet->setCellValue('K2', 'GUDANG GARAM');
		$active_sheet->setCellValue('L2', 'OTHERS');
		$active_sheet->setCellValue('M1', 'TOTAL');

		$result = $this->ci->mdl_report_online->brand_umild()->result();		
		$i=3;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, 'Week '.($i-2));
			$active_sheet->setCellValue('B'.$i,$r->uml);
			$active_sheet->setCellValue('C'.$i,$r->aml);
			$active_sheet->setCellValue('D'.$i,$r->avo);
			$active_sheet->setCellValue('E'.$i,$r->dji);
			$active_sheet->setCellValue('F'.$i,$r->mar);
			$active_sheet->setCellValue('G'.$i,$r->mag);
			$active_sheet->setCellValue('H'.$i,$r->la);
			$active_sheet->setCellValue('I'.$i,$r->sur);
			$active_sheet->setCellValue('J'.$i,$r->dja);
			$active_sheet->setCellValue('K'.$i,$r->gud);
			$active_sheet->setCellValue('L'.$i,$r->oth);
			$active_sheet->setCellValue('M'.$i,$r->tot);
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
			$i++;
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$nu = 1;
		for($a='B';$a!='N';$a++){
			$active_sheet->setCellValue($a.$i, $total[$nu]);
			$nu++;
		}
		$active_sheet->getStyle("A".$i.":"."M".$i)->getFont()->setBold(true);		
				
		$filename = 'Online Brand Report (U Mild)'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');		
	}
	function age_gap(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Online Age Report');
		
		//style
		$active_sheet->getStyle("A1:I2")->getFont()->setBold(true);
		$active_sheet->mergeCells('A1:A2');
		$active_sheet->mergeCells('B1:D1');
		$active_sheet->mergeCells('E1:E2');
		$active_sheet->mergeCells('F1:H1');
		$active_sheet->mergeCells('I1:I2');
		$active_sheet->getStyle("A1:I2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$active_sheet->getStyle("A1:I2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//header
		$active_sheet->setCellValue('A1', 'WEEK');
		$active_sheet->setCellValue('B1', 'VERIFIED');
		$active_sheet->setCellValue('B2', '18-24');
		$active_sheet->setCellValue('C2', '22-29');
		$active_sheet->setCellValue('D2', '29+');
		$active_sheet->setCellValue('E1', 'TOTAL');
		$active_sheet->setCellValue('F1', 'ALL STATUS');
		$active_sheet->setCellValue('F2', '18-24');
		$active_sheet->setCellValue('G2', '22-29');
		$active_sheet->setCellValue('H2', '29+');
		$active_sheet->setCellValue('I1', 'TOTAL');
		
		$result = $this->ci->mdl_report_online->age_gap()->result();		
		$i=3;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, 'Week '.($i-2));
			$active_sheet->setCellValue('B'.$i,$r->vrem);
			$active_sheet->setCellValue('C'.$i,$r->vdew);
			$active_sheet->setCellValue('D'.$i,$r->vtua);
			$active_sheet->setCellValue('E'.$i,$r->vtot);
			$active_sheet->setCellValue('F'.$i,$r->arem);
			$active_sheet->setCellValue('G'.$i,$r->adew);
			$active_sheet->setCellValue('H'.$i,$r->atua);
			$active_sheet->setCellValue('I'.$i,$r->atot);
							
			$total[1] += $r->vrem;
			$total[2] += $r->vdew;
			$total[3] += $r->vtua;
			$total[4] += $r->vtot;
			$total[5] += $r->arem;
			$total[6] += $r->adew;
			$total[7] += $r->atua;
			$total[8] += $r->atot;
			$i++;
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$nu = 1;
		for($a='B';$a!='J';$a++){
			$active_sheet->setCellValue($a.$i, $total[$nu]);
			$nu++;
		}
		$active_sheet->getStyle("A".$i.":"."I".$i)->getFont()->setBold(true);		
				
		$filename = 'Online Age Report (GAP)'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');		
	}
	function age_umild(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Online Age Report');
		
		//style
		$active_sheet->getStyle("A1:M2")->getFont()->setBold(true);
		$active_sheet->mergeCells('A1:A2');
		$active_sheet->mergeCells('B1:F1');
		$active_sheet->mergeCells('G1:G2');
		$active_sheet->mergeCells('H1:L1');
		$active_sheet->mergeCells('M1:M2');
		$active_sheet->getStyle("A1:M2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$active_sheet->getStyle("A1:M2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//header
		$active_sheet->setCellValue('A1', 'WEEK');
		$active_sheet->setCellValue('B1', 'VERIFIED');
		$active_sheet->setCellValue('B2', '18-24');
		$active_sheet->setCellValue('C2', '22-29');
		$active_sheet->setCellValue('D2', '30-34');
		$active_sheet->setCellValue('E2', '35-40');
		$active_sheet->setCellValue('F2', '40+');
		$active_sheet->setCellValue('G1', 'TOTAL');
		$active_sheet->setCellValue('H1', 'ALL STATUS');
		$active_sheet->setCellValue('H2', '18-24');
		$active_sheet->setCellValue('I2', '22-29');
		$active_sheet->setCellValue('J2', '30-34');
		$active_sheet->setCellValue('K2', '35-40');
		$active_sheet->setCellValue('L2', '40+');
		$active_sheet->setCellValue('M1', 'TOTAL');
		
		$result = $this->ci->mdl_report_online->age_umild()->result();		
		$i=3;
		$total = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0,18=>0,19=>0,20=>0,21=>0,22=>0,23=>0,24=>0,25=>0,26=>0);
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, 'Week '.($i-2));
			$active_sheet->setCellValue('B'.$i,$r->vrem);
			$active_sheet->setCellValue('C'.$i,$r->vdew1);
			$active_sheet->setCellValue('D'.$i,$r->vdew2);
			$active_sheet->setCellValue('E'.$i,$r->vdew3);
			$active_sheet->setCellValue('F'.$i,$r->vtua);
			$active_sheet->setCellValue('G'.$i,$r->vtot);
			$active_sheet->setCellValue('H'.$i,$r->arem);
			$active_sheet->setCellValue('I'.$i,$r->adew1);
			$active_sheet->setCellValue('J'.$i,$r->adew2);
			$active_sheet->setCellValue('K'.$i,$r->adew3);
			$active_sheet->setCellValue('L'.$i,$r->atua);
			$active_sheet->setCellValue('M'.$i,$r->atot);
			
			$j=1;
			$total[$j++] += $r->vrem;
			$total[$j++] += $r->vdew;
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
			$i++;
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$nu = 1;
		for($a='B';$a!='N';$a++){
			$active_sheet->setCellValue($a.$i, $total[$nu]);
			$nu++;
		}
		$active_sheet->getStyle("A".$i.":"."M".$i)->getFont()->setBold(true);		
				
		$filename = 'Online Age Report (U Mild)'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');		
	}	
}