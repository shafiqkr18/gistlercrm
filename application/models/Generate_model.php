<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: generate model class
 */
class Generate_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
	public function get_Agent($type,$id)
	{
		
		$q="select CONCAT(u.first_name, ' ', u.last_name) as name,u.photo_agent,u.mobile_no_new,u.job_title,u.email,u.id,u.rera from crm_users u,crm_listings r where u.id=r.agent_id and r.id=".$id;
		$query = $this->db->query($q);
		return $query->row();
		
	}
	public function get_Listing($type,$id)
	{
		
		$q="select ref,unit,unit_type,name,unit_size_price,description_demo,description_count,prop_status,(select category from crm_category where id=M.category_id) as category,(select loc_name  from crm_location where loc_id=M.area_location_id) as AreaLocation,(select sub_sub_loc from crm_subloc where sub_loc_id=M.sub_area_location_id ) as SubAreaLocation,beds,parking,baths,size,plot_size as Unitsize,street_no,floor_no,price,cheques,frequency,deposit,view_id as View from crm_listings as M where id=".$id;
		$query = $this->db->query($q);
		return $query->row();
		
	}
	function get_Listing_selected($exportPDFIds)
	{
		$q = "select id,ref,unit,unit_type,name,category_id,fitted,(select category from crm_category where id=M.category_id) as category,
		if(M.type=1,'Rentals','Sales') as Type,
		(select loc_name  from crm_location where loc_id=M.area_location_id) as AreaLocation,
		(select sub_sub_loc from crm_subloc where sub_loc_id=M.sub_area_location_id ) as SubAreaLocation,
		beds,baths,size,plot_size as Unitsize,street_no,floor_no,price,cheques,frequency,deposit,view_id as View from crm_listings as M where M.id IN(" . implode(",", $exportPDFIds) . ")";
		$query = $this->db->query($q);
		return $query->result_array();
	}
	public function get_Features($type,$id=0)
	{
		$content = $this->db->query("select features_id as id from crm_listings where id=".$id."")->row()->id;
		preg_match_all('/{(.*?)}/', $content, $matches);
		$a = array_map('intval',$matches[1]);
		$q="select f.title from crm_features f,crm_listings fr where f.id IN(" . implode(",", $a) . ")  limit 6";
		$query = $this->db->query($q);
		return $query->result_array();
		
	}
	public function get_Images($type,$id)
	{
		
		$q="select thumb,IF(is_watermarked=1,watermark_image,image) as watermark_image,image,title from crm_listings_images where listing_id=".$id." ORDER BY position";
		$query = $this->db->query($q);
		return $query->result_array();
		
	}
	function exportCSVdeal($exportIds)
	{
		if($exportIds && $exportIds != 'deals')
		{
			$exportIds = explode(',',trim($exportIds,','));
			return $this->db->query("select d.ref AS REF,IF(d.type = 1, 'Rentals', 'Sales') as Type,(CASE WHEN d.status = 1 THEN 'Open' WHEN d.status = 2 THEN 'Closed'  ELSE 'Not Specified' END) AS Status,(CASE WHEN d.sub_status = 1 THEN 'Pending' WHEN d.sub_status = 2 THEN 'Sucessful' WHEN d.sub_status = 3 THEN 'UnSucessful'  ELSE 'Not Specified' END) AS SubStatus,d.tenant_buyer_name,d.landlord_seller_name,d.price,(select CONCAT(first_name, ' ', last_name)  from crm_users where id=d.agent_1_id) as agent,d.deal_date as DealDate,d.listings_ref as ListingsRef,d.deal_estimated_date as EstimatedDate,DATE(d.dateupdated) AS dateupdated FROM crm_deals d WHERE d.is_active=1 and d.id IN(" . implode(",", $exportIds) . ")");
		}else{
		return $this->db->query("select d.ref AS REF,IF(d.type = 1, 'Rentals', 'Sales') as Type,(CASE WHEN d.status = 1 THEN 'Open' WHEN d.status = 2 THEN 'Closed'  ELSE 'Not Specified' END) AS Status,(CASE WHEN d.sub_status = 1 THEN 'Pending' WHEN d.sub_status = 2 THEN 'Sucessful' WHEN d.sub_status = 3 THEN 'UnSucessful'  ELSE 'Not Specified' END) AS SubStatus,d.tenant_buyer_name,d.landlord_seller_name,d.price,(select CONCAT(first_name, ' ', last_name)  from crm_users where id=d.agent_1_id) as agent,d.deal_date as DealDate,d.listings_ref as ListingsRef,d.deal_estimated_date as EstimatedDate,DATE(d.dateupdated) AS dateupdated FROM crm_deals d WHERE d.is_active=1");
	     }

	}
	function exportCSV($type,$exportPDFIds){
		
		if($exportPDFIds)
		{
			
			 $exportPDFIds = explode(',',trim($exportPDFIds,','));
			return $this->db->query("select M.ref as Ref,M.unit as Unit,M.unit_type as UnitType,M.name as Name,if(M.type=1,'Rentals','Sales') as Type,(select category from crm_category where id=M.category_id) as Category,
		(select name from crm_city where id=M.region_id) as City,(select loc_name  from crm_location where loc_id=M.area_location_id) as AreaLocation,(select sub_sub_loc from crm_subloc where sub_loc_id=M.sub_area_location_id ) as SubAreaLocation,
		M.street_no as StreetNo,M.beds as Beds,M.baths as Baths,M.size as Size,M.plot_size as Unitsize,M.price as Price,M.cheques as Cheques,M.frequency as Frequency,
		M.deposit as Deposit,M.commission as Commission,M.view_id as ViewType,(select CONCAT(first_name, ' ', last_name) from crm_users where id=M.agent_id) as Agent,
		M.description_demo as Description,M.photos as Photos,if(M.status=1,'Unpublished','Published') as Status,M.dateupdated as UpdatedDate,M.dateadded as AddedDate,M.landlord_name as LandlordName from crm_listings as M   
		where M.is_active=1 AND M.is_archive=0 AND M.type=".$type." and M.id IN(" . implode(",", $exportPDFIds) . ")");
		}else{
				
			if($type){
			return $this->db->query("select M.ref as Ref,M.unit as Unit,M.unit_type as UnitType,M.name as Name,if(M.type=1,'Rentals','Sales') as Type,(select category from crm_category where id=M.category_id) as Category,
		(select name from crm_city where id=M.region_id) as City,(select loc_name  from crm_location where loc_id=M.area_location_id) as AreaLocation,(select sub_sub_loc from crm_subloc where sub_loc_id=M.sub_area_location_id ) as SubAreaLocation,
		M.street_no as StreetNo,M.beds as Beds,M.baths as Baths,M.size as Size,M.plot_size as Unitsize,M.price as Price,M.cheques as Cheques,M.frequency as Frequency,
		M.deposit as Deposit,M.commission as Commission,M.view_id as ViewType,(select CONCAT(first_name, ' ', last_name) from crm_users where id=M.agent_id) as Agent,
		M.description_demo as Description,M.photos as Photos,if(M.status=1,'Unpublished','Published') as Status,M.dateupdated as UpdatedDate,M.dateadded as AddedDate,M.landlord_name as LandlordName from crm_listings as M   
		where M.is_active=1 AND M.is_archive=0 AND M.type=".$type."");
		}else{
			return $this->db->query("select M.ref as Ref,M.unit as Unit,M.unit_type as UnitType,M.name as Name,if(M.type=1,'Rentals','Sales') as Type,(select category from crm_category where id=M.category_id) as Category,
		(select name from crm_city where id=M.region_id) as City,(select loc_name  from crm_location where loc_id=M.area_location_id) as AreaLocation,(select sub_sub_loc from crm_subloc where sub_loc_id=M.sub_area_location_id ) as SubAreaLocation,
		M.street_no as StreetNo,M.beds as Beds,M.baths as Baths,M.size as Size,M.plot_size as Unitsize,M.price as Price,M.cheques as Cheques,M.frequency as Frequency,
		M.deposit as Deposit,M.commission as Commission,M.view_id as ViewType,(select CONCAT(first_name, ' ', last_name) from crm_users where id=M.agent_id) as Agent,
		M.description_demo as Description,M.photos as Photos,if(M.status=1,'Unpublished','Published') as Status,M.dateupdated as UpdatedDate,M.dateadded as AddedDate,M.landlord_name as LandlordName from crm_listings as M   
		where M.is_active=1 AND M.is_archive=0 ");
			}
		}
		
     } 
	 
	function exportLeadCSV($type_listing)
	{
		if($type_listing == "leads")
		{
			 $select = "select lead.ref as Reference, (CASE WHEN lead.type = 1 THEN 'Rental' WHEN lead.type = 3 THEN 'Rental' WHEN lead.type = 2 THEN 'Sale' WHEN lead. type = 4 THEN 'Sale' ELSE 'Not Specified' END) AS TYPE, ( select sub_status from crm_sub_status where id=lead.sub_status) AS SubStatus, CONCAT(lead.landlord_name, ' ',lead.last_name) as Contact, (select mobile_no_new_ccode from crm_owners where id=lead.landlord_id) as CountryCode,lead.landlord_mobile as Mobile, (select CONCAT_WS(' ',first_name,last_name) from crm_users where id=lead.agent_id) As Agent, lead.date_of_enquiry as DateOfEnquiry,lead.dateadded as DateAdded,(select loc_name from crm_location where loc_id=d.area_location_id) as Location,(select sub_sub_loc from crm_subloc where sub_loc_id=d.sub_area_location_id) as SubLocation from crm_leads AS lead
LEFT JOIN crm_leads_details d ON lead.id=d.lead_id
 where lead.landlord_name <> '' ";//AND  lead.id IN(" . implode(",", $exportIds) . ")";
			return $this->db->query($select);
		}else{
			$exportIds = explode(',',trim($type_listing,','));
			 $select = "select lead.ref as Reference, (CASE WHEN lead.type = 1 THEN 'Rental' WHEN lead.type = 3 THEN 'Rental' WHEN lead.type = 2 THEN 'Sale' WHEN lead. type = 4 THEN 'Sale' ELSE 'Not Specified' END) AS TYPE, ( select sub_status from crm_sub_status where id=lead.sub_status) AS SubStatus, CONCAT(lead.landlord_name, ' ',lead.last_name) as Contact, (select mobile_no_new_ccode from crm_owners where id=lead.landlord_id) as CountryCode,lead.landlord_mobile as Mobile, (select CONCAT_WS(' ',first_name,last_name) from crm_users where id=lead.agent_id) As Agent, lead.date_of_enquiry as DateOfEnquiry,lead.dateadded as DateAdded,(select loc_name from crm_location where loc_id=d.area_location_id) as Location,(select sub_sub_loc from crm_subloc where sub_loc_id=d.sub_area_location_id) as SubLocation from crm_leads AS lead
LEFT JOIN crm_leads_details d ON lead.id=d.lead_id
 where lead.landlord_name <> '' AND  lead.id IN(" . implode(",", $exportIds) . ")";
 return $this->db->query($select);
		}
	}
	
	function generate_landlord($type_listing)
	{
		if($type_listing == "landlord")
		{
				
			 $select = "select ref,name as FirstName,last_name as LastName,mobile_no_new as Mobile,phone as Phone,email as Email from crm_owners where is_active=1";
			 return $this->db->query($select);
		}else{
		$exportIds = explode(',',trim($type_listing,','));
		 $select = "select ref,name as FirstName,last_name as LastName,mobile_no_new as Mobile,phone as Phone,email as Email from crm_owners where id IN(" . implode(",", $exportIds) . ")";
		return $this->db->query($select);
		}
	}
	 
}