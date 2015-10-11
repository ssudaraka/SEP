<?php

class Event extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->model('Teacher_Model');
        $this->load->model('News_Model');
        $this->load->helper('date');
    }

    /**
     * First run this index method. The session keeps track of whether the user logged in or not. If not, user has to login to the system.
     * It riderects user to another method according to the user type.
     */
    function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $user_t = $this->session->userdata['user_type']; //get the user type from session
        $data['details'] = $this->event_model->get_pending_event_details(); //get pending events from database
        $data['result'] = $this->event_model->get_event_type_details();
        $data['navbar'] = "Sports";
        if ($user_t == 'A') {
            $this->check_event_details(); //if user type is 'A', it will call this function
        } elseif ($user_t == 'P') {
            $this->create_event();
        } else {
            $this->create_event();
        }
    }

    /**
     * This method is used to create a new event
     */
    function create_event() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $log_id = $this->session->userdata['id'];
        $data['nic'] = $this->event_model->get_logged_user_nic($log_id);
        date_default_timezone_set('Asia/Kolkata');
        $data['navbar'] = "event";
        $data['result'] = $this->event_model->get_event_type_details();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('event_name', 'event name', 'required'); //Validate fields
        $this->form_validation->set_rules('event_type', 'event type', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('start_date', 'start date', 'required|callback_check_event_start_date');
        $this->form_validation->set_rules('start_time', 'start time', 'required');
        $this->form_validation->set_rules('end_date', 'end date', 'required|callback_check_event_end_date');
        $this->form_validation->set_rules('end_time', 'end time', 'required');
        $this->form_validation->set_rules('in_charge', 'in charge', 'required|callback_check_incharge_id');
        $this->form_validation->set_rules('budget', 'budget', 'required|integer');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $data['details'] = $this->event_model->get_pending_event_details();
            $data['page_title'] = "New Event";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('event/create_sport_event', $data);
            $this->load->view('/templates/footer');
        } else {

            $data['succ_message'] = "Successfully created the event";
            $event_name = $this->input->post('event_name');
            $event_type = $this->input->post('event_type');
            $description = $this->input->post('description');
            $start_date = $this->input->post('start_date');
            $start_time = $this->input->post('start_time');
            $end_date = $this->input->post('end_date');
            $end_time = $this->input->post('end_time');
            $in_charge = $this->input->post('in_charge');
            $budget = $this->input->post('budget');

            if ($this->event_model->insert_sport_event($event_name, $event_type, $description, $start_date, $start_time, $end_date, $end_time, $in_charge, $budget)) { // the information has therefore been successfully saved in the db
                //For news field
                $tech_id = $this->session->userdata('id');
                $tech_details = $this->Teacher_Model->user_details($tech_id);
                $this->News_Model->insert_action_details($tech_id, "Create new event", $tech_details->photo_file_name, $tech_details->full_name);
                //////
                $data['details'] = $this->event_model->get_pending_event_details();
                $data['page_title'] = "Create Sports Event";
                $data['navbar'] = "Sports";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('event/create_sport_event', $data);
                $this->load->view('/templates/footer');
            } else {
                echo 'An error occurred saving your information. Please try again later';
            }
        }
    }

    /**
     * This method is used to update the data which is approved by the principle.
     */
    function publish_approved_event($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "event";
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('event_details', 'event details', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('guest', 'guest', '');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $data['details'] = $this->event_model->get_approved_event_details($id); //Get approved event details
            $data['page_title'] = "Publish Event";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('event/create_approved_sport_event', $data);
            $this->load->view('/templates/footer');
        } else {
            $event_details = $this->input->post('event_details');
            $location = $this->input->post('location');
            $guest = $this->input->post('guest');

            if ($this->event_model->update_event($event_details, $location, $guest, $id)) {
                $this->event_model->set_success_for_approved($id);
                //$data['details'] = $this->event_model->get_pending_event_details();
                //For news field
                $tech_id = $this->session->userdata('id');
                $tech_details = $this->Teacher_Model->user_details($tech_id);
                $this->News_Model->insert_action_details($tech_id, "Publish approved event", $tech_details->photo_file_name, $tech_details->full_name);
                //////
                $data['details'] = $this->event_model->get_all_events();
                $data['succ_message'] = "Successfully Updated!";
                $data['page_title'] = "Create Sports Event";
                $data['navbar'] = "Sports";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('event/up_comming_events', $data);
                $this->load->view('/templates/footer');
            } else {
                echo 'An error occurred saving your information. Please try again later';
            }
        }
    }

    /**
     * This method is used to view the approved event details
     */
    function edit_approved_event($event_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        date_default_timezone_set('Asia/Kolkata');
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['details'] = $this->event_model->get_approved_event_details($event_id); //Get approved event details from the database
        $data['page_title'] = "Publish Event";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/create_approved_sport_event', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to create new event type.
     */
    function create_event_type() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "event";
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('event_type', 'event type', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['details'] = $this->event_model->get_event_type_details();
            $data['page_title'] = "Event Type";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('event/add_new_event_type', $data);
            $this->load->view('/templates/footer');
        } else {

            $event_type = $this->input->post('event_type');
            $description = $this->input->post('description');

            if ($this->event_model->insert_new_event_type($event_type, $description)) {
                //For news field
                $tech_id = $this->session->userdata('id');
                $tech_details = $this->Teacher_Model->user_details($tech_id);
                $this->News_Model->insert_action_details($tech_id, "Create new event type", $tech_details->photo_file_name, $tech_details->full_name);
                //////
                $data['details'] = $this->event_model->get_event_type_details();
                $data['succ_message'] = "Successfully created the event type";
                $data['page_title'] = "Create Event Type";
                $data['navbar'] = "Sports";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('event/add_new_event_type', $data);
                $this->load->view('/templates/footer');
            } else {
                echo 'An error occurred saving your information. Please try again later';
            }
        }
    }

    /**
     * This method is used to view a particular event type details.
     */
    function view_event_type_details($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['details'] = $this->event_model->get_event_type_to_update($id);
        $data['page_title'] = "Event Type";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/update_event_type', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This methos is used to update the event type
     */
    function update_event_type($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['navbar'] = "event";
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('event_type', 'event type', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['details'] = $this->event_model->get_event_type_to_update($id);
            $data['page_title'] = "Event Type";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('event/update_event_type', $data);
            $this->load->view('/templates/footer');
        } else {

            $event_type = $this->input->post('event_type');
            $description = $this->input->post('description');

            if ($this->event_model->update_event_type($id, $event_type, $description)) {
                //For news field
                $tech_id = $this->session->userdata('id');
                $tech_details = $this->Teacher_Model->user_details($tech_id);
                $this->News_Model->insert_action_details($tech_id, "Update event type", $tech_details->photo_file_name, $tech_details->full_name);
                //////
                $data['details'] = $this->event_model->get_event_type_details();
                $data['succ_message'] = "Successfully created the event type";
                $data['page_title'] = "Create Event Type";
                $data['navbar'] = "Sports";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('event/add_new_event_type', $data);
                $this->load->view('/templates/footer');
            } else {
                echo 'An error occurred saving your information. Please try again later';
            }
        }
    }

    /**
     * This method is used to delete a particular event type
     */
    function delete_event_type($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        //For news field
        $tech_id = $this->session->userdata('id');
        $tech_details = $this->Teacher_Model->user_details($tech_id);
        $this->News_Model->insert_action_details($tech_id, "Delete event type", $tech_details->photo_file_name, $tech_details->full_name);
        //////
        $data['succ_message'] = "Successfully deleted";
        $data['user_type'] = $this->session->userdata['user_type'];
        $this->event_model->delete_event_type($id);
        $data['details'] = $this->event_model->get_event_type_details();
        $data['page_title'] = "Create Event Type";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/add_new_event_type', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to view all the events that are created by admin panel
     */
    function view_all_events() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['type'] = 1;
        $data['details'] = $this->event_model->get_all_events();
        $data['page_title'] = "All events";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/up_comming_events', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to view only the up comming events
     */
    function view_upcoming_events() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $today = date('Y-m-d');
        $data['type'] = 2;
        $data['details'] = $this->event_model->get_upcoming_events($today);
        $data['page_title'] = "Up coming events";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/up_comming_events', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to view the monthly events.
     */
    function view_monthly_events() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $month = date('m-Y');
        $data['type'] = 3;
        $data['details'] = $this->event_model->get_monthly_events($month);
        $data['page_title'] = "Monthly events";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/up_comming_events', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to view all the completed events.
     */
    function view_completed_events() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $today = date('Y-m-d');
        $data['type'] = 4;
        $data['details'] = $this->event_model->get_completed_events($today);
        $data['page_title'] = "Complted events";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/up_comming_events', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to view details of the particular event.
     */
    function view_upcoming_event_details($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['details'] = $this->event_model->get_upcoming_event_single_details($id);
        $data['page_title'] = "Up comming Details";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/view_events', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to cancel a event published by admin panel.
     */
    function cancel_event($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        //For news field
        $tech_id = $this->session->userdata('id');
        $tech_details = $this->Teacher_Model->user_details($tech_id);
        $this->News_Model->insert_action_details($tech_id, "Cancelled the event", $tech_details->photo_file_name, $tech_details->full_name);
        //////
        $data['user_type'] = $this->session->userdata['user_type'];
        $this->event_model->cancel_event($id);
        $data['details'] = $this->event_model->get_all_events();
        $data['page_title'] = "Up comming events";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/up_comming_events', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to check the events to be approved or rejected and view cancelled events.
     */
    function check_event_details() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['details'] = $this->event_model->get_pending_events_to_approve();
        $data['cancel'] = $this->event_model->get_canceled_events();
        $data['page_title'] = "Check Events";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/check_event_details', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to view the details of the particular pennding event.
     */
    function load_selected_pending_event($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['details'] = $this->event_model->load_pending_events($id);
        $data['page_title'] = "Pending event";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/select_event_action', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to approve the event.
     */
    function approve_event($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        //For news field
        $tech_id = $this->session->userdata('id');
        $tech_details = $this->Teacher_Model->user_details($tech_id);
        $this->News_Model->insert_action_details($tech_id, "Approved the event", $tech_details->photo_file_name, $tech_details->full_name);
        //////
        $data['succ_message'] = "Successfully completed";
        $data['user_type'] = $this->session->userdata['user_type'];
        $this->event_model->approve_event($id);
        $data['details'] = $this->event_model->get_pending_events_to_approve();
        $data['cancel'] = $this->event_model->get_canceled_events();
        $data['page_title'] = "Pending event";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/check_event_details', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is used to reject the event.
     */
    function reject_event($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        //For news field
        $tech_id = $this->session->userdata('id');
        $tech_details = $this->Teacher_Model->user_details($tech_id);
        $this->News_Model->insert_action_details($tech_id, "Reject the event", $tech_details->photo_file_name, $tech_details->full_name);
        //////
        $data['succ_message'] = "Successfully completed";
        $data['user_type'] = $this->session->userdata['user_type'];
        $this->event_model->reject_event($id);
        $data['details'] = $this->event_model->get_pending_events_to_approve();
        $data['cancel'] = $this->event_model->get_canceled_events();
        $data['page_title'] = "Pending event";
        $data['navbar'] = "Sports";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('event/check_event_details', $data);
        $this->load->view('/templates/footer');
    }

    /**
     * This method is a validation method which validate event start date
     */
    function check_event_start_date($field) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $datestring = "%Y-%m-%d";
        $time = time();
        $today = mdate($datestring, $time);
        if ($today > $field) {
            $this->form_validation->set_message('check_event_start_date', 'Please Enter Valid Date!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * This method is a validation method which validate event start date
     */
    function check_event_end_date($field) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $start_date = $this->input->post('start_date');
        if ($start_date > $field) {
            $this->form_validation->set_message('check_event_end_date', 'Please Enter Valid Date!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Check whether the given in charge id is a valid id or not.
     */
    function check_incharge_id($field) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        $val = $this->event_model->validate_teacher_id($field);
        if ($val == NULL) {
            $this->form_validation->set_message('check_incharge_id', 'Please Enter Valid ID!');
            return FALSE;
        } else {
            $this->form_validation->set_message('check_incharge_id', 'Your ID!' . " " . $field);
            return TRUE;
        }
    }

}
