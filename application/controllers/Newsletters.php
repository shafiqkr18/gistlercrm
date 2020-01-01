<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Kevin Espaldon

* Email: muhammad.royalhome@gmail.com

* Description: Newsletters Controller Class

* Date: 21 Feb, 2016

*/
class Newsletters extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
        $this->load->model('Newsletters_model');
        $this->load->model('Common_model');
    }

    public function index()
    {
        if (!file_exists(APPPATH . '/views/newsletters/home.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        /*************get session values*********/
        $data['userid']        = $this->session->userdata('userid');
        $data['username']      = $this->session->userdata('username');
        $data['user_type']     = $this->session->userdata('user_type');
        $data['client_id']     = $this->session->userdata('client_id');
        $data['user_fullname'] = $this->session->userdata('user_fullname');
        $data['title']         = ucfirst('Newsletters'); // Capitalize the first letter
        $this->load->view('templates/listing_top', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/header_listing', $data);
        $this->load->view('newsletters/home', $data);
        $this->load->view('templates/footer_listing', $data);
    }

    public function GetListings()
    {
        $listingType = $this->input->get('listingType');
        echo $this->Newsletters_model->GetListings($listingType);
    }

    public function GetContacts()
    {
        $contactType = $this->input->get('contactType');
        echo $this->Newsletters_model->GetContacts($contactType);
    }

    public function SendNewsletter()
    {
        $listingIDs = $this->input->post('listingIDs');
        $contactIDs = $this->input->post('contactIDs');
        $templateID = $this->input->post('templateID');
        $emailtitle = $this->input->post('emailtitle');
        $emailBody  = $this->input->post('emailBody');
        // echo var_dump($listingIDs);
        // echo var_dump($contactIDs);
        // echo var_dump($templateID);
        // echo var_dump($emailtitle);
        // echo var_dump($emailBody);exit;
        foreach ($contactIDs as $key => $id) {
            $contact = $this->Newsletters_model->GetContactData($id);
            $email   = $contact["email"];
            $this->load->library('email');
            $this->email->from('noreply@gistlercrm.com');
            $this->email->to($email);
            $this->email->subject($emailtitle);
            $this->email->message($emailBody);
            $this->email->send();
        }
    }
}
?>