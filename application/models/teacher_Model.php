<?php

class Teacher_Model extends CI_Model {

    //loading database on class creationorderMainAddress
    public function __construct() {
        $this->load->database();
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

    public function insert_new_teacher_userdata($username, $password) {
        try {
            $encryptpwd = md5($password);
            if ($this->db->query("INSERT INTO users (`username`, `password`) VALUES ('$username', '$encryptpwd')")) {
                $id = $this->db->insert_id();
                return $id;
            } else {
                return NULL;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

}

?>