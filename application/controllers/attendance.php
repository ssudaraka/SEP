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
        $data['date'] = date('Y-m-d');

        $this->form_validation->set_rules("signature_no", "Signature Number", "required|min_length[5]|integer|callback_add_record");

        if ($this->form_validation->run() == FALSE) {
            /*
             * If the form validation goes wrong, no worries. We will display watever the values 
             * recorded in the database currently. We are using a callback function to insert the data
             * into the database and it will do all the hard work.
             */
            $data['result'] = $this->attendance_model->get_all_temp_records();
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

            $data['result'] = $this->attendance_model->get_all_temp_records();
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
     * Parameters: $signature_no
     */
    function delete_record($signature_no) {
        $data['page_title'] = "Attendance";
        $data['navbar'] = "attendance";

        if ($this->attendance_model->delete_record($signature_no)) {
            $data['result'] = $this->attendance_model->get_all_records();
            $data['del_msg'] = "Record removed for {$signature_no}";
            $data['date'] = date('Y-m-d');
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('attendance/att_record_form', $data);
            $this->load->view('/templates/footer');
        }
    }

    function generate_report() {
        $data['date'] = date('Y-m-d');
        $data['navbar'] = "attendance";
        $data['page_title'] = 'Attendance Report For: ' . $data['date'];


        $data['result'] = $this->attendance_model->get_all_temp_records();
        $data['absent_list'] = $this->attendance_model->get_temp_absent_records();

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('attendance/report', $data);
        $this->load->view('/templates/footer');
    }

    function report_pdf() {
        $this->load->helper(array('dompdf', 'file'));
        $date_string = "%Y-%m-%d";
        $time = time();
        $data['date'] = mdate($date_string, $time);

        /**
         * REMINDER!
         * School name is hardcoded here. Change it to get the value from database so it can be extended
         * to different schools.
         */
        $data['school_name'] = "D. S. Senanayake College";


        $data['result'] = $this->attendance_model->get_all_records();
        $filename = "attendance_report_" . $data['date'];
        // page info here, db calls, etc.     
        $html = $this->load->view('attendance/report_pdf', $data, true);
        pdf_create($html, $filename);
        //or
        //$data = pdf_create($html, '', false);
        //write_file('name', $data);
        $this->attendance_model->save_attendance();
        $this->attendance_model->delete_temp();
    }

    function confirm() {

        $data['date'] = date('Y-m-d');
        $data['navbar'] = "attendance";
        $data['page_title'] = 'Attendance Report For: ' . $data['date'];


        $this->attendance_model->save_attendance();
        $absent_list = $this->attendance_model->get_temp_absent_records();
        $this->attendance_model->save_absent($absent_list);
        $this->attendance_model->delete_temp();

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('attendance/confirmation', $data);
        $this->load->view('/templates/footer');
    }

    function present_pdf($date = "") {
        $data['report_type'] = "AT";
        $data['date'] = "";

        if ($date == ""):
            $data['date'] = date('Y-m-d');
        else :
            $data['date'] = $date;
        endif;
        
        $data['page_title'] = "Attendance Report For: {$data['date']}";

        $data['result'] = $this->attendance_model->search_attendance($data['date']);
        $this->load->view('attendance/report_pdf', $data);
    }

    function absent_pdf($date = "") {
        $data['report_type'] = "AB";
        $data['date'] = "";

        if ($date == ""):
            $data['date'] = date('Y-m-d');
        else :
            $data['date'] = $date;
        endif;
        
        $data['page_title'] = "Absent Report For: {$data['date']}";
        $data['result'] = $this->attendance_model->get_absent_list($data['date']);
        $this->load->view('attendance/report_pdf', $data);
    }

    function search_report_pdf($date) {

        $this->load->helper(array('dompdf', 'file'));

        /**
         * REMINDER!
         * School name is hardcoded here. Change it to get the value from database so it can be extended
         * to different schools.
         */
        $data['date'] = $date;
        $data['school_name'] = "D. S. Senanayake College";
        $data['result'] = $this->attendance_model->search_attendance($date);
        $filename = "attendance_report_" . $date;
        $html = $this->load->view('attendance/report_pdf', $data, true);
        pdf_create($html, $filename);
    }

    function reports() {
        $data['page_title'] = "Attendance Reports";
        $data['navbar'] = "attendance";

        $this->form_validation->set_rules("date", "Date", "required|callback_have_reports_for");

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('attendance/report_search', $data);
            $this->load->view('/templates/footer');
        } else {
            $data['date'] = $this->input->post('date');
            $data['result'] = $this->attendance_model->search_attendance($data['date']);
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('attendance/search_results', $data);
            $this->load->view('/templates/footer');
        }
    }

    /**
     * This function is used to check whether there are teacher attendence reports for a given
     * date. If not available, we can display that there are no reports.
     * @return boolean
     */
    function have_reports_for() {
        $date = $this->input->post('date');
        if (!$this->attendance_model->search_attendance($date)) {
            $this->form_validation->set_message('have_reports_for', "Attendance for date <strong>{$date}</strong> is not yet recorded.");
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
