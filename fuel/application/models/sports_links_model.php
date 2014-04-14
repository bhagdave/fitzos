<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sports_links_model extends Fitzos_model {
	function __construct()
	{
		parent::__construct('sports_links');
	}

	function form_fields($values = array()){
		$fields = parent::form_fields();
		$CI =& get_instance();
		$CI->load->model('sports_model');
		$sports = $CI->sports_model->options_list();
		$fields['parent_sport'] = array('label' => 'Parent Sport', 'type' => 'select', 'options' => $sports);
		$fields['child_sport'] = array('label' => 'Child Sport', 'type' => 'select', 'options' => $sports);
		return $fields;
	}
	
}
class Sports_link_model extends Base_module_record {

}
