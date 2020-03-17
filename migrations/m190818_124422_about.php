<?php

use yii\db\Migration;

/**
 * Class m190818_124422_about
 */
class m190818_124422_about extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('setting', [
            'id' => 'about',
            'type' => 'text',
            'value' => '«Мастерские цвета Dulux» – это фирменные магазины, в которых вы найдете ответы на все вопросы о краске и штукатурке.
                        Внимательно подходим к эксплуатации, интерьеру, практичности и другим тонкостям заказчика. Исходим только из задач клиента.',
            'title' => 'О нас',
            'position' => 13
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190818_124422_about cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190818_124422_about cannot be reverted.\n";

        return false;
    }
    */
}
