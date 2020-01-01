<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: calendar model class
 */
class Calendar_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
	public function getEventInfo($event_id)
	{
		$this->db->select("*");
		$this->db->from("events");
		$where = "event_id=".$event_id;
		$this->db->where($where);
		$query = $this->db->get();
		if( $query->num_rows() == 1 ){
			  // One row, match!
			  
				  $row =  $query->row(); 
				  return array(
					'event_id'=> ''.$row->event_id.'',
					'hdn_event_id'=> ''.$row->event_id.'',
					'hdn_emails'=> ''.$row->emails.'',
					'rec_type'=> ''.$row->event_id.'',
					'userColor'=> ''.$row->userColor.'',
					'users'=> ''.$row->userId.'',
					'start_date'=> ''.$row->start_date.'',
					'end_date'=> ''.$row->end_date.'',
					'event_type'=> ''.$row->event_type.'',
					'pack_agent_id'=> ''.$row->pack_agent_id.'',
					'event_name'=> ''.$row->event_name.'',
					'location'=> ''.$row->location.'',
					'description'=> ''.$row->description.'',
					'hdn_leads_id_edit'=> ''.$row->leads_id.'',
					'hdn_listings_id_edit'=> ''.$row->listings_id.'',
					'hdn_deals_id_edit'=> ''.$row->deals_id.''
					
					);
		}
	}
	public function getUserEventById($ids)
	{
		if($ids == '' || $ids === NULL)
		{
			$this->db->select("event_id,start_date, end_date, event_name");
		$this->db->from("events");
		$where = "is_active=1";
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
		}else{
			$this->db->select("event_id,start_date, end_date, event_name");
		$this->db->from("events");
		$where = "event_id=".$ids;
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
		}
		
	}
	public function getAllEvents()
	{
		$this->db->select("event_id,start_date, end_date, event_name");
		$this->db->from("events");
		$where = "is_active=1";
		$this->db->where($where);
			$query = $this->db->get();
			return $query->result_array();
	}
	public function getAllEventsByUsers($ids)
	{
		if($ids == '' || $ids === NULL)
		{
			return true;
		}else{
		$this->db->select("event_id,start_date, end_date, event_name");
		$this->db->from("events");
		if (strpos($ids, ',') !== false) {
		    $where = "is_active=1 AND userId IN(" . implode(",", (array)$ids) . ")";
		}else{
			$where = "is_active=1 AND userId =".$ids;
		}
		
		
		$this->db->where($where);
	//	echo $this->db->get_compiled_select();exit;
		$query = $this->db->get();
		return $query->result_array();
		}
	}
	public function editRepeatEvent($id)
	{
		$this->db->select('*');
		$this->db->from('events');
		$where = "event_id=".$id;
		$this->db->where($where);
		$query = $this->db->get();
		 if( $query->num_rows() == 1 ){
		 	 $row =  $query->row(); 
		 	$repeat_count = 0;
			 $repeat_count2=0;
			 $repeat_days = '';
			 $repeat_sdate='';
			 $repeat_edate = '';
			 $repeat_edate_never = '';
		 	return $row->repeat_type."|".$repeat_count."|".$row->repeatd."|".$repeat_count2."|".$repeat_days."|".$repeat_sdate."|".$repeat_edate.
		 	"|".$repeat_edate_never;
		 	
		 }else{
		 return;
		 }
	}
	public function setGuestEmails()
	{
		
		$query = $this->db->select("emails");
		$this->db->from("events");
			$query = $this->db->get();
			return $query->result_array();
	}
	public function getGuestEmails($value='')
	{
		return $this->db->query("select emails from events where event_id=".$value)->row()->emails;
	}
	public function setEditGuestEmails($value='')
	{
		return $this->db->query("select emails from events where event_id=".$value)->row()->emails;
	}
	public function delete_event($id)
	{
		$admin_ID 	=  $this->session->userdata('userid');
		
		$dateupdated = date('Y-m-d H:i:s');
		$this->db->query("UPDATE events SET is_active= IF(is_active=1, 0, 1),dateupdated='$dateupdated'  WHERE event_id = '" . $id . "'");
	}
	public function getAllUsers()
	{
		$this->db->select("id,CONCAT(first_name, ' ', last_name) As name");
		$this->db->from("crm_users");
		$where = "is_active = 1 AND STATUS=1";
		$this->db->where($where);
		$this->db->order_by("name", "asc");
		//echo $this->db->get_compiled_select();exit;
			$query = $this->db->get();
			return $query->result_array();
	}
	public function getAllCal_Users()
	{
		$this->db->select("id,CONCAT(first_name, ' ', last_name) As name,access");
		$this->db->from("crm_users");
		$where = "is_active = 1 AND STATUS=1";
		$this->db->where($where);
		$this->db->order_by("name", "asc");
		//echo $this->db->get_compiled_select();exit;
			$query = $this->db->get();
			return $query->result_array();
	}
	
	function insertEvent()
	{
			//hdn_emails2=&hdn_repeat=&cusers=1448804&cstart_date=2015-11-17+14%3A55%3A00&cend_date=2015-11-26+15%3A00
// %3A00&cevent_type=Meeting&pack_agent_id=1448804&ctime_1=30&ctimeunit_1=minute&cevent_name=checking+it
// &clocation=dubai&cdescription=desctiption+here&hdn_leads_id=&hdn_listings_id=&hdn_deals_id=&lead_ref
// =&listing_ref=&deal_ref=&repeat_type=&repeatd=1&repstart_date=&day_ends_on=&repeatw=1&repstart_date=
// &week_ends_on=&repeatm=1&day_of_week=1&days_of_week=7&repstart_date=&month_ends_on=&repeaty=1&repstart_date
// =&year_ends_on=
	// hdn_emails2=&hdn_repeat=&cusers=84&cstart_date=2016-03-10+00%3A00%3A00&cend_date=2016-03-10+00%3A05%3A00
// &cevent_type=Viewing&pack_agent_id=84&cevent_name=this+is+shaafi&clocation=dubai+marina+office&cdescription
// =hhahahaha&hdn_leads_id=&hdn_listings_id=&hdn_deals_id=&lead_ref=&listing_ref=&deal_ref=&repeat_type
// =&repeatd=1&repstart_date=&day_ends_on=&repeatw=1&repstart_date=&week_ends_on=&repeatm=1&day_of_week
// =1&days_of_week=7&repstart_date=&month_ends_on=&repeaty=1&repstart_date=&year_ends_on=

// hdn_emails2=muhammad.royalhome%40gmail.com&hdn_repeat=&cusers=84&cstart_date=2016-03-10+00%3A00%3A00
// &cend_date=2016-03-10+00%3A05%3A00&cevent_type=&pack_agent_id=84&ctime_1=1&ctimeunit_1=hour&cevent_name
// =gf&clocation=fdsg&cdescription=sdfg&hdn_leads_id=&hdn_listings_id=&hdn_deals_id=&lead_ref=&listing_ref
// =&deal_ref=&repeat_type=day&repeatd=2&repstart_date=2016-03-10+00%3A00%3A00&ends_on=1&day_ends_on=2016-03-10
// +00%3A05%3A00&repeatw=1&repstart_date=2016-03-10+00%3A00%3A00&week_ends_on=&repeatm=1&day_of_week=1&days_of_week
// =7&repstart_date=2016-03-10+00%3A00%3A00&month_ends_on=&repeaty=1&repstart_date=2016-03-10+00%3A00%3A00
// &year_ends_on=

// hdn_emails2=muhammad.royalhome%40gmail.com%2Cabc%40gmail.com&hdn_repeat=&cusers=84&cstart_date=2016-03-10
// +00%3A00%3A00&cend_date=2016-03-10+00%3A05%3A00&cevent_type=&pack_agent_id=84&cevent_name=&clocation
// =&cdescription=&hdn_leads_id=&hdn_listings_id=&hdn_deals_id=&lead_ref=&listing_ref=&deal_ref=&repeat_type
// =&repeatd=1&repstart_date=&ends_on=1&day_ends_on=&repeatw=1&repstart_date=&week_ends_on=&repeatm=1&day_of_week
// =1&days_of_week=7&repstart_date=&month_ends_on=&repeaty=1&repstart_date=&year_ends_on=
// 	


	
			 $created_by 	=  $this->session->userdata('userid');
			 $dateadded = date('Y-m-d H:i:s');
			 $dateupdated = date('Y-m-d H:i:s');
			 
			 
			 if($this->input->post('hdn_event_id'))//this is update
			 {
			 	   $hdn_event_id = $this->input->post('hdn_event_id');
				   
				   $data_update = array(
					'event_type' =>$this->input->post('event_type'),
					'start_date'=> ($this->input->post('start_date') ? $this->input->post('start_date'):$dateadded),
					'end_date'=> ($this->input->post('end_date') ? $this->input->post('end_date'):$dateadded),
					'event_name'  =>$this->input->post('event_name'),
					'location'=> $this->input->post('location'),		
					'description' => $this->input->post('description'),
					'userId' => $this->input->post('users'),
					'created_by' => $created_by,
					'updated_by' => $created_by,
					
					'dateupdated' => $dateupdated,
					'emails' => $this->input->post('hdn_emails'),
					'day_ends_on' => $this->input->post('eday_ends_on'),
					//eends_on
					//emonthrepstart_date
					'day_of_week' =>$this->input->post('eday_of_week'),
					'days_of_week' =>$this->input->post('edays_of_week'),
					'hdn_repeat'=> $this->input->post('hdn_repeat'),
					'month_ends_on'=> $this->input->post('emonth_ends_on'),
					'pack_agent_id'  =>$this->input->post('pack_agent_id'),
					'repeat_type'=> $this->input->post('erepeat_type'),		
					'repeatd' => $this->input->post('repeatd'),
					'repeatm' => $this->input->post('erepeatm'),
					'repeatw' => $this->input->post('erepeatw'),
					'repeaty' => $this->input->post('erepeaty'),
					'repstart_date' => $this->input->post('erepstart_date'),
					'week_ends_on' => $this->input->post('eweek_ends_on'),
					
					'year_ends_on' =>$this->input->post('eyear_ends_on'),
					'listings_id'=> ($this->input->post('hdn_listings_id_edit') ? $this->input->post('hdn_listings_id_edit'):0),
					'leads_id'=>($this->input->post('hdn_leads_id_edit') ? $this->input->post('hdn_leads_id_edit'):0), 
					'deals_id'  =>($this->input->post('hdn_deals_id_edit') ? $this->input->post('hdn_deals_id_edit'):0),
					'listing_ref'=> $this->input->post('listing_ref_edit'),		
					'lead_ref' => $this->input->post('lead_ref_edit'),
					'deal_ref' => $this->input->post('deal_ref_edit')
					);
				   
				   $this->db->where('event_id', $hdn_event_id);
			       return  $this->db->update('events',$data_update); // update the record
			 }else{
			 	$data_save = array(
					'event_type' =>$this->input->post('cevent_type'),
					'start_date'=>  ($this->input->post('cstart_date') ? $this->input->post('cstart_date'):$dateadded),
					'end_date'=>  ($this->input->post('cend_date') ? $this->input->post('cend_date'):$dateadded),
					'event_name'  =>$this->input->post('cevent_name'),
					'location'=> $this->input->post('clocation'),		
					'description' => $this->input->post('cdescription'),
					'userId' => $this->input->post('cusers'),
					'created_by' => $created_by,
					'updated_by' => $created_by,
					'dateadded' => $dateadded,
					'dateupdated' => $dateupdated,
					'emails' => $this->input->post('hdn_emails2'),
					'day_ends_on' => $this->input->post('day_ends_on'),
					
					'day_of_week' =>$this->input->post('day_of_week'),
					'hdn_repeat'=> $this->input->post('hdn_repeat'),
					'month_ends_on'=> $this->input->post('month_ends_on'),
					'pack_agent_id'  =>$this->input->post('pack_agent_id'),
					'repeat_type'=> $this->input->post('repeat_type'),		
					'repeatd' => $this->input->post('repeatd'),
					'repeatm' => $this->input->post('repeatm'),
					'repeatw' => $this->input->post('repeatw'),
					'repeaty' => $this->input->post('repeaty'),
					'repstart_date' => $this->input->post('repstart_date'),
					'week_ends_on' => $this->input->post('week_ends_on'),
					
					'year_ends_on' =>$this->input->post('year_ends_on'),
					'listings_id'=> ($this->input->post('hdn_listings_id')?$this->input->post('hdn_listings_id'):0),
					'leads_id'=> ($this->input->post('hdn_leads_id')?$this->input->post('hdn_leads_id'):0),
					'deals_id'  =>($this->input->post('hdn_deals_id')?$this->input->post('hdn_deals_id'):0),
					'listing_ref'=> $this->input->post('listing_ref'),		
					'lead_ref' => $this->input->post('lead_ref'),
					'deal_ref' => $this->input->post('deal_ref')
					);
					return $this->db->insert('events', $data_save); // insert new record
			 }
			 
		 	
			 
			
						
	}
	 function save_calendar()
	 {
	



			 $created_by 	=  $this->session->userdata('userid');
			 $dateadded = date('Y-m-d H:i:s');
		 	
			$data_save = array(
					'title' =>$this->input->post('title'),
					'start_date'=> $this->input->post('start_date'),
					'end_date'=> $this->input->post('end_date'),
					'description'  =>$this->input->post('description_addevent'),
					'event_type'=> $this->input->post('event_type'),		
					'listing_id' => $this->input->post('listing_id'),
					'listing_ref' => $this->input->post('listing_ref'),
					'cal_id' => $this->input->post('cal_id'),
					'created_by' => $created_by,
					'dateadded' => $dateadded,
					'location' => $this->input->post('location'),
					
					);
					return $this->db->insert('crm_events', $data_save); // insert new record
				
			
	 }
}