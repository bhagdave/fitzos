<?php
class Sports extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('Fitzos_utility',null,'Futility');
	}
	function getStatsForPosition($id){
		$this->load->model('sports_model','sports');
		$result = $this->sports->getStatsForPosition($id);
		if (isset($result) && count($result)>0){
			echo('<select name="statistic_name">');
			foreach($result as $stat){
				?>
				<option value="<?=$stat->statistic_name ?>"><?=$stat->description ?></option>
				<?php 				
			}
		} else {
			echo('<input type="text" placeholder="Statistic" name="statistic_name" value="" />');
		}
		echo('<input type="text" placeholder="Statistic Value" name="statistic_value" value="" />');			
	}
}