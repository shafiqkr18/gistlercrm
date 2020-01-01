<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: terminals contoller class
 * Date: 14 Dec,2015
 */
class Terminals extends CI_Controller {
	 
   
	public function __construct()
	{
		
     	parent::__construct();
     	// Your own constructor code
		
		 
		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
	$this->load->model('terminals_model');
	$this->load->model('common_model');
				
    }
	public function index()
	{
		show_404();
		
	}
	
	function rentals_viewings()
	{
		$data['v_idd'] = $this->input->post('id');
		$data['v_ref'] = $this->input->post('ref');
		$data['v_landlord_id'] = $this->input->post('landlord_id');
		$data['title'] = "viewings";
		
		//pass view as string
		echo $this->load->view('terminals/viewings', $data, TRUE);
	}
	function view_lead_popup()
	{
		$data['title'] = "leads";
		$data['viewing_popid'] = $this->input->post('id');
		//pass view as string
		echo $this->load->view('terminals/rentals_viewings_leads', $data, TRUE);
	}
	function datatable_lead_popup()
    {
		$id = $this->input->get('id');
		echo $this->terminals_model->datatable_lead_popup($id);
    } 
	public function save_viewing()
	{
		$listing_type = 1;//for rentals
		return $this->terminals_model->save_viewing($listing_type);
	}
	function datatable_viewing()
    {
		echo $this->terminals_model->datatable_viewing();
    } 
	function save_notes()
	{
		$rules = array(
					 array('field'=>'terminal_notes',
						   'label'=>'Notes',
						   'rules'=>'trim|required')
						   );
			
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run())
			{
			   $response['status'] = TRUE;
			   //send email now
			           $terminal_notes = $this->input->post('terminal_notes');
						$notes_listing_id = $this->input->post('notes_listing_id');
						$type = 1;// for rentals
					
					$this->terminals_model->save_notes($notes_listing_id,$terminal_notes,$type);
			   
			}
			else
			{
				
				// $this->session->unset_userdata('secret');
				// $this->create_captcha();
				$errors = array();
				// Loop through $_POST and get the keys
				foreach ($this->input->post() as $key => $value)
				{
					// Add the error message for this field
					$errors[$key] = form_error($key);
				}
				$response['errors'] = array_filter($errors); // Some might be empty
				$response['status'] = FALSE;
			}
			// You can use the Output class here too
			header('Content-type: application/json');
			
			exit(json_encode($response));
	}
	function getNotes()
	{
		$data['title'] = "notes";
		$id= $this->input->post('id');
		$data['listNotes'] = $this->terminals_model->getNotes($id);
		//pass view as string
		echo $this->load->view('terminals/rentals_viewings_notes', $data, TRUE);
	}
}