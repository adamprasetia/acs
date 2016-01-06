<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_barang');
		$this->load->model('mdl_campaign');
		$this->load->model('mdl_barang_masuk');
		$this->load->model('mdl_barang_keluar');
		$this->load->helper('campaign_helper');
	}
	function index(){
		$offset = $this->lib_general->value_get('offset',0);
		$limit = $this->lib_general->value_get('limit',10);

		$data['title'] = 'ACS - Barang';
		$data['action'] = site_url('barang/search'.$this->_filter());
		$data['add_btn'] = anchor('barang/add'.$this->_filter(),'<span class="glyphicon glyphicon-plus"></span> New',array('class'=>'btn btn-primary btn-sm'));
		$data['export_btn'] = anchor('barang/export'.$this->_filter(),'<span class="glyphicon glyphicon-export"></span> Export Excel 2007',array('class'=>'btn btn-primary btn-sm'));
		$this->table->set_template(tbl_tmp());
		
		$head_data = array(
			'name'=>'Nama Barang'
			,'campaign_name'=>'Campaign'
			,'campaign_brand'=>'Brand'
		);
		$heading[] = 'No';
		foreach($head_data as $r => $value){
			$heading[] = anchor('barang'.$this->_filter(array('order_column'=>$r,'order_type'=>$this->lib_general->order_type($r))),$value." ".$this->lib_general->order_icon($r));
		}		
		$heading[] = 'Masuk';
		$heading[] = 'Keluar';
		$heading[] = 'Retur';
		$heading[] = 'Stok';
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->mdl_barang->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$masuk = $this->mdl_barang_masuk->banyak($r->id)->row()->banyak;	
			$keluar = $this->mdl_barang_keluar->banyak($r->id)->row()->banyak;	
			$retur = $this->mdl_barang_keluar->retur($r->id)->row()->retur;	
			$this->table->add_row(
				$i++
				,anchor('barang/edit/'.$r->id.$this->_filter(),$r->name)
				,$r->campaign_name	
				,$r->campaign_brand	
				,number_format($masuk)
				,number_format($keluar)
				,number_format($retur)
				,number_format($masuk-$keluar+$retur)
				,anchor('barang/edit/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-edit"></span> Edit')
				."&nbsp;|&nbsp;".anchor('barang/delete/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-trash"></span> Delete',array('onclick'=>"return confirm('Are you sure')"))
			);
		}
		$data['table'] = $this->table->generate();
		$total = $this->mdl_barang->count_all();
		
		$config = pag_tmp();
		$config['base_url'] = site_url("barang".$this->_filter());
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['total'] = 'Showing '.($offset+1).' to '.($offset+$limit).' of '.number_format($total).' entries';
		$this->template->display('barang',$data);
	}
	function _set_rules(){
		$this->form_validation->set_rules('name','Barang Name','trim|required');
		$this->form_validation->set_rules('campaign_id','Campaign','trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	function _field(){
		$data = array(
			'name'=>strtoupper($this->input->post('name'))
			,'campaign_id'=>$this->input->post('campaign_id')
		);
		return $data;
	}
	function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$data['title'] = 'ACS - New';
			$data['breadcrumb'] = 'barang'.$this->_filter();
			$data['heading'] = 'New';
			$data['owner'] = '';
			$data['error'] = validation_errors();
			$data['action'] = form_open('barang/add'.$this->_filter());
			$this->template->display('barang_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_create'] = $this->session->userdata('user_login');
			$data['date_create'] = date('Y-m-d H:i:s');		
			$this->mdl_barang->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			redirect('barang/add'.$this->_filter());
		}
	}
	function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){			
			$data['title'] = 'ACS - Update';
			$data['breadcrumb'] = 'barang'.$this->_filter();
			$data['heading'] = 'Update';
			$data['error'] = validation_errors();
			$data['action'] = form_open('barang/edit/'.$id.$this->_filter());
			$data['close'] = form_close();
			$data['row'] = $this->mdl_barang->get_from_field('id',$id)->row();
			$data['owner'] = owner($data['row']);
			$this->template->display('barang_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_update'] = $this->session->userdata('user_login');
			$data['date_update'] = date('Y-m-d H:i:s');		
			$this->mdl_barang->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			redirect('barang/edit/'.$id.$this->_filter());
		}
	}
	function delete($id){		
		$this->mdl_barang->delete($id);
		$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
		redirect('barang'.$this->_filter());
	}
	function search(){
		$data = array(
			'search'=>$this->input->post('search')
			,'limit'=>$this->input->post('limit')
			,'campaign_id'=>$this->input->post('campaign_id')
			,'offset'=>0
		);
		redirect('barang'.$this->_filter($data));
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array('order_column'=>0,'order_type'=>0,'limit'=>0,'offset'=>0,'search'=>0,'campaign_id'=>0);
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
		$active_sheet->setTitle('Barang List');
		
		//style
		$active_sheet->getStyle("A1:G1")->getFont()->setBold(true);

		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', 'Barang Name');
		$active_sheet->setCellValue('C1', 'Campaign');
		$active_sheet->setCellValue('D1', 'Campaign Brand');
		$active_sheet->setCellValue('E1', 'Masuk');
		$active_sheet->setCellValue('F1', 'Keluar');
		$active_sheet->setCellValue('G1', 'Stok');
		
		$result = $this->mdl_barang->export($order_column,$order_type)->result();
		$i=2;
		foreach($result as $r){
			$masuk = $this->mdl_barang_masuk->banyak($r->id)->row()->banyak;	
			$keluar = $this->mdl_barang_keluar->banyak($r->id)->row()->banyak;	
			$active_sheet->setCellValue('A'.$i, $i-1);
			$active_sheet->setCellValue('B'.$i, $r->name);
			$active_sheet->setCellValue('C'.$i, $r->campaign_name);
			$active_sheet->setCellValue('D'.$i, $r->campaign_brand);
			$active_sheet->setCellValue('E'.$i, $masuk);
			$active_sheet->setCellValue('F'.$i, $keluar);
			$active_sheet->setCellValue('G'.$i, $masuk-$keluar);
			$i++;
		}

		$filename='LIST_BARANG_'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');							
	}	
}