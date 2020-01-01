<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Shafiq
 * Description: todo model class
 */
class Todo_model extends CI_Model{
	  
     
    function __construct(){
        parent::__construct();
		$this->load->database();
	  
    	
    }
	public function datatable()
	{
				
				$c = 'id,ref,title,status,priority,due_date,assigned_by,assigned_to_id,notes,dateadded';
					$this->datatables->select($c)
						->unset_column('id')//this means if you want to include in columns or search
						->from('crm_todo');
				
					return $this->datatables->generate();
				
       }
}