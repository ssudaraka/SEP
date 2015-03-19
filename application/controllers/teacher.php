<?php

class Teacher extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Teacher_Model');
        $this->load->model('user');
    }

    function index() {
        if ($this->session->userdata('user_type') !== "A") {
            redirect('login', 'refresh');
        }

        $result = $this->user->get_details($this->session->userdata('id'));
        foreach ($result as $row) {
            $data['first_name'] = $row->first_name;
            $data['last_name'] = $row->last_name;
        }

        $data['page_title'] = "Teacher Management";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub');
        $this->load->view('teacher/teacher_reg_form', $data);
        $this->load->view('templates/footer');
    }

    function create() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('NIC', 'NIC', 'required');
        $this->form_validation->set_rules('name', 'name', '');
        $this->form_validation->set_rules('initial', 'initial', '');
        $this->form_validation->set_rules('birth', 'birth', '');
        $this->form_validation->set_rules('gender', 'gender', '');
        $this->form_validation->set_rules('Nationality', 'Nationality', '');
        $this->form_validation->set_rules('religion', 'religion', '');
        $this->form_validation->set_rules('civilstatus', 'civilstatus', '');
        $this->form_validation->set_rules('address', 'address', '');
        $this->form_validation->set_rules('contactMob', 'contactMob', '');
        $this->form_validation->set_rules('contactHome', 'contactHome', '');
        $this->form_validation->set_rules('email', 'email', '');
        $this->form_validation->set_rules('widow', 'widow', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data['page_title'] = "Teacher Registration";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('teacher/teacher_reg_form', $data);
            $this->load->view('/templates/footer');
            //$this->load->view('footer');
        } else { // passed validation proceed to post success logic
            // build array for the model
            $NIC = $this->input->post('NIC');
            $name = $this->input->post('name');
            $initials = $this->input->post('initial');
            $birth = $this->input->post('birth');
            $gender = $this->input->post('gender');
            $Nationality = $this->input->post('Nationality');
            $religion = $this->input->post('religion');
            $civilstatus = $this->input->post('civilstatus');
            $address = $this->input->post('address');
            $contactMob = $this->input->post('contactMob');
            $contactHome = $this->input->post('contactHome');
            $email = $this->input->post('email');
            $widow = $this->input->post('widow');
            // run insert model to write data to db

            if ($id = $this->Teacher_Model->insert_new_staff($NIC, $name, $initials, $birth, $gender, $Nationality, $religion, $civilstatus, $address, $contactMob, $contactHome, $email, $widow)) { // the information has therefore been successfully saved in the db
                $data["user_id"] = $id;
                $data['page_title'] = "Teacher Registration";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('teacher/teacher_update_form', $data);   // or whatever logic needs to occur
                $this->load->view('/templates/footer');
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function update_details() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('NIC', 'NIC', '');
        $this->form_validation->set_rules('serialno', 'serialno', '');
        $this->form_validation->set_rules('signatureno', 'signatureno', '');
        $this->form_validation->set_rules('careerdate', 'careerdate', '');
        $this->form_validation->set_rules('medium', 'medium', '');
        $this->form_validation->set_rules('designation', 'designation', '');
        $this->form_validation->set_rules('section', 'section', '');
        $this->form_validation->set_rules('mainsubject', 'mainsubject', '');
        $this->form_validation->set_rules('servicegrade', 'servicegrade', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $this->load->view('templates/header');
            $this->load->view('navbar_main');
            $this->load->view('navbar_sub');
            $this->load->view('/teacher/teacher_update_form');
            $this->load->view('/templates/footer');
        } else { // passed validation proceed to post success logic
            // build array for the model
            $NIC = $this->input->post('NIC');
            $serialno = $this->input->post('serialno');
            $signatureno = $this->input->post('signatureno');
            $careerdate = $this->input->post('careerdate');
            $medium = $this->input->post('medium');
            $designation = $this->input->post('designation');
            $section = $this->input->post('section');
            $mainsubject = $this->input->post('mainsubject');
            $servicegrade = $this->input->post('servicegrade');
            // run insert model to write data to db

            if ($id = $this->Teacher_Model->update_new_staff($NIC, $serialno, $signatureno, $careerdate, $medium, $designation, $section, $mainsubject, $servicegrade)) { // the information has therefore been successfully saved in the db
                $data["user_id"] = $id;
                $this->load->view('templates/header');
                $this->load->view('navbar_main');
                $this->load->view('navbar_sub');
                $this->load->view('teacher/teacher_logdetails_form', $data);   // or whatever logic needs to occur
                $this->load->view('/templates/footer');
            } else {
                echo 'An error occurred saving your information. Please try again laterrrrrrr';
                // Or whatever error handling is necessary
            }
        }
    }

    function create_log_details() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('ID', 'ID', '');
        $this->form_validation->set_rules('username', 'username', '');
        $this->form_validation->set_rules('password', 'password', '');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $this->load->view('templates/header');
            $this->load->view('navbar_main');
            $this->load->view('navbar_sub');
            $this->load->view('teacher/check_teacher_profile');
            $this->load->view('/templates/footer');
        } else { // passed validation proceed to post success logic
            // build array for the model
            $ID = $this->input->post('ID');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            // run insert model to write data to db

            if ($id = $this->Teacher_Model->insert_new_teacher_userdata($username, $password)) { // the information has therefore been successfully saved in the db
                if ($res = $this->Teacher_Model->get_staff_details($ID)) {
                    $data["user_id"] = $res;
                    $this->load->view('templates/header');
                    $this->load->view('navbar_main');
                    $this->load->view('navbar_sub');
                    //$this->load->view('teacher/teacher_view_profile', $data);   // or whatever logic needs to occur
                    $this->load->view('teacher/check_teacher_profile', $data);
                    $this->load->view('/templates/footer');
                }
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

}
