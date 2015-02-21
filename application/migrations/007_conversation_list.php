<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Conversation_list extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'message_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'reciever_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
		));
		$this->dbforge->add_key('message_id', TRUE);
		$this->dbforge->add_key('reciever_id', TRUE);
		$this->dbforge->create_table('conversationsList');
		$this->db->query("ALTER TABLE conversationsList ADD FOREIGN KEY (message_id) REFERENCES conversations (message_id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE conversationsList ADD FOREIGN KEY (reciever_id) REFERENCES users (user_id) ON DELETE CASCADE ON UPDATE CASCADE");
	}

	public function down()
	{
		$this->dbforge->drop_table('conversations-list');
	}
}
?>