<?php

namespace app\modules\project\models;

use app\modules\admin\behaviors\SeoBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\employee\models\Employee;
use app\modules\product\models\Product;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii2tech\ar\linkmany\LinkManyBehavior;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property string $alias
 * @property string $date
 * @property string $task
 * @property string $works
 * @property string $image
 * @property string $description
 * @property string $review_text
 * @property string $review_post
 * @property string $review_name
 * @property string $review_image
 * @property string $h1
 * @property string $meta_t
 * @property string $meta_d
 * @property string $meta_k
 *
 * @property Product[] $products
 * @property Employee[] $employees
 * @property ProjectImage[] $images
 *
 * @mixin ImageUploadBehavior
 * @mixin PositionBehavior
 * @mixin SeoBehavior
 */
class Project extends ActiveRecord
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
                    'thumb' => ['width' => 570, 'height' => 430],
                    'origin' => ['width' => 1170, 'height' => 650],
                ],
                'filePath' => '@webroot/uploads/project/image_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/project/image_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/project/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/project/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
            ],
            'review_image' => [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'review_image',
                'thumbs' => [
                    'thumb' => ['width' => 385, 'height' => 434],
                    'origin' => ['width' => 1170, 'height' => 650],
                ],
                'filePath' => '@webroot/uploads/project/review_image_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/project/review_image_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/project/review_image_[[md5_attribute_review_image]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/project/review_image_[[md5_attribute_review_image]]_[[profile]]_[[pk]].[[extension]]',
            ],
            [
                'class' => LinkManyBehavior::class,
                'relation' => 'products',
                'relationReferenceAttribute' => 'productsIds',
            ],
            [
                'class' => LinkManyBehavior::class,
                'relation' => 'employees',
                'relationReferenceAttribute' => 'employeesIds',
            ]
        ];
    }

    public static function tableName()
    {
        return 'projects';
    }

    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            ['alias', 'unique'],
            [['description', 'works'], 'string'],
            [['title', 'alias', 'date', 'task', 'review_text', 'review_post', 'review_name', 'h1', 'meta_t', 'meta_d', 'meta_k'], 'string', 'max' => 255],
            [['productsIds', 'employeesIds'], 'safe'],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
            ['review_image', 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
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
            'date' => 'Дата сдачи',
            'task' => 'Поставленная задача',
            'works' => 'Выполненные работы',
            'image' => 'Прикрепить изображение',
            'description' => 'Описание',
            'h1' => 'H1',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
            'productsIds' => 'Товары',
            'employeesIds' => 'Сотрудники',
            'review_text' => 'Отзыв',
            'review_post' => 'Должность',
            'review_name' => 'Имя',
            'review_image' => 'Прикрепить изображение',
            'images' => 'Фото',
        ];
    }

    public function getHref()
    {
        return Url::to(['/project/frontend/view', 'alias' => $this->alias]);
    }

    public function hasImage()
    {
        return !empty($this->image) && file_exists($this->getUploadedFilePath('image'));
    }

    public function hasImageReview()
    {
        return !empty($this->review_image) && file_exists($this->getUploadedFilePath('review_image'));
    }

    public function deleteImage()
    {
        /** @var ImageUploadBehavior $imageBehavior */
        $imageBehavior = $this->getBehavior('image');
        $imageBehavior->cleanFiles();
        $this->updateAttributes(['image' => null]);
    }

    public function deleteImageReview()
    {
        /** @var ImageUploadBehavior $imageBehavior */
        $imageBehavior = $this->getBehavior('review_image');
        $imageBehavior->cleanFiles();
        $this->updateAttributes(['review_image' => null]);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('project_products', ['project_id' => 'id']);
    }

    public function getEmployees()
    {
        return $this->hasMany(Employee::class, ['id' => 'employee_id'])->viaTable('project_employees', ['project_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(ProjectImage::class, ['project_id' => 'id'])->orderBy('position');
    }
}
