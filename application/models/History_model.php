<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Shafiq

 * Description: History_model model class

 */

class History_model extends CI_Model{

	  

     

    function __construct(){

        parent::__construct();

		$this->load->database();

	  

    	

    }

	function history_datatable()

	{

		

		$c = 'd.id,"Listings" as screen,d.ref,CONCAT(crm_users.first_name, " ", crm_users.last_name) as user,d.action_field,d.action_values,d.dt_datetime,d.action';

		$this->datatables->select($c)

						->unset_column('id')//this means if you want to include in columns or search

						->from('crm_listings_versions_details as d');

						$this->datatables->join('crm_users', 'crm_users.id = d.created_by', 'left');

					

						return $this->datatables->generate();

	}

	function loginhistory_datatable()
	{
		$c = 'CONCAT(crm_users.first_name, " ", crm_users.last_name) as user_id,d.status,d.activitytime';
		$this->datatables->select($c)

						->unset_column('id')//this means if you want to include in columns or search

						->from('crm_loginhistory as d');

						$this->datatables->join('crm_users', 'crm_users.id = d.user_id', 'left');

					

						return $this->datatables->generate();
	}

}