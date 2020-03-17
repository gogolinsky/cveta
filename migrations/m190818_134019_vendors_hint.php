<?php

use yii\db\Migration;

/**
 * Class m190818_134019_vendors_hint
 */
class m190818_134019_vendors_hint extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('vendors', 'hint', $this->string(255)->defaultValue(null));
        $this->addColumn('vendors', 'background', $this->string(500)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190818_134019_vendors_hint cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190818_134019_vendors_hint cannot be reverted.\n";

        return false;
    }
    */
}
