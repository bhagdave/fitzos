<?php
class Trainer extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}
	function index(){
		if ($this->session->userdata('id')){
			$vars = array();
			$this->fuel->pages->render('trainer/index',$vars);
		} else {
			redirect('signin/login');
		}
	}
	function profile(){	
		if ($this->session->userdata('id')){
			$vars = array();
			$this->fuel->pages->render('trainer/profile',$vars);
		} else {
			redirect('signin/login');
		}
	}
	function portal(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('trainer/welcome',$vars);
		
	}
	function calendar(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('trainer/welcome',$vars);
		
	}
	function plans(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('trainer/welcome',$vars);
		
	}
	function badges(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('trainer/welcome',$vars);
		
	}
	function business(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('trainer/welcome',$vars);
		
	}
	function message(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('trainer/welcome',$vars);
		
	}
	function progress(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('trainer/welcome',$vars);
		
	}
	function events(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('trainer/welcome',$vars);
		
	}
}
?>