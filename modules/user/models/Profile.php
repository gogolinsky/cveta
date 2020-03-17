<?php

namespace app\modules\user\models;

use yii\db\ActiveRecord;

/**
 * @property int $user_id
 * @property string $name
 * @property string $last_name
 */
class Profile extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%profiles}}';
    }

    public function rules()
    {
        return [
            [['name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'last_name' => 'Фамилия',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
