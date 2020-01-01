<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Muhammad Shafiq

 * Email: muhammad.royalhome@gmail.com

 * Description: rentals contoller class

 * Date: 12 may,2016

 */

class Commingsoon extends CI_Controller {

	public function __construct()

	{

		

     	parent::__construct();
    }

    public function index()

	{

		

		$data['title'] = ucfirst('soon');

		/****************************start view fiels*************/

		$this->load->view('templates/listing_top', $data);

		$this->load->view('templates/navigation', $data);

		$this->load->view('templates/header_listing', $data);

		$this->load->view('commingsoon', $data);

		$this->load->view('templates/footer_listing', $data);

		/****************************end view fils***************/

	}

}	