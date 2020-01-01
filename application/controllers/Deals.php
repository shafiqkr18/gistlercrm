<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: Deals contoller class
 * Date: 28 Dec,2015
 */
class Deals extends CI_Controller {
	 
   
	public function __construct()
	{
		
     	parent::__construct();
     	// Your own constructor code
		
		 $this->doc_path = "./uploads/deals/";
		if ( ! $this->session->userdata('validated'))
		{ 
			redirect('login');
		}
			
	$this->load->model('deals_model');
	$this->load->model('common_model');
				
    }
	public function index($listing_type='')
	{
		if ( ! file_exists(APPPATH.'/views/deals/home.php'))
		{
		// Whoops, we don't have a page for that!
		show_404();
		}
		$data['title'] = ucfirst('deals');
		/*************get session values*********/
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
		$data['user_type'] = $this->session->userdata('user_type');
		$data['client_id'] = $this->session->userdata('client_id');
		/*************end session values*********/
		
		/******************get form data*******/
			
		/*****************end form data********/
		  /***********************get url data**************/
         $data['listing_type'] = '';
         if($listing_type == "rentals")
		 $data['listing_type'] = 1;
		 elseif ($listing_type == "sales")
		 $data['listing_type'] = 2;
		 elseif ($listing_type == "year_rentals")
		 $data['listing_type'] = 100;
		 elseif ($listing_type == "year_sales")
		 $data['listing_type'] = 101;
		 elseif ($listing_type == "progress_rentals")
		 $data['listing_type'] = 102;
		 elseif ($listing_type == "progress_sales")
		 $data['listing_type'] = 103;
		 elseif ($listing_type == "month_rentals")
		 $data['listing_type'] = 104;
		 elseif ($listing_type == "month_sales")
		 $data['listing_type'] = 105;
        /***********************end url data*************/
		
		/****************************start view fiels*************/
		$this->load->view('templates/listing_top', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/header_listing', $data);
		$this->load->view('deals/home', $data);
		$this->load->view('templates/footer_listing', $data);
		/****************************end view fils***************/
	}
	function datatable()
    {
		
		echo $this->deals_model->datatable();
    }
	public function submit()
	{
		return $this->deals_model->submit();
	}
	public function single($id)
	{
		if ($id == null)
		 {
				  show_error('No identifier provided', 500);
		 }
		 $res = $this->deals_model->getSingleRow($id);
		  $this->output->set_content_type('application/json');
            echo json_encode($res);
        exit;
	}
	public function uploadDocuments()
	{
		if ($this->session->userdata('userid') < 1)
		{ 
			redirect('login');
		}
			$error = "";
		 $this->load->library('image_lib');
		$deal_ref = $this->input->post('deal_ref');
        $deal_id     = $this->input->post('deal_id');
        $doc_signed     = $this->input->post('doc_signed');
        $document_name = $this->input->post('document_name');
        $doc_sale     = $this->input->post('doc_sale');
        $doc_rent     = $this->input->post('doc_rent');
        $deal_type     = $this->input->post('deal_type');

        //echo $deal_ref."=".$deal_id."=".$doc_signed."=".$document_name."=".$doc_sale."=".$doc_rent."=".$deal_type;
        //GIS-D-3=3=Un-signed===Invoice=1
        $new_name = $this->uuid->v4();
        $image_upload_folder = $this->doc_path . $deal_ref; // folder page
        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }
          $config = array(
            'image_library' => 'gd2',
            'allowed_types' => 'jpg|jpeg|gif|png', //only accept these file types
            'max_size' => 2048, //2MB max
            'file_name' => $new_name, //this indicates orignal image
            'create_thumb' => TRUE,
            'maintain_ratio' => TRUE,
            'width' => 160,
            'height' => 160,
            'upload_path' => $image_upload_folder //upload directory
            
        );
           $image1 = 'deals_documents';
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($image1)) {
            
            $error = array(
                'error' => $this->upload->display_errors()
            );
            print_r($error);
            
            
        } else {
        	 $image_data = $this->upload->data();
            echo $image_data['file_name'];
        }


	}
	
}