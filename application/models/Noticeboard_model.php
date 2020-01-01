<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: Noticeboard_model model class
 */
class Noticeboard_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
public function save_notice()
	{
		
			$user_id 	=  $this->session->userdata('userid');
			$client_id =$this->session->userdata('client_id');
			$dateadded   =   date('Y-m-d H:i:s');
			
			$data = array(
					   
						'client_id' => $client_id,
						'notice' => $this->input->post('notice'),
						'user_id' => $user_id,
						'dateadded' => $dateadded
						
						
						
					);
			$res=  $this->db->insert('crm_notices', $data); // insert new record
			
			if($res) echo "Notice saved Successfully!";
			else echo "There was an error! try again later";
			
		  
	}
  public function datatable_notices()
	{
		$c = 'crm_notices.id,crm_notices.notice,CONCAT(crm_users.first_name, " ", crm_users.last_name) as user,crm_notices.dateadded';
		$this->datatables->select($c)
						->unset_column('id')//this means if you want to include in columns or search
						->from('crm_notices');
				$this->datatables->join('crm_users', 'crm_users.id = crm_notices.user_id', 'left');
			
				
						
				$this->datatables ->where('crm_notices.is_active', 1); 
				
					return $this->datatables->generate();
	}
 public function datatable_documents()
	{
		$c = 'crm_notices_documents.id,crm_notices_documents.title,crm_notices_documents.dateadded,crm_notices_documents.file_size
		,CONCAT(crm_users.first_name, " ", crm_users.last_name) as user,crm_notices_documents.file_type';
		$this->datatables->select($c)
						->unset_column('id')//this means if you want to include in columns or search
						->add_column('download', get_Download('$1'), 'crm_notices_documents.id')
						->from('crm_notices_documents');
				$this->datatables->join('crm_users', 'crm_users.id = crm_notices_documents.user_id', 'left');
			
				
						
				$this->datatables ->where('crm_notices_documents.is_active', 1); 
				
					return $this->datatables->generate();
	}
public function save_documents($file_name,$title,$file_size,$image_type)
	{
		
			$admin_ID 	=  $this->session->userdata('userid');
			$client_id =$this->session->userdata('client_id');
			$dateadded	=	date('Y-m-d H:i:s');
			
			$data = array(
					   
						'client_id' => $client_id,
						'title' => $title,
						'file_name' => $file_name,
						'user_id' => $admin_ID,
						'dateadded' => $dateadded,
						'file_type'=>$image_type,
						'file_size'=>$file_size
						
						
					);
			return  $this->db->insert('crm_notices_documents', $data); // insert new record
			
		  
	}
	public function getDocumentById($id=0)
	{
		$query = $this->db->query('SELECT file_name FROM crm_notices_documents where id='.$id);
		return $query->row();
		
	}
	public function save_target($target,$agent_id)
	{
		    $admin_ID 	= $this->session->userdata('userid');
			$data=array('target'=>$target,'created_by'=>$admin_ID);
			$this->db->where('id',$agent_id);
			$res = $this->db->update('crm_users',$data);
			
			if($res) echo "Target saved Successfully!";
			else echo "There was an error! try again later";
	}
	public function datatable_target()
	{
		$c = 'crm_users.id,crm_users.is_active,crm_users.first_name,crm_users.last_name,crm_users.target,
		(SELECT sum(commission) as cmn FROM `crm_deals` where agent_id=crm_users.id AND
		 MONTH(deal_date) = MONTH(CURDATE())
  		AND YEAR(deal_date) = YEAR(CURDATE())) as current_month,
  		crm_users.created_by,
  		(SELECT sum(commission) as cmn1 FROM `crm_deals` where agent_id=crm_users.id AND
		YEAR(deal_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
        AND MONTH(deal_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) as last_month,
		(select count(id) as cnt_deals from crm_deals where agent_id=crm_users.id) as cnt_deals,
		crm_users.status
		';
		$this->datatables->select($c)
						->unset_column('id')//this means if you want to include in columns or search
						->add_column('TargetHit', get_TargetHit('$1'), 'id')
						->from('crm_users');
						
				$this->datatables ->where('crm_users.is_active', 1); 
				$this->datatables ->where('crm_users.status', 1); 
				
					return $this->datatables->generate();
	}
public function getallDeals()
{
	$this->db->select('d.deal_date,sum(d.commission) as "commission",CONCAT(crm_users.first_name, " ", crm_users.last_name) as agent, d.agent_id');
		$this->db->from('crm_deals AS d');
		$this->db->join('crm_users', 'crm_users.id = d.agent_id');
		$where = " YEAR(d.deal_date) = YEAR(NOW())
					AND MONTH(d.deal_date) = MONTH(NOW())";
		$this->db->where($where);
		$this->db->group_by(array("deal_date", "agent_id")); 
		//echo $this->db->get_compiled_select();exit;
			$query = $this->db->get();
			$query = $query->result_array();
			foreach($query as $i=>$product) {
		
		   // Get an array of products images
		  $this->db->select('sum(d.commission) as "commission" ');
		   $this->db->where('agent_id', $product['agent_id']);
		     $this->db->where('is_active', 1);
			 $where = " YEAR(d.deal_date) = YEAR(NOW())
					AND MONTH(d.deal_date) = MONTH(NOW())";
		$this->db->where($where);
			$this->db->group_by(array("deal_date", "agent_id")); 
		   $images_query = $this->db->get('crm_deals d')->result_array();
		
		   // Add the images array to the array entry for this product
		   $query[$i]['cmn'] = $images_query;
		
		}
	return $query;
}
	
}