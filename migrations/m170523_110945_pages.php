<?php

use yii\db\Migration;

class m170523_110945_pages extends Migration
{
    public $tables = [
        'pagesTable'    => '{{%pages}}',
        'categoryTable' => '{{%pages_category}}',
    ];

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        if ($this->db->schema->getTableSchema($this->tables['pagesTable'], true) === null) {
            $this->createTable($this->tables['pagesTable'], [
                'id'                 => $this->primaryKey(),
                'title'              => $this->string(2048)->notNull(),
                'alias'              => $this->string(64)->notNull(),
                'category_id'        => $this->integer(11)->notNull(),
                'text'               => $this->text()->notNull(),
                'language'           => $this->string(32)->notNull()->defaultValue('en-US'),
                'date_created'       => 'timestamp on update current_timestamp',
                'date_updated'       => $this->timestamp(),
                'date_published_in'  => $this->timestamp(),
                'date_published_out' => $this->timestamp()->defaultValue(NULL),
                'sitemap'            => 'tinyint(4) NOT NULL DEFAULT 1',
            ], $tableOptions);
        }

        if ($this->db->schema->getTableSchema($this->tables['categoryTable'], true) === null) {
            $this->createTable($this->tables['categoryTable'], [
                'id'                 => $this->primaryKey(),
                'name'              => $this->char(64)->unique()->notNull(),
                'description'              => $this->text()->defaultValue(NULL),
            ], $tableOptions);
        }

        //Auth Item Relations Table Service
        $this->addForeignKey('category', $this->tables['pagesTable'], 'category_id', $this->tables['categoryTable'], 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
        $this->execute("SET foreign_key_checks = 0;");
        foreach ($this->tables as $table) {
            if ($this->db->schema->getTableSchema($table, true) !== null) {
                $this->dropTable($table);
            }
        }
        $this->execute("SET foreign_key_checks = 1;");
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
