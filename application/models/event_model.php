<?php

class Event_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Create a new event
     */
    function insert_sport_event($event_name, $event_type, $description, $start_date, $start_time, $end_date, $end_time, $in_charge, $budget , $loc , $guest) {
        try {

            if ($this->db->query("INSERT INTO events(`title`,`event_type`,`description`,`start_date`,`start_time`,`end_date`,`end_time`,`status` , `in_charge_id` , `budget` , `location` , `guest`) VALUES('$event_name','$event_type','$description','$start_date','$start_time','$end_date','$end_time','pending' , '$in_charge' , '$budget' , '$loc' , '$guest')")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    /**
     * Create new event type
     */
    function insert_new_event_type($type, $description) {

        try {

            if ($this->db->query("INSERT INTO event_type(`event_type`,`description`) VALUES('$type' , '$description')")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            
        }
    }

    /**
     * Update the event
     */
    function update_event($event_id, $event_name, $event_type, $description, $start_date, $start_time, $end_date, $end_time, $in_charge, $budget , $location , $guest) {

        try {

            if ($this->db->query("UPDATE events SET title='$event_name' , description='$description' , start_time='$start_time' , end_time='$end_time' , in_charge_id='$in_charge' , start_date='$start_date' , end_date='$end_date' , budget='$budget' , location='$location' , guest='$guest' , event_type='$event_type' where id='$event_id'")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            
        }
    }

    /**
     * Cancel the event. Only admin can cancel a event
     */
    function cancel_event($id) {

        try {

            if ($this->db->query("UPDATE events SET `status` = 'cancelled'  WHERE `id` = '$id'")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            
        }
    }

    /**
     * Get pending event details
     */
    public function get_pending_event_details() {
        $today = date('Y-m-d');
        try {
            if ($data = $this->db->query("select * from `events`")) {
                $row = $data->result();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_approved_event_details($id) {
        try {
            if ($data = $this->db->query("select * from `events` where id = '$id'")) {
                $row = $data->row();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_event_type_details() {
        try {
            if ($data = $this->db->query("select * from `event_type`")) {
                $row = $data->result();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_upcoming_events($today) {
        try {

            if ($data = $this->db->query("select * from `events` where start_date >= '$today' and status = 'approved'")) {
                $row = $data->result();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_upcoming_event_single_details($id) {
        try {
            if ($data = $this->db->query("select * from `events` where id = '$id'")) {
                $row = $data->row();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_pending_events_to_approve() {
        try {
            if ($data = $this->db->query("select * from `events` where `status` = 'pending' limit 10")) {
                $row = $data->result();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_canceled_events() {
        try {
            if ($data = $this->db->query("select * from `events` where `status` = 'rejected' limit 10")) {
                $row = $data->result();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function load_pending_events($id) {
        try {
            if ($data = $this->db->query("select * from `events` where id = '$id'")) {
                $row = $data->row();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function approve_event($id) {
        try {
            if ($this->db->query("update events set status = 'approved' where id = '$id'")) {
                return TRUE;
            }
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function reject_event($id) {
        try {
            if ($this->db->query("update events set status = 'rejected' where id = '$id'")) {
                return TRUE;
            }
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_monthly_events($month) {
        //Get all monthly events in order to check 
        try {
            if ($data = $this->db->query("select * from `events` where DATE_FORMAT(start_date, '%m-%Y') = '$month' and status = 'approved'")) {
                $row = $data->result();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_completed_events($today) {
        //Get all monthly events in order to check 
        try {
            if ($data = $this->db->query("select * from `events` where end_date < '$today' and status = 'approved'")) {
                $row = $data->result();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_all_events() {
        //Get all events in order to check 
        try {
            if ($data = $this->db->query("select * from `events` where status = 'approved'")) {
                $row = $data->result();
                return $row;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_event_types() {
        //this method is used to get all the events that are currently using in school
        try {
            if ($data = $this->db->query("select * from event_type")) {
                $row = $data->result();
                return $row;
            }
        } catch (Exception $exc) {
            return null;
        }
    }

    public function validate_teacher_id($id) {
        try {
            if ($data = $this->db->query("select nic_no from teachers where nic_no = '$id'")) {
                return $data->row();
            } else {
                return NULL;
            }
        } catch (Exception $exc) {
            return NULL;
        }
    }

    public function delete_event_type($id) {
        try {
            if ($this->db->query("delete from event_type where id='$id'")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_event_type_to_update($id) {
        try {
            if ($data = $this->db->query("select * from event_type where id = '$id'")) {
                $row = $data->row();
                return $row;
            }
        } catch (Exception $ex) {
            return NULL;
        }
    }

    public function update_event_type($id, $type, $description) {
        try {
            if ($this->db->query("update event_type set event_type = '$type' , description = '$description' where id = '$id'")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            
        }
    }

    //get count of upcoming events
    public function get_count_upcoming_events($today) {
        try {
            if ($data = $this->db->query("select count(*) as count from `events` where start_date >= '$today' and status = 'approved'")) {
                $row = $data->row();
                return $row->count;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function get_logged_user_nic($user) {
        try {
            if($data=  $this->db->query("select nic_no from teachers where user_id='$user'")){
                return $data->row()->nic_no;
            }
        } catch (Exception $exc) {
            return NULL;
        }
    }

}
