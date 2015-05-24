<?php

/*
 * This controlled used for managing the current user's profile / account. 
 * Edit Profile and Edit Account Settings (like password change) was previously in admin controller.
 * Seperated for better usage of admin controller. So we can use admin controller for system administration only.
 * @ssudaraka
 */

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user');
    }

    /*
     * Main (index) function. This will load current user's profile to edit general information
     * like First Name, Last Name and profile picture.
     */

    function index() {
        $result = $this->user->get_details($this->session->userdata('id'));
        foreach ($result as $row) {
            $data['first_name'] = $row->first_name;
            $data['last_name'] = $row->last_name;
            $data['profile_image'] = $row->profile_img;
        }

        $data['navbar'] = 'admin';

        $data['page_title'] = "Profile Settings";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('profile/profile_settings', $data);
        $this->load->view('templates/footer');
    }

    function account_settings() {

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
        $this->load->view('profile/account_settings', $data);
        $this->load->view('templates/footer');
    }

    /**
     * This performs password change. 
     */
    function change_password() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('old_password', 'Old Password', "required|xss_clean|callback_check_old_password");

        if ($this->user->force_strong_password()) {
            $this->form_validation->set_rules('new_password', 'New Password', "required|min_length[5]|xss_clean|matches[conf_password]|callback_is_strong_password");
        } else {
            $this->form_validation->set_rules('new_password', 'New Password', "required|min_length[5]|xss_clean|matches[conf_password]");
        }

        $this->form_validation->set_rules('conf_password', 'Confirm Password', "required|xss_clean|matches[new_password]");

        if ($this->form_validation->run() == FALSE) {
            $data['page_title'] = "Account Settings";
            $data['navbar'] = 'admin';
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('profile/account_settings', $data);
            $this->load->view('templates/footer');
        } else {

            $user_id = $this->session->userdata('id');
            $new_password = $this->input->post('new_password');
            if ($this->user->change_password($user_id, $new_password)) {
                $data['page_title'] = "Account Seings";
                $data['navbar'] = 'admin';
                $data['succ_message'] = "Password Changed Successfully";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('profile/account_settings', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    function is_strong_password() {
        $password = $this->input->post('new_password');
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);

        if (!$uppercase) {
            $this->form_validation->set_message('is_strong_password', "Your new password does not contain atleast 1 uppercase letter");
            return FALSE;
        } else if (!$lowercase) {
            $this->form_validation->set_message('is_strong_password', "Your new password does not contain atleast 1 lowecase letter");
            return FALSE;
        } else if (!$number) {
            $this->form_validation->set_message('is_strong_password', "Your new password does not contain atleast 1 number");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function update_profile() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'first name', "required|xss_clean|alpha");
        $this->form_validation->set_rules('last_name', 'last name', "required|xss_clean|alpha");

        if ($this->form_validation->run() == FALSE) {
            $user_id = $this->session->userdata('id');
            $data['page_title'] = "Profile Settings";
            $data['navbar'] = 'admin';
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['profile_image'] = $this->user->get_profile_img($user_id);

            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('profile/profile_settings', $data);
            $this->load->view('templates/footer');
        } else {
            $user_id = $this->session->userdata('id');

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '0';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);

            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');

            $image = $this->user->get_profile_img($user_id);

            if ($this->upload->do_upload('profile_img')) {
                $image_data = $this->upload->data();
                $image = base_url() . "uploads/" . $image_data['file_name'];
            }

            $update_data = array(
                'user_id' => $user_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'image' => $image
            );

            if ($this->user->update_info($update_data)) {
                $result = $this->user->get_details($this->session->userdata('id'));
                foreach ($result as $row) {
                    $data['first_name'] = $row->first_name;
                    $data['last_name'] = $row->last_name;
                    $data['profile_image'] = $row->profile_img;
                }
                $data['page_title'] = "Profile Settings";
                $data['navbar'] = 'admin';
                $data['succ_message'] = "Profile Settings Changed Successfully";
                $this->load->view('templates/header', $data);
                $this->load->view('navbar_main', $data);
                $this->load->view('navbar_sub', $data);
                $this->load->view('profile/profile_settings', $data);
                $this->load->view('templates/footer');
            }
        }
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