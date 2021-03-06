<?php

use yii\db\Migration;

/**
 * Class m210208_112044_table_category
 */
class m210202_124211_table_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(64)->notNull()->unique(),
            'description' => $this->text()->defaultValue(null),                      
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        $this->populateData();
    }

    private function populateData(){

        $this->insert('{{%category}}', [
            'title' => 'Supreme Tea',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%category}}', [
            'title' => 'Lipton Tea',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%category}}', [
            'title' => 'Tapal Dany Dar Tea',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%category}}', [
            'title' => ' Farooq Tea',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%category}}', [
            'title' => ' Rawal Tea',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
        return true;
        // echo "m210208_112044_table_category cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210208_112044_table_category cannot be reverted.\n";

        return false;
    }
    */
}
