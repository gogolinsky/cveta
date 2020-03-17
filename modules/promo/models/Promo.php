<?php

namespace app\modules\promo\models;

use app\modules\admin\behaviors\SeoBehavior;
use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "promos".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $alias
 * @property string $title
 * @property string $image
 * @property string $content
 * @property string $h1
 * @property string $meta_t
 * @property string $meta_d
 * @property string $meta_k
 *
 * @mixin ImageUploadBehavior
 * @mixin SeoBehavior
 * @mixin PositionBehavior
 */
class Promo extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SeoBehavior::class,
            PositionBehavior::class,
            'image' => [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 370, 'height' => 460],
                    'view' => ['width' => 470, 'height' => 584],
                ],
                'filePath' => '@webroot/uploads/promo/image_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/promo/image_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/promo/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/promo/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return 'promos';
    }

    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            ['alias', 'unique'],
            ['content', 'string'],
            [['title', 'alias', 'h1', 'meta_t', 'meta_d', 'meta_k'], 'string', 'max' => 255],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'title' => 'Заголовок',
            'alias' => 'Алиас',
            'image' => 'Картинка',
            'content' => 'Контент',
            'h1' => 'H1',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
        ];
    }

    public function getHref()
    {
        return Url::to(['/promo/frontend/view', 'alias' => $this->alias]);
    }

    public function hasImage()
    {
        return !empty($this->image) && file_exists($this->getUploadedFilePath('image'));
    }

    public function deleteImage()
    {
        /** @var ImageUploadBehavior $imageBehavior */
        $imageBehavior = $this->getBehavior('image');
        $imageBehavior->cleanFiles();
        $this->updateAttributes(['image' => null]);
    }

    public function getTitle()
    {
        return $this->title;
    }
}