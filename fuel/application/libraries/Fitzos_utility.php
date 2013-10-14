<?php
class Fitzos_utility{
	function checkSignin($data){
		$mesg = array();
		if (!isset($data['choice'])){
			$mesg[] = "No choice selected!";
		}
		if (!isset($data['name'])){
			$mesg[] = "No name entered!";
		}
		if (!isset($data['email'])){
			$mesg[] = "No email entered!";
		}
		if (!isset($data['TC'])){
			$mesg[] = "Not accepted Terms and Conditions!";
		}
		if (!isset($data['password'])){
			$mesg[] = "No password entered!";
		} else {
			if (!isset($data['confirm_password'])){
				$mesg[] = "No password confirmation entered!";
			} else {
				if ($data['confirm_password'] != $data['password']){
					$mesg[] = "Password confirmation does not match!";
				}
			}
		}
		return $mesg;
	}
	
}