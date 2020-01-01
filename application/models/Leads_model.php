<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Shafiq

 * Description: leads model class

 */

class Leads_model extends CI_Model{

	  

     

    function __construct(){

        parent::__construct();

		$this->load->database();

	  

    	

    }

	

	

	

	public function save_leads()

	{

		//check either it is new entry or updation

		if (($this->input->post('id')) && ($this->input->post('ref'))) {//this is update

		$id = $this->input->post('id');

		$ref = $this->input->post('ref');

		

		}else{

			$id = 0;

		//get ref no first

		$ret = $this->db->query("select IFNULL(max(id),0) as id from crm_leads")->row()->id;

			$ret = str_pad($ret, 4, '0', STR_PAD_LEFT);

			$ret = $ret + 0001;

			$ref = "GIS-L-".$ret;

		}

		//end

		$created_by =  $this->session->userdata('userid');

		$dateadded	=	date('Y-m-d');

	    $dateupdated    =	date('Y-m-d');

		

		

		/***************collect fields********/

		//rand key..some time we save owner from other pages popups so rand key for owner is empty so lets fill it here

		//14503468808582988

		$rand_key = $this->input->post('rand_key');

		if($rand_key =='' || $rand_key<1 || $rand_key == 0) $rand_key = time().mt_rand(1000000,9000000);

		
		$hot_lead = $this->input->post('hot_lead');
		
		if((int) $hot_lead == 1){
			$hot_lead = 1;
		}else{
			$hot_lead = 0;
		}
		

		$data_save = array(

					    'rand_key' =>$rand_key,

						'client_id' => $this->input->post('client_id'),

						'ref' => $ref,

						'landlord_id' => ($this->input->post('landlord_id') ? $this->input->post('landlord_id'):0),

						'landlord_name' => $this->input->post('landlord_name'),

						'landlord_mobile' => $this->input->post('landlord_mobile'),

						'landlord_email' => $this->input->post('landlord_email'),

						'assigned_by_name' => $this->input->post('assigned_by_name'),

						'agent_id' => $this->input->post('agent_id'),

						'date_of_enquiry' => ($this->input->post('date_of_enquiry') ? $this->input->post('date_of_enquiry'):$dateadded),

						'type' => $this->input->post('type'),

						'status' =>$this->input->post('status'),

						'sub_status' => $this->input->post('sub_status'),

					    'source_of_lead' => $this->input->post('source_of_lead'),

						'home_no'=> $this->input->post('home_no'),

						'notes'=> $this->input->post('notes'),

						'first_name' => $this->input->post('first_name'),

						'last_name' => $this->input->post('last_name'),

					    'listing_id_1' => $this->input->post('listing_id_1'),

						'listing_id_1_ref'=> $this->input->post('listing_id_1_ref'),

						'listing_id_2'=> $this->input->post('listing_id_2'),

						'listing_id_2_ref'=> $this->input->post('listing_id_2_ref'),

						'listing_id_3'=> $this->input->post('listing_id_3'),

						'listing_id_3_ref'=> $this->input->post('listing_id_3_ref'),

						'listing_id_4'=> $this->input->post('listing_id_4'),

						'listing_id_4_ref'=> $this->input->post('listing_id_4_ref'),

						'agent_id_2'=> ($this->input->post('agent_id_2') ? $this->input->post('agent_id_2'):0),

						'agent_id_3'=> ($this->input->post('agent_id_3') ? $this->input->post('agent_id_3'):0),

						'agent_id_4'=> ($this->input->post('agent_id_4') ? $this->input->post('agent_id_4'):0),

						'agent_id_5'=> ($this->input->post('agent_id_5') ? $this->input->post('agent_id_5'):0),

						'property_req_1'=> $this->input->post('property_req_1'),

						'property_req_2'=> $this->input->post('property_req_2'),

						'property_req_3'=> $this->input->post('property_req_3'),

						'property_req_4'=> $this->input->post('property_req_4'),

						'property_req_1_data'=> $this->input->post('property_req_1_data'),

						'property_req_2_data'=> $this->input->post('property_req_2_data'),

						'property_req_3_data'=> $this->input->post('property_req_3_data'),

						'property_req_4_data'=> $this->input->post('property_req_4_data'),

						'created_by'=> $created_by,

						'dateadded'=> $dateadded,

						'dateupdated'=> $dateupdated,

						'financial_situation'=> $this->input->post('financial_situation'),

						'subsource_of_lead'=>  ($this->input->post('subsource_of_lead') ? $this->input->post('subsource_of_lead'):0),

						'lead_priority'=> $this->input->post('lead_priority'),

						'hot_lead'=> $hot_lead,

						'lead_by_agent'=> $this->input->post('lead_by_agent'),

						'shared'=> $this->input->post('shared'),

						'leads_reminder_one'=> ($this->input->post('leads_reminder_one') ? $this->input->post('leads_reminder_one'):0),

						'leads_reminder_two'=> ($this->input->post('leads_reminder_two') ? $this->input->post('leads_reminder_two'):0)

					);

		$data_update = array(

						'id' =>$id,

					    'rand_key' =>$rand_key,

						'client_id' => $this->input->post('client_id'),

						'ref' => $ref,

						'landlord_id' => ($this->input->post('landlord_id') ? $this->input->post('landlord_id'):0),


						'landlord_name' => $this->input->post('landlord_name'),

						'landlord_mobile' => $this->input->post('landlord_mobile'),

						'landlord_email' => $this->input->post('landlord_email'),

						'assigned_by_name' => $this->input->post('assigned_by_name'),

						'agent_id' => $this->input->post('agent_id'),

						'date_of_enquiry' => ($this->input->post('date_of_enquiry') ? $this->input->post('date_of_enquiry'):$dateadded),

						'type' => $this->input->post('type'),

						'status' =>$this->input->post('status'),

						'sub_status' => $this->input->post('sub_status'),

					    'source_of_lead' => $this->input->post('source_of_lead'),

						'home_no'=> $this->input->post('home_no'),

						'notes'=> $this->input->post('notes'),

						'first_name' => $this->input->post('first_name'),

						'last_name' => $this->input->post('last_name'),

					    'listing_id_1' => $this->input->post('listing_id_1'),

						'listing_id_1_ref'=> $this->input->post('listing_id_1_ref'),

						'listing_id_2'=> $this->input->post('listing_id_2'),

						'listing_id_2_ref'=> $this->input->post('listing_id_2_ref'),

						'listing_id_3'=> $this->input->post('listing_id_3'),

						'listing_id_3_ref'=> $this->input->post('listing_id_3_ref'),

						'listing_id_4'=> $this->input->post('listing_id_4'),

						'listing_id_4_ref'=> $this->input->post('listing_id_4_ref'),

						'agent_id_2'=> ($this->input->post('agent_id_2') ? $this->input->post('agent_id_2'):0),

						'agent_id_3'=> ($this->input->post('agent_id_3') ? $this->input->post('agent_id_3'):0),

						'agent_id_4'=> ($this->input->post('agent_id_4') ? $this->input->post('agent_id_4'):0),

						'agent_id_5'=> ($this->input->post('agent_id_5') ? $this->input->post('agent_id_5'):0),

						'property_req_1'=> $this->input->post('property_req_1'),

						'property_req_2'=> $this->input->post('property_req_2'),

						'property_req_3'=> $this->input->post('property_req_3'),

						'property_req_4'=> $this->input->post('property_req_4'),

						'property_req_1_data'=> $this->input->post('property_req_1_data'),

						'property_req_2_data'=> $this->input->post('property_req_2_data'),

						'property_req_3_data'=> $this->input->post('property_req_3_data'),

						'property_req_4_data'=> $this->input->post('property_req_4_data'),

						'created_by'=> $created_by,

						//'dateadded'=> $dateadded,

						'dateupdated'=> $dateupdated,

						'financial_situation'=> $this->input->post('financial_situation'),

						'subsource_of_lead'=>  ($this->input->post('subsource_of_lead') ? $this->input->post('subsource_of_lead'):0),

						'lead_priority'=> $this->input->post('lead_priority'),

						'hot_lead'=> $hot_lead,

						'lead_by_agent'=> $this->input->post('lead_by_agent'),

						'shared'=> $this->input->post('shared'),

						'leads_reminder_one'=> ($this->input->post('leads_reminder_one') ? $this->input->post('leads_reminder_one'):0),

						'leads_reminder_two'=> ($this->input->post('leads_reminder_two') ? $this->input->post('leads_reminder_two'):0)

					);

			 

			 

			 	if (($this->input->post('id')) && ($this->input->post('ref'))) {

					$lead_id = 	$this->input->post('id');					

				  $this->db->where('id', $lead_id);

				 

			 $this->db->update('crm_leads',$data_update); // update the record

				

				}else {

						//print_r($data_save);exit;	

			  $this->db->insert('crm_leads', $data_save); // insert new record

			 $lead_id = $this->db->insert_id();

			}

			//save details

			if($lead_id>0)

			{

				if($this->input->post('property_req_1'))

				{

					$v = $this->input->post('property_req_1');

					$array = json_decode($v, true);

					$details_update = array(

						'lead_req_id' =>($array['lead_req_id']?$array['lead_req_id']:0),

					    'lead_id' =>$lead_id,

						'category_id' => ($array['category_id']?$array['category_id']:0),

						'region_id' => ($array['region_id']?$array['region_id']:0),

						'area_location_id' => ($array['area_location_id']?$array['area_location_id']:0),

						'sub_area_location_id' =>($array['sub_area_location_id']?$array['sub_area_location_id']:0),

						'min_beds' =>($array['min_beds']?$array['min_beds']:0),

					    'max_beds' =>($array['max_beds']?$array['max_beds']:0),

						'min_budget' => ($array['min_budget']?$array['min_budget']:0),

						'max_budget' =>($array['max_budget']?$array['max_budget']:0),

					    'min_area' =>($array['min_area']?$array['min_area']:0),

						'max_area' => ($array['max_area']?$array['max_area']:0),

						'unit_type' =>($array['unit_type']?$array['unit_type']:0),

						'unit_no' => ($array['unit_no']?$array['unit_no']:0),

						'type'=>($this->input->post('type')?$this->input->post('type'):0)

						);

						

						$this->db->insert('crm_leads_details', $details_update); // insert new record

						//note: if you need to update instead of adding new then keep a check

				}

				if($this->input->post('property_req_2'))

				{

					$v = $this->input->post('property_req_2');

					$array = json_decode($v, true);

					$details_update = array(

						'lead_req_id' =>($array['lead_req_id']?$array['lead_req_id']:0),

					    'lead_id' =>$lead_id,

						'category_id' => ($array['category_id']?$array['category_id']:0),

						'region_id' => ($array['region_id']?$array['region_id']:0),

						'area_location_id' => ($array['area_location_id']?$array['area_location_id']:0),

						'sub_area_location_id' =>($array['sub_area_location_id']?$array['sub_area_location_id']:0),

						'min_beds' =>($array['min_beds']?$array['min_beds']:0),

					    'max_beds' =>($array['max_beds']?$array['max_beds']:0),

						'min_budget' => ($array['min_budget']?$array['min_budget']:0),

						'max_budget' =>($array['max_budget']?$array['max_budget']:0),

					    'min_area' =>($array['min_area']?$array['min_area']:0),

						'max_area' => ($array['max_area']?$array['max_area']:0),

						'unit_type' =>($array['unit_type']?$array['unit_type']:0),

						'unit_no' => ($array['unit_no']?$array['unit_no']:0),

						'type'=>($this->input->post('type')?$this->input->post('type'):0)

						);

						

						$this->db->insert('crm_leads_details', $details_update); // insert new record

						//note: if you need to update instead of adding new then keep a check

				}

				if($this->input->post('property_req_3'))

				{

					$v = $this->input->post('property_req_3');

					$array = json_decode($v, true);

					$details_update = array(

						'lead_req_id' =>($array['lead_req_id']?$array['lead_req_id']:0),

					    'lead_id' =>$lead_id,

						'category_id' => ($array['category_id']?$array['category_id']:0),

						'region_id' => ($array['region_id']?$array['region_id']:0),

						'area_location_id' => ($array['area_location_id']?$array['area_location_id']:0),

						'sub_area_location_id' =>($array['sub_area_location_id']?$array['sub_area_location_id']:0),

						'min_beds' =>($array['min_beds']?$array['min_beds']:0),

					    'max_beds' =>($array['max_beds']?$array['max_beds']:0),

						'min_budget' => ($array['min_budget']?$array['min_budget']:0),

						'max_budget' =>($array['max_budget']?$array['max_budget']:0),

					    'min_area' =>($array['min_area']?$array['min_area']:0),

						'max_area' => ($array['max_area']?$array['max_area']:0),

						'unit_type' =>($array['unit_type']?$array['unit_type']:0),

						'unit_no' => ($array['unit_no']?$array['unit_no']:0),

						'type'=>($this->input->post('type')?$this->input->post('type'):0)

						);

						

						$this->db->insert('crm_leads_details', $details_update); // insert new record

						//note: if you need to update instead of adding new then keep a check

				}

				if($this->input->post('property_req_4'))

				{

					$v = $this->input->post('property_req_4');

					$array = json_decode($v, true);

					$details_update = array(

						'lead_req_id' =>($array['lead_req_id']?$array['lead_req_id']:0),

					    'lead_id' =>$lead_id,

						'category_id' => ($array['category_id']?$array['category_id']:0),

						'region_id' => ($array['region_id']?$array['region_id']:0),

						'area_location_id' => ($array['area_location_id']?$array['area_location_id']:0),

						'sub_area_location_id' =>($array['sub_area_location_id']?$array['sub_area_location_id']:0),

						'min_beds' =>($array['min_beds']?$array['min_beds']:0),

					    'max_beds' =>($array['max_beds']?$array['max_beds']:0),

						'min_budget' => ($array['min_budget']?$array['min_budget']:0),

						'max_budget' =>($array['max_budget']?$array['max_budget']:0),

					    'min_area' =>($array['min_area']?$array['min_area']:0),

						'max_area' => ($array['max_area']?$array['max_area']:0),

						'unit_type' =>($array['unit_type']?$array['unit_type']:0),

						'unit_no' => ($array['unit_no']?$array['unit_no']:0),

						'type'=>($this->input->post('type')?$this->input->post('type'):0)

						);

						

						$this->db->insert('crm_leads_details', $details_update); // insert new record

						//note: if you need to update instead of adding new then keep a check

				}

				

			}

		return $lead_id;

		

	}

	

