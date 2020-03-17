<?php

namespace app\modules\user\models;

use app\modules\user\traits\ModuleTrait;
use RuntimeException;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * @property int $id
 * @property int $created_at
 * @property int $user_id
 * @property int $type
 * @property string $code
 *
 * @property User $user
 */
class Token extends ActiveRecord
{
    use ModuleTrait;

    const TYPE_CONFIRMATION = 0;
    const TYPE_RECOVERY = 1;
    const TYPE_CONFIRM_NEW_EMAIL = 2;
    const TYPE_CONFIRM_OLD_EMAIL = 3;

    public static function tableName()
    {
        return '{{%tokens}}';
    }

    public function getUrl()
    {
        switch ($this->type) {
            case self::TYPE_CONFIRMATION:
                $route = '/user/registration/confirm';
                break;
            case self::TYPE_RECOVERY:
                $route = '/user/recovery/reset';
                break;
            case self::TYPE_CONFIRM_NEW_EMAIL:
            case self::TYPE_CONFIRM_OLD_EMAIL:
                $route = '/user/settings/confirm';
                break;
            default:
                throw new RuntimeException;
        }

        return Url::to([$route, 'token' => $this->code], true);
    }

    public function isExpired()
    {
        switch ($this->type) {
            case self::TYPE_CONFIRMATION:
            case self::TYPE_CONFIRM_NEW_EMAIL:
            case self::TYPE_CONFIRM_OLD_EMAIL:
                $expirationTime = $this->getModule()->confirmWithin;
                break;
            case self::TYPE_RECOVERY:
                $expirationTime = $this->getModule()->recoverWithin;
                break;
            default:
                throw new RuntimeException;
        }

        return ($this->created_at + $expirationTime) < time();
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('created_at', time());
            $this->setAttribute('code', Yii::$app->security->generateRandomString());
        }

        return parent::beforeSave($insert);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
