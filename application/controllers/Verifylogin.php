<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('login_model','',TRUE);
   $this->load->library('form_validation');
 }

 function index()
 {
   
   
   $data['title'] = ucfirst("Login"); 
   //This method will have the credentials validation
   $this->form_validation->set_rules('username', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
  

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
	 
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	 
	 $this->load->view('templates/header_login', $data);
     $this->load->view('login/login_view');
   }
   else
   {
     //Go to private area
     redirect('dashboard', 'refresh');
   }

 }
	function logout()
	 {
	   $this->session->unset_userdata('logged_in');
	   session_destroy();
	   redirect('dashboard', 'refresh');
	 }
 function check_database($password)
 {
	
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');

   //query the database
   $result = $this->login_model->get_user($username, $password);
   //echo var_dump($result);exit;//"username-->" . $username . " | password--> " . $password;exit; //
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       
	   $data = array(
						'userid' => $row->id,
						'username' => $row->username,
						'validated' => true,
						'user_type' => $row->access,
						'client_id' => $row->client_id,
						'user_fullname'=> $row->first_name." ".$row->last_name,
						'disable_publish' => $row->disable_publish,
						'disable_excel' => $row->disable_excel,
						'is_sms' => $row->is_sms,
						'delete_permissions' => $row->delete_permissions,
						'edit_listings' => $row->edit_listings,
						'mobileNo' => $row->mobile_no_new_ccode." ".$row->mobile_no_new,
						'job_title' => $row->job_title,
						'email' => $row->email,
						'rera' => $row->rera,
						'pic' => $row->photo_agent
						);
				$this->session->set_userdata($data);
				
				//lets save history here
				$this->login_model->save_loginhistory($row->id);
     
     }
     return TRUE;
   }
   else
   {
	  
     $this->form_validation->set_message('check_database', 'Invalid username or password');
	 return false;
   }
 }
}
?>