<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class leave extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('leave_model');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['page_title'] = "Leave Management";
        $data['first_name'] = $this->session->userdata('first_name');
        

        //Load form combo
        $data['leave_types'] = $this->leave_model->get_leave_types();

        //Getting Values from Leaves DB
        $data['casual_leaves'] = $this->leave_model->get_max_leave_count("Casual");
        $data['medical_leaves'] = $this->leave_model->get_max_leave_count("Medical");
        $data['duty_leaves'] = $this->leave_model->get_max_leave_count("Duty");
        $data['other_leaves'] = $this->leave_model->get_max_leave_count("Other");
        $data['maternity_leaves'] = $this->leave_model->get_max_leave_count("Maternity");

        //Getting List of Applied Leaves
        $data['applied_leaves'] = $this->leave_model->get_applied_leaves_list();

        //Get Separate leaves count according to the type
        $data['applied_casual_leaves'] = $this->leave_model->get_no_leaves('1', '1');
        $data['applied_medical_leaves'] = $this->leave_model->get_no_leaves('2', '1');
        $data['applied_duty_leaves'] = $this->leave_model->get_no_leaves('3', '1');
        $data['applied_other_leaves'] = $this->leave_model->get_no_leaves('4', '1');
        $data['applied_maternity_leaves'] = $this->leave_model->get_no_leaves('5', '1');

        //total leaves
        $data['total_leaves'] = $data['applied_casual_leaves'] + $data['applied_medical_leaves'] + $data['applied_duty_leaves'] + $data['applied_other_leaves'] + $data['applied_maternity_leaves'];

        //Passing it to the View
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('/leave/leave', $data);
        $this->load->view('/templates/footer');
    }

    //Main function to apply leaves
    public function apply_leave() {

        //Getting Values from Leaves DB
        $data['casual_leaves'] = $this->leave_model->get_max_leave_count("Casual");
        $data['medical_leaves'] = $this->leave_model->get_max_leave_count("Medical");
        $data['duty_leaves'] = $this->leave_model->get_max_leave_count("Duty");
        $data['other_leaves'] = $this->leave_model->get_max_leave_count("Other");
        $data['maternity_leaves'] = $this->leave_model->get_max_leave_count("Maternity");

//Getting List of Applied Leaves
        $data['applied_leaves'] = $this->leave_model->get_applied_leaves_list();

        //Get Separate leaves count according to the type
        $data['applied_casual_leaves'] = $this->leave_model->get_no_leaves('1', '1');
        $data['applied_medical_leaves'] = $this->leave_model->get_no_leaves('2', '1');
        $data['applied_duty_leaves'] = $this->leave_model->get_no_leaves('3', '1');
        $data['applied_other_leaves'] = $this->leave_model->get_no_leaves('4', '1');
        $data['applied_maternity_leaves'] = $this->leave_model->get_no_leaves('5', '1');

        //total leaves
        $data['total_leaves'] = $data['applied_casual_leaves'] + $data['applied_medical_leaves'] + $data['applied_duty_leaves'] + $data['applied_other_leaves'] + $data['applied_maternity_leaves'];

        //This is where the logic happens
        if ($this->leave_model->get_no_leaves('1', '1') == $this->leave_model->get_max_leave_count("Casual")) {
            $data['error_reason'] = 'No casual leaves left to apply';
        } elseif ($this->leave_model->get_no_leaves('2', '1') == $this->leave_model->get_max_leave_count("Medical")) {
            $data['error_reason'] = 'No Medical leaves left to apply';
        } else {
            
        }


        $data['title'] = "Leave Management";
        $this->load->view('/templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('/leave/save', $data);
        //Passing it to the View
        $this->load->view('/leave/leave', $data);
        $this->load->view('/templates/footer');
    }

}

/* Coded by Udara Karunarathna @P0dda */
/* Location: www.udara.info */