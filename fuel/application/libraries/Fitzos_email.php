<?php
class Fitzos_email {
	private $config = array('mailtype'=>'html');
	private $CI;
	private $email;
	function __constructor($params = null){
		$this->CI =& get_instance();
		$this->email = $this->CI->load->library('email');
		$this->email->initialize($this->config);
	}
	private function _sendMail($to,$from,$subject,$message){
		$this->CI =& get_instance();
		$this->email = $this->CI->load->library('email');
		$this->email->initialize($this->config);
		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
	}
	function sendMemberActivation($id){
		$this->CI =& get_instance();
		$members= $this->CI->load->model("members_model");
		// get data for the member
		$member  = $members->getMember($id);
		$message = $this->CI->load->view('email/memberActivation',array('member'=>$member),TRUE);
		$this->_sendMail($member->email, 'member_services@reach-your-peak.com', 'FITZOS Member activation', $message);
	}
}
