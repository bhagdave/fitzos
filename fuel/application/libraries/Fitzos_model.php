<?php
require_once(FUEL_PATH.'models/base_module_model.php');

class Fitzos_model extends Base_module_model {
	public $memcache;
	public $cacheAvailable = 0;
	function __construct($table = null)
	{
		if (class_exists('Memcache')){
			$this->memcache       = new Memcache;
			$this->cacheAvailable = $this->memcache->connect('127.0.0.1','11211');
		}
		parent::__construct($table); // table name, initialization params
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
}
