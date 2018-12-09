<?php

use yii\db\Migration;

/**
 * Class m181121_134758_test
 */
class m181121_134758_test extends Migration
{

    public function Up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'content' => $this->text(),
            'author' => $this->integer(),
            'status' => $this->integer(),
        ]);

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'descr' => $this->text(),
        ]);

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'authorId',  // это "условное имя" ключа
            'article', // это название текущей таблицы
            'author', // это имя поля в текущей таблице, которое будет ключом
            'user', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'SET NULL',
            'CASCADE'
        );

        $this->addForeignKey(
            'catalogId',  // это "условное имя" ключа
            'article', // это название текущей таблицы
            'category_id', // это имя поля в текущей таблице, которое будет ключом
            'category', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'SET NULL',
            'CASCADE'
        );


    }

    public function Down()
    {
        $this->dropTable('article');
        $this->dropTable('category');
        $this->dropTable('user');

        return true;
    }
}
