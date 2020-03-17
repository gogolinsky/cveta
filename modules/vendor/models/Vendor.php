<?php

namespace app\modules\vendor\models;

use app\modules\admin\behaviors\SeoBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\product\models\Product;
use PHPThumb\GD;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "vendors".
 *
 * @property int $id
 * @property int $position
 * @property string $title
 * @property string $alias
 * @property string $hint
 * @property string $content
 * @property string $image
 * @property string $h1
 * @property string $meta_t
 * @property string $meta_d
 * @property string $meta_k
 *
 * @property Product[] $products
 *
 * @mixin PositionBehavior
 * @mixin ImageUploadBehavior
 * @mixin SeoBehavior
 */
class Vendor extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            SeoBehavior::class,
            PositionBehavior::class,
            'image' => [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['processor' => function(GD $thumb) {
        	            return $thumb->resize(97, 47);
                    }],
                    'view' => ['processor' => function(GD $thumb) {
        	            return $thumb->resize(210, 110);
                    }],
                ],
                'filePath' => '@webroot/uploads/vendor/image_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/vendor/image_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/vendor/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/vendor/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
            ],
            'background' => [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'background',
                'thumbs' => [
                    'thumb' => ['width' => 1440, 'height' => 420],
                ],
                'filePath' => '@webroot/uploads/vendor/background_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/vendor/background_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/vendor/background_[[md5_attribute_background]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/vendor/background_[[md5_attribute_background]]_[[profile]]_[[pk]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return 'vendors';
    }

    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            [['alias'], 'unique'],
            ['content', 'string'],
            ['position', 'integer'],
            [['title', 'alias', 'hint', 'h1', 'meta_k', 'meta_t', 'meta_d', 'image_hash'], 'string', 'max' => 255],
            [['image', 'background'], 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'alias' => 'Алиас',
            'hint' => 'Подпись',
            'content' => 'Контент',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
            'h1' => 'H1',
            'image' => 'Прикрепить изображение',
            'background' => 'Фоновая картинка',
        ];
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getHref()
    {
        return Url::to(['/vendor/frontend/view', 'alias' => $this->alias]);
    }

    public function getH1()
    {
        return $this->h1 ?? $this->title;
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['vendor_id' => 'id']);
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
}
