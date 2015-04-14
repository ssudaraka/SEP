<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Year extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Year_Model');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "Year Planer";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];

        //For Admin Views
        if($data['user_type'] == 'A'){

            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);

            //View Year Planer
            $this->load->view('year/year');
            
            $this->load->view('/templates/footer');
        } elseif($data['user_type'] == 'T'){


            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            
            //View Year Planer 
            
            $this->load->view('/templates/footer');
        } else {
            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            
            //View Year Planer 
            
            $this->load->view('/templates/footer');
        }

    }

   
}

/* Coded by Udara Karunarathna @P0dda */
/* Location: www.udara.info */