<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_categories extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'slug' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                 'unique'    => TRUE
                        ),
						'parent_id' => array(
                                'type' => 'int',
								'unsigned' => TRUE,
                                'constraint' => '11',
								'default'    => 0
                        ),
						'order' => array(
                                'type' => 'int',
								'unsigned' => TRUE,
                                'constraint' => '11',
								'null'    =>'true'
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('categories');
        }

        public function down()
        {
                $this->dbforge->drop_table('categories');
        }
}