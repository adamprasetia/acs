<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_fee extends MY_Controller {
	var $fee_siang = 100000,$fee_malam = 110000,$fee_training = 85000;
	function __construct(){
		parent::__construct();
		$this->load->helper('mod_helper');
		$this->load->model('mdl_mod_absent');
	}
	function index(){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		if($date_from <> '' && $date_to <> ''){
			require_once "../assets/fpdf/fpdf.php";
			$pdf = new FPDF();

			$pdf->AliasNbPages();
			$pdf->AddPage('L','A4');
			$pdf->SetTitle("Fee Moderasi HM Sampoerna");
			
			//title
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(0,10,'Report Fee Moderasi HM Sampoerna',0,0,'C');
			$pdf->Ln(10);		
			
			$this->_header($pdf);
			
			//rows
			$pdf->SetFont('Arial','',10);
			$pdf->SetDrawColor(0,0,0);
			$pdf->SetTextColor(0,0,0);				
			$result = moderator();
			$total_siang = 0;
			$total_malam = 0;
			$i=1;
			foreach($result as $r){
				if($r[2]==1){
					$pdf->Cell(10,7,$i++,1,0,'C');
					$pdf->Cell(40,7,$r[1],1,0,'L');
					$from = date_create(format_tanggal_barat($date_from));
					$to = date_create(format_tanggal_barat($date_to));
					$j=0;
					$jum_siang = 0;
					$tot_siang = 0;
					$jum_malam = 0;
					$tot_malam = 0;
					while($from <= $to){
						$siang = $this->mdl_mod_absent->fee(date_format($from,'Y-m-d'),$r[0],'SIANG');
						$pdf->Cell(9,7,number_format($siang),1,0,'C');
						$malam = $this->mdl_mod_absent->fee(date_format($from,'Y-m-d'),$r[0],'MALAM');
						$pdf->Cell(9,7,number_format($malam),1,0,'C');
						$jum_siang += $siang;
						$jum_malam += $malam;
						date_add($from, date_interval_create_from_date_string('1 days'));
						$j++;
					}
					$pdf->Cell(10,7,number_format($jum_siang),1,0,'C');
					$pdf->Cell(20,7,number_format($jum_siang*$this->fee_siang),1,0,'C');
					$pdf->Cell(10,7,number_format($jum_malam),1,0,'C');
					$pdf->Cell(20,7,number_format($jum_malam*$this->fee_malam),1,0,'C');
					$total = $jum_siang+$jum_malam;
					$pdf->Cell(10,7,number_format($total),1,0,'C');
					$pdf->Cell(0,7,number_format(($jum_siang*$this->fee_siang)+($jum_malam*$this->fee_malam)),1,0,'C');
					$pdf->Ln(7);
					$total_siang += $jum_siang;
					$total_malam += $jum_malam;
				}
			}
			$pdf->SetFillColor(240,240,240);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(50+(18*$j),7,'Total : ',1,0,'R',true);
			$pdf->Cell(10,7,number_format($total_siang),1,0,'C',true);
			$pdf->Cell(20,7,number_format($total_siang*$this->fee_siang),1,0,'C',true);
			$pdf->Cell(10,7,number_format($total_malam),1,0,'C',true);
			$pdf->Cell(20,7,number_format($total_malam*$this->fee_malam),1,0,'C',true);
			$pdf->Cell(10,7,number_format($total_siang+$total_malam),1,0,'C',true);
			$pdf->Cell(0,7,number_format(($total_siang*$this->fee_siang)+($total_malam*$this->fee_malam)),1,0,'C',true);
			
			$this->_footer($pdf);

			/* --- TRAINING ----*/
			
			$pdf->AddPage('L','A4');
			
			//title
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(0,10,'Report Fee Training Moderasi HM Sampoerna',0,0,'C');
			$pdf->Ln(10);
			
			$this->_header_training($pdf);

			//rows
			$pdf->SetFont('Arial','',10);
			$pdf->SetDrawColor(0,0,0);
			$pdf->SetTextColor(0,0,0);				
			$result = moderator();
			$total = 0;
			$i=1;
			foreach($result as $r){
				if($r[2]==1){
					$pdf->Cell(10,7,$i++,1,0,'C');
					$pdf->Cell(40,7,$r[1],1,0,'L');
					$from = date_create(format_tanggal_barat($date_from));
					$to = date_create(format_tanggal_barat($date_to));
					$j=0;
					$jum = 0;
					while($from <= $to){
						$jumlah = $this->mdl_mod_absent->fee(date_format($from,'Y-m-d'),$r[0],'TRAINING');
						$pdf->Cell(18,7,number_format($jumlah),1,0,'C');
						$jum += $jumlah;
						date_add($from, date_interval_create_from_date_string('1 days'));
						$j++;
					}
					$pdf->Cell(30,7,number_format($jum),1,0,'C');
					$pdf->Cell(0,7,number_format($jum*$this->fee_training),1,0,'C');
					$total += $jum;
					$pdf->Ln(7);
				}
			}
			$pdf->SetFillColor(240,240,240);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(50+(18*$j),7,'Total : ',1,0,'R',true);
			$pdf->Cell(30,7,number_format($total),1,0,'C',true);
			$pdf->Cell(0,7,number_format($total*$this->fee_training),1,0,'C',true);						
			$this->_footer($pdf);
						
			$pdf->Output("Fee Moderasi HM Sampoerna","I");
		}else{
			$this->session->set_flashdata('alert','<div class="alert alert-danger">Date Empty!!!</div>');
			redirect('absent');
		}
	}
	function fee_senior(){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		if($date_from <> '' && $date_to <> ''){
			require_once "../assets/fpdf/fpdf.php";
			$pdf = new FPDF();

			$pdf->AliasNbPages();
			$pdf->AddPage('L','A4');						
			//title
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(0,10,'Report Absensi Moderasi HM Sampoerna',0,0,'C');
			$pdf->Ln(10);			
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(0,5,'Periode Tanggal : '.$this->input->get('date_from').' s/d '.$this->input->get('date_to'),0,0,'C');
			$pdf->Ln(10);
			
			//header
			$pdf->SetFont('Arial','B',10);
			$pdf->SetDrawColor(0,0,0);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(10,14,'No',1,0,'C');
			$pdf->Cell(40,14,'Moderator',1,0,'C');

			$from = date_create(format_tanggal_barat($date_from));
			$to = date_create(format_tanggal_barat($date_to));
			$j=0;
			while($from <= $to){
				$pdf->SetXY(60+$j,30);
				$pdf->Cell(6,7,date_format($from,"d"),1,0,'C');
				$pdf->SetXY(60+$j,37);
				$pdf->Cell(6,7,date_format($from,"m"),1,0,'C');
				date_add($from, date_interval_create_from_date_string('1 days'));
				$j+=6;
			}						
			$pdf->SetXY($j+60,30);
			$pdf->Cell(0,14,'Jumlah',1,0,'C');
			$pdf->Ln(14);

			//rows
			$pdf->SetFont('Arial','',10);
			$pdf->SetDrawColor(0,0,0);
			$pdf->SetTextColor(0,0,0);				
			$result = moderator();
			$total = 0;
			$i=1;
			foreach($result as $r){
				if($r[2]==2){
					$pdf->Cell(10,7,$i++,1,0,'C');
					$pdf->Cell(40,7,$r[1],1,0,'L');
					$from = date_create(format_tanggal_barat($date_from));
					$to = date_create(format_tanggal_barat($date_to));
					$j=0;
					$jum = 0;
					while($from <= $to){
						$jumlah = $this->mdl_mod_absent->fee_senior(date_format($from,'Y-m-d'),$r[0]);
						$pdf->Cell(6,7,number_format($jumlah),1,0,'C');
						$jum += $jumlah;
						date_add($from, date_interval_create_from_date_string('1 days'));
						$j++;
					}
					$pdf->Cell(0,7,number_format($jum),1,0,'C');
					$total += $jum;
					$pdf->Ln(7);
				}
			}
			$pdf->SetFillColor(240,240,240);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(50+(6*$j),7,'Total : ',1,0,'R',true);
			$pdf->Cell(0,7,number_format($total),1,0,'C',true);
			$pdf->SetFont('Arial','',10);			
			$this->_footer($pdf);
						
			$pdf->Output("Fee Moderasi HM Sampoerna","I");		
		}else{
			$this->session->set_flashdata('alert','<div class="alert alert-danger">Date Empty!!!</div>');
			redirect('absent');
		}
	}
	function _header($pdf){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0,5,'Periode Tanggal : '.$this->input->get('date_from').' s/d '.$this->input->get('date_to'),0,0,'C');
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B',10);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10,21,'No',1,0,'C');
		$pdf->Cell(40,21,'Moderator',1,0,'C');
		$from = date_create(format_tanggal_barat($date_from));
		$to = date_create(format_tanggal_barat($date_to));
		$j=0;
		while($from <= $to){
			$pdf->SetXY(60+$j,30);
			$pdf->Cell(18,7,get_nama_hari(date_format($from,"N")),1,0,'C');
			$pdf->SetXY(60+$j,37);
			$pdf->Cell(18,7,date_format($from,"d/m/y"),1,0,'C');
			$pdf->SetXY(60+$j,44);
			$pdf->Cell(9,7,"S",1,0,'C');
			$pdf->Cell(9,7,"M",1,0,'C');				
			date_add($from, date_interval_create_from_date_string('1 days'));
			$j+=18;
		}			
		$pdf->SetXY($j+60,30);
		$pdf->Cell(30,21,'Siang',1,0,'C');
		$pdf->Cell(30,21,'Malam',1,0,'C');
		$pdf->Cell(0,21,'Total',1,0,'C');
		$pdf->Ln(21);		
	}
	function _header_training($pdf){
		$date_from = $this->input->get("date_from");
		$date_to = $this->input->get("date_to");
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0,5,'Periode Tanggal : '.$this->input->get('date_from').' s/d '.$this->input->get('date_to'),0,0,'C');
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B',10);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10,14,'No',1,0,'C');
		$pdf->Cell(40,14,'Moderator',1,0,'C');
		$from = date_create(format_tanggal_barat($date_from));
		$to = date_create(format_tanggal_barat($date_to));
		$j=0;
		while($from <= $to){
			$pdf->SetXY(60+$j,30);
			$pdf->Cell(18,7,get_nama_hari(date_format($from,"N")),1,0,'C');
			$pdf->SetXY(60+$j,37);
			$pdf->Cell(18,7,date_format($from,"d/m/y"),1,0,'C');
			date_add($from, date_interval_create_from_date_string('1 days'));
			$j+=18;
		}			
		$pdf->SetXY($j+60,30);
		$pdf->Cell(30,14,'Jumlah',1,0,'C');
		$pdf->Cell(0,14,'Total',1,0,'C');
		$pdf->Ln(14);		
	}
	function _footer($pdf){
		$pdf->SetFont('Arial','',10);			
		$pdf->Ln(10);
		$pdf->Cell(0,5,'Jakarta, '.date('d M Y'),0,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(70,5,'Dibuat Oleh',1,0,'C');
		$pdf->Cell(135,5,'Diperiksa Oleh',1,0,'C');
		$pdf->Cell(0,5,'Disetujui Oleh',1,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(70,20,'',1,0,'C');
		$pdf->Cell(45,20,'',1,0,'C');
		$pdf->Cell(45,20,'',1,0,'C');
		$pdf->Cell(45,20,'',1,0,'C');
		$pdf->Cell(0,20,'',1,0,'C');
		$pdf->Ln(20);
		$pdf->Cell(70,5,'('.$this->template->get_username().')',1,0,'C');
		$pdf->Cell(45,5,'(Teguh Santoso)',1,0,'C');
		$pdf->Cell(45,5,'(HRD)',1,0,'C');
		$pdf->Cell(45,5,'(Farida Ambarwati)',1,0,'C');
		$pdf->Cell(0,5,'(Kannadasen)',1,0,'C');		
	}
}