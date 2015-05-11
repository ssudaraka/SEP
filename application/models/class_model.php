<?php

class Class_Model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function get_class_list(){
        $sql = "SELECT * FROM classes";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function get_class_name($class_id){
        $sql = "SELECT * FROM classes WHERE id = '{$class_id}'";
        $query = $this->db->query($sql);
        $result = $query->row();
        
        return $result->name;
    }
}