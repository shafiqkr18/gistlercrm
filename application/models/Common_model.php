<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Muhammad Shafiq

 * Description: Common model class

 * Date: 23 Nov,2015

 */

class Common_model extends CI_Model{

    function __construct(){

        parent::__construct();

		

    }

	

	/*******************get category******/

	public function getAllCategories()

	{

		

		$this->db->select("id,category");

		$this->db->from("crm_category");

		$this->db->order_by("category", "asc");

		

			$query = $this->db->get();

			return $query->result_array();

	}

	public function getPropertyFeatures()

	{

		

		$this->db->select("id,title");

		$this->db->from("crm_features");

		$where = "is_active=1 and is_feature=1";

		$this->db->where($where);

		$this->db->order_by("title", "asc");

		

			$query = $this->db->get();

			return $query->result_array();

	}

	public function getPropertyAmenities()

	{

		

		$this->db->select("id,title");

		$this->db->from("crm_features");

		$where = "is_active=1 and is_feature=0";

		$this->db->where($where);

		$this->db->order_by("title", "asc");

		

			$query = $this->db->get();

			return $query->result_array();

	}

	public function getAgents()

	{

		

		$this->db->select("id,CONCAT(first_name, ' ', last_name) as name");

		$this->db->from("crm_users");

		$where = "is_active=1 and status=1";

		$this->db->where($where);

		$this->db->order_by("first_name", "asc");

		

			$query = $this->db->get();

			return $query->result_array();

	}

	public function getAllLocations()

	{

		

		

		$this->db->select("city_id,loc_id,loc_name");

		$this->db->from("crm_location");

		//$this->db->group_by("city_id");

		$this->db->order_by("city_id", "asc");

		$query = $this->db->get();

		$rows = $query->result();

		$data = array();

		foreach ($rows as $key => $row)

		{

		  if($row->city_id == 1){

			

		  }

		}

			

	}

	

	public function getlastid($type)

	{

		if($type == "rentals")

		{

			return $this->db->query("select IFNULL(max(id),0) as id from crm_listings")->row()->id;

		}else{

		return 0;

		}

	}

	public function getcoordinates($id)

