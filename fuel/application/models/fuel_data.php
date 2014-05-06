<?php
class Fuel_data extends MY_Model{
    function __construct()
    {
        parent::__construct('fuel_site_variables');
    }
	function getFuelPageContent($page){
		$this->db->select('value');
		$this->db->join('fuel_page_variables',"page_id = fuel_pages.id and fuel_page_variables.name = 'body'");
		$this->db->where('location',$page);
		$result = $this->db->get('fuel_pages');
		$data = $result->result();
		if (isset($data[0])){
			return $data[0]->value;
		}else{
			return null;
		}		
	}
}