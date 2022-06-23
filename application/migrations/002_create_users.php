<?php

class Migration_Create_users extends CI_Migration 
{
	public function up()
	{
		$this->dbforge->add_field(array(
		
		               'id'          => array(
					        'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => TRUE,
							'auto_increment' => TRUE
					   ),
					   'first_name'  => array(
					        'type'           => 'VARCHAR',
							'constraint'     => 50,
					   ),
					    'last_name'  => array(
					        'type'           => 'VARCHAR',
							'constraint'     => 50,
					   ),
					    'email'      => array(
					        'type'           => 'VARCHAR',
							'constraint'     => 100,
							'unique'         => TRUE
					   ),
					   'password'    => array(
					        'type'           => 'VARCHAR',
							'constraint'     => 128,
					   )
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users');
		
	}
	
	public function down()
	{
		$this->dbforge->drop_table('users');
	}
	
}