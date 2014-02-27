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
	function sendMemberActivation($member){
		$this->CI =& get_instance();
		$message = $this->CI->load->view('email/memberActivation',array('member'=>$member),TRUE);
		$this->_sendMail($member->email, 'member_services@reach-your-peak.com', 'Reach Your Peak Member activation', $message);
	}
	function sendEventInvite($member,$event){
		$this->CI =& get_instance();
		$message = $this->CI->load->view('email/eventInvite',array('member'=>$member,'event'=>$event),TRUE);
		$this->_sendMail($member->email, 'member_services@reach-your-peak.com', 'Event Invitation', $message);
	}
	function sendMemberJoiningEmail($team,$member,$owner){
		$this->CI =& get_instance();
		$message = $this->CI->load->view('email/teamRequest',array('member'=>$member,'team'=>$team),TRUE);
		$this->_sendMail($owner->email, 'member_services@reach-your-peak.com', 'Team membership requested', $message);
	}
	function sendMemberInvite($member,$email){
		$this->CI =& get_instance();
		$message = $this->CI->load->view('email/memberInvite',array('member'=>$member),TRUE);
		$this->_sendMail($email, 'member_services@reach-your-peak.com', 'Reach Your Peak Membership Invite', $message);
	}
}
