<?php

class Fitzos_model extends Fitzos_model {
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
    	$result = $this->db->delete($this->table_name);
    	return $result->result();
    }
    function create($data){
    	$this->db->insert($this->table_name,$data);
    	return $this->db->affected_rows();
    }
}
