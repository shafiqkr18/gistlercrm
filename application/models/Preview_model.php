<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: preview model class
 */
class Preview_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
	public function get_Listing($id)
		{
			
			  $this->db->select('r.*,c.category,l.loc_name,s.sub_sub_loc,city.name as cityname');
	         $this->db->from('crm_listings as r');
			 $this->db->join('crm_category AS c', 'r.category_id = c.id','left');
			 $this->db->join('crm_location AS l', 'r.area_location_id = l.loc_id','left');
			 $this->db->join('crm_subloc AS s', 'r.sub_area_location_id=s.sub_loc_id','left');
			  $this->db->join('crm_city AS city', 'r.region_id = city.id','left');
			 $this->db->where('r.id', $id);
		    $this->db->limit('1');
		    $query = $this->db->get();
		    if( $query->num_rows() == 1 ){
		      // One row, match!
		      return $query->row();        
		    } else {
		      // None
		      return false;
		    }
		}
	public function get_Images($listing_id)
	{
		$this->db->select('thumb,watermark_image');
		$this->db->from('crm_listings_images');
		$this->db->where('is_active', 1);
		$this->db->where('listing_id', $listing_id);
		$this->db->order_by("position", "desc");
		$query = $this->db->get();
				return $query->result_array();
	}	
	public function get_Agent($id)
		{
			
			  $this->db->select('r.*,c.name as CMP');
	         $this->db->from('crm_users as r');
			 $this->db->join('crm_profile AS c', 'r.client_id = c.id','left');
			
			 $this->db->where('r.id', $id);
		    $this->db->limit('1');
		    $query = $this->db->get();
		    if( $query->num_rows() == 1 ){
		      // One row, match!
		      return $query->row();        
		    } else {
		      // None
		      return false;
		    }
		}
	public function get_Features($ids)
		{
			$ids = str_replace('{','',$ids);
			$ids = str_replace('}',',',$ids);
			$ids = trim($ids,',');
			
			  
			$this->db->select("title");
			$this->db->from("crm_features");
			$where = "is_active = 1 AND id IN(" . $ids . ")";
			$this->db->where($where);
			$this->db->order_by("title", "asc");
			//echo $this->db->get_compiled_select();exit;
				$query = $this->db->get();
				return $query->result_array();
		}
}