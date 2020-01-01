<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: prieview contoller class
 * Date: 18 Feb,2016
 */
class Preview extends CI_Controller {
	public function __construct()
	{
		
     	parent::__construct();
	
		$this->load->model('preview_model');
				
    }
	public function index()
	{
		if ( ! file_exists(APPPATH.'/views/rentals/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$rand_key = $this->uri->segment(3,0);
		$client_id = $this->uri->segment(4,0);
		$agent_id = $this->uri->segment(5,0);
		$listing_id = $this->input->get('l_id');
		
		if($listing_id<0 && $agent_id<0)
		{
			show_error('No identifier provided', 500);
		}
		
		$data['title'] = ucfirst('preview');
			
		$lst = $this->preview_model->get_Listing($listing_id);
		if($lst->features_id != '')
		$data['getFeatures'] = $this->preview_model->get_Features($lst->features_id);
		$data['getLst'] =  $lst;
		$data['getAgent'] = $this->preview_model->get_Agent($agent_id);
		$data['getImages'] = $this->preview_model->get_Images($listing_id);
		
		
		/****************************start view fiels*************/
		
		$this->load->view('preview/home', $data);
		
		/****************************end view fils***************/
		 
		
	}
	public function request_view()
		{
			$this->load->library('form_validation');
			$rules = array(
					 array('field'=>'txt_name',
						   'label'=>'Full Name',
						   'rules'=>'trim|required'),
					array('field'=>'txt_phone',
						   'label'=>'Mobile No',
						   'rules'=>'trim|required'),
					array('field'=>'txt_comment',
						   'label'=>'Message',
						   'rules'=>'trim|required'),	   	   
					 array('field'=>'txt_email',
						   'label'=>'Email',
						   'rules'=>'trim|required|valid_email')
					 );
		   // $this->form_validation->set_message('capcha_check', 'Text dont match Captcha!');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run())
			{
			   $response['status'] = TRUE;
			   //send email now
			           $name = $this->input->post('txt_name');
						$from_email = $this->input->post('txt_email');
						$mobile = $this->input->post('txt_phone');
						$message = $this->input->post('txt_comment');
						$txt_time = $this->input->post('txt_time');
						$ag_email = $this->input->post('ag_email');
						//echo $name.$from_email.$mobile.$message.$txt_time;exit;
						$res = $this->send_mail($name,$from_email,$mobile,$message,$txt_time,$ag_email);
						if($res) return TRUE;
						else return FALSE;
			   
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
public function send_mail($name,$from_email,$mobile,$message,$txt_time,$ag_email)
	{
		//set to_email id to which you want to receive mails
		$this->load->library('email');
						         $to_email = $ag_email;
								 //configure email settings
									$config['protocol'] = 'smtp';
									$config['smtp_host'] = 'ssl://smtp.gmail.com';
									$config['smtp_port'] = '465';
									$config['smtp_user'] = 'royalhome.ae@gmail.com';
									$config['smtp_pass'] = 'royalhome2013';
									$config['mailtype'] = 'html';
									$config['charset'] = 'iso-8859-1';
									$config['wordwrap'] = TRUE;
									$config['newline'] = "\r\n"; //use double quotes
									
									$this->email->initialize($config);                        
						
									//send mail
									$this->email->from($from_email, $name);
									$this->email->to($to_email);
									$this->email->subject("Request Viewing From ".$txt_name." Phone# ".$txt_phone);
									$this->email->message($message);
									 if ($this->email->send())
										{
											return true;
										}else{
											return false;
										}
	}
}