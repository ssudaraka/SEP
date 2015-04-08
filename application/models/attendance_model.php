<?php

/*
 * Model for handling Attendances. This interacts with the database to set and get attendace information.
 * - @ssudaraka
 */

class Attendance_Model extends CI_Model {

    function get_all_records() {
        $sql = "SELECT * FROM teachers t, temp_teacher_attendance a WHERE t.signature_no = a.signature_no";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function is_already_recorded($signature_no) {
        $sql = "SELECT * FROM temp_teacher_attendance WHERE signature_no = '{$signature_no}'";
        $query = $this->db->query($sql);

        if ($query->num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function is_valid_signature_no($signature_no) {
        $sql = "SELECT * FROM teachers WHERE signature_no = '{$signature_no}'";
        $query = $this->db->query($sql);

        if ($query->num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function add_record($signature_no) {
        $sql = "SELECT * FROM teachers WHERE signature_no = '{$signature_no}'";
        $query = $this->db->query($sql);
        $row = $query->row();
        $teacher_id = $row->id;
        
        $sql = "INSERT INTO temp_teacher_attendance (teacher_id, signature_no, is_present) "
                . "VALUES ($teacher_id, $signature_no, 1)";
        
        $query = $this->db->query($sql);
        
        if($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function delete_record($signature_no) {
        $sql = "DELETE FROM temp_teacher_attendance WHERE signature_no = {$signature_no}";
        $query = $this->db->query($sql);
        
        if($query){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
