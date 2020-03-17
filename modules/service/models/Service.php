<?php

namespace app\modules\service\models;

use app\modules\admin\behaviors\SeoBehavior;
use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $alias
 * @property string $title
 * @property string $slogan
 * @property string $image
 * @property string $background
 * @property string $content
 * @property string $features
 * @property string $price
 * @property string $price_list
 * @property string $h1
 * @property string $meta_t
 * @property string $meta_d
 * @property string $meta_k
 *
 * @mixin ImageUploadBehavior
 * @mixin SeoBehavior
 * @mixin PositionBehavior
 */
class Service extends ActiveRecord
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
                    'thumb' => ['width' => 370, 'height' => 450],
                ],
                'filePath' => '@webroot/uploads/service/image_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/service/image_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/service/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/service/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
            ],
            'background' => [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'background',
                'thumbs' => [
                    'thumb' => ['width' => 1440, 'height' => 535],
                ],
                'filePath' => '@webroot/uploads/service/background_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/service/background_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/service/background_[[md5_attribute_background]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/service/background_[[md5_attribute_background]]_[[profile]]_[[pk]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return 'services';
    }

    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            ['alias', 'unique'],
            [['content', 'features', 'price_list'], 'string'],
            [['title', 'alias', 'slogan', 'price', 'h1', 'meta_t', 'meta_d', 'meta_k'], 'string', 'max' => 255],
            [['image', 'background'], 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'slogan' => 'Слоган',
            'title' => 'Заголовок',
            'alias' => 'Алиас',
            'image' => 'Детальная картинка',
            'background' => 'Фоновая картинка',
            'features' => 'Особенности',
            'price' => 'Цена',
            'price_list' => 'Прайс-лист',
            'content' => 'Контент',
            'h1' => 'H1',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
        ];
    }

    public function getHref()
    {
        return Url::to(['/service/frontend/view', 'alias' => $this->alias]);
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

    public function getPrices()
    {
        return array_map(function($line) {
            return [
                'title' => trim(mb_substr($line, 0, mb_strpos($line, ':'))),
                'value' => trim(mb_substr($line, mb_strpos($line, ':') + 1)),
            ];
        }, array_filter(explode(PHP_EOL, $this->price_list)));
    }
}