<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: contacts contoller class
 * Date: 22 Dec,2015
 */
class Contacts extends CI_Controller {
	 
   
	public function __construct()
	{
		
     	parent::__construct();
     	// Your own constructor code
		$this->original_path = "./uploads/listings/";
		 $this->document_path = "./uploads/documents/contacts/";
		 
		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
	$this->load->model('contacts_model');
	$this->load->model('common_model');
				
    }
	public function index()
	{
		if ( ! file_exists(APPPATH.'/views/contacts/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('contacts');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		/******************get url data*******/
			$listing_type='';
			$data['listing_type']= $this->input->get('listing_type');
			 
		/*****************end url data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('contacts/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	
	public function lookupnew()
	{
		$mobile_no_new = $this->input->get('mobile_no_new');
		$email = $this->input->get('email');
		
		echo $this->contacts_model->lookupnew($mobile_no_new,$email);
		
	}
	public function submit()
	{
		return $this->contacts_model->save_contacts();
	}
	function datatable()
    {
		
		echo $this->contacts_model->datatable();
    }
	public function single($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->contacts_model->getSingleRow($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	public function ownedproperties()
	{
		
		echo $this->contacts_model->ownedproperties();
		
	}
	public function autoFindLead()
	{
		$term = trim($this->input->get('term', TRUE));
		$this->contacts_model->autoFindLead($term);
		
	}
	public function get_contacts_stats($id = null)
	{
			 if ($id == null) {
				show_error('No identifier provided', 500);
			}
			else {
			 
			 
					$res = $this->contacts_model->get_contacts_stats($id);
					 $this->output->set_content_type('application/json');
           				 echo json_encode($res);
        					exit;
					
			}
	}
	
	public function notes($id = null)
	{
			 if ($id == null) {
				show_error('No identifier provided', 500);
			}
			else {
			 
			 
					$res = $this->contacts_model->get_notes($id);
					 $this->output->set_content_type('application/json');
           				 echo json_encode($res);
        					exit;
					
			}
	}
	public function uploadDocuments()
	{
		if ($this->session->userdata('userid') < 1)
		{ 
			redirect('login');
		}
			$error = "";
		$listing_id  =   $this->input->post('listing_id');
		$rand_key    =   $this->input->post('rand_key');
		$title    =   $this->input->post('title');
		
		//echo $listing_id."=".$rand_key."=".$title;
		 $this->load->library('image_lib');
			$new_name = $rand_key.date('YmdHis',time()).md5(time());//.".".$image_data['file_ext'];
			
			$image_upload_folder = $this->document_path.$this->session->userdata('client_id')."/".$this->session->userdata('userid')."/".md5($rand_key);   // folder page
			 if (!file_exists($image_upload_folder)) {
				mkdir($image_upload_folder, DIR_WRITE_MODE, true);
			 }
			//'allowed_types' => "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp",
			
			$config = array(
			'upload_path' => $image_upload_folder, //upload directory
			'file_name'  => $new_name,
			'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|ppt|pptx|csv",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_height' => "768",
			'max_width' => "1024"
			);
			 $image1='listings_documents';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload($image1))
				{
					$error = array('error' => $this->upload->display_errors());
		
					
				}
				else
				{
						$image_data=$this->upload->data();
						$new_name = $new_name.$image_data['file_ext'];
						$image_id = $this->contacts_model->save_documents($rand_key,$new_name,$listing_id,$title);
						echo md5($rand_key)."/".$new_name;
					
				}
	}
	
}