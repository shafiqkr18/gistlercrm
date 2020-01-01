<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Kevin Espaldon
 * Email: muhammad.royalhome@gmail.com
 * Description: Reports Controller Class
 * Date: 6 Feb, 2016
 */

class Reports extends CI_Controller 
{

	public function __construct(){
		parent::__construct();

		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
		$this->load->library('email');
		$this->load->model('Reports_model');
		$this->load->model('Common_model');

	}

	public function index(){
		if ( ! file_exists(APPPATH.'/views/reports/home.php'))
		{
		// Whoops, we don't have a page for that!
			show_404();
		}
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Reports Dashboard'); // Capitalize the first letter
		$data['viewName'] = "reportdashboard";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/home', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	/* Load Views
	------------------------------*/
	public function reportbuilder() {
		if ( ! file_exists(APPPATH.'/views/reports/reportbuilder.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Report Builder'); // Capitalize the first letter
		$data['viewName'] = "reportbuilder";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportbuilder', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportagentleaderboard(){
		if ( ! file_exists(APPPATH.'/views/reports/reportagentleaderboard.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Agent Leaderboard'); // Capitalize the first letter
		$data['viewName'] = "reportagentleaderboard";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportagentleaderboard', $data);
		$this->load->view('templates/footer_listing', $data);
	}
	
	public function reportlistingcategory()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportlistingcategory.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/

		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Listing Type & Category'); // Capitalize the first letter
		$data['viewName'] = "reportlistingcategory";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportlistingcategory', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportdealssuccess()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportdealssuccess.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Deals Success	'); // Capitalize the first letter
		$data['viewName'] = "reportdealssuccess";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportdealssuccess', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportleadhot()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportleadhot.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Hot Leads'); // Capitalize the first letter
		$data['viewName'] = "reportleadhot";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportleadhot', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportleadpipeline()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportleadpipeline.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Leads Opportunity Pipiline'); // Capitalize the first letter
		$data['viewName'] = "reportleadpipeline";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportleadpipeline', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportleadsource()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportleadsource.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Source'); // Capitalize the first letter
		$data['viewName'] = "reportleadsource";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportleadsource', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportleadstuck()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportleadstuck.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Stuck Oppotunities'); // Capitalize the first letter
		$data['viewName'] = "reportleadstuck";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportleadstuck', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportleadtype()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportleadtype.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Leads Type'); // Capitalize the first letter
		$data['viewName'] = "reportleadtype";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportleadtype', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportlistinglocation()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportlistinglocation.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Listing Locations'); // Capitalize the first letter
		$data['viewName'] = "reportlistinglocation";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportlistinglocation', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportsavedcontacts()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportsavedcontacts.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('My Saved Reports - Contacts'); // Capitalize the first letter
		$data['viewName'] = "reportsaved";
		$data['reportType'] = "1";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportsavedcontacts', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportsaveddeals()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportsaveddeals.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('My Saved Reports - Deals'); // Capitalize the first letter
		$data['viewName'] = "reportsaved";
		$data['reportType'] = "2";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportsaveddeals', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportsavedleads()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportsavedleads.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('My Saved Reports - Leads'); // Capitalize the first letter
		$data['viewName'] = "reportsaved";
		$data['reportType'] = "3";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportsavedleads', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportsavedlisting()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportsavedlisting.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('My Saved Reports - Listings'); // Capitalize the first letter
		$data['viewName'] = "reportsaved";
		$data['reportType'] = "4";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportsavedlisting', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportlistingstatus()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportlistingstatus.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Listing report status'); // Capitalize the first letter
		$data['viewName'] = "reportlistingstatus";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportlistingstatus', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportdealsstatus()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportdealsstatus.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Deals status'); // Capitalize the first letter
		$data['viewName'] = "reportdealsstatus";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportdealsstatus', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportview()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportview.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Viewings'); // Capitalize the first letter
		$data['viewName'] = "reportview";


		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportview', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportviewleads()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportviewleads.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Listings By Leads'); // Capitalize the first letter
		$data['viewName'] = "reportviewleads";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportviewleads', $data);
		$this->load->view('templates/footer_listing', $data);
	}

	public function reportviewlisting()	{
		if ( ! file_exists(APPPATH.'/views/reports/reportviewlisting.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		$data['title'] = ucfirst('Leads By Listing Type & Category'); // Capitalize the first letter
		$data['viewName'] = "reportviewlisting";

		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('reports/reportviewlisting', $data);
		$this->load->view('templates/footer_listing', $data);
	}
	/* End
	---------*/

	/* GenerateReports
	------------------------------*/

	public function DealsStatus(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->DealsStatus($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);	
	}

	public function DealsSuccess(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->DealsSuccess($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);	
	}	

	public function LeadHot(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->LeadHot($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	public function LeadPipeline(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->LeadPipeline($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);	
	}

	public function LeadSource(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->LeadSource($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	public function LeadStuck(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->LeadStuck($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);	
	}	

	public function LeadType(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->LeadType($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);	
	}

	public function ListingCategory(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->ListingCategory($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function ListingLocation(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->ListingLocation($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function ListingStatus(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->ListingStatus($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function SavedContacts(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->SavedContacts($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function SavedDeals(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->SavedDeals($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function SavedLeads(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->SavedLeads($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function SavedListing(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->SavedListing($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function View(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->View($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function ViewLeads(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->ViewLeads($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function ViewListings(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->ViewListings($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}	

	public function SaveContacts(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->SaveContacts($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function SaveDeals(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->SaveDeals($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function SaveLeads(){
		$subGroup = $this->input->post('subGroup');
		$where = $this->input->post('where');

		$res = $this->Reports_model->SaveLeads($subGroup, $where);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function SaveReport(){
		$objData = $this->input->post('objData');

		if(strlen($objData["reference"]) == 'new'){

			$ref = $this->Reports_model->GetMaxId('crm_saved_reports') + 1;
			$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

			$objData["reference"] = "GIS-R".$objData["type"]."-".$ref;
		}

		// echo $objData["reference"];exit;

		$res = $this->Reports_model->SaveReport($objData);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}	

	public function GetSavedReports(){
		$type = $this->input->post('type');
		
		$res = $this->Reports_model->GetSavedReports($type);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function GetSavedReport($reportId){
		$res = $this->Reports_model->GetSavedReport($reportId);
		$this->output->set_content_type('application/json');
		echo json_encode($res);// exit;
	}

	public function DeleteReport(){
		$reference = $this->input->post('reference');
		$type = $this->input->post('type');

		$res = $this->Reports_model->DeleteReport($reference, $type);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	public function SendEmail(){

		$email = $this->input->post('email');
		$message = $this->input->post('message');
		

		$this->email->from('your@example.com', 'Your Name');
		$this->email->to($email); 
		// $this->email->cc('another@another-example.com'); 
		// $this->email->bcc('them@their-example.com'); 

		$this->email->subject('Email Test');
		$this->email->message($message);	

		$this->email->send();

		echo $this->email->print_debugger();
	}

	public function GetRecentlySavedReports(){
		
		$res = $this->Reports_model->GetRecentlySavedReports();
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}	

	public function GetDashboardReports(){
		$res = $this->Reports_model->GetDashboardReports();
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	function GetAgents(){
		$res = $this->Reports_model->GetAgents();
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	function GetAgentLeaderboard(){

		$listingType =  $this->input->get('type');
		echo $this->Reports_model->GetAgentLeaderboard($listingType);
	}	

	function GetReportTotals(){
		$listingType =  $this->input->post('type');
		$agent =  $this->input->post('agent');
		$date =  $this->input->post('date');

		// echo "type-->" . $listingType;
		// echo "agent-->" . $agent;
		// echo "date-->" . $date;
		// exit;		

		$res = $this->Reports_model->GetReportTotals($listingType, $agent, $date);
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	function GetConversionRates(){
		$listingType =  $this->input->post('type');
		$agent =  $this->input->post('agent');
		$date =  $this->input->post('date');

		$res = $this->Reports_model->GetConversionRates($listingType, $agent, $date);
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}
}
?>