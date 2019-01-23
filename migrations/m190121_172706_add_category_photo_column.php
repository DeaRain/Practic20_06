<?php

use yii\db\Migration;

/**
 * Class m190121_172706_add_category_photo_column
 */
class m190121_172706_add_category_photo_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->addColumn('category', 'photo', $this->string(255)->defaultValue('default.jpg'));
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropColumn('category','photo');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190121_172706_add_category_photo_column cannot be reverted.\n";

        return false;
    }
    */
}
