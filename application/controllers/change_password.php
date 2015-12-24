<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_password extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_user');
	}
	function index(){
		$this->_set_rules();
		if($this->form_validation->run()===false){			
			$data['title'] = 'ACS - Change Password';
			$data['heading'] = 'Change Password';
			$data['error'] = validation_errors();
			$data['action'] = form_open('change_password');
			$data['close'] = form_close();
			$this->template->display('change_password',$data);
		}else{			
			$data = array(
				'password'=>$this->input->post('new_password')
				,'user_update'=>$this->session->userdata('user_login')
				,'date_update'=>date('Y-m-d H:i:s')				
			);
			$id = $this->template->get_id();
			$this->mdl_user->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Complete...!!!</div>');
			redirect('change_password',$data);
		}		
	}
	function _set_rules(){
		$this->form_validation->set_rules('new_password','New Password','trim|required|matches[con_password]|min_length[6]');
		$this->form_validation->set_rules('con_password','Confirm Password','trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
}