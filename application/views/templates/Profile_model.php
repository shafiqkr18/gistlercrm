<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Shafiq

 * Description: Profile_model model class

 */

class Profile_model extends CI_Model{

	  

     

    function __construct(){

        parent::__construct();

		$this->load->database();

	  

    	

    }

	

	/**********************save data section**************/   

	public function saveprofile($profile_logo,$profile_watermark)

	{

		

		$created_by =  $this->session->userdata('userid');

		$dateadded = date('Y-m-d H:i:s');

		$dateupdated = date('Y-m-d H:i:s');

		

		

		//check either it is new entry or updation

		if($this->input->post('id')) {//this is update

			$id = $this->input->post('id');

		}else{

			$id = 0;

			

		}

		

		$data_save = array(

					'name'=> $this->input->post('name'),

					'rand_key'=> $this->input->post('rand_key'),

					'trade_id'=> $this->input->post('trade_id'),

					'address'=> $this->input->post('address'),

					'phone_no'=> $this->input->post('phone_no'),

					'fax_no'=> $this->input->post('fax_no'),

					'email'=> $this->input->post('email'),

					'web'=> $this->input->post('web'),

					'description'=> $this->input->post('description'),

					'showAgentName'=> $this->input->post('showAgentName'),

					'showAgentNum'=> $this->input->post('showAgentNum'),

					'xml_custom_email'=> $this->input->post('xml_custom_email'),

					'xml_email'=> $this->input->post('xml_email'),

					'watermark'=> $this->input->post('watermark'),

					'measuring_unit'=> $this->input->post('measuring_unit'),

					'sharing'=> $this->input->post('sharing'),

					'leads_sharing'=> $this->input->post('leads_sharing'),

					'auto_lead_option'=> $this->input->post('auto_lead_option'),

					'sms_agents'=> $this->input->post('sms_agents'),

					'lead_escalation'=> $this->input->post('lead_escalation'),

					'imap'=> $this->input->post('imap'),

					'emailsLeads'=> $this->input->post('emailsLeads'),

					'passwordemail'=> $this->input->post('passwordemail'),

					'port'=> $this->input->post('port'),

					'Active'=> $this->input->post('Active'),

					'brochure_type'=> $this->input->post('brochure_type'),

					'email_temp_id'=> $this->input->post('email_temp_id'),

					'poster_id'=> $this->input->post('poster_id'),

					'apiKey-hid'=> $this->input->post('apiKey-hid'),

					'apiKey'=> $this->input->post('apiKey'),

					'profile_logo'=> $profile_logo,

					'profile_watermark'=> $profile_watermark,

					'created_by'=> $created_by,

					'dateadded'=> $dateadded,

					'dateupdated'=> $dateupdated,
					'is_active' => $this->input->post('is_active')

					);

					

					$data_update = array(

					'name'=> $this->input->post('name'),

					'rand_key'=> $this->input->post('rand_key'),

					'trade_id'=> $this->input->post('trade_id'),

					'address'=> $this->input->post('address'),

					'phone_no'=> $this->input->post('phone_no'),

					'fax_no'=> $this->input->post('fax_no'),

					'email'=> $this->input->post('email'),

					'web'=> $this->input->post('web'),

					'description'=> $this->input->post('description'),

					'showAgentName'=> $this->input->post('showAgentName'),

					'showAgentNum'=> $this->input->post('showAgentNum'),

					'xml_custom_email'=> $this->input->post('xml_custom_email'),

					'xml_email'=> $this->input->post('xml_email'),

					'watermark'=> $this->input->post('watermark'),

					'measuring_unit'=> $this->input->post('measuring_unit'),

					'sharing'=> $this->input->post('sharing'),

					'leads_sharing'=> $this->input->post('leads_sharing'),

					'auto_lead_option'=> $this->input->post('auto_lead_option'),

					'sms_agents'=> $this->input->post('sms_agents'),

					'lead_escalation'=> $this->input->post('lead_escalation'),

					'imap'=> $this->input->post('imap'),

					'emailsLeads'=> $this->input->post('emailsLeads'),

					'passwordemail'=> $this->input->post('passwordemail'),

					'port'=> $this->input->post('port'),

					'Active'=> $this->input->post('Active'),

					'brochure_type'=> $this->input->post('brochure_type'),

					'email_temp_id'=> $this->input->post('email_temp_id'),

					'poster_id'=> $this->input->post('poster_id'),

					'apiKey-hid'=> $this->input->post('apiKey-hid'),

					'apiKey'=> $this->input->post('apiKey'),

					'profile_logo'=> $profile_logo,

					'profile_watermark'=> $profile_watermark,

					'created_by'=> $created_by,

					//'dateadded'=> $dateadded,

					'dateupdated'=> $dateupdated,
					'is_active' => $this->input->post('is_active')

					);

					

						/***************************everything clear now either save or update***********************************/

		if ($this->input->post('id')) { // this is update section

				$listing_id = 	$this->input->post('id');					

				$this->db->where('id', $listing_id);

			    $this->db->update('crm_profile',$data_update); // update the record

				

		}else {

							

			   $this->db->insert('crm_profile', $data_save); // insert new record

			   $listing_id = $this->db->insert_id();

		}

		echo "last-query:" . $this->db->last_query();exit;

		return $listing_id;

	}

	public function datatable()

	{

		$c = 'id,name,trade_id,phone_no,fax_no,email,web,dateadded,dateupdated';

		$this->datatables->select($c)

						->unset_column('id')//this means if you want to include in columns or search

						->from('crm_profile');

						$this->datatables ->where('is_active', 1); 

						return $this->datatables->generate();

	}

	public function getSingleRow($id,$type)

	{

		$this->db->select('*');

		$this->db->from('crm_profile');

		$where = "id=".$id;

		$this->db->where($where);

		$query = $this->db->get();

		 if( $query->num_rows() == 1 ){

			  // One row, match!

			  

				  $row =  $query->row(); 

				  return $row;

				// return array(

//					'id'=> ''.$row->id.'',

//					'name'=> ''.$row->name.'',

//					'rand_key'=> ''.$row->rand_key.'',

//					'trade_id'=> ''.$row->trade_id.'',

//					'address'=> ''.$row->address.''

//					);

		 }

	}

	

}