<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: Accounts_model model class
 */
class Accounts_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
	
	public function save_payment_modes()
	{
		
			$user_id 	=  $this->session->userdata('userid');
			$client_id =   $this->session->userdata('client_id');
				$dateadded = date('Y-m-d H:i:s');
				$dateupdated = date('Y-m-d H:i:s');
		    $data_save = array(
					   
						'client_id' => $client_id,
						'user_id' => $user_id,
						'dropdown_name' => $this->input->post('dropdown_name'),
						'option_title' => $this->input->post('option_title'),
						'screen_name' => $this->input->post('screen_name'),
						'screen' => $this->input->post('screen'),
						'dateadded' => $dateadded,
						'dateupdated' => $dateupdated
					);
				$data_update = array(
					   
						'client_id' => $client_id,
						'user_id' => $user_id,
						'dropdown_name' => $this->input->post('dropdown_name'),
						'option_title' => $this->input->post('option_title'),
						'screen_name' => $this->input->post('screen_name'),
						'screen' => $this->input->post('screen'),
						'dateadded' => $dateadded,
						'dateupdated' => $dateupdated
					);
					
					/***************************everything clear now either save or update***********************************/
		if ($this->input->post('id') ) { // this is update section
				$listing_id = 	$this->input->post('id');					
				$this->db->where('id', $listing_id);
			    $this->db->update('crm_accounting_paymentmodes',$data_update); // update the record
			    //create history now
			    $data_update['action'] = "update";
				//$this->db->insert('crm_accounting_paymentmodes_history', $data_update); // insert new record in history
				
		}else {
							
			   $this->db->insert('crm_accounting_paymentmodes', $data_save); // insert new record
			   $listing_id = $this->db->insert_id();
			   $data_save['action'] = "insert";
			  // $this->db->insert('crm_accounting_paymentmodes_history', $data_save); // insert new record in history
		}
					 
					 echo "Save sucessfully!";
		  
	}


	public function datatable_paymentmodes()
	{
		$c = 'id,dropdown_name,	option_title,dateadded,dateupdated';
		$this->datatables->select($c)
						//->unset_column('id')//this means if you want to include in columns or search
						->from('crm_accounting_paymentmodes');
			$this->datatables ->where('crm_accounting_paymentmodes.is_active', 1); 
				return $this->datatables->generate();
	}
	public function getSinglePayment($id=0)
	{
		$this->db->select('*');
		$this->db->from('crm_accounting_paymentmodes');
		$where = "id=".$id;
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
	}
	public function save_TransactionCategory()
	{
		
			$user_id 	=  $this->session->userdata('userid');
			$client_id =   $this->session->userdata('client_id');
				$dateadded = date('Y-m-d H:i:s');
				$dateupdated = date('Y-m-d H:i:s');
		    $data_save = array(
					   
						'client_id' => $client_id,
						'user_id' => $user_id,
						'category-selection' => $this->input->post('category-selection'),
						'transaction' => $this->input->post('transaction'),
						'parent_id' => ($this->input->post('parent_id') ? $this->input->post('parent_id'):0),
						'title' => $this->input->post('title'),
						'dateadded' => $dateadded,
						'dateupdated' => $dateupdated
					);
				$data_update = array(
					   
						'client_id' => $client_id,
						'user_id' => $user_id,
						'category-selection' => $this->input->post('category-selection'),
						'transaction' => $this->input->post('transaction'),
						'parent_id' => ($this->input->post('parent_id') ? $this->input->post('parent_id'):0),
						'title' => $this->input->post('title'),
						//'dateadded' => $dateadded,
						'dateupdated' => $dateupdated
					);
					
					/***************************everything clear now either save or update***********************************/
		if ($this->input->post('id') ) { // this is update section
				$listing_id = 	$this->input->post('id');					
				$this->db->where('id', $listing_id);
			    $this->db->update('crm_accounting_trancategories',$data_update); // update the record
			    //create history now
			    $data_update['action'] = "update";
				//$this->db->insert('crm_accounting_trancategories_history', $data_update); // insert new record in history
				
		}else {
							
			   $this->db->insert('crm_accounting_trancategories', $data_save); // insert new record
			   $listing_id = $this->db->insert_id();
			   $data_save['action'] = "insert";
			 //  $this->db->insert('crm_accounting_trancategories_history', $data_save); // insert new record in history
		}
					 
					 echo "Save sucessfully!";
		  
	}
	public function datatable_transaction_categories()
	{
		$c = 'crm_accounting_trancategories.id,crm_accounting_trancategories.title,crm_accounting_trancategories.transaction,crm_accounting_parentcategory.CategoryName as parent_id,dateadded,dateupdated';
		$this->datatables->select($c)
						//->unset_column('id')//this means if you want to include in columns or search
						->from('crm_accounting_trancategories');
						$this->datatables->join('crm_accounting_parentcategory', 'crm_accounting_trancategories.parent_id = crm_accounting_parentcategory.parent_id', 'left');
			$this->datatables ->where('crm_accounting_trancategories.is_active', 1); 
				return $this->datatables->generate();
	}

	public function getsingleTransaction($id=0)
	{
		$this->db->select('*');
		$this->db->from('crm_accounting_trancategories');
		$where = "id=".$id;
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
	}
	
	function save_BankAccount()
	{
			$user_id 	=  $this->session->userdata('userid');
			$client_id =   $this->session->userdata('client_id');
				$dateadded = date('Y-m-d H:i:s');
				$dateupdated = date('Y-m-d H:i:s');
		    $data_save = array(
					   
						'client_id' => $client_id,
						'user_id' => $user_id,
						'name' => $this->input->post('name'),
						'initial_amount' => $this->input->post('initial_amount'),
						'account_no' => $this->input->post('account_no'),
						'iban_no' => $this->input->post('iban_no'),
						'branch_name'=>$this->input->post('branch_name'),
						'currency_id'=>$this->input->post('currency_id'),
						'swift_code'=>$this->input->post('swift_code'),
						'isDefault'=>($this->input->post('isDefault') ? $this->input->post('isDefault'):0),
						'dateadded' => $dateadded,
						'dateupdated' => $dateupdated
					);
				$data_update = array(
					   
						'client_id' => $client_id,
						'user_id' => $user_id,
						'name' => $this->input->post('name'),
						'initial_amount' => $this->input->post('initial_amount'),
						'account_no' => $this->input->post('account_no'),
						'iban_no' => $this->input->post('iban_no'),
						'branch_name'=>$this->input->post('branch_name'),
						'currency_id'=>$this->input->post('currency_id'),
						'swift_code'=>$this->input->post('swift_code'),
						'isDefault'=>($this->input->post('isDefault') ? $this->input->post('isDefault'):0),
						//'dateadded' => $dateadded,
						'dateupdated' => $dateupdated
					);
					
					/***************************everything clear now either save or update***********************************/
		if ($this->input->post('id') ) { // this is update section
				$listing_id = 	$this->input->post('id');					
				$this->db->where('id', $listing_id);
			    $this->db->update('crm_accounting_bankaccounts',$data_update); // update the record
			    //create history now
			    $data_update['action'] = "update";
				//$this->db->insert('crm_accounting_bankaccounts_history', $data_update); // insert new record in history
				
		}else {
							
			   $this->db->insert('crm_accounting_bankaccounts', $data_save); // insert new record
			   $listing_id = $this->db->insert_id();
			   $data_save['action'] = "insert";
			   //$this->db->insert('crm_accounting_bankaccounts_history', $data_save); // insert new record in history
		}
					 
					 echo "Save sucessfully!";
	}

	public function datatableBankAccounts()
	{
		$c = 'id,name,account_no,branch_name,swift_code,iban_no,initial_amount,currency_id,dateadded,dateupdated,isDefault';
		$this->datatables->select($c)
						//->unset_column('id')//this means if you want to include in columns or search
						->from('crm_accounting_bankaccounts');
			$this->datatables ->where('crm_accounting_bankaccounts.is_active', 1); 
				return $this->datatables->generate();
	}
	
	function single_bank_account($id=0)
	{
		$this->db->select('*');
		$this->db->from('crm_accounting_bankaccounts');
		$where = "id=".$id;
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
	}
	function datatable_balancesheet()
	{
		 
		$c = 'b.id,b.ref,b.transaction,b.status,b.type,b.sub_type,b.internal_ref,b.payment_mode,b.amount,CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id,b.deal_ref,b.created_by_name,b.receipt_no,b.dateadded,b.dateupdated';
		$this->datatables->select($c)
						//->unset_column('id')//this means if you want to include in columns or search
						->from('crm_accounting_balancesheet as b');
			$this->datatables->join('crm_users', 'crm_users.id = b.agent_id', 'left');
			$this->datatables ->where('b.is_active', 1); 
				return $this->datatables->generate();	
	}
	
	function save_balancesheet()
	{
			$user_id 	=  $this->session->userdata('userid');
			$client_id =   $this->session->userdata('client_id');
			$dateadded = date('Y-m-d H:i:s');
			$dateupdated = date('Y-m-d H:i:s');
				//check either it is new entry or updation
		if (($this->input->post('id')) && ($this->input->post('ref'))) {//this is update
		$id = $this->input->post('id');
		$ref = $this->input->post('ref');
		
		}else{
			$id = 0;
			$ret = $this->db->query("select IFNULL(max(id),0) as id from crm_accounting_balancesheet")->row()->id;
			$ret = str_pad($ret, 4, '0', STR_PAD_LEFT);
			$ret = $ret + 0001;
			$ref = "GIS-BS-".$ret;
			}
		    $data_save = array(
					   
						'client_id' => $client_id,
						'user_id' => $user_id,
						'ref' => $ref,
						'bank_id' => $this->input->post('bank_id'),
						'deal_id' => ($this->input->post('deal_id') ? $this->input->post('deal_id'):0),
						'transaction' => $this->input->post('transaction'),
						'status'=>($this->input->post('status') ? $this->input->post('status'):0),
						'payment_mode'=>($this->input->post('payment_mode') ? $this->input->post('payment_mode'):0),
						'type'=>($this->input->post('type') ? $this->input->post('type'):0),
						'sub_type'=>($this->input->post('sub_type') ? $this->input->post('sub_type'):0),
						'internal_ref'=>$this->input->post('internal_ref'),
						'agent_id'=>($this->input->post('agent_id') ? $this->input->post('agent_id'):0),
						'auto_name_field'=>$this->input->post('auto_name_field'),
						'receipt_no'=>$this->input->post('receipt_no'),
						'deal_ref'=>$this->input->post('deal_ref'),
						'created_by_name'=>$this->input->post('created_by_name'),
						'amount'=>($this->input->post('amount') ? $this->input->post('amount'):0),
						'notes'=>$this->input->post('notes'),
						'dateadded' => $dateadded,
						'dateupdated' => $dateupdated
					);
				$data_update = array(
					   
						'client_id' => $client_id,
						'user_id' => $user_id,
						'ref' => $ref,
						'bank_id' => $this->input->post('bank_id'),
						'deal_id' => ($this->input->post('deal_id') ? $this->input->post('deal_id'):0),
						'transaction' => $this->input->post('transaction'),
						'status'=>($this->input->post('status') ? $this->input->post('status'):0),
						'payment_mode'=>($this->input->post('payment_mode') ? $this->input->post('payment_mode'):0),
						'type'=>($this->input->post('type') ? $this->input->post('type'):0),
						'sub_type'=>($this->input->post('sub_type') ? $this->input->post('sub_type'):0),
						'internal_ref'=>$this->input->post('internal_ref'),
						'agent_id'=>($this->input->post('agent_id') ? $this->input->post('agent_id'):0),
						'auto_name_field'=>$this->input->post('auto_name_field'),
						'receipt_no'=>$this->input->post('receipt_no'),
						'deal_ref'=>$this->input->post('deal_ref'),
						'created_by_name'=>$this->input->post('created_by_name'),
						'amount'=>($this->input->post('amount') ? $this->input->post('amount'):0),
						'notes'=>$this->input->post('notes'),
						//'dateadded' => $dateadded,
						'dateupdated' => $dateupdated
					);
					
					/***************************everything clear now either save or update***********************************/
		if ($this->input->post('id') ) { // this is update section
				$listing_id = 	$this->input->post('id');					
				$this->db->where('id', $listing_id);
			    $this->db->update('crm_accounting_balancesheet',$data_update); // update the record
			    //create history now
			    $data_update['action'] = "update";
				//$this->db->insert('crm_accounting_balancesheet_history', $data_update); // insert new record in history
				
		}else {
							
			   $this->db->insert('crm_accounting_balancesheet', $data_save); // insert new record
			   $listing_id = $this->db->insert_id();
			   $data_save['action'] = "insert";
			  // $this->db->insert('crm_accounting_balancesheet_history', $data_save); // insert new record in history
		}
					 
					 echo "Save sucessfully!";
	}


	public function auto_names($term)
    {
		$req  = "SELECT  id,first_name from crm_users WHERE first_name LIKE '%".$term."%' ";
	    $query = $this->db->query($req);
		//$row = $query->row();
		if((!$query->result())){
			echo 0;
		}else{
			foreach ($query->result() as $row)
			{
			$results[] = array(
                        'id' => $row->id,
                        'value' => $row->first_name
						
						
                    );
       
		
			}
			 echo json_encode($results);
		}
			
    }	

}