<?php

use yii\db\Migration;

/**
 * Class m190113_183420_add_article_photo_column
 */
class m190113_183420_add_article_photo_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->addColumn('article', 'photo', $this->string(255)->after('author')->defaultValue('default.jpg'));
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropColumn('article','photo');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190113_183420_add_article_photo_column cannot be reverted.\n";

        return false;
    }
    */
}
