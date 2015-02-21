<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Recipes extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'recipe_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'recipe_name' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'recipe_description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'recipe_equipments' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'recipe_steps' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'recipe_author' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'recipe_create_date' => array(
				'type' => 'DATE',
				'null' => TRUE
			),
			'recipe_update' => array(
				'type' => 'TIMESTAMP',
				'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
				'null' => TRUE,
			),
			'recipe_rating' => array(
				'type' => 'DECIMAL',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'recipe_status' => array(
				'type' => 'BOOLEAN',
				'null' => TRUE
			),
			'recipe_views' => array(
				'type' => 'INT',
				'unsigned' => 'TRUE',
				'null' => TRUE
			),
			'recipe_photo' => array(
				'type' => 'MEDIUMTEXT',
				'null' => TRUE,
			),
			'recipe_highlight' => array(
				'type' => 'BOOLEAN',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('recipe_id', TRUE);
		$this->dbforge->add_foreign_key(array('field' => 'recipe_author', 'foreign_table' => 'users', 'foreign_field' => 'user_id'));
		$this->dbforge->create_table('recipes');
	}

	public function down()
	{
		$this->dbforge->drop_table('recipes');
	}
}
?>