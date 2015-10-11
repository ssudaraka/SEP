<?php

/*
 * Main controller for Admin related functionalties.
 */

class Sports extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        $data['page_title'] = "System Administration";
        $data['navbar'] = "admin";

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('sports/sport_details', $data);
        $this->load->view('templates/footer');
    }
    
     function assign_leaders(){
        $data['page_title'] = "System Administration";
        $data['navbar'] = "admin";

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('sports/assign_leaders_form', $data);
        $this->load->view('templates/footer');
    }
    
    function assign_students(){
        $data['page_title'] = "System Administration";
        $data['navbar'] = "admin";

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('sports/assign_students', $data);
        $this->load->view('templates/footer');
    }
    
    function management_details(){
        $data['page_title'] = "System Administration";
        $data['navbar'] = "admin";

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('sports/sport_managers_form', $data);
        $this->load->view('templates/footer');
    }
    
    
}