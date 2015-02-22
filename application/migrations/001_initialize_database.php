<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Initialize_database extends CI_Migration {

	public function up()
	{
		/*
		Table Users
		*/
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'name' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'password' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'gender' => array(
				'type' => 'VARCHAR',
				'constraint' => '1',
				'null' => TRUE
			),
			'bdate' => array(
				'type' => 'DATE',
				'null' => TRUE
			),
			'phone' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE,
			),
			'status' => array(
				'type' => 'VARCHAR',
				'constraint' => '30',
				'default' => 'MEMBER',
				'null' => TRUE,
			),
			'photo' => array(
				'type' => 'MEDIUMTEXT',
				'null' => TRUE,
			),
			'banned' => array(
				'type' => 'BOOLEAN DEFAULT FALSE',
				'null' => TRUE,
			),
			'last_access' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('email', TRUE);
		$this->dbforge->create_table('users');

		/*
		Table Recipes
		*/
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'equipments' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'steps' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'author' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'create_date' => array(
				'type' => 'DATE',
				'null' => TRUE
			),
			'update' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
				'null' => TRUE,
			),
			'rating' => array(
				'type' => 'DECIMAL',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'status' => array(
				'type' => 'BOOLEAN',
				'null' => TRUE
			),
			'views' => array(
				'type' => 'INT',
				'unsigned' => 'TRUE',
				'null' => TRUE
			),
			'photo' => array(
				'type' => 'MEDIUMTEXT',
				'null' => TRUE,
			),
			'highlight' => array(
				'type' => 'BOOLEAN',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('recipes');

		/*
		Table Ingredients
		*/
		$this->dbforge->add_field(array(
			'recipe_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'quantity' => array(
				'type' => 'INT DEFAULT 0',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'price' => array(
				'type' => 'INT DEFAULT 0',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'units' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('recipe_id', TRUE);
		$this->dbforge->add_key('name', TRUE);
		$this->dbforge->create_table('ingredients');

		/*
		Table Categories
		*/
		$this->dbforge->add_field(array(
			'recipe_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('recipe_id', TRUE);
		$this->dbforge->add_key('name', TRUE);
		$this->dbforge->create_table('categories');

		/*
		Table Comments
		*/
		$this->dbforge->add_field(array(
			'id' => array(
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
			'description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'submit' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('comments');

		/*
		Table Conversations
		*/
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'sender_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'submit' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('conversations');

		/*
		Table ConversationList
		*/
		$this->dbforge->add_field(array(
			'message_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'reciever_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
		));
		$this->dbforge->add_key('message_id', TRUE);
		$this->dbforge->add_key('reciever_id', TRUE);
		$this->dbforge->create_table('conversationsList');

		$this->db->query("ALTER TABLE users ADD UNIQUE (email)");
		$this->db->query("ALTER TABLE recipes ADD FOREIGN KEY (author) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE ingredients ADD FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE categories ADD FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE comments ADD FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE comments ADD FOREIGN KEY (recipe_id) REFERENCES recipes (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE conversations ADD FOREIGN KEY (sender_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE conversationsList ADD FOREIGN KEY (message_id) REFERENCES conversations (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE conversationsList ADD FOREIGN KEY (reciever_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE");
	}

	public function down()
	{
		$this->dbforge->drop_table('conversationsList');
		$this->dbforge->drop_table('conversations');
		$this->dbforge->drop_table('comments');
		$this->dbforge->drop_table('categories');
		$this->dbforge->drop_table('ingredients');
		$this->dbforge->drop_table('recipes');
		$this->dbforge->drop_table('users');
	}
}
?>