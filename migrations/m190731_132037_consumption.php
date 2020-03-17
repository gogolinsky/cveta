<?php

use yii\db\Migration;

/**
 * Class m190731_132037_consumption
 */
class m190731_132037_consumption extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'consumption', $this->decimal(11, 2)->defaultValue(null));
        $this->addColumn('product_variations', 'volume', $this->integer(11)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190731_132037_consumption cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190731_132037_consumption cannot be reverted.\n";

        return false;
    }
    */
}
