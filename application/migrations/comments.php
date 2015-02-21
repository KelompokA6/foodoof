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
			'user_id' => array(
				'type' => 'INT',
				'null' => TRUE
			),
			'recipe_id' => array(
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
		$this->dbforge->add_foreign_key(array('field' => 'user_id', 'foreign_table' => 'users', 'foreign_field' => 'user_id'));
		$this->dbforge->add_foreign_key(array('field' => 'recipe_id', 'foreign_table' => 'recipes', 'foreign_field' => 'recipe_id'));
		$this->dbforge->create_table('comments');
	}

	public function down()
	{
		$this->dbforge->drop_table('comments');
	}
}
?>