<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('user_helper');
		$this->load->model('mdl_chat');
		$this->load->model('mdl_individual');
		$this->load->model('mdl_campaign');
		$this->load->model('mdl_barang');
		$this->load->model('mdl_vendor');
	}
	function index(){
		if($this->session->userdata('user_login')<>''){
			$data['title'] = 'ACS - Dashboard';
			$data['individual_total'] = number_format($this->mdl_individual->count_all());
			$data['campaign_total'] = number_format($this->mdl_campaign->count_all());
			$data['vendor_total'] = number_format($this->mdl_vendor->count_all());
			$data['barang_total'] = number_format($this->mdl_barang->count_all());
			$this->template->display('dashboard',$data);	
		}else{
			$this->load->view('login');	
		}
	}
	function get_campaign_individual(){
		$campaign = $this->mdl_campaign->export()->result();
		foreach($campaign as $r){
			$data[] = array(
				'c'=>$r->name,
				't'=>$this->mdl_individual->get_from_field('campaign_id',$r->id)->num_rows()
			);
		}
		echo json_encode($data);
	}
	function block(){
		$data['title'] = 'Avengers - Content Blocked';
		$this->template->display('block',$data);	
	}	
}