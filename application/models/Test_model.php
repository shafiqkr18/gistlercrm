<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: rentals model class
 */
class Test_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
	
	public function datatable()
	{
				
	
				$c ='id,ref,type,category_id,region_id,area_location_id,sub_area_location_id,beds,size,price,agent_id,dateadded';
					$this->datatables->select($c)
					->unset_column('id')//this means if you want to include in columns or search
						->from('crm_listings');
				//$this->datatables->join('crm_users', 'crm_users.id = crm_owners.created_by', 'left');
						
				$this->datatables ->where('crm_listings.is_active', 1); 
				
					return $this->datatables->generate();
				
       }
		public function datatable1()
	{
		$c = 'crm_rentals.id as id,crm_rentals.ref as ref,crm_rentals.unit as unit,crm_category.category as cat';
		$this->datatables->select($c)
			   // ->unset_column('id')//this means if you want to include in columns or search
				->from('crm_rentals');
				$this->datatables->join('crm_category', 'crm_rentals.category_id = crm_category.id', 'left');
		
			return $this->datatables->generate();
       }
	   
	   public function datatable_old()
	{
		$c = 'id,terminal,status,managed,exclusive,shared,ref,unit,category_id,region_id,area_location_id,sub_area_location_id,beds,size,
		price,agent_id,landlord_id,unit_type,baths,street_no,floor_no,dewa_no,photos,cheques,fitted,prop_status,source_of_listing,available_date,
		remind_me,furnished,featured,maintenance,strno,amount,tenanted,plot_size,name,view_id,commission,deposit,unit_size_price,dateadded,dateupdated,
		created_by as user_id,key_location,development_unit_id';
			$this->datatables->select($c)
			    ->unset_column('id')//this means if you want to include in columns or search
				->from('crm_rentals ');
				
	 
			return $this->datatables->generate();
       }
	
}