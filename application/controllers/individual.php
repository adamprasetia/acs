<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Individual extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_individual');
		$this->load->model('mdl_campaign');
		$this->load->model('mdl_sba');
	}
	function index(){
		$offset = $this->lib_general->value_get('offset',0);
		$limit = $this->lib_general->value_get('limit',10);

		$data['title'] = 'ACS - Individual';
		$data['action'] = site_url('individual/search'.$this->_filter());
		$data['add_btn'] = anchor('individual/add'.$this->_filter(),'<span class="glyphicon glyphicon-plus"></span> New',array('class'=>'btn btn-primary btn-sm'));
		$data['export_btn'] = anchor('individual/export'.$this->_filter(),'<span class="glyphicon glyphicon-export"></span> Export Excel 2007',array('class'=>'btn btn-primary btn-sm'));
		$data['export_xls_btn'] = anchor('individual/export_xls'.$this->_filter(),'<span class="glyphicon glyphicon-export"></span> Export Excel 2003',array('class'=>'btn btn-primary btn-sm'));
		$data['breadcrumb'] = 'individual/filter'.$this->_filter();
		$this->table->set_template(tbl_tmp());
		
		$head_data = array(
			'id'=>'ID'
			,'firstname'=>'Fullname'
			,'sex'=>'Sex'
			,'id_number'=>'ID Number'
			,'email'=>'Email'
			,'city'=>'City'
			,'status_verifikasi'=>'Status'
		);
		$heading[] = 'No';
		foreach($head_data as $r => $value){
			$heading[] = anchor('individual'.$this->_filter(array('order_column'=>$r,'order_type'=>$this->lib_general->order_type($r))),$value." ".$this->lib_general->order_icon($r));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->mdl_individual->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				$i++
				,anchor('individual/edit/'.$r->id.$this->_filter(),$r->id)
				,$r->firstname.' '.$r->lastname
				,$r->sex
				,$r->id_number
				,$r->email  
				,$r->city
				,$r->status_verifikasi
				,anchor('individual/delete/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-trash"></span> Delete',array('onclick'=>"return confirm('Are you sure')"))
			);
		}
		$data['table'] = $this->table->generate();
		$total = $this->mdl_individual->count_all();
		
		$config = pag_tmp();
		$config['base_url'] = site_url("individual".$this->_filter());
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['total'] = page_total($offset,$limit,$total);
		$this->template->display('individual',$data);
	}
	function _set_rules(){
		$this->form_validation->set_rules('campaign_id','Campaign','required|trim');
		$this->form_validation->set_rules('mop_id','MOP ID','trim');
		$this->form_validation->set_rules('firstname','Firstname','required|trim');
		$this->form_validation->set_rules('lastname','Lastname','trim');
		$this->form_validation->set_rules('nickname','Nickname','trim');
		$this->form_validation->set_rules('sex','Sex','required|trim');
		$this->form_validation->set_rules('dob','Day of Birth','required|trim');
		$this->form_validation->set_rules('id_type','ID Type','trim');
		$this->form_validation->set_rules('id_number','ID Number','required|trim');
		$this->form_validation->set_rules('tlp','Telephone','trim');
		$this->form_validation->set_rules('address','Address','trim');
		$this->form_validation->set_rules('email','Email','required|trim');
		$this->form_validation->set_rules('fb','Fb','trim');
		$this->form_validation->set_rules('tw','Tw','trim');
		$this->form_validation->set_rules('city','City','trim');
		$this->form_validation->set_rules('pos_code','Pos Code','trim');
		$this->form_validation->set_rules('brand','Brand 1','required|trim');
		$this->form_validation->set_rules('brand_','Brand 2','trim');
		$this->form_validation->set_rules('source_type','Source Type','required|trim');
		$this->form_validation->set_rules('source_user','Source User','trim');
		$this->form_validation->set_rules('survey_date','Survey Date','trim');
		$this->form_validation->set_rules('upload_date','Upload Date','trim');
		$this->form_validation->set_rules('entry_date','Entry Date','trim');
		$this->form_validation->set_rules('verifikasi_date','Verifikasi Date','trim');
		$this->form_validation->set_rules('referred','Referred by','trim');
		$this->form_validation->set_rules('drn_number','DRN Number','trim');
		$this->form_validation->set_rules('status_verifikasi','Status Verifikasi','required|trim');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	function _field(){
		$data = array(
			'campaign_id'=>strtoupper($this->input->post('campaign_id'))
			,'mop_id'=>strtoupper($this->input->post('mop_id'))
			,'firstname'=>strtoupper($this->input->post('firstname'))
			,'lastname'=>strtoupper($this->input->post('lastname'))
			,'nickname'=>strtoupper($this->input->post('nickname'))
			,'sex'=>strtoupper($this->input->post('sex'))
			,'dob'=>format_tanggal_barat($this->input->post('dob'))
			,'id_type'=>strtoupper($this->input->post('id_type'))
			,'id_number'=>strtoupper($this->input->post('id_number'))
			,'tlp'=>strtoupper($this->input->post('tlp'))
			,'address'=>strtoupper($this->input->post('address'))
			,'email'=>strtoupper($this->input->post('email'))
			,'fb'=>strtoupper($this->input->post('fb'))
			,'tw'=>strtoupper($this->input->post('tw'))
			,'city'=>strtoupper($this->input->post('city'))
			,'pos_code'=>strtoupper($this->input->post('pos_code'))
			,'brand'=>strtoupper($this->input->post('brand'))
			,'brand_'=>strtoupper($this->input->post('brand_'))
			,'source_type'=>strtoupper($this->input->post('source_type'))
			,'source_user'=>strtoupper($this->input->post('source_user'))
			,'survey_date'=>format_tanggal_barat($this->input->post('survey_date'))
			,'upload_date'=>format_tanggal_barat($this->input->post('upload_date'))
			,'entry_date'=>format_tanggal_barat($this->input->post('entry_date'))
			,'verifikasi_date'=>format_tanggal_barat($this->input->post('verifikasi_date'))
			,'referred'=>strtoupper($this->input->post('referred'))
			,'drn_number'=>strtoupper($this->input->post('drn_number'))
			,'status_verifikasi'=>strtoupper($this->input->post('status_verifikasi'))
		);
		return $data;
	}
	function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$data['title'] = 'ACS - New';
			$data['breadcrumb'] = 'individual'.$this->_filter();
			$data['heading'] = 'New';
			$data['owner'] = '';
			$data['error'] = validation_errors();
			$data['action'] = form_open('individual/add'.$this->_filter());
			$this->template->display('individual_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_create'] = $this->session->userdata('user_login');
			$data['date_create'] = date('Y-m-d H:i:s');		
			$this->mdl_individual->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			redirect('individual/add'.$this->_filter());
		}
	}
	function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){			
			$data['title'] = 'ACS - Update';
			$data['breadcrumb'] = 'individual'.$this->_filter();
			$data['heading'] = 'Update';
			$data['error'] = validation_errors();
			$data['action'] = form_open('individual/edit/'.$id.$this->_filter());
			$data['close'] = form_close();
			$data['row'] = $this->mdl_individual->get_from_field('id',$id)->row();
			$data['owner'] = owner($data['row']);
			$this->template->display('individual_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_update'] = $this->session->userdata('user_login');
			$data['date_update'] = date('Y-m-d H:i:s');		
			$this->mdl_individual->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			redirect('individual/edit/'.$id.$this->_filter());
		}
	}
	function delete($id){		
		$this->mdl_individual->delete($id);
		$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
		redirect('individual'.$this->_filter());
	}
	function search(){
		$data = array(
			'search'=>$this->input->post('search')
			,'limit'=>$this->input->post('limit')
			,'campaign_id'=>$this->input->post('campaign_id')
			,'offset'=>0
		);
		redirect('individual'.$this->_filter($data));
	}
	function filter(){
		$this->form_validation->set_rules('campaign_id','Campaign','trim');
		if($this->form_validation->run()===false){
			$data['title'] = 'ACS - Individual Filter';
			$data['action'] = form_open('individual/filter');
			$data['breadcrumb'] = 'individual'.$this->_filter();
			$this->template->display('individual_filter',$data);			
		}else{
			$data = array(
				'campaign_id'=>$this->input->post('campaign_id')
				,'id'=>$this->input->post('id')
				,'mop_id'=>$this->input->post('mop_id')
				,'firstname'=>$this->input->post('firstname')
				,'lastname'=>$this->input->post('lastname')
				,'nickname'=>$this->input->post('nickname')
				,'sex'=>$this->input->post('sex')
				,'dob_from'=>$this->input->post('dob_from')
				,'dob_to'=>$this->input->post('dob_to')
				,'id_type'=>$this->input->post('id_type')
				,'id_number'=>$this->input->post('id_number')
				,'tlp'=>$this->input->post('tlp')
				,'email'=>$this->input->post('email')
				,'fb'=>$this->input->post('fb')
				,'tw'=>$this->input->post('tw')
				,'address'=>$this->input->post('address')
				,'city'=>$this->input->post('city')
				,'pos_code'=>$this->input->post('pos_code')
				,'brand'=>$this->input->post('brand')
				,'brand_'=>$this->input->post('brand_')
				,'source_type'=>$this->input->post('source_type')
				,'source_user'=>$this->input->post('source_user')
				,'survey_date_from'=>$this->input->post('survey_date_from')
				,'survey_date_to'=>$this->input->post('survey_date_to')
				,'upload_date_from'=>$this->input->post('upload_date_from')
				,'upload_date_to'=>$this->input->post('upload_date_to')
				,'entry_date_from'=>$this->input->post('entry_date_from')
				,'entry_date_to'=>$this->input->post('entry_date_to')
				,'verifikasi_date_from'=>$this->input->post('verifikasi_date_from')
				,'verifikasi_date_to'=>$this->input->post('verifikasi_date_to')
				,'drn_number'=>$this->input->post('drn_number')
				,'status_verifikasi'=>$this->input->post('status_verifikasi')
				,'offset'=>0
			);
			redirect('individual'.$this->_filter($data));			
		}
	}
	function query(){
		$data['title'] = 'ACS - Individual Query';
		$data['breadcrumb'] = 'individual'.$this->_filter();
		$this->template->display('individual_query',$data);
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array('order_column'=>0
			,'order_type'=>0
			,'limit'=>0
			,'offset'=>0
			,'search'=>0
			,'campaign_id'=>0
			,'id'=>0
			,'mop_id'=>0
			,'firstname'=>0
			,'lastname'=>0
			,'nickname'=>0
			,'sex'=>0
			,'dob_from'=>0
			,'dob_to'=>0
			,'id_type'=>0
			,'id_number'=>0
			,'tlp'=>0
			,'email'=>0
			,'fb'=>0
			,'tw'=>0
			,'address'=>0
			,'city'=>0
			,'pos_code'=>0
			,'brand'=>0
			,'brand_'=>0
			,'source_type'=>0
			,'source_user'=>0
			,'survey_date_from'=>0
			,'survey_date_to'=>0
			,'upload_date_from'=>0
			,'upload_date_to'=>0
			,'entry_date_from'=>0
			,'entry_date_to'=>0
			,'verifikasi_date_from'=>0
			,'verifikasi_date_to'=>0
			,'referred'=>0
			,'drn_number'=>0
			,'status_verifikasi'=>0
			,'query'=>0
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
	function import(){
		ini_set('memory_limit','-1'); 
		$this->form_validation->set_rules('campaign_id','Campaign','trim');
		if($this->form_validation->run()===false){
			$data['title'] = 'ACS - Individual Import';
			$data['breadcrumb'] = 'individual'.$this->_filter();
			$this->template->display('individual_import',$data);			
		}else{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'xlsx';
			$config['file_name'] = 'import_individual_'.$this->session->userdata('user_login').'.xlsx';
			$config['overwrite'] = true;
			$config['encrypt_name'] = true;
			$config['max_size']	= '3000';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()){
				$this->session->set_flashdata('alert','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
			}else{
				require_once "../assets/phpexcel/PHPExcel.php";
				$excel = new PHPExcel();
				$excel = PHPExcel_IOFactory::load(FCPATH."/uploads/import_individual_".$this->session->userdata('user_login').".xlsx");
				$excel->setActiveSheetIndex(0);
				$active_sheet = $excel->getActiveSheet();
				if($active_sheet->getCell('B1')->getValue()=='MOP ID'){					
					$i=2;
					while(trim($active_sheet->getCell('A'.$i)->getValue())<>''){
						$data[] = array(
							'campaign_id'=>strtoupper(trim($this->input->post('campaign_id')))
							,'mop_id'=>strtoupper(trim($active_sheet->getCell('B'.$i)->getValue()))
							,'firstname'=>strtoupper(trim($active_sheet->getCell('C'.$i)->getValue()))
							,'lastname'=>strtoupper(trim($active_sheet->getCell('D'.$i)->getValue()))
							,'nickname'=>strtoupper(trim($active_sheet->getCell('E'.$i)->getValue()))
							,'sex'=>strtoupper(trim($active_sheet->getCell('F'.$i)->getValue()))
							,'dob'=>excel_to_date($active_sheet->getCell('G'.$i))
							,'id_type'=>strtoupper(trim($active_sheet->getCell('H'.$i)->getValue()))
							,'id_number'=>strtoupper(trim($active_sheet->getCell('I'.$i)->getValue()))
							,'tlp'=>strtoupper(trim($active_sheet->getCell('J'.$i)->getValue()))
							,'email'=>strtoupper(trim($active_sheet->getCell('K'.$i)->getValue()))
							,'referred'=>strtoupper(trim($active_sheet->getCell('L'.$i)->getValue()))
							,'fb'=>strtoupper(trim($active_sheet->getCell('M'.$i)->getValue()))
							,'tw'=>strtoupper(trim($active_sheet->getCell('N'.$i)->getValue()))
							,'address'=>strtoupper(trim($active_sheet->getCell('O'.$i)->getValue()))
							,'city'=>strtoupper(trim($active_sheet->getCell('P'.$i)->getValue()))
							,'pos_code'=>strtoupper(trim($active_sheet->getCell('Q'.$i)->getValue()))
							,'brand'=>strtoupper(trim($active_sheet->getCell('R'.$i)->getValue()))
							,'brand_'=>strtoupper(trim($active_sheet->getCell('S'.$i)->getValue()))
							,'source_type'=>strtoupper(trim($active_sheet->getCell('T'.$i)->getValue()))
							,'source_user'=>strtoupper(trim($active_sheet->getCell('U'.$i)->getValue()))
							,'survey_date'=>excel_to_date($active_sheet->getCell('V'.$i))
							,'upload_date'=>excel_to_date($active_sheet->getCell('W'.$i))
							,'entry_date'=>excel_to_date($active_sheet->getCell('X'.$i))
							,'verifikasi_date'=>excel_to_date($active_sheet->getCell('Y'.$i))
							,'drn_number'=>strtoupper(trim($active_sheet->getCell('Z'.$i)->getValue()))
							,'status_verifikasi'=>strtoupper(trim($active_sheet->getCell('AA'.$i)->getValue()))
							,'date_create'=>date('Y-m-d H:i:s')
							,'user_create'=>$this->session->userdata('user_login')
						);
						$i++;
					}
					$this->mdl_individual->import($data);
					$this->session->set_flashdata('alert','<div class="alert alert-success">Import : <b>'.($i-2).'</b> Data Completed!!!</div>');
				}else{
					$this->session->set_flashdata('alert','<div class="alert alert-danger">Warning : Excel Value Failed!!!</div>');					
				}
			}
			redirect('individual/import');	
		}		
	}
	function update(){
		ini_set('memory_limit','-1'); 
		if(empty($_FILES['userfile']['name'])){
			$data['title'] = 'ACS - Individual Update';
			$data['breadcrumb'] = 'individual'.$this->_filter();
			$this->template->display('individual_update',$data);						
		}else{			
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'xlsx';
			$config['file_name'] = 'update_individual_'.$this->session->userdata('user_login').'.xlsx';
			$config['overwrite'] = true;
			$config['encrypt_name'] = true;
			$config['max_size']	= '2000';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()){
				$this->session->set_flashdata('alert','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
			}else{
				require_once "../assets/phpexcel/PHPExcel.php";
				$excel = new PHPExcel();
				$excel = PHPExcel_IOFactory::load(FCPATH."/uploads/update_individual_".$this->session->userdata('user_login').".xlsx");
				$excel->setActiveSheetIndex(0);
				$active_sheet = $excel->getActiveSheet();
				if($active_sheet->getCell('B1')->getValue()=='Code'){
					$i=2;
					while(trim($active_sheet->getCell('A'.$i)->getValue())<>''){
						$data[] = array(
							'id'=>strtoupper(trim($active_sheet->getCell('B'.$i)->getValue()))
							,'campaign_id'=>strtoupper(trim($active_sheet->getCell('C'.$i)->getValue()))
							,'mop_id'=>strtoupper(trim($active_sheet->getCell('D'.$i)->getValue()))
							,'firstname'=>strtoupper(trim($active_sheet->getCell('E'.$i)->getValue()))
							,'lastname'=>strtoupper(trim($active_sheet->getCell('F'.$i)->getValue()))
							,'nickname'=>strtoupper(trim($active_sheet->getCell('G'.$i)->getValue()))
							,'sex'=>strtoupper(trim($active_sheet->getCell('H'.$i)->getValue()))
							,'dob'=>excel_to_date($active_sheet->getCell('I'.$i))
							,'id_type'=>strtoupper(trim($active_sheet->getCell('J'.$i)->getValue()))
							,'id_number'=>strtoupper(trim($active_sheet->getCell('K'.$i)->getValue()))
							,'tlp'=>strtoupper(trim($active_sheet->getCell('L'.$i)->getValue()))
							,'email'=>strtoupper(trim($active_sheet->getCell('M'.$i)->getValue()))
							,'fb'=>strtoupper(trim($active_sheet->getCell('N'.$i)->getValue()))
							,'tw'=>strtoupper(trim($active_sheet->getCell('O'.$i)->getValue()))
							,'address'=>strtoupper(trim($active_sheet->getCell('P'.$i)->getValue()))
							,'city'=>strtoupper(trim($active_sheet->getCell('Q'.$i)->getValue()))
							,'pos_code'=>strtoupper(trim($active_sheet->getCell('R'.$i)->getValue()))
							,'brand'=>strtoupper(trim($active_sheet->getCell('S'.$i)->getValue()))
							,'brand_'=>strtoupper(trim($active_sheet->getCell('T'.$i)->getValue()))
							,'source_type'=>strtoupper(trim($active_sheet->getCell('U'.$i)->getValue()))
							,'source_user'=>strtoupper(trim($active_sheet->getCell('V'.$i)->getValue()))
							,'survey_date'=>excel_to_date($active_sheet->getCell('W'.$i))
							,'upload_date'=>excel_to_date($active_sheet->getCell('X'.$i))
							,'entry_date'=>excel_to_date($active_sheet->getCell('Y'.$i))
							,'verifikasi_date'=>excel_to_date($active_sheet->getCell('Z'.$i))
							,'referred'=>strtoupper(trim($active_sheet->getCell('AA'.$i)->getValue()))
							,'drn_number'=>strtoupper(trim($active_sheet->getCell('AB'.$i)->getValue()))
							,'status_verifikasi'=>strtoupper(trim($active_sheet->getCell('AC'.$i)->getValue()))
							,'user_update'=>$this->session->userdata('user_login')
							,'date_update'=>date('Y-m-d H:i:s')
						);
						$i++;
					}
					$this->mdl_individual->update('id',$data);
					$this->session->set_flashdata('alert','<div class="alert alert-success">Update : <b>'.($i-2).'</b> Data Completed!!!</div>');
				}else{
					$this->session->set_flashdata('alert','<div class="alert alert-danger">Warning : Excel Value Failed!!!</div>');					
				}
			}	
			redirect('individual/update');	
		}
	}
	function export(){
		ini_set('memory_limit','-1'); 
		
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('Individual List');
		
		//style
		$active_sheet->getStyle("A1:AC1")->getFont()->setBold(true);

		//header
		$active_sheet->setCellValue('A1', 'No');
		$active_sheet->setCellValue('B1', 'Code');
		$active_sheet->setCellValue('C1', 'Campaign');
		$active_sheet->setCellValue('D1', 'MOP ID');
		$active_sheet->setCellValue('E1', 'Firstname');
		$active_sheet->setCellValue('F1', 'Lastname');
		$active_sheet->setCellValue('G1', 'Nickname');
		$active_sheet->setCellValue('H1', 'Sex');
		$active_sheet->setCellValue('I1', 'Day Of Birth');
		$active_sheet->setCellValue('J1', 'ID Type');
		$active_sheet->setCellValue('K1', 'ID Number');
		$active_sheet->setCellValue('L1', 'Telephone');
		$active_sheet->setCellValue('M1', 'Email');
		$active_sheet->setCellValue('N1', 'Fb');
		$active_sheet->setCellValue('O1', 'Tw');
		$active_sheet->setCellValue('P1', 'Address');
		$active_sheet->setCellValue('Q1', 'City');
		$active_sheet->setCellValue('R1', 'Pos Code');
		$active_sheet->setCellValue('S1', 'Curr Brand');
		$active_sheet->setCellValue('T1', 'Sec Brand');
		$active_sheet->setCellValue('U1', 'Source Type');
		$active_sheet->setCellValue('V1', 'Source User');
		$active_sheet->setCellValue('W1', 'Survey Date');
		$active_sheet->setCellValue('X1', 'Upload Date');
		$active_sheet->setCellValue('Y1', 'Entry Date');
		$active_sheet->setCellValue('Z1', 'Verification Date');
		$active_sheet->setCellValue('AA1', 'Referred by');
		$active_sheet->setCellValue('AB1', 'DRN Number');
		$active_sheet->setCellValue('AC1', 'Status Verification');
		
		$result = $this->mdl_individual->export()->result();
		$i=2;
		foreach($result as $r){
			$active_sheet->setCellValue('A'.$i, $i-1);
			$active_sheet->setCellValueExplicit('B'.$i, $r->id);
			$active_sheet->setCellValueExplicit('C'.$i, $r->campaign_id);
			$active_sheet->setCellValue('D'.$i, $r->mop_id);
			$active_sheet->setCellValue('E'.$i, $r->firstname);
			$active_sheet->setCellValue('F'.$i, $r->lastname);
			$active_sheet->setCellValue('G'.$i, $r->nickname);
			$active_sheet->setCellValue('H'.$i, $r->sex);
			$active_sheet->setCellValue('I'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->dob)));
			$active_sheet->getStyle('I'.$i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');		   
			$active_sheet->setCellValue('J'.$i, $r->id_type);
			$active_sheet->setCellValueExplicit('K'.$i, $r->id_number);
			$active_sheet->setCellValueExplicit('L'.$i, $r->tlp);
			$active_sheet->setCellValue('M'.$i, $r->email);
			$active_sheet->setCellValue('N'.$i, $r->fb);
			$active_sheet->setCellValue('O'.$i, $r->tw);
			$active_sheet->setCellValue('P'.$i, $r->address);
			$active_sheet->setCellValue('Q'.$i, $r->city);
			$active_sheet->setCellValueExplicit('R'.$i, $r->pos_code);
			$active_sheet->setCellValue('S'.$i, $r->brand);
			$active_sheet->setCellValue('T'.$i, $r->brand_);
			$active_sheet->setCellValue('U'.$i, $r->source_type);
			$active_sheet->setCellValue('V'.$i, $r->source_user);
			$active_sheet->setCellValue('W'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->survey_date)));
			$active_sheet->getStyle('W'.$i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');		   
			$active_sheet->setCellValue('X'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->upload_date)));
			$active_sheet->getStyle('X'.$i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');		   
			$active_sheet->setCellValue('Y'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->entry_date)));
			$active_sheet->getStyle('Y'.$i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');		   
			$active_sheet->setCellValue('Z'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->verifikasi_date)));
			$active_sheet->getStyle('Z'.$i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');		   
			$active_sheet->setCellValue('AA'.$i, $r->referred);
			$active_sheet->setCellValueExplicit('AB'.$i, $r->drn_number);
			$active_sheet->setCellValue('AC'.$i, $r->status_verifikasi);
			$i++;
		}

		$filename='LIST_INDIVIDUAL_'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');							
	}
	function export_xls(){		
		ini_set('memory_limit','-1'); 
		
		require "../assets/export-xls.class.modif.php";
		$filename = 'LIST_INDIVIDUAL_'.date('Ymd_His').'.xls';

		$xls = new ExportXLS($filename);
		
		$header[] = "NO"; 
		$header[] = "INDIVIDUAL CODE"; 
		$header[] = "CAMPAIGN"; 
		$header[] = "MOP ID"; 
		$header[] = "FIRSTNAME"; 
		$header[] = "LASTNAME"; 
		$header[] = "NICKNAME"; 
		$header[] = "SEX"; 
		$header[] = "DAY OF BIRTH"; 
		$header[] = "ID TYPE"; 
		$header[] = "ID NUMBER"; 
		$header[] = "TELEPHONE"; 
		$header[] = "EMAIL"; 
		$header[] = "FB"; 
		$header[] = "TW"; 
		$header[] = "ADDRESS"; 
		$header[] = "CITY"; 
		$header[] = "POS CODE"; 
		$header[] = "BRAND"; 
		$header[] = "BRAND 2"; 
		$header[] = "SOURCE TYPE"; 
		$header[] = "SOURCE USER"; 
		$header[] = "SOURCE EMAIL"; 
		$header[] = "SURVEY DATE"; 
		$header[] = "UPLOAD DATE"; 
		$header[] = "ENTRY DATE"; 
		$header[] = "VERIFIKASI DATE"; 
		$header[] = "REFERRED BY"; 
		$header[] = "DRN NUMBER"; 
		$header[] = "STATUS VERIFIKASI"; 
		$header[] = "AGE"; 
		$xls->addHeader($header);	

		$result = $this->mdl_individual->export()->result();
		$i=1;
		foreach($result as $r){
			$row[] = $i++;
			$row[] = $r->id;
			$row[] = $r->campaign_id;
			$row[] = $r->mop_id;
			$row[] = $r->firstname;
			$row[] = $r->lastname;
			$row[] = $r->nickname;
			$row[] = $r->sex;
			$row[] = format_tanggal_excel($r->dob);
			$row[] = $r->id_type;
			$row[] = $r->id_number;
			$row[] = $r->tlp;
			$row[] = $r->email;
			$row[] = $r->fb;
			$row[] = $r->tw;
			$row[] = $r->address;
			$row[] = $r->city;
			$row[] = $r->pos_code;
			$row[] = $r->brand;
			$row[] = $r->brand_;
			$row[] = $r->source_type;
			$row[] = $this->mdl_sba->get_sba_name($r->source_user);
			$row[] = $r->source_user;
			$row[] = format_tanggal_excel($r->survey_date);
			$row[] = format_tanggal_excel($r->upload_date);
			$row[] = format_tanggal_excel($r->entry_date);
			$row[] = format_tanggal_excel($r->verifikasi_date);
			$row[] = $r->referred;
			$row[] = $r->drn_number;
			$row[] = $r->status_verifikasi;
			$row[] = get_age($r->dob);
					
			$xls->addRow($row);
			unset($row);
		}
		$xls->sendFile();
	}
	function autocomplete($id){
		$result = $this->mdl_individual->autocomplete($id);
		echo json_encode($result);
	}			
	function query_builder(){
		$this->load->helper('query_builder');

		$campaign = $this->mdl_campaign->query_builder();
		$id_type = $this->mdl_individual->query_builder('id_type');
		$city = $this->mdl_individual->query_builder('city');
		$curr_brand = $this->mdl_individual->query_builder('brand');
		$sec_brand = $this->mdl_individual->query_builder('brand_');
		$source_type = $this->mdl_individual->query_builder('source_type');
		$status_verifikasi = $this->mdl_individual->query_builder('status_verifikasi');

		$data[] = genSelect('campaign_id','Campaign',$campaign);
		$data[] = genString('id','Individual ID');
		$data[] = genString('mop_id','MOP ID');
		$data[] = genString('firstname','Firstname');
		$data[] = genString('lastname','Lastname');
		$data[] = genString('nickname','Nickname');
		$data[] = genSelect('sex','Sex',array("M"=>"MALE","F"=>"FEMALE"));
		$data[] = genDate('dob','Day of Birth');
		$data[] = genInteger("DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(dob)), '%Y')+0",'Age');
		$data[] = genSelect('id_type','ID Type',$id_type);
		$data[] = genString('id_number','ID Number');
		$data[] = genString('tlp','Telephone');
		$data[] = genString('email','Email');
		$data[] = genString('fb','Facebook');
		$data[] = genString('tw','Twitter');
		$data[] = genString('address','Address');
		$data[] = genSelect('city','City',$city);
		$data[] = genString('pos_code','Pos Code');
		$data[] = genSelect('brand','Current Brand',$curr_brand);
		$data[] = genSelect('brand_','Second Brand',$sec_brand);
		$data[] = genSelect('source_type','Source Type',$source_type);
		$data[] = genString('source_user','Source User');
		$data[] = genDate('survey_date','Survey Date');
		$data[] = genDate('upload_date','Upload Date');
		$data[] = genDate('entry_date','Entry Date');
		$data[] = genDate('verifikasi_date','Verification Date');
		$data[] = genString('referred','Referred by');
		$data[] = genSelect('status_verifikasi','Status Verification',$status_verifikasi);
		echo json_encode($data);
	}
}