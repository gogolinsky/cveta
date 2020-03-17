<?php

namespace app\modules\post\models;

use app\modules\admin\behaviors\SeoBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\product\models\Product;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii2tech\ar\linkmany\LinkManyBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property string $alias
 * @property string $image
 * @property string $content
 * @property string $h1
 * @property string $meta_t
 * @property string $meta_d
 * @property string $meta_k
 *
 * @property Product[] $products
 * @property PostImage[] $images
 *
 * @mixin ImageUploadBehavior
 * @mixin SeoBehavior
 */
class Post extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SeoBehavior::class,
            'image' => [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 368, 'height' => 230],
                    'origin' => ['width' => 1170, 'height' => 650],
                ],
                'filePath' => '@webroot/uploads/post/image_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/post/image_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/post/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/post/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
            ],
            [
                'class' => LinkManyBehavior::class,
                'relation' => 'products',
                'relationReferenceAttribute' => 'productsIds',
            ],
        ];
    }

    public static function tableName()
    {
        return 'posts';
    }

    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            ['alias', 'unique'],
            ['content', 'string'],
            [['title', 'alias', 'h1', 'meta_t', 'meta_d', 'meta_k'], 'string', 'max' => 255],
            ['productsIds', 'safe'],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'title' => 'Заголовок',
            'alias' => 'Алиас',
            'image' => 'Прикрепить изображение',
            'content' => 'Описание',
            'h1' => 'H1',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
            'productsIds' => 'Товары',
            'images' => 'Фото',
        ];
    }

    public function getHref()
    {
        return Url::to(['/post/frontend/view', 'alias' => $this->alias]);
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

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('post_products', ['post_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(PostImage::class, ['post_id' => 'id'])->orderBy('position');
    }
}
