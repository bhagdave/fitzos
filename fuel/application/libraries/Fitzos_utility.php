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
		}
		return $mesg;
	}
	function saveFile($file){
		if ($file["file"]["error"] > 0){
			return null;
		} else {
			$path = 'assets/images/events/' . $file["file"]["name"];
			if (file_exists($path)){
				// update member image to point here...
			} else {
				// save file...
				move_uploaded_file($file["file"]["tmp_name"],$path);
			}
			// update the member
			return $path;
		}
		return null;
	}
}