<?php

use yii\db\Migration;

/**
 * Class m210210_150520_table_sale
 */
class m210210_150520_table_sale extends Migration
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

        $this->createTable('{{%sale}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            //'client_name' => $this->string('32')->notNull(), 
            'client_city' => $this->integer()->notNull(),
            'account_id' => $this->integer()->notNull()->defaultValue(0),
            'bill_book_no' => $this->string('16')->notNull(), 
            'bill_no' => $this->string('16')->notNull(), 
            'bill_date' => $this->date()->notNull(), 
            'cargo_terminal' => $this->string('32')->defaultValue(NULL), 
            'builty_no' => $this->string('32')->defaultValue(NULL),  
            'vehicle_no' => $this->string('32')->defaultValue(NULL),          
            'builty_charges' => $this->integer()->notNull()->defaultValue(0),
            'labour_charges' => $this->integer()->notNull()->defaultValue(0),
            'other_charges' => $this->integer()->notNull()->defaultValue(0),
            'total_amount' => $this->integer()->notNull()->defaultValue(0),  
            'discount' => $this->integer()->notNull()->defaultValue(0),
            'cash_amount' => $this->integer()->notNull()->defaultValue(0), 
            'debit_amount' => $this->integer()->notNull()->defaultValue(0),
            'previous_balance' => $this->integer()->notNull()->defaultValue(0),                     
            'status' => $this->string(16)->notNull()->defaultValue('new'),  
            'notes' => $this->text()->defaultValue(null),                                
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sale}}');
        return true;
        // echo "m210210_150520_table_sale cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210210_150520_table_sale cannot be reverted.\n";

        return false;
    }
    */
}
