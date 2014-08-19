<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Athletes_model extends Fitzos_model {
	function __construct()
	{
		parent::__construct('athlete');
	}
	function setProfile($athlete){
		$this->db->where('id',$athlete->id);
		$this->db->update('athlete',$athlete);
	}
	function saveProfile($data){
		$update = array(
			'gender'=>isset($data['gender']) ? $data['gender'] : '',
			'nickname'=>isset($data['nickname']) ? $data['nickname'] : '',
			'height'=>isset($data['height']) ? $data['height'] : '',
			'weight'=>isset($data['weight']) ? $data['weight'] : '',
			'body_fat_percentage'=>isset($data['bodyFat']) ? $data['bodyFat'] : '',
			'units'=>isset($data['units']) ? $data['units']: '',
			'location'=>isset($data['location']) ? $data['location'] : '',
			'show_status'=>isset($data['show_status']) ? $data['show_status'] :'' ,
			'show_progress'=>isset($data['show_progress']) ? $data['show_progress'] : '',
			'show_tables'=>isset($data['show_tables']) ? $data['show_tables'] : '',
			'search'=>isset($data['search']) ? $data['search'] : '',
			'message'=>isset($data['message']) ? $data['message'] :'' ,
			'age'=>isset($data['age']) ? $data['age'] : '',
			'find_trainer'=>isset($data['find_trainer']) ? $data['find_trainer']: ''			
		);
		$this->db->where('member_id', $data['id']);
		$this->db->update('athlete',$update);
	}
	function saveAthleteBySalt($data){
		$this->db->where('salt',$data['id']);
		$result = $this->db->get('member');
		$member = $result->result();
		if (isset($member[0]->id)){
			$data['id'] = $member[0]->id;
			$this->db->where('id',$data['id']);
			$this->db->update('athlete',$data);
			return $this->db->affected_rows();
		}
	}
	function loadProfile($memberId){
			return $this->getAthlete($memberId);
	}
	function getAthlete($id){
		$this->db->where('member_id',$id);
		$result = $this->db->get('athlete');
		$data = $result->result();
		if (isset($data[0])){
			return $data[0];
		} else {
			return null;
		}
	}
	function getStatsForAthleteSport($id,$sport){
		$this->db->select('statistic_name,statistic_value,date,formula,comment');
		$this->db->where('sport_id',$sport);
		$this->db->where('source_table','member');
		$this->db->where('source_id',$id);
		$result = $this->db->get('statistics');
		return $result->result();
	}
	function saveStats($data){
		// lets frig those dates baby..
		if (!empty($data['date'])){
			$data['date'] = $this->fixDate($data['date']);
		}
		$this->db->insert("statistics",$data);
		return $this->db->insert_id();
	}
}
class Athlete_model extends Base_module_record {

}
