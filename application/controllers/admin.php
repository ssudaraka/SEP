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
    
    function update_profile(){
        
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

}
