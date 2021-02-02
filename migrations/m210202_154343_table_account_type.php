<?php

use yii\db\Migration;

/**
 * Class m210202_154343_table_account_type
 */
class m210202_154343_table_account_type extends Migration
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

        $this->createTable('{{%account_type}}', [
            'id' => $this->primaryKey(),
            'account_type' => $this->string(2)->notNull()->unique(),
            'name' => $this->string('32')->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        $this->pupulateData();  

    }

    private function pupulateData(){

        $this->insert('{{%account_type}}', [
            'account_type' => 'A',
            'name' => 'Asset',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%account_type}}', [
            'account_type' => 'E',
            'name' => 'Expense',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%account_type}}', [
            'account_type' => 'Eq',
            'name' => 'Equity',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%account_type}}', [
            'account_type' => 'L',
            'name' => 'Liability',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%account_type}}', [
            'account_type' => 'R',
            'name' => 'Revenue',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%account_type}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210202_154343_table_account_type cannot be reverted.\n";

        return false;
    }
    */
}
