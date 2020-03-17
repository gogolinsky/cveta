<?php

namespace app\modules\setting\models;

use app\modules\admin\traits\QueryExceptions;
use app\modules\setting\SettingFactory;
use yii\db\ActiveRecord;
use yii\bootstrap\ActiveForm;
use yii2tech\ar\position\PositionBehavior;

/**
 * @property string $id
 * @property int $position
 * @property string $type
 * @property string $value
 * @property string $title
 * @property string $description
 * @property string $hint
 * @property string $hash
 *
 * @mixin PositionBehavior
 */
class Setting extends ActiveRecord
{
    use QueryExceptions;

    const TYPE = null;
    const NAME = null;

    public function behaviors()
    {
        return [
            PositionBehavior::class,
        ];
    }

    public function formName()
    {
        return 'Setting';
    }

    public function init()
    {
        $this->type = static::TYPE;
        parent::init();
    }

    public static function tableName()
    {
        return 'setting';
    }

    public function rules()
    {
        return [
            [['id', 'type', 'title'], 'required'],
            [['id', 'type', 'value', 'title', 'description', 'hint'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'value' => 'Значение',
            'description' => 'Описание',
            'title' => 'Название',
            'hint' => 'Подсказка',
        ];
    }

    public static function find()
    {
        return new SettingQuery(get_called_class());
    }

    public function getValue()
    {
        return $this->value;
    }

    public function formField(ActiveForm $form)
    {
        return $form->field($this, 'value');
    }

    public static function instantiate($row)
    {
       return SettingFactory::create($row['type']);
    }

    public function getArray()
    {
        return array_filter(array_map('trim', explode(PHP_EOL,  $this->value)));
    }

}