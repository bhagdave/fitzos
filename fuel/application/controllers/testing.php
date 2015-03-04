<?php
class Testing extends CI_Controller{
	public function testAccptInvite(){
		$this->load->model('events_model','events');
		$this->events->acceptInvite(1,27);
	}
}