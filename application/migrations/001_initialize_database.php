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
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'facebook' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'twitter' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'googleplus' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'path' => array(
				'type' => 'TEXT',
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
			'portion' => array(
				'type' => 'INT DEFAULT 1',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'duration' => array(
				'type' => 'INT DEFAULT 0',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'author' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'create_date' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
				'null' => TRUE
			),
			'last_update' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
				'null' => TRUE,
			),
			'rating' => array(
				'type' => 'DECIMAL(3,2) DEFAULT 0.0',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'status' => array(
				'type' => 'BOOLEAN DEFAULT FALSE',
				'null' => TRUE
			),
			'views' => array(
				'type' => 'INT DEFAULT 0',
				'unsigned' => 'TRUE',
				'null' => TRUE
			),
			'photo' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'highlight' => array(
				'type' => 'BOOLEAN DEFAULT FALSE',
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
				'unsigned' => TRUE,
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'quantity' => array(
				'type' => 'INT DEFAULT 0',
				'null' => FALSE,
			),
			'units' => array(
				'type' => 'VARCHAR',
				'constraint' => '30',
				'null' => TRUE,
			),
			'info' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
		));
		$this->dbforge->add_key('recipe_id', TRUE);
		$this->dbforge->add_key('name', TRUE);
		$this->dbforge->create_table('ingredients');

		/*
		Table Steps
		*/
		$this->dbforge->add_field(array(
			'recipe_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'no_step' => array(
				'type' => 'TINYINT',
				'unsigned' => TRUE,
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'photo' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
		));
		$this->dbforge->add_key('recipe_id', TRUE);
		$this->dbforge->add_key('no_step', TRUE);
		$this->dbforge->create_table('steps');

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
		Table Rating
		*/
		$this->dbforge->add_field(array(
			'recipe_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'value' => array(
				'type' => 'DECIMAL(3,2)',
				'unsigned' => TRUE
			),
		));
		$this->dbforge->add_key('recipe_id', TRUE);
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('rating');

		/*
		Table Favorites
		*/
		$this->dbforge->add_field(array(
			'recipe_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
		));
		$this->dbforge->add_key('recipe_id', TRUE);
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('favorites');

		/*
		Table Cook Later
		*/
		$this->dbforge->add_field(array(
			'recipe_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'submit' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('recipe_id', TRUE);
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('cooklater');

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
		Table Report
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
			'reason' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'submit' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('reports');

		/*
		Table Conversations
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
			'submit' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('conversations');

		/*
		Table Messages
		*/
		$this->dbforge->add_field(array(
			'message_id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'conversation_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'description' => array(
				'type' => 'MEDIUMTEXT',
				'null' => TRUE,
			),
			'submit' => array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('message_id', TRUE);
		$this->dbforge->add_key('conversation_id', TRUE);
		$this->dbforge->create_table('messages');

		/*
		Table Catalogs
		*/
		$this->dbforge->add_field(array(
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'units' => array(
				'type' => 'VARCHAR',
				'constraint' => '30',
				'null' => TRUE
			),
			'price' => array(
				'type' => 'INT DEFAULT 0',
				'null' => TRUE
			),
		));
		$this->dbforge->add_key('name', TRUE);
		$this->dbforge->add_key('units', TRUE);
		$this->dbforge->create_table('catalogs');

		$this->db->query("ALTER TABLE users ADD UNIQUE (email)");
		$this->db->query("ALTER TABLE recipes ADD FOREIGN KEY (author) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE ingredients ADD FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE steps ADD FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE categories ADD FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE rating ADD FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE rating ADD FOREIGN KEY (recipe_id) REFERENCES recipes (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE favorites ADD FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE favorites ADD FOREIGN KEY (recipe_id) REFERENCES recipes (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE cooklater ADD FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE cooklater ADD FOREIGN KEY (recipe_id) REFERENCES recipes (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE comments ADD FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE comments ADD FOREIGN KEY (recipe_id) REFERENCES recipes (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE conversations ADD FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE");
		$this->db->query("ALTER TABLE messages ADD FOREIGN KEY (conversation_id) REFERENCES conversations (id) ON DELETE CASCADE ON UPDATE CASCADE");
	}

	public function down()
	{
		$this->dbforge->drop_table('messages');
		$this->dbforge->drop_table('conversations');
		$this->dbforge->drop_table('favorites');
		$this->dbforge->drop_table('cooklater');
		$this->dbforge->drop_table('comments');
		$this->dbforge->drop_table('categories');
		$this->dbforge->drop_table('steps');
		$this->dbforge->drop_table('ingredients');
		$this->dbforge->drop_table('recipes');
		$this->dbforge->drop_table('users');
	}
}
?>