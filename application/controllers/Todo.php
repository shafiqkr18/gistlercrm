<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: Todo contoller class
 * Date: march 2016
 */
 class Todo extends CI_Controller {
	 
	public function __construct()
	{
		
     	parent::__construct();
     	// Your own constructor code
		
		 
		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
	$this->load->model('todo_model');
	$this->load->model('listings_model');
	
		
    }
	public function index()
	{
		if ( ! file_exists(APPPATH.'/views/todo/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('Todo');
			/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('todo/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	public function todosubmit()
		{
			return $this->listings_model->save_todo();
		}
	function datatable()
    {
		
		echo $this->todo_model->datatable();
    }	
 }
