<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: accounts contoller class
 * Date: 13Feb,2016
 */
class Accounts extends CI_Controller {
		
	public function __construct()
	{
		parent::__construct();
     	// Your own constructor code
		 
		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
	$this->load->model('accounts_model');
	$this->load->model('common_model');
				
    }
	public function index()
	{
		if ( ! file_exists(APPPATH.'/views/accounts/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('accounts');
			/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		/******************get form data*******/
			
		/*****************end form data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('accounts/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	public  function balance_sheet()
	{
		if ( ! file_exists(APPPATH.'/views/accounts/balance_sheet.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('balance sheet');
			/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		/******************get form data*******/
			
		/*****************end form data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('accounts/balance_sheet', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	public  function bank_accounts()
	{
		//this was settings
		if ( ! file_exists(APPPATH.'/views/accounts/bank_accounts.php'))
			{
			// Whoops, we don't have a page for that!
			show_404();
			}
			$data['title'] = ucfirst('bank accounts');
				/*************get session values*********/
			$data['userid'] = $this->session->userdata('userid');
			$data['username'] = $this->session->userdata('username');
			$data['user_type'] = $this->session->userdata('user_type');
			$data['client_id'] = $this->session->userdata('client_id');
			/*************end session values*********/
			
			/******************get form data*******/
				
			/*****************end form data********/
			
			
			/****************************start view fiels*************/
			$this->load->view('templates/listing_top', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('templates/header_listing', $data);
			$this->load->view('accounts/bank_accounts', $data);
			$this->load->view('templates/footer_listing', $data);
			/****************************end view fils***************/
		
	}
	public function transaction_categories()
	{
		//manage_types
		if ( ! file_exists(APPPATH.'/views/accounts/transaction_categories.php'))
			{
			// Whoops, we don't have a page for that!
			show_404();
			}
			$data['title'] = ucfirst('transaction categories');
				/*************get session values*********/
			$data['userid'] = $this->session->userdata('userid');
			$data['username'] = $this->session->userdata('username');
			$data['user_type'] = $this->session->userdata('user_type');
			$data['client_id'] = $this->session->userdata('client_id');
			/*************end session values*********/
			
			/******************get form data*******/
				
			/*****************end form data********/
			
			
			/****************************start view fiels*************/
			$this->load->view('templates/listing_top', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('templates/header_listing', $data);
			$this->load->view('accounts/transaction_categories', $data);
			$this->load->view('templates/footer_listing', $data);
			/****************************end view fils***************/
		
	}
	public function payment_modes()
	{
		//manage_dropdowns
		if ( ! file_exists(APPPATH.'/views/accounts/payment_modes.php'))
			{
			// Whoops, we don't have a page for that!
			show_404();
			}
			$data['title'] = ucfirst('payment modes');
				/*************get session values*********/
			$data['userid'] = $this->session->userdata('userid');
			$data['username'] = $this->session->userdata('username');
			$data['user_type'] = $this->session->userdata('user_type');
			$data['client_id'] = $this->session->userdata('client_id');
			/*************end session values*********/
			
			/******************get form data*******/
				
			/*****************end form data********/
			
			
			/****************************start view fiels*************/
			$this->load->view('templates/listing_top', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('templates/header_listing', $data);
			$this->load->view('accounts/payment_modes', $data);
			$this->load->view('templates/footer_listing', $data);
			/****************************end view fils***************/
		
	}

	public function history()
	{
		//manage_dropdowns
		if ( ! file_exists(APPPATH.'/views/accounts/history.php'))
			{
			// Whoops, we don't have a page for that!
			show_404();
			}
			$data['title'] = ucfirst('history');
				/*************get session values*********/
			$data['userid'] = $this->session->userdata('userid');
			$data['username'] = $this->session->userdata('username');
			$data['user_type'] = $this->session->userdata('user_type');
			$data['client_id'] = $this->session->userdata('client_id');
			/*************end session values*********/
			
			/******************get form data*******/
				
			/*****************end form data********/
			
			
			/****************************start view fiels*************/
			$this->load->view('templates/listing_top', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('templates/header_listing', $data);
			$this->load->view('accounts/history', $data);
			$this->load->view('templates/footer_listing', $data);
			/****************************end view fils***************/
		
	}
	public function submitPayment_modes()
	{
		return $this->accounts_model->save_payment_modes();
	}
	public function datatable_paymentmodes()
	{
		echo $this->accounts_model->datatable_paymentmodes();
	}
	function singlePayment($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->accounts_model->getSinglePayment($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	function submitTransactionCategory()
	{
		return $this->accounts_model->save_TransactionCategory();
	}
	function datatable_transaction_categories()
	{
		echo $this->accounts_model->datatable_transaction_categories();
	}
	function singleTransaction($id){
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->accounts_model->getsingleTransaction($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	function submitBankAccount()
	{
		return $this->accounts_model->save_BankAccount();
	
	}
	function datatableBankAccounts()
	{
		echo $this->accounts_model->datatableBankAccounts();
	}
	function single_bank_account($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->accounts_model->single_bank_account($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	public function getTotalBalance($selectedBankId)
	{
		//get total balance here.for now i am returning only
		
		echo 100000;
	}
	public function datatable_balancesheet()
	{
		echo $this->accounts_model->datatable_balancesheet();
	}
	
	function save_balancesheet()
	{
		return $this->accounts_model->save_balancesheet();	
	}
	function auto_names()
	{
		$term = trim($this->input->get('term', TRUE));
		$this->accounts_model->auto_names($term);
	}
}
