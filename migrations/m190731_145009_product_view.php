<?php

use yii\db\Migration;

/**
 * Class m190731_145009_product_view
 */
class m190731_145009_product_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'view', $this->string(255)->defaultValue('default'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190731_145009_product_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190731_145009_product_view cannot be reverted.\n";

        return false;
    }
    */
}
