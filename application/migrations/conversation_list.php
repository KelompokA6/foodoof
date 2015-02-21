<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Conversations_List extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'message_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'reciever_id' => array(
				'type' => 'INT',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('message_id', TRUE);
		$this->dbforge->add_key('id_reciever', TRUE);
		$this->dbforge->add_foreign_key(array('field' => 'reciever_id', 'foreign_table' => 'users', 'foreign_field' => 'user_id'));
		$this->dbforge->create_table('conversations-list');
	}

	public function down()
	{
		$this->dbforge->drop_table('conversations-list');
	}
}
?>