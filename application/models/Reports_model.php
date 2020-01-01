<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Shafiq

 * Description: dashboard model class

 */

class Reports_model extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();

		

	}
	
	public function ListingCategory($subGroup, $where){


	
		if($subGroup == 'Location')

		{

			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type'

			, crm_location.loc_name as 'Location'

			, crm_category.category as 'Category', count(crm_listings.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_listings");

			$this->db->join('crm_category', 'crm_category.id = crm_listings.category_id', 'left');

			$this->db->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('type', 'category', 'area_location_id'));
	
			$tableData = $this->db->get();

			$tableData->result_array();			

		}

		else if($subGroup == 'Agent')

		{

			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type'

			, crm_category.category as 'Category'

			, CONCAT (crm_users.first_name, crm_users.last_name) as 'Agent'

			, count(crm_listings.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_listings");

			$this->db->join('crm_category', 'crm_category.id = crm_listings.category_id', 'left');

			$this->db->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('type', 'category', 'agent_id'));
	
			$tableData = $this->db->get();

			$tableData->result_array();			

		}		

		else

		{

			$select = "CASE crm_listings.type when 1 then 'Rent' when 2 then 'Sale' end as 'Type',

			crm_category.category as 'Category', count(crm_listings.id) as 'Count'";

			$group = array('type', 'category');

			

			$this->db->select($select);

			$this->db->from("crm_listings");

			$this->db->join('crm_category', 'crm_category.id = crm_listings.category_id', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by($group);
	
			$tableData = $this->db->get();

			$tableData->result_array();			

		}
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));

		

		//echo $totalCount;exit;

		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();

	}
	
	public function ListingLocation($subGroup, $where){
	
		if($subGroup == 'Category')

		{

			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type'

			, crm_location.loc_name as 'Location'			

			, crm_category.category as 'Category'			

	        , count(crm_listings.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_listings");

			$this->db->join('crm_category', 'crm_category.id = crm_listings.category_id', 'left');

			$this->db->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_listings.type', 'crm_listings.area_location_id'));
	
			$tableData = $this->db->get();

			$tableData->result_array();

		}
	
		else if($subGroup == 'Agent')

		{

			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type'

			, crm_location.loc_name as 'Location'			

			, CONCAT (crm_users.first_name, crm_users.last_name) as 'Agent'			

	        , count(crm_listings.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_listings");

			$this->db->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');

			$this->db->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_listings.type', 'crm_listings.area_location_id'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	

		}		
	
		else

		{

			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type'

			, crm_location.loc_name as 'Location'

	        , count(crm_listings.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_listings");

			//$this->db->join('crm_category', 'crm_category.id = crm_listings.category_id', 'left');

			$this->db->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_listings.type', 'crm_listings.area_location_id'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	

		}
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();

	}
	
	public function ListingStatus($subGroup, $where){
	
			$select = " CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type'

	        , CASE status when 1 then 'Unpublished' else 'Published' end as 'Status'

	        , count(crm_listings.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_listings");

			//$this->db->join('crm_location', 'crm_location.loc_id = crm_listings.area_location_id', 'left');

			//$this->db->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_listings.type', 'crm_listings.status'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();			

	}
	
	public function LeadHot($subGroup, $where){
	
			$select = "case type when 1 then 'Tenant'

				 when 2 then 'Buyer'

				 when 3 then 'Landlord'

				 when 4 then 'Seller'

				 when 5 then 'Landlord+Seller'

				 when 6 then 'Not Specified'

				 end as 'Type'

				, count(`id`) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_leads");

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_leads.type'));

			$this->db->where("hot_lead = 1");

			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();			

	}
	
	public function LeadSource($subGroup, $where){
	
			$select = "source_of_lead as 'Source'

				, count(`id`) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_leads");

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_leads.source_of_lead'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();		

	}
	
	public function LeadPipeline($subGroup, $where){
	
			$select = "source_of_lead as 'Source'

				, count(`id`) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_leads");

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_leads.source_of_lead'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();	

	}
	
	public function LeadType($subGroup, $where){
	
			$select = "case type when 1 then 'Tenant'

				 when 2 then 'Buyer'

				 when 3 then 'Landlord'

				 when 4 then 'Seller'

				 when 5 then 'Landlord+Seller'

				 when 6 then 'Not Specified'

				 end as 'Type'

				, count(`id`) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_leads");

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_leads.type'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();			

	}
	
	public function LeadStuck($subGroup, $where){
	
			$select = "case type when 1 then 'Tenant'

				 when 2 then 'Buyer'

				 when 3 then 'Landlord'

				 when 4 then 'Seller'

				 when 5 then 'Landlord+Seller'

				 when 6 then 'Not Specified'

				 end as 'Type'

				, count(`id`) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_leads");

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_leads.type'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();	

	}
	
	public function DealsSuccess($subGroup, $where){
	
			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type',

			crm_sub_status.sub_status as 'Status',

			count(crm_deals.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_deals");

			$this->db->join('crm_sub_status', 'crm_sub_status.id = crm_deals.sub_status', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_deals.sub_status'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();	

	}
	
	public function DealsStatus($subGroup, $where){
	
			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type',

			crm_sub_status.sub_status as 'Status',

			count(crm_deals.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_deals");

			$this->db->join('crm_sub_status', 'crm_sub_status.id = crm_deals.sub_status', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_deals.sub_status'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();	

	}
	
	public function View($subGroup, $where){
	
			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type',

			crm_sub_status.sub_status as 'Status',

			count(crm_deals.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_deals");

			$this->db->join('crm_sub_status', 'crm_sub_status.id = crm_deals.sub_status', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_deals.sub_status'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();	

	}
	
	public function ViewLeads($subGroup, $where){
	
			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type',

			crm_sub_status.sub_status as 'Status',

			count(crm_deals.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_deals");

			$this->db->join('crm_sub_status', 'crm_sub_status.id = crm_deals.sub_status', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_deals.sub_status'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();	

	}
	
	public function ViewListings($subGroup, $where){
	
			$select = "CASE type when 1 then 'Rent' when 2 then 'Sale' end as 'Type',

			crm_sub_status.sub_status as 'Status',

			count(crm_deals.id) as 'Count'";

			

			$this->db->select($select);

			$this->db->from("crm_deals");

			$this->db->join('crm_sub_status', 'crm_sub_status.id = crm_deals.sub_status', 'left');

			if($where)

				$this->db->where($where);

			$this->db->group_by(array('crm_deals.sub_status'));
	
			$tableData = $this->db->get();

			$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all('crm_listings'));
	
		$res = array_merge($tableData->result_array(), $totalCount);

		

		return $res; //$tableData->result_array();	

	}
	
	public function SaveReport($data){

		$q = $this->db->get_where("crm_saved_reports", array('reference =' => $data["reference"]));
	
		if($q->num_rows() > 0)

			$this->db->where('reference', $data["reference"])->update("crm_saved_reports", $data); // update existing record        

		else

			$this->db->insert("crm_saved_reports", $data); // insert new record        

		

		return $this->db->insert_id();

	}
	
	public function GetMaxId($tablename){

		return $this->db->count_all($tablename);

	}
	
	public function GetSavedReports($type){
	
		$select = "id, `reportname`, `customname`, `createdAt`, reference, functionname as viewname";

		$this->db->select($select);

		$this->db->from('crm_saved_reports');

		$this->db->where("type", $type);

		$this->db->where("isactive", 1);
	
		$tableData = $this->db->get();

		$tableData->result_array();	
	
		$totalCount = array("Total"=>$this->db->count_all_results());
	
		return $tableData->result_array();	//$res; //

	}
	
	public function GetSavedReport($reference){

		$select = "`reportname`, `customname`, `createdAt`, `functionname`, `subgroupedby`, filter, coalesce(`daterange`, '-') as 'daterange', controllername";

		$this->db->select($select);

		$this->db->from('crm_saved_reports');

		$this->db->where("reference", $reference);
	
		$tableData = $this->db->get();

		$tableData->result_array();	
	


		return $tableData->result_array();	//$res; //

	}
	
	public function DeleteReport($reference, $type){

		$this->db->where('reference', $reference)->update("crm_saved_reports", array("isactive" => 0));  
	
		return $this->GetSavedReports($type);

	}

	function GetAgents(){
		$this->db->select("id, first_name, last_name");
		$this->db->from('crm_users');
		$this->db->where("is_active", 1);	
		$tableData = $this->db->get();
		// 

		return $tableData->result_array();	

	}

	function GetAgentLeaderBoard($listingType){

		$c = "0 as rank,
		concat(first_name, ' ', last_name) as agent,
		count(crm_listings.id) as listingsCount,
		0 as lead,
		0 as viewingCount,
		0 as dealCount,
		0 as successfulDealCount,
		0 as leadConversion,
		0 as companyConversion,
		0 as agentConversion";

		$this->datatables->select($c)->from('crm_listings');
		$this->datatables->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left');
		$this->datatables->where('crm_listings.is_active', 1);

		if($listingType > 0)
			$this->datatables->where('crm_listings.type', $listingType);

		$this->db->order_by("count(crm_listings.id)", "desc");
		$this->datatables->group_by('crm_listings.agent_id');

		// echo var_dump($this->datatables->generate());exit;

		return $this->datatables->generate();
	}

	function GetReportTotals($listingType, $agent, $date){
		//count(crm_listings.id)
		$dateVal = "";

		$c = "count(crm_listings.id) as listingsCount,
		61 as leadsCount,
		58 as viewingsCount,
		46 as dealsCount,
		26 as successfulDealsCount";
		$this->db->select($c)
		->from('crm_listings')
		->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left')
		->where('crm_listings.is_active', 1);

		if($listingType > 0)
			$this->db->where('crm_listings.type', $listingType);

		if($agent > 0)
			$this->db->where('crm_users.id', $agent);

		if($date){
			//echo "date->".$date;
			if($date == "pastSevenDays")
				$dateVal = "crm_listings.dateadded BETWEEN DATE(NOW()) AND DATE(NOW()) - INTERVAL 7 DAY";
			if($date == "pastThirtyDays")
				$dateVal = "crm_listings.dateadded BETWEEN DATE(NOW()) AND DATE(NOW()) - INTERVAL 1 MONTH";
			if($date == "pastThreeMonths")
				$dateVal = "crm_listings.dateadded BETWEEN DATE(NOW()) AND DATE(NOW()) - INTERVAL 3 MONTH";
			if($date == "pastYear")
				$dateVal = "crm_listings.dateadded BETWEEN DATE(NOW()) AND DATE(NOW()) - INTERVAL 1 YEAR";

			$this->db->where($dateVal);
		}

		$this->db->order_by("count(crm_listings.id)", "desc");
		// ->group_by('crm_listings.agent_id');

		// echo $this->db->get_compiled_select();exit;

		$tableData = $this->db->get();

		// echo var_dump( $tableData->result_array());
		return $tableData->result_array()[0];	


	}

	function GetConversionRates($listingType, $agent, $date){

		$c = "80 as lead,
		60 as company,
		50 as agent";
		$this->db->select($c)
		->from('crm_listings')
		->join('crm_users', 'crm_users.id = crm_listings.agent_id', 'left')
		->where('crm_listings.is_active', 1);

		if($listingType > 0)
			$this->db->where('crm_listings.type', $listingType);

		if($agent > 0)
			$this->db->where('crm_users.id', $agent);

		$this->db->order_by("count(crm_listings.id)", "desc");
		// ->group_by('crm_listings.agent_id');
		// echo $this->db->get_compiled_select();exit;

		$tableData = $this->db->get();

		// echo var_dump( $tableData->result_array());
		return $tableData->result_array()[0];	


	}

	/* A note on the formula of Agent Leaderboard's Conversion Rates
	 * Lead Conversion = # of leads / # of Listings
	 * Company Conversion = # of Closed Deals / # of Leads
	 * Agent Conversion = ??
	---------------------------------------------------------------------*/


}



//echo $this->db->get_compiled_select();exit;