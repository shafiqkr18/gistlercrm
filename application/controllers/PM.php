<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Kevin Espaldon
 * Email: muhammad.royalhome@gmail.com
 * Description: Reports Controller Class
 * Date: 6 Feb, 2016
 */
class Pm extends CI_Controller{
    function __construct(){

        parent::__construct();
        $this->load->model('PM_Model');
    }

    function index(){ //dashboard{

        if (!file_exists(APPPATH . '/views/pm/dashboard.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('Property Management Dashboard'); // Capitalize the first letter
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('pm/dashboard', $data);
        $this->load->view('pm/pm_modals', $data);
        $this->load->view('templates/footer_listing', $data);
    }

    function units(){

        if (!file_exists(APPPATH . '/views/pm/units.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('PM - Units'); // Capitalize the first letter
        $counts                = $this->PM_Model->GetUnitsHeaderCounts();
        $data['all']           = $counts["AllCount"];
        $data['available']     = $counts["AvailableCount"];
        $data['rented']        = $counts["RentedCount"];
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('pm/units', $data);
        $this->load->view('pm/pm_modals', $data);
        $this->load->view('templates/footer_listing', $data);
    
}
    function accounts(){

        if (!file_exists(APPPATH . '/views/pm/accounts.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('PM - accounts'); // Capitalize the first letter
        $counts                = $this->PM_Model->GetAccountsHeaderCounts();
        $data['all']           = $counts["AllCount"];
        $data['paymentin']     = $counts["PaymentInCount"];
        $data['paymentout']    = $counts["PaymentOutCount"];
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('pm/accounts', $data);
        $this->load->view('pm/pm_modals', $data);
        $this->load->view('templates/footer_listing', $data);
    }

    function landlords(){

        if (!file_exists(APPPATH . '/views/pm/landlords.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('PM - Landlords'); // Capitalize the first letter
        $counts                = $this->PM_Model->GetLandlordsHeaderCounts();
        $data['all']           = $counts["AllCount"];
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('pm/landlords', $data);
        $this->load->view('pm/pm_modals', $data);
        $this->load->view('templates/footer_listing', $data);
    }

    function leases(){

        if (!file_exists(APPPATH . '/views/pm/leases.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('PM - Leases'); // Capitalize the first letter
        $counts                = $this->PM_Model->GetLeasesHeaderCounts();
        $data['all']           = $counts["AllCount"];
        $data['expiring']      = $counts["ExpiringCount"];
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('pm/leases', $data);
        $this->load->view('pm/pm_modals', $data);
        $this->load->view('templates/footer_listing', $data);
    }

    function serviceproviders(){

        if (!file_exists(APPPATH . '/views/pm/serviceproviders.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('PM - service providers'); // Capitalize the first letter
        $counts                = $this->PM_Model->GetServiceProvidersHeaderCounts();
        $data['all']           = $counts["AllCount"];
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('pm/serviceproviders', $data);
        $this->load->view('pm/pm_modals', $data);
        $this->load->view('templates/footer_listing', $data);
    }

    function settings(){

        if (!file_exists(APPPATH . '/views/pm/settings.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('PM - settings'); // Capitalize the first letter
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('pm/settings', $data);
        $this->load->view('pm/pm_modals', $data);
        $this->load->view('templates/footer_listing', $data);
    }

    function tenants(){

        if (!file_exists(APPPATH . '/views/pm/tenants.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('PM - tenants'); // Capitalize the first letter
        $counts                = $this->PM_Model->GetTenantsHeaderCounts();
        $data['all']           = $counts["AllCount"];
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('pm/tenants', $data);
        $this->load->view('pm/pm_modals', $data);
        $this->load->view('templates/footer_listing', $data);
    }

    function workorders(){

        if (!file_exists(APPPATH . '/views/pm/workorders.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('PM - Work Orders'); // Capitalize the first letter
        $counts                = $this->PM_Model->GetWorkOrdersHeaderCounts();
        $data['all']           = $counts["AllCount"];
        $data['inprogress']    = $counts["InProgressCount"];
        $data['completed']     = $counts["CompletedCount"];
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('pm/workorders', $data);
        $this->load->view('pm/pm_modals', $data);
        $this->load->view('templates/footer_listing', $data);
    }
}
?>