<?php

class Teacher extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Teacher_Model');
        $this->load->helper('date');
        $this->load->model('user');
    }

    function index() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "teacher";
        $data['result'] = $this->Teacher_Model->SearchAllTeachers();

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] == 'T'){
            $data['page_title'] = "View Teacher Profile";
            $data['navbar'] = 'teacher';
            $teacher_id = $this->Teacher_Model->get_teacher_id($this->session->userdata['id']);
            $data['user_id'] = $this->Teacher_Model->get_staff_details($teacher_id);
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('teacher/check_teacher_profile', $data);
            $this->load->view('/templates/footer');

        } else{
            //Load all teachers
            $data['page_title'] = "Search Teacher";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/teacher/Search_page', $data);
            $this->load->view('/templates/footer');
            $result = $this->user->get_details($this->session->userdata('id'));
            foreach ($result as $row) {
                $data['first_name'] = $row->first_name;
                $data['last_name'] = $row->last_name;
            }
        }


    }

    //Table search
    public function search_one() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "teacher";
        $id = $this->input->post('nic');
        $data['query'] = $this->Teacher_Model->SearchTeacher($id);
        if ($data['query']->num_rows() <= 0) {

            $data['err_message'] = "No result is found";
        }

        $data['result'] = $data['query']->result();
        $data['page_title'] = "Search Teacher";
        $this->load->view('/templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('/teacher/Search_page', $data);
        $this->load->view('/templates/footer');
    }

    //Load teacher details in to update view
    public function load_teacher($id) {
        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "teacher";
        $data['result'] = $this->Teacher_Model->getTeacherProfile($id);

        $data['page_title'] = "Teacher Profile";
        $this->load->view('/templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('/teacher/edit_teacher_profile', $data);
        $this->load->view('/templates/footer');
    }

    //edit teacher
    public function edit_teacher() {
        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "teacher";
        $this->load->library('form_validation');

        //edit_teacher_profile view validations
        $this->form_validation->set_rules('NIC', 'NIC', 'required|exact_length[10]|callback_check_NIC');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('initial', 'initial', 'required');
        $this->form_validation->set_rules('birth', 'birth', 'required|callback_check_Birth_day');
        $this->form_validation->set_rules('gender', 'gender', 'callback_check_gender');
        $this->form_validation->set_rules('Nationality', 'Nationality', 'callback_check_selection');
        $this->form_validation->set_rules('religion', 'religion', 'callback_check_selection');
        $this->form_validation->set_rules('civilstatus', 'civilstatus', 'callback_check_selection_status');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('contactMob', 'contactMob', 'exact_length[10]|integer|callback_check_Mobile');
        $this->form_validation->set_rules('contactHome', 'contactHome', 'exact_length[10]|integer');
        $this->form_validation->set_rules('email', 'email', 'valid_email');
        $this->form_validation->set_rules('widow', 'widow', '');
        $this->form_validation->set_rules('serialno', 'serialno', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('careerdate', 'careerdate', 'required');
        $this->form_validation->set_rules('medium', 'medium', 'required');
        $this->form_validation->set_rules('section', 'section', 'required');
        $this->form_validation->set_rules('mainsubject', 'mainsubject', 'required');
        $this->form_validation->set_rules('servicegrade', 'servicegrade', 'required');
        $this->form_validation->set_rules('personfile', 'personfile', 'required');
        $this->form_validation->set_rules('teacherregno', 'teacherregno', 'required');
        $this->form_validation->set_rules('serviceperiod', 'serviceperiod', 'required');
        $this->form_validation->set_rules('remarks', 'remarks', 'required');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');


        //if validations are false
        if ($this->form_validation->run() == FALSE) {
            $myid = $this->input->post('XID');
            //load form with same details
            $this->load_teacher($myid);
        } else {

            //validations passed
            $myid = $this->input->post('XID');
            $teacher = array(
                'nic' => $this->input->post('NIC'),
                'fullName' => $this->input->post('name'),
                'nameWithInitials' => $this->input->post('initial'),
                'birthday' => $this->input->post('birth'),
                'gender' => $this->input->post('gender'),
                'nationality' => $this->input->post('Nationality'),
                'religion' => $this->input->post('religion'),
                'civilStatus' => $this->input->post('civilstatus'),
                'address' => $this->input->post('address'),
                'contactMobile' => $this->input->post('contactMob'),
                'contactHome' => $this->input->post('contactHome'),
                'email' => $this->input->post('email'),
                'wnop' => $this->input->post('widow'),
                'serial' => $this->input->post('serialno'),
                'signature' => $this->input->post('signatureno'),
                'joinDate' => $this->input->post('careerdate'),
                'medium' => $this->input->post('medium'),
                'designation' => $this->input->post('designation'),
                'section' => $this->input->post('section'),
                'mainSub' => $this->input->post('mainsubject'),
                'serviceGrade' => $this->input->post('servicegrade'),
                'personalFile' => $this->input->post('personfile'),
                'teacherRegNo' => $this->input->post('teacherregno'),
                'service' => $this->input->post('serviceperiod'),
                'remarks' => $this->input->post('remarks')
            );

            //successfull message is genarated
            if ($this->Teacher_Model->UpdateTeacher($teacher, $myid)) {
                $data['page_title'] = "Teacher Profile";
                $data['succ_message'] = "Teacher details updated successfully";
                $data['result'] = $this->Teacher_Model->getTeacherProfile($myid);
                $this->load->view('/templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('/teacher/edit_teacher_profile', $data);
                $this->load->view('/templates/footer');
            } else {

                // error message
                $data['page_title'] = "Teacher Profile";
                $this->load->view('/templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('/teacher/edit_teacher_profile', $data);
                $this->load->view('/templates/footer');
            }
        }
    }

    //deleate teacher recode
    public function delete_teacher($id) {
        if(!$this->session->userdata('id')){
            redirect('login', 'refresh');
        }
        $data['navbar'] = "teacher";


        if ($this->Teacher_Model->DeleteTeacher($id)) {

            $data['result'] = $this->Teacher_Model->SearchAllTeachers();


            $data['succ_message'] = "Teacher details deleted successfully";
            $data['page_title'] = "Search Teacher";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/teacher/Search_page', $data);
            $this->load->view('/templates/footer');
        } else {

            $data['result'] = $this->Teacher_Model->SearchAllTeachers();


            $data['succ_message'] = "Teacher details deleted successfully";
            $data['page_title'] = "Search Teacher";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/teacher/Search_page', $data);
            $this->load->view('/templates/footer');
        }
    }

    function create() {
        $data['navbar'] = "teacher";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('NIC', 'NIC', 'required|exact_length[10]|is_unique[teachers.nic_no]|callback_check_NIC');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('initial', 'initial', '');
        $this->form_validation->set_rules('birth', 'birth', 'required|callback_check_Birth_day');
        $this->form_validation->set_rules('gender', 'gender', 'callback_check_gender');
        $this->form_validation->set_rules('Nationality', 'Nationality', 'callback_check_selection');
        $this->form_validation->set_rules('religion', 'religion', 'callback_check_selection');
        $this->form_validation->set_rules('civilstatus', 'civilstatus', 'callback_check_selection_status');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('contactMob', 'contactMob', 'exact_length[10]|integer|callback_check_Mobile');
        $this->form_validation->set_rules('contactHome', 'contactHome', 'exact_length[10]|integer');
        $this->form_validation->set_rules('email', 'email', 'valid_email');
        $this->form_validation->set_rules('widow', 'widow', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data['page_title'] = "Teacher Registration";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('teacher/teacher_reg_form', $data);
            //$this->load->view('teacher/check_teacher_profile', $data);
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
                $data['navbar'] = "teacher";
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

    function check_selection($field) {

//        $Nationality = $this->input->post('Nationality');
//        $religion = $this->input->post('religion');
//        $civilstatus = $this->input->post('civilstatus'); 

        if ($field == 0) {
            $this->form_validation->set_message('check_selection', 'Please Select a Selection!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_selection_status($field) {

        if ($field == 'n') {
            $this->form_validation->set_message('check_selection_status', 'Please Select Your Status!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_Mobile($field) {

        $res = preg_match('/07[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/', $field);
        if ($res == 0) {
            $this->form_validation->set_message('check_Mobile', 'Please Enter Valid Mobile No!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_NIC($field) {

        $res = preg_match('/[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][vV]/', $field);
        if ($res == 0) {
            $this->form_validation->set_message('check_NIC', 'Please Enter Your Valid NIC!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_Birth_day($field) {

        $datestring = "%Y-%m-%d";
        $time = time();
        $create = mdate($datestring, $time);

        if ($create - $field > 60 || $create - $field < 20) {
            $this->form_validation->set_message('check_Birth_day', 'Please Enter Valid Birth Day!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_gender($d) {

        //$gender = $this->input->post('gender');
        if ($d == 'f' || $d == 'm') {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_gender', 'Required Gender Field');
            return FALSE;
        }
    }

    function update_details() {

        $data['navbar'] = "teacher";
        $data['page_title'] = "Teacher Registration";
        $data['user_id'] = $this->input->post('NIC');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('NIC', 'NIC', '');
        $this->form_validation->set_rules('serialno', 'serialno', 'required|exact_length[3]|is_unique[teachers.serial_no]|integer');
        $this->form_validation->set_rules('signatureno', 'signatureno', 'required|is_unique[teachers.signature_no]|integer');
        $this->form_validation->set_rules('careerdate', 'careerdate', 'required|callback_check_career_day');
        $this->form_validation->set_rules('medium', 'medium', '');
        $this->form_validation->set_rules('designation', 'designation', '');
        $this->form_validation->set_rules('section', 'section', '');
        $this->form_validation->set_rules('mainsubject', 'mainsubject', '');
        $this->form_validation->set_rules('servicegrade', 'servicegrade', 'required');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/teacher/teacher_update_form', $data);
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

//            $datestring = "%Y-%m-%d %h:%i:%a";
//            $time = time();
//            $create = mdate($datestring, $time);
            $create = date('Y-m-d H:i:s');
            $this->Teacher_Model->set_time($NIC, $create);

            if ($id = $this->Teacher_Model->update_new_staff($NIC, $serialno, $signatureno, $careerdate, $medium, $designation, $section, $mainsubject, $servicegrade)) { // the information has therefore been successfully saved in the db
                $data["user_id"] = $id;
                $data['page_title'] = "Teacher Registration";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('teacher/teacher_logdetails_form', $data);   // or whatever logic needs to occur
                $this->load->view('/templates/footer');
            } else {
                echo 'An error occurred saving your information. Please try again laterrrrrrr';
                // Or whatever error handling is necessary
            }
        }
    }

    function create_log_details() {
        $data['navbar'] = "teacher";
        $data['page_title'] = "Teacher Registration";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ID', 'ID', '');
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'password', 'required|matches[confirm_password]|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[confirm_password]');

        $data['user_id'] = $this->input->post('ID');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('teacher/teacher_logdetails_form', $data);
            $this->load->view('/templates/footer');
        } else {

            $ID = $this->input->post('ID');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');

//            $datestring = "%Y-%m-%d %h:%i:%a";
//            $time = time();
            $create = date('Y-m-d H:i:s');
            //$this->Teacher_Model->set_time($ID , $create);

            if ($id = $this->Teacher_Model->insert_new_teacher_userdata($username, $password, $create)) { // the information has therefore been successfully saved in the db
                $this->Teacher_Model->set_user_id($ID, $id);
                if ($res = $this->Teacher_Model->get_staff_details($ID)) {
                    $data["user_id"] = $res;
                    $this->load->view('templates/header', $data);
                    $this->load->view('navbar_main', $data);
                    $this->load->view('navbar_sub', $data);
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

    function view_profile($teacher_id) {
        $data['page_title'] = "View Teacher Profile";
        $data['navbar'] = 'teacher';
        $data['user_id'] = $this->Teacher_Model->get_staff_details($teacher_id);
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('teacher/check_teacher_profile', $data);
        $this->load->view('/templates/footer');
    }

    function check_career_day($field) {

        $datestring = "%Y-%m-%d";
        $time = time();
        $create = mdate($datestring, $time);

        if ($create >= $field) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_career_day', 'Please Enter Valid Career Date!');
            return FALSE;
        }
    }


}
