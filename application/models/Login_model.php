<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
		
    }
    
    public function get_user($username, $password){
        // grab user input
       $this -> db -> select('*');
	   $this -> db -> from('crm_users');
	   $this -> db -> where('username', $username);

	   /* Dev note (kevin):
	   	* I commented out MD5($password) due to the fact that 
	   	* the password field in the database is not in MD5 format. 
	   	* Password field (in DB) is still in string
	   ----------------------------------------------------------------*/
	   
	   $this -> db -> where('password', MD5($password)); //MD5($password));

	   $this -> db -> where('is_active', 1);//either it is delete?
	   $this -> db -> where('status', 1);//either pending or publish
	   $this -> db -> limit(1);
	//echo $this->db->get_compiled_select();exit;
	   $query = $this -> db -> get();
	
	   if($query -> num_rows() == 1)
	   {
		 return $query->result();
	   }
	   else
	   {
		 return false;
	   }
    }
	
	public function save_loginhistory($user_id)
	{
		$data_save = array(
					    'status' => 0,//this is login
						'activitytime' => date('Y-m-d H:i:s'),
						'user_id' => $user_id
						);
		return $this->db->insert('crm_loginhistory', $data_save);				
	}
	
	
}
?>