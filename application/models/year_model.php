<?php
class Year_Model extends CI_Model {
	//loading database on class creationorderMainAddress
	public function __construct() {
			$this->load->database();
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

}
?>