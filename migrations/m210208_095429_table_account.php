<?php

use yii\db\Migration;

/**
 * Class m210208_095429_table_account
 */
class m210208_095429_table_account extends Migration
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

        $this->createTable('{{%account}}', [
            'id' => $this->primaryKey(),
            'system'=>$this->tinyInteger()->notNull()->defaultValue(0),
            'parent' => $this->integer()->notNull()->defaultValue(0),
            'title' => $this->string(64)->notNull(),      
            'type' => $this->string(2)->notNull(),                      
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        $this->pupulateAccounts();

    }

    public function pupulateAccounts(){

        $this->insert('{{%account}}', [
            'system' => 1,
            'type' => 'E',
            'parent' => 0,
            'title' => 'Company Default Expense Account',
            'created_at' => time(),
            'updated_at' => time()

        ]);

        $this->insert('{{%account}}', [
            'system' => 1,
            'type' => 'A',
            'parent' => 0,
            'title' => 'Company Default Asset Account',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%account}}', [
            'system' => 1,
            'type' => 'R',
            'parent' => 0,
            'title' => 'Company Default Revenue Account',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%account}}', [
            'system' => 1,
            'type' => 'L',
            'parent' => 0,
            'title' => 'Company Default Liability Account',
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%account}}');
        return true;
        // echo "m210208_095429_table_account cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210208_095429_table_account cannot be reverted.\n";

        return false;
    }
    */
}
