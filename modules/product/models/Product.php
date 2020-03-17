<?php

namespace app\modules\product\models;

use app\modules\admin\behaviors\SeoBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\category\models\Category;
use app\modules\direction\models\Direction;
use app\modules\eav\EavBehavior;
use app\modules\eav\EavTrait;
use app\modules\eav\models\EavAttribute;
use app\modules\eav\models\EavAttributeQuery;
use app\modules\eav\models\EavAttributeValue;
use app\modules\vendor\models\Vendor;
use PHPThumb\GD;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;
use yii2tech\ar\linkmany\LinkManyBehavior;

/**
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $category_id
 * @property int $vendor_id
 * @property int $price
 * @property string $code
 * @property string $title
 * @property string $hint
 * @property string $description
 * @property string $consumption
 * @property string $view
 * @property string $h1
 * @property string $meta_t
 * @property string $meta_d
 * @property string $meta_k
 *
 * @property Category $category
 * @property EavAttribute $eavAttributes
 * @property ProductImage[] $images
 * @property Direction[] $directions
 * @property Vendor $vendor
 * @property Variation[] $variations
 *
 * @mixin SeoBehavior
 * @mixin EavBehavior
 * @mixin ImageUploadBehavior
 * @mixin QueryExceptions
 */
class Product extends ActiveRecord
{
    use EavTrait;
    use QueryExceptions;

    const VIEW_DEFAULT = 'default';
    const VIEW_CALCULATOR = 'calculator';
    const VIEW_COLOR = 'color';

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SeoBehavior::class,
            [
                'class' => EavBehavior::class,
                'valueClass' => EavAttributeValue::class,
            ],
            'image' => [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['processor' => function (GD $thumb) {
                        $thumb->resize(270, 280);
                    }],
                    'view' => ['processor' => function (GD $thumb) {
                        $thumb->resize(171, 230);
                    }],
                ],
                'filePath' => '@webroot/uploads/product/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'fileUrl' => '/uploads/product/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/product/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
                'thumbUrl' => '/uploads/cache/product/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
            ],
            [
                'class' => LinkManyBehavior::class,
                'relation' => 'directions',
                'relationReferenceAttribute' => 'directionsIds',
            ],
        ];
    }

    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    public static function tableName()
    {
        return 'products';
    }

    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['title', 'code', 'h1', 'hint', 'meta_t', 'meta_d', 'meta_k', 'image_hash', 'view'], 'string', 'max' => 255],
            [['category_id', 'vendor_id'], 'integer'],
            [['price', 'consumption'], 'number'],
            ['description', 'string'],
            ['directionsIds', 'safe'],
            ['image', 'image', 'extensions' => ['jpeg', 'jpg', 'png'], 'checkExtensionByMimeType' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата редактирования',
            'code' => 'Артикул',
            'category_id' => 'Категория',
            'images' => 'Фото',
            'title' => 'Название',
            'hint' => 'Подпись',
            'description' => 'Описание',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
            'h1' => 'H1',
            'price' => 'Цена',
            'view' => 'Отображение на сайте',
            'vendor_id' => 'Производитель',
            'image' => 'Прикрепить изображение',
            'directionsIds' => 'Направления',
            'consumption' => 'Расход, кв.м. на 1л.',
        ];
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
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

    /**
     * @throws \yii\base\InvalidConfigException
     * @return EavAttributeQuery
     */
    public function getEavAttributes(): ActiveQuery
    {
        return $this->hasMany(EavAttribute::class, ['id' => 'attribute_id'])
            ->viaTable(EavAttributeValue::tableName(), ['entity_id' => 'id']);
    }

    public function getDirections()
    {
        return $this->hasMany(Direction::class, ['id' => 'product_id'])->viaTable('product_directions', ['direction_id' => 'id']);
    }

    public function getHref($scheme = false)
    {
        return Url::to(['/product/frontend/view', 'id' => $this->id], $scheme);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getImages()
    {
        return $this->hasMany(ProductImage::class, ['product_id' => 'id'])->orderBy('position');
    }

    public function getVariations()
    {
        return $this->hasMany(Variation::class, ['product_id' => 'id'])->orderBy('position');
    }

    public function getVendor()
    {
        return $this->hasOne(Vendor::class, ['id' => 'vendor_id']);
    }

    public function getPrice()
    {
        return $this->price;
    }
}
