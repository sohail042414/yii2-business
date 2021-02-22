<?php

use yii\db\Migration;

/**
 * Class m210202_124157_init
 */
class m210202_124157_init extends Migration
{

    public function safeUp() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'role' => $this->string('15')->notNull()->defaultValue('user'),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        $this->createAdmin();                       
    }

        /**
     * 
     */
    private function createAdmin() {

        //password : admin1234
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'role' => 'admin',
            'auth_key' => '8GfidvnD3E83t3G66xEWxbRmySANGjwZ',
            'password_hash' => '$2y$13$7yEghajQmPuTv41hgyZFeOwEjIdC9NEjnVD.lkqXmwBkWuNVW.AZq',
            'password_reset_token' => NULL,
            'email' => 'admin@gmail.com',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

    }

    public function safeDown() {
        $this->dropTable('{{%user}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210202_124157_init cannot be reverted.\n";

        return false;
    }
    */

}
