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
			if ($this->input->post()){
				// do the search..
				$criteria = $this->input->post();
				$results  = $this->search_model->getSearchResults($criteria,$this->session->userdata('id'));
			} else {
				$criteria = null;
				$results = null;
			}
			$suggestions = $this->search_model->getSuggestionsForMember($this->session->userdata('id'));
			$vars = array(
				'results'=>$results,
				'suggestions'=>$suggestions,
				'criteria'=>$criteria
			);
			$this->fuel->pages->render('find/search',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
}