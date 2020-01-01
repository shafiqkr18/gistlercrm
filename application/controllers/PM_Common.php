<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Description: common controller for all common functions
 * Date: 23 Nov,2015
 */
class PM_Common extends CI_Controller {
	
	public function __construct(){
     	parent::__construct();
     	// Your own constructor code
		 // $this->original_path = "./uploads/listings/";
		 // $this->document_path = "./uploads/documents/listings/";     	
		$this->original_path = "./uploads/PM/";
		$this->document_path = "./uploads/PM/documents/";
		$this->load->library('Uuid');

		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
		$adm_type = $this->session->userdata('user_type');			
		$this->load->model('PM_Model');
    
	}

    function GetListings(){
		$listingType =  $this->input->get('listingType');
		echo $this->PM_Model->GetListings($listingType);
    }

    function GetCategories(){
		$res = $this->PM_Model->GetCategories();
		$this->output->set_content_type('application/json');
		echo json_encode($res);    	
	}

    function GetAgents(){
    }

 	function uploadDocuments_(){
		if ($this->session->userdata('userid') < 1)
		{ 
			redirect('login');
		}

		$error = "";
		$rand_key    =    $this->input->post('rand_key');
		$note    =   $this->input->post('note');
		$docname  =   $this->input->post('docname');
		// echo "note-->" . $note;exit;
		
		$this->load->library('image_lib');
		$new_name = $this->uuid->v4();
		//echo $rand_key."=".$rand_key;exit;
		//$new_name = $rand_key.date('YmdHis',time()).md5(time());//.".".$image_data['file_ext'];
		//echo "new_name: " . $new_name;exit;

		$image_upload_folder = $this->document_path.$this->session->userdata('client_id');//."/".$this->session->userdata('userid');//."/".md5($rand_key);   // folder page
		//echo "uploadfolder" . $image_upload_folder;
		//exit;

		if (!file_exists($image_upload_folder)) {
			mkdir($image_upload_folder, DIR_WRITE_MODE, true);
		}
		//'allowed_types' => "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp",
		
		$config = array(
		'upload_path' => $image_upload_folder, //upload directory
		'file_name'  => $new_name,
		'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|ppt|pptx|csv",
		'overwrite' => TRUE,
		'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
		'max_height' => "768",
		'max_width' => "1024"
		);

		$image1='listings_documents';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($image1))
		{
			echo "here";exit;
			$error = array('error' => $this->upload->display_errors());
			// print_r("error nga. " . var_dump($this->upload->display_errors('', '')));
            // echo var_dump($error);
		}
		else
		{
			echo "controller: success";exit;
			$image_data=$this->upload->data();
			$new_name = $new_name.$image_data['file_ext'];
			$image_id = $this->PM_Model->SaveImages($rand_key, $new_name);
			echo $new_name;
		}
	}

 	function uploadDocuments()
	{	

		if ($this->session->userdata('userid') < 1)
		{ 
			redirect('login');
		}

		$error = "";
		$listing_id  =   $this->input->post('listing_id');
		$rand_key    =   $this->input->post('rand_key');
		$title    =   $this->input->post('title');
		
		//echo $listing_id."=".$rand_key."=".$title;
		 $this->load->library('image_lib');
			$new_name = $rand_key.date('YmdHis',time()).md5(time());//.".".$image_data['file_ext'];
			$image_upload_folder = $this->document_path.$this->session->userdata('client_id');//."/".$this->session->userdata('userid');//."/".md5($rand_key);   // folder page
			// $image_upload_folder = $this->document_path.$this->session->userdata('client_id')."/".$this->session->userdata('userid')."/".md5($rand_key);   // folder page
			 if (!file_exists($image_upload_folder)) {
				mkdir($image_upload_folder, DIR_WRITE_MODE, true);
			 }
			//'allowed_types' => "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp",
			
			$config = array(
			'upload_path' => $image_upload_folder, //upload directory
			'file_name'  => $new_name,
			'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|ppt|pptx|csv",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_height' => "768",
			'max_width' => "1024"
			);
			 $image1='listings_documents';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload($image1))
				{
					$error = array('error' => $this->upload->display_errors());
		
					
				}
				else
				{
						$image_data=$this->upload->data();
						$new_name = $new_name.$image_data['file_ext'];
						$image_id = $this->listings_model->save_documents($rand_key,$new_name,$listing_id,$title);
						echo md5($rand_key)."/".$new_name;
					
				}
	}
	
	function SaveNewUnit(){
		$objUnit = $this->input->post('objUnit');

		if($objUnit["id"] == 0){
			$objUnit["created_by"] = $this->session->userdata('userid');
			$objUnit["dateadded"] = date('Y-m-d H:i:s');
			
			$objUnit["view_id"] = str_replace("+"," ",$objUnit["view_id"]);
			$objUnit["name"] = str_replace("+"," ",$objUnit["name"]);
			$objUnit["description_demo"] = str_replace("+"," ",$objUnit["description_demo"]);
			$objUnit["landlordId"] = str_replace("+"," ",$objUnit["landlordId"]);

			$ref = $this->PM_Model->GetMaxId('crm_pm_units') + 1;
			$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

			$objUnit["ref"] = "GIS-UN-".$ref;

			$objUnit["client_id"] = $this->session->userdata('client_id');
		}
		$objUnit["dateupdated"] = date('Y-m-d H:i:s');
		// return $res = $this->PM_Model->SaveNewUnit($objUnit);
		return $res = $this->PM_Model->SaveRecord($objUnit, "crm_pm_units");

	}

	function ImportUnit(){
		$listingID = $this->input->post('listingID');

		$ref = $this->PM_Model->GetMaxId('crm_pm_units') + 1;
		$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

		$ref = "GIS-PM-".$ref;
		
		return $res = $this->PM_Model->ImportUnit($listingID, $ref);
	}

	function GetUnits(){
		$prop_status =  $this->input->get('prop_status');
		$type =  $this->input->get('type');
		echo $this->PM_Model->GetUnits($prop_status, $type);
	}

	function GetUnit(){
		$unitId = $this->input->post('unitId');
		
		$res = $this->PM_Model->GetUnit($unitId);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	function GetLeases(){
		$unitId =  $this->input->get('unitId');
		echo $this->PM_Model->GetLeases($unitId);
	}

	function GetLease(){
		$leaseId = $this->input->post('leaseId');
		
		$res = $this->PM_Model->GetLease($leaseId);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	function SaveLease(){
		$objLease = $this->input->post('objLease');

		if($objLease["id"] == 0){
			$objLease["created_by"] = $this->session->userdata('userid');
			$objLease["dateadded"] = date('Y-m-d H:i:s');

			$ref = $this->PM_Model->GetMaxId('crm_pm_leases') + 1;
			$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

			$objLease["ref"] = "GIS-LE-".$ref;		
		}

		$objLease["dateupdated"] = date('Y-m-d H:i:s');

		return $res = $this->PM_Model->SaveRecord($objLease, "crm_pm_leases");
	}

	function SaveLeaseNote(){

		$ref = $this->PM_Model->GetMaxId('crm_pm_lease_notes') + 1;
		$ref = "GIS-LN-". str_pad($ref, 4, '0', STR_PAD_LEFT);

		$objNote = array(
			'leaseId' => $this->input->post('leaseId'),
			'note' => $this->input->post('note'),
			'datecreated' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('userid')
		);  

		//echo var_dump($objNote);exit;

		return $this->PM_Model->SaveLeaseNote($objNote);
	}

	function SaveUnitNote(){

		$ref = $this->PM_Model->GetMaxId('crm_pm_units_notes') + 1;
		$ref = "GIS-UN-". str_pad($ref, 4, '0', STR_PAD_LEFT);

		$objNote = array(
			'unitId' => $this->input->post('unitId'),
			'note' => $this->input->post('note'),
			'datecreated' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('userid')
		);  

		//echo var_dump($objNote);exit;

		return $this->PM_Model->SaveUnitNote($objNote);
	}

	function SaveLeaseDocuments(){

	}

	#Workorders

	function SaveWorkOrder(){
		$objWorkOrder = $this->input->post('objWorkOrder');

		if($objWorkOrder["id"] == 0){
			$objWorkOrder["created_by"] = $this->session->userdata('userid');
			$objWorkOrder["dateadded"] = date('Y-m-d H:i:s');

			$ref = $this->PM_Model->GetMaxId('crm_pm_workorders') + 1;
			$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

			$objWorkOrder["ref"] = "GIS-WO-".$ref;		
		}

		$objWorkOrder["dateupdated"] = date('Y-m-d H:i:s');

		return $res = $this->PM_Model->SaveRecord($objWorkOrder, "crm_pm_workorders");
	}

	function GetWorkOrders(){
		$unitId =  $this->input->get('unitId');
		echo $this->PM_Model->GetWorkOrders($unitId);
	}

	function GetWorkOrder(){
		$workorderID = $this->input->post('workorderID');
		
		$res = $this->PM_Model->GetWorkOrder($workorderID);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}	

	function SaveWorkOrderNote(){

		$ref = $this->PM_Model->GetMaxId('crm_pm_workorders_notes') + 1;
		$ref = "GIS-WN-". str_pad($ref, 4, '0', STR_PAD_LEFT);

		$objNote = array(
			'workorderID' => $this->input->post('workorderID'),
			'note' => $this->input->post('note'),
			'datecreated' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('userid')
		);  

		//echo var_dump($objNote);exit;

		return $this->PM_Model->SaveWorkOrderNote($objNote);
	}	

	function SaveTransaction(){
		$objTransaction = $this->input->post('objTransaction');

		if($objTransaction["id"] == 0){
			$objTransaction["created_by"] = $this->session->userdata('userid');
			$objTransaction["dateadded"] = date('Y-m-d H:i:s');

			$ref = $this->PM_Model->GetMaxId('crm_pm_accounts') + 1;
			$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

			$objTransaction["ref"] = "GIS-TR-".$ref;		
		}

		$objTransaction["dateupdated"] = date('Y-m-d H:i:s');

		return $res = $this->PM_Model->SaveRecord($objTransaction, "crm_pm_accounts");
	}

	function GetTransactions(){
		$transactiontype =  $this->input->get('transactiontype');
		echo $this->PM_Model->GetTransactions($transactiontype);
	}	

	function GetTransaction(){
		$transactionId = $this->input->post('transactionId');
		
		$res = $this->PM_Model->GetTransaction($transactionId);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	function SaveTransactionNote(){

		$ref = $this->PM_Model->GetMaxId('crm_pm_accounts_notes') + 1;
		$ref = "GIS-TN-". str_pad($ref, 4, '0', STR_PAD_LEFT);

		$objNote = array(
			'accountId' => $this->input->post('transactionId'),
			'note' => $this->input->post('note'),
			'datecreated' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('userid')
		);  

		//echo var_dump($objNote);exit;

		return $this->PM_Model->SaveTransactionNote($objNote);
	}

	function SaveLandlord(){
		$objLandlord = $this->input->post('objLandlord');

		if($objLandlord["id"] == 0){
			$objLandlord["created_by"] = $this->session->userdata('userid');
			$objLandlord["dateadded"] = date('Y-m-d H:i:s');

			$ref = $this->PM_Model->GetMaxId('crm_pm_landlords') + 1;
			$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

			$objLandlord["ref"] = "GIS-LA-".$ref;		
		}

		$objLandlord["dateupdated"] = date('Y-m-d H:i:s');

		return $res = $this->PM_Model->SaveRecord($objLandlord, "crm_pm_landlords");
	}

	function GetLandlords(){
		//$lease_status =  $this->input->get('lease_status');
		echo $this->PM_Model->GetLandlords();
	}

	function GetLandlord(){
		$landlordId = $this->input->post('landlordId');
		
		$res = $this->PM_Model->GetLandlord($landlordId);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	function SaveLandlordNote(){

		$ref = $this->PM_Model->GetMaxId('crm_pm_landlords_notes') + 1;
		$ref = "GIS-LN-". str_pad($ref, 4, '0', STR_PAD_LEFT);

		$objNote = array(
			'landlordId' => $this->input->post('landlordId'),
			'note' => $this->input->post('note'),
			'datecreated' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('userid')
		);  

		//echo var_dump($objNote);exit;

		return $this->PM_Model->SaveLandlordNote($objNote);
	}	


	function SaveTenant(){
		$objTenant = $this->input->post('objTenant');

		if($objTenant["id"] == 0){
			$objTenant["created_by"] = $this->session->userdata('userid');
			$objTenant["dateadded"] = date('Y-m-d H:i:s');

			$ref = $this->PM_Model->GetMaxId('crm_pm_tenants') + 1;
			$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

			$objTenant["ref"] = "GIS-TE-".$ref;		
		}

		$objTenant["dateupdated"] = date('Y-m-d H:i:s');

		echo $this->PM_Model->SaveRecord($objTenant, "crm_pm_tenants");
	}

	function GetTenants(){
		//$lease_status =  $this->input->get('lease_status');
		echo $this->PM_Model->GetTenants();
	}

	function GetTenant(){
		$tenantId = $this->input->post('tenantId');
		
		$res = $this->PM_Model->GetTenant($tenantId);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	function SaveTenantNote(){

		$ref = $this->PM_Model->GetMaxId('crm_pm_tenants_notes') + 1;
		$ref = "GIS-EN-". str_pad($ref, 4, '0', STR_PAD_LEFT);

		$objNote = array(
			'tenantId' => $this->input->post('tenantId'),
			'note' => $this->input->post('note'),
			'datecreated' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('userid')
		);  

		//echo var_dump($objNote);exit;

		return $this->PM_Model->SaveTenantNote($objNote);
	}	

	function SaveServiceProvider(){
		$objServiceProvider = $this->input->post('objServiceProvider');

		//echo var_dump($objServiceProvider);

		if($objServiceProvider["id"] == 0){
			$objServiceProvider["created_by"] = $this->session->userdata('userid');
			$objServiceProvider["dateadded"] = date('Y-m-d H:i:s');

			$ref = $this->PM_Model->GetMaxId('crm_pm_serviceproviders') + 1;
			$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

			$objServiceProvider["ref"] = "GIS-SP-".$ref;		
		}



		$objServiceProvider["dateupdated"] = date('Y-m-d H:i:s');

		return $res = $this->PM_Model->SaveRecord($objServiceProvider, "crm_pm_serviceproviders");
	}

	function GetServiceProviders(){
		//$lease_status =  $this->input->get('lease_status');
		echo $this->PM_Model->GetServiceProviders();
	}

	function GetServiceProvider(){
		$serviceproviderId = $this->input->post('serviceproviderId');

		$res = $this->PM_Model->GetServiceProvider($serviceproviderId);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	function SaveServiceProviderNote(){

		$ref = $this->PM_Model->GetMaxId('crm_pm_serviceproviders_notes') + 1;
		$ref = "GIS-SN-". str_pad($ref, 4, '0', STR_PAD_LEFT);

		$objNote = array(
			'serviceproviderId' => $this->input->post('serviceproviderId'),
			'note' => $this->input->post('note'),
			'datecreated' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('userid')
		);  

		//echo var_dump($objNote);exit;

		return $this->PM_Model->SaveServiceProviderNote($objNote);
	}

	function GetUnitsHeaderCounts(){
		$res = $this->PM_Model->GetUnitsHeaderCounts();
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	function GetLeasesHeaderCounts(){
		$res = $this->PM_Model->GetLeasesHeaderCounts();
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	function GetWorkOrdersHeaderCounts(){
		$res = $this->PM_Model->GetWorkOrdersHeaderCounts();
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}	

	function GetAccountsHeaderCounts(){
		$res = $this->PM_Model->GetAccountsHeaderCounts();
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	function GetLandlordsHeaderCounts(){
		$res = $this->PM_Model->GetLandlordsHeaderCounts();
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	function GetTenantsHeaderCounts(){
		$res = $this->PM_Model->GetTenantsHeaderCounts();
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	function GetServiceProvidersHeaderCounts(){
		$res = $this->PM_Model->GetServiceProvidersHeaderCounts();
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	function GetTransactionsPerUnit(){
		$unitId = $this->input->get('unitId');

		echo $this->PM_Model->GetTransactionsPerUnit($unitId);
	}

	function GetPayments(){
		$unitId = $this->input->post('unitId');
		// $quarter = $this->input->post('quarter');

		$res = $this->PM_Model->GetPayments($unitId);//($unitId, $quarter);
		$this->output->set_content_type('application/json');
		echo json_encode($res);
	}

	function GetServiceProviderNames(){
		// $unitId = $this->input->post('unitId');
		// $quarter = $this->input->post('quarter');

		$res = $this->PM_Model->GetServiceProviderNames();
		$this->output->set_content_type('application/json');

		echo json_encode($res);
	}

	function SavePayments(){
		$objPaymentDetails = $this->input->post('objPayment');
		$headerId = $this->input->post('headerId');
		$ref = $this->input->post('ref');
		$unitId = $this->input->post('unitId');

		$objPaymentHeader = array(
			"id" =>$headerId,
			"ref" =>$ref,
			"unitId" => $unitId,
			"updatedby" => $this->session->userdata('userid')
		);			

		if($headerId == 0){
			$objPaymentHeader["createdby"] = $this->session->userdata('userid');
			$objPaymentDetails["createdby"] = $this->session->userdata('userid');

			$objPaymentHeader["dateadded"] = date('Y-m-d H:i:s');

			$ref = $this->PM_Model->GetMaxId('crm_pm_payments_header') + 1;
			$ref = str_pad($ref, 4, '0', STR_PAD_LEFT);

			$objPaymentHeader["ref"] = "GIS-PA-".$ref;		
		}

		$objPaymentDetails["dateupdated"] = date('Y-m-d H:i:s');
		$objPaymentDetails["updatedby"] = $this->session->userdata('userid');

		return $this->PM_Model->SavePayments($objPaymentHeader, $objPaymentDetails);
	}

	function DeletePaymentRecord(){
		$payeeId = $this->input->post('payeeId');
		$headerId = $this->input->post('headerId');

		$this->PM_Model->DeletePaymentRecord($payeeId, $headerId);
	}

	function GetServiceProviderTypes(){
		$res = $this->PM_Model->GetServiceProviderTypes();
		$this->output->set_content_type('application/json');

		echo json_encode($res);
	}	

	function GetServiceProviderSubTypes(){
		$typeId = $this->input->get("typeId");

		$res = $this->PM_Model->GetServiceProviderSubTypes($typeId);
		$this->output->set_content_type('application/json');

		echo json_encode($res);
	}	

	function SaveSubType(){
		$objSubType = $this->input->post('objSubType');

		$objSubType["dateadded"] = date('Y-m-d H:i:s');

		return $res = $this->PM_Model->SaveSubType($objSubType);		
	}

	function GetExpiringLeases(){
		$res = $this->PM_Model->GetExpiringLeases();
		$this->output->set_content_type('application/json');
		echo json_encode($res);		
	}

	function GetRecentlyViewedListings(){
		$res = $this->PM_Model->GetRecentlyViewedListings();
		$this->output->set_content_type('application/json');
		echo json_encode($res);				
	}

	function GetDueWorkOrders(){
		$res = $this->PM_Model->GetDueWorkOrders();
		$this->output->set_content_type('application/json');
		echo json_encode($res);				
	}

	function GetWorkOrdersInProgress(){
		$res = $this->PM_Model->GetWorkOrdersInProgress();
		$this->output->set_content_type('application/json');
		echo json_encode($res);				
	}

	function CallDashboardTables(){
		$res = $this->PM_Model->CallDashboardTables();
		$this->output->set_content_type('application/json');
		echo json_encode($res);				
	}

	function GetWorkTypes(){
		$res = $this->PM_Model->GetWorkTypes();
		$this->output->set_content_type('application/json');
		echo json_encode($res);				
	}	

	function GetWorkSubTypes(){
		$typeId = $this->input->post("typeId");

		$res = $this->PM_Model->GetWorkSubTypes($typeId);
		$this->output->set_content_type('application/json');
		echo json_encode($res);				
	}	
}
?>