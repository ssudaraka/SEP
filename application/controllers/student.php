<?php

class Student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Student_Model');
        $this->load->helper('date');
        $this->load->model('user');
    }

    function index($uri_segment = "3") {

        $this->load->library('pagination');

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        if ($data['user_type'] == 'S') {
            redirect(profile);
        } else {

            $data['navbar'] = "student";
            $data['navbar'] = 'student';
            $data['page_title'] = "Manage Student";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/Student/search_student', $data);
            $this->load->view('/templates/footer');
        }
    }

    /*
     * search teacher by keyword.... may return multiple 
     */

    public function search_one() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "student";
        $id = $this->input->post('id');
        $data['query'] = $this->Student_Model->search_student($id);

        /*
         * if there is no any matching result should display a error message
         */
        if ($data['query']->num_rows() <= 0) {

            $data['err_message'] = "No result is found";
        }
        /*
         * getting the user type
         */
        $data['user_type'] = $this->session->userdata['user_type'];

        $data['result'] = $data['query']->result();
        $data['page_title'] = "Manage Teacher";
        $this->load->view('/templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);


        if ($data['user_type'] == 'A') {//if admin
            $this->load->view('/student/search_student_1', $data);
        } else if ($data['user_type'] == 'T') {//if Teacher
            $this->load->view('/student/search_student_1_t', $data);
        }

        $this->load->view('/templates/footer');
    }

    /*
     * Function for Creating a new student
     */

    public function create_student() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['page_title'] = "Admission";
        $data['navbar'] = "student";
        $data['user_type'] = $this->session->userdata['user_type']; //getting the user type
        /*
         * checking validations
         */
        $this->load->library('form_validation');
        $this->form_validation->set_rules('admissionnumber', 'Admission Number', 'required|is_unique[students.admission_no]|min_length[4]');
        $this->form_validation->set_rules('admissiondate', 'Admission Date', 'required|callback_check_admission_date');
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('initials', 'Name With Initials', 'required');
        $this->form_validation->set_rules('dob', 'Date Of Birth', 'required|callback_check_Birth_day');
        $this->form_validation->set_rules('nic', 'NIC No', 'exact_length[10]|is_unique[students.nic_no]|callback_check_NIC');
        $this->form_validation->set_rules('language', 'Medium', 'required|callback_check_selection_status');
        $this->form_validation->set_rules('religion', 'Religion', 'callback_check_selection');
        $this->form_validation->set_rules('houseid', 'Houser', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('contact_home', 'Contact Home', 'exact_length[10]|integer');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');


        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        
       
        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data['page_title'] = "Admission";


           // $data['stud_data'] = $student_data;
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('student/create_student', $data);

            $this->load->view('/templates/footer');
        } else {//validation ok
            $student_data = array(
                // 'studentid' => $student_id,
                'admissionno' => $this->input->post('admissionnumber'),
                'admissiondate' => $this->input->post('admissiondate'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'nameWithInitials' => $this->input->post('initials'),
                'birthday' => $this->input->post('dob'),
                'nic' => $this->input->post('nic'),
                'language' => $this->input->post('language'),
                'religion' => $this->input->post('religion'),
                'houseid' => $this->input->post('houseid'),
                'address' => $this->input->post('address'),
                'contactHome' => $this->input->post('contact_home'),
                'email' => $this->input->post('email')
            );
            
             $this->session->set_userdata('student_d',$student_data);
        
            $data['page_title'] = "Admission";
            $data['navbar'] = "student";
            $data['stud_data'] = $student_data;
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('student/create_guardian', $data);
            $this->load->view('/templates/footer');
        }
    }

    /*
     * function for adding a new guardian
     */

    public function create_guardian() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['page_title'] = "Admission";
        $data['navbar'] = "student";
        $data['user_type'] = $this->session->userdata['user_type']; //getting the user type


        $this->load->library('form_validation');
        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('initial', 'initial', 'required');
        $this->form_validation->set_rules('relation', 'relation', 'required');
        $this->form_validation->set_rules('dobg', 'dob', 'required|callback_check_guardian_Birth_day');
        $this->form_validation->set_rules('occupation', 'occupation', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('contact_homeg', 'contact_home', 'required|exact_length[10]|integer');
        $this->form_validation->set_rules('contact_mobile', 'contact_mobile', 'exact_length[10]|integer');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data['page_title'] = "Admission";
            $data['row'] = $this->Student_Model->get_last_row();
            $data['stud_data']=$this->session->userdata('student_d');
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('student/create_guardian', $data);
            $this->load->view('/templates/footer');
        } else {

            if (isset($_POST['pastpupil'])) {
                $pastpupil = 1; // get the value of checked checkbox.
            } else {
                $pastpupil = 0;
                ;
            }

            $last_row = $this->Student_Model->get_last_row(); //getting last student user_id
            $student_id = $last_row->id;
            $studentd = array();
            $studentd = $this->session->userdata('student_d');

            $student_data = array(
                // 'studentid' => $student_id,
                'admissionno' => $studentd['admissionno'],
                'admissiondate' => $studentd['admissiondate'],
                'firstname' => $studentd['firstname'],
                'lastname' => $studentd['lastname'],
                'nameWithInitials' => $studentd['nameWithInitials'],
                'birthday' => $studentd['birthday'],
                'nic' => $studentd['nic'],
                'language' => $studentd['language'],
                'religion' => $studentd['religion'],
                'houseid' => $studentd['houseid'],
                'address' => $studentd['address'],
                'contactHome' => $studentd['contactHome'],
                'email' => $studentd['email']
            );

            if ($id = $this->Student_Model->insert_new_student($student_data)) {

                /*
                 * creating and inserting login credentials for the student
                 */
                $data['row'] = $this->Student_Model->get_last_inserted_student($id);
                $ID = $data['row']->id;
                $username = $data['row']->admission_no;
                
                $password = "PW_" . $username;
                
                $create = date('Y-m-d H:i:s');
                $fname = $studentd['firstname'];
                $lname = $studentd['lastname'];
                if ($id = $this->Student_Model->insert_new_student_userdata($username, $password, $create, $fname, $lname)) {

                    $this->Student_Model->set_user_id($ID, $id);

                    $guardian_data = array(
                        'studentid' => $this->input->post('studentid'),
                        'fullname' => $this->input->post('fullname'),
                        'relation' => $this->input->post('relation'),
                        'namewithinitials' => $this->input->post('initial'),
                        'birthday' => $this->input->post('dobg'),
                        'gender' => $this->input->post('gender'),
                        'occupation' => $this->input->post('occupation'),
                        'pastpupil' => $pastpupil,
                        'address' => $this->input->post('address'),
                        'contact_home' => $this->input->post('contact_homeg'),
                        'contact_mobile' => $this->input->post('contact_mobile')
                    );

                    if ($id = $this->Student_Model->insert_new_Guardian($guardian_data)) { // the information has therefore been successfully saved in the db
//                        $last_row = $this->Student_Model->get_last_row();
//                        $student_id = $last_row->user_id;
//                        $this->view_profile($student_id);
                        $this->session->unset_userdata('student_d');
                        $this->session->set_flashdata('succ_message','Admission Successfull');
                        redirect('student/create_student');
                    } else {
                        $err= 'An error occurred saving your information. Please try again later';
                        $this->session->set_flashdata('err_message',$err);
                        redirect('student/create_student');
                    }
                } else {
                   $err= 'An error occurred creating your user account. Please try again later';
                   $this->session->set_flashdata('err_message',$err);
                        redirect('student/create_student');
                }
            } else {
                $err= 'An error occurred saving your information. Please try again later';
                $this->session->set_flashdata('err_message',$err);
                        redirect('student/create_student');
            }
        }
    }

    /*
     * Function for change password
     */

    function account_settings() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['user_type'] = $this->session->userdata['user_type']; //Getting user type

        if ($this->session->userdata('user_type') !== "S") {//only enable for students
            redirect('login', 'refresh');
        }

        $result = $this->user->get_details($this->session->userdata('id'));
        foreach ($result as $row) {
            $data['first_name'] = $row->first_name;
            $data['last_name'] = $row->last_name;
        }

        $data['page_title'] = "Account Settings";
        $data['navbar'] = 'admin';
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('student/edit_student_logdetails', $data);
        $this->load->view('templates/footer');
    }

    /*
     * Function for view student+guardian profile for a given id
     */

    function view_profile($student_id) {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['user_type'] = $this->session->userdata['user_type'];
        $data['page_title'] = "Profile";
        $data['navbar'] = 'student';
        $data['user_id'] = $this->Student_Model->get_student_only($student_id);
        $data['user_id_2'] = $this->Student_Model->get_guardian_only($student_id);
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);

        if ($data['user_type'] == 'A') {
            $this->load->view('student/check_student_profile', $data);
        } else if ($data['user_type'] == 'T') {
            $this->load->view('student/check_student_profile_1', $data);
        } else if ($data['user_type'] == 'S') {
            $this->load->view('student/check_student_profile_1_S', $data);
        }
        $this->load->view('/templates/footer');
    }

    /*
     * uploading student profile picture 
     */

    function upload_pro_pic() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);
        $last_row = $this->Student_Model->get_last_row();
        $student_id = $last_row->user_id;
        //$image = $this->user->get_profile_img($student_id);
        $ss = $this->upload->do_upload('profile_img');
        $image_data = $this->upload->data();
        $image = base_url() . "uploads/" . $image_data['file_name'];

        $update_data = array(
            'student_id' => $student_id,
            'image' => $image
        );

        if ($this->Student_Model->update_profile_picture($update_data)) {

            $data['page_title'] = "Profile";
            $data['navbar'] = 'student';
            $data['user_id'] = $this->Student_Model->get_student_only($student_id);
            $data['user_id_2'] = $this->Student_Model->get_guardian_only($student_id);
            $data['profile_image'] = $this->user->get_profile_img($student_id);
            $data['user_type'] = $this->session->userdata['user_type'];
            $data['succ_message'] = "Profile Settings Changed Successfully";

            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);

            if ($data['user_type'] == 'A') {
                $this->load->view('student/check_student_profile', $data);
            } else if ($data['user_type'] == 'T') {
                $this->load->view('student/check_student_profile_1', $data);
            } else if ($data['user_type'] == 'S') {
                $this->load->view('student/check_student_profile_1_S', $data);
            }
            $this->load->view('/templates/footer');
        }
    }

    /*
     * Function for view student profile for a given id
     */

    function view_student_profile($student_id) {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['user_type'] = $this->session->userdata['user_type'];
        $data['page_title'] = "Student Profile";
        $data['navbar'] = 'student';
        $data['user_id'] = $this->Student_Model->get_student_only($student_id);
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);

        if ($data['user_type'] == 'A') {
            $this->load->view('student/check_student_only_profile', $data);
        } else if ($data['user_type'] == 'T') {
            $this->load->view('student/check_student_only_profile_1', $data);
        }


        $this->load->view('/templates/footer');
    }

    /*
     * Function for view guardian profile for a given id
     */

    function view_guardian_profile($student_id) {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['user_type'] = $this->session->userdata['user_type'];
        $data['page_title'] = "Student Profile";
        $data['navbar'] = 'student';
        $data['user_id'] = $this->Student_Model->get_guardian_only($student_id);
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        //$this->load->view('student/check_guardian_only_profile', $data);

        if ($data['user_type'] == 'A') {
            $this->load->view('student/check_guardian_only_profile', $data);
        } else if ($data['user_type'] == 'T') {
            $this->load->view('student/check_guardian_only_profile_1', $data);
        }
        $this->load->view('/templates/footer');
    }

    /*
     * function for delete student+guardian recode
     */

    public function delete_student($id) {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "student";
        $data['user_type'] = $this->session->userdata['user_type'];

        if ($data['user_type'] == 'A') {
            if ($this->Student_Model->delete_student($id)) {

                $data['query'] = $this->Student_Model->get_all_archive_students();
                $data['result'] = $data['query'];
                $data['succ_message'] = "Student details deleted successfully";
                $data['page_title'] = "Search Archived Student";
                $this->load->view('/templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('/student/archived_search_student', $data);
                $this->load->view('/templates/footer');
            } else {

                $data['query'] = $this->Student_Model->get_all_archive_students();
                $data['result'] = $data['query'];
                $data['err_message'] = "Error occured";
                $data['page_title'] = "Search Archived Student";
                $this->load->view('/templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('/student/archived_search_student', $data);
                $this->load->view('/templates/footer');
            }
        } else {

            redirect('login', 'refresh');
        }
    }

    /*
     * function for edit a specific guardian
     */

    public function edit_guardian() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "student";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('initials', 'initial', 'required');
        $this->form_validation->set_rules('dob', 'dob', 'required|callback_check_guardian_Birth_day');
        $this->form_validation->set_rules('occupation', 'occupation', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('contact_home', 'contact_home', 'required|exact_length[10]|integer');
        $this->form_validation->set_rules('contact_mobile', 'contact_mobile', 'exact_length[10]|integer');

        if ($this->form_validation->run() == FALSE) {

            $myid = $this->input->post('studentid'); //if validations are fualse load form with same details
            $this->load_guardian($myid);
        } else {
            //validations passed
            $myid = $this->input->post('studentid');
            $guardian = array(
                'name' => $this->input->post('fullname'),
                'nameWithInitials' => $this->input->post('initials'),
                'birthday' => $this->input->post('dob'),
                'occupation' => $this->input->post('occupation'),
                'address' => $this->input->post('address'),
                'contact_home' => $this->input->post('contact_home'),
                'contact_mobile' => $this->input->post('contact_mobile')
            );

            if ($this->Student_Model->update_guardian($guardian, $myid)) {

                $data['page_title'] = "Guardian Profile";
                $data['succ_message'] = "Guardian details updated successfully";
                $data['result'] = $this->Student_Model->get_guardian_only($myid);
                $data['page_title'] = "Edit Guardian";
                $this->load->view('/templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('/student/edit_guardian', $data);
                $this->load->view('/templates/footer');
            } else {

                $data['err_message'] = "Guardian details update error";
                $data['page_title'] = "Guardian Profile";
                $this->load->view('/templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('/student/edit_guardian', $data);
                $this->load->view('/templates/footer');
            }
        }
    }

    /*
     * Load guardian details in to update view
     */

    public function load_guardian($id) {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "student";
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['result'] = $this->Student_Model->get_guardian_only($id);
        $data['page_title'] = "Edit Guardian";

        $this->load->view('/templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('/student/edit_guardian', $data);
        $this->load->view('/templates/footer');
    }

    /*
     * function for edit a specific student
     */

    function edit_student() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "student";
        $data['user_type'] = $this->session->userdata['user_type'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('initials', 'initial', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('contact_home', 'contact_home', 'required|exact_length[10]|integer');

        if ($this->form_validation->run() == FALSE) {

            $myid = $this->input->post('studentid');
            $this->load_student($myid);
        } else {

            $myid = $this->input->post('studentid');
            $student = array(
                'name' => $this->input->post('fullname'),
                'nameWithInitials' => $this->input->post('initials'),
                'address' => $this->input->post('address'),
                'contact_home' => $this->input->post('contact_home'),
                'email' => $this->input->post('email')
            );

            if ($this->Student_Model->update_student($student, $myid)) {

                $data['page_title'] = "Student Profile";
                $data['succ_message'] = "Student details updated successfully";
                $data['result'] = $this->Student_Model->get_student_only($myid);
                $data['page_title'] = "Student Profile";

                $this->load->view('/templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('/student/edit_student', $data);
                $this->load->view('/templates/footer');
            } else {

                $data['err_message'] = "Student details update error";
                $data['page_title'] = "Student Profile";
                $this->load->view('/templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('/student/edit_student', $data);
                $this->load->view('/templates/footer');
            }
        }
    }

    /*
     * Load student details in to update view
     */

    public function load_student($id) {
        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "student";
        $data['result'] = $this->Student_Model->get_student_only($id);
        $data['page_title'] = "Edit Student";

        $this->load->view('/templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('/student/edit_student', $data);
        $this->load->view('/templates/footer');
    }

    /*
     * change Student's account password
     */

    function change_password() {
        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['user_type'] = $this->session->userdata['user_type'];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('oldpassword', 'Old Password', "required|xss_clean|callback_check_old_password");
        $this->form_validation->set_rules('password', 'New Password', "required|min_length[5]|xss_clean|matches[confirm_password]"); //check password with confirm password
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', "required|xss_clean|matches[password]");

        if ($this->form_validation->run() == FALSE) {

            $data['page_title'] = "Account Settings";
            $data['err_message'] = "Errer Occured";
            $data['navbar'] = 'student';
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('student/edit_student_logdetails', $data);
            $this->load->view('templates/footer');
        } else {

            $user_id = $this->session->userdata('id');
            $new_password = $this->input->post('password');

            if ($this->Student_Model->change_password($user_id, $new_password)) {

                $data['page_title'] = "Account Seings";
                $data['navbar'] = 'student';
                $data['succ_message'] = "Password Changed Successfully";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('student/edit_student_logdetails', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    /*
     * check whether user has entered his Old password correctly before changing his password
     */

    function check_old_password() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $user_id = $this->session->userdata('id');
        $password_hash = $this->Student_Model->get_password_hash($user_id);
        $inserted_old_password_hash = md5($this->input->post('oldpassword'));

        if ($password_hash === $inserted_old_password_hash) {

            return TRUE;
        } else {

            $this->form_validation->set_message('check_old_password', "Your old password is incorrect");
            return FALSE;
        }
    }

    /*
     * function for archive student+guardian recode
     */

    public function archive_student($id) {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "student";
        $data['user_type'] = $this->session->userdata['user_type'];


        if ($this->Student_Model->archive_student($id)) {

            //reload table
            $data['query'] = $this->Student_Model->get_all_students_2();
            $data['result'] = $data['query']->result();
            $data['succ_message'] = "Student details deleted successfully";
            $data['page_title'] = "Search Student";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/student/search_student', $data);
            $this->load->view('/templates/footer');
        } else {

            $data['query'] = $this->Student_Model->get_all_students_2();
            $data['result'] = $data['query']->result();
            $data['page_title'] = "Search Student";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/student/search_student', $data);
            $this->load->view('/templates/footer');
        }
    }

    /*
     * get archive student details
     */

    public function load_all_archived_students() {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "admin";
        $data['user_type'] = $this->session->userdata['user_type'];

        if ($data['user_type'] == 'A') {

            $data['query'] = $this->Student_Model->get_all_archive_students();
            $data['result'] = $data['query'];
            $data['page_title'] = "Search Archived Student";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/student/archived_search_student', $data);
            $this->load->view('/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    /*
     * Function for view archived student profile for a given id
     */

    function view_archived_student_profile($student_id) {

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }

        $data['user_type'] = $this->session->userdata['user_type'];
        $data['page_title'] = "Archived Student Profile";
        $data['navbar'] = 'admin';
        $data['user_id'] = $this->Student_Model->get_archived_student_only($student_id);
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);

        if ($data['user_type'] == 'A') {
            $this->load->view('student/archived_check_student_only_profile', $data);
        } else {
            redirect('login', 'refresh');
        }


        $this->load->view('/templates/footer');
    }

    function load_student_datatble() {


        $col = array("id", "id2", "admission_no", "name_with_initials", "contact_home");

        $filter = $this->input->get();
        // $user_id=$this->session->userdata('user_id');

        $inputs = array(
            "offset" => $filter["start"],
            "limit" => $filter["length"],
            "orderby" => $filter["order"][0]["dir"],
            "orderCol" => $col[$filter["order"][0]["column"]],
            "search" => $filter["search"]["value"]
        );

        $data = $this->Student_Model->get_all_student_details($inputs);

//        var_dump($data);
//        die();

        $newData = array();
        $status = '';
        $x = $filter["start"];
        for ($i = 0; $i < sizeof($data["data"]); $i++) {



            $id = $data["data"][$i]->id;
            $id2 = $data["data"][$i]->user_id;
            $admission_no = $data["data"][$i]->admission_no;
            $name_with_initials = $data["data"][$i]->name_with_initials;
            $contact_home = $data["data"][$i]->contact_home;




            $newData[] = array(
                "id" => $id,
                "id2" => $id2,
                "admission_no" => $admission_no,
                "name_with_initials" => $name_with_initials,
                "contact_home" => $contact_home
            );
        }


        $is["data"] = $newData;
        $is["recordsTotal"] = $data["count"];
        $is["recordsFiltered"] = $data["count"];

        echo json_encode($is);
    }

    /*
     * <<<<<<<<<<<<<<<<<<<<<<    validation functions    >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
     */

    /*
     * combobox validation
     */

    function check_selection($field) {


        if ($field == 0) {
            $this->form_validation->set_message('check_selection', 'Please Select a Selection!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * combobox validation
     */

    function check_selection_status($field) {

        if ($field == 'n') {
            $this->form_validation->set_message('check_selection_status', 'Please Select One Option!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * mobile no validation
     */

    function check_Mobile($field) {

        $res = preg_match('/07[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/', $field);
        if ($res == 0) {
            $this->form_validation->set_message('check_Mobile', 'Please Enter Valid Mobile No!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * nic validation
     */

    function check_NIC($field) {

        $res = preg_match('/[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][vV]/', $field);
        if ($res == null) {
            return TRUE;
        } elseif ($res == 0) {
            $this->form_validation->set_message('check_NIC', 'Please Enter Your Valid NIC!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * admission date validation
     */

    function check_addmission_date($field) {
        $datestring = "%Y-%m-%d";
        $time = time();
        $create = mdate($datestring, $time);

        if ($create - $field < 0 || $create - $field > 18) {
            $this->form_validation->set_message('check_admission_date', 'Please Enter Valid Admission Date!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * student birthday validation
     */

    function check_Birth_day($field) {

        $datestring = "%Y-%m-%d";
        $time = time();
        $create = mdate($datestring, $time);

        if ($create - $field > 20 || $create - $field < 5) {
            $this->form_validation->set_message('check_Birth_day', 'Please Enter Valid Birth Day!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * guardian birthday validation
     */

    function check_guardian_Birth_day($field) {

        $datestring = "%Y-%m-%d";
        $time = time();
        $create = mdate($datestring, $time);

        if ($create - $field < 20) {
            $this->form_validation->set_message('check_guardian_Birth_day', 'Please Enter Valid Birth Day!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * gender (selected or not) validation
     */

    function check_gender($d) {

//$gender = $this->input->post('gender');
        if ($d == 'f' || $d == 'm') {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_gender', 'Required Gender Field');
            return FALSE;
        }
    }

}
