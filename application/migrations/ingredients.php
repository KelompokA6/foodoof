<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Ingredients extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'ingredient_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'ingredient_price' => array(
				'type' => 'INT',
				'null' => TRUE
			),
			'ingredient_units' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('ingredient_name', TRUE);
		$this->dbforge->create_table('ingredients');
	}

	public function down()
	{
		$this->dbforge->drop_table('ingredients');
	}
}
?>