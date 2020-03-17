<?php

namespace app\modules\feedback\models;

use app\modules\admin\traits\QueryExceptions;
use app\modules\category\models\Category;
use app\modules\feedback\factories\FormFactory;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $type
 * @property string $name
 * @property string $phone
 * @property string $comment
 * @property string $ref
 * @property int status
 */
class Feedback extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_NEW = 1;
    const STATUS_PROCESS = 2;
    const STATUS_SUCCESS = 3;
    const STATUS_CANCELED = 4;

    const TITLE = 'Заявки';
    const ICON = 'bell-o';
    const TYPE = NULL;

    public function init()
    {
        $this->type = static::TYPE;
    }

    public function formName()
    {
        return '';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function tableName()
    {
        return 'feedback';
    }

    public function rules()
    {
        return [
            [['phone', 'type'], 'required', 'message' => 'Заполните поле'],
            [['status'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 255],
            ['comment', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата заявки',
            'updated_at' => 'Дата обновления',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'comment' => 'Комментарий',
            'ref' => 'Страница',
            'status' => 'Статус',
            'type' => 'Форма',
        ];
    }

    public function getSuccessMessage()
    {
        return '';
    }

    public static function instantiate($row)
    {
        return FormFactory::create($row['type']);
    }

    public function gridAttrs()
    {
        return ['status', 'created_at', 'name', 'phone'];
    }
}
