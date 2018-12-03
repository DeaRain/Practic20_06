<?php

use yii\db\Migration;

/**
 * Class m181121_134758_test
 */
class m181121_134758_test extends Migration
{
    /**
     * {@inheritdoc}
     */

    public function Up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'content' => $this->text(),
            'author' => $this->string()->notNull(),
            'status' => $this->integer(),
        ]);

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'descr' => $this->text(),
        ]);

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'banned' => $this->integer(),
            'auth_key' => $this->string(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('article');
        $this->dropTable('category');
        $this->dropTable('user');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_134758_test cannot be reverted.\n";

        return false;
    }
    */
}
