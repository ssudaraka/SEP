<?php

class Attendance extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('attendance_model');
        $this->load->library('form_validation');
        $this->load->helper('date');
    }

    /*
     * This loads the main interface for recording attendaces of teachers. 
     */

    function index() {
        $data['page_title'] = "Attendance";
        $data['navbar'] = "attendance";


        $this->form_validation->set_rules("signature_no", "Signature Number", "required|min_length[5]|integer|callback_add_record");

        if ($this->form_validation->run() == FALSE) {
            /*
             * If the form validation goes wrong, no worries. We will display watever the values 
             * recorded in the database currently. We are using a callback function to insert the data
             * into the database and it will do all the hard work.
             */
            $data['result'] = $this->attendance_model->get_all_records();
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('attendance/att_record_form', $data);
            $this->load->view('/templates/footer');
        } else {
            /*
             * What if the form validation goes right? We made it simple by using the callback function.
             * If you are still unsure what the heck is happening reffer to the callback function defined below.
             */

            $data['result'] = $this->attendance_model->get_all_records();
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('attendance/att_record_form', $data);
            $this->load->view('/templates/footer');
        }
    }

    function add_record() {
        /*
         * First we check the signature number already in the attendance recording database. If it's already in the
         * database, why again? 
         */

        $signature_no = $this->input->post('signature_no');
        if ($this->attendance_model->is_already_recorded($signature_no)) {
            $this->form_validation->set_message('add_record', "Attendace for "
                    . "<strong>Signature No: {$signature_no}</strong> is already recorded ");

            return FALSE;
        }

        /*
         * Is the inserted signature number actually belongs to a teacher? 
         */

        if (!$this->attendance_model->is_valid_signature_no($signature_no)) {
            $this->form_validation->set_message('add_record', "There's no teacher with "
                    . "<strong>Signature No: {$signature_no}</strong>");

            return FALSE;
        }

        /*
         * Enough validations. Let's do the work!
         */
        if ($this->attendance_model->add_record($signature_no)) {
            return TRUE;
        }
    }

    /**
     * This function is created to delete a record already added to the temp table that contains attendace details.
     */
    function delete_record($signature_no) {
        $data['page_title'] = "Attendance";
        $data['navbar'] = "attendance";

        if ($this->attendance_model->delete_record($signature_no)) {
            $data['result'] = $this->attendance_model->get_all_records();
            $data['del_msg'] = "Record removed for {$signature_no}";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('attendance/att_record_form', $data);
            $this->load->view('/templates/footer');
        }
    }

    function generate_report() {
        $date_string = "%Y-%m-%d";
        $time = time();
        $data['date'] = mdate($date_string, $time);
        $data['navbar'] = "attendance";

        $data['page_title'] = 'Attendance Report For: ' . $data['date'];

        $data['result'] = $this->attendance_model->get_all_records();
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('attendance/report', $data);
        $this->load->view('/templates/footer');
    }

}
