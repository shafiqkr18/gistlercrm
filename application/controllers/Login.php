<?php
/* Author: Muhammad Shafiq
 * Description: Login controller class
 * Date: 23 Nov,2015
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	 function __construct(){
        parent::__construct();
		$this->load->model('login_model');
		
	 }
	 public function index()
	{
		if ( ! file_exists(APPPATH.'/views/login/login_view.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst("Login"); 
		$this->load->view('templates/header_login', $data);
		$this->load->view('login/login_view');
	}
	function logout()
	 {
	   $this->session->unset_userdata('logged_in');
	   session_destroy();
	   redirect('login', 'refresh');
	 }
	
}