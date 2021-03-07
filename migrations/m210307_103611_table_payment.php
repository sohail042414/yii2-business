<?php

use yii\db\Migration;

/**
 * Class m210307_103611_table_payment
 */
class m210307_103611_table_payment extends Migration
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

        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),            
            'amount' => $this->integer()->notNull(),
            'payment_method' => "ENUM('cash','bank','easypaisa') default 'cash'",  
            'account_no' => $this->string(64)->defaultValue(Null),     
            'transection' => $this->string(64)->defaultValue(Null),     
            'notes' => $this->text(),     
            'payment_date' => $this->date()->notNull(),           
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment}}');
        return true;

        // echo "m210307_103611_table_payment cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210307_103611_table_payment cannot be reverted.\n";

        return false;
    }
    */
}
