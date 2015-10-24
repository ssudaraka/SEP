<?php

class Classes extends CI_Controller {

    function __construct() {
        parent::__construct();


        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->model('class_model');
        $this->load->helper('class');
    }

    function index() {
        $data['page_title'] = "Class Management";
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "admin";
        $grade = $this->input->get('grade');
        $academic_year = $this->input->get('ay');

        if (!$academic_year) {
            $academic_year = date('Y');
        }

        $data['result'] = $this->class_model->get_classes($grade, $academic_year);

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('classes/index');
        $this->load->view('/templates/footer');
    }

    function create() {
        $data['page_title'] = "Class Management";
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "admin";
        $data['grades'] = $this->class_model->get_grades();

        $this->load->model('teacher_model');
        $data['teachers'] = $this->teacher_model->get_teacher_list();

        // if this is a redirect from successful form submission, get the success message.
        $data['succ_message'] = $this->session->flashdata('succ_message');

        $this->form_validation->set_rules('grade', 'Grade', 'required|callback_grade_selected');
        $this->form_validation->set_rules('class_name', 'Class Name', 'required');
        //$this->form_validation->set_rules('class_teacher', 'Class Teacher', '');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('classes/create_class', $data);
            $this->load->view('/templates/footer', $data);
        } else {
            $class = array(
                'grade_id' => $this->input->post('grade'),
                'name' => $this->input->post('class_name'),
                'academic_year' => date('Y'),
            );

            if ($this->input->post('class_teacher') != 'select_teacher') {
                $class['teacher_id'] = $this->input->post('class_teacher');
            }
            $this->class_model->create_class($class);
            $this->session->set_flashdata('succ_message', "Class Created");
            redirect('classes/create');
        }
    }

    function grade_selected() {
        $grade = $this->input->post('grade');
        if ($grade == 'select_grade') {
            $this->form_validation->set_message('grade_selected', 'Please select a grade');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function view_class($class_id) {
        $data['class'] = $this->class_model->get_class($class_id);
        $data['class_students'] = $this->class_model->get_class_students($class_id);
        $data['page_title'] = "{$class->name} : Class Management";
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "admin";

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('classes/create_class', $data);
        $this->load->view('/templates/footer', $data);
    }

}
