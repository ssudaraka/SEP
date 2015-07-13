<?php

class Timetable extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('class_model');
        $this->load->model('timetable_model');
        $this->load->library('form_validation');
    }

    function index() {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        $data['page_title'] = "Timetable Management";
        $data['navbar'] = "timetable";

        $data['timetable_list'] = $this->timetable_model->get_timetable_list();

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('timetable/index', $data);
        $this->load->view('/templates/footer');
    }

    function create() {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        $data['page_title'] = "Create Timetable";
        $data['navbar'] = "timetable";

        $data['class_list'] = $this->class_model->get_class_list();
        $this->form_validation->set_rules("year", " Year", "required|integer|callback_check_year");
        $this->form_validation->set_rules("class", " Class", "required|callback_class_selected");

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('timetable/create_timetable_form', $data);
            $this->load->view('/templates/footer');
        } else {
            $data['class_id'] = $this->input->post('class');
            $data['year'] = $this->input->post('year');
            $data['timetable_id'] = $this->timetable_model->create_class_timetable($data['class_id'], $data['year']);
            $data['class_name'] = $this->class_model->get_class_name($data['class_id']);
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('timetable/timetable', $data);
            $this->load->view('/templates/footer');
        }
    }

    function search_by_year() {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        $data['page_title'] = "Timetable Management";
        $data['navbar'] = 'timetable';

        $keyword = $this->input->post('year');
        $data['timetable_list'] = $this->timetable_model->search_by_year($keyword);

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('timetable/index', $data);
        $this->load->view('/templates/footer');
    }
    
    function search_by_class(){
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        $data['page_title'] = "Timetable Management";
        $data['navbar'] = 'timetable';

        $keyword = $this->input->post('class');
        $class_id = $this->class_model->get_class_id($keyword);
        
        $data['timetable_list'] = $this->timetable_model->search_by_class($class_id);

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('timetable/index', $data);
        $this->load->view('/templates/footer');
    }

    function open($timetable_id) {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        $data['page_title'] = "Timetable: $timetable_id";
        $data['navbar'] = "timetable";
        $data['timetable_id'] = $timetable_id;

        $timetable = $this->timetable_model->get_class_timetable($timetable_id);

        $data['year'] = $timetable->year;
        $data['class_name'] = $this->class_model->get_class_name($timetable->class_id);

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('timetable/timetable', $data);
        $this->load->view('/templates/footer');
    }

    function check_year() {
        $year = $this->input->post('year');
        $class_id = $this->input->post('class');
        if ($year < 1990 OR $year > 2099) {
            $this->form_validation->set_message('check_year', "year must be greater that 1990 and less that 2099");
            return FALSE;
        } else if ($this->timetable_model->timetable_already_have($class_id, $year)) {
            $class_name = $this->class_model->get_class_name($class_id);
            $this->form_validation->set_message('check_year', "there's timetable created for the class: <strong>$class_name</strong>");
            return FALSE;
        }
        return TRUE;
    }

    function class_selected() {
        $class = $this->input->post('class');
        if ($class == 0) {
            $this->form_validation->set_message('class_selected', "Please select a class");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function teacher_selected() {
        $teacher = $this->input->post('teacher');
        if ($teacher == 0) {
            $this->form_validation->set_message('teacher_selected', "Please select a teacher");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function subject_selected() {
        $subject = $this->input->post('subject');
        if ($subject == 0) {
            $this->form_validation->set_message('subject_selected', "Please select a subject");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function delete($timetable_id) {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        $data['page_title'] = "Timetable Management";
        $data['navbar'] = "timetable";

        if ($this->timetable_model->delete($timetable_id)) {
            $data['delete_msg'] = "Timetable ID: {$timetable_id} is successfully deleted.";
            $data['timetable_list'] = $this->timetable_model->get_timetable_list();

            $this->timetable_model->delete_slots($timetable_id);

            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('timetable/index', $data);
            $this->load->view('/templates/footer');
        }
    }

    function test() {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        $data['page_title'] = "Test Timetable";
        $data['navbar'] = "timetable";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('timetable/timetable', $data);
        $this->load->view('/templates/footer');
    }

    function add_slot($timetable_id, $slot_id) {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];
        
        $data['page_title'] = "Timetable Management";
        $data['navbar'] = "timetable";
        $data['timetable'] = $this->timetable_model->get_class_timetable($timetable_id);
        $data['slot_id'] = $slot_id;
        $data['teacher_list'] = $this->timetable_model->get_teacher_list();
        $data['subject_list'] = $this->timetable_model->get_subject_list();



        $this->form_validation->set_rules("teacher", "Teacher", "required|integer|callback_teacher_selected|callback_teacher_already_have_slot");
        $this->form_validation->set_rules("subject", "Subject", "required|callback_subject_selected");

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('timetable/add_slot_form', $data);
            $this->load->view('/templates/footer');
        } else {
            $slot['timetable_id'] = $timetable_id;
            $slot['slot_id'] = $slot_id;
            $slot['teacher_id'] = $this->input->post('teacher');
            $slot['subject_id'] = $this->input->post('subject');
            $slot['year'] = $this->timetable_model->get_timetable_year($timetable_id);
            $this->timetable_model->add_slot($slot);
            $this->open($timetable_id);
        }
    }

    function delete_slot($timetable_id, $slot_id) {
        $this->timetable_model->delete_slot($timetable_id, $slot_id);
        $this->open($timetable_id);
    }

    function teacher_already_have_slot() {

        $timetable_id = $this->input->post('timetable_id');
        $slot_id = $this->input->post('slot');
        $teacher_id = $this->input->post('teacher');
        $year = $this->timetable_model->get_timetable_year($timetable_id);

        if ($in_timetable = $this->timetable_model->already_have_slot($teacher_id, $slot_id, $year)) {
            $this->form_validation->set_message('teacher_already_have_slot', "The teacher you have selected already have a slot in timetable <strong># {$in_timetable}</strong> ");
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
