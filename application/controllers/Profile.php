<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Muhammad Shafiq

* Email: muhammad.royalhome@gmail.com

* Description: profile contoller class

* Date: 13 Jan,2016

*/
class Profile extends CI_Controller
{
    var $original_path;
    
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->original_path  = "./uploads/profile/logo/";
        $this->watermark_path = "./uploads/profile/watermark/";
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
        
        $this->load->model('profile_model');
        $this->load->model('common_model');
    }
    
    public function index()
    {
        if (!file_exists(APPPATH . '/views/profile/home.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        
        $data['title']     = ucfirst('profile');
        /*************get session values*********/
        $data['userid']    = $this->session->userdata('userid');
        $data['username']  = $this->session->userdata('username');
        $data['user_type'] = $this->session->userdata('user_type');
        $data['client_id'] = $this->session->userdata('client_id');
        /*************end session values*********/
        /******************get form data*******/
        /*****************end form data********/
        /****************************start view fiels*************/
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('profile/home', $data);
        $this->load->view('templates/footer_listing', $data);
        /****************************end view fils***************/
    }
    
    public function submit()
    {
        $this->load->library('image_lib');
        $rand_key = $this->input->post('rand_key');
        $trade_id = $this->input->post('trade_id');
        if ($rand_key == 0 || $rand_key == '')
            return false;
        if ($trade_id == 0 || $trade_id == '')
            return false;
        $new_name = $rand_key . date('YmdHis', time()) . md5(time()); //.".".$image_data['file_ext'];

        
        #empty($_FILES['profile_logo1']['name']);exit;

        echo "profile_logo-->" . $_FILES["profile_logo"]["name"];//empty($_FILES["profile_logo"]["name"]);exit;

        if (empty($_FILES["profile_logo"]["name"]) !== 1) {
	        
	        
	        $image_upload_folder = $this->original_path . $trade_id . "/" . $rand_key; // folder page
	        if (!file_exists($image_upload_folder)) {
	            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
	        }
	        
	        $w            = 141;
	        $h            = 60;
	        $config       = array(
	            'allowed_types' => 'jpg|jpeg|gif|png', //only accept these file types
	            'max_size' => 2048, //2MB max
	            'file_name' => $new_name,
	            'create_thumb' => TRUE,
	            'maintain_ratio' => TRUE,
	            'width' => $w,
	            'height' => $h,
	            'upload_path' => $image_upload_folder //upload directory
	        );
	        $profile_logo = '';
	        $image1       = 'profile_logo';
	        $this->load->library('upload', $config);

	        echo "$image_upload_folder-->".$image_upload_folder;

	        if (!$this->upload->do_upload($image1)) {
	            $error = array(
	                'error' => $this->upload->display_errors()
	            );
	            print_r($error);
	        } else {
	            $image_data   = $this->upload->data();
	            $profile_logo = $image_data['file_name'];

	            print_r("Upload Successful.");
	        }

        }
        // else $profile_logo = "";

        // echo "image_upload_folder-->" . $image_upload_folder;

        // echo "profile_logo-->" . $profile_logo;

        if (empty($_FILES['profile_watermark']['name']) !== 1) {

	        //save watermark now
	        $water_upload_folder = $this->watermark_path . $trade_id . "/" . $rand_key; // folder page
	        if (!file_exists($water_upload_folder)) {
	            mkdir($water_upload_folder, DIR_WRITE_MODE, true);
	        }


	        $w                 = 141;
	        $h                 = 60;
	        $config_water      = array(
	            'allowed_types' => 'jpg|jpeg|gif|png', //only accept these file types
	            'max_size' => 2048, //2MB max
	            'file_name' => $new_name,
	            'create_thumb' => TRUE,
	            'maintain_ratio' => TRUE,
	            'width' => $w,
	            'height' => $h,
	            'upload_path' => $water_upload_folder //upload directory
	        );
	        $profile_watermark = '';
	        $image1            = 'profile_watermark';
	        $this->upload->initialize($config_water);
	        $this->load->library('upload', $config_water);
	        if (!$this->upload->do_upload($image1)) {
	            $error = array(
	                'error' => $this->upload->display_errors()
	            );
	            print_r($error);
	        } else {
	            $image_data1       = $this->upload->data();
	            $profile_watermark = $image_data1['file_name'];
	        }
        }
        // else{
        	
        	// $profile_watermark = "";
        // }

        return $this->profile_model->saveprofile($profile_logo, $profile_watermark);
    }

    function datatable()
    {
        echo $this->profile_model->datatable();
    }
    
    public function getSingleRow($id, $type)
    {
        if ($id == null) {
            show_error('No identifier provided', 500);
        }
        
        $res = $this->profile_model->getSingleRow($id, $type);
        $this->output->set_content_type('application/json');
        echo json_encode($res);
        exit;
    }
}