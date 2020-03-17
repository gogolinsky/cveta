<?php

namespace app\modules\page\models;

use app\modules\admin\behaviors\SeoBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\page\components\Pages;
use creocoder\nestedsets\NestedSetsBehavior;
use PHPThumb\GD;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property string $id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $parent_id
 * @property string $alias
 * @property string $title
 * @property string $caption
 * @property string $content
 * @property string $route
 * @property string $h1
 * @property string $meta_d
 * @property string $meta_k
 * @property string $meta_t
 *
 * @property bool[] $options
 * @property PageElement[] $elements
 *
 * @mixin NestedSetsBehavior
 * @mixin SeoBehavior
 */
class Page extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SeoBehavior::class,
            NestedSetsBehavior::class,
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return PageQuery
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }

    public static function tableName()
    {
        return '{{%pages}}';
    }

    public function rules()
    {
        return [
            [['id', 'title', 'alias'], 'required'],
            [['id', 'alias'], 'unique'],
            ['id', 'match', 'pattern' => '/^[a-z]+[a-z-]*$/i'],
            [['id', 'parent_id'], 'string', 'max' => 50],
            [['title', 'alias', 'route', 'caption', 'meta_d', 'meta_k', 'meta_t', 'h1'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['route'], 'default',  'value' => null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'parent_id' => 'Родительская страница',
            'alias' => 'Алиас',
            'route' => 'Роут',
            'title' => 'Заголовок',
            'caption' => 'Подпись',
            'content' => 'Контент',
            'h1' => 'H1',
            'is_route' => 'Тип ссылки',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
        ];
    }

    public function currentParent()
    {
        $current_parent = $this->parents(1)->one();
        $parent = is_null($current_parent) ? '0' : $current_parent->id;

        return $parent;
    }

    public function getHref()
    {
        return !empty($this->route) ? Url::to([$this->route]) : Url::to(['/page/frontend/view', 'alias' => $this->alias]);
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $id
     * @return Page
     */
    public static function getOrCreate($id)
    {
        $page = Page::findOne(['id' => $id]);
        
        return (null !== $page) ? $page : new Page(['id' => $id]);
    }

    public function saveElements()
    {
        $saveElementKeys = [];

        if (!empty(\Yii::$app->request->post('Page')['elements'])) {

            foreach (\Yii::$app->request->post('Page')['elements'] as $key => $arElement)
            {
                if(!empty($arElement['value'])) {
                    $this->setElement($key, $arElement['value']);
                    $saveElementKeys[$key] = $key;
                }
            }
        }

        PageElement::deleteAll([
            'AND',
            ['page_id' => $this->id],
            ['NOT IN', 'key', $saveElementKeys],
        ]);
    }

    public function isActive()
    {
        return $this->lft <= Pages::getCurrentPage()->lft && $this->rgt >= Pages::getCurrentPage()->rgt;
    }

    public function getElements()
    {
        return $this->hasMany(PageElement::class, ['page_id' => 'id'])->indexBy('key');
    }

    public function setElement($key, $value)
    {
        $element = $this->getElements()->andWhere(['key' => $key])->one()
            ?? new PageElement([
                'page_id' => $this->id,
                'key' => $key,
            ]);

        $element->value = $value;
        $element->save();
    }
}