	{

		$this->db->select('lat,lon');

		$this->db->from('crm_location');

		$where = "loc_id=".$id;

		$this->db->where($where);

		$this->db->limit(1);

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

			  // One row, match!

				  $row =  $query->row(); 

				   return $row->lat."|".$row->lon;       

				} else {

				  // None

				  return 0;

				}

	}

	

	public function validate_sub_location($id)

	{

		$this->db->select('id,description');

		$this->db->from('crm_locations_text');

		$where = "sub_area_location_id=".$id;

		$this->db->where($where);

		$this->db->limit(1);

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

			  // One row, match!

				  $row =  $query->row(); 

				   return array('description' => ''.$row->description.'','id'=> ''.$row->id.'');       

				} else {

				  // None

				  return 0;

				}

	}

	

	public function validate_location($id)

	{

		$this->db->select('id,description');

		$this->db->from('crm_locations_text');

		$where = "area_location_id=".$id;

		$this->db->where($where);

		$this->db->limit(1);

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

			  // One row, match!

				  $row =  $query->row(); 

				   return array('description' => ''.$row->description.'','id'=> ''.$row->id.'');       

				} else {

				  // None

				  return 0;

				}

	}

	

	public function validate_agent($id)

	{

		$this->db->select('*');

		$this->db->from('crm_users');

		$where = "id=".$id;

		$this->db->where($where);

		$this->db->limit(1);

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

			  // One row, match!

				  $row =  $query->row(); 
				  $web = '';
				  if($row->is_individual == 0)
				  {
				  	$web = $this->db->query("select web from crm_profile where id=".$row->client_id)->row()->web;
				  }
				   return array('first_name' => ''.$row->first_name.'','last_name'=> ''.$row->last_name.'','rera'=> ''.$row->rera.'','ccode'=> ''.$row->mobile_no_new_ccode.'','mobile_no'=> ''.$row->mobile_no_new.'','office_no'=> ''.$row->office_no.'','web'=>$web.'','is_individual'=>$row->is_individual);       

				} else {

				  // None

				  return 0;

				}

	}

	

	public function validate_company_profile($client_id)

	{

		$this->db->select('*');

		$this->db->from('crm_profile');

		$where = "id=".$client_id;

		$this->db->where($where);

		$this->db->limit(1);

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

			  // One row, match!

				  $row =  $query->row(); 

				   return array('name' => ''.$row->name.'','trade_id'=> ''.$row->trade_id.'','address'=> ''.$row->address.'','phone_no'=> ''.$row->phone_no.'','fax_no'=> ''

				   .$row->fax_no.'','email'=> ''.$row->email.'','web'=> ''.$row->web.'','description'=> ''.$row->description.'');       

				} else {

				  // None

				  return 0;

				}

	}

	

	public function auto_location($term)

    {

		$req  = "SELECT 0 as city_id,loc_id,sub_loc_id,sub_sub_loc as myval,0 as lat,0 as lon FROM crm_subloc WHERE sub_sub_loc LIKE '%".$term."%'  UNION select city_id,loc_id,0 as sub_loc_id,loc_name as myval,lat,lon from crm_location WHERE loc_name LIKE '%".$term."%' ";

		

		//echo $req;exit;

        $query = $this->db->query($req);

		//$row = $query->row();

		if((!$query->result())){

			echo 0;

		}else{

			foreach ($query->result() as $row)

			{

			$results[] = array(

                        'region_id' => $row->city_id,

                        'value' => $row->myval,

						'area_location_id' => $row->loc_id,

                        'sub_area_location_id' => $row->sub_loc_id,

						'lat' => $row->lat,

                        'lon' => $row->lon

						

                    );

       

		

			}

			 echo json_encode($results);

		}

			

    }

	

	public function save_disabled_columns()

	{

		

		$created_by =  $this->session->userdata('userid');

		$dateadded	=	date('Y-m-d');

	     $array_data = implode(",", $this->input->post('columns'));
	     $screenname = $this->input->post('screenname');
	     if($screenname == '') $screenname = 'listings';
			$data = array(

					   

						'columns' => $array_data,

						'created_by' => $created_by,

						'dateadded' => $dateadded,
						'screenname' => $screenname

						

					);

			  $this->db->insert('crm_columns', $data); // insert new record

		


	}

	

	public function datatable_landlord_popup()

	{
		// get user
		$admin_ID 	= $this->session->userdata('userid');
		$user_type 	= $this->session->userdata('user_type');

		// to avoid "The SELECT would examine more than MAX_JOIN_SIZE rows;"
		$query_For_Max = $this->db->query("SET SQL_BIG_SELECTS=1");

		$c = 'crm_owners.id as id,crm_owners.name as name,crm_owners.last_name as last_name,crm_owners.mobile_no_new_ccode as mobile_no_new_ccode,crm_owners.mobile_no_new as mobile_no_new,crm_owners.phone as phone,crm_owners.email as email,ua.first_name as first_name,u.first_name as first_name,crm_owners.dateupdated as dateupdated';

			$this->datatables->select($c)

			    ->unset_column('crm_owners.id')//this means if you want to include in columns or search

				->from('crm_owners');

				$this->datatables->join('crm_users as u', 'u.id = crm_owners.created_by','left');

				$this->datatables->join('crm_users as ua', 'ua.id = crm_owners.assigned_to_id','left');

				$this->datatables ->where('crm_owners.is_active', 1); 

				$contact_type = trim($this->input->post('contact_type'));

				if($contact_type){

					//$this->datatables ->where('crm_owners.contact_type', $contact_type);

				}

				if($user_type == 3)
				{
					$this->datatables ->where('crm_owners.assigned_to_id', $admin_ID); 
				}

	 

			return $this->datatables->generate();

       }

	   

	public function datatable_lead_popup()

	{
		// to avoid "The SELECT would examine more than MAX_JOIN_SIZE rows;"
		$query_For_Max = $this->db->query("SET SQL_BIG_SELECTS=1");

		$id =  $this->input->post('listings_id');

		$c = 'l.id,l.ref, IF(l.status = 2, "Closed", "Open") as status,l.landlord_name,l.last_name,r.name as city,l.landlord_mobile,l.date_of_enquiry,l.source_of_lead,

		CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id';

			$this->datatables->select($c)

			    ->unset_column('id')//this means if you want to include in columns or search

				->from('crm_leads as l');

					$this->datatables->join('crm_leads_details as ld', 'ld.lead_id = l.id','left');

					$this->datatables->join('crm_city as r', 'r.id = ld.region_id','left');

					 $this->datatables->join('crm_users', 'crm_users.id = l.agent_id', 'left');

					$this->db->where("listing_id_1='$id' OR listing_id_2 = '$id' OR listing_id_3 = '$id' OR listing_id_4 = '$id'");

	 

			return $this->datatables->generate();

       }

	   

	public function checkLocation($id)

	{

		$this->db->select('id');

		$this->db->from('crm_locations_text');

		$where = "area_location_id=".$id;

		$this->db->where($where);

		$this->db->limit(1);

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

      // One row, match!

		  $row =  $query->row(); 

		   return json_encode(array('msg' => 'This Location already exists in the system with the same details.','id'=> ''.$row->id.''));       

		} else {

		  // None

		  return 0;

		}

	}

	

	public function checkSubLocation($id)

	{

		$this->db->select('id');

		$this->db->from('crm_locations_text');

		$where = "sub_area_location_id=".$id;

		$this->db->where($where);

		$this->db->limit(1);

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

      // One row, match!

		  $row =  $query->row(); 

		   return json_encode(array('msg' => 'This Sub-Location already exists in the system with the same details.','id'=> ''.$row->id.''));       

		} else {

		  // None

		  return 0;

		}

	}

	

	

	

	public function set_Locations()

	{

		$created_by =  $this->session->userdata('userid');

		$dateadded = date('Y-m-d H:i:s');

		$dateupdated = date('Y-m-d H:i:s');

	    $id =  $this->input->post('hdn_setting_id');

		

					if ($id) {

											$data = array(

									'id' => $this->input->post('hdn_setting_id'),

									'region_id' => $this->input->post('region_id'),

									'area_location_id' => $this->input->post('area_location_id'),

									'sub_area_location_id' => $this->input->post('sub_area_location_id'),

									'description' => $this->input->post('description'),

									'created_by' => $created_by,

									'dateupdated' => $dateupdated,

									'client_id'=>$this->session->userdata('client_id'),

									'listing_type' => $this->input->post('listing_type')

								);

				  $this->db->where('id', $data['id']);

				 $this->db->update('crm_locations_text',$data); // update the record

				 return array('returnthis'=> ''.$data['id'].''); 

				}

			else {

							$data = array(

					   

						'region_id' => $this->input->post('region_id'),

						'area_location_id' => $this->input->post('area_location_id'),

						'sub_area_location_id' => $this->input->post('sub_area_location_id'),

						'description' => $this->input->post('description'),

						'created_by' => $created_by,

						'dateadded' => $dateadded,

						'dateupdated' => $dateupdated,

						'client_id'=>$this->session->userdata('client_id'),

						'listing_type' => $this->input->post('listing_type')

					);

			  $this->db->insert('crm_locations_text', $data); // insert new record

			  $insert_id = $this->db->insert_id();

               return array('returnthis'=> ''.$insert_id.'');

			 

			}

		

	}

	public function single_setting($id)

	{

		$this->db->select('*');

		$this->db->from('crm_locations_text');

		$where = "id=".$id;

		$this->db->where($where);

		$this->db->limit(1);

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

      // One row, match!

		  $row =  $query->row(); 

		   return $row;       

		} else {

		  // None

		  return 0;

		}

	}

	public function datatable_locations()

	{
		// to avoid "The SELECT would examine more than MAX_JOIN_SIZE rows;"
		$query_For_Max = $this->db->query("SET SQL_BIG_SELECTS=1");

		$c = 'l.id,r.name as region_id,pl.loc_name as area_location_id,IFNULL(psl.sub_sub_loc, "--") as sub_area_location_id,l.description,l.dateupdated,l.client_id';

		//area_location_id

			$this->datatables->select($c)

			    ->unset_column('id')//this means if you want to include in columns or search

				->from('crm_locations_text as l');

				$this->datatables->join('crm_city as r', 'r.id = l.region_id');

				$this->datatables->join('crm_location as pl', 'pl.loc_id = l.area_location_id');

				$this->datatables->join('crm_subloc as psl', 'psl.sub_loc_id = l.sub_area_location_id','LEFT');

	 

			return $this->datatables->generate();

       }

	   

	public function datatable_linktolistings()

	{
		// get user
		$admin_ID 	= $this->session->userdata('userid');
		$user_type 	= $this->session->userdata('user_type');

				// to avoid "The SELECT would examine more than MAX_JOIN_SIZE rows;"
				$query_For_Max = $this->db->query("SET SQL_BIG_SELECTS=1");

				//CASE WHEN crm_listings.agent_id='.$admin_ID.' THEN crm_listings.unit ELSE "--" END AS unit

				$c = 'crm_listings.id as id,crm_listings.type as type,crm_listings.managed as managed,crm_listings.exclusive as exclusive,crm_listings.shared as shared,crm_listings.ref as ref,

				crm_listings.unit AS unit, crm_category.category as category_id,crm_city.name as region_id,crm_location.loc_name as area_location_id,crm_subloc.sub_sub_loc as sub_area_location_id,crm_listings.beds as beds,crm_listings.size as size,

				crm_listings.price as price,CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id,crm_listings.landlord_name as landlord_id,crm_listings.unit_type as unit_type,crm_listings.baths as baths,crm_listings.street_no as street_no,crm_listings.floor_no as floor_no,crm_listings.dewa_no as dewa_no,crm_listings.photos as photos,crm_listings.cheques as cheques,crm_listings.fitted as fitted,crm_listings.prop_status as prop_status,crm_listings.source_of_listing as source_of_listing,crm_listings.available_date as available_date,

				crm_listings.remind_me as remind_me,crm_listings.furnished as furnished,crm_listings.featured as featured,crm_listings.maintenance as maintenance,crm_listings.strno as strno,crm_listings.amount as amount,crm_listings.tenanted as tenanted,crm_listings.plot_size as plot_size,crm_listings.name as name,crm_listings.view_id as view_id,crm_listings.commission as commission,crm_listings.deposit as deposit,crm_listings.unit_size_price as unit_size_price,crm_listings.dateadded as dateadded,crm_listings.dateupdated as dateupdated,

				crm_listings.created_by as user_id';

					$this->datatables->select($c)

						//->unset_column('id')//this means if you want to include in columns or search

						->from('crm_listings');

				$this->datatables->join('crm_category', 'crm_listings.category_id = crm_category.id', 'left');

				$this->datatables->join('crm_city', 'crm_city.id = crm_listings.region_id', 'left');

				$this->datatables->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');

				$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_listings.sub_area_location_id', 'left');

				$this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');

						

				$this->datatables ->where('crm_listings.is_active', 1); 

				$this->datatables ->where('crm_listings.status', 2); 

				if($user_type == 3)
				{
					$this->datatables ->where('crm_listings.agent_id', $admin_ID);

				}

					return $this->datatables->generate();

				

       }   

	

	public function autoFindListing()

	{

		$arr = array();

		$term = $_GET["term"];

		$this->db->select('id,rand_key,name,beds,area_location_id,landlord_name');

		$this->db->from('crm_listings');

		//$where = "ref=".$id;

		//$this->db->where($where);

		$this->db->like('ref', $term);

		//echo $this->db->get_compiled_select();exit;

		$query = $this->db->get();

		return $query->result_array();

	}

	public function addleadsubmit()

	{

		//there is no update bcoz this is popup

			$id = 0;

			

			//check from where these fields comes.

			if($this->input->post('SaveLeadPopup'))//this comes from lisitngs->action->add lead popup

			{

							

							

							$created_by =  $this->session->userdata('userid');

							$client_id   =  $this->session->userdata('client_id');

							$dateadded	=	date('Y-m-d');

							$dateupdated    =	date('Y-m-d');

							

							

							/***************collect fields********/

							//rand key..some time we save lead from other pages popups so rand key for owner is empty so lets fill it here

							//14503468808582988

							$rand_key = time().mt_rand(1000000,9000000);

							

							//first save caller,owner details or contact details 

							$ret = $this->db->query("select IFNULL(max(id),0) as id from crm_owners")->row()->id;

							$ret = str_pad($ret, 4, '0', STR_PAD_LEFT);

							$ret = $ret + 0001;

							$ref_owner = "GIS-O-".$ret;

							$assigned_to_id = $this->input->post('agent_id');

							if($assigned_to_id<1) $assigned_to_id = $created_by;

							if($this->input->post('agent_id'))

							{

								$agent_id = $this->input->post('agent_id');

							}else{

								$agent_id  = $this->session->userdata('userid');

							}

							

					$data_save_owner = array(

					    'rand_key' =>$rand_key,

						'client_id' => $client_id,

						'ref' => $ref_owner,

						'name' => $this->input->post('first_name'),

						'last_name' => $this->input->post('last_name'),

						'mobile_no_new_ccode' => $this->input->post('mobile_code_lead'),

						'mobile_no_new' => $this->input->post('mobile_no'),

						'c_code_phone_1' => $this->input->post('phone_code_lead'),

						'phone'=> $this->input->post('home_no'),

						'email'=> $this->input->post('email'),

						'dateadded'=> $dateadded,

						'dateupdated'=> $dateupdated,

						'created_by'=> $created_by,

						'agent_id'=> $agent_id,

						'assigned_to_id'=> $assigned_to_id,

						'notes'=> $this->input->post('notes'),

						'contact_type'=> $this->input->post('type'),

						'source_of_contact'=> $this->input->post('source_of_lead')

					);

						//save contact first

						 $this->db->insert('crm_owners', $data_save_owner); // insert new record

						 $landlord_id = $this->db->insert_id();						

							

							//now save lead

							//get ref no first

							$ret = $this->db->query("select IFNULL(max(id),0) as id from crm_leads")->row()->id;

								$ret = str_pad($ret, 4, '0', STR_PAD_LEFT);

								$ret = $ret + 0001;

								$ref = "GIS-L-".$ret;

						

							$data_save = array(

											'rand_key' =>$rand_key,

											'client_id' => $client_id,

											'ref' => $ref,

											'landlord_id' => $landlord_id,

											'landlord_name' => $this->input->post('first_name')." ".$this->input->post('last_name'),

											'landlord_mobile' => $this->input->post('mobile_code_lead')." ".$this->input->post('mobile_no'),

											'landlord_email' => $this->input->post('email'),

											'assigned_by_name' => $this->session->userdata('username'),

											'agent_id' => $agent_id,

											'date_of_enquiry' => $this->input->post('date_of_enquiry'),

											'type' => $this->input->post('type'),

											'status' =>$this->input->post('status'),

											'sub_status' => $this->input->post('sub_status'),

											'source_of_lead' => $this->input->post('source_of_lead'),

											'home_no'=> $this->input->post('home_no'),

											'notes'=> $this->input->post('notes'),

											'first_name' => $this->input->post('first_name'),

											'last_name' => $this->input->post('last_name'),

											'listing_id_1' => $this->input->post('enquired_for_ref'),

											'listing_id_1_ref'=> $this->input->post('enquired_for_referance'),

											'property_req_1'=> $this->input->post('property_req_1'),

											'property_req_1_data'=> $this->input->post('property_req_1_data'),

											'created_by'=> $created_by,

											'dateadded'=> $dateadded,

											'dateupdated'=> $dateupdated,

											'subsource_of_lead'=> $this->input->post('subsource_of_lead')

										);

						

								 

								 

								  $this->db->insert('crm_leads', $data_save); // insert new record

								 $lead_id = $this->db->insert_id();

							

								//save details

								if($lead_id>0)

								{

									$details_update = array(

											'lead_id' =>$lead_id,

											'category_id' => $this->input->post('listings_type'),

											'region_id' => $this->input->post('region_id'),

											'area_location_id' => $this->input->post('listings_location'),

											'sub_area_location_id' =>$this->input->post('listings_sub_location'),

											'min_beds' =>$this->input->post('min_beds'),

											'max_beds' =>$this->input->post('min_beds'),

											'min_budget' => $this->input->post('min_budget'),

											'max_budget' => $this->input->post('min_budget'),

											'min_area' =>$this->input->post('min_area'),

											'max_area' =>$this->input->post('min_area'),

											'unit_no' => $this->input->post('unit_no'),

											'type'=>$this->input->post('type')

											);

											

											$this->db->insert('crm_leads_details', $details_update); // insert new record

								

								

									

								}

							return $lead_id;

			}

		

	}

	

	public function adddealsubmit()

	{

		$created_by =  $this->session->userdata('userid');

		$dateadded = date('Y-m-d H:i:s');

		$dateupdated = date('Y-m-d H:i:s');

		

		$rand_key = time().mt_rand(1000000,9000000);

		

			$id = 0;

			$ret = $this->db->query("select IFNULL(max(id),0) as id from crm_deals")->row()->id;

			$ret = str_pad($ret, 4, '0', STR_PAD_LEFT);

			$ret = $ret + 0001;

			

			$ref = "GIS-D-".$ret;

		

	

	//collect pharameters

		

		

		$data_save = array(

					'client_id'=> $this->session->userdata('client_id'),

					'rand_key'=> $rand_key,

					'ref'=> $ref,

					'type'  => $this->input->post('type'),

					'tenant_buyer_id' => $this->input->post('listings_landlord_id'),

					'tenant_buyer_name' => $this->input->post('listings_landlord_name'),

					//'landlord_seller_id' => $this->input->post('landlord_seller_id'),

					//'landlord_seller_name' => $this->input->post('landlord_seller_name'),

					'status' => $this->input->post('status'),

					'sub_status' => $this->input->post('sub_status'),

					'agent_id' => $this->input->post('agent_id'),

					'price' => $this->input->post('listings_price'),

					'deposit' => $this->input->post('listings_deposit'),

					'commission' => $this->input->post('listings_commission'),

					'cheques' => $this->input->post('listings_cheques'),

					'deal_date' => $this->input->post('rent_start_date'),

					//'deal_estimated_date' => $this->input->post('deal_estimated_date'),

					'listings_id' => $this->input->post('listings_id'),

					'listings_ref' => $this->input->post('listings_ref'),

					'listings_randkey' => $this->input->post('listings_randkey'),

					'listings_unit' => $this->input->post('listings_unit'),

					//'agent_1_id' => $this->input->post('agent_1_id'),

					//'agent_1_commission_percentage' => $this->input->post('agent_1_commission_percentage'),

					//'agent_1_commission' => $this->input->post('agent_1_commission'),

					//'agent_2_id' => $this->input->post('agent_2_id'),

					//'agent_2_commission_percentage' => $this->input->post('agent_2_commission_percentage'),

					//'agent_2_commission' => $this->input->post('agent_2_commission'),

					//'agent_3_id' => $this->input->post('agent_3_id'),

					//'agent_3_commission_percentage' => $this->input->post('agent_3_commission_percentage'),

					//'agent_3_commission' => $this->input->post('agent_3_commission'),

					'listings_beds' => $this->input->post('listings_beds'),

					'listings_unit_type' => $this->input->post('listings_unit_type'),

					'listings_street_no'=> $this->input->post('listings_street_no'),

					'listings_floor_no' => $this->input->post('listings_floor_no'),

					//'renewal_date' => $this->input->post('renewal_date'),

					//'remind_before' => $this->input->post('remind_before'),

					'listings_category_id' => $this->input->post('listings_category_id'),

					'region_id' => $this->input->post('listings_region_id_val'),

					'area_location_id' => $this->input->post('listings_location_val'),

					'sub_area_location_id' => $this->input->post('listings_sublocation_val'),

					'notes' => $this->input->post('notes'),

					'add_info' => $this->input->post('add_info'),

					'created_by' => $created_by,

					'created_by_name' => $this->session->userdata('username'),

					'dateadded' => $dateadded,

					'dateupdated' => $dateupdated,

					'leads_id' => $this->input->post('leads_id'),

					'leads_ref' => $this->input->post('leads_ref')

					);

				 $this->db->insert('crm_deals', $data_save); // insert new record

				 echo "Saved sucessfully!";

		

	}

	

	public function get_listings_stats($id)

	 {

		

		$this->db->where("listings_id=".$id);

		$this->db->from('crm_todo');

		$todo = $this->db->count_all_results();

		

		$this->db->where("listing_id=".$id);

		$this->db->from('crm_events');

		$events = $this->db->count_all_results();



		$this->db->where("listing_id_1=".$id." OR listing_id_2 = '$id' OR listing_id_3 = '$id' OR listing_id_4 = '$id'");

		$this->db->from('crm_leads');

		$leads = $this->db->count_all_results();

		

		$this->db->where("listings_id=".$id);

		$this->db->from('crm_deals');

		$deals = $this->db->count_all_results();

		

		

		

			 return array(

					'activities'=> ''.$todo.'',

					'events'=> ''.$events.'',

					'leads'=> ''.$leads.'',

					'deals'=> ''.$deals.'',

					);

	 }

	 public function datatable_listings_todo()

	{

		$id =  $this->input->post('listings_id');

			$c = 'id,ref,title,status,priority,due_date,created_by,assigned_to_id,notes';

		//area_location_id

			$this->datatables->select($c)

			   // ->unset_column('id')//this means if you want to include in columns or search

				->from('crm_todo');

				//$this->datatables->join('crm_city as r', 'r.id = l.region_id');

				//$this->datatables->join('crm_location as pl', 'pl.loc_id = l.area_location_id');

				//$this->datatables->join('crm_subloc as psl', 'psl.sub_loc_id = l.sub_area_location_id','LEFT');

				$this->db->where("listings_id=".$id);

	 

			return $this->datatables->generate();

       }

	   

	public function datatable_listings_events()

	{

		$id =  $this->input->post('listings_id');

	

			$c = 'id,start_date,end_date,title,location,description,created_by';

		//area_location_id

			$this->datatables->select($c)

			    ->unset_column('id')//this means if you want to include in columns or search

				->from('crm_events');

				//$this->datatables->join('crm_city as r', 'r.id = l.region_id');

				//$this->datatables->join('crm_location as pl', 'pl.loc_id = l.area_location_id');

				//$this->datatables->join('crm_subloc as psl', 'psl.sub_loc_id = l.sub_area_location_id','LEFT');

				$this->db->where("listing_id=".$id);

	 

			return $this->datatables->generate();

    }

	public function datatable_listings_deals()

	{

		$id =  $this->input->post('listings_id');

	

			$c = 'id,ref,listings_ref,type,tenant_buyer_name,landlord_seller_name,price,cheques,deposit,commission,agent_1_id,deal_date';

		//area_location_id

			$this->datatables->select($c)

			   // ->unset_column('id')//this means if you want to include in columns or search

				->from('crm_deals');

				

				//$this->datatables->join('crm_city as r', 'r.id = l.region_id');

				//$this->datatables->join('crm_location as pl', 'pl.loc_id = l.area_location_id');

				//$this->datatables->join('crm_subloc as psl', 'psl.sub_loc_id = l.sub_area_location_id','LEFT');

				if($id)

				{

					$this->db->where("listings_id=".$id);

				}

				

				if($this->input->post('landlord_id'))

				{

					$landlord_id = $this->input->post('landlord_id');

					$this->db->where("tenant_buyer_id=".$landlord_id." OR 	landlord_seller_id= ".$landlord_id);

				}

	 

			return $this->datatables->generate();

    }

	public function getProfiles()

	{

		

		$this->db->select("id, name");

		$this->db->from("crm_profile");

		$where = "is_active=1";

		$this->db->where($where);

		$this->db->order_by("name", "asc");

		

			$query = $this->db->get();

			return $query->result_array();

	}

	// datatable section helper functions

	public function beds_baths_score($id)

	{

		

		

		$score = 0;

		return $score1 = 33;

		$ret=1;

		//return "select id from crm_listings where id='$id'";

		//$iddd = $this->db->query("select id from crm_listings where id='$id'")->row()->id;

		// $q = "select id from crm_listings where id='$id'";

		

		//$ret = $this->db->query($q)->row()->id;

		

		// $this->db->select("id");

		// $this->db->from("crm_listings");

		// $where = "id='$id'";

		// $this->db->where($where);

// 		

		  // $this->db->get_compiled_select();

		  // //$this->db->_reset_select();

		  // $query = $this->db->get();

		  // $ret = $query->row()->id;

			// //$query = $this->db->get();

			// //return $query->result_array();

		// //

		 // return $id."=".$q ;

		//$this->db->where("ref='$id'");

		//$this->db->from('crm_listings');

		//return $id."=".$ret = $this->db->count_all_results();

		

	}



