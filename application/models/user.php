<?php

class User extends CI_Model {

    public function login($username, $password) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    public function get_details($user_id){
        $query = $this->db->query("SELECT first_name, last_name FROM users WHERE id='{$user_id}' LIMIT 1");
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return FALSE;
        }
        
    }
    
    public function change_password($user_id, $new_password){
        $hashed_password = md5($new_password);
        $query = "UPDATE users SET password='{$hashed_password}' WHERE id='{$user_id}'";
        $result = $this->db->query($query);
        
        if(!$result){
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function get_password_hash($user_id){
        $query = $this->db->query("SELECT password FROM users WHERE id='{$user_id}'");
        $row = $query->row();
        return $row->password;
    }

}
