<?php

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "dashboard";

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        $data['page_title'] = 'Dashboard';
        $data['first_name'] = $this->session->userdata('first_name');
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }

}
