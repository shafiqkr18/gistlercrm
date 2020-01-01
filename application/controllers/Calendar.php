<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: Calendar contoller class
 * Date: 
 */
//use dhtmlx\samples\common\Connector\SchedulerConnector;
  require_once("./dhtmlx/samples/common/connector/scheduler_connector.php");
 require_once("./dhtmlx/samples/common/connector/db_phpci.php");
// DataProcessor::$action_param ="dhx_editor_status";

class Calendar extends CI_Controller {
	  var $original_path;
   
   

	public function __construct()
	{
		
		

     	parent::__construct();
     	// Your own constructor code
		
		 

		 

		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
			

	$this->load->model('calendar_model');
	
		

		

    }
	public function index()
	{
		if ( ! file_exists(APPPATH.'/views/calendar/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}

		$data['title'] = ucfirst('Calendar');

			/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		

		/******************get form data*******/
			$data['cal_users']  = $this->calendar_model->getAllCal_Users();
		/*****************end form data********/
		
		

		

		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('calendar/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	public function submit()
	{
		return $this->calendar_model->save_calendar();
	}
	
	

	public function getAllUsers()
	{
		//return  $this->calendar_model->getAllUsers();
		$conn = new SchedulerConnector($this->db, "PHPCI");
		$this->load->model('calendar_model');
		$events = $this->calendar_model->getAllUsers();
		//print_r($events);
		$conn->render_array($events,"id", "name");
	}
	public function getEventInfo()
	{
		$event_id = $this->input->get("event_id");
		$conn = new SchedulerConnector($this->db, "PHPCI");
		$this->load->model('calendar_model');
		//$events = $this->calendar_model->getEventInfo($event_id);
		
		

		// $conn->render_array($events,"event_id", "event_type, start_date, end_date,event_name,location,description,userId,created_by,dateadded,dateupdated,
		// day_ends_on,day_of_week,hdn_repeat,month_ends_on,pack_agent_id,repeat_type");  
		
		

		$res = $this->calendar_model->getEventInfo($event_id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	public function data()
	{
		 $conn = new SchedulerConnector($this->db, "PHPCI");
		$this->load->model('calendar_model');
		$events = $this->calendar_model->getAllEvents();
		//print_r($events);
		$conn->render_array($events,"event_id", "start_date, end_date, event_name");  
	
	

	}
	public  function getGuestEmails($value=0)
	{
		echo $this->calendar_model->getGuestEmails($value);
	}
	public function setEditGuestEmails($value=0)
	{
		echo $this->calendar_model->setEditGuestEmails($value);
	}
	public function delete_event($value=0)
	{
		return $this->calendar_model->delete_event($value);
	}
	public function updateUserSettings()
	{
		return;
	}
	public function setGuestEmails()
	{
		$data['res']= $this->calendar_model->setGuestEmails();
		echo $this->load->view('partial/cal_guest_emails', $data, TRUE);
	}
	public function editRepeatEvent($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 echo $this->calendar_model->editRepeatEvent($id);
		  
		  
	}
	public function initLoad()
	{
		$conn = new SchedulerConnector($this->db, "PHPCI");
		$this->load->model('calendar_model');
		$events = $this->calendar_model->getAllEvents();
		//print_r($events);
		$conn->render_array($events,"event_id", "start_date, end_date, event_name");  
	}
	public function getUserEventById()
	{
		$ids = $this->input->get("ids");
		$conn = new SchedulerConnector($this->db, "PHPCI");
		$this->load->model('calendar_model');
		$events = $this->calendar_model->getUserEventById($ids);
		//print_r($events);
		$conn->render_array($events,"event_id", "start_date, end_date, event_name"); 
	}
	public function getSingleUserById()
	{
		$ids = $this->input->get("ids");
		//echo $ids."==";exit;
		$conn = new SchedulerConnector($this->db, "PHPCI");
		$this->load->model('calendar_model');
		$events = $this->calendar_model->getAllEventsByUsers($ids);
		//print_r($events);
		$conn->render_array($events,"event_id", "start_date, end_date, event_name"); 
	}
	public function insertEvent()
	{
	
	

		return $this->calendar_model->insertEvent();
	}
	public function updateEvent()
	{
		return $this->calendar_model->insertEvent();
	}
	public function saveiCal()
	{
		$this->load->helper('file');
		$id = $this->input->get("idUser");
		$cal_data = $this->input->get("iCal");
		//echo $ids."==".$cal_data;exit;
		//./uploads/listings/
		$filename = "shafiq.ical";
		header("Cache-Control: ");
header("Content-type: text/plain");
header('Content-Disposition: attachment; filename="'.$filename.'"');
echo $cal_data;
		 //file_put_contents("./uploads/iCal/".$id.".ical",$cal_data);
		// echo "./uploads/iCal/".$id.".ical";
		 // if ( ! write_file("./uploads/iCal/".$id.".ical", $cal_data))
			// {
			//         echo 'Unable to write the file';
			// }
			// else
			// {
			//         echo 'File written!';
			// }
	}

}