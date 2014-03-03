<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/base_module_model.php');

class Search_model extends Base_module_model {
	function getSuggestionsForMember($id){
		$this->load->model('members_model');
		$member = $this->members_model->getMember($id);	
		$this->load->model('athletes_model');
		$athlete = $this->athletes_model->getAthlete($id);
		$sports = $this->members_model->getSports($id,false);
		// People in same location
		$sameLocation = $this->getMembersWithLocation($athlete->location,$id);
		// people with same sports
		$sameSports = $this->getMembersWithSports($sports,$id);
		return array(
			'locations'=>$sameLocation,
			'sports'=>$sameSports
		);
	}
	function getMembersWithLocation($location,$id){
		$this->db->select('member.*');
		$this->db->distinct();
		$this->db->like('location',$location);
		$this->db->join('member','athlete.member_id = member.id');
		$this->db->where('member.id !=',$id);
		$result = $this->db->get('athlete');
		return $result->result();
	}
	function getMembersWithSports($sports,$id){
		$search = array();
		foreach($sports as $sport){
			$search[] = $sport->id;
		}
		$this->db->select('member.*');
		$this->db->distinct();
		$this->db->join('member_sports','member_sports.member_id = member.id');
		$this->db->where('member.id !=',$id);
		$this->db->where_in('member_sports.sport_id',$search);
		$result = $this->db->get('member');
		return $result->result();
	}
}
