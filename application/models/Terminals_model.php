<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: terminals_model model class
 */
class Terminals_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
	
	public function datatable_lead_popup($id)
	{
		$c = 'crm_leads.id,crm_leads.ref,crm_leads.status,crm_leads.landlord_name,crm_leads.last_name,crm_leads.ref,crm_leads.landlord_mobile,crm_leads.date_of_enquiry,crm_leads.source_of_lead,crm_leads.agent_id';
			$this->datatables->select($c)
			    ->unset_column('id')//this means if you want to include in columns or search
				->from('crm_leads');
				$this->datatables ->where('crm_leads.rental_id', $id); 
				//$this->datatables->join('crm_city as r', 'r.id = l.region_id');
				//$this->datatables->join('crm_location as pl', 'pl.loc_id = l.area_location_id');
				//$this->datatables->join('crm_subloc as psl', 'psl.sub_loc_id = l.sub_area_location_id','LEFT');
	 
			return $this->datatables->generate();
       }
	public function datatable_viewing()
	{
		$created_by =  $this->session->userdata('userid');
		$c = '*';
			$this->datatables->select($c)
			    ->unset_column('id')//this means if you want to include in columns or search
				->from('crm_terminals_viewings');
				$this->datatables ->where('crm_terminals_viewings.created_by', $created_by); 
			
			return $this->datatables->generate();
       }
	public function save_viewing($listing_type)
	{
		
		$created_by =  $this->session->userdata('userid');
		$dateadded	=	date('Y-m-d');
	    $dateupdated    =	date('Y-m-d');
		$starttime = date("Y-m-d", strtotime($this->input->post('starttime')));
		
		$data = array(
					    'listing_type' => $listing_type,
						'listing_id' => $this->input->post('viewing_listing_id'),
						'listing_ref' => $this->input->post('viewing_listing_ref'),
						'viewing_landlord_id' => $this->input->post('viewing_landlord_id'),
						'starttime' =>$starttime,
						'viewing_status' => $this->input->post('viewing_status'),
						'viewing_agent_id' => $this->input->post('viewing_agent_id'),
						'viewing_req_agent_id'=> $this->input->post('viewing_req_agent_id'),
						'viewing_lead_id'=> $this->input->post('viewing_lead_id'),
						'viewing_lead_ref'=> $this->input->post('viewing_lead_ref'),
						'viewing_landlord'=> $this->input->post('viewing_landlord'),
						'created_by' => $created_by,
						'dateadded'=>$dateadded,
						'dateupdated'=>$dateupdated,
						'viewing_notes'=>$this->input->post('viewing_notes')
					);
			  $this->db->insert('crm_terminals_viewings', $data); // insert new record
		
	
	}
	public function save_notes($notes_listing_id,$terminal_notes,$type)
	{
		$created_by =  $this->session->userdata('userid');
		$dateadded	=	date('Y-m-d');
		$data = array(
		'notes'=>$terminal_notes,
		'created_by' => $created_by,
		'dateadded'=>$dateadded,
		'listing_id'=>$notes_listing_id,
		'listing_type'=>$type
		);
			  $this->db->insert('crm_viewings_notes', $data); // insert new record
	}
	public function getNotes($id)
	{
		$this->db->select("n.id,n.dateadded,n.notes,u.first_name,u.last_name");
		$this->db->from("crm_viewings_notes n");
		$this->db->join('crm_users u', 'n.created_by = u.id');
		$where = " n.listing_type=1 and n.listing_id=".$id;
		$this->db->where($where);
		$this->db->order_by("n.id", "desc");
		
			$query = $this->db->get();
			return $query->result_array();
	}
}