<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Muhammad Shafiq
 * Email: muhammad.royalhome@gmail.com
 * Description: users contoller class
 * Date: 4 feb,2016
 */
class Users extends CI_Controller
{
    
    
    var $profileImage_path;
    var $contactImage_path;
    
    public function __construct()
    {
        
        parent::__construct();
        // Your own constructor code
        $this->profileImage_path = "./uploads/user/profile/";
        $this->contactImage_path = "./uploads/user/contact/";
        
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
        
        $this->load->model('users_model');
        $this->load->model('common_model');
        
    }
    public function index()
    {
        if (!file_exists(APPPATH . '/views/users/home.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title']     = ucfirst('Users');
        /*************get session values*********/
        $data['userid']    = $this->session->userdata('userid');
        $data['username']  = $this->session->userdata('username');
        $data['user_type'] = $this->session->userdata('user_type');
        $data['client_id'] = $this->session->userdata('client_id');
        /*************end session values*********/
        
        /******************get form data*******/
        $data['AllUsers']     = $this->common_model->getAgents();
        $data['AllCompanies'] = $this->common_model->getProfiles();
        /*****************end form data********/
        
        
        /****************************start view fiels*************/
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('users/home', $data);
        $this->load->view('templates/footer_listing', $data);
        /****************************end view fils***************/
    }
    
    public function groups()
    {
        if (!file_exists(APPPATH . '/views/users/group_home.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title']     = ucfirst('Groups');
        /*************get session values*********/
        $data['userid']    = $this->session->userdata('userid');
        $data['username']  = $this->session->userdata('username');
        $data['user_type'] = $this->session->userdata('user_type');
        $data['client_id'] = $this->session->userdata('client_id');
        /*************end session values*********/
        
        /******************get form data*******/
        //$data['AllUsers'] = $this->common_model->getAgents();	
        //$data['AllCompanies'] = $this->common_model->getProfiles();
        /*****************end form data********/
        
        
        /****************************start view fiels*************/
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('users/group_home', $data);
        $this->load->view('templates/footer_listing', $data);
        /****************************end view fils***************/
    }
    
    public function questions()
    {
        if (!file_exists(APPPATH . '/views/users/questions_home.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title']     = ucfirst('questions');
        /*************get session values*********/
        $data['userid']    = $this->session->userdata('userid');
        $data['username']  = $this->session->userdata('username');
        $data['user_type'] = $this->session->userdata('user_type');
        $data['client_id'] = $this->session->userdata('client_id');
        /*************end session values*********/
        
        /******************get form data*******/
        //$data['AllUsers'] = $this->common_model->getAgents();	
        //$data['AllCompanies'] = $this->common_model->getProfiles();
        /*****************end form data********/
        
        
        /****************************start view fiels*************/
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('users/questions_home', $data);
        $this->load->view('templates/footer_listing', $data);
        /****************************end view fils***************/
    }
    
    public function uploadphoto()
    {
        $this->load->library('image_lib');
        $current_User = $this->input->post('current_User');
        $trade_id     = $this->input->post('current_User_client_id');
        $rand_key     = $this->input->post('current_User_randkey');
        if ($rand_key < 1 || $trade_id < 1 || $current_User < 1) {
            echo "Save listing first!";
            return false;
        }
        $new_name = $rand_key . $this->uuid->v4(); //.".".$image_data['file_ext'];
        
        
        $image_upload_folder = $this->profileImage_path . $trade_id; // folder page
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
        $image1 = 'image';
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($image1)) {
            
            $error = array(
                'error' => $this->upload->display_errors()
            );
            print_r($error);
            
            
        } else {
            $config1['image_library']  = 'gd2';
            $config1['source_image']   = $this->upload->upload_path . $this->upload->file_name;
            $config1['create_thumb']   = TRUE;
            $config1['maintain_ratio'] = TRUE;
            $config1['width']          = 160;
            $config1['height']         = 160;
            
            
            $this->image_lib->clear();
            $this->image_lib->initialize($config1);
            
            if (!$this->image_lib->resize()) {
                
                $error = array(
                    'error' => $this->image_lib->display_errors()
                );
                print_r($error);
                exit;
            }
            $image_data = $this->upload->data();
            echo $image_data['file_name'];

            $this->db->where('id', $current_User)->update("crm_users", array("photo_agent" => $image_data['file_name']));

            exit;
            
        }
    }
    
    public function uploadphoto2()
    {
        
        $this->load->library('image_lib');
        $current_User = $this->input->post('current_User');
        $trade_id     = $this->input->post('current_User_client_id');
        $rand_key     = $this->input->post('current_User_randkey');
        if ($rand_key < 1 || $trade_id < 1 || $current_User < 1) {
            echo "Save listing first!";
            return false;
        }
        $new_name = $rand_key . $this->uuid->v4(); //.".".$image_data['file_ext'];
        
        
        $image_upload_folder = $this->contactImage_path . $trade_id; // folder page
        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }
        
        
        $config = array(
            'allowed_types' => 'jpg|jpeg|gif|png', //only accept these file types
            'max_size' => 2048, //2MB max
            'file_name' => "org-" . $new_name, //this indicates orignal image
            'create_thumb' => TRUE,
            'maintain_ratio' => TRUE,
            'width' => 160, //$w,
            'height' => 160, //$h,
            'upload_path' => $image_upload_folder //upload directory
            
        );
        $image1 = 'image2';
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($image1)) {
            
            $error = array(
                'error' => $this->upload->display_errors()
            );
            print_r($error);
            
            
        } else {
            $config1['image_library']  = 'gd2';
            $config1['source_image']   = $this->upload->upload_path . $this->upload->file_name;
            $config1['create_thumb']   = TRUE;
            $config1['maintain_ratio'] = TRUE;
            $config1['width']          = 160;
            $config1['height']         = 160;
            
            
            $this->image_lib->clear();
            $this->image_lib->initialize($config1);
            
            if (!$this->image_lib->resize()) {
                
                $error = array(
                    'error' => $this->image_lib->display_errors()
                );
                print_r($error);
            }
            $image_data = $this->upload->data();
            echo $image_data['file_name'];
            exit;
            
        }
        
    }
    
