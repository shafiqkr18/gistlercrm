<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: History contoller class
 * Date: 11Feb,2016
 */
class History extends CI_Controller {
		
		

	public function __construct()
	{
		parent::__construct();
     	// Your own constructor code
		 
		 

		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
			

	$this->load->model('history_model');
	$this->load->model('common_model');
				
				

    }
	public function index()
	{
		if ( ! file_exists(APPPATH.'/views/history/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('history');
			/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		

		/******************get form data*******/
			
			

		/*****************end form data********/
		
		

		

		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('history/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	public function login_history()
	{
		if ( ! file_exists(APPPATH.'/views/history/login_history.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('login history');
			/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		

		/******************get form data*******/
			
			

		/*****************end form data********/
		
		

		

		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('history/login_history', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	
	

	public function history_datatable()
	{
		echo $this->history_model->history_datatable();
	}

	public function loginhistory_datatable()

	{

		echo $this->history_model->loginhistory_datatable();

	}

}	