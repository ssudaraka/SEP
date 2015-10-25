<?php
class Email_Model extends CI_Model {
	//loading database on class creationorderMainAddress
	public function __construct() {
			$this->load->database();
	}

    // This function sends a basic email to a when you pass user id, message, and subject
    public function send_basic_email($userid, $messagestring, $messagesubject){
        $config = Array(
                'mailtype' => 'html',
                'charset'  => 'utf-8',
                'priority' => '1'
            );

        // Get useremail by ID
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $userid);
        $this->db->limit(1);

        $query = $this->db->get();
        $row = $query->row();
        $email = $row->email;

        // Fail if user email is null
        if($email != null){
            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->from('admin@projectecole.com', 'Ecole Admin');
            $this->email->to($email); 
            $this->email->subject($messagesubject);

            // Passing to View
            $data['user'] = array('message' => $messagestring, 'subject' => $messagesubject);
            $message = $this->load->view('email/leave',$data,true);
            $this->email->message($message); 

            // Send Email
            $this->email->send();

            return true;
        }else{
            return false;
        }
    }
}
?>