<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_user');
		$this->load->helper('user_helper');
	}
	function index(){
		$this->_set_rules();
		if($this->form_validation->run()===false){			
			$data['title'] = 'ACS - Profile';
			$data['heading'] = 'Profile';
			$data['error'] = validation_errors();
			$data['action'] = form_open_multipart('profile');
			$data['close'] = form_close();
			$data['row'] = $this->mdl_user->get_from_field('username',$this->session->userdata('user_login'))->row();
			$this->template->display('profile',$data);
		}else{			
			$data = array(
				'fullname'=>$this->input->post('fullname')
				,'user_update'=>$this->session->userdata('user_login')
				,'date_update'=>date('Y-m-d H:i:s')				
			);
			$id = $this->template->get_id();
			$this->mdl_user->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			$this->_upload_image($id,md5(uniqid(mt_rand())));
			redirect('profile',$data);
		}		
	}
	function _set_rules(){
		$this->form_validation->set_rules('fullname','Fullname','trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
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
}