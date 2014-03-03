<?php
class Find extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}
	function search(){
		if ($this->session->userdata('id')){
			// lets get people that migh match
			$this->load->model('search_model');
			$suggestions = $this->search_model->getSuggestionsForMember($this->session->userdata('id'));
			$vars = array(
				'suggestions'=>$suggestions);
			$this->fuel->pages->render('find/search',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
}