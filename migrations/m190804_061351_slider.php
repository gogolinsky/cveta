<?php

use yii\db\Migration;

/**
 * Class m190804_061351_slider
 */
class m190804_061351_slider extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('slider', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(11)->defaultValue(null),
            'updated_at' => $this->integer(11)->defaultValue(null),
            'position' => $this->integer(11)->defaultValue(1),
            'title' => $this->string(255)->defaultValue(null),
            'description' => $this->string(255)->defaultValue(null),
            'link' => $this->string(500)->defaultValue(null),
            'image' => $this->string(500)->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190804_061351_slider cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190804_061351_slider cannot be reverted.\n";

        return false;
    }
    */
}
