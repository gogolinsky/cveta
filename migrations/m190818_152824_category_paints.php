<?php

use yii\db\Migration;

/**
 * Class m190818_152824_category_paints
 */
class m190818_152824_category_paints extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('categories', 'has_paints', $this->integer(1)->defaultValue(0)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190818_152824_category_paints cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190818_152824_category_paints cannot be reverted.\n";

        return false;
    }
    */
}
