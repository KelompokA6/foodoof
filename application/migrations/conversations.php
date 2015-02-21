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
				'null' => TRUE
			),
			'message_description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'message_submit' => array(
				'type' => 'TIMESTAMP',
				'default' => 'CURRENT_TIMESTAMP';
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('message_id', TRUE);
		$this->dbforge->add_foreign_key(array('field' => 'sender_id', 'foreign_table' => 'users', 'foreign_field' => 'user_id'));
		$this->dbforge->create_table('conversations');
	}

	public function down()
	{
		$this->dbforge->drop_table('conversations');
	}
}
?>