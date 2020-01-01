<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Shafiq

 * Description: contacts model class

 */

class Contacts_model extends CI_Model{

	  

     

    function __construct(){

        parent::__construct();

		$this->load->database();

	  

    	

    }

	

	public function lookupnew($mobile_no_new,$email)

	{

		if($mobile_no_new != '')

		{

			$this->db->where('mobile_no_new',$mobile_no_new);

			$this->db->where('is_active',1);

			$query = $this->db->get('crm_owners');

			if ($query->num_rows() > 0){

				return 1;//record exist

			}

			else{

				return 0;

			}

		}else if($email != '')

		{

			$this->db->where('email',$email);

			$this->db->where('is_active',1);

			$query = $this->db->get('crm_owners');

			if ($query->num_rows() > 0){

				return 1;//record exist

			}

			else{

				return 0;

			}

		}else return 0;

	}

	

	public function save_contacts()

	{

		//check either it is new entry or updation

		if (($this->input->post('id')) && ($this->input->post('ref'))) {//this is update

		$id = $this->input->post('id');

		$ref = $this->input->post('ref');

		

		}else{

			$id = 0;

		//get ref no first

		$ret = $this->db->query("select IFNULL(max(id),0) as id from crm_owners")->row()->id;

			$ret = str_pad($ret, 4, '0', STR_PAD_LEFT);

			$ret = $ret + 0001;

			$ref = "GIS-O-".$ret;

		}

		//end

		$created_by =  $this->session->userdata('userid');

		$dateadded	=	date('Y-m-d');

	    $dateupdated    =	date('Y-m-d');

		

		

		/***************collect fields********/

		$came_from = $this->input->post('came_from');//check from which page we getting data..1= main contact save page

		if($came_from == 1)

		{

			$assigned_to_id = $this->input->post('assigned_to_id');

		}else{

			$assigned_to_id = $this->input->post('assigned_to_id1');

		}

		//check if user did not select assign to then it will assign to login user

		if($assigned_to_id<1) $assigned_to_id = $created_by;

		

		//rand key..some time we save owner from other pages popups so rand key for owner is empty so lets fill it here

		//14503468808582988

		$rand_key = $this->input->post('rand_key');

		if($rand_key =='' || $rand_key<1 || $rand_key == 0)

		{

			 $rand_key = time().mt_rand(1000000,9000000);

		}

		

		$hobbies = '';

		

		if($this->input->post('hobbies'))

		$hobbies = implode(', ', $this->input->post('hobbies'));

		

		if($this->input->post('client_id'))

		{

			$client_id = $this->input->post('client_id');

		}else{

		$client_id = $this->session->userdata('client_id');;

		}

		if($this->input->post('agent_id'))

		{

			$agent_id = $this->input->post('agent_id');

		}else{

			$agent_id  = $this->session->userdata('userid');

		}

		

		$data_save = array(

					    'rand_key' =>$rand_key,

						'client_id' => $client_id,

						'ref' => $ref,

						'title' => $this->input->post('title'),

						'name' => $this->input->post('name'),

						'last_name' => $this->input->post('last_name'),

						'gender' => $this->input->post('gender'),

						'mobile_no_new_ccode' => $this->input->post('mobile_no_new_ccode'),

						'mobile_no_new' => $this->input->post('mobile_no_new'),

						'mobile_no_new_ccode_2' => $this->input->post('mobile_no_new_ccode_2'),

						'mobile_2' => $this->input->post('mobile_2'),

						'mobile_no_new_ccode_3' =>$this->input->post('mobile_no_new_ccode_3'),

						'mobile_3' => $this->input->post('mobile_3'),

					    'c_code_phone_1' => $this->input->post('c_code_phone_1'),

						'phone'=> $this->input->post('phone'),

						'c_code_phone_2'=> $this->input->post('c_code_phone_2'),

						'phone_2' => $this->input->post('phone_2'),

					    'c_code_phone_3' => $this->input->post('c_code_phone_3'),

						'phone_3'=> $this->input->post('phone_3'),

						'email'=> $this->input->post('email'),

						'email_2'=> $this->input->post('email_2'),

						'email_3'=> $this->input->post('email_3'),

						'c_code_fax'=> $this->input->post('c_code_fax'),

						'fax'=> $this->input->post('fax'),

						'c_code_fax_2'=> $this->input->post('c_code_fax_2'),

						'fax_2'=> $this->input->post('fax_2'),

						'c_code_fax_3'=> $this->input->post('c_code_fax_3'),

						'fax_3'=> $this->input->post('fax_3'),

						'dateadded'=> $dateadded,

						'dateupdated'=> $dateupdated,

						'created_by'=> $created_by,

						'agent_id'=> $agent_id,

						'company'=> $this->input->post('company'),

						'address_line_1'=> $this->input->post('address_line_1'),

						'address_line_2'=> $this->input->post('address_line_2'),

						'address_city'=> $this->input->post('address_city'),

						'address_zip_po_box'=> $this->input->post('address_zip_po_box'),

						'address_state'=> $this->input->post('address_state'),

						'address_country'=> $this->input->post('address_country'),

						'assigned_to_id'=> $this->input->post('assigned_to_id'),

						'notes'=> $this->input->post('notes'),

						'contact_type'=> $this->input->post('contact_type'),

						'nationality_new'=> $this->input->post('nationality_new'),

						'nationality'=> $this->input->post('nationality'),

						'nationality_1'=> $this->input->post('nationality_1'),

						'dob'=> $this->input->post('dob'),

						'religion'=> $this->input->post('religion'),

						'native_language'=> $this->input->post('native_language'),

						'language1'=> $this->input->post('language1'),

						'second_language'=> $this->input->post('second_language'),

						'hobbies'=>$hobbies,

						'address'=> $this->input->post('address'),

						'address2'=> $this->input->post('address2'),

						'designation'=> $this->input->post('designation'),

						'website'=> $this->input->post('website'),

						'facebook'=> $this->input->post('facebook'),

						'twitter'=> $this->input->post('twitter'),

						'linkedin'=> $this->input->post('linkedin'),

						'skype'=> $this->input->post('skype'),

						'source_of_contact'=> $this->input->post('source_of_contact')

					);

		$data_update = array(

						'id' =>$id,

					    'name' =>$rand_key,

						'client_id' => $client_id,

						'ref' => $ref,

						'title' => $this->input->post('title'),

						'name' => $this->input->post('name'),

						'last_name' => $this->input->post('last_name'),

						'gender' => $this->input->post('gender'),

						'mobile_no_new_ccode' => $this->input->post('mobile_no_new_ccode'),

						'mobile_no_new' => $this->input->post('mobile_no_new'),

						'mobile_no_new_ccode_2' => $this->input->post('mobile_no_new_ccode_2'),

						'mobile_2' => $this->input->post('mobile_2'),

						'mobile_no_new_ccode_3' =>$this->input->post('mobile_no_new_ccode_3'),

						'mobile_3' => $this->input->post('mobile_3'),

					    'c_code_phone_1' => $this->input->post('c_code_phone_1'),

						'phone'=> $this->input->post('phone'),

						'c_code_phone_2'=> $this->input->post('c_code_phone_2'),

						'phone_2' => $this->input->post('phone_2'),

					    'c_code_phone_3' => $this->input->post('c_code_phone_3'),

						'phone_3'=> $this->input->post('phone_3'),

						'email'=> $this->input->post('email'),

						'email_2'=> $this->input->post('email_2'),

						'email_3'=> $this->input->post('email_3'),

						'c_code_fax'=> $this->input->post('c_code_fax'),

						'fax'=> $this->input->post('fax'),

						'c_code_fax_2'=> $this->input->post('c_code_fax_2'),

						'fax_2'=> $this->input->post('fax_2'),

						'c_code_fax_3'=> $this->input->post('c_code_fax_3'),

						'fax_3'=> $this->input->post('fax_3'),

						//'dateadded'=> $dateadded,

						'dateupdated'=> $dateupdated,

						'created_by'=> $created_by,

						'agent_id'=> $agent_id,

						'company'=> $this->input->post('company'),

						'address_line_1'=> $this->input->post('address_line_1'),

						'address_line_2'=> $this->input->post('address_line_2'),

						'address_city'=> $this->input->post('address_city'),

						'address_zip_po_box'=> $this->input->post('address_zip_po_box'),

						'address_state'=> $this->input->post('address_state'),

						'address_country'=> $this->input->post('address_country'),

						'assigned_to_id'=> $this->input->post('assigned_to_id'),

						'notes'=> $this->input->post('notes'),

						'contact_type'=> $this->input->post('contact_type'),

						'nationality_new'=> $this->input->post('nationality_new'),

						'nationality'=> $this->input->post('nationality'),

						'nationality_1'=> $this->input->post('nationality_1'),

						'dob'=> $this->input->post('dob'),

						'religion'=> $this->input->post('religion'),

						'native_language'=> $this->input->post('native_language'),

						'language1'=> $this->input->post('language1'),

						'second_language'=> $this->input->post('second_language'),

						'hobbies'=>$hobbies,

						'address'=> $this->input->post('address'),

						'address2'=> $this->input->post('address2'),

						'designation'=> $this->input->post('designation'),

						'website'=> $this->input->post('website'),

						'facebook'=> $this->input->post('facebook'),

						'twitter'=> $this->input->post('twitter'),

						'linkedin'=> $this->input->post('linkedin'),

						'skype'=> $this->input->post('skype'),

						'source_of_contact'=> $this->input->post('source_of_contact')

					);

			 

			 

			 	if (($this->input->post('id')) && ($this->input->post('ref'))) {

					$listing_id = 	$this->input->post('id');					

				  $this->db->where('id', $listing_id);

			 $this->db->update('crm_owners',$data_update); // update the record

				

				}else {

							

			  $this->db->insert('crm_owners', $data_save); // insert new record

			 $listing_id = $this->db->insert_id();

			}

			/************************save notes*********************************/

		if($this->input->post('notes'))

		{

				$data_notes = array(

							'created_by' => $created_by,

							'notes'=> $this->input->post('notes'),

							'created_date'=>  date("Y-m-d H:i:s"),

							'listing_id'=> $listing_id,

							'rand_key'=> $this->input->post('rand_key')

							);

							 $this->db->insert('crm_contacts_notes', $data_notes);

		}

		

		return $listing_id;

		

	}

	

