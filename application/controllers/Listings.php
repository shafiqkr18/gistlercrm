<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: rentals contoller class
 * Date: 1 Dec,2015
 */
class Listings extends CI_Controller {
	  var $original_path;
   
	public function __construct()
	{
		
     	parent::__construct();
     	// Your own constructor code
		 $this->original_path = "./uploads/listings/";
		 $this->document_path = "./uploads/documents/listings/";
		 
		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
	$this->load->model('listings_model');
	$this->load->model('common_model');
	
				
    }
	public function index()
	{
		show_404();
	}
	public function rentals($listing_type='')
	{
		if ( ! file_exists(APPPATH.'/views/rentals/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('rentals');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		/*************end session values*********/
		
		/******************get form data*******/
			$data['getCat'] = $this->common_model->getAllCategories();
			$data['PropertyFeaturesPop'] = $this->common_model->getPropertyFeatures();
			$data['PropertyAmenitiesPop'] = $this->common_model->getPropertyAmenities();
			
			$data['copy_rentals_id'] = $this->input->post('copy_rentals_id');
		/*****************end form data********/
		
        /***********************get url data**************/
         $data['listing_type'] = '';
		 $data['listing_agent'] = '';
         if($listing_type == "published")
		 $data['listing_type'] = 2;
		 elseif ($listing_type == "pending")
		 $data['listing_type'] = 3;
		 elseif ($listing_type == "expired")
		 $data['listing_type'] = 100;
		 elseif ($listing_type == "less_photos")
		 $data['listing_type'] = 101;
		 elseif ($listing_type == "expiring")
		 $data['listing_type'] = 102;
		 
		 $data['listing_agent']= $this->input->get('agent_id');
        /***********************end url data*************/
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('rentals/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
		
		
	}

	public function international_rentals()
	{
		if ( ! file_exists(APPPATH.'/views/rentals/international_rentals.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('international rentals');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		$data['user_fullname'] = $this->session->userdata('user_fullname');
		/*************end session values*********/
		
		/******************get form data*******/
			$data['getCat'] = $this->common_model->getAllCategories();
			$data['PropertyFeaturesPop'] = $this->common_model->getPropertyFeatures();
			$data['PropertyAmenitiesPop'] = $this->common_model->getPropertyAmenities();
		/*****************end form data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('rentals/international_rentals', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
		
		
	}
	public function listings_quality()
	{
		if ( ! file_exists(APPPATH.'/views/rentals/listings_quality.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('rentals');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		/******************get form data*******/
			$data['agent_performance']= $this->listings_model->agent_performance();
			$data['getCat'] = $this->common_model->getAllCategories();
			$data['PropertyFeaturesPop'] = $this->common_model->getPropertyFeatures();
			$data['PropertyAmenitiesPop'] = $this->common_model->getPropertyAmenities();
			$data['formDataArchived'] = $this->load->view('partial/rental_entry', NULL, TRUE);
		/*****************end form data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('rentals/listings_quality', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	public function archived_rentals()
	{
		if ( ! file_exists(APPPATH.'/views/rentals/archive_home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('rentals');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		/******************get form data*******/
			$data['getCat'] = $this->common_model->getAllCategories();
			$data['PropertyFeaturesPop'] = $this->common_model->getPropertyFeatures();
			$data['PropertyAmenitiesPop'] = $this->common_model->getPropertyAmenities();
			$data['formDataArchived'] = $this->load->view('partial/rental_entry', NULL, TRUE);
		/*****************end form data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('rentals/archive_home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
		
		
	}
	
	public function archived_sales()
	{
		if ( ! file_exists(APPPATH.'/views/sales/archive_home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('Sales');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		/******************get form data*******/
			$data['getCat'] = $this->common_model->getAllCategories();
			$data['PropertyFeaturesPop'] = $this->common_model->getPropertyFeatures();
			$data['PropertyAmenitiesPop'] = $this->common_model->getPropertyAmenities();
			$data['formDataArchived'] = $this->load->view('partial/sale_entry', NULL, TRUE);
		/*****************end form data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('sales/archive_home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
		
		
	}
	
	public function sales($listing_type='')
	{
		
		if ( ! file_exists(APPPATH.'/views/sales/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('sales');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		/******************get form data*******/
			$data['getCat'] = $this->common_model->getAllCategories();
			$data['PropertyFeaturesPop'] = $this->common_model->getPropertyFeatures();
			$data['PropertyAmenitiesPop'] = $this->common_model->getPropertyAmenities();
			$data['copy_sales_id'] = $this->input->post('copy_sales_id');
		/*****************end form data********/
		  /***********************get url data**************/
         $data['listing_type'] = '';
		 $data['listing_agent'] = '';
         if($listing_type == "published")
		 $data['listing_type'] = 2;
		 elseif ($listing_type == "pending")
		 $data['listing_type'] = 3;
		 elseif ($listing_type == "expired")
		 $data['listing_type'] = 100;
		 elseif ($listing_type == "less_photos")
		 $data['listing_type'] = 101;
		 elseif ($listing_type == "expiring")
		 $data['listing_type'] = 102;
		 
		 $data['listing_agent']= $this->input->get('agent_id');
        /***********************end url data*************/
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('sales/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
		
		
	
	}
	
	 public function international_sales()
	 {
	 	if ( ! file_exists(APPPATH.'/views/sales/international_sales.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('international sales');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		/******************get form data*******/
			$data['getCat'] = $this->common_model->getAllCategories();
			$data['PropertyFeaturesPop'] = $this->common_model->getPropertyFeatures();
			$data['PropertyAmenitiesPop'] = $this->common_model->getPropertyAmenities();
		/*****************end form data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('sales/international_sales', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	 }
	
	public function save()
	{
		return $this->listings_model->save_listing();
	}
	public function getSingleRow($id,$type)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->listings_model->getSingleRow($id,$type);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	
	public function getusers()
	 {
	     $result=$this->listings_model->getusers();
		 echo json_encode($result);
	 }
   function show_images() {
	    $filename = $this->input->post('filename'); 
		 $arr_images = $this->input->post('arr_images'); 
		  $linked_id = $this->input->post('linked_id'); 
		  $rand_key = $this->input->post('rand_key');
		 
		
		$data['getPic'] = $this->listings_model->get_pics($filename,$arr_images,$linked_id,$rand_key);
		$data['getfloor'] = $this->listings_model->get_floorpics($filename,$arr_images,$linked_id,$rand_key);
		
		//pass view as string
		echo $this->load->view('partial/listings_pics', $data, TRUE);
    }
	public function deleteimage($id = null)
	{
		 if ($id == null) {
      		show_error('No identifier provided', 500);
		}
		else {
		 
		 
				$this->listings_model->delete_images($id);
				
		}
	}
	
	
	
	function datatable()
    {
		$type = $this->input->get('type');
		echo $this->listings_model->datatable($type);
    }
	function datatable_archive()
    {
		$type = $this->input->get('type');
		echo $this->listings_model->datatable_archive($type);
    }
	function datatable_quality()
	{
		//$this->load->helper('datatables_helper');
		$type = $this->input->get('type');
		echo $this->listings_model->datatable_quality($type);
	}
	 
    public function uploadify($rand_key,$type_dummy){
		
		//I know we have check in construct but lets make more secure
		if ($this->session->userdata('userid') < 1)
		{ 
			redirect('login');
		}
		//check if randkey and type has been passed?
		if($rand_key == 0 || $rand_key == '' || $type_dummy =='') return false;
		
		
		
		//set type of listings
		$type = "Sales";
		if($type_dummy == 1) $type = "Rentals";
   
			 $this->load->library('image_lib');
			$new_name = $rand_key."-".date('Y-m-d-H-i-s',time()).md5(time())."-".$this->uuid->v4();//.".".$image_data['file_ext'];
			
			//$image_upload_folder = $this->original_path.$this->session->userdata('client_id')."/".$this->session->userdata('userid')."/".md5($rand_key);   // folder page
			//userid can create issues later
			$image_upload_folder = $this->original_path.$this->session->userdata('client_id')."/".md5($rand_key);   // folder page
			 if (!file_exists($image_upload_folder)) {
				mkdir($image_upload_folder, DIR_WRITE_MODE, true);
			}
		
			$w= 800;
			$h= 600;
			$config = array(
			'allowed_types'     => 'jpg|jpeg|gif|png', //only accept these file types
			'max_size'          => 2048, //2MB max
			'file_name'           => $new_name,
			'create_thumb'		=> TRUE,
			'maintain_ratio'		=> TRUE,
			'width'				=> $w,
			'height'			=> $h,
			'upload_path'       => $image_upload_folder //upload directory
			
		  );
		
			 $image1='Filedata';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($image1)) {
		
				$error = array('error' => $this->upload->display_errors());
				//print_r($error);
				echo json_encode($error);
				
		
				 }else {
				$image_data=$this->upload->data();
				$watPath = $image_upload_folder."/watermark";
				 if (!file_exists($watPath)) {
				   mkdir($watPath, DIR_WRITE_MODE, true);
			     }
			/*************create water mark*/
			$configW = array(
			'image_library' => 'gd2',
			'source_image'      => $image_data['full_path'], //path to the uploaded image
			'new_image'         => $watPath, //path to
			'wm_type'           => 'overlay',
			'wm_overlay_path'   => './uploads/profile/watermark.png',
			'wm_opacity' => '30',
			'wm_vrt_alignment' => 'middle', 
			'wm_hor_alignment' => 'center',
			'wm_hor_offset' => '10',
			'wm_vrt_offset' => '10',
			'width'             => $w,
			'height'            => $h
			);
			$this->waterMark($configW);
			
			//save images
			$new_name = $new_name.$image_data['file_ext'];
			$listing_id = $this->input->post('listing_id');
			$image_type = $this->input->post('image_type');
			$image_id = $this->listings_model->save_images($rand_key,$new_name,$listing_id,$type_dummy,$image_type);
			$results = array(
                        'filename' => $new_name,
                        'image_id' => $image_id
						
					 );
			 
			 echo json_encode($results); 	
				
				
				   
	 }
	 
 }
 
 	public function uploadDocuments()
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
			
			$image_upload_folder = $this->document_path.$this->session->userdata('client_id')."/".$this->session->userdata('userid')."/".md5($rand_key);   // folder page
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
 
 
 	public function lookup()
	{
		$cat = $this->input->get('cat');
		$region_id = $this->input->get('region_id');
		$loc = $this->input->get('loc');
		$subloc = $this->input->get('subloc');
		$unit = $this->input->get('unit');
		$type = $this->input->get('type');
		
		echo $this->listings_model->lookup($cat,$region_id,$loc,$subloc,$unit,$type);
	}
 
	public  function waterMark($configW)
		  {
			  $this->image_lib->initialize($configW);
		
				$this->image_lib->watermark();
				$this->image_lib->clear();
		  }
	public  function resizePic($config)
		  {
			  $this->image_lib->initialize($config);
			  $this->image_lib->resize();
			  $this->image_lib->clear();
		  }
		  
		  
		  
		  /*****************************location text area*******/
	public function locations_text_sales()
	{
		//this is same as locations_text_rentals
		if ( ! file_exists(APPPATH.'/views/locations/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('sales');
		$data['listing_type'] = 2;
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		/*************end session values*********/
		
		/******************get form data*******/
			$data['getCat'] = $this->common_model->getAllLocations();
		/*****************end form data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('locations/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
		
	}
	public function locations_text_rentals()
	{
		//this is same as locations_text_sales
		if ( ! file_exists(APPPATH.'/views/locations/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['listing_type'] = 1;
		$data['title'] = ucfirst('rentals');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		/*************end session values*********/
		
		/******************get form data*******/
			$data['getCat'] = $this->common_model->getAllLocations();
		/*****************end form data********/
		
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('locations/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
		
		
	
	}
		  /******************************end location text area **/
		  /*********************share section starts here*************/
		
		function getUserAndAgentDetails($id)
		{
			if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->listings_model->getUserAndAgentDetails($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
		}
		function getUserDetails($id)
		{
			if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->listings_model->getUserDetails($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
		}
		/************share section ends here******/
		
		function status()
		{
			echo $this->listings_model->updateStatus();
		}
		
		/************************save search*******************/
		public function savesearch()
		{
			echo $this->listings_model->savesearch();
		}
		public function delete_savedsearch()
		{
			$id=$this->input->post('id');
			if($id<1)
			{
				show_error('No identifier provided', 500);
			}
			return $this->listings_model->delete_savedsearch($id);
		}
		public function move_to_archive()
		{
			echo $this->listings_model->updateStatus();
		}
		public function move_to_listings()
		{
			echo $this->listings_model->updateStatus();
		}
		public function todosubmit()
		{
			return $this->listings_model->save_todo();
		}
		public function updateFeilds()
		{
			return $this->listings_model->updateFeilds();
		}
		public function lead_single($listing_id)
		{
			$res = $this->listings_model->lead_single($listing_id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
		}
		public function deletedocument($id = null)
		{
			 if ($id == null) {
				show_error('No identifier provided', 500);
			}
			else {
			 
			 
					$this->listings_model->deletedocument($id);
					
			}
		}
		public function addleadsubmit()
		{
			return $this->common_model->addleadsubmit();
		}
		public function adddealsubmit()
		{
			return $this->common_model->adddealsubmit();
		}
		public function get_listings_stats($id = null)
		{
			 if ($id == null) {
				show_error('No identifier provided', 500);
			}
			else {
			 
			 
					$res = $this->common_model->get_listings_stats($id);
					 $this->output->set_content_type('application/json');
           				 echo json_encode($res);
        					exit;
					
			}
		}
		public function price_index_rentals()
		{
			//this is same as locations_text_sales
			if ( ! file_exists(APPPATH.'/views/rentals/price_index.php'))
			{
			// Whoops, we don't have a page for that!
			show_404();
			}
			$data['listing_type'] = 1;
			$data['title'] = ucfirst('price index');
			/*************get session values*********/
			$data['userid'] = $this->session->userdata('userid');
			$data['username'] = $this->session->userdata('username');
			$data['user_type'] = $this->session->userdata('user_type');
			/*************end session values*********/
			
			
			
			/****************************start view fiels*************/
			$this->load->view('templates/listing_top', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('templates/header_listing', $data);
			$this->load->view('rentals/price_index', $data);
			$this->load->view('templates/footer_listing', $data);
			/****************************end view fils***************/
		
		}
		public function single_priceindex($id,$type)
		{
			if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->listings_model->single_priceindex($id,$type);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
		}
		public function datatable_price_index()
		{
			$type = $this->input->get('type');
		echo $this->listings_model->datatable_price_index($type);
		}
	public function price_index_sales()
	{
		//this is same as locations_text_sales
			if ( ! file_exists(APPPATH.'/views/sales/price_index.php'))
			{
			// Whoops, we don't have a page for that!
			show_404();
			}
			$data['listing_type'] = 1;
			$data['title'] = ucfirst('price index');
			/*************get session values*********/
			$data['userid'] = $this->session->userdata('userid');
			$data['username'] = $this->session->userdata('username');
			$data['user_type'] = $this->session->userdata('user_type');
			/*************end session values*********/
			
			
			
			/****************************start view fiels*************/
			$this->load->view('templates/listing_top', $data);
			$this->load->view('templates/navigation', $data);
			$this->load->view('templates/header_listing', $data);
			$this->load->view('sales/price_index', $data);
			$this->load->view('templates/footer_listing', $data);
			/****************************end view fils***************/
	}
}