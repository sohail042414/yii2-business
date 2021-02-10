<?php

use yii\db\Migration;

/**
 * Class m210208_112557_table_items
 */
class m210208_112557_table_items extends Migration
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

        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'category' => $this->integer()->notNull(),
            'name' => $this->string(64)->notNull()->unique(),      
            'description' => $this->text()->defaultValue(null),
            'purchase_price' => $this->integer()->notNull()->defaultValue(0),                      
            'sale_price' => $this->integer()->notNull()->defaultValue(0),                      
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
        return true;

        //echo "m210208_112557_table_items cannot be reverted.\n";
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210208_112557_table_items cannot be reverted.\n";

        return false;
    }
    */
}
