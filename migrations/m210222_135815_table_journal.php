<?php

use yii\db\Migration;

/**
 * Class m210222_135815_table_journal
 */
class m210222_135815_table_journal extends Migration
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

        $this->createTable('{{%journal}}', [
            'id' => $this->primaryKey(),
            'journal_number' => $this->string(20)->notNull()->defaultValue('--'),
            'type' => "ENUM('sale', 'purchase', 'payment','deposit')",
            'journal_date' => $this->date()->notNull(), 
            'description' => $this->text(),
            'status'=> "ENUM('pending','approved','canceled','voided') DEFAULT 'pending'",
            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%journal}}');
        return true;
        // echo "m210222_135815_table_journal cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210222_135815_table_journal cannot be reverted.\n";

        return false;
    }
    */
}
