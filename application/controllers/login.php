<?php
/**
 * Ecole - Login Controller
 * 
 * Handles the user login to the system.
 * 
 * @author  Sudaraka K. S.
 * @copyright (c) 2015, Ecole. (http://projectecole.com)
 * @link http://projectecole.com
 */
class Login extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
    function index(){
        
        if($this->session->userdata('logged_in')){
            redirect('dashboard', 'refresh');
        }
        
        $data['page_title'] = "Login";
        $this->load->view('/templates/header', $data);
        $this->load->view('login_form');
        $this->load->view('/templates/footer');
    }
}