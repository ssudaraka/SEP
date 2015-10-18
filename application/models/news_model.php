<?php

class News_Model extends CI_Model {

    //loading database on class creationorderMainAddress
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }
/*
 * Here all the activity details that have been perfomed by users are recorded in database
 */
    public function insert_action_details($id, $action, $propic, $username) {
        $create = date('Y-m-d H:i:s');
        $this->db->query("insert into user_logs(user_id,content,created_at,pro_img,user_fullname) values('$id','$action','$create','$propic','$username')");
    }
/*
 * In this function all the news details are retrieving in descending order
 */
    public function get_news_details() {
        $data = $this->db->query("select * from user_logs order by id desc");
        return $data->result();
    }
/*
 * In this function all the activities are retrieved and set to the view using ajax call
 */
    public function get_teacher_activities($tech_id) {
        $data = $this->db->query("select * from user_logs where user_id = '$tech_id'");

        foreach ($data->result() as $row) {
            echo "<tr>
                                <td><img src='$row->pro_img' id='profile-img' class='img-thumbnail profile-img' style='height: 40px; width: 50px'></td>
                                <td>$row->id</td>
                                <td>$row->user_fullname</td>
                                <td>$row->content</td>
                                <td>$row->created_at</td>
                            </tr>";
        }
        exit;
    }
/*
 * This functio is used to clear the history(activity) details for today,last week,this month and all
 */
    public function clear($type) {
        if ($type == 1) {
            $today = date('Y-m-d');
            $this->db->query("delete from user_logs where created_at like '$today%'");
        }
        else if($type == 2){
           // $today = date('Y-m-d');
            $today=date('d');
            $yr_mnth = date('Y-m');
            $month=date('m');
            $year=date('Y');
            $date = date('d')-7;
            $this->db->query("delete from user_logs where day(created_at) between '$date' and '$today' and month(created_at) = '$month' and year(created_at) = '$year'");
        }
        else if($type == 3){
            $thismonth = date('Y-m');
            $this->db->query("delete from user_logs where created_at like '$thismonth%'");
        }
        else if($type == 4){
            $this->db->query("delete from user_logs");
        }
        
        $data = $this->db->query("select * from user_logs");
        foreach ($data->result() as $row) {
            echo "<tr>
                                <td><img src='$row->pro_img' id='profile-img' class='img-thumbnail profile-img' style='height: 40px; width: 50px'></td>
                                <td>$row->id</td>
                                <td>$row->user_fullname</td>
                                <td>$row->content</td>
                                <td>$row->created_at</td>
                            </tr>";
        }
        exit;
    }
    /*
     * This function is used to record news details
     */
    public function create_news($news_name, $description){
        $created_time = date('Y-m-d H:i:s');
        $this->db->query("insert into news_blog(name,description,create_at) values('$news_name','$description','$created_time')");
        return TRUE;
    }
    
    public function get_all_news_details(){
        $data = $this->db->query("select * from news_blog order by id desc");
        return $data->result();
    }
    
    public function get_particular_news($id){
        $data = $this->db->query("select * from news_blog where id='$id'");
        return $data->row();
    }
    
    public function update_news($news_id , $news_name, $description){
        $this->db->query("update news_blog set name = '$news_name' , description = '$description' where id = '$news_id'");
        echo'<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Updated Successfully</div>';
        exit;
    }
    
    public function delete_news($id){
        $this->db->query("delete from news_blog where id='$id'");
        return TRUE;
    }

}
