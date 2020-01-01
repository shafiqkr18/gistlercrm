<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: users_model model class
 */
class Users_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();	
    }
	
	public function datatable()
	{
		$c = 'id,client_id,first_name,last_name,job_title,office_no,mobile_no_new_ccode,mobile_no_new,email';
		$this->datatables->select($c)
						//->unset_column('id')//this means if you want to include in columns or search
						->from('crm_users');
						$this->datatables ->where('is_active', 1); 
						$this->datatables ->where('status', 1); 
						return $this->datatables->generate();
	}
	public function datatable_groups()
	{
		$c = 'id,name,description,created_date';
		$this->datatables->select($c)
						//->unset_column('id')//this means if you want to include in columns or search
						->from('crm_groups');
						$this->datatables ->where('is_active', 1); 
						
						return $this->datatables->generate();
	}
	public function getGroupUsers($id=0)
	{
		$this->db->select("*");
		$this->db->from("crm_groups");
		if($id>0){
		$where = "id='$id'";
		$this->db->where($where);
		}
		$this->db->order_by("name", "asc");
		//echo $this->db->get_compiled_select();exit;
			$query = $this->db->get()->result_array();
			//return $query->result_array();
	 foreach($query as $i=>$product) {
		 $this->db->select(' id,first_name,last_name');
		  $this->db->where_in('id', $product['user_ids']);
		 
		  $query = $this->db->get('crm_users')->result_array();
		
		
		}
		
		return $query;
	}
	public function submit()
	{
		$created_by =  $this->session->userdata('userid');
		$dateadded = date('Y-m-d H:i:s');
		$dateupdated = date('Y-m-d H:i:s');
		
			//save user details
			$client_id = $this->input->post('client_id');
			if($client_id<1) $client_id =  $this->session->userdata('client_id');
			
			
			$data_save = array(
					'rand_key'=> $this->input->post('rand_key'),
					'client_id'=> $client_id,
					'first_name'=> $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'mobile_no_new_ccode'=> $this->input->post('mobile_no_new_ccode'),	
					'mobile_no_new' => $this->input->post('mobile_no_new'),
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'act_pw' => $this->input->post('act_pw'),
					'created_by' => $created_by,
					'created_date' => $dateadded,
					'email' => $this->input->post('email'),
					'job_title'=> $this->input->post('job_title'),
					'office_no'  => $this->input->post('office_no'),
					'rera'=> $this->input->post('rera'),	
					'status' => $this->input->post('status'),//either it is published or not
					'disable_publish' => $this->input->post('disable_publish'),
					'disable_excel' => $this->input->post('disable_excel'),
					'disable_sharing' => $this->input->post('disable_sharing'),
					'is_sms' => $this->input->post('is_sms'),
					'landlord_details' => $this->input->post('landlord_details'),
					'delete_permissions' => $this->input->post('delete_permissions'),
					'edit_listings' => $this->input->post('edit_listings'),
					'access' => $this->input->post('access'),
					'profile' => $this->input->post('profile'),
					// 'photo_agent' => $this->input->post('photo_agent'),
					// 'photo_agent2' => $this->input->post('photo_agent2'),
					'blocked' => $this->input->post('select1values'),
					// 'readonly' => $this->input->post('select2values'),
					// 'editable' => $this->input->post('select3values'),

					// 'co_not_user_id' => $this->input->post('select1uservalues'),

					// 'select2uservalues' => $this->input->post('select2uservalues'),
					'access_timings_details' => $this->input->post('access_timings_details'),
					'access_days' => $this->input->post('access_days'),
					'access_timings' => $this->input->post('access_timings'),
					'imap' => $this->input->post('imap'),
					'emailsLeads' => $this->input->post('emailsLeads'),
					'passwordemail' => $this->input->post('passwordemail'),
					'connect_status' => $this->input->post('connect_status'),
					'email_user_id' => $this->input->post('email_user_id'),
					'email_client_id' => $this->input->post('email_client_id'),
					'port' => $this->input->post('port'),
					'target' => $this->input->post('target')
					
					);
					
					$data_update = array(
						'id'=> $this->input->post('id'),
					'rand_key'=> $this->input->post('rand_key'),
					'client_id'=> $client_id,
					'first_name'=> $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'mobile_no_new_ccode'=> $this->input->post('mobile_no_new_ccode'),	
					'mobile_no_new' => $this->input->post('mobile_no_new'),
					'username' => $this->input->post('username'),
					//'password' => md5($this->input->post('password')),// we do not update password
					'act_pw' => $this->input->post('act_pw'),
					'created_by' => $created_by,
					'created_date' => $dateadded,
					'email' => $this->input->post('email'),
					'job_title'=> $this->input->post('job_title'),
					'office_no'  => $this->input->post('office_no'),
					'rera'=> $this->input->post('rera'),	
					'status' => $this->input->post('status'),//either it is published or not
					'disable_publish' => $this->input->post('disable_publish'),
					'disable_excel' => $this->input->post('disable_excel'),
					'disable_sharing' => $this->input->post('disable_sharing'),
					'is_sms' => $this->input->post('is_sms'),
					'landlord_details' => $this->input->post('landlord_details'),
					'delete_permissions' => $this->input->post('delete_permissions'),
					'edit_listings' => $this->input->post('edit_listings'),
					'access' => $this->input->post('access'),
					'profile' => $this->input->post('profile'),
					// 'photo_agent' => $this->input->post('photo_agent'),
					// 'photo_agent2' => $this->input->post('photo_agent2'),
					'blocked' => $this->input->post('select1values'),
					// 'readonly' => $this->input->post('select2values'),
					// 'editable' => $this->input->post('select3values'),
					// 'co_not_user_id' => $this->input->post('select1uservalues'),
					// 'co_user_id' => $this->input->post('select2uservalues'),
					'access_timings_details' => $this->input->post('access_timings_details'),
					'access_days' => $this->input->post('access_days'),
					'access_timings' => $this->input->post('access_timings'),
					'imap' => $this->input->post('imap'),
					'emailsLeads' => $this->input->post('emailsLeads'),
					'passwordemail' => $this->input->post('passwordemail'),
					'connect_status' => $this->input->post('connect_status'),
					'email_user_id' => $this->input->post('email_user_id'),
					'email_client_id' => $this->input->post('email_client_id'),
					'port' => $this->input->post('port'),
					'target' => $this->input->post('target')
					
					
					);
	
		if ($this->input->post('id'))  { // this is update section
				$listing_id = 	$this->input->post('id');					
				$this->db->where('id', $listing_id);
			    $this->db->update('crm_users',$data_update); // update the record

			    $output = "Update Successful.";
		}else {
							
			   $this->db->insert('crm_users', $data_save); // insert new record
			   $listing_id = $this->db->insert_id();

			   $output = $listing_id;
		}

		echo $output;//"Success!";//$listing_id;
	}
	public function submit_groups()
	{
		$created_by =  $this->session->userdata('userid');
		$dateadded = date('Y-m-d H:i:s');
		$dateupdated = date('Y-m-d H:i:s');
		
			//save me
			$client_id = $this->input->post('client_id');
			if($client_id<1)
			{
				$client_id =  $this->session->userdata('client_id');
			}
			
			$data_save = array(
					'client_id'=> $client_id,
					'name'=> $this->input->post('name'),
					'description'  => $this->input->post('description'),
					'created_date'=> $dateadded,		
					'created_by' => $created_by,
					'emirates_allowed' => $this->input->post('emirates_allowed'),
					'locations_allowed' => $this->input->post('locations_allowed'),
					'user_ids' => $this->input->post('user_ids'),
					'listings_allowed' => $this->input->post('listings_allowed'),
					'listings_sharing' => $this->input->post('listings_sharing')
					
					);
			$data_update = array(
					'client_id'=> $client_id,
					'name'=> $this->input->post('name'),
					'description'  => $this->input->post('description'),
					'dateupdated'=> $dateupdated,		
					'created_by' => $created_by,
					'emirates_allowed' => $this->input->post('emirates_allowed'),
					'locations_allowed' => $this->input->post('locations_allowed'),
					'user_ids' => $this->input->post('user_ids'),
					'listings_allowed' => $this->input->post('listings_allowed'),
					'listings_sharing' => $this->input->post('listings_sharing')
					
					);
					
		if ($this->input->post('id'))  { // this is update section
				$listing_id = 	$this->input->post('id');					
				$this->db->where('id', $listing_id);
			    $this->db->update('crm_groups',$data_update); // update the record
				
		}else {
							
			   $this->db->insert('crm_groups', $data_save); // insert new record
			   $listing_id = $this->db->insert_id();
		}
		return $listing_id;
					
	}
	
	public function single($id)
	{
		$this->db->select('crm_users.*
			, concat(crm_profile.trade_id, "/", crm_profile.rand_key, "/", crm_profile.profile_logo) as logo_path');
		$this->db->from('crm_users');
		$this->db->join('crm_profile', 'crm_users.client_id = crm_profile.id', 'left');
		$this->db->where("crm_users.id", $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function single_group($id)
	{
		$this->db->select('*');
		$this->db->from('crm_groups');
		$where = "id=".$id;
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_screens()
	{
		
		$this->db->select("id,screen_name");
		$this->db->from("crm_screens");
		$where = "is_active=1 ";
		$this->db->where($where);
		$this->db->order_by("screen_name", "asc");
		$q1 = $this->db->get();
		if ($q1->num_rows() > 0) {
		 foreach (($q1->result()) as $row1) {
		$prdtarray[] = $row1->screen_name;
		}
		 return implode(',',$prdtarray); 
		}
		return 0;
					
	}
	
	public function lookup_duplicate_users($username,$id)
	{
		 $this -> db -> select('id');
	   $this -> db -> from('crm_users');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('is_active', 1);//either it is delete?
	   $query = $this -> db -> get();
	
	   if($query -> num_rows()> 0)
	   {
		 return $query->row()->id;
	   }
	   else
	   {
		 return 0;
	   }
	}
	
	public function CheckPassword($newpass,$id)
	{
		//need logic here
	}

	function GetCompanies(){
		$this->db->select('crm_profile.id, crm_profile.name
			, concat(crm_profile.trade_id, "/", crm_profile.rand_key, "/", crm_profile.profile_logo) as logo_path');
		$this->db->from('crm_profile');
		$query = $this->db->get();
		return $query->result_array();		
	}
	
}