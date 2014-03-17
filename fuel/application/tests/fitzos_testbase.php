<?php
class fitzos_testbase extends Tester_base{
	protected function _login(){
		$username = 'dave_gill@blueyonder.co.uk';
		$password = 'sddsdds';
		$post = array(
				'username' => $username,
				'password' => $password
		);
		$result = $this->load_page('signin/login',$post);
		return $result;
	}
}