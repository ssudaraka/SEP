<?php

/*
 * Main controller for Admin related functionalties.
 */

class Subject extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Subject_model');
    }

    /**
     * Main function for Admin section for now. Maybe changed in future. This will just load the current user's profile.
     */
    function index() {

        if ($this->session->userdata('user_type') !== "A") {
            redirect('login');
        }

        /*
         * in the index funtion will load the create_subject page
         */


        /*
         * validations (for subject name and subject code cannot enter null values)
         */
        $this->load->library('form_validation');
        $this->form_validation->set_rules('subjectname', 'subjectname', "trim|required|xss_clean|min_length[5]|alpha_dash");
        $this->form_validation->set_rules('subjectcode', 'subjectcode', "trim|required|xss_clean");



        if ($this->form_validation->run() == FALSE) {
            $data['page_title'] = "Create Subject";
            $data['navbar'] = 'subject';
            $data["query"] = $this->db->query("SELECT * FROM teachers");
            $data['result'] = $data['query']->result();
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('subject/create_subject', $data);
            $this->load->view('templates/footer');
        } else {
            $subject_data = array(
                'subjectname' => $this->input->post('subjectname'),
                'subjectcode' => $this->input->post('subjectcode'),
                'sectionid' => $this->input->post('sectionid'),
                'subjectinchargeid' => $this->input->post('subjectinchargeid')
            );
            if ($this->Subject_model->create($subject_data)) {
                //For news field
                $tech_id = $this->session->userdata('id');
                $tech_details = $this->Teacher_Model->user_details($tech_id);
                $this->News_Model->insert_action_details($tech_id, "Insert new subject", $tech_details->photo_file_name, $tech_details->full_name);
                //////
                $data['page_title'] = "Create Subject ";
                $data['navbar'] = 'subject';
                $data['succ_message'] = "New subject Created Successfully";
                $data["query"] = $this->db->query("SELECT * FROM teachers");
                $data['result'] = $data['query']->result();
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('subject/create_subject', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    /*
     * getting a list of subjects so can delete or edit them
     */

    function manage_subjects() {
        $data['page_title'] = "Manage Subjects";
        $data['navbar'] = 'subject';




        /**
         * setting up paginations
         */
        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = base_url() . "index.php/subject/manage_subjects";
        $config['total_rows'] = $this->Subject_model->get_subject_total();
        $config['per_page'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 5;

        $config['cur_tag_open'] = '<a href="#">';
        $config['cur_tag_close'] = '</a>';

        $config['offset'] = ($this->uri->segment(3) ? $this->uri->segment(3) : null);

        $data['query'] = $this->Subject_model->get_subjects($config['per_page'], $config['offset']);

        $data['result'] = $data['query']->result();
        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        $data['result'] = $data['query']->result();
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('subject/manage_subjects', $data);
        $this->load->view('templates/footer');
    }

    function search() {

        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = base_url() . "index.php/subject/manage_subjects";
        $config['total_rows'] = $this->Subject_model->get_subject_total();
        $config['per_page'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 5;

        $config['offset'] = ($this->uri->segment(3) ? $this->uri->segment(3) : null);

        $keyword = $this->input->post('keyword');
        $data['page_title'] = "Manage Administrators";
        $data['navbar'] = 'subject';

        $data['query'] = $this->Subject_model->search_subjects($keyword, $config['per_page'], $config['offset']);
        $config['cur_tag_open'] = "&nbsp;";

        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        $data['result'] = $data['query']->result();

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('subject/manage_subjects', $data);
        $this->load->view('templates/footer');
    }

    function delete($id) {

        if ($this->session->userdata('user_type') !== "A") {
            show_404();
        }

        if ($this->Subject_model->delete($id)) {
            $data['delete_msg'] = "Subject ID " . $id . " has been removed from the database. This cannot be reverted";
            $data['page_title'] = "Manage Subjects";
            $data['navbar'] = 'subject';




            /**
             * setting up paginations
             */
            $this->load->library('pagination');
            $config = array();
            $config['base_url'] = base_url() . "index.php/subject/manage_subjects";
            $config['total_rows'] = $this->Subject_model->get_subject_total();
            $config['per_page'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 5;

            $config['cur_tag_open'] = '<a href="#">';
            $config['cur_tag_close'] = '</a>';

            $config['offset'] = ($this->uri->segment(3) ? $this->uri->segment(3) : null);

            $data['query'] = $this->Subject_model->get_subjects($config['per_page'], $config['offset']);

            $data['result'] = $data['query']->result();
            $this->pagination->initialize($config);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;', $str_links);

            $data['result'] = $data['query']->result();
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('subject/manage_subjects', $data);
            $this->load->view('templates/footer');
        }
    }

}
