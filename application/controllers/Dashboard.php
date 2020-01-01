<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Muhammad Shafiq

* Description: dashboard contoller class

* Date: 23 Nov,2015

*/
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
        $adm_type = $this->session->userdata('user_type');
        $this->load->model('dashboard_model');
    }
    public function index()
    {
        if (!file_exists(APPPATH . '/views/dashboard/home.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title']         = ucfirst('Dahsboard'); // Capitalize the first letter
        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        /*************end session values*********/
        //get dashboard data
        $data['contacts']      = $this->dashboard_model->get_contacts_overview();
        $data['allusers']      = $this->dashboard_model->get_allusers();
        $data['totalusers']    = count($data['allusers']);
        $data['portals']       = $this->dashboard_model->get_portals_overview();
        $data['cmp_users']     = $this->dashboard_model->get_company_users();
        //print_r($data['portals']);exit;
        //end getting data
        $this->load->view('templates/home_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_home', $data);
        $this->load->view('dashboard/home', $data);
        $this->load->view('templates/footer_home', $data);
    }
    public function get_listing_overview()
    {
        $result = $this->dashboard_model->get_listing_overview();
        echo json_encode($result);
    }
    public function leads_overview()
    {
        $result = $this->dashboard_model->get_leads_overview();
        echo json_encode($result);
    }
    public function users_listings_overview()
    {
        $result = $this->dashboard_model->get_users_listings_overview();
        echo json_encode($result);
    }
    public function mydeals_overview()
    {
        $result = $this->dashboard_model->get_mydeals_overview();
        echo json_encode($result);
    }
    public function get_portal_overview()
    {
        $result = $this->dashboard_model->getPortalsChartData();
        echo json_encode($result);
    }
    public function get_agent($agentid)
    {
        $result = $this->dashboard_model->get_agent_details($agentid);
        echo json_encode($result);
    }
    public function getCalendarData()
    {
        $result = $this->dashboard_model->getCalendarData();
        echo json_encode($result);
    }
}