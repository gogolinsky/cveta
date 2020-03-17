<?php

namespace app\modules\category\models;

use app\modules\admin\behaviors\SeoBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\product\models\Product;
use creocoder\nestedsets\NestedSetsBehavior;
use PHPThumb\GD;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property int $id
 * @property int $lft
 * @property int $depth
 * @property int $rgt
 * @property string $title
 * @property string $alias
 * @property string $hint
 * @property string $caption
 * @property string $content
 * @property int $has_paints
 * @property string $meta_t
 * @property string $meta_d
 * @property string $meta_k
 * @property string $h1
 * @property string $image
 * @property string $image_hash
 *
 * @property int $parent_id
 * @property Product[] $products
 *
 * @mixin SeoBehavior
 * @mixin NestedSetsBehavior
 * @mixin ImageUploadBehavior
 */
class Category extends ActiveRecord
{
    use QueryExceptions;

    public $parent_id;

    public function behaviors()
    {
        return [
            NestedSetsBehavior::class,
            SeoBehavior::class,
            TimestampBehavior::class,
            'image' => [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['processor' => function (GD $thumb) {
                        $thumb->resize(270, 280);
                    }],
                ],
                'filePath' => '@webroot/uploads/category/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'fileUrl' => '/uploads/category/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/category/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
                'thumbUrl' => '/uploads/cache/category/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return CategoryQuery
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public static function tableName()
    {
        return 'categories';
    }

    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            [['alias'], 'unique'],
            ['parent_id', 'integer'],
            ['image', 'image', 'extensions' => ['jpeg', 'jpg', 'png'], 'checkExtensionByMimeType' => false],
            [['title', 'alias', 'hint', 'meta_t', 'meta_d', 'meta_k', 'h1', 'image_hash', 'caption'], 'string', 'max' => 255],
            ['content', 'string'],
            ['has_paints', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'title' => 'Заголовок',
            'alias' => 'Алиас',
            'content' => 'Контент',
            'hint' => 'Подпись',
            'caption' => 'Краткое описание',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
            'h1' => 'H1',
            'image' => 'Прикрепить изображение',
            'has_paints' => 'Показывать палитру',
        ];
    }

    /**
     * @return int
     */
    public function currentParent()
    {
        $current_parent = $this->parents(1)->one();
        $parent = null === $current_parent ? 0 : (int) $current_parent->id;

        return $parent;
    }

    public function getHref()
    {
        return Url::to(['/category/frontend/view', 'alias' => $this->alias]);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function hasImage()
    {
        return !empty($this->image) && is_file($this->getUploadedFilePath('image'));
    }

    public function deleteImage()
    {
        /** @var ImageUploadBehavior $fileBehavior */
        $fileBehavior = $this->getBehavior('image');
        $fileBehavior->cleanFiles();
        $this->updateAttributes(['image' => null, 'image_hash' => null]);
    }

    public function beforeSave($insert)
    {
        if ($this->image instanceof UploadedFile) {
            $this->image_hash = uniqid();
        }
        return parent::beforeSave($insert);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    public function hasPaints()
    {
        return (bool) $this->has_paints;
    }
}
