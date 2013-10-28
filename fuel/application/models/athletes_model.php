<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Athletes_model extends Fitzos_model {
	function __construct()
	{
		parent::__construct('athlete');
	}
	function saveProfile($data){
		$update = array(
			'gender'=>$_POST['gender'],
			'nickname'=>$_POST['nickname'],
			'height'=>$_POST['height'],
			'weight'=>$_POST['weight'],
			'body_fat_percentage'=>$_POST['bodyFat'],
			'units'=>isset($_POST['units']) ? $_POST['units']: '',
			'location'=>$_POST['location'],
			'show_status'=>isset($_POST['show_status']) ? $_POST['show_status'] :'' ,
			'show_progress'=>isset($_POST['show_progress']) ? $_POST['show_progress'] : '',
			'search'=>isset($_POST['search']) ? $_POST['search'] : '',
			'message'=>isset($_POST['message']) ? $_POST['message'] :'' ,
			'age'=>$_POST['age'],
			'find_trainer'=>isset($_POST['find_trainer']) ? $_POST['find_trainer']: ''			
		);
		$this->db->where('member_id', $data['id']);
		$this->db->update('athlete',$update);
	}
	function loadProfile($memberId){
		$this->db->where('member_id',$memberId);
		$result = $this->db->get('athlete');
		$data = $result->result();
		if (isset($data[0])){
			return $data[0];
		} else {
			return null;
		}
	}
	function getStatsForAthleteSport($id,$sport){
		$this->db->select('statistic_name,statistic_value,date,formula');
		$this->db->where('sport_id',$sport);
		$this->db->where('source_table','member');
		$this->db->where('source_id',$id);
		$result = $this->db->get('statistics');
		return $result->result();
	}
}
class Athlete_model extends Base_module_record {

}
