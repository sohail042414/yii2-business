<?php

use yii\db\Migration;

/**
 * Class m210222_140452_table_trans
 */
class m210222_140452_table_trans extends Migration
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

        $this->createTable('{{%trans}}', [
            'id' => $this->primaryKey(),
            'journal_id' => $this->integer()->notNull(),
            'account_id' => $this->integer()->notNull(),
            'type'=> "ENUM('d', 'c')",
            'debit' => $this->integer()->notNull(),
            'credit' => $this->integer()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%trans}}');
        return true;
        // echo "m210222_140452_table_trans cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210222_140452_table_trans cannot be reverted.\n";

        return false;
    }
    */
}
