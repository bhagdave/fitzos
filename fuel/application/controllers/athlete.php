<?php 
class Athlete extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}
	function index(){
		if ($this->session->userdata('id')){
			$this->load->model('athletes_model','athletes');
			$this->load->model('members_model','members');
			// get the athlete from the database
			$id      = $this->session->userdata('id');
			$athlete = $this->athletes->loadProfile($id);
			$member  = $this->members->getMember($id);
		} else {
			redirect('signin/login');
			die();
		}
		$vars = array('athlete'=>$athlete,'member'=>$member);
		$this->fuel->pages->render('athlete/welcome',$vars);
	}
	function signUp(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
	}
	function portal(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function calendar(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function events(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function badges(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function plans(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function messages(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function progress(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/welcome',$vars);
		
	}
	function profile(){
		$this->load->model('athletes_model','athletes');
		if (isset($_POST['age'])){	
			$this->load->model('members_model','members');
			// post to the database baby...
			$data = $_POST;
			$data['id'] = $this->session->userdata('id');
			$this->athletes->saveProfile($data);
			$this->session->set_flashdata('message', 'Profile Saved');			
			$athlete = $this->athletes->loadProfile($data['id']);
			// get the athlete from the database
			$member  = $this->members->getMember($data['id']);
			$vars = array('athlete'=>$athlete,'member'=>$member);
			$this->fuel->pages->render('athlete/welcome',$vars);
		} else {
			if ($this->session->userdata('id')){
				// get the athlete from the database
				$id      = $this->session->userdata('id');
				$athlete = $this->athletes->loadProfile($id);
				if (isset($athlete)){
					$vars = array('athlete'=>$athlete);
					$vars['message'] = $this->session->flashdata('message');
					$this->fuel->pages->render('athlete/profile',$vars);	
				} else {
					redirect('signin/login');
				}			
			} else {
				redirect('signin/login');
			}
		}
	}
	function sports(){
		$this->load->model('athletes_model','athletes');
		$this->load->model('members_model','members');
		$this->load->model('sports_model','sports');
		$vars = array();
		if (isset($_POST['member_id'])){
			// new sport lets take it...
			$data = $_POST;
			$id = $this->members->addSport($data);
			if ($id > 0){
				$vars['message'] = "Sport added to your profile!";				
			} else {
				$vars['message'] = "Unable to add sport to your profile!";				
			}				
		}
		if ($this->session->userdata('id')){
			// get the athlete from the database
			$id      = $this->session->userdata('id');
			$athlete = $this->athletes->loadProfile($id);
			// let us get all of the sports man....
			// Lets us get the sports attached to the member
			$athlete_sports = $this->members->getSports($id, false);
			$sports = $this->sports->list_items();
			if (isset($athlete)){
				$vars['athlete']=$athlete;
				$vars['sports']=$sports; 
				$vars['members_sports']=$athlete_sports;
				$this->fuel->pages->render('athlete/sports',$vars);	
			} else {
				redirect('signin/login');
			}			
		} else {
			redirect('signin/login');
		}
	}	
	function stats($sport){
		$this->load->model('athletes_model','athletes');
		$this->load->model('members_model','members');
		$this->load->model('sports_model','sports');
		$vars = array();
		if ($this->session->userdata('id')){
			// get the athlete from the database
			$id      = $this->session->userdata('id');
			$athlete = $this->athletes->loadProfile($id);
			// get positions for the sport
			$positions = $this->sports->getPositionsForSport($sport);
			// get possible stats for the sport and the sport of course
			$stats = $this->sports->getStatsForSport($sport);
			$sportData = $this->sports->find_by_key($sport,'array');
			// get athlete stats for the sport.
			$athleteStats = $this->athletes->getStatsForAthleteSport($id,$sport);
			if (isset($athlete)){
				$vars['athlete']=$athlete;
				$vars['positions'] = $positions;
				$vars['stats'] = $stats;
				$vars['athlete_stats'] = $athleteStats;
				$vars['sport'] = $sportData;
				$this->fuel->pages->render('athlete/stats',$vars);	
			} else {
				redirect('signin/login');
			}			
		} else {
			redirect('signin/login');
		}
	}
	function addStats(){
		$data = $_POST;
		$this->load->model('athletes_model','athletes');
		$vars = array();
		if (isset($data['source_id'])){
			// post to the database
			$id = $this->athletes->saveStats($data);
			if ($id > 0){
				$vars['message'] = 'Updated ok.';
			} else {
				$vars['message'] = 'Unable to save stats';
			}
		} else {
			redirect('signin/login');
		}
		if ($this->session->userdata('id')){
			redirect('athlete/stats/' . $data['sport_id']);
		} else {
			redirect('signin/login');
		}
	}
	function teams(){
		$this->load->model('athletes_model','athletes');
		$this->load->model('members_model','members');
		$this->load->model('teams_model','teams');
		$vars = array();
		if ($this->session->userdata('id')){
			// get the athlete from the database
			$id      = $this->session->userdata('id');
			$athlete = $this->athletes->loadProfile($id);
			$teams   = $this->teams->getPublicTeams($id);
			$owned   = $this->teams->getOwnedTeams($id);
			$member  = $this->teams->getTeamsIn($id);
			// let us get all of the sports man....
			// Lets us get the sports attached to the member
			$athlete_sports = $this->members->getSports($id, false);
			if (isset($athlete)){
				$vars['athlete'] = $athlete;
				$vars['members_sports'] = $athlete_sports;
				$vars['public_teams']   = $teams;
				$vars['owned'] = $owned;
				$vars['member'] = $member;
				$this->fuel->pages->render('athlete/teams',$vars);	
			} else {
				redirect('signin/login');
			}			
		} else {
			redirect('signin/login');
		}
	}
	function joinTeam(){
		if ($this->session->userdata('id')){
			$member = $_REQUEST['member_id'];
			$team   = $_REQUEST['team_id'];
			$this->load->model('teams_model','teams');
			$id = $this->teams->setMemberRequest($team,$member);
			$this->load->library('Fitzos_email',null,'Femail');
			$this->Femail->sendMemberJoiningEmail($team,$member);
			$this->load->model('notifications_model','notifications');
			$this->notifications->notifyJoining($team,$member);
			if ($id['id'] > 0){
				echo("Your team membership has been requested!");
			} else {
				echo("Team membership has already been requested!");
			}
		} else {
			redirect('signin/login');
		}
	}
	function notifications(){
		$this->load->model('athletes_model','athletes');
		$this->load->model('notifications_model','notify');
		if ($this->session->userdata('id')){
			// get the athlete from the database
			$id   = $this->session->userdata('id');
			$notifications = $this->notify->getMemberNotifications($id);
			$vars = array('notes'=>$notifications);
			$this->fuel->pages->render('athlete/notifications',$vars);	
		} else {
			redirect('signin/login');
		}
		
	}
}
?>