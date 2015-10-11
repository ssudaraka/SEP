<?php

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->model('news_model');
    }

    function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $today = date('Y-m-d');
        $data['count'] = $this->event_model->get_upcoming_events($today);
        $data['news'] = $this->news_model->get_all_news_details();
        $data['activity'] = $this->news_model->get_news_details();
        $data['navbar'] = "dashboard";

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
    
    function get_news(){
        $data['news'] = $this->news_model->get_all_news_details();
        $this->load->view('dashboard_news_form',$data);
    }

}
