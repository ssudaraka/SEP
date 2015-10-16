<?php

class News extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Teacher_Model');
        $this->load->model('News_Model');
        $this->load->helper('date');
        $this->load->model('user');
    }

    /*
     *  This is the index function which executes first in this controller
     */

    function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata['user_type'] == 'A') {
            $data['users'] = $this->Teacher_Model->SearchAllTeachers();
            $data['page_title'] = "History";
            $data['navbar'] = 'history';
            $data['result'] = $this->News_Model->get_news_details();
            //Getting user type
            $data['user_type'] = $this->session->userdata['user_type'];
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('news/news_form', $data);
            $this->load->view('/templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    /*
     * In this function, admin can get the news form
     */

    function get_news() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata['user_type'] == 'A') {
            $data['page_title'] = "News History";
            $data['navbar'] = 'news';
            $data['details'] = $this->News_Model->get_all_news_details();
            //Getting user type
            $data['user_type'] = $this->session->userdata['user_type'];
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('news/publish_news_form', $data);
            $this->load->view('/templates/footer');
        }
    }

    /*
     * Display all the activities that user has perfomed in this system
     */

    function list_activities() {
        $tech_id = $this->input->post('tid');
        $this->News_Model->get_teacher_activities($tech_id);
    }

    /*
     * Admin can clear the history(activities)
     */

    function clear_history() {
        $clear_data_type = $this->input->post('deletetype');
        $this->News_Model->clear($clear_data_type);
    }

    /*
     * In this function only admin can create a news
     */

    function create_news() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata['user_type'] == 'A') {
            //Getting user type
            $data['user_type'] = $this->session->userdata['user_type'];
            date_default_timezone_set('Asia/Kolkata');             //get the current timezone
            $this->load->library('form_validation');
            $this->form_validation->set_rules('news', 'News Name', 'required');
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                $data['details'] = $this->News_Model->get_all_news_details();
                $data['page_title'] = "Publish News";
                $data['navbar'] = 'news';
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('news/publish_news_form', $data);
                $this->load->view('/templates/footer');
            } else {

                $data['succ_message'] = "Successfully created News";
                $news_name = $this->input->post('news');
                $description = $this->input->post('description');

                if ($this->News_Model->create_news($news_name, $description)) {
                    //For news field
                    $tech_id = $this->session->userdata('id');
                    $tech_details = $this->Teacher_Model->user_details($tech_id);
                    $this->News_Model->insert_action_details($tech_id, "Publish a news", $tech_details->profile_img, $tech_details->first_name);
                    //////
                    $data['details'] = $this->News_Model->get_all_news_details();
                    $data['page_title'] = "Publish News";
                    $data['navbar'] = "news";
                    $this->load->view('templates/header', $data);
                    $this->load->view('navbar_main', $data);
                    $this->load->view('navbar_sub', $data);
                    $this->load->view('news/publish_news_form', $data);
                    $this->load->view('/templates/footer');
                } else {
                    echo 'An error occurred saving your information. Please try again later';
                }
            }
        }
    }

    /*
     * In this function, Admin can update news that has been created previously
     */

    public function update_news() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata['user_type'] == 'A') {
            //Getting user type
            $data['user_type'] = $this->session->userdata['user_type'];
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'News Name', 'required');
            $this->form_validation->set_rules('desc', 'description', 'required');
            $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                echo'<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . validation_errors() . '</div>';
                exit;
            } else {
                $news_id = $this->input->post('id');
                $news_name = $this->input->post('name');
                $description = $this->input->post('desc');

                //For news field
                $tech_id = $this->session->userdata('id');
                $tech_details = $this->Teacher_Model->user_details($tech_id);
                $this->News_Model->insert_action_details($tech_id, "Update news", $tech_details->profile_img, $tech_details->first_name);
                //////

                $this->News_Model->update_news($news_id, $news_name, $description);
            }
        }
    }

    /*
     * In this function, news details will be displayed as a pop up window
     */

    public function view_news() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];
        $id = $this->uri->segment(3);
        $data['details'] = $this->News_Model->get_particular_news($id);
        $this->load->view('news/edit', $data);
    }

    /*
     * In this function admin can delete particular news
     */

    public function delete_news($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['succ_message'] = "Successfully deleted";
        $this->News_Model->delete_news($id);
        redirect('news/get_news', 'refresh');
    }

}
