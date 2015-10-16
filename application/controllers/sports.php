<?php

/*
 * Main controller for Admin related functionalties.
 */

class Sports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('sports_model');
    }
    
    function index(){
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['page_title'] = "System Administration";
        $data['navbar'] = "admin";
        $data['det'] = $this->sports_model->view_sport_category();
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('sports/sport_details', $data);
        $this->load->view('templates/footer');
    }
    
    function add_sport_category(){
        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "sports";
        $this->load->library('form_validation');
        $data['user_type'] = $this->session->userdata['user_type'];
        //edit_teacher_profile view validations
        $this->form_validation->set_rules('sport_name', '', 'required');
        $this->form_validation->set_rules('description', 'Full Name', 'required');
        $this->form_validation->set_rules('agecat', 'Name with Initial', 'required');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        
        if ($this->form_validation->run() == FALSE) {
            $data['det'] = $this->sports_model->view_sport_category();
            $data['navbar'] = "sport";
            $data['page_title'] = "Sport Category";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('sports/sport_details', $data);
            $this->load->view('/templates/footer');
        }
        else{
            $sport_cat = $this->input->post('sport_name');
            $sport_descrp = $this->input->post('description');
            $sport_age_category = $this->input->post('agecat');
            $this->sports_model->add_sport_category($sport_cat,$sport_descrp,$sport_age_category);
            
            $data['det'] = $this->sports_model->view_sport_category();
            $data['succ_message'] = "Succesfully inserted";
            $data['navbar'] = "sport";
            $data['page_title'] = "Sport Category";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('sports/sport_details', $data);
            $this->load->view('/templates/footer');
        }
        
        
    }
    
    public function view_category() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];
        $id = $this->uri->segment(3);
        $data['details'] = $this->sports_model->sport_category_details($id);
        $this->load->view('sports/edit_sport_category_form', $data);
    }
    
     function assign_leaders(){
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['page_title'] = "System Administration";
        $data['navbar'] = "admin";

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('sports/assign_leaders_form', $data);
        $this->load->view('templates/footer');
    }
    
    function assign_students(){
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['page_title'] = "System Administration";
        $data['navbar'] = "admin";

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('sports/assign_students', $data);
        $this->load->view('templates/footer');
    }
    
    function management_details(){
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['page_title'] = "System Administration";
        $data['navbar'] = "admin";

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('sports/sport_managers_form', $data);
        $this->load->view('templates/footer');
    }
    
    
}