<?php

use yii\db\Migration;

/**
 * Class m210218_062738_table_weight_units
 */
class m210202_124159_table_unit extends Migration
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

        $this->createTable('{{%unit}}', [
            'id' => $this->primaryKey(),
            'type' => "ENUM('length', 'weight', 'count')",      
            'symbol' => $this->string(16)->notNull(), 
            'name' => $this->string(32)->notNull(), 
            ], $tableOptions);

        $this->populateUnits();

    }

    private function populateUnits(){

        $this->insert('{{%unit}}', [
            'type' => 'weight',
            'symbol' => 'kg',
            'name' => 'Kilogram',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'weight',
            'symbol' => 'pao',
            'name' => 'Pao',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'weight',
            'symbol' => 'g',
            'name' => 'Gram',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'weight',
            'symbol' => 'mann',
            'name' => 'Mann',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'length',
            'symbol' => 'm',
            'name' => 'Meter',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'length',
            'symbol' => 'cm',
            'name' => 'Centimeter',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'length',
            'symbol' => 'inch',
            'name' => 'Inch',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'length',
            'symbol' => 'mm',
            'name' => 'Milimeter',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'count',
            'symbol' => 'bori',
            'name' => 'Bori',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'count',
            'symbol' => 'carton',
            'name' => 'Carton',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'count',
            'symbol' => 'box',
            'name' => 'Box',
        ]);

        $this->insert('{{%unit}}', [
            'type' => 'count',
            'symbol' => 'packet',
            'name' => 'Packet',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%unit}}');
        return true;
        // echo "m210218_062738_table_weight_units cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210218_062738_table_weight_units cannot be reverted.\n";

        return false;
    }
    */
}
