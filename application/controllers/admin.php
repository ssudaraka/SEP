<?php

/*
 * Main controller for Admin related functionalties.
 */

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user');
    }

    /**
     * Main function for Admin section for now. Maybe changed in future. This will just load the current user's profile.
     */
    function index() {

        $data['page_title'] = "System Administration";
        $data['navbar'] = "admin";
        
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * This will just load the view used to change account settings.
     * as a kickstart, I have added password change here.
     */

    function system_settings() {
        if ($this->session->userdata('user_type') !== "A") {
            redirect('login');
        }

        $data['page_title'] = "Account Settings";
        $data['navbar'] = 'admin';

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('admin/system_settings', $data);
        $this->load->view('templates/footer');
    }

    function create() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', "trim|required|xss_clean|min_length[5]|alpha_dash");
        $this->form_validation->set_rules('email', 'email', "trim|required|xss_clean|valid_email");
        $this->form_validation->set_rules('first_name', 'first name', "trim|required|xss_clean|alpha");
        $this->form_validation->set_rules('last_name', 'last name', "trim|required|xss_clean|alpha");

        if ($this->user->force_strong_password()) {
            $this->form_validation->set_rules('new_password', 'New Password', "required|min_length[5]|xss_clean|matches[conf_password]|callback_is_strong_password");
        } else {
            $this->form_validation->set_rules('new_password', 'New Password', "required|min_length[5]|xss_clean|matches[conf_password]");
        }

        $this->form_validation->set_rules('conf_password', 'confirm password', "required|xss_clean|matches[password]");

        if ($this->form_validation->run() == FALSE) {
            $data['page_title'] = "Create Admin Account";
            $data['navbar'] = 'admin';
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('admin/create_admin', $data);
            $this->load->view('templates/footer');
        } else {
            $input_data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'password' => md5($this->input->post('password'))
            );
            if ($this->user->create($input_data, "A")) {
                $data['page_title'] = "Create Admin Account";
                $data['navbar'] = 'admin';
                $data['succ_message'] = "New Admin Created Successfully";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('admin/create_admin', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    function manage_admins() {
        $data['page_title'] = "Manage Administrators";
        $data['navbar'] = 'admin';




        /**
         * setting up paginations
         */
        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = base_url() . "index.php/admin/manage_admins";
        $config['total_rows'] = $this->user->get_user_total();
        $config['per_page'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 5;

        $config['cur_tag_open'] = '<a href="#">';
        $config['cur_tag_close'] = '</a>';

        $config['offset'] = ($this->uri->segment(3) ? $this->uri->segment(3) : null);

        $data['query'] = $this->user->get_user_list('', 'A', $config['per_page'], $config['offset']);

        $data['result'] = $data['query']->result();
        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        $data['result'] = $data['query']->result();
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('admin/manage_admins', $data);
        $this->load->view('templates/footer');
    }

    function search() {

        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = base_url() . "index.php/admin/manage_admins";
        $config['total_rows'] = $this->user->get_user_total();
        $config['per_page'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 5;

        $config['offset'] = ($this->uri->segment(3) ? $this->uri->segment(3) : null);

        $keyword = $this->input->post('keyword');
        $data['page_title'] = "Manage Administrators";
        $data['navbar'] = 'admin';

        $data['query'] = $this->user->get_user_list($keyword, 'A', $config['per_page'], $config['offset']);
        $config['cur_tag_open'] = "&nbsp;";

        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        $data['result'] = $data['query']->result();

        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('admin/manage_admins', $data);
        $this->load->view('templates/footer');
    }

    function delete($user_id) {

        if ($this->session->userdata('user_type') !== "A") {
            show_404();
        }

        if ($this->user->delete($user_id)) {
            $data['delete_msg'] = "User ID " . $user_id . " has been removed from the database. This cannot be reverted";
            $data['page_title'] = "Manage Administrators";
            $data['navbar'] = 'admin';




            /**
             * setting up paginations
             */
            $this->load->library('pagination');
            $config = array();
            $config['base_url'] = base_url() . "index.php/admin/manage_admins";
            $config['total_rows'] = $this->user->get_user_total();
            $config['per_page'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 5;

            $config['cur_tag_open'] = '<a href="#">';
            $config['cur_tag_close'] = '</a>';

            $config['offset'] = ($this->uri->segment(3) ? $this->uri->segment(3) : null);

            $data['query'] = $this->user->get_user_list('', 'A', $config['per_page'], $config['offset']);

            $data['result'] = $data['query']->result();
            $this->pagination->initialize($config);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;', $str_links);

            $data['result'] = $data['query']->result();
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('admin/manage_admins', $data);
            $this->load->view('templates/footer');
        }
    }

}
