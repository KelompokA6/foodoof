<?php

class Conversation extends DataMapper {

    var $table = "conversations"; 
    var $has_many = array('message');
    var $has_one = array('user');

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    /*
        Memperoleh semua pesan pada sebuah conversation
    */
    function getAllMessages($conversation_id=null, $user_id=null, $flag_read=false, $limit=20, $offset=0){
        if(empty($conversation_id)){
            $conversation_id = $this->conversation_id;
        }
        if(!empty($conversation_id) && !empty($user_id)){
            $this->where("id", $conversation_id);
            $this->where("user_id", $user_id);
            if($this->count() > 0){
                $messages = new Message();  
                $messages->order_by("submit","desc");
                $messages->limit($limit);
                $messages->get_where(array("conversation_id"=>$conversation_id), $limit, $offset);
                $listMessages = array();
                foreach ($messages as $message) {
                    $data = new stdClass();
                    $data->id = $message->message_id;
                    $data->description = $message->description;
                    $data->submit = $message->submit;
                    $data->sender_id = $message->sender_id;
                    array_push($listMessages, $data);
                }
                $messages->clear();
                if($flag_read){
                    $messages->where("conversation_id", $conversation_id)->not_ilike("read","|".$user_id."|")->get();
                    $msg = new Message();
                    foreach ($messages as $message) {
                        $msg->where("message_id", $message->message_id);
                        $msg->update("read", $message->read."|".$user_id."|");
                    }        
                }
                return $listMessages;
            }
            return false;
        }
        return false;
    }

    /*
        Memperoleh jumlah message yang belum terbaca dari sebuah conversation
    */
    function getCountUnreadMessage($conversation_id=null, $user_id=null){
        if(empty($conversation_id)){
            $conversation_id = $this->conversation_id;
        }
        if(!empty($conversation_id) && !empty($user_id)){
            $this->where("id", $conversation_id);
            $this->where("user_id", $user_id);
            if($this->count() > 0){
                $messages = new Message();
                $messages->where("conversation_id", $conversation_id)->not_ilike("read", "|".$user_id."|");
                return $messages->count();
            }
        }
        return false;
    }

    /*
        Memperoleh list id user dari conversation tersebut
    */
    function getMembers($conversation_id=null, $user_id=null){
        if(empty($conversation_id)){
            $conversation_id = $this->conversation_id;
        }
        if(!empty($conversation_id) && !empty($user_id)){
            $conversation = new Conversation();
            $conversation->where("id", $conversation_id);
            $conversation->where("user_id", $user_id);
            if($conversation->count() > 0){
                $conversation->clear();
                $conversation->where("id", $conversation_id);
                $conversation->where("user_id !=", $user_id);
                $conversation->get();
                $listUser = array();
                foreach ($conversation as $conv) {
                    array_push($listUser, $conv->user_id);
                }
                return $listUser;
            }
            return false;
        }
        return false;
    }
    /*
        Menambahkan conversation user_id dapat berupa array, jika user_id tidak berupa array maka conversation_id harus ada
    */
    function addConversation($subject="", $user_id=null, $conversation_id=null){
        if(!empty($user_id)){
            if(empty($conversation_id)){
                $this->subject = $subject;
                $this->user_id = $user_id;
                if($this->skip_validation()->save()){
                    return $this->db->insert_id();
                }
                else{
                    return false;
                }
            }
            else{
                $sql = "INSERT INTO `foodoof`.`conversations` (`id`, `user_id`, `submit`, `subject`) VALUES ('".$conversation_id."', '".$user_id."', CURRENT_TIMESTAMP, '".$subject."')";
                return $this->db->query($sql);
            }
        }
        return false;      
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */