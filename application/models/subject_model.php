<?php

class Subject_model extends CI_Model {

    

    public function get_details($Subject_id) {
        $query = $this->db->query("SELECT * FROM subject WHERE id='{$Subject_id}' LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
/*
 * Search subjects
 */
   public function search_subjects($keyword, $limit = 1, $offset = null) {
        $sql = "SELECT * FROM subjects WHERE subject_name LIKE '%{$keyword}%' OR subject_code LIKE '%{$keyword}%' LIMIT {$limit} ";
        
        if (isset($offset)) {
            $sql .= " OFFSET {$offset}";
        }
        $query = $this->db->query($sql);
        return $query;
    }

   
    public function update_info($update_data) {
               
        $query = "UPDATE users SET first_name='{$update_data['first_name']}', last_name='{$update_data["last_name"]}', profile_img='{$update_data['image']}' WHERE id='{$update_data['user_id']}'";
        $result = $this->db->query($query);

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
/*
 * Add new subject into database
 */
    public function create($subject_data) {


        $subjectname = $subject_data['subjectname'];
        $subjectcode = $subject_data['subjectcode'];
        $sectionid = $subject_data['sectionid'];
        $subjectinchargeid = $subject_data['subjectinchargeid'];
        
        $sql = "INSERT INTO subjects (subject_name, subject_code, section_id, subject_incharge_id) VALUES ('{$subjectname}', '{$subjectcode}', '{$sectionid}', '{$subjectinchargeid}')";

        

       

        $result = $this->db->query($sql);

        if (!$result) {
            return FALSE;
        } else {
            return $this->db->insert_id();
        }
    }
/*
 * get all the subject resuls from subjects table 
 */
    public function get_subjects( $limit = 1, $offset = null) {
        $sql = "SELECT * FROM subjects  LIMIT {$limit}";
        //if ofset is not null
        if (isset($offset)) {
            $sql .= " OFFSET {$offset}";
        }
        $query = $this->db->query($sql);
        return $query;
    }
/*
 * Get total row count of the subjects table .. this is needed for pagination
 */
    public function get_subject_total() {
        $sql = "SELECT * FROM subjects";
        $query = $this->db->query($sql);

        return $query->num_rows();
    }
/*
 * delete subject
 */
    public function delete($id) {
        $sql = "DELETE FROM subjects WHERE id='{$id}'";
        $query = $this->db->query($sql);

        if ($query) {
            return TRUE;
        }
    }

   
    
   
}
    