	public function datatable()

	{

				

				$c ='crm_owners.id as id ,crm_owners.auto as auto,crm_owners.ref as ref,crm_owners.gender as gender,crm_owners.name as name,crm_owners.last_name as last_name,
				    crm_owners.company as company,crm_owners.address_line_1 as address_line_1,
                    crm_owners.address_line_2 as address_line_2,crm_owners.address_city as address_city,crm_owners.address_state as address_state,
                    crm_owners.address_country as address_country,crm_owners.address_zip_po_box as address_zip_po_box,crm_owners.phone as phone,crm_owners.phone_2 as phone_2,
					crm_owners.fax as fax,crm_owners.address2_zip_po_box as address2_zip_po_box,crm_owners.mobile_no_new as mobile_no_new,
					crm_owners.email as email,crm_owners.email_2 as email_2,crm_owners.dob as dob,crm_owners.designation as designation,
					crm_owners.nationality_new as nationality_new,crm_owners.title as title,crm_owners.phone_3 as phone_3,crm_owners.assigned_to_id as assigned_to_id,
					crm_owners.dateupdated,"123" as NIL,"123" as NIL1,crm_owners.phone_3 as phone_3,crm_owners.mobile_3 as mobile_3,
					crm_owners.fax_2 as fax_2,crm_owners.fax_3 as fax_3,crm_owners.email_3 as email_3,crm_owners.website as website,
					crm_owners.facebook as facebook,crm_owners.twitter as twitter,
					crm_owners.linkedin as linkedin,crm_owners.googleplus as googleplus,crm_owners.instagram as instagram,
					crm_owners.wechat as wechat,crm_owners.skype as skype,crm_owners.nationality as nationality,crm_owners.nationality_1,crm_owners.address2_line_1 as address2_line_1,
					crm_owners.address2_line_2 as address2_line_2,crm_owners.address2_city as address2_city,
					crm_owners.address2_state as address2_state,crm_owners.address2_country as address2_country,crm_owners.address2_po_box as address2_po_box,

					 crm_owners.native_language as native_language,crm_owners.second_language as second_language,crm_owners.source_of_contact as source_of_contact,
					 crm_owners.contact_type as contact_type,crm_owners.dateadded as dateadded,CONCAT(crm_users.first_name, " ", crm_users.last_name) as created_by
                    ';

					$this->datatables->select($c)

						//->unset_column('id')//this means if you want to include in columns or search

						->from('crm_owners');

				$this->datatables->join('crm_users', 'crm_users.id = crm_owners.created_by', 'left');

						

				$this->datatables ->where('crm_owners.is_active', 1); 

				if($this->input->post('listing_type'))

				{

					if($this->input->post('listing_type') == 'b')

					{

						$this->datatables ->where('crm_owners.contact_type', 2); 

					}

					if($this->input->post('listing_type') == 'l')

					{

						$this->datatables ->where('crm_owners.contact_type', 3); 

						$this->datatables ->where('crm_owners.contact_type', 5); 

					}

					if($this->input->post('listing_type') == 's')

					{

						$this->datatables ->where('crm_owners.contact_type', 4); 

						$this->datatables ->where('crm_owners.contact_type', 5); 

					}

				}

				

					return $this->datatables->generate();

				

       }

	

