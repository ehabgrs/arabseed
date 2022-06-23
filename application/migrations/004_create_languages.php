<?php

class Migration_create_languages extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
		        'id'   => array(
				           'type'           => 'INT',
						   'constraint'      => 11,
						   'unsigned'        => true,
						   'auto_increment'  => true
				),
				'name'  => array(
				           'type'           => 'VARCHAR',
						   'constraint'      => 100,
				)
		
		));
		$this->dbforge->add_key('id' , TRUE);
		$this->dbforge->create_table('languages');
		
	}
	
	public function down()
	{
		$this->dbforge->drop_table('languages');
	}
	
	
}