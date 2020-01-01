<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: rentals contoller class
 * Date: 1 Dec,2015
 */
class Test extends CI_Controller {
	public function __construct()
	{
		
     	parent::__construct();
	
	$this->load->model('test_model');
	//$this->load->library('uuid');
	$this->load->helper('text');	
	$this->load->helper('url');		
    }
	public function index()
	{
		
		$data['title'] = ucfirst('rentals');
		$this->load->view('test', $data);
	}
		function datatable()
    {
		
		echo $this->test_model->datatable();
    }
	public function testme()
	{
		echo word_limiter("i am here with sdfa sdafa sadfe ew",5);
		
	}
}