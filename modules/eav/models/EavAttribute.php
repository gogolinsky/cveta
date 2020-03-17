<?php

namespace app\modules\eav\models;

use app\modules\admin\traits\QueryExceptions;
use app\modules\product\models\Product;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\FileUploadBehavior;

/**
 * This is the model class for table "{{%eav_attribute}}".
 *
 * @property int $id
 * @property int $type_id
 * @property int $position
 * @property string $name
 * @property string $label
 * @property string $title
 * @property string $unit
 * @property string $description
 * @property string $default_value
 * @property int $default_option_id
 * @property int $required
 * @property int $is_important
 * @property int $in_filter
 * @property string $icon
 * @property string $icon_hash
 *
 * @property EavAttributeOption[] $eavAttributeOptions
 * @property EavAttributeValue[] $eavAttributeValues
 * @property Product[] $products
 *
 * @mixin PositionBehavior
 * @mixin FileUploadBehavior
 */
class EavAttribute extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            PositionBehavior::class,
            'icon' => [
                'class' => FileUploadBehavior::class,
                'attribute' => 'icon',
                'filePath' => '@webroot/uploads/eav/[[pk]]_[[attribute_icon_hash]].[[extension]]',
                'fileUrl' => '/uploads/eav/[[pk]]_[[attribute_icon_hash]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%eav_attribute}}';
    }

    public function rules()
    {
        return [
            [['title', 'name'], 'required'],
            ['name', 'unique'],
            [['name', 'label', 'title', 'description', 'default_value'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 50],
            [['type_id', 'in_filter'], 'integer'],
            [['required', 'is_important'], 'boolean'],
            ['in_filter', 'compare', 'compareValue' => 0, 'operator' => '==', 'type' => 'number', 'when' => function ($eavAttribute) {
                return $eavAttribute->type_id == 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('#eavattribute-type_id').val() == 1;
            }", 'message' => 'Выберите тип «Выпадающий список»'],
            ['icon', 'file', 'skipOnEmpty' => true, 'extensions' => ['svg'], 'checkExtensionByMimeType' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Тип',
            'name' => 'Алиас',
            'title' => 'Полное название',
            'label' => 'Короткое название',
            'unit' => 'Ед. измерения',
            'description' => 'Описание',
            'is_important' => 'Выводить в превью',
            'in_filter' => 'Выводить в фильтре',
            'icon' => 'Иконка',
        ];
    }

    /**
     * @return EavAttributeQuery
     */
    public static function find()
    {
        return new EavAttributeQuery(get_called_class());
    }

    public function getDefaultOption()
    {
        return $this->hasOne(EavAttributeOption::class, ['id' => 'default_option_id']);
    }

    public function getEavType()
    {
        return $this->hasOne(EavAttributeType::class, ['id' => 'type_id']);
    }

    public function getEavOptions()
    {
        return $this->hasMany(EavAttributeOption::class, ['attribute_id' => 'id']);
    }

    public function getEavAttributeValues()
    {
        return $this->hasMany(EavAttributeValue::class, ['attribute_id' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'entity_id'])
            ->viaTable('eav_attribute_value', ['attribute_id' => 'id']);
    }

    public function getLabel()
    {
        return (bool) $this->label ? $this->label : $this->title;
    }

    public function getbootstrapData()
    {
      return [
        'cid' => '',
        'label' => '',
        'field_type' => '',
        'required' => '',
        'field_options' => [],
      ];
    }

    public function inFilter()
    {
        return (bool) $this->in_filter;
    }

    public function showIcon()
    {
        if ($this->hasIcon()) {
            readfile($this->getUploadedFilePath('icon'));
        }
    }

    public function hasIcon()
    {
        return !empty($this->icon) && file_exists($this->getUploadedFilePath('icon'));
    }

    public function beforeSave($insert)
    {
        if ($this->icon instanceof UploadedFile) {
            $this->icon_hash = uniqid();
        }
        return parent::beforeSave($insert);
    }

    public function deleteIcon()
    {
        /** @var FileUploadBehavior $fileBehavior */
        $fileBehavior = $this->getBehavior('icon');
        $fileBehavior->cleanFiles();
        $this->updateAttributes([
            'icon' => null,
            'icon_hash' => null,
        ]);
    }
}