    public function datatable()
    {
        echo $this->users_model->datatable();
    }
    public function datatable_groups()
    {
        echo $this->users_model->datatable_groups();
    }
    
    public function getGroupUsers($id)
    {
        if ($id == null) {
            show_error('No identifier provided', 500);
        }
        $data['grp_users'] = $this->users_model->getGroupUsers($id);
        echo $this->load->view('partial/group_users', $data, TRUE);
        
    }
    public function submit()
    {
        return $this->users_model->submit();
    }
    public function submit_groups()
    {
        return $this->users_model->submit_groups();
    }
    
    public function single($id)
    {
        if ($id == null) {
            show_error('No identifier provided', 500);
        }
        $res = $this->users_model->single($id);
        $this->output->set_content_type('application/json');
        echo json_encode($res);
        exit;
    }
    public function single_group($id)
    {
        if ($id == null) {
            show_error('No identifier provided', 500);
        }
        $res = $this->users_model->single_group($id);
        $this->output->set_content_type('application/json');
        echo json_encode($res);
        exit;
    }
    public function get_screens()
    {
        $array = $this->users_model->get_screens();
        
        echo $array;
        
    }
    public function lookup()
    {
        return true;
    }
    public function lookup_duplicate_users($username, $id)
    {
        echo $this->users_model->lookup_duplicate_users($username, $id);
    }
    public function CheckPassword()
    {
        //we need logic here
        //for now return 0
        return 0;
        $newpass = trim($this->input->get('newpass', TRUE));
        $id      = trim($this->input->get('id', TRUE));
        echo $this->users_model->CheckPassword($newpass, $id);
    }

    function GetCompanies(){
        
        $res = $this->users_model->GetCompanies();
        $this->output->set_content_type('application/json');
        echo json_encode($res);        
    }
    
    
}