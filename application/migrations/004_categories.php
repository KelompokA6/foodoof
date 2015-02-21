<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Categories extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'category_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('category_name', TRUE);
		$this->dbforge->create_table('categories');
		$this->db->query("ALTER TABLE categories ADD FOREIGN KEY (id) REFERENCES recipes(recipe_id) ON DELETE CASCADE ON UPDATE CASCADE");
	}

	public function down()
	{
		$this->dbforge->drop_table('categories');
	}
}
?>