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

        $data['navbar'] = 'admin';

        $data['page_title'] = "Profile Settings";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
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
        $data['navbar'] = 'admin';
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
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
            $data['navbar'] = 'admin';
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('admin/account_settings', $data);
            $this->load->view('templates/footer');
        } else {

            $user_id = $this->session->userdata('id');
            $new_password = $this->input->post('new_password');
            if ($this->user->change_password($user_id, $new_password)) {
                $data['page_title'] = "Account Settings";
                $data['navbar'] = 'admin';
                $data['succ_message'] = "Password Changed Successfully";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('admin/account_settings', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    function update_profile() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'first name', "required|xss_clean|alpha");
        $this->form_validation->set_rules('last_name', 'last name', "required|xss_clean|alpha");

        if ($this->form_validation->run() == FALSE) {
            $data['page_title'] = "Profile Settings";
            $data['navbar'] = 'admin';
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
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
                $data['navbar'] = 'admin';
                $data['succ_message'] = "Profile Settings Changed Successfully";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
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

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', "trim|required|xss_clean|min_length[5]|alpha_dash");
        $this->form_validation->set_rules('email', 'email', "trim|required|xss_clean|valid_email");
        $this->form_validation->set_rules('first_name', 'first name', "trim|required|xss_clean|alpha");
        $this->form_validation->set_rules('last_name', 'last name', "trim|required|xss_clean|alpha");
        $this->form_validation->set_rules('password', 'password', "required|xss_clean|matches[conf_password]|min_length[5]");
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
        $data["links"] = explode('&nbsp;',$str_links );

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
        
        $config['cur_tag_open'] = '<a href="#">';
        $config['cur_tag_close'] = '</a>';

        $config['offset'] = ($this->uri->segment(3) ? $this->uri->segment(3) : null);

        $keyword = $this->input->post('keyword');
        $data['page_title'] = "Manage Administrators";
        $data['navbar'] = 'admin';
        
        $data['query'] = $this->user->get_user_list($keyword, 'A', $config['per_page'], $config['offset']);
        
        
        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        
        $data['result'] = $data['query']->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('admin/manage_admins', $data);
        $this->load->view('templates/footer');
    }
    
    function delete($user_id){
        
        if($this->session->userdata('user_type') !== "A"){
            show_404();
        }
        
        if($this->user->delete($user_id)) {
            $data['delete_msg'] = "User ID " . $user_id . " has been removed from the database. This cannot be reverted";
            $data['page_title'] = "Manage Administrators";
            $data['navbar'] = 'admin';
        }
    }

}