	public function datatable()

	{

				
// to avoid "The SELECT would examine more than MAX_JOIN_SIZE rows;"
		$query_For_Max = $this->db->query("SET SQL_BIG_SELECTS=1");

		
				$c ='crm_leads.id as id,crm_leads.auto as auto,crm_leads.ref as ref,crm_leads.type as type,crm_leads.status as status,
				crm_leads.sub_status as sub_status,
				crm_leads.lead_priority as lead_priority,crm_leads.hot_lead as hot_lead,crm_leads.landlord_name as landlord_name,crm_leads.last_name as last_name,

				crm_leads.landlord_mobile as landlord_mobile,crm_category.category as category_id,crm_city.name as region_id,
				crm_location.loc_name as area_location_id,crm_subloc.sub_sub_loc as sub_area_location_id,
				crm_leads_details.unit_type as unit_type,crm_leads_details.unit_no as unit_no,crm_leads_details.min_beds as min_beds,crm_leads_details.max_beds as max_beds,
				crm_leads_details.min_budget as min_budget,crm_leads_details.max_budget as max_budget,crm_leads_details.min_area as min_area,
				crm_leads_details.max_area as max_area,

				crm_leads.listing_id_1_ref as listing_id_1_ref,crm_leads.source_of_lead as source_of_lead,
				CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id,
				crm_leads.agent_id_2 as agent_id_2,crm_leads.agent_id_3 as agent_id_3,
				crm_leads.agent_id_4 as agent_id_4,crm_leads.agent_id_5 as agent_id_5,crm_leads.created_by as created_by,
				crm_leads.financial_situation as financial_situation,crm_leads.date_of_enquiry as date_of_enquiry,
				crm_leads.dateupdated as dateupdated,crm_leads.lead_by_agent as lead_by_agent,
				crm_leads.shared as shared,crm_leads.subsource_of_lead as subsource_of_lead

				

				';

					$this->datatables->select($c)

						//->unset_column('id')//this means if you want to include in columns or search

						->from('crm_leads');

						$this->datatables->join('crm_leads_details', 'crm_leads.id = crm_leads_details.lead_id', 'left');

						$this->datatables->join('crm_category', 'crm_leads_details.category_id = crm_category.id', 'left');

						$this->datatables->join('crm_city', 'crm_city.id = crm_leads_details.region_id', 'left');

						$this->datatables->join('crm_location', 'crm_location.loc_id = crm_leads_details.area_location_id', 'left');

						$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_leads_details.sub_area_location_id', 'left');

						$this->datatables->join('crm_users', 'crm_users.id = crm_leads.agent_id', 'left');

			

						

				$this->datatables ->where('crm_leads.is_active', 1); 

				/***********************where conditions starts here *******/

				if($this->input->post('type'))

				{

					if($this->input->post('type') == 1)

					{

						$this->db->where_in('crm_leads.type', array('1','3','5','6'));

					}elseif($this->input->post('type') == 2){

						$this->db->where_in('crm_leads.type', array('2','4','5','6'));

					}elseif($this->input->post('type') == 100){

						$this->db->where_in('crm_leads.type', array('1','2','5','6'));

						$this->datatables ->where('crm_owners.status', 2); 

						$this->datatables ->where('crm_owners.sub_status', 2); 

					}elseif($this->input->post('type') == 101){

						$this->db->where_in('crm_leads.type', array('2','4','5','6'));

						$this->datatables ->where('crm_owners.status', 2); 

						$this->datatables ->where('crm_owners.sub_status', 2); 

					}elseif($this->input->post('type') == 102){

						$this->db->where_in('crm_leads.type', array('1','3','5','6'));

						$this->datatables ->where("crm_leads.date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)");

					}

					elseif($this->input->post('type') == 103){

						$this->db->where_in('crm_leads.type', array('2','4','5','6'));

						$this->datatables ->where("crm_leads.date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)");

					}elseif($this->input->post('type') == 104){

						$this->db->where_in('crm_leads.type', array('1','3','5','6'));

						$this->datatables ->where("crm_leads.status = 1");

					}elseif($this->input->post('type') == 105){

						$this->db->where_in('crm_leads.type', array('2','4','5','6'));

						$this->datatables ->where("crm_leads.status = 1");

					}elseif($this->input->post('type') == 106){

						$this->db->where_in('crm_leads.type', array('1','3','5','6'));

						$this->datatables ->where("crm_leads.date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");

					}elseif($this->input->post('type') == 107){

						$this->db->where_in('crm_leads.type', array('2','4','5','6'));

						$this->datatables ->where("crm_leads.date_of_enquiry > DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");

					}elseif($this->input->post('type') == 108){

						$this->db->where_in('crm_leads.type', array('1','3','5','6'));

						$this->datatables ->where("crm_leads.status = 2");

					}elseif($this->input->post('type') == 109){

						$this->db->where_in('crm_leads.type', array('2','4','5','6'));

						$this->datatables ->where("crm_leads.status = 2");

					}

					 

				}

			/**********************where ends here*********************/

					return $this->datatables->generate();

				

       }

	   

