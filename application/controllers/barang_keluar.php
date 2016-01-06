<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_keluar extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_barang');
		$this->load->model('mdl_campaign');
		$this->load->model('mdl_barang_keluar');
		$this->load->model('mdl_vendor');
	}
	function index(){
		$offset = $this->lib_general->value_get('offset',0);
		$limit = $this->lib_general->value_get('limit',10);

		$data['title'] = 'ACS - Barang Keluar';
		$data['action'] = site_url('barang_keluar/search'.$this->_filter());
		$data['action_add'] = site_url('barang_keluar/add'.$this->_filter());
		$data['export_btn'] = anchor('barang_keluar/export'.$this->_filter(),'<span class="glyphicon glyphicon-export"></span> Export Excel 2007',array('class'=>'btn btn-primary btn-sm'));
		$this->table->set_template(tbl_tmp());
		
		$head_data = array(
			'barang_name'=>'Nama Barang'
			,'tanggal'=>'Tanggal'
			,'banyak'=>'Banyak'
			,'retur'=>'Retur'
			,'vendor_name'=>'Vendor'
			,'operator'=>'Operator'
			,'keterangan'=>'Keterangan'
		);
		$heading[] = 'No';
		foreach($head_data as $r => $value){
			$heading[] = anchor('barang_keluar'.$this->_filter(array('order_column'=>$r,'order_type'=>$this->lib_general->order_type($r))),$value." ".$this->lib_general->order_icon($r));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->mdl_barang_keluar->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				$i++
				,anchor('barang_keluar/edit/'.$r->id.$this->_filter(),$r->barang_name)
				,format_tanggal($r->tanggal)	
				,$r->banyak	
				,$r->retur	
				,$r->vendor_name	
				,$r->operator	
				,$r->keterangan
				,anchor('barang_keluar/edit/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-edit"></span> Edit')
				."&nbsp;|&nbsp;".anchor('barang_keluar/delete/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-trash"></span> Delete',array('onclick'=>"return confirm('Are you sure')"))
			);
		}
		$data['table'] = $this->table->generate();
		$total = $this->mdl_barang_keluar->count_all();
		
		$config = pag_tmp();
		$config['base_url'] = site_url("barang_keluar".$this->_filter());
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['total'] = 'Showing '.($offset+1).' to '.($offset+$limit).' of '.number_format($total).' entries';
		$this->template->display('barang_keluar',$data);
	}
	function _set_rules(){
		$this->form_validation->set_rules('barang_id','Barang Name','trim|required');
		$this->form_validation->set_rules('tanggal','Tanggal','trim|required');
		$this->form_validation->set_rules('banyak','Banyak','trim|required');
		$this->form_validation->set_rules('retur','Retur','trim');
		$this->form_validation->set_rules('vendor_id','Vendor','trim');
		$this->form_validation->set_rules('operator','Operator','trim');
		$this->form_validation->set_rules('keterangan','Keterangan','trim');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	function _field(){
		$data = array(
			'barang_id'=>$this->input->post('barang_id')
			,'tanggal'=>format_tanggal_barat($this->input->post('tanggal'))
			,'banyak'=>$this->input->post('banyak')
			,'retur'=>$this->input->post('retur')
			,'vendor_id'=>$this->input->post('vendor_id')
			,'operator'=>strtoupper($this->input->post('operator'))
			,'keterangan'=>strtoupper($this->input->post('keterangan'))
		);
		return $data;
	}
	function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$data['title'] = 'ACS - New';
			$data['breadcrumb'] = 'barang_keluar'.$this->_filter();
			$data['heading'] = 'New';
			$data['owner'] = '';
			$data['error'] = validation_errors();
			$data['action'] = form_open('barang_keluar/add'.$this->_filter());
			$this->template->display('barang_keluar_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_create'] = $this->session->userdata('user_login');
			$data['date_create'] = date('Y-m-d H:i:s');		
			$this->mdl_barang_keluar->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			redirect('barang_keluar'.$this->_filter());
		}
	}
	function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){			
			$data['title'] = 'ACS - Update';
			$data['breadcrumb'] = 'barang_keluar'.$this->_filter();
			$data['heading'] = 'Update';
			$data['error'] = validation_errors();
			$data['action'] = form_open('barang_keluar/edit/'.$id.$this->_filter());
			$data['close'] = form_close();
			$data['row'] = $this->mdl_barang_keluar->get_from_field('id',$id)->row();
			$data['owner'] = owner($data['row']);
			$this->template->display('barang_keluar_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_update'] = $this->session->userdata('user_login');
			$data['date_update'] = date('Y-m-d H:i:s');		
			$this->mdl_barang_keluar->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			redirect('barang_keluar/edit/'.$id.$this->_filter());
		}
	}
	function delete($id){		
		$this->mdl_barang_keluar->delete($id);
		$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
		redirect('barang_keluar'.$this->_filter());
	}
	function search(){
		$data = array(
			'search'=>$this->input->post('search')
			,'limit'=>$this->input->post('limit')
			,'campaign_id'=>$this->input->post('campaign_id')
			,'tanggal_from'=>$this->input->post('tanggal_from')
			,'tanggal_to'=>$this->input->post('tanggal_to')
			,'offset'=>0
		);
		redirect('barang_keluar'.$this->_filter($data));
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array('order_column'=>0,'order_type'=>0,'limit'=>0,'offset'=>0,'search'=>0,'campaign_id'=>0
			,'tanggal_from'=>0,'tanggal_to'=>0
		);
		$result = array_diff_key($data,$add);
		foreach($result as $r => $val){			
			if($this->input->get($r)<>''){
				$str .="&$r=".$this->input->get($r);
			}
		}
		if($add<>''){
			foreach($add as $r => $val){
				if($val<>''){
					$str .="&$r=".$val;
				}
			}
		}
		return $str;
	}
	function export(){
		$order_column = ($this->input->get('order_column')<>''?$this->input->get('order_column'):'id');
		$order_type = ($this->input->get('order_type')<>''?$this->input->get('order_type'):'desc');
		
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Barang Keluar List');
		
		//style
		$active_sheet->getStyle("A1:G1")->getFont()->setBold(true);

		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', 'Barang Name');
		$active_sheet->setCellValue('C1', 'Tanggal');
		$active_sheet->setCellValue('D1', 'Banyak');
		$active_sheet->setCellValue('E1', 'Retur');
		$active_sheet->setCellValue('F1', 'Vendor');
		$active_sheet->setCellValue('G1', 'Operator');
		$active_sheet->setCellValue('H1', 'Keterangan');
		
		$result = $this->mdl_barang_keluar->export($order_column,$order_type)->result();
		$i=2;
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, $i-1);
			$active_sheet->setCellValue('B'.$i, $r->barang_name);
			$active_sheet->setCellValue('C'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->tanggal)));
			$active_sheet->getStyle('C'.$i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');		   
			$active_sheet->setCellValue('D'.$i, $r->banyak);
			$active_sheet->setCellValue('E'.$i, $r->retur);
			$active_sheet->setCellValue('F'.$i, $r->vendor_name);
			$active_sheet->setCellValue('G'.$i, $r->operator);
			$active_sheet->setCellValue('H'.$i, $r->keterangan);
			$i++;
		}

		$filename='LIST_BARANG_KELUAR_'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');							
	}	
}