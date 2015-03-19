<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user');
    }

    function index() {

        if ($this->session->userdata('user_type') !== "A") {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "admin";

        $result = $this->user->get_details($this->session->userdata('id'));
        foreach ($result as $row) {
            $data['first_name'] = $row->first_name;
            $data['last_name'] = $row->last_name;
        }

        $data['page_title'] = "Profile Settings";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub');
        $this->load->view('admin/profile_settings', $data);
        $this->load->view('templates/footer');
    }

    function account_settings() {

        $data['navbar'] = "admin";

        if ($this->session->userdata('user_type') !== "A") {
            redirect('login', 'refresh');
        }

        $result = $this->user->get_details($this->session->userdata('id'));
        foreach ($result as $row) {
            $data['first_name'] = $row->first_name;
            $data['last_name'] = $row->last_name;
        }

        $data['page_title'] = "Account Settings";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub');
        $this->load->view('admin/account_settings', $data);
        $this->load->view('templates/footer');
    }

    function change_password() {

        $data['navbar'] = "admin";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('old_password', 'Old Password', "required|xss_clean|callback_check_old_password");
        $this->form_validation->set_rules('new_password', 'New Password', "required|xss_clean|matches[conf_password]");
        $this->form_validation->set_rules('conf_password', 'Confirm Password', "required|xss_clean|matches[new_password]");

        if ($this->form_validation->run() == FALSE) {
            $data['page_title'] = "Account Settings";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub');
            $this->load->view('admin/account_settings', $data);
            $this->load->view('templates/footer');
        } else {

            $user_id = $this->session->userdata('id');
            $new_password = $this->input->post('new_password');
            if ($this->user->change_password($user_id, $new_password)) {
                $data['page_title'] = "Account Settings";
                $data['succ_message'] = "Password Changed Successfully";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub');
                $this->load->view('admin/account_settings', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    function update_profile() {
        $data['navbar'] = "admin";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'first name', "required|xss_clean|alpha");
        $this->form_validation->set_rules('last_name', 'last name', "required|xss_clean|alpha");

        if ($this->form_validation->run() == FALSE) {
            $data['page_title'] = "Profile Settings";
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub');
            $this->load->view('admin/profile_settings', $data);
            $this->load->view('templates/footer');
        } else {
            $user_id = $this->session->userdata('id');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            if ($this->user->update_info($user_id, $first_name, $last_name)) {
                $result = $this->user->get_details($this->session->userdata('id'));
                foreach ($result as $row) {
                    $data['first_name'] = $row->first_name;
                    $data['last_name'] = $row->last_name;
                }
                $data['page_title'] = "Profile Settings";
                $data['succ_message'] = "Profile Settings Changed Successfully";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub');
                $this->load->view('admin/profile_settings', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    function get_profile_img() {
        
    }

    function check_old_password() {
        $user_id = $this->session->userdata('id');
        $password_hash = $this->user->get_password_hash($user_id);

        $inserted_old_password_hash = md5($this->input->post('old_password'));
        if ($password_hash === $inserted_old_password_hash) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_old_password', "Your old password is incorrect");
            return FALSE;
        }
    }

    function create() {
        $data['navbar'] = "admin";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', "trim|required|xss_clean|min_length[5]|alpha_dash");
        $this->form_validation->set_rules('email', 'email', "trim|required|xss_clean|valid_email");
        $this->form_validation->set_rules('first_name', 'first name', "trim|required|xss_clean|alpha");
        $this->form_validation->set_rules('last_name', 'last name', "trim|required|xss_clean|alpha");
        $this->form_validation->set_rules('password', 'password', "required|xss_clean|matches[conf_password]|min_length[5]");
        $this->form_validation->set_rules('conf_password', 'confirm password', "required|xss_clean|matches[password]");
        
        if ($this->form_validation->run() == FALSE) {
            $data['page_title'] = "Create Admin Account";
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub');
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
            if($this->user->create($input_data)){
                
            }
        }
    }
}