	public function datatable_landlord()

	{

				

				$c ='id,name,last_name,mobile_no_new_ccode,mobile_no_new,phone,email,created_by,assigned_to_id,dateadded';

					$this->datatables->select($c)

						//->unset_column('id')//this means if you want to include in columns or search

						->from('crm_owners');

			//	$this->datatables->join('crm_category', 'crm_listings.category_id = crm_category.id', 'left');

			//	$this->datatables->join('crm_city', 'crm_city.id = crm_listings.region_id', 'left');

			//	$this->datatables->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');

			//	$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_listings.sub_area_location_id', 'left');

			//	$this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');

						

				$this->datatables ->where('crm_owners.is_active', 1); 

				

					return $this->datatables->generate();

				

       }   

 public function getSingleRow($id)

	{

		$this->db->select('*');

		$this->db->from('crm_leads');

		$where = "id=".$id;

		$this->db->where($where);

		

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

			  // One row, match!

			  

				  $row =  $query->row(); 

				return array(

					'id'=> ''.$row->id.'',

					'rand_key'=> ''.$row->rand_key.'',

					'client_id'=> ''.$row->client_id.'',

					'ref'=> ''.$row->ref.'',

					'auto'=> ''.$row->auto.'',

					'landlord_id'=> ''.$row->landlord_id.'',

					'landlord_name'=> ''.$row->landlord_name.'',

					'landlord_mobile'=> ''.$row->landlord_mobile.'',

					'landlord_email'=> ''.$row->landlord_email.'',

					'assigned_by_name'=> ''.$row->assigned_by_name.'',

					'agent_id'=> ''.$row->agent_id.'',

					'date_of_enquiry'=> ''.$row->date_of_enquiry.'',

					'type'=> ''.$row->type.'',

					'status'=> ''.$row->status.'',

					'sub_status'=> ''.$row->sub_status.'',

					'source_of_lead'=> ''.$row->source_of_lead.'',

					'home_no'=> ''.$row->home_no.'',

					'notes'=> ''.$row->notes.'',

					'first_name'=> ''.$row->first_name.'',

					'last_name'=> ''.$row->last_name.'',

					'listing_id_1'=> ''.$row->listing_id_1.'',

					'listing_id_1_ref'=> ''.$row->listing_id_1_ref.'',

					'listing_id_2'=> ''.$row->listing_id_2.'',

					'listing_id_2_ref'=> ''.$row->listing_id_2_ref.'',

					'listing_id_3'=> ''.$row->listing_id_3.'',

					'listing_id_3_ref'=> ''.$row->listing_id_3_ref.'',

					'listing_id_4'=> ''.$row->listing_id_4.'',

					'listing_id_4_ref'=> ''.$row->listing_id_4_ref.'',

					'agent_id_2'=> ''.$row->agent_id_2.'',

					'agent_id_3'=> ''.$row->agent_id_3.'',

					'agent_id_4'=> ''.$row->agent_id_4.'',

					'agent_id_5'=> ''.$row->agent_id_5.'',

					

					'property_req_1'=> ''.$row->property_req_1.'',

					'property_req_2'=> ''.$row->property_req_2.'',

					'property_req_3'=> ''.$row->property_req_3.'',

					'property_req_4'=> ''.$row->property_req_4.'',

					

					'property_req_1_data'=> ''.$row->property_req_1_data.'',

					'property_req_2_data'=> ''.$row->property_req_2_data.'',

					'property_req_3_data'=> ''.$row->property_req_3_data.'',

					'property_req_4_data'=> ''.$row->property_req_4_data.'',

					

					'created_by'=> ''.$row->created_by.'',

					'dateadded'=> ''.$row->dateadded.'',

					'dateupdated'=> ''.$row->dateupdated.'',

					'financial_situation'=> ''.$row->financial_situation.'',

					'subsource_of_lead'=> ''.$row->subsource_of_lead.'',

					'lead_priority'=> ''.$row->lead_priority.'',

					'hot_lead'=> ''.$row->hot_lead.'',

					'lead_by_agent'=> ''.$row->lead_by_agent.'',

					'shared'=> ''.$row->shared.'',

					'leads_reminder_one'=> ''.$row->leads_reminder_one.'',

					'leads_reminder_two'=> ''.$row->leads_reminder_two.''

					

					);

					

					} else {

				  // None

				  return 0;

				}

	}

function savesearch()

	 {

		 $created_by 	=  $this->session->userdata('userid');

		

		$dateadded = date('Y-m-d H:i:s');

		

		//get data

			$savesearch_name = $this->input->post('name');

		

		$savesearch_name = $savesearch_name."-".$created_by."-".date('Y-m-d');

	    $data_save = array(

					'search_name' =>$savesearch_name,

					'as_category_id'=> $this->input->post('as_category_id'),
					'as_beds'=> $this->input->post('as_beds'),
					'as_unit'=> $this->input->post('as_unit'),
					'as_enquired_for_referance'=> $this->input->post('as_enquired_for_referance'),
					'as_min_price'=> $this->input->post('as_min_price'),
					'as_max_price'=> $this->input->post('as_max_price'),
					'as_min_area'=> $this->input->post('as_min_area'),
					'as_max_area'=> $this->input->post('as_max_area'),
					'as_date_enq_to'=> $this->input->post('as_date_enq_to'),
					'as_date_enq_from'=> $this->input->post('as_date_enq_from'),
					'dateadded'=> $dateadded,
					'created_by' => $created_by

					);

		        $this->db->insert('crm_savedsearch_leads', $data_save); // insert new record

				return $this->db->insert_id();

		

	

		

		

	 }	

}