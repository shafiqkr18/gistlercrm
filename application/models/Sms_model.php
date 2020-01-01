<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: sms_model model class
 */
class Sms_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
	
	function agents_datatable()
	{
		
		$c = 'id,first_name,last_name,job_title,office_no,mobile_no_new_ccode,mobile_no_new,email';
		$this->datatables->select($c)
						//->unset_column('id')//this means if you want to include in columns or search
						->from('crm_users');
						$this->datatables ->where('is_active', 1); 
						$this->datatables ->where('status', 1); 
						return $this->datatables->generate();
	}
	function contacts_datatable()
	{
		
		$c = 'id,name,last_name,nationality,phone,mobile_no_new_ccode,mobile_no_new,email';
		$this->datatables->select($c)
						//->unset_column('id')//this means if you want to include in columns or search
						->from('crm_owners');
						$this->datatables ->where('is_active', 1); 
						return $this->datatables->generate();
	}
}