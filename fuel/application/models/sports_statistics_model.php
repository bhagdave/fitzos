<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sports_statistics_model extends Fitzos_model {
	function __construct()
	{
		parent::__construct('sport_statistics');
	}

	function form_fields($values = array()){
		$fields = parent::form_fields();
		$CI =& get_instance();
		$CI->load->model('sports_model');
		$sports = $CI->sports_model->options_list();
		$fields['sport_id'] = array('label' => 'Sport', 'type' => 'select', 'options' => $sports);
		return $fields;
	}
	
}
class Sports_statistic_model extends Base_module_record {

}
 