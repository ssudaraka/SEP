<?php

class Messages_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*
     * Create's a new conversation and add the first message to the database.
     */
    public function new_conversation($sender, $receiver, $subject, $message) {
        $conversation = array(
            'sender_id' => $sender,
            'receiver_id' => $receiver,
            'subject' => $subject,
            'created_time' => date("Y-m-d H:i:s"),
            'last_updated_time' => date("Y-m-d H:i:s")
        );

        /*
         * Inserting new conversation into the database
         */
        $this->db->insert('inbox_conversations', $conversation);
        $conversation['id'] = $this->db->insert_id();
        
        $message = array(
            'conversation_id' => $conversation['id'],
            'created_time' => date("Y-m-d H:i:s"),
            'sender_id' => $sender,
            'receiver_id' => $receiver,
            'content' => $message,
        );
        
        /*
         * Inserting the first message related to the new conversation
         */
        $this->db->insert('inbox_conversations', $conversation);
        $conversation['message_id'] = $this->db->insert_id();
        return $conversation;
    }
    
    public function get_sent_list($user_id){
        $query = $this->db->get_where('inbox_conversations', array('sender_id' => $user_id, 'sender_deleted' => 0));
        return $query->result();
    }
    
    public function get_received_list($user_id){
        $query = $this->db->get_where('inbox_conversations', array('receiver_id' => $user_id, 'receiver_deleted' => 0));
        return $query->result();
    }
    

}
