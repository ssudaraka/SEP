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
        if($this->input->post('class_teacher')){
            $this->form_validation->set_rules('class_teacher', 'Class Teacher', 'callback_validate_teacher_class');
        }
        
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
        $data['page_title'] = "{$data['class']->name} : Class Management";
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "admin";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('classes/view_class', $data);
        $this->load->view('/templates/footer', $data);
    }
    
    function assign_to_class($class_id){
        $data['class'] = $this->class_model->get_class($class_id);
        $data['class_students'] = $this->class_model->get_class_students($class_id);
        $data['page_title'] = "Assign Students to {$data['class']->name} : Class Management";
        $data['students_eligible'] = $this->class_model->get_students_without_class($data['class']->grade_id);
        $data['students_in'] = $this->class_model->get_class_students($class_id);
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "admin";
        
//        var_dump($data['class']);
//        var_dump($data['class_students']);
//        
//        var_dump($data['students_eligible']);
        
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('classes/assign_students_to_class', $data);
        $this->load->view('/templates/footer', $data);
    }
    
    function process_student_class_assignment($class_id){
        $students_eligible = $this->input->post('students-eligible');
        $students_in = $this->input->post('students-in');
        $this->class_model->assign_students_to_class($class_id, $students_eligible, $students_in);
        redirect("classes/view_class/{$class_id}");
    }
    
    /*
     * If this class teacher already assigned to class, return FALSE
     * else return TRUE
     */
    function validate_teacher_class(){
        $teacher_id = $this->input->post('class_teacher');
        if($this->class_model->teacher_assigned_to_class($teacher_id, date('Y'))){
            $this->form_validation->set_message('validate_teacher_class', 'Selected Teacher Already Assigned to a Class');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /*
     * Returns false if we already have a class name for given class name in academic year.
     */
    function validate_class_name(){
        
    }

    function edit_class(){
        
    }
}
