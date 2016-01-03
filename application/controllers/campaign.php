<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_campaign');
		$this->load->helper('campaign_helper');
	}
	function index(){
		$offset = $this->lib_general->value_get('offset',0);
		$limit = $this->lib_general->value_get('limit',10);
		$data['title'] = 'ACS - Campaign';
		$data['action'] = site_url('campaign/search'.$this->_filter());
		$data['add_btn'] = anchor('campaign/add'.$this->_filter(),'<span class="glyphicon glyphicon-plus"></span> New',array('class'=>'btn btn-primary btn-sm'));
		$this->table->set_template(tbl_tmp());
		
		$head_data = array(
			'name'=>'Campaign'
			,'brand'=>'Brand'
			,'start'=>'Start'
			,'end'=>'End'
			,'status'=>'Status'
		);
		$heading[] = 'No';
		foreach($head_data as $r => $value){
			$heading[] = anchor('campaign'.$this->_filter(array('order_column'=>$r,'order_type'=>$this->lib_general->order_type($r))),$value." ".$this->lib_general->order_icon($r));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->mdl_campaign->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				$i++
				,anchor('campaign/edit/'.$r->id.$this->_filter(),$r->name)
				,$r->brand	
				,format_tanggal($r->start)
				,format_tanggal($r->end)
				,get_campaign_status($r->status)
				,anchor('campaign/edit/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-edit"></span> Edit')
				."&nbsp;|&nbsp;".anchor('campaign/delete/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-trash"></span> Delete',array('onclick'=>"return confirm('Are you sure')"))
			);
		}
		$data['table'] = $this->table->generate();
		$total = $this->mdl_campaign->count_all();

		$config = pag_tmp();
		$config['base_url'] = site_url("campaign".$this->_filter());
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['total'] = page_total($offset,$limit,$total);
		$this->template->display('campaign',$data);
	}
	function _set_rules(){
		$this->form_validation->set_rules('name','Campaign Name','trim|required');
		$this->form_validation->set_rules('brand','Campaign Brand','trim|required');
		$this->form_validation->set_rules('start','Start','trim|required');
		$this->form_validation->set_rules('end','End','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	function _field(){
		$data = array(
			'name'=>$this->input->post('name')
			,'brand'=>$this->input->post('brand')
			,'start'=>format_tanggal_barat($this->input->post('start'))
			,'end'=>format_tanggal_barat($this->input->post('end'))
			,'status'=>$this->input->post('status')
		);
		return $data;
	}
	function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$data['title'] = 'ACS - New';
			$data['breadcrumb'] = 'campaign'.$this->_filter();
			$data['heading'] = 'New';
			$data['owner'] = '';
			$data['error'] = validation_errors();
			$data['action'] = form_open('campaign/add'.$this->_filter());
			$this->template->display('campaign_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_create'] = $this->session->userdata('user_login');
			$data['date_create'] = date('Y-m-d H:i:s');		
			$this->mdl_campaign->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			redirect('campaign'.$this->_filter());
		}
	}
	function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){			
			$data['title'] = 'ACS - Update';
			$data['breadcrumb'] = 'campaign'.$this->_filter();
			$data['heading'] = 'Update';
			$data['error'] = validation_errors();
			$data['action'] = form_open('campaign/edit/'.$id.$this->_filter());
			$data['close'] = form_close();
			$data['row'] = $this->mdl_campaign->get_from_field('id',$id)->row();
			$data['owner'] = owner($data['row']);
			$this->template->display('campaign_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_update'] = $this->session->userdata('user_login');
			$data['date_update'] = date('Y-m-d H:i:s');		
			$this->mdl_campaign->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			redirect('campaign/edit/'.$id.$this->_filter());
		}
	}
	function delete($id){		
		$this->mdl_campaign->delete($id);
		$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
		redirect('campaign'.$this->_filter());
	}
	function search(){
		$data = array(
			'search'=>$this->input->post('search')
			,'limit'=>$this->input->post('limit')
			,'status'=>$this->input->post('status')
			,'offset'=>0
		);
		redirect('campaign'.$this->_filter($data));
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array('order_column'=>0,'order_type'=>0,'limit'=>0,'offset'=>0,'search'=>0,'status'=>0);
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
}