<?php

class User extends CI_Model {

    public function login($username, $password) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_details($user_id) {
        $query = $this->db->query("SELECT * FROM users WHERE id='{$user_id}' LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

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

    public function get_password_hash($user_id) {
        $query = $this->db->query("SELECT password FROM users WHERE id='{$user_id}'");
        $row = $query->row();
        return $row->password;
    }

    public function update_info($update_data) {
               
        $query = "UPDATE users SET first_name='{$update_data['first_name']}', last_name='{$update_data["last_name"]}', profile_img='{$update_data['image']}' WHERE id='{$update_data['user_id']}'";
        $result = $this->db->query($query);

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function create($new_user_data, $user_type) {
        $this->load->helper('date');
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        $created_at = mdate($datestring, $time);

        $username = $new_user_data['username'];
        $email = $new_user_data['email'];
        $first_name = $new_user_data['first_name'];
        $last_name = $new_user_data['last_name'];
        $password = $new_user_data['password'];
        $sql = "INSERT INTO users (username, password, first_name, last_name, email, user_type, created_at";

        if ($user_type === "A") {
            $sql .= ", superuser";
        }

        $sql .= ") VALUES ('{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$email}', '{$user_type}', '{$created_at}'";

        if ($user_type === "A") {
            $sql .= ", 1";
        }

        $sql .= ")";

        $result = $this->db->query($sql);

        if (!$result) {
            return FALSE;
        } else {
            return $this->db->insert_id();
        }
    }

    public function get_user_list($user_type) {
        $sql = "SELECT * FROM users WHERE user_type = '$user_type'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_user_total() {
        $sql = "SELECT * FROM users";
        $query = $this->db->query($sql);

        return $query->num_rows();
    }

    public function delete($user_id) {
        $sql = "DELETE FROM users WHERE id='{$user_id}'";
        $query = $this->db->query($sql);

        if ($query) {
            return TRUE;
        }
    }

    public function get_profile_img($user_id) {
        $sql = "SELECT profile_img FROM users WHERE id='{$user_id}'";
        $query = $this->db->query($sql);

        return $query->row()->profile_img;
    }
    
    public function force_strong_password(){
        $sql = "SELECT is_strong_password FROM system_config";
        $query = $this->db->query($sql);
        $row = $query->row();
        
        if($row->is_strong_password == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
    