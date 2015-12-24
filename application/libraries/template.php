<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
		$this->ci->load->model('mdl_user');
	}
	function display($view,$data=null){
		$data['username'] = $this->get_username();
		$data['user_level'] = $this->get_user_level();
		$data['user_image'] = $this->get_user_image($this->get_photo(),'user-image');
		$data['user_image_circle'] = $this->get_user_image($this->get_photo(),'img-circle');
		$data['content'] = $this->ci->load->view($view,$data,true);
		$this->ci->load->view('template',$data);
	}
	function get_id(){
		$row = $this->ci->mdl_user->get_from_field('username',$this->ci->session->userdata('user_login'))->row();
		return $row->id;
	}
	function get_photo(){
		$row = $this->ci->mdl_user->get_from_field('username',$this->ci->session->userdata('user_login'))->row();
		return $row->photo;
	}
	function get_username(){
		$row = $this->ci->mdl_user->get_from_field('username',$this->ci->session->userdata('user_login'))->row();
		return $row->fullname;
	}
	function get_user_level(){
		$user_level = $this->ci->session->userdata('user_level');
		return get_level($user_level);
	}
	function get_user_image($id,$class){
		$path = 'assets/img/user/'.$id.'.jpg';
		if(file_exists($path)){
			return img(array('src'=>$path,'class'=>$class,'alt'=>"User Image"));	
		}else{
			return img(array('src'=>'assets/img/user/user.jpg','class'=>$class,'alt'=>"User Image"));
		}
		
	}
}