<?php

class Migration_create_shows extends CI_Migration
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
			'category_id'      => array(
							   'type'            => 'INT',
							   'constraint'      => 11,
							   'unsigned'        => true,
			),
			'language_id'      => array(
							   'type'            => 'INT',
							   'constraint'      => 11,
							   'unsigned'        => true,
			),
			'country_id'       => array(
							   'type'            => 'INT',
							   'constraint'      => 11,
							   'unsigned'        => true,
			),
			'has_episodes'     => array(
							   'type'            => 'BOOLEAN',
							   'default'         => FALSE
			),
			'name'             => array(
							   'type'            => 'VARCHAR',
							   'constraint'      => 100,
			),
			'description'      => array(
							   'type'            => 'VARCHAR',
							   'constraint'      => 400,
							   'null'            => true
			),
			'label'            => array(
							   'type'            => 'VARCHAR',
							   'constraint'      => 100,
							   'null'            => true
			),
			'release_date`'    => array(
							   'type'            => 'date',
			),
			'tags'             => array(
							   'type'            => 'VARCHAR',
							   'constraint'      => 200,
							   'null'            => true
			),
			'rating'           => array(
							   'type'            => 'decimal',
							   'constraint'      => '3,2',
							   'null'            => true
			),
			'image'            => array(
							   'type'            => 'JSON',
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
		
		$this->dbforge->add_field([
		'CONSTRAINT  FOREIGN KEY(category_id) REFERENCES categories(id)',
		'CONSTRAINT  FOREIGN KEY(country_id)  REFERENCES countries(id)',
		'CONSTRAINT  FOREIGN KEY(language_id) REFERENCES languages(id)'
		]
		);
		
		$this->dbforge->create_table('shows');

	}
	
	public function down()
	{
		$this->dbforge->drop_table('shows');
	}
	
	
}