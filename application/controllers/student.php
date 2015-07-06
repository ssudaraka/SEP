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

        $data['navbar'] = "student";

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];


        $data['page_title'] = "Manage Student";
        $data['navbar'] = 'student';


/**
 * Get all student recodes and display in a table
 */
        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = base_url() . "index.php/student/student";
        $total_row = $this->db->get('students')->num_rows();
        $config["total_rows"] = $total_row;
        $config["per_page"] = 10;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

//  if there is no uri segment null value will be sent
        $config['offset'] = ($this->uri->segment(3) ? $this->uri->segment(3) : null);
        $data["query"] = $this->Student_Model->get_all_students($config["per_page"], $config['offset']);
//      $data["query"] = $this->Student_Model->get_all_students_2();
        $data['result'] = $data['query']->result();
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);



//Load the view  + with pagination
           
            
             if ($data['user_type'] == 'A') {
            $data['page_title'] = "Manage Student";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/Student/search_student', $data);
            $this->load->view('/templates/footer');
        } else if ($data['user_type'] == 'T') {
            $data['page_title'] = "Manage Student";
            $this->load->view('/templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/Student/search_student_t', $data);
            $this->load->view('/templates/footer');
        } else if ($data['user_type'] == 'S') {
            $data['page_title'] = "Manage Student";
            $data['navbar'] = 'student';

              $user_id = $this->session->userdata('id');
              $this->view_profile($user_id);
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

        //if there is no any matching result should display a error message
        if ($data['query']->num_rows() <= 0) {

            $data['err_message'] = "No result is found";
        }
        //getting the user type
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
    public function create_student(){
        $data['page_title'] = "Admission";
        $data['navbar'] = "student";

        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];
        
        //checking validations
         $this->load->library('form_validation');
         $this->form_validation->set_rules('admissionnumber', 'Admission Number', 'required|is_unique[students.admission_no]|exact_length[4]');
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
        $this->form_validation->set_rules('contactHome', 'Contact Home', 'exact_length[10]|integer');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
         
        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data['page_title'] = "Admission";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('student/create_student', $data);
            $this->load->view('/templates/footer');

        }else{//validation ok
        //getting the last student's Id and Creating new students student_id    
//                $last_row=$this->Student_Model->get_last_row();
//                $table_id=$last_row->id;
//                $student_id="ST_".($table_id+1);
        
            $student_data = array(
               // 'studentid' => $student_id,
                'admissionno'=> $this->input->post('admissionnumber'),
                'admissiondate'=> $this->input->post('admissiondate'),
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
               'email'=> $this->input->post('email')
        );
         if ($id=$this->Student_Model->insert_new_student($student_data)) { // the information has therefore been successfully saved in the db
                
                $data['row']=$this->Student_Model->get_last_inserted_student($id);
                $data['page_title'] = "Admission";
                $data['navbar'] = "student";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('student/create_guardian', $data);  
                $this->load->view('/templates/footer');
                
                //creating and inserting login credentials for the student
                $ID=$data['row']->id;
                $username =$data['row']->admission_no;
                $password = "PW_".$username;
                $create = date('Y-m-d H:i:s');
                
               if($id=$this->Student_Model->insert_new_student_userdata($username, $password, $create)){
                   $this->Student_Model->set_user_id($ID, $id);
               }else{
                   echo 'An error occurred creating your user account. Please try again later';
               }
                
            } else {
                echo 'An error occurred saving your information. Please try again later';
            
            }
        
        
        }
        
        
    }
    /*
     * Function for change password
     */
    function account_settings() {

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

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
     * function for adding a new guardian
     */
      public function create_guardian() {
        $data['page_title'] = "Admission";
        $data['navbar'] = "student";

        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];


        $this->load->library('form_validation');

        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('initial', 'initial', 'required');
        $this->form_validation->set_rules('relation', 'relation', 'required');
        $this->form_validation->set_rules('dob', 'dob', 'required|callback_check_guardian_Birth_day');
        $this->form_validation->set_rules('occupation', 'occupation', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('contact_home', 'contact_home', 'required|exact_length[10]|integer');
        $this->form_validation->set_rules('contact_mobile', 'contact_mobile', 'exact_length[10]|integer');



        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data['page_title'] = "Admission";
            $data['row'] = $this->Student_Model->get_last_row();
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

            //getting last student user_id
            $last_row = $this->Student_Model->get_last_row();
            $student_id = $last_row->id;


            $guardian_data = array(
                'studentid' => $this->input->post('studentid'),
                'fullname' => $this->input->post('fullname'),
                'relation' => $this->input->post('relation'),
                'namewithinitials' => $this->input->post('initial'),
                'birthday' => $this->input->post('dob'),
                'gender' => $this->input->post('gender'),
                'occupation' => $this->input->post('occupation'),
                'pastpupil' => $pastpupil,
                'address' => $this->input->post('address'),
                'contact_home' => $this->input->post('contact_home'),
                'contact_mobile' => $this->input->post('contact_mobile')
            );
            if ($id = $this->Student_Model->insert_new_Guardian($guardian_data)) { // the information has therefore been successfully saved in the db
                $last_row = $this->Student_Model->get_last_row();
                $student_id = $last_row->user_id;

                $this->view_profile($student_id);
            } else {
                echo 'An error occurred saving your information. Please try again later';
               
        }
      }}
  
    /*
     * Function for view student+guardian profile for a given id
     */
    function view_profile($student_id) {
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
         }else if ($data['user_type'] == 'T') {
       $this->load->view('student/check_student_profile_1', $data);
         }else if($data['user_type'] == 'S'){
         $this->load->view('student/check_student_profile_1_S', $data);    
         }
          $this->load->view('/templates/footer');
    }
    
    /*
     * Function for view student profile for a given id
     */
    function view_student_profile($student_id){
         $data['user_type'] = $this->session->userdata['user_type'];
        
         $data['page_title'] = "Student Profile";
        $data['navbar'] = 'student';
        $data['user_id'] = $this->Student_Model->get_student_only($student_id);
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        
        if ($data['user_type'] == 'A') {
       $this->load->view('student/check_student_only_profile', $data);
         }else if ($data['user_type'] == 'T') {
       $this->load->view('student/check_student_only_profile_1', $data);
         }
         
        
        $this->load->view('/templates/footer');
        
    }
    
    /*
     * Function for view guardian profile for a given id
     */
    function view_guardian_profile($student_id){
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
         }else if ($data['user_type'] == 'T') {
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
        $data['navbar'] = "teacher";

        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];


        if ($this->Student_Model->delete_student($id)) {

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
    * function for edit a specific guardian
    */
    public function edit_guardian() {

        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if (!$this->session->userdata('id')) {
            redirect('login', 'refresh');
        }
        $data['navbar'] = "student";
        $this->load->library('form_validation');

     // validations
       $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('initials', 'initial', 'required');
        $this->form_validation->set_rules('dob', 'dob', 'required|callback_check_guardian_Birth_day');
        $this->form_validation->set_rules('occupation', 'occupation', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('contact_home', 'contact_home', 'required|exact_length[10]|integer');
        $this->form_validation->set_rules('contact_mobile', 'contact_mobile', 'exact_length[10]|integer');


        if ($this->form_validation->run() == FALSE) {
            $myid = $this->input->post('studentid');
    //if validations are fualse load form with same details
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
        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

            if (!$this->session->userdata('id')) {
                redirect('login', 'refresh');
            }
            $data['navbar'] = "student";
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
    function edit_student(){

        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];
        
             $data['navbar'] = "student";
             $this->load->library('form_validation');
             
             $this->form_validation->set_rules('fullname', 'fullname', 'required');
             $this->form_validation->set_rules('initials', 'initial', 'required');
             
             $this->form_validation->set_rules('address', 'address', 'required');
             $this->form_validation->set_rules('contact_home', 'contact_home', 'required|exact_length[10]|integer');
             
                
             if ($this->form_validation->run() == FALSE) {
                   $myid = $this->input->post('studentid');
                   $this->load_student($myid);
             }else{
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
                $this->load->view('/student/edit_Student', $data);
                $this->load->view('/templates/footer');
                }else{
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
    public function load_student($id){

        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

                if (!$this->session->userdata('id')) {
                    redirect('login', 'refresh');
                }
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

        //getting the user type
        $data['user_type'] = $this->session->userdata['user_type'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('oldpassword', 'Old Password', "required|xss_clean|callback_check_old_password");
        $this->form_validation->set_rules('password', 'New Password', "required|min_length[5]|xss_clean|matches[confirm_password]");//check password with confirm password
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', "required|xss_clean|matches[password]");

        if ($this->form_validation->run() == FALSE) {
            $data['page_title'] = "Account Settings";
            $data['err_message']="Errer Occured";
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
        if ($res==null) {
            return TRUE;
        }elseif ($res == 0) {
            $this->form_validation->set_message('check_NIC', 'Please Enter Your Valid NIC!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * admission date validation
     */
    function check_addmission_date($field){
        $datestring = "%Y-%m-%d";
        $time = time();
        $create = mdate($datestring, $time);

        if ($create - $field < 0 || $create - $field >18) {
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

        if ($create - $field < 20 ) {
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
