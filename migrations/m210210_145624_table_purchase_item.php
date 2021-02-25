<?php

use yii\db\Migration;

/**
 * Class m210210_145624_table_purchase_item
 */
class m210210_145624_table_purchase_item extends Migration
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

        $this->createTable('{{%purchase_item}}', [
            'id' => $this->primaryKey(),
            'purchase_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'purchase_price' => $this->integer()->notNull(),
            'purchase_total' => $this->integer()->notNull(),
            'weight' => $this->integer()->notNull(),
            'total_weight' => $this->integer()->notNull()->defaultValue(0),
            'shortage' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%purchase_item}}');
        return true;
        // echo "m210210_145624_table_purchase_item cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210210_145624_table_purchase_item cannot be reverted.\n";

        return false;
    }
    */
}
