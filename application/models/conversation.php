<?php

class Conversation extends DataMapper {

    var $table = "conversations"; 
    var $has_many = array('message');
    var $has_one = array('user');

    function __construct($recipe_id = NULL)
    {
        parent::__construct($recipe_id);
    }

    /*
        Memperoleh semua pesan pada sebuah conversation, $read jika true maka $user_id yang mengakses akan ditambahkan kedalam daftar read dari message
    */
    function getAllMessages($conversation_id=null, $user_id=null, $limit=10, $offset=0, $read=false){
        if(empty($conversation_id)){
            $conversation_id = $this->conversation_id;
        }
        if(!empty($conversation_id) && !empty($user_id)){
            $this->where("conversation_id", $conversation_id);
            $this->where("user_id", $user_id);
            if($this->count() > 0){
                $messages = new Message();  
                $messages->order_by("submit","desc");
                $messages->limit($limit);
                $messages->get_where(array("conversation_id"=>$conversation_id), $limit, $offset);
                $listMessages = array();
                foreach ($messages as $message) {
                    $data = new stdClass();
                    $data->id = $message->id;
                    $data->description = $message->description;
                    $data->submit = $message->submit;
                    array_push($listMessages, $data);
                }    
                if($read){
                    $messages->clear();
                    $messages->where("conversation_id",$conversation_id);
                    $messages->not_ilike("read",$user_id);
                    $messages->get();
                    $msg = new Message();
                    foreach ($messages as $message) {
                        $msg->where("message_id", $message->message_id);
                        if(!$msg->update("read",$message->read."|".$user_id."|")){
                            return false;
                        }
                        $msg->clear();
                    }
                }
                return $listMessages;
            }
            return false;
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
                $conversation->where("conversation_id", $conversation_id);
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
        Menabahkan conversation user_id dapat berupa array
    */
    function addConversation($subject="", $user_id=null){
        if(!empty($user_id)){
            if(is_array($user_id)){
                if(empty($subject)){
                    $u = new User_model();
                    $x=0;
                    foreach ($user_id as $user) {
                        if($x==0){
                            $subject += $u->getProfile($user)->name;
                        }
                        else{
                            $subject += ", ".$u->getProfile($user)->name;
                        }
                    }
                }
                foreach ($user_id as $user) {
                    $this->clear();
                    $this->subject = $subject;
                    $this->user_id = $user;
                    if(!$this->skip_validation()->save()){
                        return false;
                    }         
                }
                return true;
            }
            else{
                if(empty($subject)){
                    $subject += $u->getProfile($user_id)->name;
                } 
                $this->clear();
                $this->subject = $subject;
                $this->user_id = $user_id;
                return $this->skip_validation()->save();
            }
        }
        return false
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */