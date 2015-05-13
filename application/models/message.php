<?php

class Message extends DataMapper {

    var $table = "messages"; 
    var $has_one = array('conversation');

    function __construct($recipe_id = NULL)
    {
        parent::__construct($recipe_id);
    }

    function addMessage($conversation_id=null, $description="", $sender=null){
    	if(!empty($conversation_id) && !empty($sender)){
            $now = date("Y-m-d H:i:s");
    		$this->conversation_id = $conversation_id;
    		$this->description = $description;
    		$this->submit = $now;
            $this->sender_id = $sender;
    		if($this->skip_validation->save()){
    			$this->clear();
                $conversation = new Conversation();
                $conversation->where("id", $conversation_id)->update("submit", $now);
    			return true;
    		}
    		else{
    			$this->clear();
    			return false;
    		}
    	}
    	else{
    		return false;
    	}
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */