<?php

use yii\db\Migration;

/**
 * Class m210208_112557_table_items
 */
class m210202_124212_table_items extends Migration
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
            'item_no' => $this->integer()->notNull()->unique(),
            'name' => $this->string(64)->notNull()->unique(),
            'type' => "ENUM('wholesale', 'retail')",
            'count_unit' => "ENUM('bori','corton','box','dozen') default NULL",             
            'weight' => $this->integer()->notNull()->defaultValue(0),
            'weight_unit' => "ENUM('kg','pao','gram','mann') default 'kg'",
            'description' => $this->text()->defaultValue(null),
            'purchase_price' => $this->integer()->notNull()->defaultValue(0),                      
            'sale_price' => $this->integer()->notNull()->defaultValue(0),                      
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        
        $this->populateData();

    }

    private function populateData(){
        
        $this->insert('{{%item}}', [
            'name' => 'Supreme 1 Kg packet',
            'category' => 1,
            'item_no' => 100,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2000,
            'sale_price' => 3000,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%item}}', [
            'name' => 'Lipton 1 Kg packet',
            'category' => 2,
            'item_no' => 101,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2500,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%item}}', [
            'name' => 'Lipton 0.5 Kg packet',
            'category' => 2,
            'item_no' => 102,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2500,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%item}}', [
            'name' => 'Lipton0.25 Kg packet',
            'category' => 2,
            'item_no' => 103,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2500,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);


        $this->insert('{{%item}}', [
            'name' => 'Tappal 1 Kg packet',
            'category' => 3,
            'item_no' => 104,
            'type' => 'wholesale',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2500,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);


        $this->insert('{{%item}}', [
            'name' => 'Tappal 0.25 Kg packet',
            'category' => 3,
            'item_no' => 105,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2500,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%item}}', [
            'name' => 'Tappal Tea 0.5 Kg packet',
            'category' => 3,
            'item_no' => 106,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2100,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);


        $this->insert('{{%item}}', [
            'name' => 'Farooq 0.5 Kg packet',
            'category' => 4,
            'item_no' => 107,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2500,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);


        $this->insert('{{%item}}', [
            'name' => 'Farooq 1 Kg packet',
            'category' => 4,
            'item_no' => 108,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2500,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);


        $this->insert('{{%item}}', [
            'name' => 'Rawal 0.5 Kg packet',
            'category' => 5,
            'item_no' => 109,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2500,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%item}}', [
            'name' => 'Rawal Tea 1 Kg packet',
            'category' => 5,
            'item_no' => 110,
            'type' => 'retail',
            'count_unit' => 'bori',
            'weight_unit' => 'kg',
            'purchase_price' => 2500,
            'sale_price' => 3050,
            'created_at' => time(),
            'updated_at' => time(),
        ]);



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
