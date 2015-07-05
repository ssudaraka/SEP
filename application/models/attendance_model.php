<?php

/*
 * Model for handling Attendances. This interacts with the database to set and get attendace information.
 * - @ssudaraka
 */

class Attendance_Model extends CI_Model {

    function get_all_temp_records() {
        $sql = "SELECT * FROM teachers t, temp_teacher_attendance a WHERE t.signature_no = a.signature_no";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function is_already_recorded($signature_no) {
        $sql = "SELECT * FROM temp_teacher_attendance WHERE signature_no = '{$signature_no}'";
        $query = $this->db->query($sql);

        if ($query->num_rows == 1) {
            return TRUE;
        }

        $date = date("Y-m-d");

        $sql = "SELECT * FROM teacher_attendance WHERE signature_no = '{$signature_no}' AND date = '{$date}'";
        $query = $this->db->query($sql);

        if ($query->num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_temp_absent_records() {
        $sql = "SELECT t1.* FROM teachers t1 LEFT JOIN temp_teacher_attendance t2 ON t2.teacher_id = t1.id WHERE t2.teacher_id IS NULL";
        $query = $this->db->query($sql);

        if (!$query) {
            return NULL;
        } else {
            return $query->result();
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

        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_record($signature_no) {
        $sql = "DELETE FROM temp_teacher_attendance WHERE signature_no = {$signature_no}";
        $query = $this->db->query($sql);

        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_temp() {
        $sql = "DELETE FROM temp_teacher_attendance";
        $query = $this->db->query($sql);

        return TRUE;
    }

    function save_attendance() {
        $sql = "SELECT * FROM temp_teacher_attendance";
        $query = $this->db->query($sql);
        $date = date("Y-m-d");

        $result = $query->result();

        foreach ($result as $row) {
            $sql = "INSERT INTO teacher_attendance (teacher_id, signature_no, is_present, date) ";
            $sql .= "VALUES ($row->teacher_id, $row->signature_no, 1, '$date')";
            $query = $this->db->query($sql);
        }
    }

    function save_absent($absent_list) {
        
        $date = date("Y-m-d");
        foreach ($absent_list as $absent) {
            $sql = "INSERT INTO teacher_attendance (teacher_id, signature_no, is_present, date) ";
            $sql .= "VALUES ($absent->id, $absent->signature_no, 0, '$date')";
            $query = $this->db->query($sql);
        }
    }

    function search_attendance($date) {
        $sql = "SELECT * FROM teachers t, teacher_attendance a WHERE t.signature_no = a.signature_no AND a.date = '{$date}'";
        $query = $this->db->query($sql);

        if ($query->num_rows == 0) {
            return null;
        } else {
            return $query->result();
        }
    }

}
