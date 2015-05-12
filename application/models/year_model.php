<?php
class Year_Model extends CI_Model {
	//loading database on class creationorderMainAddress
	public function __construct() {
			$this->load->database();
	}


    //Add New Adcademic Year
    public function add_new_academic_year($name, $start_date, $end_date, $status, $t1_start_date, $t1_end_date, $t2_start_date, $t2_end_date, $t3_start_date, $t3_end_date, $structure){
        try {
            if($this->db->query("INSERT INTO year_plan ( `name`, `start_date`, `end_date`, `status`, `t1_start_date`, `t1_end_date`, `t2_start_date`, `t2_end_date`, `t3_start_date`, `t3_end_date`, `structure`)
                VALUES ('$name', '$start_date', '$end_date','$status', '$t1_start_date', '$t1_end_date', '$t2_start_date','$t2_end_date', '$t3_start_date' ,'$t3_end_date', '$structure');")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //update Academic Year
    public function update_academic_year($id,$name, $start_date, $end_date, $status, $t1_start_date, $t1_end_date, $t2_start_date, $t2_end_date, $t3_start_date, $t3_end_date, $structure){
        try {
            if($this->db->query("UPDATE year_plan SET `name` = '$name', `start_date` = '$start_date', `end_date` = '$end_date', `status` = '$status', `t1_start_date` = '$t1_start_date', `t1_end_date` = '$t1_end_date', `t2_start_date` = '$t2_start_date', `t2_end_date` = '$t2_end_date', `t3_start_date` = '$t3_start_date', `t3_end_date` = '$t3_end_date', `structure` ='$structure'
                WHERE `id` = '$id' ")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //update year holiday
    public function update_holiday($id, $structure){
        try {
            if($this->db->query("UPDATE year_plan SET `structure` ='$structure'
                WHERE `id` = '$id' ")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch(Exception $ex) {
            return FALSE;
        }
    }


    //Get current Academic Year Details
    public function get_academic_year_details(){
        try{
            $query = $this->db->query("SELECT * FROM year_plan where status = '1' LIMIT 1");

            return $query->result();
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Get All Academic Years List
    public function get_all_academic_years(){
        try{
            $query = $this->db->query("SELECT * FROM year_plan ORDER BY start_date desc");

            return $query->result();
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Get Academic Year by ID
    public function get_academic_year_by_id($id){
        try{
            $query = $this->db->query("SELECT * FROM year_plan where id = $id");

            return $query->result();
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Get Year Structure by ID
    public function year_structure($id){
        try{
            $query = $this->db->query("SELECT * FROM year_plan where id = $id");
            foreach ($query->result() as $row){
                return $row->structure;
            }
            
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Start of temp date functions

    //Adding Temp Date Values
    public function add_temp_dates($year_id, $date, $status)
    {
        try {
            if($this->db->query("INSERT INTO year_plan_temp_date ( `year_id`, `date`, `status`)
                VALUES ('$year_id', '$date', '$status');")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Deleting Temp Date
    public function delete_temp_date($id){
        
        try {
            if($this->db->query("DELETE FROM year_plan_temp_date WHERE id = '$id' ")) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Get Temp Date id
    public function get_temp_dates_id($year_id,$date){
        try{
            $query = $this->db->query("SELECT * FROM year_plan_temp_date where year_id = '$year_id' and date = '$date'");
            foreach ($query->result() as $row){
                return $row->id;
            }
        } catch(Exception $ex) {
            return FALSE;
        }
    }

    //Get Temp Date values
    public function get_temp_dates($year_id,$date){
        try{
            $query = $this->db->query("SELECT * FROM year_plan_temp_date where year_id = '$year_id' and date = '$date'");
            foreach ($query->result() as $row){
                return $row->status;
            }
        } catch(Exception $ex) {
            return FALSE;
        }
    }
    //End of Temp Date functions

}
?>