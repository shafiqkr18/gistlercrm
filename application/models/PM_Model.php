<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Muhammad Shafiq

 * Description: Common model class

 * Date: 23 Nov,2015
 // $this->db->select('*');

		// $this->db->from('table');

		// $this->db->where("parameter", $value);

		// echo $this->db->get_compiled_select();exit;

 */



class PM_Model extends CI_Model{

	function __construct(){

		parent::__construct();

	}



    public function GetListings($listingType){

		$c = 'crm_listings.id as id
		,crm_listings.type
		,crm_listings.status as status
		,crm_listings.ref as ref
		,crm_listings.unit as unit
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



	public function GetCategories(){

		$tableData = $this->db->get('crm_category');

		return $tableData->result_array();

	}



	public function SaveImages($rand_key,$new_name){        

		$admin_ID   =  $this->session->userdata('userid');

		$created_date   =   date('Y-m-d');

		//$xary = array('rand_key','rentals_id','created_date','image', 'thumb','watermark_image','created_by');
		$data = array(

			'rand_key' => $rand_key,

			'created_date' => $created_date,

			'image' => $new_name,

			'thumb' => $new_name,

			'watermark_image' => $new_name,

			'created_by' => $admin_ID

			);
			$this->db->insert('crm_pm_units_images', $data); // insert new record

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}



	public function SaveNewUnit($objUnit){

		$this->db->insert('crm_pm_units', $objUnit); // insert new record

		return $this->db->insert_id();

	}



	public function ImportUnit($listingID, $ref){

		$this->db->select('*');

		$this->db->from('crm_listings');

		$this->db->where('id', $listingID);

		$listingRecord = $this->db->get()->result_array()[0];
		$listingRecord["ref"] = $ref;   
		unset($listingRecord["id"]);
		$listingRecord["landlordId"] = $listingRecord["landlord_id"];

		unset($listingRecord["landlord_id"]);
		//echo var_dump($listingRecord);exit;

		// $this->db->insert('crm_pm_units', $listingRecord); // insert new record

		return $this->SaveRecord($listingRecord, 'crm_pm_units');

	}



	public function GetUnits($prop_status, $type){

				// ,CASE WHEN crm_pm_units.agent_id='.$admin_ID.' THEN crm_pm_units.unit ELSE "--" END AS unit


		$admin_ID 	= $this->session->userdata('userid');

		$c = 'crm_pm_units.id as id
		,crm_pm_units.type
		,crm_pm_units.status as crm_pm_units
		,crm_pm_units.ref as ref
		,crm_pm_units.unit
		,crm_category.category as category
		,crm_city.name as region_id
		,crm_location.loc_name as area_location_id
		,crm_subloc.sub_sub_loc as sub_area_location_id
		,crm_pm_units.beds as beds                           
		,crm_pm_units.size as size
		,crm_pm_units.price as price
		,CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id
		,crm_pm_units.landlord_name as landlord_name        
		,crm_pm_units.photos as photos
		,crm_pm_units.dateadded as dateadded
		,crm_pm_units.dateupdated as dateupdated
		,CONCAT(crm_users.first_name, " ", crm_users.last_name) as user_id
		,crm_pm_units.key_location as key_location';

		//,crm_pm_units.development_unit_id as development_unit_id
		$this->datatables->select($c)

		//->unset_column('id')//this means if you want to include in columns or search

		->from('crm_pm_units');

		$this->datatables->join('crm_category', 'crm_pm_units.category_id = crm_category.id', 'left');

		$this->datatables->join('crm_city', 'crm_city.id = crm_pm_units.region_id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_pm_units.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_units.agent_id', 'left');

		//$this->datatables->join('crm_users', 'crm_users.id = crm_pm_units.created_by', 'left');
		$this->datatables->where('crm_pm_units.is_active', 1); 
		if($prop_status != 0)

			$this->datatables->where('crm_pm_units.prop_status', $prop_status); 
		if($type != 0)

			$this->datatables->where('crm_pm_units.type', $type); 


//echo $this->db->get_compiled_select();exit;

		return $this->datatables->generate();

	}



	public function GetUnit($unitId){
		$c = 'crm_pm_units.*
		,crm_category.category as category
		,crm_location.loc_id
		,crm_location.loc_name as area_location_id
		,crm_subloc.sub_loc_id
		,crm_subloc.sub_sub_loc as sub_area_location_id
		,CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent_id
		,CONCAT(crm_users.first_name, " ", crm_users.last_name) as user_id
		,CONCAT(crm_pm_landlords.firstname, " ", crm_pm_landlords.lastname) as landlord_name';

		//,crm_pm_units.development_unit_id as development_unit_id
		$this->datatables->select($c)->from('crm_pm_units');

		$this->datatables->join('crm_category', 'crm_pm_units.category_id = crm_category.id', 'left');

		$this->datatables->join('crm_city', 'crm_city.id = crm_pm_units.region_id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_pm_units.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_units.agent_id', 'left');

		$this->datatables->join('crm_pm_landlords', 'crm_pm_landlords.id = crm_pm_units.landlordId', 'left');		

		//$this->datatables->join('crm_users', 'crm_users.id = crm_pm_units.created_by', 'left');

		$this->datatables->where('crm_pm_units.id', $unitId); 

		//echo $this->db->get_compiled_select();exit;

		$tableData = $this->db->get();
		$resArray["unitDetails"] = (count($tableData->result_array())>0)?$tableData->result_array()[0]:"";

		

		$pQuery = $this->db->get_where("crm_pm_units_images", array('rand_key =' => $resArray["unitDetails"]["rand_key"]));

		$resArray["unitPhotos"] = $pQuery->result_array();
		$c = "crm_pm_leases.id,

		crm_pm_leases.ref,

		concat(crm_pm_tenants.firstname, ' ', crm_pm_tenants.lastname) as tenant,

		crm_pm_leases.startdate,

		crm_pm_leases.enddate,

		crm_pm_leases.leaseamount,

		crm_pm_leases.commission";

		$this->datatables->select($c)->from('crm_pm_leases');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_pm_tenants', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->where('crm_pm_units.id', $unitId); 		

		$this->datatables->where('crm_pm_leases.enddate > now()'); 		

		$this->datatables->where('crm_pm_leases.startdate < now()'); 		
		$tableData = $this->db->get();
		$resArray["currentLease"] = (count($tableData->result_array()) > 0)?$tableData->result_array()[0]:"";
		$c = "crm_pm_leases.id,

		crm_pm_leases.ref,

		concat(crm_pm_tenants.firstname, ' ', crm_pm_tenants.lastname) as tenant,

		crm_pm_leases.startdate,

		crm_pm_leases.enddate,

		crm_pm_leases.leaseamount,

		crm_pm_leases.commission";

		$this->datatables->select($c)->from('crm_pm_leases');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_pm_tenants', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->where('crm_pm_units.id', $unitId); 		

		$this->datatables->where('crm_pm_leases.enddate < now()'); 		
		$tableData = $this->db->get();
		$resArray["previousLease"] = (count($tableData->result_array()) > 0)?$tableData->result_array()[0]:"";
		$c = "crm_pm_leases.id,

		crm_pm_leases.ref,

		concat(crm_pm_tenants.firstname, ' ', crm_pm_tenants.lastname) as tenant,

		crm_pm_leases.startdate,

		crm_pm_leases.enddate,

		crm_pm_leases.leaseamount,

		crm_pm_leases.commission";

		$this->datatables->select($c)->from('crm_pm_leases');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_pm_tenants', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->where('crm_pm_units.id', $unitId); 		

		$this->datatables->where('crm_pm_leases.startdate > now()'); 		
		$tableData = $this->db->get();
		$resArray["futureLease"] = (count($tableData->result_array()) > 0)?$tableData->result_array()[0]:"";
		$c = "crm_pm_workorders.id,

		crm_pm_workorders.ref,

		crm_pm_serviceproviders.serviceprovidername,

		crm_pm_workorders.type,

		crm_pm_workorders.subtype,

		crm_pm_workorders.enddate,

		crm_pm_workorders.cost,

		crm_pm_workorders.priority";

		$this->datatables->select($c)->from('crm_pm_workorders');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_workorders.unitId', 'left');

		$this->datatables->join('crm_pm_serviceproviders', 'crm_pm_serviceproviders.id = crm_pm_workorders.serviceproviderId', 'left');

		$this->datatables->where('crm_pm_units.id', $unitId); 		

		$this->datatables->where('crm_pm_workorders.status', 4); 

		$this->db->order_by("priority", "desc");	

		

		$tableData = $this->db->get();

		$resArray["completedWO"] = (count($tableData->result_array()) > 0)?$tableData->result_array():"";
		$c = "crm_pm_workorders.id,

		crm_pm_workorders.ref,

		crm_pm_serviceproviders.serviceprovidername,

		crm_pm_workorders.type,

		crm_pm_workorders.subtype,

		crm_pm_workorders.enddate,

		crm_pm_workorders.cost,

		crm_pm_workorders.priority";

		$this->datatables->select($c)->from('crm_pm_workorders');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_workorders.unitId', 'left');

		$this->datatables->join('crm_pm_serviceproviders', 'crm_pm_serviceproviders.id = crm_pm_workorders.serviceproviderId', 'left');

		$this->datatables->where('crm_pm_units.id', $unitId); 		

		$this->datatables->where('crm_pm_workorders.status', 3); 		

		$this->db->order_by("priority", "desc");	

		

		$tableData = $this->db->get();
		$resArray["inProgressWO"] = (count($tableData->result_array()) > 0)?$tableData->result_array():"";

		$q = $this->db->get_where("crm_pm_units_notes", array('unitId =' => $unitId));

		$resArray["unitNotes"] = (count($q->result_array()) > 0)?$q->result_array():"";				
		return $resArray;

	}



	public function GetTransactionsPerUnit($unitId){

		$c = "crm_pm_accounts.id,

		crm_pm_accounts.ref,

		crm_pm_accounts.transactiontype,

		crm_pm_accounts.type,

		crm_pm_accounts.subtype,

		crm_pm_accounts.from,

		crm_pm_accounts.to,

		crm_pm_accounts.mode,

		crm_pm_accounts.amount,

		crm_pm_units.ref as 'UnitRef',

		CONCAT(crm_users.first_name, ' ', crm_users.last_name) as 'CreatedBy',

		crm_pm_accounts.dateadded,

		crm_pm_accounts.dateupdated";
		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_accounts.unitId', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_accounts.created_by', 'left');

		$this->datatables->where("crm_pm_units.id", $unitId);

		

		// $tableData = $this->db->get();
		// $resArray["transactionDetails"] = (count($tableData->result_array()) > 0)?$tableData->result_array():"";
		return $this->datatables->generate();

	}



