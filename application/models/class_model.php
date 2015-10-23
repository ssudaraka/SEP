<?php

class Class_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_classes($grade = NULL, $academic_year = NULL){
        $sql = "SELECT * FROM `classes` WHERE `academic_year`='{$academic_year}' ";
        $sql .= (!$grade ? "" : "AND grade_id='{$grade}' ");
        
        return $this->db->query($sql)->result();
    }
    
    public function create_class($class){
        $this->db->insert('classes', $class); 
    }
    
    public function get_grades(){
        return $this->db->get('grades')->result();
    }

}
