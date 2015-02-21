<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Recipes extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_email' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => FALSE
			),
			'user_name' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'user_gender' => array(
				'type' => 'VARCHAR',
				'constraint' => '1',
				'null' => TRUE,
			),
			'user_bdate' => array(
				'type' => 'DATE',
				'null' => TRUE
			),
			'user_phone' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			),
			'user_status' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'user_photo' => array(
				'type' => 'MEDIUMTEXT',
				'null' => TRUE,
			),
			'user_banned' => array(
				'type' => 'BOOLEAN',
				'null' => TRUE,
			),
			'user_last_activity' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE,
			),
		));
		$this->dbforge->add_key('user_email', TRUE);
		$this->dbforge->create_table('recipes');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}
?>