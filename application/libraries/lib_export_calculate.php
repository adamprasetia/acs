<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_export_calculate {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
	}
	function calculate($key,$name){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle($name.' Calculate');
		
		//style
		$active_sheet->getStyle("A1:C1")->getFont()->setBold(true);
				
		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', $name);
		$active_sheet->setCellValue('C1', 'Count');
		
		$result = $this->ci->mdl_report_calculate->field($key)->result_array();
		$i=2;
		$total=0;
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, $i-1);
			$active_sheet->setCellValue('B'.$i, $r[$key]);
			$active_sheet->setCellValue('C'.$i, $r['count']);
			$i++;
			$total+=$r['count'];
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('C'.$i, $total);

		$filename = $name.' Calculate '.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');
	}
	function city(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('City Group Calculate');
		
		//style
		$active_sheet->getStyle("A1:C1")->getFont()->setBold(true);
				
		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', 'City');
		$active_sheet->setCellValue('C1', 'Count');
		
		$row = $this->ci->mdl_report_calculate->city()->row_array();
		
		$result = array(
			'BANDUNG'=>'aban'
			,'JAKARTA'=>'ajak'
			,'MEDAN'=>'amed'
			,'PALEMBANG'=>'apal'
			,'SURABAYA'=>'asur'
			,'YOGYAKARTA'=>'ayog'
			,'PADANG'=>'apad'
			,'LAMPUNG'=>'alam'
			,'SEMARANG'=>'asem'
			,'DENPASAR'=>'aden'
			,'MAKASSAR'=>'amak'
			,'OTHERS'=>'aoth'
		);
		$i=2;
		foreach($result as $r => $k){
			$active_sheet->setCellValue('A'.$i, ($i-1));
			$active_sheet->setCellValue('B'.$i, $r);
			$active_sheet->setCellValue('C'.$i, $row[$k]);
			$i++;		
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('C'.$i, $row['atot']);
		
		$filename = 'City Group Calculate '.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');
	}
	function city_age(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('City Age Calculate');
		
		//style
		$active_sheet->getStyle("A1:J1")->getFont()->setBold(true);
				
		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', 'City');
		$active_sheet->setCellValue('C1', '<18');
		$active_sheet->setCellValue('D1', '18-24');
		$active_sheet->setCellValue('E1', '25-29');
		$active_sheet->setCellValue('F1', '30-34');
		$active_sheet->setCellValue('G1', '35-40');
		$active_sheet->setCellValue('H1', '40+');
		$active_sheet->setCellValue('I1', 'Others');
		$active_sheet->setCellValue('J1', 'Count');
		
		$result = $this->ci->mdl_report_calculate->city_age()->result();
		$i=2;
		$count=0;
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, ($i-1));
			$active_sheet->setCellValue('B'.$i, $r->city_name);
			$active_sheet->setCellValue('C'.$i, $r->ank);
			$active_sheet->setCellValue('D'.$i, $r->rem);
			$active_sheet->setCellValue('E'.$i, $r->dew1);
			$active_sheet->setCellValue('F'.$i, $r->dew2);
			$active_sheet->setCellValue('G'.$i, $r->dew3);
			$active_sheet->setCellValue('H'.$i, $r->tua);
			$active_sheet->setCellValue('I'.$i, $r->oth);
			$active_sheet->setCellValue('J'.$i, $r->count);
			$i++;	
			$count += $r->count; 	
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('J'.$i, $count);
		
		$filename = 'City Age Calculate '.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');
	}
	function brand(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('City Brand Calculate');
		
		//style
		$active_sheet->getStyle("A1:C1")->getFont()->setBold(true);
				
		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', 'Brand');
		$active_sheet->setCellValue('C1', 'Count');
		
		$row = $this->ci->mdl_report_calculate->brand()->row_array();
		
		$result = array(
			'A MILD'=>'aaml'
			,'AVOLUTION'=>'aavo'
			,'DJARUM'=>'adja'
			,'DUNHILL'=>'adun'
			,'GUDANG GARAM'=>'agdg'
			,'L.A'=>'ala'
			,'OTHERS'=>'aoth'
		);
		$i=2;
		foreach($result as $r => $k){
			$active_sheet->setCellValue('A'.$i, ($i-1));
			$active_sheet->setCellValue('B'.$i, $r);
			$active_sheet->setCellValue('C'.$i, $row[$k]);
			$i++;		
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('C'.$i, $row['atot']);
		
		$filename = 'Brand Group Calculate '.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');		
	}
	function age(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('City Brand Calculate');
		
		//style
		$active_sheet->getStyle("A1:C1")->getFont()->setBold(true);
				
		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', 'Age');
		$active_sheet->setCellValue('C1', 'Count');
		
		$row = $this->ci->mdl_report_calculate->age()->row_array();
		
		$result = array(
			'18-24'=>'arem'
			,'25-29'=>'adew1'
			,'30-34'=>'adew2'
			,'35-40'=>'adew3'
			,'>40'=>'atua'
			,'OTHERS'=>'aoth'
		);
		$i=2;
		foreach($result as $r => $k){
			$active_sheet->setCellValue('A'.$i, ($i-1));
			$active_sheet->setCellValue('B'.$i, $r);
			$active_sheet->setCellValue('C'.$i, $row[$k]);
			$i++;		
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('C'.$i, $row['atot']);
		
		$filename = 'Age Calculate '.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');				
	}	
	function sba(){
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('SBA Calculate');
		
		//style
		$active_sheet->getStyle("A1:D1")->getFont()->setBold(true);
				
		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', 'City');
		$active_sheet->setCellValue('C1', 'SBA');
		$active_sheet->setCellValue('D1', 'Count');
		
		$result = $this->ci->mdl_report_calculate->sba()->result();
		
		$i=2;
		$total = 0;
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, ($i-1));
			$active_sheet->setCellValue('B'.$i, $r->city);
			$active_sheet->setCellValue('C'.$i, $r->sba_name);
			$active_sheet->setCellValue('D'.$i, $r->count);
			$i++;	
			$total += $r->count;	
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('D'.$i, $total);
		
		$filename = 'SBA Calculate '.date('Ymd_His').'.xlsx';
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
		$active_sheet->setTitle('Week Calculate');
		
		//style
		$active_sheet->getStyle("A1:C1")->getFont()->setBold(true);
				
		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', 'Week');
		$active_sheet->setCellValue('C1', 'Count');
		
		$result = $this->ci->mdl_report_calculate->week()->result();
		
		$i=2;
		$total = 0;
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, ($i-1));
			$active_sheet->setCellValue('B'.$i, "Week ".($i-1));
			$active_sheet->setCellValue('C'.$i, $r->count);
			$i++;	
			$total += $r->count;	
		}
		$active_sheet->setCellValue('A'.$i, 'Total');
		$active_sheet->setCellValue('C'.$i, $total);
		
		$filename = 'Week Calculate '.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');				
	}	
}