 <?php


class Migration_Add_template_to_categories extends CI_Migration {

        public function up()
        {
                $fields = (array(
                        'template' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 50,
                        )
                ));
                $this->dbforge->add_column('categories', $fields);
        }

        public function down()
        {
                $this->dbforge->drop_column('categories','template');
        }
}