<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: Leads contoller class
 * Date: 28 Dec,2015
 */
class Leads extends CI_Controller {
	 
   

   

	public function __construct()
	{
		
		

     	parent::__construct();
     	// Your own constructor code
		
		 

		 

		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
			

	$this->load->model('leads_model');
	$this->load->model('common_model');
				
				

    }
	public function index($listing_type='')
	{
		if ( ! file_exists(APPPATH.'/views/leads/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('leads');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		/*************end session values*********/
		
		

		

		 /***********************get url data**************/
         $data['listing_type'] = '';
         if($listing_type == "rentals")
		 $data['listing_type'] = 1;
		 elseif ($listing_type == "sales")
		 $data['listing_type'] = 2;
		 elseif ($listing_type == "successful_rentals")
		 $data['listing_type'] = 100;
		 elseif ($listing_type == "successful_sales")
		 $data['listing_type'] = 101;
		 elseif ($listing_type == "day_rentals")
		 $data['listing_type'] = 102;
		 elseif ($listing_type == "day_sales")
		 $data['listing_type'] = 103;
		  elseif ($listing_type == "open_rentals")
		 $data['listing_type'] = 104;
		 elseif ($listing_type == "open_sales")
		 $data['listing_type'] = 105;
		 elseif ($listing_type == "sevendays_rentals")
		 $data['listing_type'] = 106;
		 elseif ($listing_type == "sevendays_sales")
		 $data['listing_type'] = 107;
		 elseif ($listing_type == "closed_rentals")
		 $data['listing_type'] = 108;
		 elseif ($listing_type == "closed_sales")
		 $data['listing_type'] = 109;
        /***********************end url data*************/
        
		

		

		/******************get form data*******/
			
			

		/*****************end form data********/
		
		

		

		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('leads/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	
	

	public function lookupnew()
	{
		$mobile_no_new = $this->input->get('mobile_no_new');
		$email = $this->input->get('email');
		
		

		echo $this->leads_model->lookupnew($mobile_no_new,$email);
		
		

	}
	public function submit()
	{
		return $this->leads_model->save_leads();
	}
	function datatable()
    {
		
		

		echo $this->leads_model->datatable();
    }
	function datatable_landlord()
	{
		echo $this->leads_model->datatable_landlord();
	}
	public function single($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->leads_model->getSingleRow($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;

	}

	/************************save search*******************/

		public function savesearch()

		{

			echo $this->leads_model->savesearch();

	}
	
}