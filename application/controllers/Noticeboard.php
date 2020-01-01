<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: noticeboard contoller class
 * Date: 25Feb,2016
 */
class Noticeboard extends CI_Controller {
	 
   
	public function __construct()
	{
		
     	parent::__construct();
     	// Your own constructor code
		
		 $this->document_path = "./uploads/documents/noticeboard/"; 
		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
	$this->load->model('noticeboard_model');
	$this->load->model('common_model');
				
    }
	public function index()
	{
		if ( ! file_exists(APPPATH.'/views/noticeboard/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('noticeboard');
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
		$this->load->view('noticeboard/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	public function target()
	{
		if ( ! file_exists(APPPATH.'/views/noticeboard/target_home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('target');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		$data['dealsList'] = $this->noticeboard_model->getallDeals();
	
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('noticeboard/target_home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	public function submit_notice()
	{
		echo $this->noticeboard_model->save_notice();
	}
	function datatable_notices()
    {
		
		echo $this->noticeboard_model->datatable_notices();
    }
	function datatable_documents()
    {
		
		echo $this->noticeboard_model->datatable_documents();
    }
	function datatable_target()
	{
		echo $this->noticeboard_model->datatable_target();
	}
	public function download($id)
	{
		$this->load->helper('download');
		 $file = $this->noticeboard_model->getDocumentById($id); //getting all the file details
                                                      //for $file_id (all details are stored in DB)
        $data = file_get_contents($this->document_path.$this->session->userdata('client_id').'/'.$file->file_name); // Read the file's contents
        $name = $file->file_name;

        force_download($name, $data);
	}
	public function uploadDocuments()
	{
		if ($this->session->userdata('userid') < 1)
		{ 
			redirect('login');
		}
			$error = "";
		
		$title    =   $this->input->post('name');
		
		//echo $listing_id."=".$rand_key."=".$title;
		 $this->load->library('image_lib');
			$new_name = $this->uuid->v4(); 
			
			$image_upload_folder = $this->document_path.$this->session->userdata('client_id');   // folder page
			 if (!file_exists($image_upload_folder)) {
				mkdir($image_upload_folder, DIR_WRITE_MODE, true);
			 }
			
			$config = array(
			'upload_path' => $image_upload_folder, //upload directory
			'file_name'  => $new_name,
			'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|ppt|pptx|csv",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_height' => "768",
			'max_width' => "1024"
			);
			 $image1='upload_documents';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload($image1))
				{
					$error = array('error' => $this->upload->display_errors());
		
					print_r($error);exit;
				}
				else
				{
						$image_data=$this->upload->data();
						$file_name = $new_name.$image_data['file_ext'];
						$file_size = $image_data['file_size'];
						$image_type = $image_data['image_type'];
						//echo $file_name."--".$title."=".$file_size."=".$image_type;exit;
						$image_id = $this->noticeboard_model->save_documents($file_name,$title,$file_size,$image_type);
						echo $file_name;
					
				}
	}
    
	public function set_target()
	{
		$this->load->library('form_validation');
			$rules = array(
					 array('field'=>'target',
						   'label'=>'Target',
						   'rules'=>'trim|required'),
					array('field'=>'agent_id',
						   'label'=>'User Name',
						   'rules'=>'trim|required')
					
					 );
		   // $this->form_validation->set_message('capcha_check', 'Text dont match Captcha!');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run())
			{
			   $response['status'] = TRUE;
			   //send email now
			           $target = $this->input->post('target');
						$agent_id = $this->input->post('agent_id');
						echo $this->noticeboard_model->save_target($target,$agent_id);
						
			   
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
}