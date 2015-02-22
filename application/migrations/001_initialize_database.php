<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Initialize_database extends CI_Migration {

	public function up()
	{
		/*
		Table Users
		*/
		$this->dbforge->add_field(array(
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_email' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'user_name' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'user_password' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'user_gender' => array(
				'type' => 'VARCHAR',
				'constraint' => '1',
				'null' => TRUE
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
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->add_key('user_email', TRUE);
		$this->dbforge->create_table('users');

		/*
		Table Recipes
		*/
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
				'unsigned' => TRUE,
			),
			'recipe_create_date' => array(
				'type' => 'DATE',
				'null' => TRUE
			),
			'recipe_update' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
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
		$this->dbforge->create_table('recipes');

		/*
		Table Ingredients
		*/
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'ingredient_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
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

		/*
		Table Categories
		*/
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

		/*
		Table Comments
		*/
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

		/*
		Table Conversations
		*/
		$this->dbforge->add_field(array(
			'message_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'sender_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'message_description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'message_submit' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('message_id', TRUE);
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

		$this->db->query("ALTER TABLE users ADD UNIQUE (user_email)");
		$this->db->query("ALTER TABLE recipes ADD CONSTRAINT id_author FOREIGN KEY (recipe_author) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE ingredients ADD FOREIGN KEY (id) REFERENCES recipes(recipe_id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE categories ADD FOREIGN KEY (id) REFERENCES recipes(recipe_id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE comments ADD FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE comments ADD FOREIGN KEY (recipe_id) REFERENCES recipes (recipe_id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE conversations ADD FOREIGN KEY (sender_id) REFERENCES users (user_id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE conversationsList ADD FOREIGN KEY (message_id) REFERENCES conversations (message_id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE conversationsList ADD FOREIGN KEY (reciever_id) REFERENCES users (user_id) ON DELETE CASCADE ON UPDATE CASCADE");
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