	public function getSingleRow($id)

	{

		$this->db->select('*');

		$this->db->from('crm_owners');

		$where = "id=".$id;

		$this->db->where($where);

		

			$query = $this->db->get();

			 if( $query->num_rows() == 1 ){

			  // One row, match!

			  

				  $row =  $query->row(); 

				return array(

					'id'=> ''.$row->id.'',

					'client_id'=> ''.$row->client_id.'',

					'auto'=> ''.$row->auto.'',

					'rand_key'=> ''.$row->rand_key.'',

					'ref'=> ''.$row->ref.'',

					'title'=> ''.$row->title.'',

					'name'=> ''.$row->name.'',

					'last_name'=> ''.$row->last_name.'',

					'gender'=> ''.$row->gender.'',

					'mobile_no_new_ccode'=> ''.$row->mobile_no_new_ccode.'',

					'mobile_no_new'=> ''.$row->mobile_no_new.'',

					'mobile_no_new_ccode_2'=> ''.$row->mobile_no_new_ccode_2.'',

					'mobile_2'=> ''.$row->mobile_2.'',

					'mobile_no_new_ccode_3'=> ''.$row->mobile_no_new_ccode_3.'',

					'mobile_3'=> ''.$row->mobile_3.'',

					'c_code_phone_1'=> ''.$row->c_code_phone_1.'',

					'phone'=> ''.$row->phone.'',

					'c_code_phone_2'=> ''.$row->c_code_phone_2.'',

					'phone_2'=> ''.$row->phone_2.'',

					'c_code_phone_3'=> ''.$row->c_code_phone_3.'',

					'phone_3'=> ''.$row->phone_3.'',

					'email'=> ''.$row->email.'',

					'email_2'=> ''.$row->email_2.'',

					'email_3'=> ''.$row->email_3.'',

					'c_code_fax'=> ''.$row->c_code_fax.'',

					'fax'=> ''.$row->fax.'',

					'c_code_fax_2'=> ''.$row->c_code_fax_2.'',

					'fax_2'=> ''.$row->fax_2.'',

					'c_code_fax_3'=> ''.$row->c_code_fax_3.'',

					'fax_3'=> ''.$row->fax_3.'',

					'dateadded'=> ''.$row->dateadded.'',

					'dateupdated'=> ''.$row->dateupdated.'',

					'created_by'=> ''.$row->created_by.'',

					'agent_id'=> ''.$row->agent_id.'',

					'company'=> ''.$row->company.'',

					'address_line_1'=> ''.$row->address_line_1.'',

					'address_line_2'=> ''.$row->address_line_2.'',

					'address_city'=> ''.$row->address_city.'',

					'address_zip_po_box'=> ''.$row->address_zip_po_box.'',

					'address2_zip_po_box'=> ''.$row->address2_zip_po_box.'',

					'address_state'=> ''.$row->address_state.'',

					'address_country'=> ''.$row->address_country.'',

					'assigned_to_id'=> ''.$row->assigned_to_id.'',

					'notes'=> ''.$row->notes.'',

					'contact_type'=> ''.$row->contact_type.'',

					'nationality_new'=> ''.$row->nationality_new.'',

					'nationality'=> ''.$row->nationality.'',

					'nationality_1'=> ''.$row->nationality_1.'',

					'dob'=> ''.$row->dob.'',

					'religion'=> ''.$row->religion.'',

					'native_language'=> ''.$row->native_language.'',

					'language1'=> ''.$row->language1.'',

					'second_language'=> ''.$row->second_language.'',

					'hobbies'=> ''.$row->hobbies.'',

					'address'=> ''.$row->address.'',

					'address2'=> ''.$row->address2.'',

					'designation'=> ''.$row->designation.'',

					'website'=> ''.$row->website.'',

					'facebook'=> ''.$row->facebook.'',

					'twitter'=> ''.$row->twitter.'',

					'linkedin'=> ''.$row->linkedin.'',

					'googleplus'=> ''.$row->googleplus.'',

					'instagram'=> ''.$row->instagram.'',

					'wechat'=> ''.$row->wechat.'',

					'skype'=> ''.$row->skype.'',

					'source_of_contact'=> ''.$row->source_of_contact.'',

					'po_box'=> ''.$row->po_box.'',

					'address2_city'=> ''.$row->address2_city.'',

					'address2_state'=> ''.$row->address2_state.'',

					'address2_country'=> ''.$row->address2_country.'',

					'address2_line_1'=> ''.$row->address2_line_1.'',

					'address2_line_2'=> ''.$row->address2_line_2.'',

					'address2_po_box'=> ''.$row->address2_po_box.''

					);

				       

				} else {

				  // None

				  return 0;

				}

		

	}   

