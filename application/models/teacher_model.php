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

    public function update_new_staff($regno, $ID, $serialno, $signatureno, $careerdate, $medium, $designation, $section, $mainsubject, $servicegrade, $appointment, $educational, $profession, $first_appointment, $fileno, $pension) {
        try {
            if ($this->db->query("UPDATE teachers SET `teacher_register_no` = '$regno', `serial_no` = '$serialno' , `signature_no` = '$signatureno' , `joined_date` = '$careerdate' , `medium` = '$medium' ,"
                            . " `designation_id` = '$designation' , `section` = '$section' , `main_subject_id` = '$mainsubject' , `grade` = '$servicegrade' , `nature_of_appointment` = '$appointment' , `educational_qualific`='$educational' ,"
                            . " `professional_qualific`='$profession' , `first_appointment_date`='$first_appointment' , `personal_file_no`='$fileno' , `pension_date`='$pension' WHERE id = '$ID' ")) {
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

    public function set_time($id, $time) {
        try {
            if ($data = $this->db->query("UPDATE `teachers` set `created_at` = '$time'  where `id` = '$id' ")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function set_user_id($ID, $userid) {
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

    public function update_new_teacher_userdata($username, $password, $create, $teacher_log_id) {
        try {
            $encryptpwd = md5($password);
            if ($this->db->query("UPDATE users SET `username` = '$username', `password` = '$encryptpwd' , `created_at` = '$create' , `user_type` = 'T' WHERE id = '$teacher_log_id' ")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    public function insert_new_teacher_userdata($username, $password, $create , $first_name , $last_name , $photo , $email) {
        try {
            $encryptpwd = md5($password);
            if ($this->db->query("INSERT INTO users (`username`, `password` , `created_at`, `user_type` , `first_name` , `last_name` , `profile_img` , `email`) VALUES ('$username', '$encryptpwd' , '$create', 'T' , '$first_name' , '$last_name' , '$photo' , '$email')")) {
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
        return $query->row();
    }

//get all teacher recodes    
    public function SearchAllTeachers() {

        $query = $this->db->query("SELECT * FROM teachers order by full_name asc");
        return $query->result();
    }

    //update teacher details
    public function UpdateTeacher($teacher, $myid) {
        $datestring = " %Y-%m-%d";
        $time = time();

        $updated_date = mdate($datestring, $time);


        $sql = "UPDATE teachers SET
                                    nic_no='{$teacher['nic']}',                 full_name='{$teacher['fullName']}',            name_with_initials='{$teacher['nameWithInitials']}', dob='{$teacher['birthday']}',
                                        gender='{$teacher['gender']}',          nationality_id='{$teacher['nationality']}',    religion_id='{$teacher['religion']}',                civil_status='{$teacher['civilStatus']}',
                                        permanent_addr='{$teacher['address']}', contact_mobile='{$teacher['contactMobile']}',  contact_home='{$teacher['contactHome']}',            email='{$teacher['email']}', 
                                        wnop_no='{$teacher['wnop']}',           serial_no='{$teacher['serial']}',              signature_no='{$teacher['signature']}',              joined_date='{$teacher['joinDate']}',
                                        medium='{$teacher['medium']}',          designation_id='{$teacher['designation']}',    section='{$teacher['section']}',                     main_subject_id='{$teacher['mainSub']}',
                                        grade='{$teacher['serviceGrade']}',     personal_file_no='{$teacher['personalFile']}', teacher_register_no='{$teacher['teacherRegNo']}',    service='{$teacher['service']}',
                                        remarks='{$teacher['remarks']}',        nature_of_appointment='{$teacher['nature']}',  educational_qualific='{$teacher['education']}',      professional_qualific='{$teacher['profession']}',       
                                        first_appointment_date='{$teacher['appointmentdate']}',    pension_date='{$teacher['pension']}',     increment_date='{$teacher['increment']}',    promotions='{$teacher['promotions']}',      updated_at='$updated_date'    
                WHERE id='$myid' ";
        // $sql = "UPDATE teachers SET nic_no='{$teacher['nic']}' WHERE id='$myid' ";

        if ($query = $this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //delete teacher
    public function DeleteTeacher($id) {
        $sql = "DELETE FROM archived_teachers WHERE id='$id'";
        if ($query = $this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Get teacher id from user id
    public function get_teacher_id($userid) {
        try {
            $query = $this->db->query("SELECT id FROM teachers WHERE user_id='$userid'");
            $row = $query->row();
            return $row->id;
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    public function get_section_teacher_details($section) {
        try {
            if ($data = $this->db->query("select * from teachers where section = '$section' ")) {
                $row = $data->result();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function upload_pic($id, $img) {
        try {
            if ($this->db->query("UPDATE teachers SET photo_file_name = '$img' WHERE id = '$id' ")) {
                return TRUE;
            }
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_profile_img($id) {
        $sql = "SELECT photo_file_name FROM teachers WHERE id='$id'";
        $query = $this->db->query($sql);

        return $query->row()->photo_file_name;
    }

    public function getTeacherUserId($id) {

        $query = $this->db->query("SELECT user_id FROM teachers WHERE id ='$id'");
        return $query->row()->user_id;
    }

    public function check_userid($teacher_log_id) {

        if ($this->db->query("SELECT * FROM users WHERE id = '$teacher_log_id'")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function archive_teacher($id) {

        try {
            if ($data_t = $this->db->query("SELECT * FROM teachers  WHERE user_id = '$id'")) {
                $teachr_data = $data_t->row();


                $NIC = $teachr_data->nic_no;
                $name = $teachr_data->full_name;
                $initial = $teachr_data->name_with_initials;
                $birth = $teachr_data->dob;
                $gender = $teachr_data->gender;
                $Nationality = $teachr_data->nationality_id;
                $religion = $teachr_data->religion_id;
                $civilstatus = $teachr_data->civil_status;
                $address = $teachr_data->permanent_addr;
                $contactMob = $teachr_data->contact_mobile;
                $contactHome = $teachr_data->contact_home;
                $email = $teachr_data->email;
                $widow = $teachr_data->wnop_no;

                if ($this->db->query("INSERT INTO archived_teachers(`id`,`nic_no`, `full_name`, `name_with_initials` , `dob` , `gender`, `nationality_id` , `religion_id` , `civil_status` , `permanent_addr` , `contact_mobile` , `contact_home` , `email` , `wnop_no`) 
    			VALUES ('$id','$NIC', '$name' , '$initial' , '$birth', '$gender' , '$Nationality' , '$religion' , '$civilstatus' , '$address' , '$contactMob' , '$contactHome' , '$email' , '$widow')")) {


                    $sql1 = "DELETE FROM teachers  WHERE id = '$id'";
                    if ($query = $this->db->query($sql1)) {
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                }
            } else {

                return FALSE;
            }
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function user_details($id) {
        $sql = "SELECT * FROM users WHERE id='$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function generate_report($type , $report){
        if($type == 1){
            $data = $this->db->query("select * from teachers where section = '$report' ");
            echo "<img src='".base_url('assets/img/dslogo.jpg')."' width='128px' height='128px' style='margin-left: 4em'>";
            echo "<h3 style='margin-bottom: 0; margin-left: 3em'>D.S Senanayake College</h3>";
            echo "<h5 style='margin-top: 0; margin-left: 5em'>Report - ";
            if ($report == 1) {
                echo '1/5';
            } else if ($report == 2) {
                echo '6/7';
            } else if ($report == 3) {
                echo '8/9';
            } else if ($report == 4) {
                echo '10/11';
            } else if ($report == 5) {
                echo 'A/L Science';
            } else if ($report == 6) {
                echo 'A/L Commerce';
            } else if ($report == 7) {
                echo 'A/L Arts';
            } else {
                echo '';
            } 
            echo "Section Teacher List</h5>";
            echo "<div class='row' style='margin-left: 5em'>
                    <table class='table table-hove'>
                    <thead>
                    <tr>
                        <th align='left' width='150px'>Signature No</th>
                        <th align='left' width='150px'>Name</th>
                        <th align='left' width='150px'>NIC</th>
                        <th align='left' width='150px'>Registered Date</th>
                    </tr>
                    </thead>
                    <tbody>";
            foreach ($data->result() as $row){
                echo "<tr>
                        <td>$row->signature_no;</td>
                        <td>$row->name_with_initials</td>
                        <td>$row->nic_no</td>
                        <td>$row->first_appointment_date</td>
                    </tr>";
            }
            echo "  </tbody>
                    </table>
                    </div>";
        }
        else{
            $data = $this->db->query("select * from `teachers` where `id` = $report");
            $result = $data->row();
            $propic = $this->get_profile_img($report);
            echo "<img src='".base_url('assets/img/dslogo.jpg')."' width='128px' height='128px' style='margin-left: 4em'>";
            echo "<img src='$propic' id='profile-img' class='img-thumbnail profile-img' style='height: 100px ; width: 100px ; margin-left: 12em ;'>";
            echo "<h3 style='margin-bottom: 0; margin-left: 3em'>D.S Senanayake College</h3>";
            echo "<h5 style='margin-top: 0; margin-left: 5em'>Teacher Report - $result->name_with_initials</h5>";
            echo "<div class='row' style='margin-left: 5em'>
                    <h3><u>Basic Details</u></h3>
                    <table class='table table-hover'>
                    <thead>
                    <tr>
                        <th align='left' width='50%'></th>
                        <th align='left' width='50%'></th>
                    </tr>
                </thead>
                <tbody>";
            echo "<tr>
                    <td>NIC</td>
                    <td>$result->nic_no</td>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td>$result->full_name</td>
                </tr>
                <tr>
                    <td>Name with Initials</td>
                    <td>$result->name_with_initials</td>
                </tr>
                <tr>
                    <td>Birthday</td>
                    <td>$result->dob</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>";
                    if ( $result->gender == 'm') {
                        echo 'Male';
                    } else if ( $result->gender == 'f') {
                        echo 'Female';
                    }
                    echo "</td>";
            echo "</tr>
                <tr>
                <td>Nationality</td>
                <td>";
                    if ($result->nationality_id == 1) {
                        echo "Sinhala";
                    } else if ($result->nationality_id == 2) {
                        echo "Sri Lankan Tamil";
                    } else if ($result->nationality_id == 3) {
                        echo "Indian Tamil";
                    } else if ($result->nationality_id == 4) {
                        echo "Muslim";
                    } else {
                        echo "Other";
                    }
               echo "</td>
                    </tr>
                    <tr>
                        <td>Religion</td>
                        <td>";
                    if ($result->religion_id == 1) {
                        echo "Buddhism";
                    } else if ($result->religion_id == 2) {
                        echo "Hindunism";
                    } else if ($result->religion_id == 3) {
                        echo "Islam";
                    } else if ($result->religion_id == 4) {
                        echo "Catholicism";
                    } else if ($result->religion_id == 5) {
                        echo "Christianity";
                    } else {
                        echo "Other";
                    }
            echo "</td>
                    </tr>
                    <tr>
                    <td>Civil Status</td>
                    <td>";
                    if ($result->civil_status == 's') {
                        echo "Single";
                    } else if ($result->civil_status == 'm') {
                        echo "Married";
                    } else if ($result->civil_status == 'w') {
                        echo "Widow";
                    } else {
                        echo "Other";
                    }
                    echo "</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>$result->permanent_addr
                </td>
            </tr>
            <tr>
                <td>Contact Mobile No</td>
                <td>$result->contact_home</td>
            </tr>
            <tr>
                <td>Widow & Orphan No</td>
                <td>$result->wnop_no</td>
            </tr>
        </tbody>
    </table>
    <h3><u>Academic Details</u></h3>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th align='left' width='50%'></th>
                <th align='left' width='50%'></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Register No</td>
                <td>$result->teacher_register_no</td>
            </tr>
            <tr>
                <td>Signature No</td>
                <td>$result->signature_no</td>
            </tr>
            <tr>
                <td>Serial No</td>
                <td>$result->serial_no</td>
            </tr>
            <tr>
                <td>Date Joined School</td>
                <td>$result->joined_date</td>
            </tr>
            <tr>
                <td>Medium</td>
                <td>";
                    if ($result->medium == 's') {
                        echo "Sinhala";
                    } else if ($result->medium == 'e') {
                        echo "English";
                    } else if ($result->medium == 't') {
                        echo "Tamil";
                    } else {
                        echo "";
                    }
                    
                echo "</td>
            </tr>
            <tr>
                <td>Designation</td>
                <td>";
                    if ($result->designation_id == 1) {
                        echo "Principal";
                    } else if ($result->designation_id == 2) {
                        echo "Acting Principal";
                    } else if ($result->designation_id == 3) {
                        echo "Deputy Principal";
                    } else if ($result->designation_id == 4) {
                        echo "Acting Deputy Principal";
                    } else if ($result->designation_id == 5) {
                        echo "Assistant Principal";
                    } else if ($result->designation_id == 6) {
                        echo "Acting Assistant Principal";
                    } else if ($result->designation_id == 7) {
                        echo "Teacher";
                    } else {
                        echo "";
                    }
                echo "</td>
            </tr>
            <tr>
                <td>Section</td>
                <td>";
                    if ($result->section == 1) {
                        echo "1/5";
                    } else if ($result->section == 2) {
                        echo "6/7";
                    } else if ($result->section == 3) {
                        echo "8/9";
                    } else if ($result->section == 4) {
                        echo "10/11";
                    } else if ($result->section == 5) {
                        echo "A/L Science";
                    } else if ($result->section == 6) {
                        echo "A/L Commerce";
                    } else if ($result->section == 7) {
                        echo "A/L Arts";
                    } else {
                        echo "";
                    }
                echo "</td>
            </tr>
            <tr>
                <td>Main Subject</td>
                <td>";
                    if ($result->main_subject_id == 1) {
                        echo "Maths";
                    } else if ($result->main_subject_id == 2) {
                        echo "Science";
                    } else if ($result->main_subject_id == 3) {
                        echo "Chemistry";
                    } else if ($result->main_subject_id == 4) {
                        echo "Physics";
                    } else if ($result->main_subject_id == 5) {
                        echo "Business Studies";
                    } else if ($result->main_subject_id == 6) {
                        echo "English";
                    } else if ($result->main_subject_id == 7) {
                        echo "History";
                    } else if ($result->main_subject_id == 8) {
                        echo "Information Technology";
                    } else if ($result->main_subject_id == 9) {
                        echo "Sinhala";
                    } else if ($result->main_subject_id == 10) {
                        echo "Mechanics";
                    } else if ($result->main_subject_id == 11) {
                        echo "Tamil";
                    } else if ($result->main_subject_id == 12) {
                        echo "Other";
                    } else {
                        echo "";
                    }
                echo "</td>
            </tr>
            <tr>
                <td>Service Garde</td>
                <td>";
                    if ($result->grade == 1) {
                        echo "Sri Lanka Education Administrative ServiceI";
                    } else if ($result->grade == 2) {
                        echo "Sri Lanka Education Administrative ServiceII";
                    } else if ($result->grade == 3) {
                        echo "Sri Lanka Education Administrative ServiceIII";
                    } else if ($result->grade == 4) {
                        echo "Sri Lanka Principal ServiceI";
                    } else if ($result->grade == 5) {
                        echo "Sri Lanka Principal Service2I";
                    } else if ($result->grade == 6) {
                        echo "Sri Lanka Principal Service2II";
                    } else if ($result->grade == 7) {
                        echo "Sri Lanka Principal Service3";
                    } else if ($result->grade == 8) {
                        echo "Sri Lanka Teacher ServiceI";
                    } else if ($result->grade == 9) {
                        echo "Sri Lanka Teacher Service2I";
                    } else if ($result->grade == 10) {
                        echo "Sri Lanka Teacher Service2II";
                    } else if ($result->grade == 11) {
                        echo "Sri Lanka Teacher Service3I";
                    } else if ($result->grade == 12) {
                        echo "Sri Lanka Teacher Service3II";
                    } else if ($result->grade == 13) {
                        echo "Sri Lanka Teacher Service Pending";
                    } else {
                        echo "";
                    }
                echo "</td>
            </tr>
            <tr>
                <td>Nature of Appointment</td>
                <td>";
                    if ($result->nature_of_appointment == 1) {
                        echo "Degree";
                    } else if ($result->nature_of_appointment == 2) {
                        echo "Diploma";
                    } else if ($result->nature_of_appointment == 3) {
                        echo "Trained";
                    } else if ($result->nature_of_appointment == 4) {
                        echo "Other";
                    } else {
                        echo "";
                    }
                echo "</td>
            </tr>
            <tr>
                <td>Educational Qualifications</td>
                <td>$result->educational_qualific</td>
            </tr>
            <tr>
                <td>Professional Qualifications</td>
                <td>$result->professional_qualific</td>
            </tr>
            <tr>
                <td>First Appointment Date</td>
                <td>$result->first_appointment_date</td>
            </tr>
            <tr>
                <td>Due Pension Date</td>
                <td>$result->pension_date</td>
            </tr>
            </table>
        </div>";
        }
        
    }
    
    public function get_teacher_list(){
        $sql = "SELECT `id`, `full_name` FROM teachers ORDER BY `id`";
        return $this->db->query($sql)->result();
    }
    
    public function get_teacher_name($teacher_id){
        $sql = "SELECT name_with_initials FROM teachers WHERE id='{$teacher_id}'";
        return $this->db->query($sql)->row();
    }

}