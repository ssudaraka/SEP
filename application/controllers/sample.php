<?php

class Sample extends CI_Controller {

    public function index() {
        $data['page_title'] = "Sample Page";
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/footer');
    }

    public function view($page = 'home') {
        
    }

}
