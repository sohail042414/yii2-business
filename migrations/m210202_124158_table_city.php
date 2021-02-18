<?php

use yii\db\Migration;

/**
 * Class m210216_090013_table_city
 */
class m210202_124158_table_city extends Migration
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

        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'state_id' => $this->integer()->notNull()->defaultValue(1),      
            'name' => $this->string(16)->notNull(), 
            ], $tableOptions);
        
        $this->populateCities();        
    }

    private function populateCities(){

        $this->insert('{{%city}}', [
            'name' => 'Islamabad',
            'state_id' => 1
        ]);

        $this->insert('{{%city}}', [
            'name' => 'Rawalpindi',
            'state_id' => 1
        ]);

        $this->insert('{{%city}}', [
            'name' => 'Lahore',
            'state_id' => 1
        ]);

        $this->insert('{{%city}}', [
            'name' => 'Peshawar',
            'state_id' => 1
        ]);

        $this->insert('{{%city}}', [
            'name' => 'Karachi',
            'state_id' => 1
        ]);

        $this->insert('{{%city}}', [
            'name' => 'Multan',
            'state_id' => 1
        ]);

        $this->insert('{{%city}}', [
            'name' => 'Kohat',
            'state_id' => 1
        ]);

        $this->insert('{{%city}}', [
            'name' => 'Qoueta',
            'state_id' => 1
        ]);
        $this->insert('{{%city}}', [
            'name' => 'Sialkot',
            'state_id' => 1
        ]);
        $this->insert('{{%city}}', [
            'name' => 'Gujrawanwala',
            'state_id' => 1
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
        return true;
        // echo "m210216_090013_table_city cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210216_090013_table_city cannot be reverted.\n";

        return false;
    }
    */
}
