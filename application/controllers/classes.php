<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classes extends CI_Controller {

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
        $this->load->model('Class_Model');
        $this->load->model('Year_Model');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "Class Management";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        //For Admin Views
        if($data['user_type'] == 'A'){

            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);

            //View Year Planer Admin
            $this->load->view('classes/index');
            
            $this->load->view('/templates/footer');
        } else {
            redirect('dashboard', 'refresh');
        }

    }

    //view class
    public function view_class($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        if(!isset($id)){
        	redirect('dashboard');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "View Class - Class Management";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];
         $data['classid'] = $id;
       
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }


        	$data['studentlist'] = $this->Class_Model->view_class_students($id);

	    	$data['classinfo'] = $this->Class_Model->viewclass($id);
	    	$classdet = $this->Class_Model->viewclass($id);
	    	if(!empty($classdet['teacher_id'])){
		    	$data['teacher_name'] = $this->Class_Model->get_teacher_name($classdet['teacher_id']);
		    }

	        $this->load->view('templates/header', $data);
	        $this->load->view('navbar_main', $data);
	        $this->load->view('navbar_sub', $data);
	        //View Assign Batch Admin
	        $this->load->view('classes/view_class');
	        $this->load->view('/templates/footer');
    }

    //Delete Student from Class
    public function remove_from_class($id, $classid){
    	if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        if (!isset($id)) {
            redirect('classes');
        }

        if (!isset($classid)) {
            redirect('classes');
        }

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }

        $student = array(
                'class' => NULL
            );

        if($this->Class_Model->unassign_student_from_class($student,$id)){
                redirect('classes/view_class/'. $classid . '?delete=success', 'refresh');
        } else{
            redirect('classes/view_class/'. $classid . '?delete=fail', 'refresh');               
        }


    }

     //Assign Class Teacher
    public function assign_class_teacher($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        if(!isset($id)){
        	redirect('dashboard');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "View Class - Class Management";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];


        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }


        $this->load->library('form_validation');
        $this->form_validation->set_rules('cmbteacher', 'Teacher', "required|callback_check_teacher_selected|callback_check_vaild_teacher");

        	$data['teachers'] = $this->Class_Model->get_unselected_teachers();

	    	$data['classinfo'] = $this->Class_Model->viewclass($id);

	    	$data['classid'] = $id;
	    if ($this->form_validation->run() == FALSE) {

	        $this->load->view('templates/header', $data);
	        $this->load->view('navbar_main', $data);
	        $this->load->view('navbar_sub', $data);
	        //View Assign Batch Admin
	        $this->load->view('classes/assign_class_teacher');
	        $this->load->view('/templates/footer');
	    } else{
	    	$sentarray = array(
	                'teacher_id' => $this->input->post('cmbteacher')
	            );

	    	if($this->Class_Model->update_class_teacher($sentarray, $id)){
	    		$data['succ_message'] = "Class Teacher Assigned successfully";
		    	$this->load->view('templates/header', $data);
		        $this->load->view('navbar_main', $data);
		        $this->load->view('navbar_sub', $data);
		        //View Assign Batch Admin
		        $this->load->view('classes/assign_class_teacher');
		        $this->load->view('/templates/footer');
		        $this->output->set_header('refresh:3; url='.base_url('index.php/classes/view_class/'.$id));
		    } else{
		    	$this->load->view('templates/header', $data);
		        $this->load->view('navbar_main', $data);
		        $this->load->view('navbar_sub', $data);
		        //View Assign Batch Admin
		        $this->load->view('classes/assign_class_teacher');
		        $this->load->view('/templates/footer');	
		    }
	    }
    }

    //Assign Class for Students
    public function assign_class() {
    	 if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "Assign Class - Class Management";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }

        $data['classlist'] = $this->Class_Model->get_class_list();
        $data['studentlist'] = $this->Class_Model->get_pending_students();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('cmbbatch', 'Batch', "required|callback_check_batch_selected");

        if ($this->form_validation->run() == FALSE) {
	        //Passing it to the View
	        $this->load->view('templates/header', $data);
	        $this->load->view('navbar_main', $data);
	        $this->load->view('navbar_sub', $data);
	        //View Assign Batch Admin
	        $this->load->view('classes/assign_class');
	        $this->load->view('/templates/footer');
	    } else{
	    	$batchid = $this->input->post('cmbbatch');
	    	$students = $this->input->post('hiddenbox');
	    	$student_array = explode(",", $students);
	    	//Passing it to the View
	    	foreach ($student_array as $value) {
		    	 $classarray = array(
	                'class' => $batchid
	            );
		    	//Update Student
		    	$this->Class_Model->update_student_batch($classarray, $value);

	    	}

	    	$data['succ_message'] = "Class Assigned successfully";
	    	$data['studentlist'] = $this->Class_Model->get_pending_students();

	        $this->load->view('templates/header', $data);
	        $this->load->view('navbar_main', $data);
	        $this->load->view('navbar_sub', $data);
	        //View Assign Batch Admin
	        $this->load->view('classes/assign_class');
	        $this->load->view('/templates/footer');
	    }
    }

    //Assign Batch for Students
    public function assign_batch() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "Assign Batch - Class Management";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }

        $data['batchlist'] = $this->Class_Model->get_batch_list();
        $data['studentlist'] = $this->Class_Model->getpendingstudents();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('cmbbatch', 'Batch', "required|callback_check_batch_selected");

        if ($this->form_validation->run() == FALSE) {
	        //Passing it to the View
	        $this->load->view('templates/header', $data);
	        $this->load->view('navbar_main', $data);
	        $this->load->view('navbar_sub', $data);
	        //View Assign Batch Admin
	        $this->load->view('classes/assign_batch');
	        $this->load->view('/templates/footer');
	    } else{
	    	$batchid = $this->input->post('cmbbatch');
	    	$students = $this->input->post('hiddenbox');
	    	$student_array = explode(",", $students);
	    	//Passing it to the View
	    	foreach ($student_array as $value) {
		    	 $classarray = array(
	                'batch' => $batchid
	            );
		    	//Update Student
		    	$this->Class_Model->update_student_batch($classarray, $value);

	    	}

	    	$data['succ_message'] = "Class Assigned successfully";
	    	$data['studentlist'] = $this->Class_Model->getpendingstudents();

	        $this->load->view('templates/header', $data);
	        $this->load->view('navbar_main', $data);
	        $this->load->view('navbar_sub', $data);
	        //View Assign Batch Admin
	        $this->load->view('classes/assign_batch');
	        $this->load->view('/templates/footer');
	    }
    }

    //Create Class
    public function create_class() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "Add New Class - Class Management";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
       	$this->load->library('form_validation');
        $this->form_validation->set_rules('classname', 'Class Name', "trim|required|xss_clean|callback_check_class_name");

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if ($this->form_validation->run() == FALSE) {
        	//Get Class List
        	$data['classlist'] = $this->Class_Model->get_class_list();

            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            //View Create Class
            $this->load->view('classes/create_class');
            $this->load->view('/templates/footer');

        } else{
        	//Success Logic
        	$grade = $this->input->post('cmbgrade');
	        $name = strtoupper($this->input->post('classname'));

	        $classarray = array(
                'name' => $name,
                'grade_id' => $grade
            );

            if($this->Class_Model->addclass($classarray)){
            	//Passing it to the View
            	//Get Class List
        		$data['classlist'] = $this->Class_Model->get_class_list();
        		$data['succ_message'] = "Class sucessfully Created";

	            $this->load->view('templates/header', $data);
	            $this->load->view('navbar_main', $data);
	            $this->load->view('navbar_sub', $data);
	            //View Create Class
	            $this->load->view('classes/create_class');
	            $this->load->view('/templates/footer');
            } else{
            	//Passing it to the View
	            $this->load->view('templates/header', $data);
	            $this->load->view('navbar_main', $data);
	            $this->load->view('navbar_sub', $data);
	            //View Create Class
	            $this->load->view('classes/create_class');
	            $this->load->view('/templates/footer');
            }
        }
    } 

    //Edit Class
    public function edit_class($id){
    	if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        if (!isset($id)) {
            redirect('dashboard');
        }

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "Edit Class Basics - Class Management";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
       	$this->load->library('form_validation');
        $this->form_validation->set_rules('classname', 'Class Name', "trim|required|xss_clean|callback_check_class_name");

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['classid'] = $id;
        $data['classdet'] = $this->Class_Model->viewclass($id);

        if ($this->form_validation->run() == FALSE) {
        	//Get Class List
        	$data['classlist'] = $this->Class_Model->get_class_list();

            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            //View Create Class
            $this->load->view('classes/edit_class');
            $this->load->view('/templates/footer');

        } else{
        	//Success Logic
        	$grade = $this->input->post('cmbgrade');
	        $name = strtoupper($this->input->post('classname'));

	        $classarray = array(
                'name' => $name,
                'grade_id' => $grade
            );

            if($this->Class_Model->updateclass($classarray, $id)){
            	//Passing it to the View
            	//Get Class List
        		$data['classlist'] = $this->Class_Model->get_class_list();
        		$data['succ_message'] = "Class updated successfully";

        		$data['classdet'] = $this->Class_Model->viewclass($id);

	            $this->load->view('templates/header', $data);
	            $this->load->view('navbar_main', $data);
	            $this->load->view('navbar_sub', $data);
	            //View Create Class
	            $this->load->view('classes/edit_class');
	            $this->load->view('/templates/footer');

	            $this->output->set_header('refresh:3; url='.base_url('index.php/classes/create_class'));
            } else{
            	//Passing it to the View
	            $this->load->view('templates/header', $data);
	            $this->load->view('navbar_main', $data);
	            $this->load->view('navbar_sub', $data);
	            //View Create Class
	            $this->load->view('classes/edit_class');
	            $this->load->view('/templates/footer');
            }
        }

    	
    }

    //Delete Class
    public function delete_class($id){
    	if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        if (!isset($id)) {
            redirect('dashboard');
        }

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }

        if($this->Class_Model->deleteclass($id)){
                redirect('classes/create_class?delete=success', 'refresh');
        } else{
            redirect('classes/create_class?delete=fail', 'refresh');               
        }


    }

    //Create Batch
    public function create_batch() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "Create Batch - Class Management";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
       	$this->load->library('form_validation');
        $this->form_validation->set_rules('batchname', 'Batch Name', "trim|required|xss_clean|callback_check_batch_name");

        //Get AY
        $data['all_years'] =  $this->Year_Model->get_all_academic_years();

        if ($this->form_validation->run() == FALSE) {
        	//Get Class List
        	$data['batchlist'] = $this->Class_Model->get_batch_list();

            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            //View Create Class
            $this->load->view('classes/create_batch');
            $this->load->view('/templates/footer');

        } else{
        	//Success Logic
        	$academic_year = $this->input->post('cmbay');
	        $name = strtoupper($this->input->post('batchname'));
	        $grade = $this->input->post('cmbgrade');

	        $batcharray = array(
                'name' => $name,
                'grade' => $grade,
                'academic_year' => $academic_year
            );

            if($this->Class_Model->addbatch($batcharray)){
            	//Passing it to the View
            	//Get Class List
        		$data['batchlist'] = $this->Class_Model->get_batch_list();
        		$data['succ_message'] = "Batch sucessfully Created";

	            $this->load->view('templates/header', $data);
	            $this->load->view('navbar_main', $data);
	            $this->load->view('navbar_sub', $data);
	            //View Create Class
	            $this->load->view('classes/create_batch');
	            $this->load->view('/templates/footer');
            } else{
            	//Passing it to the View
	            $this->load->view('templates/header', $data);
	            $this->load->view('navbar_main', $data);
	            $this->load->view('navbar_sub', $data);
	            //View Create Class
	            $this->load->view('classes/create_batch');
	            $this->load->view('/templates/footer');
            }
        }
    }

    //Edit Batch
    public function edit_batch($id){
    	if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        if (!isset($id)) {
            redirect('dashboard');
        }

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] != 'A'){
        	redirect('dashboard');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "Edit Batch Basics - Class Management";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
       	$this->load->library('form_validation');
        $this->form_validation->set_rules('batchname', 'Batch Name', "trim|required|xss_clean|callback_check_batch_name");

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['batchid'] = $id;
        $data['batchdet'] = $this->Class_Model->viewbatch($id);

        //Get AY
        $data['all_years'] =  $this->Year_Model->get_all_academic_years();

        if ($this->form_validation->run() == FALSE) {
        	//Get Class List
        	$data['batchlist'] = $this->Class_Model->get_batch_list();

            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            //View Create Class
            $this->load->view('classes/edit_batch');
            $this->load->view('/templates/footer');

        } else{
        	//Success Logic
        	$academic_year = $this->input->post('cmbay');
	        $name = strtoupper($this->input->post('batchname'));
	        $grade = $this->input->post('cmbgrade');

	        $batcharray = array(
                'name' => $name,
                'grade' => $grade,
                'academic_year' => $academic_year
            );

            if($this->Class_Model->updatebatch($batcharray, $id)){
            	//Passing it to the View
            	//Get Class List
        		$data['batchlist'] = $this->Class_Model->get_batch_list();
        		$data['succ_message'] = "Batch updated successfully";

        		$data['batchdet'] = $this->Class_Model->viewbatch($id);

	            $this->load->view('templates/header', $data);
	            $this->load->view('navbar_main', $data);
	            $this->load->view('navbar_sub', $data);
	            //View Create Class
	            $this->load->view('classes/edit_batch');
	            $this->load->view('/templates/footer');

	            $this->output->set_header('refresh:3; url='.base_url('index.php/classes/create_batch'));
            } else{
            	//Passing it to the View
	            $this->load->view('templates/header', $data);
	            $this->load->view('navbar_main', $data);
	            $this->load->view('navbar_sub', $data);
	            //View Create Class
	            $this->load->view('classes/edit_batch');
	            $this->load->view('/templates/footer');
            }
        }

    	
    } 

    //Call backs
    function check_class_name() {
        $grade = $this->input->post('cmbgrade');
        $name = strtoupper($this->input->post('classname'));

        if (!$this->Class_Model->check_class_exists_name($grade, $name)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_class_name', "Class Name for that certain Grade already exists");
            return FALSE;
        }
    }  

    function check_batch_name() {
        $ay = $this->input->post('cmbay');
        $name = strtoupper($this->input->post('batchname'));
        $grade = $this->input->post('cmbgrade');

        if (!$this->Class_Model->check_batch_exists_name($ay, $name, $grade)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_batch_name', "Batch Name for that certain Academic Year already exists");
            return FALSE;
        }
    }

    function check_batch_selected() {
        $ay = $this->input->post('cmbbatch');

        if (!$ay == '0') {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_batch_selected', "You need to select a Batch");
            return FALSE;
        }
    }

    	//Check if Teacher is selected
     function check_teacher_selected() {
        $ay = $this->input->post('cmbteacher');

        if (!$ay == '0') {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_teacher_selected', "You need to select a Teacher");
            return FALSE;
        }
    }

    function check_vaild_teacher() {
        $teacher = $this->input->post('cmbteacher');

        if ($this->Class_Model->check_class_teacher($teacher) == 1) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_vaild_teacher', "Selected Teacher is already in-charge of another class");
            return FALSE;
        }
    }
}

/* Coded by Udara Karunarathna @P0dda */
/* Location: www.udara.info */