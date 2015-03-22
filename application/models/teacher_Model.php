<?php

class Teacher_Model extends CI_Model {

    //loading database on class creationorderMainAddress
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

    public function insert_new_staff($NIC, $name, $initial, $birth, $gender, $Nationality, $religion, $civilstatus, $address, $contactMob, $contactHome, $email, $widow) {
        try {
            if ($this->db->query("INSERT INTO teachers (`nic_no`, `full_name`, `name_with_initials` , `dob` , `gender`, `nationality_id` , `religion_id` , `civil_status` , `permanent_addr` , `contact_mobile` , `contact_home` , `email` , `wnop_no`) 
    			VALUES ('$NIC', '$name' , '$initial' , '$birth', '$gender' , '$Nationality' , '$religion' , '$civilstatus' , '$address' , '$contactMob' , '$contactHome' , '$email' , '$widow')")) {
                $id = $this->db->insert_id();
                return $id;
            } else {
                return NULL;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    public function update_new_staff($ID, $serialno, $signatureno, $careerdate, $medium, $designation, $section, $mainsubject, $servicegrade) {
        try {
            if ($this->db->query("UPDATE teachers SET `serial_no` = '$serialno' , `signature_no` = '$signatureno' , `first_appointment_date` = '$careerdate' , `medium` = '$medium' , `designation_id` = '$designation' , `section` = '$section' , `main_subject_id` = '$mainsubject' , `grade` = '$servicegrade' WHERE id = '$ID' ")) {
                return $ID;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    public function get_staff_details($ID) {
        try {
            if ($data = $this->db->query("select * from `teachers` where `id` = $ID")) {
                $row = $data->row();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }
    
    public function set_time($ID , $time) {
        try {
            if ($data = $this->db->query("UPDATE `teachers` set `created_at` = '$time'  where `id` = '$ID' ")) {
                
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            return null;
        }
    }
    
    public function set_user_id($ID , $userid ) {
        try {
            if ($this->db->query("UPDATE `teachers` set `user_id` = '$userid'  where `id` = '$ID' ") == TRUE) {
                
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            return null;
        }
    }
    
    public function insert_new_teacher_userdata($username, $password , $create) {
        try {
            $encryptpwd = md5($password);
            if ($this->db->query("INSERT INTO users (`username`, `password` , `created_at`, `user_type`) VALUES ('$username', '$encryptpwd' , '$create', 'T')")) {
                $id = $this->db->insert_id();
                return $id;
            } else {
                return NULL;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

//search teacher by nic no
    public function SearchTeacher($id) {

        $query = $this->db->query("SELECT * FROM teachers WHERE nic_no like'%$id%' or full_name like '%$id%' or user_id like '%$id%' or signature_no like '%$id%' or serial_no like '%$id%' ");
        return $query;
    }

//search for teacher details by 'id'
    public function getTeacherProfile($id) {

        $query = $this->db->query("SELECT * FROM teachers WHERE id ='$id'");
        return $query->result();
    }

//get all teacher recodes    
    public function SearchAllTeachers() {

        $query = $this->db->query("SELECT * FROM teachers");
        return $query->result();
    }

    //update teacher details
    public function UpdateTeacher($teacher,$myid) {
        $datestring = " %Y-%m-%d";
        $time = time();

        $updated_date = mdate($datestring, $time);
        

        $sql = "UPDATE teachers SET
                                    nic_no='{$teacher['nic']}',                 full_name='{$teacher['fullName']}',            name_with_initials='{$teacher['nameWithInitials']}', dob='{$teacher['birthday']}',
                                        gender='{$teacher['gender']}',          nationality_id='{$teacher['nationality']}',    religion_id='{$teacher['religion']}',                civil_status='{$teacher['civilStatus']}',
                                        permanent_addr='{$teacher['address']}', contact_mobile='{$teacher['contactMobile']}',  contact_home='{$teacher['contactHome']}',            email='{$teacher['email']}', 
                                        wnop_no='{$teacher['wnop']}',           serial_no='{$teacher['serial']}',              signature_no='{$teacher['signature']}',              first_appointment_date='{$teacher['joinDate']}',
                                        medium='{$teacher['medium']}',          designation_id='{$teacher['designation']}',    section='{$teacher['section']}',                     main_subject_id='{$teacher['mainSub']}',
                                        grade='{$teacher['serviceGrade']}',     personal_file_no='{$teacher['personalFile']}', teacher_register_no='{$teacher['teacherRegNo']}',    service='{$teacher['service']}',
                                        remarks='{$teacher['remarks']}',        updated_at='$updated_date'
                                    WHERE id='$myid' ";
       // $sql = "UPDATE teachers SET nic_no='{$teacher['nic']}' WHERE id='$myid' ";
        
        if($query = $this->db->query($sql)){
            return TRUE;
        }else{
            return FALSE;
            
        }
         
    }
    
    //delete teacher
    public function DeleteTeacher($id){
       $sql= "DELETE FROM teachers WHERE id='$id'";
        if($query = $this->db->query($sql)){
            return TRUE;
        }else{
            return FALSE;
            
        }
    }

    //Get teacher id from user id
    public function get_teacher_id($userid){
        try{
            $query = $this->db->query("SELECT id FROM teachers WHERE user_id='$userid'");
            $row = $query->row();
            return $row->id;
        } catch (Exception $ex) {
            return FALSE;
        }
    }

}

?>