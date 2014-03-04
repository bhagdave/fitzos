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
	function getSearchResults($criteria,$id){
		if (!empty($criteria['location'])){
			$locations = $this->getMembersWithLocation($criteria['location'], $id);
		} else {
			$locations = null;
		}
		if (!empty($criteria['sport'])){
			$sports = $this->getMembersWithSport($criteria['sport'], $id);
		} else {
			$sports = null;
		}
		if (!empty($criteria['name'])){
			$names = $this->getMembersWithName($criteria['name'], $id);
		} else {
			$names = null;
		}
		if (!empty($criteria['location']) ||
			!empty($criteria['name']) ||
			!empty($criteria['sport'])){
			$combined = $this->getCombinedSearchResults($criteria);
		}
		return array(
			'names'=>$names,
			'sports'=>$sports,
			'locations'=>$locations,
			'combined'=>$combined
		);
	}
	function getCombinedSearchResults($criteria){
		$this->db->select('member.*');
		$this->db->distinct();
		$this->db->join('member','member.id = athlete.member_id');
		$this->db->join('member_sports','member_sports.member_id = member.id','left');
		$this->db->join('sport','sport.id = member_sports.sport_id','left');
		if (isset($criteria['location']) && !empty($criteria['location'])){
			$this->db->like('location',$criteria['location']);
		}
		if (isset($criteria['sport']) && !empty($criteria['sport'])){
			$this->db->like('sport.name',$criteria['sport']);
		}
		if (isset($criteria['name']) && !empty($criteria['name'])){
			$this->db->where("(member.first_name like '%".$criteria['name']."%' or member.last_name like '%".$criteria['name']."%')",null,true);
		}
		$result = $this->db->get('athlete');
		//echo($this->db->last_query());
		return $result->result();
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
	function getMembersWithName($name,$id){
		$this->db->select('member.*');
		$this->db->distinct();
		$this->db->like('first_name',$name);
		$this->db->or_like('last_name',$name);
		$this->db->where('member.id !=',$id);
		$result = $this->db->get('member');
		return $result->result();
	}
	function getMembersWithSport($sport,$id){
		$this->db->select('member.*');
		$this->db->distinct();
		$this->db->join('member_sports','member_sports.member_id = member.id');
		$this->db->join('sport','member_sports.sport_id = sport.id');
		$this->db->where('member.id !=',$id);
		$this->db->where('sport.name',$sport);
		$result = $this->db->get('member');
		return $result->result();
	}
}
