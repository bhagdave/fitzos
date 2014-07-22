<?php 
class Athlete extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('events_model','events');
		$this->load->model('athletes_model','athletes');
		$this->load->model('notifications_model','notify');
		$this->load->model('members_model','members');
	}
	private function _getCoreData($id){
		// get the athlete from the database
		$athlete = $this->athletes->loadProfile($id);
		$member  = $this->members->getMember($id);
		$sports  = $this->members->getSports($id);
		$events  = $this->events->getEventsForMember($id);
		$notifications = $this->notify->getNotifications('member',$id);
		return array(
				'athlete'=>$athlete,
				'member'=>$member,
				'notes'=>$notifications,
				'events'=>$events,
				'sports'=>$sports
		);
	}
	function edit($id){
		$user = $this->session->userdata('id');
		if (isset($user) && $user == $id){
			$this->load->model('events_model','events');
			$vars = $this->_getCoreData($id);
		} else {
			redirect('404');
			die();
		}
		$this->fuel->pages->render('athlete/welcome',$vars);
	}
	function beFriend($id){
		if ($this->session->userdata('id')){
			// get this users id
			$user = $this->session->userdata('id');
			// check if they are already friends
			$friends = $this->members->isFriends($id,$user);
			if ($friends){
				$this->session->set_flashdata('message','Already friends');
				redirect("athlete/view/$id");
			} else {
				// create db record
				$request = $this->members->setFriendRequest($id,$user);
				if ($request > 0){
					// send notification
					// get the member details for the requestee
					$requestee = $this->members->getMember($user);
					$requested = $this->members->getMember($id);
					// build message
					$message =  "The user $requestee->first_name $requestee->last_name has requested friendship.";
					$message .= "<a href='/athlete/acceptFriend/$request'>Accept</a><a href='/athlete/declineFriend/$request'>Decline</a> ";
					// get the member details for the requester
					$this->notify->createNotification(array(
						'from_table'=>'member',
						'from_key'=>$user,
						'to_table'=>'member',
						'to_key'=>$id,
						'notification'=>$message,						
					));
					// send email
					$this->load->library('Fitzos_email',null,'Femail');
					$this->Femail->sendFriendRequest($requested,$requested->email,$request,$requestee);
					$this->session->set_flashdata('message','Friend request sent!');
					redirect("athlete/view/$id");
				} else {
					//TODO: Send error message
				}				
			}
		} else {
			redirect('signin/login');
			die();
		}
	}
	function friendRequest($id){
		if ($this->session->userdata('id')){
			//check the user is who the request is for
			$user = $this->session->userdata('id');
			// get the request
			$request = $this->members->getFriendRequest($id);
			if ($request->member_id_requestee == $user){
				// get the relevant member
				$member = $this->members->getMember($request->member_id_requested);
				// display page with ability to accept/reject
			} else {
				$request = null;
				$member = null;
				$this->session->set_flashdata('message','The friend request you attempted to access was invalid!');
			}
			$vars = array('request'=>$request,'member'=>$member);
			$this->fuel->pages->render('athlete/friendRequest',$vars);
		} else {
			redirect('signin/login');
			die();
		}
	}
	function acceptFriend($request){
		if ($this->session->userdata('id')){
			//set the friendship as accepted
			$result = $this->members->acceptFriendRequest($request);
			// set the flash data
			if ($result){
				$this->session->set_flashdata('message', 'Frienship request accepted');
			} else {
				$this->session->set_flashdata('message', 'Error accessing frindship request');
			}
			redirect('athlete/index');
			die();
		} else {
			redirect('signin/login');
			die();
		}
	}
	function declineFriend($request){
		if ($this->session->userdata('id')){
			//set the friendship as accepted
			$result = $this->members->declineFriendRequest($request);
			// set the flash data
			if ($result){
				$this->session->set_flashdata('message', 'Frienship request declined');
			} else {
				$this->session->set_flashdata('message', 'Error accessing frindshipt request');
			}
			redirect('athlete/index');
			die();
		} else {
			redirect('signin/login');
			die();
		}
	}
	function index(){
		if ($this->session->userdata('id')){
			// get the athlete from the database
			$id   = $this->session->userdata('id');
			$vars = $this->_getCoreData($id);
			if (count($vars['sports']) == 0){
				$this->session->set_flashdata('message', 'Remember to add a sport to your profile!');
			}
			if (empty($vars['member']->image)){
				$this->session->set_flashdata('message', 'Remember to add a photo to your profile!');
			}
			if (!isset($vars['member'])){
				redirect('signin/login');
			}
			$vars['id'] = $id;
			$vars['friends'] = $this->members->getFriends($id);
			$vars['sportsForThisMonth']  = $this->events->getPublicEventsForMonthBySport();
		} else {
			redirect('signin/login');
			die();
		}
		$this->fuel->pages->render('athlete/view',$vars);
	}
	function getAthlete(){
		$id      = $this->session->userdata('id');
		$athlete = $this->athletes->loadProfile($id);
		echo(json_encode($athlete));
	}
	function setAthlete(){
		$athlete = json_decode($this->input->post['payload']);
		$this->athletes->setProfile($athlete);	
	}
	function calendar(){
		// check for login???
		$vars = array();
		$this->fuel->pages->render('athlete/calendar',$vars);
		
	}
	function saveProfileImage($id){
		$request = $_REQUEST;
		$this->load->model('api_model','x');
		if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
			if ($_FILES["file"]["error"] > 0){
				$this->session->set_flashdata('message', 'Unable to save image');
			} else {
				$_FILES["file"]["name"] = underscore($_FILES["file"]["name"]);
				$path = 'assets/images/members/' . $_FILES["file"]["name"];
				if (file_exists($path)){
					// update member image to point here...
				} else {
					// save file...
					move_uploaded_file($_FILES["file"]["tmp_name"],$path);
				}
				// update the member
				$this->members->saveMemberBySalt(array('id'=>$id,'image'=>$path));
			}
		} else {
			$data = apache_request_headers();
			$this->x->logEvent('saveProfileImage->allHeaders',print_r($data,true));
			$this->x->logEvent('saveProfileImage','No file received');
			$data = file_get_contents('php://input');
			$this->x->logEvent('saveProfileImage->phpinput',print_r($data,true));
			$this->x->logEvent('saveProfileImage->request',print_r($request,true));
		}
	}
	function profile(){
		if ($this->input->post('age')){	
			$this->load->helper('inflector');
			// post to the database baby...
			$data = $this->input->post();
			$data['id'] = $this->session->userdata('id');
			$this->athletes->saveProfile($data);
			$this->session->set_flashdata('message', 'Profile Saved');
			// deal with the image.
			if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
				if ($_FILES["file"]["error"] > 0){	
					$this->session->set_flashdata('message', 'Unable to save image');
				} else {
					$_FILES["file"]["name"] = underscore($_FILES["file"]["name"]);
					$path = 'assets/images/members/' . $_FILES["file"]["name"];
					if (file_exists($path)){
						// update member image to point here...
					} else {
						// save file...
						move_uploaded_file($_FILES["file"]["tmp_name"],$path);
					}
					// update the member
					$this->members->saveMember(array('id'=>$data['id'],'image'=>$path));
				}
			}			
			redirect('athlete/index');
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
		$this->load->model('sports_model','sports');
		$vars = array();
		if ($this->input->post('member_id')){
			// new sport lets take it...
			$data = $this->input->post();
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
		$data = $this->input->post();
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
		$this->load->model('teams_model','teams');
		$vars = array();
		if ($this->session->userdata('id')){
			// get the athlete from the database
			$id      = $this->session->userdata('id');
			$athlete = $this->athletes->loadProfile($id);
			$teams   = $this->teams->getPublicTeams($id);
			$owned   = $this->teams->getOwnedTeams($id);
			$member  = $this->teams->getTeamsIn($id);
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
			$member = $this->input->get_post('member_id');
			$team   = $this->input->get_post('team_id');
			$this->load->model('teams_model','teams');
			$id = $this->teams->setMemberRequest($team,$member);
			$teamData = $this->teams->getTeam($this->input->get_post('team_id'));
			$memberData = $this->members->getMember($member);
			$owner  = $this->teams->getTeamOwner($this->input->get_post('team_id'));	
			$this->load->library('Fitzos_email',null,'Femail');
			$this->Femail->sendMemberJoiningEmail($teamData,$memberData,$owner);
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
		if ($this->session->userdata('id')){
			// get the athlete from the database
			$id   = $this->session->userdata('id');
			$notifications = $this->notify->getNotifications('member',$id);
			$vars = array('notes'=>$notifications);
			$this->fuel->pages->render('athlete/notifications',$vars);	
		} else {
			redirect('signin/login');
		}
		
	}
	function markNotificationRead($notification){
		if ($this->session->userdata('id')){
			// get the athlete from the database
			$id   = $this->session->userdata('id');
			// mark the notification read
			$this->notify->markRead($notification);
			$notifications = $this->notify->getNotifications('member',$id);
			$vars = array('notes'=>$notifications,'layout'=>'none');
			$this->fuel->pages->render('athlete/notifications',$vars);
		} else {
			redirect('signin/login');
		}
	} 
	function find(){
		if ($this->session->userdata('id')){
			// display the find page...
		} else {
			redirect('signin/login');
			die();
		}
	}
	function view($id){
		if ($this->session->userdata('id')){
			$this->load->model('athletes_model','athletes');
			$this->load->model('members_model','members');
			$sports  = $this->members->getSports($id);
			$athlete = $this->athletes->loadProfile($id);
			$member  = $this->members->getMember($id);
			$message = $this->session->flashdata('message');
		} else {
			redirect('signin/login');
			die();
		}
		$vars = array('id'=>$this->session->userdata('id'),'message'=>$message,'athlete'=>$athlete,'member'=>$member,'sports'=>$sports);
		$this->fuel->pages->render('athlete/view',$vars);
	}
}


?>