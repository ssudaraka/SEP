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
            //Show his/her personal details
            $data['page_title'] = "View Teacher Profile";
            $data['navbar'] = 'teacher';
            $data['progress'] = 0;
            $teacher_id = $this->Teacher_Model->get_teacher_id($this->session->userdata['id']);
            $data['user_id'] = $this->Teacher_Model->get_staff_details($teacher_id);
            $data['propic'] = $this->Teacher_Model->get_profile_img($teacher_id);
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
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];


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
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "teacher";
        $data['row'] = $this->Teacher_Model->getTeacherProfile($id);
        $data['attempt'] = 1;
        $data['page_title'] = "Teacher Profile";
        $this->load->view('/templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('/teacher/edit_teacher_profile', $data);
        $this->load->view('/templates/footer');
    }

    //edit teacher
    public function edit_teacher($id) {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "teacher";
        $this->load->library('form_validation');

        //edit_teacher_profile view validations
        $this->form_validation->set_rules('NIC', 'NIC', 'required|exact_length[10]|callback_check_NIC');
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('initial', 'Name with Initial', 'required');
        $this->form_validation->set_rules('birth', 'Birth Day', 'required|callback_check_Birth_day');
        $this->form_validation->set_rules('gender', 'Gender', 'callback_check_gender');
        $this->form_validation->set_rules('Nationality', 'Nationality', 'callback_check_selection');
        $this->form_validation->set_rules('religion', 'Religion', 'callback_check_selection');
        $this->form_validation->set_rules('civilstatus', 'Civil Status', 'callback_check_selection_status');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('contactMob', 'Contact Mobile', 'exact_length[10]|integer');
        $this->form_validation->set_rules('contactHome', 'Contact Home', 'exact_length[10]|integer');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('widow', 'Widow & Orphan No', 'required');
        $this->form_validation->set_rules('serialno', 'Serial No', 'required|less_than[100000]|integer');
        $this->form_validation->set_rules('signatureno', 'Signature No', 'required|less_than[1000]|integer');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('careerdate', 'Date Joined this School', 'required|callback_check_career_day');
        $this->form_validation->set_rules('designation', 'Designation', 'required|callback_check_selection');
        $this->form_validation->set_rules('medium', 'Medium', 'required|callback_check_selection_status');
        $this->form_validation->set_rules('section', 'Section', 'required|callback_check_selection');
        $this->form_validation->set_rules('mainsubject', 'Main Subject', 'required|callback_check_selection');
        $this->form_validation->set_rules('servicegrade', 'Service Grade', 'required|callback_check_selection');
        $this->form_validation->set_rules('personfile', 'Personal File No', 'required');
        $this->form_validation->set_rules('teacherregno', 'Register No', 'required');
        $this->form_validation->set_rules('serviceperiod', 'Service Period', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $this->form_validation->set_rules('nature', 'Nature of Appointment', 'required|callback_check_selection');
        $this->form_validation->set_rules('education', 'Educational Qualification', 'required');
        $this->form_validation->set_rules('profession', 'Professional Qualification', 'required');
        $this->form_validation->set_rules('appointmentdate', 'Appointment Date', 'callback_check_career_day');
        $this->form_validation->set_rules('pension', 'Pension Date', 'callback_check_pension_day');
        $this->form_validation->set_rules('promotions', 'Promotion', 'callback_check_selection');
        $this->form_validation->set_rules('increment', 'Increment Date', 'callback_check_pension_day');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');


        //if validations are false
        if ($this->form_validation->run() == FALSE) {
            //$myid = $this->input->post('XID');
            //load form with same details
            //$this->load_teacher($id);
            $data['row'] = $this->Teacher_Model->getTeacherProfile($id);
            $data['navbar'] = "teacher";
            $data['attempt'] = 2;
            $data['page_title'] = "Teacher Profile";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/teacher/edit_teacher_profile', $data);
            $this->load->view('/templates/footer');
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
                'remarks' => $this->input->post('remarks'),
                'nature' => $this->input->post('nature'),
                'education' => $this->input->post('education'),
                'profession' => $this->input->post('profession'),
                'appointmentdate' => $this->input->post('appointmentdate'),
                'pension' => $this->input->post('pension'),    
                'increment' => $this->input->post('increment'),
                'promotions' => $this->input->post('promotions')
            );

            //successfull message is genarated
            if ($this->Teacher_Model->UpdateTeacher($teacher, $id)) {
                $data['attempt'] = 1;
                $data['page_title'] = "Teacher Profile";
                $data['succ_message'] = "Teacher details updated successfully";
                $data['row'] = $this->Teacher_Model->getTeacherProfile($id);
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
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

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
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "teacher";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('NIC', 'NIC', 'required|exact_length[10]|is_unique[teachers.nic_no]|callback_check_NIC');
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('initial', 'Initials', '');
        $this->form_validation->set_rules('birth', 'Birth Day', 'required|callback_check_Birth_day');
        $this->form_validation->set_rules('gender', 'Gender', 'callback_check_gender');
        $this->form_validation->set_rules('Nationality', 'Nationality', 'callback_check_selection');
        $this->form_validation->set_rules('religion', 'Religion', 'callback_check_selection');
        $this->form_validation->set_rules('civilstatus', 'Civil Status', 'callback_check_selection_status');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('contactMob', 'Contatct Mobile', 'exact_length[10]|integer|callback_check_Mobile');
        $this->form_validation->set_rules('contactHome', 'Contact Home', 'exact_length[10]|integer');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('widow', 'Widow No', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data['page_title'] = "Teacher Registration";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('teacher/teacher_reg_form', $data);
            $this->load->view('/templates/footer');
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

    

    function update_details($id) {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "teacher";
        $data['page_title'] = "Teacher Registration";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('regno', 'Register No', 'required');
        $this->form_validation->set_rules('serialno', 'Serial No', 'required|less_than[100000]|is_unique[teachers.serial_no]|integer');
        $this->form_validation->set_rules('signatureno', 'Signature No', 'required|less_than[1000]|is_unique[teachers.signature_no]|integer');
        $this->form_validation->set_rules('careerdate', 'Date Joined', 'required|callback_check_career_day');
        $this->form_validation->set_rules('medium', 'Medium', '');
        $this->form_validation->set_rules('designation', 'Designation', '');
        $this->form_validation->set_rules('section', 'Section', '');
        $this->form_validation->set_rules('mainsubject', 'Main subject', '');
        $this->form_validation->set_rules('servicegrade', 'Service grade', 'callback_check_selection');
        $this->form_validation->set_rules('appointment', 'Appointment', 'callback_check_selection');
        $this->form_validation->set_rules('educational', 'Educational qualification', '');
        $this->form_validation->set_rules('profession', 'Professional qualification', '');
        $this->form_validation->set_rules('first_appointment', 'First appointment', 'callback_check_career_day');
        $this->form_validation->set_rules('fileno', 'File no', '');
        $this->form_validation->set_rules('pension', 'Due pension date', 'callback_check_pension_day');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data['user_id'] = $id;
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/teacher/teacher_update_form', $data);
            $this->load->view('/templates/footer');
        } else { // passed validation proceed to post success logic
            // build array for the model
            $regno = $this->input->post('regno');
            $serialno = $this->input->post('serialno');
            $signatureno = $this->input->post('signatureno');
            $careerdate = $this->input->post('careerdate');
            $medium = $this->input->post('medium');
            $designation = $this->input->post('designation');
            $section = $this->input->post('section');
            $mainsubject = $this->input->post('mainsubject');
            $servicegrade = $this->input->post('servicegrade');
            $appointment = $this->input->post('appointment');
            $educational = $this->input->post('educational');
            $profession = $this->input->post('profession');
            $first_appointment = $this->input->post('first_appointment');
            $fileno = $this->input->post('fileno');
            $pension = $this->input->post('pension');
            // run insert model to write data to db

            $create = date('Y-m-d H:i:s');
            $this->Teacher_Model->set_time($id, $create);

            if ($t_id = $this->Teacher_Model->update_new_staff($regno, $id, $serialno, $signatureno, $careerdate, $medium, $designation,
                    $section, $mainsubject, $servicegrade, $appointment, $educational, $profession, $first_appointment, $fileno, $pension )) { // the information has therefore been successfully saved in the db
                $data["user_id"] = $t_id;
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

    function create_log_details($id) {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "teacher";
        $data['page_title'] = "Teacher Registration";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'User Name', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[confirm_password]');
        
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['user_id'] = $id;
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('teacher/teacher_logdetails_form', $data);
            $this->load->view('/templates/footer');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $create = date('Y-m-d H:i:s');
            
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '0';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            
            $this->upload->do_upload('profile_img');
            $image_data = $this->upload->data();
            $image = base_url() . "uploads/" . $image_data['file_name'];
            
            if ($u_id = $this->Teacher_Model->insert_new_teacher_userdata($username, $password, $create)) { // the information has therefore been successfully saved in the db
                $this->Teacher_Model->set_user_id($id, $u_id);
                $this->Teacher_Model->upload_pic($id , $image);
                $data['propic'] = $this->Teacher_Model->get_profile_img($id);
                if ($res = $this->Teacher_Model->get_staff_details($id)) {
                    $data['progress'] = 1;
                    $data["user_id"] = $res;
                    $this->load->view('templates/header', $data);
                    $this->load->view('navbar_main', $data);
                    $this->load->view('navbar_sub', $data);
                    $this->load->view('teacher/check_teacher_profile', $data);
                    $this->load->view('/templates/footer');
                }
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        
        }
    }
    
    function check_profile($id){
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "teacher";
        $data['page_title'] = "Teacher Registration";
        $data['propic'] = $this->Teacher_Model->get_profile_img($id);
        $res = $this->Teacher_Model->get_staff_details($id);
        $data['progress'] = 0;
        $data["user_id"] = $res;
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('teacher/check_teacher_profile', $data);
        $this->load->view('/templates/footer');
    }
            
    function create_profile() {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "teacher";
        $data['page_title'] = "Profile";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'User Name', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[confirm_password]');
        
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        $data['users'] = $this->Teacher_Model->SearchAllTeachers();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('teacher/create_profile_view', $data);
            $this->load->view('/templates/footer');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $teacher = $this->input->post('teachername');
            $create = date('Y-m-d H:i:s');
            
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '0';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $this->upload->do_upload('profile_img');
            $image_data = $this->upload->data();
            $image = base_url() . "uploads/" . $image_data['file_name'];
            
            $teacher_log_id = $this->Teacher_Model->getTeacherUserId($teacher);
            if($teacher_log_id == 0){
                $u_id = $this->Teacher_Model->insert_new_teacher_userdata($username, $password, $create);
                $this->Teacher_Model->set_user_id($teacher, $u_id);
            }
            else{
                $this->Teacher_Model->update_new_teacher_userdata($username, $password, $create , $teacher_log_id);
                $this->Teacher_Model->set_user_id($teacher, $teacher_log_id);
            }
            
            $data['succ_message'] = "Successfully created";
            $this->Teacher_Model->upload_pic($teacher , $image);
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('teacher/create_profile_view', $data);
            $this->load->view('/templates/footer');
                
        
        }
    }

    function view_profile($teacher_id) {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['page_title'] = "View Teacher Profile";
        $data['navbar'] = 'teacher';
        $data['progress'] = 0;
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['user_id'] = $this->Teacher_Model->get_staff_details($teacher_id);
        $data['propic'] = $this->Teacher_Model->get_profile_img($teacher_id);
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('teacher/check_teacher_profile', $data);
        $this->load->view('/templates/footer');
    }
    
    function teacher_report($val) {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['value'] = $val;
        $data['page_title'] = "Teacher Report";
        $data['navbar'] = 'teacher';
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['users'] = $this->Teacher_Model->SearchAllTeachers();
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('teacher/teacher_report_form', $data);
        $this->load->view('/templates/footer');
    }
    
    function report_pdf($l) {
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];
        
        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $this->load->helper(array('dompdf', 'file'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('reporttype', 'reporttype', 'callback_check_selection');
        $this->form_validation->set_rules('report', 'report', '');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        
        if ($this->form_validation->run() == FALSE) {
            $data['page_title'] = "Teacher Report";
            $data['navbar'] = 'teacher';
            $data['value'] = 0;
            $data['users'] = $this->Teacher_Model->SearchAllTeachers();
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('teacher/teacher_report_form', $data);
            $this->load->view('/templates/footer');
        } 
        else{
            $report = $this->input->post('report');
            if($l == 1){
                $data['section'] = $report;
                $data['school_name'] = "D. S. Senanayake College";
                $data['result'] = $this->Teacher_Model->get_section_teacher_details($report);
                $filename = "Teacher_report";    
                $html = $this->load->view('teacher/report_pdf', $data, true);
                pdf_create($html, $filename);
            }
            else if($l == 2){
                $data['school_name'] = "D. S. Senanayake College";
                $data['propic'] = $this->Teacher_Model->get_profile_img($report);
                $data['result'] = $this->Teacher_Model->get_staff_details($report);
                $filename = "Teacher_report";    
                $html = $this->load->view('teacher/report_teacher_pdf', $data, true);
                pdf_create($html, $filename);
            }
        }
    }
    
    function check_selection($field) {

        if ($field == 0) {
            $this->form_validation->set_message('check_selection', 'Please Select One!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_selection_status($field) {

        if ($field == 'n') {
            $this->form_validation->set_message('check_selection_status', 'Please Select One!');
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

    function check_career_day($field) {

        $datestring = "%Y-%m-%d";
        $time = time();
        $create = mdate($datestring, $time);

        if ($create >= $field) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_career_day', 'Please Enter Valid Date!');
            return FALSE;
        }
    }
    
    function check_pension_day($field) {

        $datestring = "%Y-%m-%d";
        $time = time();
        $create = mdate($datestring, $time);

        if ($create < $field) {
            return TRUE;
        }else if($field == 0000-00-00){
            return TRUE;
        }
        else {
            $this->form_validation->set_message('check_pension_day', 'Please Enter Valid Date!');
            return FALSE;
        }
    }

}
