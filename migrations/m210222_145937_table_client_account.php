<?php

use yii\db\Migration;

/**
 * Class m210222_145937_client_account
 */
class m210222_145937_table_client_account extends Migration
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

        $this->createTable('{{%client_account}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'account_id' => $this->integer()->notNull(),
            'default' => $this->boolean()->notNull()->defaultValue(false),
                ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client_account}}');
        return true;
        // echo "m210222_145937_client_account cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210222_145937_client_account cannot be reverted.\n";

        return false;
    }
    */
}
