<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Comments extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'comment_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'id_user' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'id_recipe' => array(
				'type' => 'INT',
				'null' => TRUE
			),
			'comment_description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'comment_submit' => array(
				'type' => 'TIMESTAMP',
				'default' => 'CURRENT_TIMESTAMP';
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('comment_id', TRUE);
		$this->dbforge->create_table('comments');
	}

	public function down()
	{
		$this->dbforge->drop_table('comments');
	}
}
?>