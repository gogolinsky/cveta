<?php

use yii\db\Migration;

/**
 * Class m190801_084338_eav_icon
 */
class m190801_084338_eav_icon extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\modules\eav\models\EavAttribute::tableName(), 'icon', $this->string(500)->defaultValue(null));
        $this->addColumn(\app\modules\eav\models\EavAttribute::tableName(), 'icon_hash', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190801_084338_eav_icon cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190801_084338_eav_icon cannot be reverted.\n";

        return false;
    }
    */
}
