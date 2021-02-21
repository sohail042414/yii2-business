<?php

use yii\db\Migration;

/**
 * Class m210210_150531_table_sale_item
 */
class m210210_150531_table_sale_item extends Migration
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

        $this->createTable('{{%sale_item}}', [
            'id' => $this->primaryKey(),
            'sale_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'shortage' => $this->integer()->notNull()->defaultValue(0),
            'weight' => $this->integer()->notNull(),
            'total_weight' => $this->integer()->notNull()->defaultValue(0),
            'sale_price' => $this->integer()->notNull(),
            'sale_total' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sale_item}}');
        return true;
        // echo "m210210_150531_table_sale_item cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210210_150531_table_sale_item cannot be reverted.\n";

        return false;
    }
    */
}
