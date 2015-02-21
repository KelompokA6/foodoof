<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Conversations extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'message_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'sender_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'message_description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'message_submit' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('message_id', TRUE);
		$this->dbforge->create_table('conversations');
		$this->db->query("ALTER TABLE conversations ADD FOREIGN KEY (sender_id) REFERENCES users (user_id) ON DELETE CASCADE ON UPDATE CASCADE");
	}

	public function down()
	{
		$this->dbforge->drop_table('conversations');
	}
}
?>