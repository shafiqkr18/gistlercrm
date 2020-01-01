<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: deals model class
 */
class Deals_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
	
	public function datatable()
	{
	//SELECT CASE type WHEN "1" THEN "Rent" WHEN "2" THEN "Sale" ELSE "Not Specified" END  as type FROM `crm_deals` d	
		$c = 'd.id as id,d.ref as ref,(case when d.type = 1 
 THEN
      "Rent"
 ELSE
      "Sale" 
 END)  as type,d.status as status,crm_sub_status.sub_status as sub_status,d.tenant_buyer_name as tenant_buyer_name,d.landlord_seller_name as landlord_seller_name,c.name as region_id,
 crm_location.loc_name as area_location_id,crm_subloc.sub_sub_loc as sub_area_location_id,d.price,d.price,d.deposit,d.deal_date,d.deal_estimated_date,d.renewal_date,
 CONCAT(u.first_name, " ", u.last_name) as agent_1_id,d.agent_1_commission,d.agent_2_id,d.agent_2_commission,d.agent_3_id,d.agent_3_commission,d.listings_ref,
 d.listings_beds,d.listings_street_no,d.listings_floor_no,d.listings_floor_no,d.created_by_name,d.listings_unit,d.commission,d.dateupdated';
		
		
		
		
			$this->datatables->select($c)
			    ->unset_column('d.id')//this means if you want to include in columns or search
				->from('crm_deals d');
				$this->datatables->join('crm_users as u', 'u.id = d.agent_id', 'left');
				$this->datatables->join('crm_city as c', 'c.id = d.region_id', 'left');
				$this->datatables->join('crm_location', 'crm_location.loc_id = d.area_location_id', 'left');
				$this->datatables->join('crm_subloc', 'crm_subloc.sub_loc_id = d.sub_area_location_id', 'left');
				$this->datatables->join('crm_sub_status', 'crm_sub_status.id = d.sub_status', 'left');
				
				$this->datatables ->where('d.is_active', 1); 
				
	 		/***********************where conditions starts here *******/
				if($this->input->post('listing_type'))
				{
					if($this->input->post('listing_type') == 1)
					{
						$where = "d.type = 1";
						$this->datatables ->where($where);
					}elseif($this->input->post('listing_type') == 2){
						$this->datatables ->where('d.type',2);
					}elseif($this->input->post('status') == 100){
						$where = "YEAR(deal_estimated_date) = YEAR(Now()) AND type=1";
						$this->datatables ->where($where);
					}elseif($this->input->post('status') == 101){
						$where = "YEAR(deal_estimated_date) = YEAR(Now()) AND type=2";
						$this->datatables ->where($where);
					}elseif($this->input->post('status') == 102){
						$where = "status=1  AND type=1";
						$this->datatables ->where($where);
					}elseif($this->input->post('status') == 103){
						$where = "status=1  AND type=2";
						$this->datatables ->where($where);
					}elseif($this->input->post('status') == 104){
						$where = "WHERE YEAR(deal_estimated_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
		AND MONTH(deal_estimated_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
		AND status=2  AND type=1";
						$this->datatables ->where($where);
					}elseif($this->input->post('status') == 105){
						$where = "WHERE YEAR(deal_estimated_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
		AND MONTH(deal_estimated_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
		AND status=2  AND type=2";
						$this->datatables ->where($where);
					}
					 
				}
			/**********************where ends here*********************/
			
			return $this->datatables->generate();
       }
	   
	/**********************save data section**************/   
	public function submit()
	{
		
		$created_by =  $this->session->userdata('userid');
		$dateadded = date('Y-m-d H:i:s');
		$dateupdated = date('Y-m-d H:i:s');
		
		//set type for lisitng
		$type = $this->input->post('type');
		
		//check either it is new entry or updation
		if (($this->input->post('id')) && ($this->input->post('ref'))) {//this is update
		$id = $this->input->post('id');
		$ref = $this->input->post('ref');
		
		}else{
			$id = 0;
			$ret = $this->db->query("select IFNULL(max(id),0) as id from crm_deals")->row()->id;
			$ret = str_pad($ret, 4, '0', STR_PAD_LEFT);
			$ret = $ret + 0001;
			
			$ref = "GIS-D-".$ret;
			
			
		}
		
		// Create two arrays, one for save and other for update
		$data_save = array(
					'client_id'=> $this->input->post('client_id'),
					'rand_key'=> $this->input->post('rand_key'),
					'ref'=> $ref,
					'type'  => $type,
					'tenant_buyer_id' => $this->input->post('tenant_buyer_id'),
					'tenant_buyer_name' => $this->input->post('tenant_buyer_name'),
					'landlord_seller_id' => $this->input->post('landlord_seller_id'),
					'landlord_seller_name' => $this->input->post('landlord_seller_name'),
					'status' => ($this->input->post('status') ? $this->input->post('status'):1),
					'sub_status' => ($this->input->post('sub_status') ? $this->input->post('sub_status'):1),
					'agent_id' => $this->input->post('agent_id'),
					'price' => $this->input->post('price'),
					'deposit' => $this->input->post('deposit'),
					'commission' => $this->input->post('commission'),
					'deal_date' => $this->input->post('deal_date'),
					'deal_estimated_date' => $this->input->post('deal_estimated_date'),
					'listings_id' => $this->input->post('listings_id'),
					'listings_ref' => $this->input->post('listings_ref'),
					'listings_randkey' => $this->input->post('listings_randkey'),
					'listings_unit' => $this->input->post('listings_unit'),
					'agent_1_id' => $this->input->post('agent_1_id'),
					'agent_1_commission_percentage' => $this->input->post('agent_1_commission_percentage'),
					'agent_1_commission' => $this->input->post('agent_1_commission'),
					'agent_2_id' => ($this->input->post('agent_2_id') ? $this->input->post('agent_2_id'):0),
					'agent_2_commission_percentage' => ($this->input->post('agent_2_commission_percentage') ? $this->input->post('agent_2_commission_percentage'):0),
					'agent_2_commission' => ($this->input->post('agent_2_commission') ? $this->input->post('agent_2_commission'):0),
					'agent_3_id' => ($this->input->post('agent_3_id') ? $this->input->post('agent_3_id'):0),
					'agent_3_commission_percentage' => ($this->input->post('agent_3_commission_percentage') ? $this->input->post('agent_3_commission_percentage'):0),
					'agent_3_commission' => ($this->input->post('agent_3_commission') ? $this->input->post('agent_3_commission'):0),
					'listings_beds' => $this->input->post('listings_beds'),
					'listings_unit_type' => $this->input->post('listings_unit_type'),
					'listings_street_no'=> $this->input->post('listings_street_no'),
					'listings_floor_no' => $this->input->post('listings_floor_no'),
					'renewal_date' => ($this->input->post('renewal_date') ? $this->input->post('renewal_date'):0),
					'remind_before' => $this->input->post('remind_before'),
					'listings_category_id' => ($this->input->post('listings_category_id') ? $this->input->post('listings_category_id'):0),
					'region_id' => ($this->input->post('region_id') ? $this->input->post('region_id'):0),
					'area_location_id' => ($this->input->post('area_location_id') ? $this->input->post('area_location_id'):0),
					'sub_area_location_id' => ($this->input->post('sub_area_location_id') ? $this->input->post('sub_area_location_id'):0),
					'notes' => $this->input->post('notes'),
					'add_info' => $this->input->post('add_info'),
					'created_by' => $created_by,
					'created_by_name' => $this->input->post('created_by_name'),
					'dateadded' => $dateadded,
					'dateupdated' => $dateupdated,
					'leads_id' => ($this->input->post('leads_id') ? $this->input->post('leads_id'):0),
					'leads_ref' => ($this->input->post('leads_ref') ? $this->input->post('leads_ref'):0)
					
					
					
						);
						
			////////////////////////////////////////////////////////////////////////
			
		$data_update = array(
					'id'=>$id,
					'client_id'=> $this->input->post('client_id'),
					'rand_key'=> $this->input->post('rand_key'),
					'ref'=> $ref,
					'type'  => $type,
					'tenant_buyer_id' => $this->input->post('tenant_buyer_id'),
					'tenant_buyer_name' => $this->input->post('tenant_buyer_name'),
					'landlord_seller_id' => $this->input->post('landlord_seller_id'),
					'landlord_seller_name' => $this->input->post('landlord_seller_name'),
					'status' => ($this->input->post('status') ? $this->input->post('status'):1),
					'sub_status' => ($this->input->post('sub_status') ? $this->input->post('sub_status'):1),
					'agent_id' => $this->input->post('agent_id'),
					'price' => $this->input->post('price'),
					'deposit' => $this->input->post('deposit'),
					'commission' => $this->input->post('commission'),
					'deal_date' => $this->input->post('deal_date'),
					'deal_estimated_date' => $this->input->post('deal_estimated_date'),
					'listings_id' => $this->input->post('listings_id'),
					'listings_ref' => $this->input->post('listings_ref'),
					'listings_randkey' => $this->input->post('listings_randkey'),
					'listings_unit' => $this->input->post('listings_unit'),
					'agent_1_id' => $this->input->post('agent_1_id'),
					'agent_1_commission_percentage' => $this->input->post('agent_1_commission_percentage'),
					'agent_1_commission' => $this->input->post('agent_1_commission'),
					'agent_2_id' => ($this->input->post('agent_2_id') ? $this->input->post('agent_2_id'):0),
					'agent_2_commission_percentage' => ($this->input->post('agent_2_commission_percentage') ? $this->input->post('agent_2_commission_percentage'):0),
					'agent_2_commission' => ($this->input->post('agent_2_commission') ? $this->input->post('agent_2_commission'):0),
					'agent_3_id' => ($this->input->post('agent_3_id') ? $this->input->post('agent_3_id'):0),
					'agent_3_commission_percentage' => ($this->input->post('agent_3_commission_percentage') ? $this->input->post('agent_3_commission_percentage'):0),
					'agent_3_commission' => ($this->input->post('agent_3_commission') ? $this->input->post('agent_3_commission'):0),
					'listings_beds' => $this->input->post('listings_beds'),
					'listings_unit_type' => $this->input->post('listings_unit_type'),
					'listings_street_no'=> $this->input->post('listings_street_no'),
					'listings_floor_no' => $this->input->post('listings_floor_no'),
					'renewal_date' => ($this->input->post('renewal_date') ? $this->input->post('renewal_date'):0),
					'remind_before' => $this->input->post('remind_before'),
					'listings_category_id' => ($this->input->post('listings_category_id') ? $this->input->post('listings_category_id'):0),
					'region_id' => ($this->input->post('region_id') ? $this->input->post('region_id'):0),
					'area_location_id' => ($this->input->post('area_location_id') ? $this->input->post('area_location_id'):0),
					'sub_area_location_id' => ($this->input->post('sub_area_location_id') ? $this->input->post('sub_area_location_id'):0),
					'notes' => $this->input->post('notes'),
					'add_info' => $this->input->post('add_info'),
					'created_by' => $created_by,
					'created_by_name' => $this->input->post('created_by_name'),
					
					'dateupdated' => $dateupdated,
					'leads_id' => ($this->input->post('leads_id') ? $this->input->post('leads_id'):0),
					'leads_ref' => ($this->input->post('leads_ref') ? $this->input->post('leads_ref'):0)
					
						
						);				
		//print_r($data_save);exit;
		
		if (($this->input->post('id')) && ($this->input->post('ref'))) {
					$listing_id = 	$this->input->post('id');					
				  $this->db->where('id', $listing_id);
			return $this->db->update('crm_deals',$data_update); // update the record
				
				}else {
							
			return  $this->db->insert('crm_deals', $data_save); // insert new record
			 
			}
		
		
		
		
	}//end save data function	   
	   
	public function getSingleRow($id)
	{
		$this->db->select('*');
		$this->db->from('crm_deals');
		$where = "id=".$id;
		$this->db->where($where);
		
			$query = $this->db->get();
			 if( $query->num_rows() == 1 ){
			  // One row, match!
			  
				  $row =  $query->row(); 
				return array(
					'id'=> ''.$row->id.'',
					'client_id'=> ''.$row->client_id.'',
					'rand_key'=> ''.$row->rand_key.'',
					'ref'=> ''.$row->ref.'',
					'type'=> ''.$row->type.'',
					'tenant_buyer_id'=> ''.$row->tenant_buyer_id.'',
					'tenant_buyer_name'=> ''.$row->tenant_buyer_name.'',
					'landlord_seller_id'=> ''.$row->landlord_seller_id.'',
					'landlord_seller_name'=> ''.$row->landlord_seller_name.'',
					'status'=> ''.$row->status.'',
					'sub_status'=> ''.$row->sub_status.'',
					'agent_id'=> ''.$row->agent_id.'',
					'price'=> ''.$row->price.'',
					'deposit'=> ''.$row->deposit.'',
					'commission'=> ''.$row->commission.'',
					'deal_date'=> ''.$row->deal_date.'',
					'deal_estimated_date'=> ''.$row->deal_estimated_date.'',
					'listings_id'=> ''.$row->listings_id.'',
					'listings_ref'=> ''.$row->listings_ref.'',
					'listings_randkey'=> ''.$row->listings_randkey.'',
					'listings_unit'=> ''.$row->listings_unit.'',
					'agent_1_id'=> ''.$row->agent_1_id.'',
					'agent_1_commission_percentage'=> ''.$row->agent_1_commission_percentage.'',
					'agent_1_commission'=> ''.$row->agent_1_commission.'',
					'agent_2_id'=> ''.$row->agent_2_id.'',
					'agent_2_commission_percentage'=> ''.$row->agent_2_commission_percentage.'',
					'agent_2_commission'=> ''.$row->agent_2_commission.'',
					'agent_3_id'=> ''.$row->agent_3_id.'',
					'agent_3_commission_percentage'=> ''.$row->agent_3_commission_percentage.'',
					'agent_3_commission'=> ''.$row->agent_3_commission.'',
					'listings_beds'=> ''.$row->listings_beds.'',
					'listings_unit_type'=> ''.$row->listings_unit_type.'',
					'listings_street_no'=> ''.$row->listings_street_no.'',
					'listings_floor_no'=> ''.$row->listings_floor_no.'',
					'renewal_date'=> ''.$row->renewal_date.'',
					'remind_before'=> ''.$row->remind_before.'',
					'listings_category_id'=> ''.$row->listings_category_id.'',
					'region_id'=> ''.$row->region_id.'',
					'area_location_id'=> ''.$row->area_location_id.'',
					'sub_area_location_id'=> ''.$row->sub_area_location_id.'',
					'notes'=> ''.$row->notes.'',
					'add_info'=> ''.$row->add_info.'',
					'created_by'=> ''.$row->created_by.'',
					'created_by_name'=> ''.$row->created_by_name.'',
					'dateadded'=> ''.$row->dateadded.'',
					'dateupdated'=> ''.$row->dateupdated.''
					);
				       
				} else {
				  // None
				  return 0;
				}
		
	}
	   
}