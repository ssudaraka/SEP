<?php

class Student_Model extends CI_Model {

    //loading database on class creationorderMainAddress
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

    /*
     * Insert New Student recode
     */

    public function insert_new_student($student_data) {
        try {
            // $userid=$student_data['studentid'];
            $admissionno = $student_data['admissionno'];
            $admissiondate = $student_data['admissiondate'];
            $firstname = $student_data['firstname'];
            $lastname = $student_data['lastname'];
            $fullname = $firstname . " " . $lastname;
            $initials = $student_data['nameWithInitials'];
            $dob = $student_data['birthday'];
            $gender = "M";
            $nic = $student_data['nic'];
            $language = $student_data['language'];
            $religion_id = $student_data['religion'];
            $address = $student_data['address'];
            $contact = $student_data['contactHome'];
            $house_id = $student_data['houseid'];
            $email = $student_data['email'];
            $created_at = date('Y-m-d H:i:s');

            if ($this->db->query("INSERT INTO students (`admission_no` , `admission_date` , `full_name` , `name_with_initials` , `dob` , `gender`, `nic_no` , `language` , `religion` , `permanent_addr` , `contact_home` , `email` , `house_id` , `created_at`) 
    			VALUES ('$admissionno', '$admissiondate' , '$fullname' , '$initials' , '$dob' , '$gender' , '$nic' , '$language' , '$religion_id' , '$address' , '$contact' , '$email' , '$house_id' , '$created_at')")) {
                $id = $this->db->insert_id();
                return $id;
            } else {
                return NULL;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    /*
     * Insert New Guardian recode
     */

    public function insert_new_Guardian($guardian_data) {

        $row = $this->Student_Model->get_last_row();
        $student_id = $row->user_id;
        $fullname = $guardian_data['fullname'];
        $initials = $guardian_data['namewithinitials'];
        $dob = $guardian_data['birthday'];
        $gender = $guardian_data['gender'];
        $occupation = $guardian_data['occupation'];
        $relation = $guardian_data['relation'];
        $pastpupil = $guardian_data['pastpupil'];
        $adddress = $guardian_data['address'];
        $contact_home = $guardian_data['contact_home'];
        $contact_mobile = $guardian_data['contact_mobile'];

        if ($this->db->query("INSERT INTO guardians (`student_id` , `fullname` , `name_with_initials` , `dob` , `gender` , `relation` , `occupation` , `addr` , `contact_home` , `contact_mobile`,`is_pastpupil` ) 
    			VALUES ('$student_id', '$fullname'  , '$initials' , '$dob' , '$gender' , '$relation' , '$occupation' , '$adddress' , '$contact_home' , '$contact_mobile','$pastpupil')")) {
            $id = $this->db->insert_id();
            return $id;
        } else {
            return NULL;
        }
    }

    
    /*
     * getting the last recode details of students table
     */
    public function get_last_row(){
        if($rows = $this->db->query("SELECT * FROM students ORDER BY id DESC LIMIT 1")){
            $row=$rows->row();
            return $row;
        }  else {
             return null;
        }
        
    }
      /*
     * getting the recode details of Newly added Student
     */
    public function  get_last_inserted_student($id){
         if($query= $this->db->query("SELECT * FROM students WHERE id = '$id'")){
            $row=$query->row();
            return $row;
        }  else {
             return null;
        }
        
    }
    
    /*
     * getting the recode details of  Student with his guardian details by given id
     */

    public function get_student_profile($id) {

        try {
            if ($data = $this->db->query("SELECT * FROM students s, guardians g WHERE s.user_id = g.student_id  AND  s.user_id = '$id'")) {
                $row = $data->row();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    /*
     * getting the recode details of  Student details by given id
     */

    public function get_student_only($id) {
        try {
            if ($data = $this->db->query("SELECT * FROM students  WHERE user_id = '$id'")) {
                $row = $data->row();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    /*
     * getting the recode details of guardian details by given id
     */

    public function get_guardian_only($id) {
        try {
            if ($data = $this->db->query("SELECT * FROM guardians  WHERE student_id = '$id'")) {
                $row = $data->row();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    /*
     * getting all the student recode details +pagination
     */

    public function get_all_students($limit = 1, $offset = null) {
        $sql = "SELECT * FROM students LIMIT {$limit}";
        if (isset($offset)) {
            $sql .= " OFFSET {$offset}";
        }
        $query = $this->db->query($sql);
        return $query;
    }

    /*
     * getting all the student recode details without pagination
     */

    public function get_all_students_2() {
        $sql = "SELECT * FROM students";

        $query = $this->db->query($sql);
        return $query;
    }
    
    /*
     * get all archived student recodes
     */
     function get_all_archive_students() {
         $query = $this->db->query("SELECT * FROM  archived_students order by full_name asc");
     
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /*
     * delete student recode + his guardian details
     */

    public function delete_student($id) {
        $sql1 = "DELETE s,g FROM archived_students AS s INNER JOIN archived_guardians AS g ON s.user_id = g.student_id  WHERE  s.user_id = '$id'";

        if ($query = $this->db->query($sql1)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * update Guardian recode 
     */

    public function update_guardian($guardian, $myid) {
        $sql = "UPDATE guardians SET fullname = '{$guardian['name']}', name_with_initials = '{$guardian['nameWithInitials']}', dob = '{$guardian['birthday']}', occupation = '{$guardian['occupation']}',
                                        addr ='{$guardian['address']}',contact_home='{$guardian['contact_home']}',contact_mobile='{$guardian['contact_mobile']}' WHERE student_id='$myid' ";
        // $sql = "UPDATE teachers SET nic_no='{$teacher['nic']}' WHERE id='$myid' ";

        if ($query = $this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * update Student recode 
     */

    public function update_student($student, $myid) {
        $sql = "UPDATE students SET full_name ='{$student['name']}',  permanent_addr='{$student['address']}',  name_with_initials='{$student['nameWithInitials']}', contact_home='{$student['contact_home']}',email='{$student['email']}'  WHERE user_id='$myid'";

        if ($query = $this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * Insert new student's log details
     */

    public function insert_new_student_userdata($username, $password, $create , $fname , $lname) {
        try {
            $encryptpwd = md5($password);
            if ($this->db->query("INSERT INTO users (`username`, `password` , `first_name` , `last_name` , `created_at`, `user_type`) VALUES ('$username', '$encryptpwd' , '$fname' , '$lname' , '$create', 'S')")) {
                $id = $this->db->insert_id();
                return $id;
            } else {
                return NULL;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    /*
     * set user_id of the student in the student table
     */

    public function set_user_id($ID, $userid) {
        try {
            if ($this->db->query("UPDATE `students` set `user_id` = '$userid'  where `id` = '$ID' ") == TRUE) {

                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    /*
     * Search student by given Id 
     */

    public function search_student($id) {
        $sql = "SELECT * FROM students WHERE user_id like'%$id%' or full_name like '%$id%' or admission_no like '%$id%' or name_with_initials like '%$id%' ";
        if (isset($offset)) {
            $sql .= " OFFSET {$offset}";
        }
        $query = $this->db->query($sql);
        return $query;
    }

    /*
     * Get Logged user's username 
     */

    public function get_details($user_id) {
        $query = $this->db->query("SELECT username FROM users WHERE id='{$user_id}'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /*
     * change Logged user's password
     */

    public function change_password($user_id, $new_password) {
        $hashed_password = md5($new_password);
        $query = "UPDATE users SET password='{$hashed_password}' WHERE id='{$user_id}'";
        $result = $this->db->query($query);

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * get Logged user's encrypted password
     */

    public function get_password_hash($user_id) {
        $query = $this->db->query("SELECT password FROM users WHERE id='{$user_id}'");
        $row = $query->row();
        return $row->password;
    }

    /*
     * Insert New Guardian recode
     */

    public function archive_student($id) {

//       $student_d = get_student_only($id);
//       $guardian_d = get_guardian_only($id);

        try {
            if ($data_s = $this->db->query("SELECT * FROM students  WHERE user_id = '$id'")) {
                $student_data = $data_s->row();

                $user_id = $student_data->user_id;
                $admissionno = $student_data->admission_no;
                $admissiondate = $student_data->admission_date;
//                $firstname = $student_data->'first_name'];
//                $lastname = $student_data->'last_name'];
                $fullname = $student_data->full_name;
                $initials = $student_data->name_with_initials;
                $dob = $student_data->dob;
                $gender = "M";
                $nic = $student_data->nic_no;

                $language = $student_data->language;
                $religion_id = $student_data->religion;
                $address = $student_data->permanent_addr;
                $contact = $student_data->contact_home;
                $house_id = $student_data->house_id;
                $email = $student_data->email;
                $created_at = date('Y-m-d H:i:s');

                $data_g = $this->db->query("SELECT * FROM guardians  WHERE student_id = '$id'");
                $guardian_d = $data_g->row();



                if ($this->db->query("INSERT INTO archived_students (`user_id` , `admission_no` , `admission_date` , `full_name` , `name_with_initials` , `dob` , `gender`, `language` , `religion` , `permanent_addr` , `contact_home` , `email` , `house_id` , `created_at`) 
    			VALUES ('$user_id' , '$admissionno', '$admissiondate' , '$fullname' , '$initials' , '$dob' , '$gender' , '$language' , '$religion_id' , '$address' , '$contact' , '$email' , '$house_id' , '$created_at')")) {

                    if ($data_g = $this->db->query("SELECT * FROM guardians  WHERE student_id = '$id'")) {
                        $guardian_data = $data_g->row();


                        $student_id = $guardian_data->student_id;
                        $fullname = $guardian_data->fullname;
                        $initials = $guardian_data->name_with_initials;
                        $dob = $guardian_data->dob;
                        $gender = $guardian_data->gender;
                        $occupation = $guardian_data->occupation;
                        $relation = $guardian_data->relation;
                        $pastpupil = $guardian_data->is_pastpupil;
                        $adddress = $guardian_data->addr;
                        $contact_home = $guardian_data->contact_home;
                        $contact_mobile = $guardian_data->contact_mobile;

                        if ($this->db->query("INSERT INTO archived_guardians (`student_id` , `fullname` , `name_with_initials` , `dob` , `gender` , `relation` , `occupation` , `addr` , `contact_home` , `contact_mobile`,`is_pastpupil` ) 
    			VALUES ('$student_id', '$fullname'  , '$initials' , '$dob' , '$gender' , '$relation' , '$occupation' , '$adddress' , '$contact_home' , '$contact_mobile','$pastpupil')")) {

                            $sql1 = "DELETE s,g FROM students AS s INNER JOIN guardians AS g ON s.user_id = g.student_id  WHERE  s.user_id = '$id'";

                            if ($query = $this->db->query($sql1)) {
                                return TRUE;
                            } else {
                                return FALSE;
                            }
                        }
                    
                }
            }
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }
    
    /*
     * getting the recode details of archived student by given id
     */

    public function get_archived_student_only($id) {
        try {
            if ($data = $this->db->query("SELECT * FROM archived_students  WHERE user_id = '$id'")) {
                $row = $data->row();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

}

?>