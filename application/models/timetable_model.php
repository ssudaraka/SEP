<?php

class Timetable_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create_class_timetable($class_id, $year) {

        $sql = "INSERT INTO class_timetable (class_id, year) VALUES ('{$class_id}', '{$year}')";
        $query = $this->db->query($sql);

        return $this->db->insert_id();
    }

    function get_class_timetable($timetable_id) {
        $sql = "SELECT * FROM class_timetable WHERE id='{$timetable_id}'";
        $query = $this->db->query($sql);

        return $query->row();
    }

    function get_timetable_list() {

        $sql = "SELECT * FROM class_timetable";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function delete($timetable_id) {

        $sql = "DELETE FROM class_timetable WHERE id='{$timetable_id}'";
        $query = $this->db->query($sql);

        return TRUE;
    }

    function get_timetable_slot($timetable_id, $slot_id) {
        $sql = "SELECT * FROM timetable_slot WHERE timetable_id='{$timetable_id}' AND slot_id='{$slot_id}'";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $timetable = $query->row();
            $slot['timetable_id'] = $timetable->timetable_id;
            $slot['slot_id'] = $timetable->slot_id;
            $slot['teacher_id'] = $timetable->teacher_id;
            $slot['subject_id'] = $timetable->subject_id;

            return $slot;
        }
    }
    
    function get_teacher_list(){
        $sql = "SELECT * FROM teachers";
        $query = $this->db->query($sql);
        
        if($query->num_rows() == 0){
            return FALSE;
        } else {
            return $query->result();
        }
    }
    
    function get_subject_list(){
        $sql = "SELECT * FROM subjects";
        $query = $this->db->query($sql);
        
        if($query->num_rows() == 0){
            return FALSE;
        } else {
            return $query->result();
        }
    }
    
    function get_subject_name($subject_id){
        $sql = "SELECT * FROM subjects WHERE id = {$subject_id}";
        $query = $this->db->query($sql);
        $subject = $query->row();
        
        return $subject->subject_name;  
    }
    
    function get_teacher_name($teacher_id){
        $sql = "SELECT * FROM teachers WHERE id = {$teacher_id}";
        $query = $this->db->query($sql);
        
        $teacher = $query->row();
        return $teacher->name_with_initials;
    }
    
    function get_timetable_year($timetable_id){
        $sql = "SELECT * FROM class_timetable WHERE id = {$timetable_id}";
        $query = $this->db->query($sql);
        $timetable = $query->row();
        
        return $timetable->year;      
    }
    
    function already_have_slot($teacher_id, $slot_id, $year){
        $sql = "SELECT * FROM timetable_slot WHERE teacher_id=$teacher_id AND slot_id='$slot_id' AND year='$year'";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0){
            $row = $query->row();
            return $row->timetable_id;
        } else {
            return FALSE;
        }
    }
    
    function delete_slots($timetable_id){
        $sql = "DELETE FROM timetable_slot WHERE timetable_id=$timetable_id";
        $query = $this->db->query($sql);
        
        return TRUE;
    }
    
    function delete_slot($timetable_id, $slot_id){
        $sql = "DELETE FROM timetable_slot WHERE timetable_id=$timetable_id AND slot_id='$slot_id'";
        $query = $this->db->query($sql);
        
        return TRUE;
    }
    
    function timetable_already_have($class_id, $year){
        $sql = "SELECT * FROM class_timetable WHERE class_id=$class_id AND year='$year'";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function add_slot($slot){
        $timetable_id = $slot['timetable_id'];
        $slot_id = $slot['slot_id'];
        $teacher_id = $slot['teacher_id'];
        $subject_id = $slot['subject_id'];
        $year = $slot['year'];
        $sql = "INSERT INTO timetable_slot (timetable_id, slot_id, teacher_id, subject_id, year) VALUES($timetable_id, '$slot_id', $teacher_id, $subject_id, '$year')";
        
        if($this->db->query($sql)){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
