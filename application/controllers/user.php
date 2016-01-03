<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_user');
	}
	function index(){
		$offset = $this->lib_general->value_get('offset',0);
		$limit = $this->lib_general->value_get('limit',10);

		$data['title'] = 'ACS - Security';
		$data['action'] = site_url('user/search'.$this->_filter());
		$data['add_btn'] = anchor('user/add'.$this->_filter(),'<span class="glyphicon glyphicon-plus"></span> New',array('class'=>'btn btn-primary btn-sm'));
		$this->table->set_template(tbl_tmp());
		
		$head_data = array(
			'fullname'=>'Fullname'
			,'username'=>'Username'
			,'level'=>'Level'
			,'ip_login'=>'Last IP Login'
			,'user_agent'=>'Last User Agent'
			,'date_login'=>'Last Login'
			,'status'=>'Status'
		);
		$heading[] = 'No';
		foreach($head_data as $r => $value){
			$heading[] = anchor('user'.$this->_filter(array('order_column'=>$r,'order_type'=>$this->lib_general->order_type($r))),$value." ".$this->lib_general->order_icon($r));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->mdl_user->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				$i++
				,anchor('user/edit/'.$r->id.$this->_filter(),$this->template->get_user_image($r->photo,'user-image-table img-circle').' '.$r->fullname)
				,$r->username	
				,get_level($r->level)
				,$r->ip_login
				,$r->user_agent
				,$r->date_login
				,get_status($r->status)
				,anchor('user/edit/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-edit"></span> Edit')
				."&nbsp;|&nbsp;".anchor('user/delete/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-trash"></span> Delete',array('onclick'=>"return confirm('Are you sure')"))
			);
		}
		$data['table'] = $this->table->generate();
		$total = $this->mdl_user->count_all();
		
		$config = pag_tmp();
		$config['base_url'] = site_url("user".$this->_filter());
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['total'] = page_total($offset,$limit,$total);
		$this->template->display('user',$data);
	}
	function _set_rules(){
		$this->form_validation->set_rules('fullname','Fullname','trim|required');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('level','Level','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	function _field(){
		$data = array(
			'fullname'=>$this->input->post('fullname')
			,'username'=>$this->input->post('username')
			,'password'=>$this->input->post('password')
			,'level'=>$this->input->post('level')
			,'status'=>$this->input->post('status')
		);
		return $data;	
	}
	function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$data['title'] = 'ACS - New';
			$data['breadcrumb'] = 'user'.$this->_filter();
			$data['heading'] = 'New';
			$data['owner'] = '';
			$data['error'] = validation_errors();
			$data['action'] = form_open_multipart('user/add'.$this->_filter());
			$this->template->display('user_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_create'] = $this->session->userdata('user_login');
			$data['date_create'] = date('Y-m-d H:i:s');		
			$id = $this->mdl_user->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			$this->_upload_image($id,md5(uniqid(mt_rand())));
			redirect('user'.$this->_filter());
		}
	}
	function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){			
			$data['title'] = 'ACS - Update';
			$data['breadcrumb'] = 'user'.$this->_filter();
			$data['heading'] = 'Update';
			$data['error'] = validation_errors();
			$data['action'] = form_open_multipart('user/edit/'.$id.$this->_filter());
			$data['close'] = form_close();
			$data['row'] = $this->mdl_user->get_from_field('id',$id)->row();
			$data['owner'] = owner($data['row']);
			$this->template->display('user_edit',$data);
		}else{			
			$data = $this->_field();
			$data['user_update'] = $this->session->userdata('user_login');
			$data['date_update'] = date('Y-m-d H:i:s');		
			$this->mdl_user->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			$this->_upload_image($id,md5(uniqid(mt_rand())));
			redirect('user/edit/'.$id.$this->_filter());
		}
	}
	function delete($id){		
		$this->mdl_user->delete($id);
		$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
		redirect('user'.$this->_filter());
	}
	function _upload_image($id,$file_name){
		if (!empty($_FILES['userfile']['name'])){
			$config['upload_path'] = './assets/img/user/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $file_name.'.jpg';
			$config['overwrite'] = true;
			$config['encrypt_name'] = true;
			$config['max_size']	= '2000';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()){
				$this->session->set_flashdata('alert','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
				return false;
			}else{
				$data = array('photo'=>$file_name);
				$this->mdl_user->edit($id,$data);
			}
		}
		return true;
	}
	function search(){
		$data = array(
			'search'=>$this->input->post('search')
			,'limit'=>$this->input->post('limit')
			,'offset'=>0
		);
		redirect('user'.$this->_filter($data));
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array('order_column'=>0,'order_type'=>0,'limit'=>0,'offset'=>0,'search'=>0);
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