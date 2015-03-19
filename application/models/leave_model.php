<?php
class leave_model extends CI_Model {
	//loading database on class creationorderMainAddress
	public function __construct() {
			$this->load->database();
	}
	// Test Function
	public function getTest() {
		$query = $this->db->query("SELECT * FROM `test`.`staff` ");
		return $query->result_array();
	}

    //Get Leave types table
    public function get_leave_types(){
        try{
            $query = $this->db->query("SELECT * FROM `leave_types`");
            return $query->result();
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Get a list of applied leaves according to the teacher id
    public function get_applied_leaves_list($uid){
        try{
            $query = $this->db->query("SELECT lt.name,al.applied_date,al.start_date,al.end_date,al.no_of_days,ls.status FROM apply_leaves al,leave_types lt,leave_status ls where (al.id = lt.id) AND al.leave_status = ls.id AND al.user_id='$uid' ORDER BY al.applied_date desc LIMIT 5");
//            $query = $this->db->query("SELECT lt.name,al.applied_date,al.start_date,al.end_date,al.no_of_days,al.leave_status FROM apply_leaves al,leave_types lt where (al.id = lt.id)");
            return $query->result();
        } catch(Exception $ex) {
            return FALSE;
        }
    }
	//Get max leave count according to the name
	public function get_max_leave_count($name){
		try {
			$query = $this->db->query("SELECT max_leave_count FROM `leave_types` WHERE name='$name'");
            $row = $query->row();
            return $row->max_leave_count;
			
		} catch (Exception $ex) {
			return FALSE;
		}
	}

    //Get No of leaves applied by a person Make sure to use user id
    public function get_no_leaves($leave_type, $uid){
        try {
            $query = $this->db->query("SELECT sum(no_of_days) as days FROM `apply_leaves` WHERE user_id = '$uid' AND leave_type_id = '$leave_type'");
            $row = $query->row();
            return $row->days;
            
        } catch (Exception $e) {
            return FALSE;
        }
    }
    //Get teacher id by userid
    function get_teacher_id($uid){
        try{
            $query = $this->db->query("SELECT id FROM teachers WHERE user_id='$uid'");
            $row = $query->row();
            return $row->id;
        } catch (Exception $ex) {
            return FALSE;
        }
    }

	//Apply for leave
	public function apply_for_leave($user_id, $teacher_id, $leave_type_id, $applied_date, $start_date, $end_date, $reason, $no_of_days){
		try {
    		if($this->db->query("INSERT INTO apply_leaves (`id`, `user_id`, `teacher_id`, `leave_type_id`, `is_half_day`, `applied_date`, `start_date`, `end_date`, `reason`, `leave_status`, `remarks`, `no_of_days`)
                VALUES (NULL ,'$user_id', '$teacher_id', '$leave_type_id','0' ,'$applied_date', '$start_date', '$end_date', '$reason','0',NULL ,'$no_of_days');")) {
    			return TRUE;
    		} else {
    			return FALSE;
    		}
    	} catch(Exception $ex) {
    		return FALSE;
    	}
	}

    //Get a list of pending leaves
    public function get_list_of_pending_leaves(){
        try {
            $query = $this->db->query("SELECT t.full_name, al.id, al.user_id,al.leave_type_id,al.applied_date,al.start_date,al.end_date,al.reason FROM apply_leaves al,teachers t WHERE al.user_id = t.user_id AND al.leave_status = '0' ORDER BY al.applied_date desc");
            return $query->result();

        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Get a single leave details
    public function get_leave_details($id){
        try {
            $query = $this->db->query("SELECT t.full_name, al.id, al.user_id,lt.name,al.applied_date,al.start_date,al.end_date,al.reason,al.no_of_days,ls.status FROM apply_leaves al,teachers t, leave_types lt, leave_status ls WHERE al.leave_status=ls.id AND al.id = '$id' AND al.user_id = t.user_id AND lt.id = al.leave_type_id");
            return $query->result();

        } catch(Exception $ex) {
            return FALSE;
        }
    }
    //Approve Leave by ID
    public function approve_leave($id){
        try {
            if($this->db->query("UPDATE apply_leaves SET leave_status='1',remarks='Leave Approved' WHERE id = '$id'")){
                return TRUE;
            } else{
                return FALSE;
            }
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Reject Leave by ID
    public function reject_leave($id){
        try {
            if($this->db->query("UPDATE apply_leaves SET leave_status='2',remarks='Leave Reject' WHERE id = '$id'")){
                return TRUE;
            } else{
                return FALSE;
            }
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Get a list of applied leaves according to the teacher id
    public function get_all_leaves($limit){
        try{
            $query = $this->db->query("SELECT * FROM apply_leaves ORDER BY applied_date desc LIMIT $limit ");
            return $query->result();
        } catch(Exception $ex) {
            return FALSE;
        }
    }
}
?>