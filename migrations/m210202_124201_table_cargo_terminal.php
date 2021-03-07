<?php

use yii\db\Migration;

/**
 * Class m210226_090757_table_cargo_terminal
 */

class m210202_124201_table_cargo_terminal extends Migration
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

        $this->createTable('{{%cargo_terminal}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull()->unique(),      
            'city_id' => $this->integer()->notNull(),            
            'phone' => $this->string(16)->defaultValue(NUll),                            
                ], $tableOptions);
        
        $this->populateData();
    
    }

    private function populateData(){

        $this->insert('{{%cargo_terminal}}', [
            'name' => 'Khan Goods Transport',
            'city_id' => 1,
            'phone' => '051442342342'
        ]);

        $this->insert('{{%cargo_terminal}}', [
            'name' => 'Faisal Movers',
            'city_id' => 1,
            'phone' => '0514242342'
        ]);

        $this->insert('{{%cargo_terminal}}', [
            'name' => 'Niazi Add',
            'city_id' => 1,
            'phone' => '0514242342'
        ]);

        $this->insert('{{%cargo_terminal}}', [
            'name' => 'Bilal Daewo Add',
            'city_id' => 2,
            'phone' => '0514242342'
        ]);

        $this->insert('{{%cargo_terminal}}', [
            'name' => 'Sky ways',
            'city_id' => 2,
            'phone' => '0514242342'
        ]);


    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cargo_terminal}}');
        return true;
        // echo "m210226_090757_table_cargo_terminal cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210226_090757_table_cargo_terminal cannot be reverted.\n";

        return false;
    }
    */
}
