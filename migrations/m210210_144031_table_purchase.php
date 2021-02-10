<?php

use yii\db\Migration;

/**
 * Class m210210_144031_table_purchase
 */
class m210210_144031_table_purchase extends Migration
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

        $this->createTable('{{%purchase}}', [
            'id' => $this->primaryKey(),
            'vendor_id' => $this->integer()->notNull(),
            'notes' => $this->text()->defaultValue(null),
            'total_amount' => $this->integer()->notNull()->defaultValue(0),                      
            'status' => $this->string(16)->notNull()->defaultValue('new'),                      
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%purchase}}');
        return true;

        // echo "m210210_144031_table_purchase cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210210_144031_table_purchase cannot be reverted.\n";

        return false;
    }
    */
}
