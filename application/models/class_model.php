<?php

class Class_Model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function get_class_list(){
        $sql = "SELECT * FROM classes order by grade_id,name asc";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function get_class_name($class_id){
        $sql = "SELECT * FROM classes WHERE id = '{$class_id}'";
        $query = $this->db->query($sql);
        $result = $query->row();
        
        return $result->name;
    }

    public function check_class_exists_name($grade, $name) {

        $sql = "SELECT * FROM classes WHERE grade_id ='$grade' AND name ='$name'";
        $query = $this->db->query($sql);
        //Check if Username or Password Exists
        if ($query->num_rows() == 0){
            return FALSE;
        } else{
            return TRUE;
        }
        
    }

    //Add Class
    public function addclass($data) {

        if ($this->db->insert('classes', $data)) {
            return TRUE;
        } else {
                return FALSE;
        }
        
    }

    //Get Class Basic Details
    function viewclass($id){
        try{
            $query = $this->db->query("SELECT * FROM classes WHERE id='$id' LIMIT 1");
            if ($query->num_rows() > 0)
            {
                $ret_array = array();
               foreach ($query->result() as $row)
               {
                  $ret_array['name'] = $row->name; 
                  $ret_array['id'] = $row->id; 
                  $ret_array['grade_id'] = $row->grade_id; 
                  $ret_array['teacher_id'] = $row->teacher_id; 
               }

               return $ret_array;
            } else{
                return FALSE;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    //Update Class
    function updateclass($data,$id){
        $this->db->where('id', $id);
        if ($this->db->update('classes', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Delete Class
    public function deleteclass($id){
        $data = array(
               'id' => $id
            );

        if ($this->db->delete('classes', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //get batch list
    function get_batch_list(){
        $sql = "SELECT b.id,b.name,b.grade,y.name as acadamic_year FROM batch b, year_plan y where b.academic_year = y.id order by b.academic_year,b.name desc";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    //Add Batch
    public function addbatch($data) {

        if ($this->db->insert('batch', $data)) {
            return TRUE;
        } else {
                return FALSE;
        }
        
    }

    //batch exists
    public function check_batch_exists_name($ay, $name, $grade) {

        $sql = "SELECT * FROM batch WHERE academic_year ='$ay' AND name ='$name' AND grade ='$grade'  ";
        $query = $this->db->query($sql);
        //Check if Username or Password Exists
        if ($query->num_rows() == 0){
            return FALSE;
        } else{
            return TRUE;
        }
        
    }

    //Update Baatch
    function updatebatch($data,$id){
        $this->db->where('id', $id);
        if ($this->db->update('batch', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

     //Get Class Basic Details
    function viewbatch($id){
        try{
            $query = $this->db->query("SELECT b.id,b.name,b.grade,b.academic_year FROM batch b, year_plan y where b.academic_year = y.id and b.id='$id' LIMIT 1");
            if ($query->num_rows() > 0)
            {
                $ret_array = array();
               foreach ($query->result() as $row)
               {
                  $ret_array['name'] = $row->name; 
                  $ret_array['id'] = $row->id; 
                  $ret_array['acadamic_year'] = $row->academic_year;
                  $ret_array['grade'] = $row->grade;  
               }

               return $ret_array;
            } else{
                return FALSE;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    //Get Pending Students
    function get_pending_students(){
        $sql = "SELECT * FROM students WHERE class is null";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }

    }

     //Update Student bAtach
    function update_student_batch($data,$id){
        $this->db->where('id', $id);
        if ($this->db->update('students', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //View Student Class
    public function view_class_students($id){
        $this->db->select('*');
        $this->db->from('students');
        $this->db->where('class', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    //View Student Class
    public function get_unselected_teachers(){
        $this->db->select('*');
        $this->db->from('teachers');
        $this->db->where('designation_id', '7');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }


    //Check Teacher is Selected or Not
    public function check_class_teacher($id){
        $sql = "SELECT * FROM classes WHERE teacher_id = '$id'";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

     //Update Student bAtach
    function update_class_teacher($data,$id){
        $this->db->where('id', $id);
        if ($this->db->update('classes', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

     public function get_teacher_name($id) {

        $query = $this->db->query("SELECT * FROM teachers WHERE id ='$id'");
        return $query->row()->full_name;
    }

    //Delete Student From Class
    function unassign_student_from_class($data,$id){
        $this->db->where('id', $id);
        if ($this->db->update('students', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}