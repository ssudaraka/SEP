<?php

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['page_title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        // session_destroy(); I'm not sure if this is necessary 
        redirect('login', 'refresh');
    }

}
