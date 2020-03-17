<?php

namespace app\modules\user\models;

use app\modules\user\helpers\Password;
use DomainException;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $blocked_at
 * @property int $confirmed_at
 * @property string $email
 * @property string $unconfirmed_email
 * @property string $password_hash
 * @property string $auth_key
 * @property int $registration_ip
 *
 * @property bool $isConfirmed
 *
 * @property Profile $profile
 * @property Token[] $tokens
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function create($email, $password)
    {
        $user = new static();
        $user->email = $email;
        $user->setPassword($password);
        $user->confirmed_at = time();
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->registration_ip = null;

        if (!$user->save()) {
            throw new DomainException('User can not be registered');
        }

        return $user;
    }

    public static function register($email, $password = null)
    {
        $user = new static();
        $user->email = $email;
        $user->setPassword($password);
        $user->confirmed_at = null;
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->registration_ip = Yii::$app->request->userIP;

        if (!$user->save()) {
            throw new DomainException('User can not be created');
        }

        return $user;
    }

    private function setPassword($password)
    {
        $this->password_hash = Password::hash($password);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function tableName()
    {
        return '{{%users}}';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'registration_ip' => 'IP при регистрации',
            'unconfirmed_email' => 'Новый email',
            'created_at' => 'Дата регистрации',
            'confirmed_at' => 'Дата подтверждения email',
        ];
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique'],
        ];
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function getId()
    {
        return $this->getAttribute('id');
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key == $authKey;
    }

    public function resetPassword($password)
    {
        return (bool) $this->updateAttributes(['password_hash' => Password::hash($password)]);
    }

    public function block()
    {
        return (bool) $this->updateAttributes([
            'blocked_at' => time(),
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);
    }

    public function unblock()
    {
        return (bool) $this->updateAttributes(['blocked_at' => null]);
    }

    public function isActive()
    {
        return null == $this->blocked_at;
    }

    public function confirm()
    {
        return $this->updateAttributes(['confirmed_at' => time()]);
    }

    public function unconfirm()
    {
        return $this->updateAttributes(['confirmed_at' => null]);
    }

    public function isConfirmed()
    {
        return $this->confirmed_at != null;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            $profile = new Profile();
            $profile->link('user', $this);
        }
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getTokens()
    {
        return $this->hasMany(Token::class, ['user_id' => 'id']);
    }
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }
}
