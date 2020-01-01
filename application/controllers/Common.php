<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Description: common controller for all common functions
 * Date: 23 Nov,2015
 */
class Common extends CI_Controller {
	
	

	public function __construct()
	{
     	parent::__construct();
     	// Your own constructor code
		
		

		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
		$adm_type = $this->session->userdata('user_type');			
		$this->load->model('common_model');
		$this->load->library('email');
		$this->load->library('form_validation');
				
				
    }
	
	

	public function getcoordinates($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->common_model->getcoordinates($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	public function getlastid($type)
	{
		
		

		 $res = $this->common_model->getlastid($type);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	public function validate_sub_location($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->common_model->validate_sub_location($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	
	

	public function validate_location($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->common_model->validate_location($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	
	

	public function validate_agent($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->common_model->validate_agent($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	
	

	public function validate_company_profile()
	{
		
		

		 $client_id = $this->session->userdata('client_id');
		 $res = $this->common_model->validate_company_profile($client_id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	
	

	public function getAgents()
	{
		
		

		 $res = $this->common_model->getAgents();
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	
	

	public function auto_location()
	{
		$term = trim($this->input->get('term', TRUE));
		$this->common_model->auto_location($term);
		
		

	}
	public function save_disabled_columns()
	{
		return $this->common_model->save_disabled_columns();
	}
	function view_landlord_popup()
	{
		$data['title'] = "Contacts";
		
		

		//pass view as string
		echo $this->load->view('partial/listings_landlords', $data, TRUE);
	}
	function datatable_landlord_popup()
    {
	
	

		echo $this->common_model->datatable_landlord_popup();
    }
	 
	 

	 function view_lead_popup()
	{
		$data['title'] = "leads";
		
		

		//pass view as string
		echo $this->load->view('partial/listings_leads', $data, TRUE);
	}
	function datatable_lead_popup()
    {
		
		

		echo $this->common_model->datatable_lead_popup();
    } 
	
	

	public function checkLocationInsertSettings($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->common_model->checkLocation($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	
	

	public function checkSubLocationInsertSettings($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->common_model->checkSubLocation($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	
	

	

	public function save()
	{
		$res = $this->common_model->set_Locations();
		 $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	public function single_setting($id)
	{
		$res = $this->common_model->single_setting($id);
		 $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	function datatable_locations()
    {
		
		

		echo $this->common_model->datatable_locations();
    }
	function linktolistings()
	{
		$data['title'] = "Listings";
		
		

		//pass view as string
		echo $this->load->view('partial/linktolistings', $data, TRUE);
	}
	function datatable_linktolistings()
	{
		echo $this->common_model->datatable_linktolistings();
	}
	
	

	function add_view_multi_landlord_popup($type)
	{
		
		

		$data["con_type"] = $type;
		echo $this->load->view('partial/deals_landlords', $data, TRUE);
	}
	public function autoFindListing()
	{
		$res = $this->common_model->autoFindListing();
		 $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	public function view_task_popup()
	{
		$data["title"] = '';
		echo $this->load->view('partial/view_task_popup', $data, TRUE);
	}
	public function add_task_popup()
	{
		$data["title"] = '';
		echo $this->load->view('partial/add_task_popup', $data, TRUE);
	}
	public function add_event_popup()
	{
		$data["title"] = '';
		echo $this->load->view('partial/add_event_popup', $data, TRUE);
	}
	public function add_lead_popup()
	{
		$data["title"] = '';
		echo $this->load->view('partial/add_lead_popup', $data, TRUE);
	}
	public function add_deal_popup()
	{
		$data["title"] = '';
		echo $this->load->view('partial/add_deal_popup', $data, TRUE);	
	}
	public function datatable_listings_todo()
	{
		echo $this->common_model->datatable_listings_todo();
	}
	public function view_event_popup()
	{
		$data["title"] = '';
		echo $this->load->view('partial/view_event_popup', $data, TRUE);
	}
	
	

	public function datatable_listings_events()
	{
		echo $this->common_model->datatable_listings_events();
	}
	
	

	public function view_deal_popup()
	{
		$data["title"] = '';
		echo $this->load->view('partial/view_deal_popup', $data, TRUE);
	}
	
	

	public function datatable_listings_deals()
	{
		echo $this->common_model->datatable_listings_deals();
	}
	function send_sms()
	{
		$mob_number = $this->input->post('mob_number'); 
		$msg = $this->input->post('description'); 
			//Please Enter Your Details
			 $user="royalhome"; //your username
			 $password="royal2010"; //your password
			 $mobilenumbers=$mob_number;//+971552493494 //enter Mobile numbers comma seperated
			 $message = $msg; //enter Your Message 
			 $senderid="SMSCountry"; //Your senderid
			 $messagetype="N"; //Type Of Your Message
			 $DReports="Y"; //Delivery Reports
			 $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
			 $message = urlencode($message);
			 $ch = curl_init(); 
			 if (!$ch){die("Couldn't initialize a cURL handle");}
			 $ret = curl_setopt($ch, CURLOPT_URL,$url);
			 curl_setopt ($ch, CURLOPT_POST, 1);
			 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			 curl_setopt ($ch, CURLOPT_POSTFIELDS, 
			"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
			 $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			

			

			//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
			// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
			
			
			
			

			

			 $curlresponse = curl_exec($ch); // execute
			if(curl_errno($ch))
				echo 'curl error : '. curl_error($ch);
			
			

			 if (empty($ret)) {
			    // some kind of an error happened
			    die(curl_error($ch));
			    curl_close($ch); // close cURL handler
			 } else {
			    $info = curl_getinfo($ch);
			    curl_close($ch); // close cURL handler
			    //echo "<br>";
				//echo $curlresponse;    //echo "Message Sent Succesfully" ;
			   
			   

			 }

	}
	
	public function reset()
		{
			
			
			   //send email now
			  $name = $this->input->post('name');
			   //$this->common_model->get_password($name);

			   $response['status'] = TRUE;
			   header('Content-type: application/json');
			
			exit(json_encode($response));

	
}


}



?>