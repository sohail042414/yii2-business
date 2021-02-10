<?php

use yii\db\Migration;

/**
 * Class m210208_083854_table_clients
 */
class m210208_083854_table_client extends Migration
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

        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull()->unique(),      
            'phone' => $this->string(16)->notNull(),            
            'city' => $this->string(32)->notNull(),
            'address' => $this->string(96)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        //$this->pupulateData();  
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client}}');
        return true;
        //echo "m210208_083854_table_clients cannot be reverted.\n";
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210208_083854_table_clients cannot be reverted.\n";

        return false;
    }
    */
}
