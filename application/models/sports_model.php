<?php

class Sports_Model extends CI_Model {

    //loading database on class creationorderMainAddress
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }
    
    public function add_sport_category($name,$description,$agecat){
        $this->db->query("insert into sport_category(name,description,age_category) values('$name','$description','$agecat')");
        return TRUE;
    }
    
    public function view_sport_category() {
        $data = $this->db->query("select * from sport_category");
        return $data->result();
    }
    
    public function sport_category_details($id) {
        $data = $this->db->query("select * from sport_category where id='$id'");
        //echo $data->row()->name;
        //exit;
        return $data->row();
    }
}