<?php

use yii\db\Migration;

/**
 * Class m190731_125521_variations
 */
class m190731_125521_variations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_variations', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(11)->defaultValue(null),
            'updated_at' => $this->integer(11)->defaultValue(null),
            'position' => $this->integer(11)->defaultValue(1),
            'product_id' => $this->integer(11)->notNull(),
            'title' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190731_125521_variations cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190731_125521_variations cannot be reverted.\n";

        return false;
    }
    */
}
