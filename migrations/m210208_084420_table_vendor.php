<?php

use yii\db\Migration;

/**
 * Class m210208_084420_table_vendor
 */
class m210208_084420_table_vendor extends Migration
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

        $this->createTable('{{%vendor}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer()->notNull(), 
            'name' => $this->string(32)->notNull()->unique(),      
            'phone' => $this->string(16)->defaultValue(NUll),            
            'address' => $this->string(96)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


        $this->populateVendors();       
    }

    private function populateVendors(){

        $this->insert('{{%vendor}}', [
            'name' => 'Ahmed Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%vendor}}', [
            'name' => 'Hammad Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%vendor}}', [
            'name' => 'Haroom Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%vendor}}', [
            'name' => 'Zia Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%vendor}}', [
            'name' => 'Malkoo Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%vendor}}', [
            'name' => 'Haris Khan',
            'city_id' => 1,
            'address' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%vendor}}', [
            'name' => 'Imran Khan',
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
        $this->dropTable('{{%vendor}}');
        return true;
        // echo "m210208_084420_table_vendor cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210208_084420_table_vendor cannot be reverted.\n";

        return false;
    }
    */
}
