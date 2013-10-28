<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sports_model extends Fitzos_model {
	function __construct()
	{
		parent::__construct('sport');
	}
	function getPositionsForSport($id){
		$this->db->select("positions.id, positions.name");
		$this->db->from('sport_statistics');
		$this->db->join('positions','positions.id = sport_statistics.position_id');
		$this->db->where('sport_statistics.sport_id',$id);
		$result = $this->db->get();
		return $result->result();
	}
	function getStatsForSport($id){
		$this->db->where('sport_id',$id);
		$result = $this->db->get('sport_statistics');
		return $result->result();	
	}
}
class Sport_model extends Base_module_record {

}
