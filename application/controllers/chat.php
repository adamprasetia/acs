<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_chat');
	}
	function get(){
		$result = $this->mdl_chat->get()->result();
		$data = '';
		foreach($result as $r){
			$data .= $this->load->view('chat',$r,true);
		}
		echo $data;
	}
	function set(){
		$chat = trim($this->input->post('chat'));
		if($chat<>''){
			$data = array(
				'username'=>$this->session->userdata('user_login')
				,'chat'=>$chat
				,'date'=>date('Y-m-d H:i:s')
			);
			$id = $this->mdl_chat->add($data);
			$row = $this->mdl_chat->get_from_field('chat.id',$id)->row();
			$view = $this->load->view('chat',$row,true);
			echo $view;
		}
	}
}