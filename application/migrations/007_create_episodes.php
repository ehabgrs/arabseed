<?php

class Migration_create_episodes extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id'               => array(
							   'type'            => 'INT',
							   'constraint'      => 11,
							   'unsigned'        => true,
							   'auto_increment'  => true
			),
			'show_id'          => array(
							   'type'            => 'INT',
							   'constraint'      => 11,
							   'unsigned'        => true,
			),
			'episode_number'   => array(
							   'type'            => 'SMALLINT',
							   'constraint'      => 5,
							   'unsigned'        => true,
			),
			'episode_number_literally'       => array(
							   'type'            => 'VARCHAR',
							   'constraint'      => 100,
			),
			'label'            => array(
							   'type'            => 'VARCHAR',
							   'constraint'      => 100,
							   'null'            => true
			),
			'streaming_links'  => array(
							   'type'            => 'JSON',
			),
			'download_links'    => array(
							   'type'            => 'JSON',
			),
			'pubdate'          => array(
							   'type'            => 'DATE',
			),
			'created'          => array(
							   'type'            => 'DATETIME',
			),
			'modified'          => array(
							   'type'            => 'DATETIME',
			)
		));
		
		$this->dbforge->add_key('id' , TRUE);
		
		$this->dbforge->add_field('CONSTRAINT  FOREIGN KEY(show_id) REFERENCES shows(id)');
		
		$this->dbforge->create_table('episodes');

	}
	
	public function down()
	{
		$this->dbforge->drop_table('episodes');
	}
	
	
}