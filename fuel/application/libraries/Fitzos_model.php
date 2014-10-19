<?php
require_once(FUEL_PATH.'models/base_module_model.php');

class Fitzos_model extends Base_module_model {
	public $memcache;
	public $cacheAvailable = 0;
	function __construct($table = null,$params = array())
	{
		if (class_exists('Memcache')){
			$this->memcache       = new Memcache;
			$this->cacheAvailable = $this->memcache->connect('127.0.0.1','11211');
		}
		parent::__construct($table,$params); // table name, initialization params
	}
	function getCache($key){
		if ($this->cacheAvailable){
			$result = $this->memcache->get($key);
			if ($result){
				return $result;
			} else {
				return null;
			}
		} else {
			return null;	
		}
	}
	function setCache($key, $data = null){
		if (isset($data)){
			if ($this->cacheAvailable){
				$this->memcache->set($key,$data);
			}
		}
	}	
    function find_one($id){
    	$this->db->where($this->key_field(),$id);
    	$result = $this->db->get($this->table_name);
    	return $result->result();
    }
    function find_all(){
    	$result = $this->db->get($this->table_name);
    	return $result->result();
    }
    function update($data){
		$key = $this->key_field();
		$this->db->where($this->key_field(),$data[$key]);
		$this->db->update($this->table_name,$data);
		return $this->db->affected_rows();
    }
    function delete($id){
    	$this->db->where($this->key_field(),$id);
    	$this->db->delete($this->table_name);
		return $this->db->affected_rows();
    }
    function create($data){
    	$this->db->insert($this->table_name,$data);
    	return $this->db->affected_rows();
    }
	protected function fixDate($date){
		if (isset($date)){
			if (strtotime($date)){
				$this->logEvent('strtotime worked',print_r($date,TRUE));
				$date = date('Y-m-d',strtotime($date));
				return $date;
			} else {
				// lets check for format...
				$newDate = DateTime::createFromFormat('d/m/Y',$date);
				if ($newDate){
					$this->logEvent('createfromformat worked',print_r($date,TRUE));
					return $newDate->format('Y-m-d');
				} else {
					$this->logEvent('createfromformat failed trying american',print_r($date,TRUE));
					$newDate = DateTime::createFromFormat('m/d/Y',$date);
					if ($newDate){
						return $newDate->format('Y-m-d');
					}
				}
				return null;
			}
		} else {
			return null;
		}
	}
	protected function logEvent($event, $message){
		$insert = array('event'=>$event,'message'=>$message, 'time'=>date("Y-m-d H:i:s"));
		$this->db->insert('api_log',$insert);
	}
}
