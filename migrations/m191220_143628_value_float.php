<?php

use yii\db\Migration;

/**
 * Class m191220_143628_value_float
 */
class m191220_143628_value_float extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->alterColumn('product_variations', 'volume', $this->decimal(11, 2)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191220_143628_value_float cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191220_143628_value_float cannot be reverted.\n";

        return false;
    }
    */
}
