<?php

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        //Load Models
        $this->load->model('Leave_Model');
        $this->load->model('event_model');
    }

    function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "dashboard";

        //Stats on Dashboard
        $data['leaves'] = $this->Leave_Model->get_count_of_pending_leaves();
        $today = date('Y-m-d');
        $data['events'] = $this->event_model->get_count_upcoming_events($today);
        $data['eventslist'] = $this->event_model->get_upcoming_events($today);

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
