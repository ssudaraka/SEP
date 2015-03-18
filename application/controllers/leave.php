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
        $userid = $this->session->userdata['id'];

        //Load form combo
        $data['leave_types'] = $this->leave_model->get_leave_types();

        //Getting Values from Leaves DB
        $data['casual_leaves'] = $this->leave_model->get_max_leave_count("Casual");
        $data['medical_leaves'] = $this->leave_model->get_max_leave_count("Medical");
        $data['duty_leaves'] = $this->leave_model->get_max_leave_count("Duty");
        $data['other_leaves'] = $this->leave_model->get_max_leave_count("Other");
        $data['maternity_leaves'] = $this->leave_model->get_max_leave_count("Maternity");

        //Getting List of Applied Leaves
        $data['applied_leaves'] = $this->leave_model->get_applied_leaves_list($userid);

        //Get Separate leaves count according to the type
        $data['applied_casual_leaves'] = $this->leave_model->get_no_leaves('1', $userid);
        $data['applied_medical_leaves'] = $this->leave_model->get_no_leaves('2', $userid);
        $data['applied_duty_leaves'] = $this->leave_model->get_no_leaves('3', $userid);
        $data['applied_other_leaves'] = $this->leave_model->get_no_leaves('4', $userid);
        $data['applied_maternity_leaves'] = $this->leave_model->get_no_leaves('5', $userid);

        //total leaves
        $data['total_leaves'] = $data['applied_casual_leaves'] + $data['applied_medical_leaves'] + $data['applied_duty_leaves'] + $data['applied_other_leaves'] + $data['applied_maternity_leaves'];

        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        if($data['user_type'] == 'A'){
            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/leave/admin_leave', $data);
            $this->load->view('/templates/footer');
        } elseif($data['user_type'] == 'T'){
            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/leave/leave', $data);
            $this->load->view('/templates/footer');
        } else {
            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/leave/leave', $data);
            $this->load->view('/templates/footer');
        }

    }

    //Main function to apply leaves
    public function apply_leave() {
        //Basic data to be loaded

        //Load form combo
        $data['leave_types'] = $this->leave_model->get_leave_types();

        $userid = $this->session->userdata['id'];

        //Getting Values from Leaves DB
        $data['casual_leaves'] = $this->leave_model->get_max_leave_count("Casual");
        $data['medical_leaves'] = $this->leave_model->get_max_leave_count("Medical");
        $data['duty_leaves'] = $this->leave_model->get_max_leave_count("Duty");
        $data['other_leaves'] = $this->leave_model->get_max_leave_count("Other");
        $data['maternity_leaves'] = $this->leave_model->get_max_leave_count("Maternity");

        //Getting List of Applied Leaves
        $data['applied_leaves'] = $this->leave_model->get_applied_leaves_list($this->session->userdata['id']);

        //Get Separate leaves count according to the type
        $data['applied_casual_leaves'] = $this->leave_model->get_no_leaves('1', $userid);
        $data['applied_medical_leaves'] = $this->leave_model->get_no_leaves('2', $userid);
        $data['applied_duty_leaves'] = $this->leave_model->get_no_leaves('3', $userid);
        $data['applied_other_leaves'] = $this->leave_model->get_no_leaves('4', $userid);
        $data['applied_maternity_leaves'] = $this->leave_model->get_no_leaves('5', $userid);

        //total leaves
        $data['total_leaves'] = $data['applied_casual_leaves'] + $data['applied_medical_leaves'] + $data['applied_duty_leaves'] + $data['applied_other_leaves'] + $data['applied_maternity_leaves'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_reason', 'Reason', "required|xss_clean");
        $this->form_validation->set_rules('txt_startdate', 'Start Date', "required|xss_clean");
        $this->form_validation->set_rules('txt_enddate', 'End Date', "required|xss_clean");

        $data['page_title'] = "Leave Management";

        if($this->form_validation->run() == FALSE){

            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/leave/leave', $data);
            $this->load->view('/templates/footer');

        } else{
            $leavetype = $this->input->post('cmb_leavetype');
            $startdate = $this->input->post('txt_startdate');
            $enddate = $this->input->post('txt_enddate');
            $reason = $this->input->post('txt_reason');
            $applieddate = date("Y-m-d");
            $teacherid = $this->leave_model-> get_teacher_id($userid);

            $noofdates=date_diff(date_create($startdate),date_create($enddate));
            $sdate = $noofdates->format("%a");

            //validation for dates
            if($sdate == '0'){
                $data['error_message'] = "Start date cannot be the End date of the leaves". $noofdates->format("%R%a days");
            } elseif($applieddate == $startdate) {
                $data['error_message'] = "Start Date cannot be the current date";
            } elseif($enddate < $startdate){
                $data['error_message'] = "End Date cannot be a previous date";
            }
            //bit buggy here
            elseif($leavetype =='1' && $data['casual_leaves'] == $data['applied_casual_leaves']){
                $data['error_message'] = "No Casual leaves left to apply";
            } elseif($leavetype =='2' && $data['medical_leaves'] == $data['applied_medical_leaves']){
                $data['error_message'] = "No Medical leaves left to apply";
            }
            //Need to apply some more logic here when it comes to maternity leaves. But not right now
            elseif($leavetype =='5' && $data['maternity_leaves'] >= $data['applied_maternity_leaves']){
                $data['error_message'] = "No Maternity leaves left to apply";
            }
            else {

                if($this->leave_model->apply_for_leave($userid, $teacherid, $leavetype, $applieddate, $startdate, $enddate, $reason, $sdate) == TRUE)
                {
                    $data['succ_message'] = "Leave Applied Successfully for ". $noofdates->format("%a days");

                    //loading values again
                    //Getting Values from Leaves DB
                    $data['casual_leaves'] = $this->leave_model->get_max_leave_count("Casual");
                    $data['medical_leaves'] = $this->leave_model->get_max_leave_count("Medical");
                    $data['duty_leaves'] = $this->leave_model->get_max_leave_count("Duty");
                    $data['other_leaves'] = $this->leave_model->get_max_leave_count("Other");
                    $data['maternity_leaves'] = $this->leave_model->get_max_leave_count("Maternity");

                    //Getting List of Applied Leaves
                    $data['applied_leaves'] = $this->leave_model->get_applied_leaves_list($this->session->userdata['id']);

                    //Get Separate leaves count according to the type
                    $data['applied_casual_leaves'] = $this->leave_model->get_no_leaves('1', $userid);
                    $data['applied_medical_leaves'] = $this->leave_model->get_no_leaves('2', $userid);
                    $data['applied_duty_leaves'] = $this->leave_model->get_no_leaves('3', $userid);
                    $data['applied_other_leaves'] = $this->leave_model->get_no_leaves('4', $userid);
                    $data['applied_maternity_leaves'] = $this->leave_model->get_no_leaves('5', $userid);

                    //total leaves
                    $data['total_leaves'] = $data['applied_casual_leaves'] + $data['applied_medical_leaves'] + $data['applied_duty_leaves'] + $data['applied_other_leaves'] + $data['applied_maternity_leaves'];

                } else{
                    $data['error_message'] = "Failed to save data to the Database";
                }
            }



            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('/leave/leave', $data);
            $this->load->view('/templates/footer');
        }

    }

}

/* Coded by Udara Karunarathna @P0dda */
/* Location: www.udara.info */