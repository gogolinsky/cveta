<?php

use yii\db\Migration;

/**
 * Class m190801_203957_prices
 */
class m190801_203957_prices extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_variations', 'price', $this->decimal(11,2)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190801_203957_prices cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190801_203957_prices cannot be reverted.\n";

        return false;
    }
    */
}
