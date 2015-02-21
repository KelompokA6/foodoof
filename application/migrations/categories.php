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
				'type' => 'TEXT',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('category_name', TRUE);
		$this->dbforge->add_foreign_key(array('field' => 'id', 'foreign_table' => 'recipes', 'foreign_field' => 'recipe_id'));
		$this->dbforge->create_table('categories');
	}

	public function down()
	{
		$this->dbforge->drop_table('categories');
	}
}
?>