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
            'city_id' => $this->integer()->notNull(),            
            'name' => $this->string(32)->notNull()->unique(),      
            'phone' => $this->string(16)->defaultValue(NUll),                            
            'address' => $this->string(96)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        $this->pupulateClients();  
    }

    private function  pupulateClients(){

        $this->insert('{{%client}}', [
            'name' => 'Kamal Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%client}}', [
            'name' => 'Jamal Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%client}}', [
            'name' => 'Bilal Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%client}}', [
            'name' => 'Hakeem Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%client}}', [
            'name' => 'Naeem Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%client}}', [
            'name' => 'Amir Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%client}}', [
            'name' => 'Salman Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%client}}', [
            'name' => 'Habib Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%client}}', [
            'name' => 'Karim Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

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
