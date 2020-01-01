<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Kevin

 * Description: Newsletters model class

 * echo $this->db->get_compiled_select();exit;

 */



class Newsletters_model extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();

	}



	public function GetListings($listingType)

	{

//,CASE type when 1 then "Rent" when 2 then "Sale" end as "Type"

		$c = 'crm_listings.id as id

		,crm_listings.type

		,crm_listings.status as status

		,crm_listings.ref as ref

		,CASE WHEN crm_listings.agent_id='.$admin_ID.' THEN crm_listings.unit ELSE "--" END AS unit,

		,crm_category.category as category

		,crm_city.name as region_id

		,crm_location.loc_name as area_location_id

		,crm_subloc.sub_sub_loc as sub_area_location_id

		,crm_listings.beds as beds

		,crm_listings.size as size

		,crm_listings.price as price

		,CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id

		,crm_listings.landlord_id as landlord_id		

		,crm_listings.photos as photos

		,crm_listings.dateadded as dateadded

		,crm_listings.dateupdated as dateupdated

		,CONCAT(crm_users.first_name, " ", crm_users.last_name) as user_id

		,crm_listings.key_location as key_location';

		//,crm_listings.development_unit_id as development_unit_id



		$this->datatables->select($c)

		//->unset_column('id')//this means if you want to include in columns or search

		->from('crm_listings');

		$this->datatables->join('crm_category', 'crm_listings.category_id = crm_category.id', 'left');

		$this->datatables->join('crm_city', 'crm_city.id = crm_listings.region_id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_listings.sub_area_location_id', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');

		//$this->datatables->join('crm_users', 'crm_users.id = crm_listings.created_by', 'left');



		$this->datatables->where('crm_listings.is_active', 1); 



		if($listingType != 0)

			$this->datatables->where('crm_listings.type', $listingType); 



		//echo $this->db->get_compiled_select();exit;



		return $this->datatables->generate();

	}



	public function GetContactData($id)

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



	public function GetContacts($contactType)

	{	

		$c ='crm_owners.id as id

		,crm_owners.contact_type as contact_type

		,crm_owners.name as name

		,crm_owners.last_name as last_name

		,crm_owners.company as company

		,crm_owners.phone as phone

		,crm_owners.mobile_no_new as mobile

		,crm_owners.email as email

		,crm_owners.dateadded as dateadded

		,CONCAT(crm_users.first_name, " ", crm_users.last_name) as created_by';



		$this->datatables->select($c)

			->from('crm_owners');

		$this->datatables->join('crm_users', 'crm_users.id = crm_owners.created_by', 'left');

		$this->datatables ->where('crm_owners.is_active', 1); 



		if($contactType != 0)

			$this->datatables ->where('crm_owners.contact_type', $contactType);



		return $this->datatables->generate();

	}

}

?>

