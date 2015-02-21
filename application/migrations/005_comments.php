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
				'unsigned' => TRUE,
			),
			'recipe_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'comment_description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'comment_submit' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('comment_id', TRUE);
		$this->dbforge->create_table('comments');
		$this->db->query("ALTER TABLE comments ADD FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE comments ADD FOREIGN KEY (recipe_id) REFERENCES recipes (recipe_id) ON DELETE CASCADE ON UPDATE CASCADE");
	}

	public function down()
	{
		$this->dbforge->drop_table('comments');
	}
}
?>