public function get_password($name)

	{

		$this->db->select('first_name','password');

		$this->db->from('crm_users');

		$where = "username=".$name;

		$this->db->where($where);

		$this->db->limit(1);

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

			  // One row, match!

				  $row =  $query->row(); 
				  return true;
				   //return this->send_mail($row->name,);    

				} else {

				  // None

				  return 0;

				}

	}
	
		public function send_mail($name,$from_email,$mobile,$message,$email_type)
	{
		//set to_email id to which you want to receive mails
						         $to_email = 'muhammad.royalhome@gmail.com';
								 //configure email settings
									$config['protocol'] = 'smtp';
									$config['smtp_host'] = 'ssl://smtp.gmail.com';
									$config['smtp_port'] = '465';
									$config['smtp_user'] = 'software.engineer006@gmail.com';
									$config['smtp_pass'] = 'ZemtvZemtv';
									$config['mailtype'] = 'html';
									$config['charset'] = 'iso-8859-1';
									$config['wordwrap'] = TRUE;
									$config['newline'] = "\r\n"; //use double quotes
									//$this->load->library('email', $config);
									$this->email->initialize($config);                        
						
									//send mail
									$this->email->from($from_email, $name);
									$this->email->to($to_email);
									$this->email->subject("Email From Home Page For ".$email_type."- Royalhome.ae");
									$this->email->message($message);
									 if ($this->email->send())
										{
											return true;
										}else{
											return false;
										}
	}

}