	public function ownedproperties()

	{

				

				$c ='crm_listings.id,crm_listings.ref,IF(crm_listings.type = 1, "Rental", "Sales") as type,crm_category.category as category_id,crm_city.name as region_id,crm_location.loc_name as area_location_id,crm_subloc.sub_sub_loc as sub_area_location_id,crm_listings.beds,crm_listings.size,crm_listings.price,CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id,crm_listings.dateadded';

					$this->datatables->select($c)

					->unset_column('crm_listings.id')//this means if you want to include in columns or search

						->from('crm_listings');

				$this->datatables->join('crm_category', 'crm_listings.category_id = crm_category.id', 'left');		

				$this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'LEFT');

				$this->datatables->join('crm_city', 'crm_city.id = crm_listings.region_id','LEFT');

				$this->datatables->join('crm_location ', 'crm_location.loc_id = crm_listings.area_location_id','LEFT');

				$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_listings.sub_area_location_id','LEFT');

						

				$this->datatables ->where('crm_listings.is_active', 1); 

				if($this->input->post('landlord_id'))

				{

					$landlord_id =  $this->input->post('landlord_id');

					$this->datatables ->where('crm_listings.landlord_id', $landlord_id); 

				}

				

					return $this->datatables->generate();

				

       }

	public function autoFindLead($term)

    {

		$req  = "SELECT id,ref FROM crm_leads WHERE ref LIKE '%".$term."%'";

		

		//echo $req;exit;

        $query = $this->db->query($req);

		//$row = $query->row();

		if((!$query->result())){

			echo 0;

		}else{

			foreach ($query->result() as $row)

			{

			$results[] = array(

                        'id' => $row->id,

                        'name' => $row->ref

						

						

                    );

       

		

			}

			 echo json_encode($results);

		}

			

    }

	

	public function get_contacts_stats($id)

	 {

		

		$this->db->where("landlord_id=".$id);

		$this->db->from('crm_listings');

		$listings = $this->db->count_all_results();

		

		

		$this->db->where("tenant_buyer_id=".$id." OR landlord_seller_id=".$id);

		$this->db->from('crm_deals');

		$deals = $this->db->count_all_results();

		

		

		

			 return array(

					'listings'=> ''.$listings.'',

					'deals'=> ''.$deals.''

					);

	 }

	 public function get_notes($id)

	 {

		   $queryNotes = $this->db->query("select r.notes,r.created_date,CONCAT(u.first_name, ' ', u.last_name) As user_name  FROM crm_contacts_notes r 

		   LEFT JOIN crm_users u on u.id=r.created_by  WHERE  r.listing_id=".$id." ORDER BY r.activitytime desc");

		   $results_notes = array();

			foreach ($queryNotes->result() as $rowNote)

			{

			   $date = date_create($rowNote->created_date);

               $mydt= date_format($date, 'Y-m-d H:i');

			   $results_notes[]=array('notes'=>$rowNote->notes, 'date'=>$mydt,'user_name'=>$rowNote->user_name);

			}

			$queryNotes->free_result();

			return $results_notes;

	 }

   public function save_documents($rand_key,$new_name,$listing_id,$title)

	{

		

			$admin_ID 	=  $this->session->userdata('userid');

			$client_id =$this->session->userdata('client_id');

			$dateadded	=	date('Y-m-d');

			//$xary = array('rand_key','rentals_id','created_date','image', 'thumb','watermark_image','created_by');

			

			$data = array(

					   

						'document_name' => $new_name,

						'title' => $title,

						'listing_id' => $listing_id,

						'rand_key' => $rand_key,

						'created_by' => $admin_ID,

						'client_id' => $client_id,

						'dateadded' => $dateadded

						

						

					);

			return  $this->db->insert('crm_contacts_documents', $data); // insert new record

			

		  

	}

}