	public function GetLeases($unitId){      
		$c = "crm_pm_leases.id,

		crm_pm_units.prop_status as 'status',  

		crm_pm_leases.ref,  

		crm_pm_units.unit,

		crm_category.category,

		crm_city.name as 'Emirate',

		crm_location.loc_name as 'Location',

		crm_subloc.sub_sub_loc as 'Sub-Location',

		crm_pm_units.beds,

		crm_pm_units.landlord_name as 'Owner',

		crm_pm_leases.enddate as 'Next Available',

		CONCAT(crm_users.first_name, ' ', crm_users.last_name) as 'PropertyMgr'";
		$this->datatables->select($c)->from('crm_pm_leases');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_category', 'crm_category.id = crm_pm_units.category_id', 'left');

		$this->datatables->join('crm_city', 'crm_city.id = crm_pm_units.region_id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_pm_units.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_units.agent_id', 'left');
		if($unitId != 0)

			$this->datatables->where('crm_pm_leases.unitId', $unitId);
			//echo $this->db->get_compiled_select();exit;

		return $this->datatables->generate();

	}



	public function GetLease($leaseId){

		$c = "crm_pm_leases.id,  

		crm_pm_leases.ref,  

		crm_pm_leases.rand_key,

		crm_pm_units.unit,

		crm_pm_leases.startdate,

		crm_pm_leases.enddate,

		crm_pm_leases.leaseamount,

		crm_pm_leases.deposit_percentage,deposit_amount,

		crm_pm_leases.fees_percentage,fees_amount,

		crm_pm_leases.commission,

		crm_pm_leases.paymentmode,

		crm_pm_leases.paymentterm,

		crm_pm_leases.cheques,

		crm_pm_leases.sourceoftenancy,

		crm_pm_leases.depositheldby,

		crm_pm_leases.ejaristatus,

		crm_pm_leases.ejarinumber,

		crm_pm_leases.reminder,

		crm_pm_leases.dateadded,

		crm_pm_leases.created_by";

		$this->datatables->select($c)->from('crm_pm_leases');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->where("crm_pm_leases.id", $leaseId);

                                                                                                                                                                                                                       		$tableData = $this->db->get();
		$resArray["leaseDetails"] = (count($tableData->result_array())>0)?$tableData->result_array()[0]:"";
		$c = "`crm_pm_units`.`id` as `unitId`
		, `crm_pm_units`.`ref` as `unitRefNo`
		, `crm_pm_units`.`type`
		, `crm_category`.`category`
		, crm_city.name as 'Emirate'
		, crm_location.loc_name as 'Location'
		, crm_subloc.sub_sub_loc as 'SubLocation'
		, `crm_pm_units`.`beds`
		, crm_pm_units.landlord_name as 'Owner'
		, CONCAT(crm_users.first_name, ' ', crm_users.last_name) as 'PropertyMgr'";

		$this->datatables->select($c)->from('crm_pm_units');

		$this->datatables->join('crm_category', 'crm_category.id = crm_pm_units.category_id', 'left');

		$this->datatables->join('crm_city', 'crm_city.id = crm_pm_units.region_id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_pm_units.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_units.agent_id', 'left');     

		$this->datatables->join('crm_pm_leases', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->where("crm_pm_leases.id", $leaseId);

		$tableData = $this->db->get();
		$resArray["unitDetails"] = (count($tableData->result_array())>0)?$tableData->result_array()[0]:"";
		$c = "crm_pm_tenants.id, 

		crm_pm_tenants.ref,  

		crm_pm_tenants.salutation, 

		crm_pm_tenants.title, 

		crm_pm_tenants.firstname, 

		crm_pm_tenants.lastname, 

		crm_pm_tenants.nationality, 

		crm_pm_tenants.dob, 

		crm_pm_tenants.countrycode1, 

		crm_pm_tenants.mobilenumber1, 

		crm_pm_tenants.email";

		$this->datatables->select($c)->from('crm_pm_tenants');

		$this->datatables->join('crm_pm_leases', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->where("crm_pm_leases.id", $leaseId);

		$tableData = $this->db->get();	

		$resArray["tenantDetails"] = (count($tableData->result_array())>0)?$tableData->result_array()[0]:"";
		$q = $this->db->get_where("crm_pm_lease_notes", array('leaseId =' => $leaseId));

		$resArray["leaseNotes"] = (count($q->result_array()) > 0)?$q->result_array():"";
		//$q = $this->db->get_where(" ", array('leaseId =' => $leaseId));

		$resArray["leaseDocuments"] = (count($q->result_array()) > 0)?$q->result_array():"";
		return $resArray;
		//TODO: get tenant, notes and documents for this leaseId

	}



	public function SaveUnitNote($objNote){

		$this->db->insert('crm_pm_units_notes', $objNote);
		return $this->GetUnit($objNote["unitId"]);

	}



	public function SaveLeaseNote($objNote){

		$this->db->insert('crm_pm_lease_notes', $objNote);
		return $this->GetLease($objNote["leaseId"]);

	}



	public function SaveLeaseDocument(){

	}  



	#SaveRecord

	public function SaveRecord($objRecord, $tablename){

		$q = $this->db->get_where($tablename, array('ref =' => $objRecord["ref"]));
		if($q->num_rows() > 0)

			$this->db->where('ref', $objRecord["ref"])->update($tablename, $objRecord); // update existing record        

		else{

			unset($objRecord["id"]);

			$this->db->insert($tablename, $objRecord); // insert new record        

		}

		

		return $this->db->insert_id();

	}



	public function GetWorkOrders($unitId){

		$c = "crm_pm_workorders.id,

		crm_pm_workorders.ref,  

		crm_pm_workorders.status,  

		crm_pm_workorders.priority,  

		crm_pm_units.unit,

		crm_category.category,

		crm_city.name as 'Emirate',

		crm_location.loc_name as 'Location',

		crm_subloc.sub_sub_loc as 'Sub-Location',

		'Service Provider' as serviceprovider,

		crm_pm_workorders.type,

		crm_pm_workorders.subtype,

		crm_pm_workorders.paymentstatus,

		CONCAT(crm_users.first_name, ' ', crm_users.last_name) as 'PropertyMgr',

		'Current Tenant' as currenttenant,

		crm_pm_workorders.dateupdated

		";
		$this->datatables->select($c)->from('crm_pm_workorders');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_workorders.unitId', 'left');

		$this->datatables->join('crm_category', 'crm_category.id = crm_pm_units.category_id', 'left');

		$this->datatables->join('crm_city', 'crm_city.id = crm_pm_units.region_id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_pm_units.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_units.agent_id', 'left');
		if($unitId != 0)

			$this->db->where('crm_pm_workorders.unitId', $unitId);
		$this->db->order_by("priority", "desc");
			//echo $this->db->get_compiled_select();exit;

		return $this->datatables->generate();

	}



	public function GetWorkOrder($workorderID){

		$c = "crm_pm_workorders.id,  

		crm_pm_workorders.ref,  

		crm_pm_workorders.rand_key,

		crm_pm_units.unit,

		crm_pm_workorders.serviceproviderId,

		crm_pm_workorders.startdate,

		crm_pm_workorders.enddate,

		crm_pm_workorders.description,

		crm_pm_workorders.type,

		crm_pm_workorders.subtype,

		crm_pm_workorders.assignedto,

		crm_pm_workorders.status,

		crm_pm_workorders.cost,

		crm_pm_workorders.paidby,

		crm_pm_workorders.paymentstatus,

		crm_pm_workorders.priority,

		crm_pm_workorders.dateadded,

		crm_pm_workorders.created_by";

		$this->datatables->select($c)->from('crm_pm_workorders');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id =  crm_pm_workorders.unitId', 'left');

		$this->datatables->where("crm_pm_workorders.id", $workorderID);

		$tableData = $this->db->get();
		$resArray["workorderDetails"] = (count($tableData->result_array())>0)?$tableData->result_array()[0]:"";
		$c = "`crm_pm_units`.`id` as `unitId`
		, `crm_pm_units`.`ref` as `unitRefNo`
		, `crm_pm_units`.`type`
		, `crm_category`.`category`
		, crm_city.name as 'Emirate'
		, crm_location.loc_name as 'Location'
		, crm_subloc.sub_sub_loc as 'SubLocation'
		, `crm_pm_units`.`beds`
		, crm_pm_units.landlord_name as 'Owner'
		, CONCAT(crm_users.first_name, ' ', crm_users.last_name) as 'PropertyMgr'";

		$this->datatables->select($c)->from('crm_pm_units');

		$this->datatables->join('crm_category', 'crm_category.id = crm_pm_units.category_id', 'left');

		$this->datatables->join('crm_city', 'crm_city.id = crm_pm_units.region_id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_pm_units.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_units.agent_id', 'left');     

		$this->datatables->join('crm_pm_workorders', 'crm_pm_units.id = crm_pm_workorders.unitId', 'left');

		$this->datatables->where("crm_pm_workorders.id", $workorderID);

		$tableData = $this->db->get();
		$resArray["unitDetails"] = (count($tableData->result_array())>0)?$tableData->result_array()[0]:"";
		$q = $this->db->get_where("crm_pm_workorders_notes", array('workorderID =' => $workorderID));

		$resArray["workOrderNotes"] = (count($q->result_array()) > 0)?$q->result_array():"";
		//$q = $this->db->get_where(" ", array('workorderID =' => $workorderID));

		$resArray["leaseDocuments"] = (count($q->result_array()) > 0)?$q->result_array():"";
		$c = "crm_pm_accounts.id,

		crm_pm_accounts.ref,

		crm_pm_accounts.transactiontype,

		crm_pm_accounts.type,

		crm_pm_accounts.subtype,

		crm_pm_accounts.amount,

		crm_pm_accounts.status

		";

		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_workorders', 'crm_pm_accounts.unitId = crm_pm_workorders.unitId', 'left');

		$this->datatables->where("crm_pm_workorders.id", $workorderID);

		$tableData = $this->db->get();
		$resArray["transactionDetails"] = (count($tableData->result_array()) > 0)?$tableData->result_array():"";
		$c = "crm_pm_serviceproviders.id,

		crm_pm_serviceproviders.ref,

		crm_pm_serviceproviders.serviceprovidername,

		crm_pm_serviceproviders.type,

		crm_pm_serviceproviders.subtypes,

		crm_pm_serviceproviders.firstname,

		crm_pm_serviceproviders.lastname,

		concat('+', crm_pm_serviceproviders.countrycode1, crm_pm_serviceproviders.mobilenumber1) as mobilenumber,

		crm_pm_serviceproviders.email";

		$this->datatables->select($c)->from('crm_pm_serviceproviders');

		$this->datatables->join('crm_pm_workorders', 'crm_pm_serviceproviders.id = crm_pm_workorders.serviceproviderId', 'left');

		$this->datatables->where("crm_pm_workorders.id", $workorderID);

		$tableData = $this->db->get();
		$resArray["serviceproviderDetails"] = (count($tableData->result_array()) > 0)?$tableData->result_array()[0]:"";


return $resArray;
//TODO: get tenant, notes and documents for this workorderID

	}



	public function SaveWorkOrderNote($objNote){

		$this->db->insert('crm_pm_workorders_notes', $objNote);
		return $this->GetLease($objNote["workorderID"]);

	}    



	#GetMaxCounts

	public function GetMaxId($tablename){

		return $this->db->count_all($tablename);

	}



	public function GetTransactions($transactiontype){

		$c = "crm_pm_accounts.id,

		crm_pm_accounts.ref,

		crm_pm_accounts.transactiontype,

		crm_pm_accounts.type,

		crm_pm_accounts.subtype,

		crm_pm_accounts.from,

		crm_pm_accounts.to,

		crm_pm_accounts.mode,

		crm_pm_accounts.amount,

		crm_pm_units.ref as 'UnitRef',

		CONCAT(crm_users.first_name, ' ', crm_users.last_name) as 'CreatedBy',

		crm_pm_accounts.dateadded,

		crm_pm_accounts.dateupdated";
		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_accounts.unitId', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_accounts.created_by', 'left');
		if($transactiontype)

			$this->datatables->where("crm_pm_accounts.transactiontype", $transactiontype);
			//echo $this->db->get_compiled_select();exit;

		return $this->datatables->generate();

	}



	public function GetTransaction($transactionId){

		$c = "crm_pm_accounts.id,  

		crm_pm_accounts.ref,  

		crm_pm_accounts.rand_key,

		crm_pm_units.unit,

		crm_pm_accounts.leaseId,

		crm_pm_accounts.transactiontype,

		crm_pm_accounts.type,

		crm_pm_accounts.subtype,

		crm_pm_accounts.from,

		crm_pm_accounts.to,

		crm_pm_accounts.amount,

		crm_pm_accounts.mode,

		crm_pm_accounts.status,

		crm_pm_accounts.memo,

		crm_pm_accounts.dateupdated,

		crm_pm_accounts.dateadded,

		CONCAT(crm_users.first_name, ' ', crm_users.last_name) as 'CreatedBy'";

		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id =  crm_pm_accounts.unitId', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_accounts.created_by', 'left');		

		$this->datatables->where("crm_pm_accounts.id", $transactionId);

		$tableData = $this->db->get();
		$resArray["transactionDetails"] =  (count($tableData->result_array()) > 0)?$tableData->result_array()[0]:"";
		$c = "`crm_pm_units`.`id` as `unitId`
		, `crm_pm_units`.`ref` as `unitRefNo`
		, `crm_pm_units`.`type`
		, `crm_category`.`category`
		, crm_city.name as 'Emirate'
		, crm_location.loc_name as 'Location'
		, crm_subloc.sub_sub_loc as 'SubLocation'
		, `crm_pm_units`.`beds`
		, crm_pm_units.landlord_name as 'Owner'
		, CONCAT(crm_users.first_name, ' ', crm_users.last_name) as 'PropertyMgr'";

		$this->datatables->select($c)->from('crm_pm_units');

		$this->datatables->join('crm_category', 'crm_category.id = crm_pm_units.category_id', 'left');

		$this->datatables->join('crm_city', 'crm_city.id = crm_pm_units.region_id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_pm_units.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_units.agent_id', 'left');     

		$this->datatables->join('crm_pm_accounts', 'crm_pm_units.id = crm_pm_accounts.unitId', 'left');

		$this->datatables->where("crm_pm_accounts.id", $transactionId);

		

		$tableData = $this->db->get();
		$resArray["unitDetails"] =  (count($tableData->result_array()) > 0)?$tableData->result_array()[0]:"";
		$c = "crm_pm_leases.id as leaseId,

		crm_pm_leases.ref,

		crm_pm_leases.startdate,

		crm_pm_leases.enddate,

		crm_pm_leases.leaseamount,

		crm_pm_leases.fees_percentage,

		crm_pm_leases.fees_amount,

		crm_pm_leases.paymentmode,

		crm_pm_leases.paymentterm,

		crm_pm_leases.ejaristatus";

		$this->datatables->select($c)->from('crm_pm_leases');

		$this->datatables->join('crm_pm_accounts', 'crm_pm_leases.id = crm_pm_accounts.leaseId', 'left');

		// $this->datatables->join('crm_pm_tenants', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->where("crm_pm_accounts.id", $transactionId);
		$tableData = $this->db->get();

		$resArray["leaseDetails"] =  (count($tableData->result_array()) > 0)?$tableData->result_array()[0]:"";
		$c = "crm_pm_tenants.id, 

		crm_pm_tenants.ref,  

		crm_pm_tenants.salutation, 

		crm_pm_tenants.title, 

		crm_pm_tenants.firstname, 

		crm_pm_tenants.lastname, 

		crm_pm_tenants.nationality, 

		crm_pm_tenants.dob, 

		crm_pm_tenants.countrycode1, 

		crm_pm_tenants.mobilenumber1, 

		crm_pm_tenants.email";

		$this->datatables->select($c)->from('crm_pm_tenants');

		$this->datatables->join('crm_pm_leases', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->join('crm_pm_accounts', 'crm_pm_leases.id = crm_pm_accounts.leaseId', 'left');

		// $this->datatables->join('crm_pm_tenants', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->where("crm_pm_accounts.id", $transactionId);

		$tableData = $this->db->get();	

		$resArray["tenantDetails"] =  (count($tableData->result_array()) > 0)?$tableData->result_array()[0]:"";
		$q = $this->db->get_where("crm_pm_accounts_notes", array('accountId =' => $transactionId));

		$resArray["accountNotes"] = (count($q->result_array()) > 0)?$q->result_array():"";
		// //$q = $this->db->get_where(" ", array('workorderID =' => $workorderID));

		// $resArray["leaseDocuments"] = (count($q->result_array()) > 0)?$q->result_array():"";
		return $resArray;

	}



	public function SaveTransactionNote($objNote){

		$this->db->insert('crm_pm_accounts_notes', $objNote);
		return $this->GetTransaction($objNote["transactionId"]);

	}



	public function GetLandlords(){

		$c = "crm_pm_landlords.id,

		crm_pm_landlords.ref,

		crm_pm_landlords.firstname,

		crm_pm_landlords.lastname,

		concat(crm_pm_landlords.countrycode1, crm_pm_landlords.mobilenumber1) as mobilenumber,

		crm_pm_landlords.dob,

		crm_pm_landlords.email,

		crm_pm_landlords.nationality,

		crm_pm_landlords.dateadded,

		crm_pm_landlords.dateupdated";
		$this->datatables->select($c)->from('crm_pm_landlords');
		//echo $this->db->get_compiled_select();exit;

		return $this->datatables->generate();

	} 	



	public function GetLandlord($landlordId){

		$c = "crm_pm_landlords.id,

		crm_pm_landlords.rand_key,

		crm_pm_landlords.ref,

		crm_pm_landlords.salutation,

		crm_pm_landlords.title,

		crm_pm_landlords.firstname,

		crm_pm_landlords.lastname,

		crm_pm_landlords.nationality,

		crm_pm_landlords.dob,

		crm_pm_landlords.email,

		crm_pm_landlords.countrycode1,

		crm_pm_landlords.mobilenumber1,

		crm_pm_landlords.countrycode2,

		crm_pm_landlords.mobilenumber2,

		crm_pm_landlords.countrycode3,

		crm_pm_landlords.mobilenumber3";

		$this->datatables->select($c)->from('crm_pm_landlords');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.landlordId =  crm_pm_landlords.id', 'left');

		$this->datatables->where("crm_pm_landlords.id", $landlordId);

		$tableData = $this->db->get();
		$resArray["landlordDetails"] = (count($tableData->result_array())>0)?$tableData->result_array()[0]:"";
		$c = "crm_pm_units.id as unitId,

		crm_pm_units.ref as unitRefNo,

		concat(crm_pm_units.unit, ' - ', crm_subloc.sub_sub_loc) as unit";

		$this->datatables->select($c)->from('crm_pm_units');    

		$this->datatables->join('crm_pm_landlords', 'crm_pm_units.landlordId = crm_pm_landlords.id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_pm_units.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');		

		$this->datatables->where("crm_pm_landlords.id", $landlordId);

			

		$tableData = $this->db->get();
		$resArray["unitDetails"] = $tableData->result_array();
		$c = "crm_pm_units.ref as 'unitref'
		,concat(crm_pm_units.unit, ' ',crm_subloc.sub_sub_loc) as 'unittitle'
		,crm_pm_accounts.transactiontype
		,crm_pm_accounts.type
		,crm_pm_accounts.subtype
		,crm_pm_accounts.amount";

		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_leases', 'crm_pm_leases.id = crm_pm_accounts.leaseId', 'left');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_pm_landlords', 'crm_pm_landlords.id = crm_pm_units.landlordId', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->where("crm_pm_landlords.id", $landlordId);

		$tableData = $this->db->get();
		$resArray["accountDetails"] = $tableData->result_array();
		$c = "crm_pm_units.ref as 'unitref'
		,concat(crm_pm_units.unit, ' ',crm_subloc.sub_sub_loc) as 'unittitle'
		,crm_pm_accounts.transactiontype
		,crm_pm_accounts.type
		,crm_pm_accounts.subtype
		,crm_pm_accounts.amount";

		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_leases', 'crm_pm_leases.id = crm_pm_accounts.leaseId', 'left');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_pm_landlords', 'crm_pm_landlords.id = crm_pm_units.landlordId', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->where("crm_pm_landlords.id", $landlordId);

		$this->datatables->where("crm_pm_accounts.status", 2);

		$tableData = $this->db->get();
		$resArray["pendingDetails"] = $tableData->result_array();
		$c = "crm_pm_units.ref as 'unitref'
		,concat(crm_pm_units.unit, ' ',crm_subloc.sub_sub_loc) as 'unittitle'
		,crm_pm_accounts.transactiontype
		,crm_pm_accounts.type
		,crm_pm_accounts.subtype
		,crm_pm_accounts.amount";

		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_leases', 'crm_pm_leases.id = crm_pm_accounts.leaseId', 'left');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_pm_landlords', 'crm_pm_landlords.id = crm_pm_units.landlordId', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->where("crm_pm_landlords.id", $landlordId);

		$this->datatables->where("crm_pm_accounts.status", 1);

		$tableData = $this->db->get();
		$resArray["paidDetails"] = $tableData->result_array();
		$q = $this->db->get_where("crm_pm_landlords_notes", array('landlordId =' => $landlordId));

		$resArray["landlordNotes"] = (count($q->result_array()) > 0)?$q->result_array():"";
		// //$q = $this->db->get_where(" ", array('workorderID =' => $workorderID));

		// $resArray["leaseDocuments"] = (count($q->result_array()) > 0)?$q->result_array():"";
		return $resArray;
		// //TODO: get tenant, notes and documents for this workorderID

	}



	public function SaveLandlordNote($objNote){

		$this->db->insert('crm_pm_landlords_notes', $objNote);
		return $this->GetLandlord($objNote["landlordId"]);

	}	



	public function GetTenants(){

		$c = "crm_pm_tenants.id,

		crm_pm_tenants.ref,

		crm_pm_tenants.firstname,

		crm_pm_tenants.lastname,

		concat(crm_pm_tenants.countrycode1, crm_pm_tenants.mobilenumber1) as mobilenumber,

		crm_pm_tenants.dob,

		crm_pm_tenants.email,

		crm_pm_tenants.nationality,

		crm_pm_tenants.dateadded,

		crm_pm_tenants.dateupdated";
		$this->datatables->select($c)->from('crm_pm_tenants');
		//echo $this->db->get_compiled_select();exit;

		return $this->datatables->generate();

	} 	



	public function GetTenant($tenantId){

		$c = "crm_pm_tenants.id,

		crm_pm_tenants.ref,

		crm_pm_tenants.salutation,

		crm_pm_tenants.title,

		crm_pm_tenants.firstname,

		crm_pm_tenants.lastname,

		crm_pm_tenants.nationality,

		crm_pm_tenants.dob,

		crm_pm_tenants.email,

		crm_pm_tenants.countrycode1,

		crm_pm_tenants.mobilenumber1,

		crm_pm_tenants.countrycode2,

		crm_pm_tenants.mobilenumber2,

		crm_pm_tenants.countrycode3,

		crm_pm_tenants.mobilenumber3";

		$this->datatables->select($c)->from('crm_pm_tenants');

		$this->datatables->where("crm_pm_tenants.id", $tenantId);

		//echo $this->db->get_compiled_select();exit;

		$tableData = $this->db->get();
		$resArray["tenantDetails"] = (count($tableData->result_array())>0)?$tableData->result_array()[0]:"";
		$c = "crm_pm_units.id as unitId,

		crm_pm_units.ref as unitRefNo,

		concat(crm_pm_units.unit, ' - ', crm_subloc.sub_sub_loc) as unit";

		$this->datatables->select($c)->from('crm_pm_units');

		$this->datatables->join('crm_pm_leases', 'crm_pm_leases.unitId = crm_pm_units.id', 'left');

		$this->datatables->join('crm_pm_tenants', 'crm_pm_leases.tenantId = crm_pm_tenants.id', 'left');

		$this->datatables->join('crm_location', 'crm_location.loc_id = crm_pm_units.area_location_id', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');		

		$this->datatables->where("crm_pm_tenants.id", $tenantId);

			

		$tableData = $this->db->get();
		$resArray["unitDetails"] = $tableData->result_array();
		$c = "crm_pm_units.ref as 'unitref'
		,concat(crm_pm_units.unit, ' ',crm_subloc.sub_sub_loc) as 'unittitle'
		,crm_pm_accounts.transactiontype
		,crm_pm_accounts.type
		,crm_pm_accounts.subtype
		,crm_pm_accounts.amount";

		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_leases', 'crm_pm_leases.id = crm_pm_accounts.leaseId', 'left');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_pm_tenants', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->where("crm_pm_tenants.id", $tenantId);

		$tableData = $this->db->get();
		$resArray["accountDetails"] = $tableData->result_array();
		$c = "crm_pm_units.ref as 'unitref'
		,concat(crm_pm_units.unit, ' ',crm_subloc.sub_sub_loc) as 'unittitle'
		,crm_pm_accounts.transactiontype
		,crm_pm_accounts.type
		,crm_pm_accounts.subtype
		,crm_pm_accounts.amount";

		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_leases', 'crm_pm_leases.id = crm_pm_accounts.leaseId', 'left');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_pm_tenants', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->where("crm_pm_tenants.id", $tenantId);

		$this->datatables->where("crm_pm_accounts.status", 2);		

		$tableData = $this->db->get();
		$resArray["pendingDetails"] = $tableData->result_array();
		$c = "crm_pm_units.ref as 'unitref'
		,concat(crm_pm_units.unit, ' ',crm_subloc.sub_sub_loc) as 'unittitle'
		,crm_pm_accounts.transactiontype
		,crm_pm_accounts.type
		,crm_pm_accounts.subtype
		,crm_pm_accounts.amount";

		$this->datatables->select($c)->from('crm_pm_accounts');

		$this->datatables->join('crm_pm_leases', 'crm_pm_leases.id = crm_pm_accounts.leaseId', 'left');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_leases.unitId', 'left');

		$this->datatables->join('crm_pm_tenants', 'crm_pm_tenants.id = crm_pm_leases.tenantId', 'left');

		$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = crm_pm_units.sub_area_location_id', 'left');

		$this->datatables->where("crm_pm_tenants.id", $tenantId);

		$this->datatables->where("crm_pm_accounts.status", 1);		

		$tableData = $this->db->get();
		$resArray["paidDetails"] = $tableData->result_array();				


// $q = $this->db->get_where("crm_pm_tenants_notes", array('tenantId =' => $tenantId));

		$resArray["tenantNotes"] = "";
		// //$q = $this->db->get_where(" ", array('workorderID =' => $workorderID));

		// $resArray["leaseDocuments"] = (count($q->result_array()) > 0)?$q->result_array():"";
		return $resArray;
		// //TODO: get tenant, notes and documents for this workorderID

	}



	public function SaveTenantNote($objNote){

		$this->db->insert('crm_pm_tenants_notes', $objNote);
		return $this->GetTenant($objNote["tenantId"]);

	}



	public function GetServiceProviders(){

		$c = "crm_pm_serviceproviders.id,
		crm_pm_serviceproviders.ref,
		crm_pm_serviceproviders.serviceprovidername,
		crm_pm_work_types.name as type,
		crm_pm_work_subtypes.name as subtypes,
		crm_pm_serviceproviders.firstname,
		crm_pm_serviceproviders.lastname,
		concat('+', crm_pm_serviceproviders.countrycode1, crm_pm_serviceproviders.mobilenumber1) as mobilenumber,
		crm_pm_serviceproviders.email,
		crm_pm_serviceproviders.dateadded,
		crm_pm_serviceproviders.dateupdated";

		$this->datatables->select($c)->from('crm_pm_serviceproviders');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_serviceproviders.created_by', 'left');
		$this->datatables->join('crm_pm_work_types', 'crm_pm_work_types.id = crm_pm_serviceproviders.type', 'left');
		$this->datatables->join('crm_pm_work_subtypes', 'crm_pm_work_subtypes.id = crm_pm_serviceproviders.subtypes', 'left');


// echo $this->db->get_compiled_select();exit;

		return $this->datatables->generate();

	}	



	public function GetServiceProvider($serviceproviderId){
		$c = "crm_pm_serviceproviders.id,

		crm_pm_serviceproviders.ref,

		crm_pm_serviceproviders.serviceprovidername,

		crm_pm_serviceproviders.type,

		crm_pm_serviceproviders.subtypes,

		crm_pm_serviceproviders.firstname,

		crm_pm_serviceproviders.lastname,

		crm_pm_serviceproviders.countrycode1,

		crm_pm_serviceproviders.mobilenumber1,

		crm_pm_serviceproviders.email,

		crm_pm_serviceproviders.address,

		crm_pm_serviceproviders.accountnumber,

		CONCAT(crm_users.first_name, ' ', crm_users.last_name) as 'CreatedBy',

		crm_pm_serviceproviders.dateadded,

		crm_pm_serviceproviders.dateupdated";
		$this->datatables->select($c)->from('crm_pm_serviceproviders');

		$this->datatables->join('crm_users', 'crm_users.id = crm_pm_serviceproviders.created_by', 'left');

		$this->datatables->where("crm_pm_serviceproviders.id", $serviceproviderId);

		

		$tableData = $this->db->get();
		$resArray["spDetails"] = (count($tableData->result_array()) > 0)?$tableData->result_array()[0]:"";
		$c = "crm_pm_serviceproviders.id,

		crm_pm_workorders.ref,

		concat(crm_pm_units.unit, ' - ', crm_subloc.sub_sub_loc) as 'unit',

		crm_pm_workorders.type,

		crm_pm_workorders.subtype,

		crm_pm_workorders.priority";

		$this->datatables->select($c)->from('crm_pm_serviceproviders');

		$this->datatables->join('crm_pm_workorders', 'crm_pm_serviceproviders.id = crm_pm_workorders.serviceproviderId', 'left');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_workorders.unitId', 'left');

		$this->datatables->join('crm_subloc', 'crm_pm_units.sub_area_location_id = crm_subloc.sub_loc_id', 'left');

		$this->datatables->where("crm_pm_serviceproviders.id", $serviceproviderId);

		$this->datatables->where("crm_pm_workorders.status", 2);

		//echo $this->db->get_compiled_select();exit;

		$tableData = $this->db->get();
		$resArray["workOrderInProgress"] = (count($tableData->result_array()) > 0)?$tableData->result_array():"";
		$c = "crm_pm_serviceproviders.id,

		crm_pm_workorders.ref,

		concat(crm_pm_units.unit, ' - ', crm_subloc.sub_sub_loc) as 'unit',

		crm_pm_workorders.type,

		crm_pm_workorders.subtype,

		crm_pm_workorders.priority";

		$this->datatables->select($c)->from('crm_pm_serviceproviders');

		$this->datatables->join('crm_pm_workorders', 'crm_pm_serviceproviders.id = crm_pm_workorders.serviceproviderId', 'left');

		$this->datatables->join('crm_pm_units', 'crm_pm_units.id = crm_pm_workorders.unitId', 'left');

		$this->datatables->join('crm_subloc', 'crm_pm_units.sub_area_location_id = crm_subloc.sub_loc_id', 'left');

		$this->datatables->where("crm_pm_serviceproviders.id", $serviceproviderId);

		$this->datatables->where("crm_pm_workorders.status", 3);

		//echo $this->db->get_compiled_select();exit;

		$tableData = $this->db->get();
		$resArray["workOrderCompleted"] = (count($tableData->result_array()) > 0)?$tableData->result_array():"";
		$c = "crm_pm_accounts.ref,

		crm_pm_accounts.type,

		crm_pm_accounts.subtype,

		crm_pm_accounts.amount";

		$this->datatables->select($c)->from('crm_pm_serviceproviders');

		$this->datatables->join('crm_pm_accounts', 'crm_pm_serviceproviders.id = crm_pm_accounts.to', 'left');

		$this->datatables->where("crm_pm_serviceproviders.id", $serviceproviderId);

		$tableData = $this->db->get();

		$resArray["allTransactions"] = (count($tableData->result_array()) > 0)?$tableData->result_array():"";
		$c = "crm_pm_accounts.ref,

		crm_pm_accounts.type,

		crm_pm_accounts.subtype,

		crm_pm_accounts.amount";

		$this->datatables->select($c)->from('crm_pm_serviceproviders');

		$this->datatables->join('crm_pm_accounts', 'crm_pm_serviceproviders.id = crm_pm_accounts.to', 'left');

		$this->datatables->where("crm_pm_serviceproviders.id", $serviceproviderId);		

		$this->datatables->where("crm_pm_accounts.status", 1);

		$tableData = $this->db->get();
		$resArray["pendingTransactions"] = (count($tableData->result_array()) > 0)?$tableData->result_array():"";
		$c = "crm_pm_accounts.ref,

		crm_pm_accounts.type,

		crm_pm_accounts.subtype,

		crm_pm_accounts.amount";

		$this->datatables->select($c)->from('crm_pm_serviceproviders');

		$this->datatables->join('crm_pm_accounts', 'crm_pm_serviceproviders.id = crm_pm_accounts.to', 'left');

		$this->datatables->where("crm_pm_serviceproviders.id", $serviceproviderId);		

		$this->datatables->where("crm_pm_accounts.status", 2);

		$tableData = $this->db->get();

		

		$resArray["paidTransactions"] = (count($tableData->result_array()) > 0)?$tableData->result_array():"";
		$q = $this->db->get_where("crm_pm_serviceproviders_notes", array('serviceproviderId =' => $serviceproviderId));

		$resArray["spNotes"] = (count($q->result_array()) > 0)?$q->result_array():"";		
		return $resArray;		

	}	



	public function SaveServiceProviderNote($objNote){

		$this->db->insert('crm_pm_serviceproviders_notes', $objNote);
		return $this->GetServiceProvider($objNote["serviceproviderId"]);

	}



	public function GetUnitsHeaderCounts(){

		$AllCount = $this->db->count_all('crm_pm_units');
		$this->db->select('count(id)');

		$this->db->from('crm_pm_units');

		$this->db->where('prop_status', 1);

		$AvailableCount = $this->db->get()->result_array()[0]["count(id)"];
		$this->db->select('count(id)');

		$this->db->from('crm_pm_units');

		$this->db->where('prop_status', 3);

		$RentedCount = $this->db->get()->result_array()[0]["count(id)"];
		$res = array(

			'AllCount' => $AllCount,

			'AvailableCount' => $AvailableCount,

			'RentedCount' => $RentedCount

			);



	   //echo 'res: ' . var_dump($res);exit;

		return $res;

	}



	public function GetLeasesHeaderCounts(){		

		$AllCount = $this->db->count_all('crm_pm_leases');
		$this->db->select('count(id)');

		$this->db->from('crm_pm_leases');

		$AllCount = $this->db->get()->result_array()[0]["count(id)"];
		$this->db->select('count(id)');

		$this->db->from('crm_pm_leases');

		$this->db->where('datediff(now(), enddate) <', -5);

		$ExpiringCount = $this->db->get()->result_array()[0]["count(id)"];
		$res = array(

			'AllCount' => $AllCount,

			'ExpiringCount' => $ExpiringCount

			);



	   //echo 'res: ' . var_dump($res);exit;

		return $res;

	}

	

	public function GetWorkOrdersHeaderCounts(){		

		$AllCount = $this->db->count_all('crm_pm_workorders');
		$this->db->select('count(id)');

		$this->db->from('crm_pm_workorders');

		$AllCount = $this->db->get()->result_array()[0]["count(id)"];
		$this->db->select('count(id)');

		$this->db->from('crm_pm_workorders');

		$this->db->where('status', 3);

		$InProgressCount = $this->db->get()->result_array()[0]["count(id)"];
		$this->db->select('count(id)');

		$this->db->from('crm_pm_workorders');

		$this->db->where('status <', 4);

		$CompletedCount = $this->db->get()->result_array()[0]["count(id)"];		
		$res = array(

			'AllCount' => $AllCount,

			'InProgressCount' => $InProgressCount,

			'CompletedCount' => $CompletedCount

			);



	   //echo 'res: ' . var_dump($res);exit;

		return $res;

	}

	

	public function GetAccountsHeaderCounts(){		

		$AllCount = $this->db->count_all('crm_pm_accounts');
		$this->db->select('count(id)');

		$this->db->from('crm_pm_accounts');

		$AllCount = $this->db->get()->result_array()[0]["count(id)"];
		$this->db->select('count(id)');

		$this->db->from('crm_pm_accounts');

		$this->db->where('transactiontype', 1);

		$PaymentInCount = $this->db->get()->result_array()[0]["count(id)"];
		$this->db->select('count(id)');

		$this->db->from('crm_pm_accounts');

		$this->db->where('transactiontype <', 2);

		$PaymentOutCount = $this->db->get()->result_array()[0]["count(id)"];		
		$res = array(

			'AllCount' => $AllCount,

			'PaymentInCount' => $PaymentInCount,

			'PaymentOutCount' => $PaymentOutCount

			);



	   //echo 'res: ' . var_dump($res);exit;

		return $res;

	}

	

	public function GetLandlordsHeaderCounts(){		

		$AllCount = $this->db->count_all('crm_pm_landlords');
		$this->db->select('count(id)');

		$this->db->from('crm_pm_landlords');

		$AllCount = $this->db->get()->result_array()[0]["count(id)"];
		$res = array(

			'AllCount' => $AllCount

			);



	   //echo 'res: ' . var_dump($res);exit;

		return $res;

	}

	

	public function GetTenantsHeaderCounts(){		

		$AllCount = $this->db->count_all('crm_pm_tenants');
		$this->db->select('count(id)');

		$this->db->from('crm_pm_tenants');

		$AllCount = $this->db->get()->result_array()[0]["count(id)"];
		$res = array(

			'AllCount' => $AllCount

			);



	   //echo 'res: ' . var_dump($res);exit;

		return $res;

	}

	

	public function GetServiceProvidersHeaderCounts(){

	}



	public function GetPayments($unitId){

		$c = "DISTINCT(crm_pm_payments_detail.payeeId),

		crm_pm_serviceproviders.serviceprovidername as 'payeeName'";

		$this->datatables->select($c)->from('crm_pm_payments_header');

		$this->datatables->join('crm_pm_payments_detail', 'crm_pm_payments_header.id = crm_pm_payments_detail.headerId', 'inner');		

		$this->datatables->join('crm_pm_serviceproviders', 'crm_pm_payments_detail.payeeId = crm_pm_serviceproviders.id', 'inner');		

		$this->datatables->where("crm_pm_payments_header.unitId", $unitId);

		// echo $this->db->get_compiled_select();exit;

		$tableData = $this->db->get();

		$resArray["payees"] = (count($tableData->result_array())>0)?$tableData->result_array():"";
		$c = "crm_pm_payments_header.id as headerId
		, crm_pm_payments_detail.id as detailId
		, crm_pm_payments_detail.payeeId
		, crm_pm_serviceproviders.serviceprovidername as name
		, crm_pm_payments_detail.year
		, crm_pm_payments_detail.month
		, crm_pm_payments_detail.day
		, crm_pm_payments_detail.status
		, crm_pm_payments_detail.payment";

		$this->datatables->select($c)->from('crm_pm_payments_header');

		$this->datatables->join('crm_pm_payments_detail', 'crm_pm_payments_header.id = crm_pm_payments_detail.headerId', 'left');		

		$this->datatables->join('crm_pm_serviceproviders', 'crm_pm_payments_detail.payeeId = crm_pm_serviceproviders.id', 'left');		

		$this->datatables->where("crm_pm_payments_header.unitId", $unitId);

		

		$this->db->order_by("year", "desc");

		$this->db->order_by("month", "asc");
		// echo $this->db->get_compiled_select();exit;

		$tableData = $this->db->get();
		$resArray["payments"] = (count($tableData->result_array())>0)?$tableData->result_array():"";
		$c = "crm_pm_payments_header.id as headerId
		, crm_pm_payments_header.ref";

		$this->datatables->select($c)->from('crm_pm_payments_header');	

		$this->datatables->where("crm_pm_payments_header.unitId", $unitId);		
		$tableData = $this->db->get();
		$resArray["headerInfo"] = (count($tableData->result_array())>0)?$tableData->result_array():"";		
		return $resArray;

	}



	public function GetServiceProviderNames(){

		$c = "crm_pm_serviceproviders.id, crm_pm_serviceproviders.ref, crm_pm_serviceproviders.serviceprovidername as name";

		$this->datatables->select($c)->from('crm_pm_serviceproviders');
		// echo $this->db->get_compiled_select();exit;

		$tableData = $this->db->get();
		$resArray["spnames"] = (count($tableData->result_array())>0)?$tableData->result_array():"";
		return $resArray;

	}



	public function SavePayments($objPaymentHeader, $objPaymentDetails){

		$q = $this->db->get_where("crm_pm_payments_header", array('id' => $objPaymentHeader["id"]));

		$headerId = 0;
		if($q->num_rows() > 0){

			$this->db->where("crm_pm_payments_header.id", $objPaymentHeader["id"])->update("crm_pm_payments_header", $objPaymentHeader); // update existing record

			$headerId = $objPaymentHeader["id"];

		}

		else{

			$this->db->insert("crm_pm_payments_header", $objPaymentHeader); // insert new record     

			$headerId = $this->db->insert_id();

		}

		// $q = $this->db->get_where("crm_pm_payments_detail", array('headerId' => $objPaymentHeader["id"]));
		foreach ($objPaymentDetails as $key => $paymentArray) {
			$paymentArray["headerId"] = $headerId;
			$where = array('year' => $paymentArray["year"], 

				'month' => $paymentArray["month"], 

				'payeeId' => $paymentArray["payeeId"], 

				'status' => $paymentArray["status"]);
					//echo var_dump($paymentArray);

			$q = $this->db->get_where("crm_pm_payments_detail", $where);
				if($q->num_rows() > 0)

				$this->db->where($where)->update("crm_pm_payments_detail", $paymentArray); // update existing record

			else{

				// unset($paymentArray["id"]);

				$this->db->insert("crm_pm_payments_detail", $paymentArray); // insert new record     

			}

		} 

	}



	public function DeletePaymentRecord($payeeId, $headerId){
		$where = array('headerId' => $headerId, 

			'payeeId' => $payeeId);		
	$this->db->where($where)->delete('crm_pm_payments_detail'); 
			$q = $this->db->get_where("crm_pm_payments_detail", array('headerId' => $headerId));

		if($q->num_rows() == 0)

			$this->db->where('id', $headerId)->delete('crm_pm_payments_header'); 

	}


	function GetWorkTypes(){

		$this->db->select("id, name, description")
		->from("crm_pm_work_types");

		$tableData = $this->db->get();

		return (count($tableData->result_array())>0)?$tableData->result_array():"";
	}

	function GetWorkSubTypes($typeId){

		$this->db->select("id, name, description")
		->from("crm_pm_work_subtypes");

		if($typeId > 0)
			$this->db->where("typeId", $typeId);

		$tableData = $this->db->get();

		return $tableData->result_array();//(count($tableData->result_array())>0)?$tableData->result_array():"";
	}

	function SaveSubType($objRecord){

		$q = $this->db->get_where("crm_pm_work_subtypes", array('id' => $objRecord["id"], 'typeId' => $objRecord["typeId"]));
		if($q->num_rows() > 0)
			$this->db->where(array('id' => $objRecord["id"], 'typeId' => $objRecord["typeId"]))->update("crm_pm_work_subtypes", $objRecord); // update existing record        
		
		else{
			unset($objRecord["id"]);
			$this->db->insert("crm_pm_work_subtypes", $objRecord); // insert new record        
		}

		return $this->db->insert_id();

	}

/*



	$q = $this->db->get_where($tablename, array('ref =' => $objRecord["ref"]));



	if($q->num_rows() > 0)

		$this->db->where('ref', $objRecord["ref"])->update($tablename, $objRecord); // update existing record        

	else

		$this->db->insert($tablename, $objRecord); // insert new record        

	

	return $this->db->insert_id();

	

*/



}



?>