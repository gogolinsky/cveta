<?php

namespace app\modules\category\controllers;

use app\modules\category\models\Category;
use app\modules\filter\forms\FilterForm;
use app\modules\product\widgets\ListWidget;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $categories = Category::find()->where(['depth' => 1])->orderBy('lft')->all();

        return $this->render('index', compact('categories'));
    }

    public function actionView($alias)
    {
        $this->layout = '/thin';
        $category = Category::getOrFail(compact('alias'));
        $filterForm = new FilterForm(compact('category'));
        $filterForm->load(Yii::$app->request->get());
        $dataProvider = $filterForm->filter();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['html' => ListWidget::widget(compact('dataProvider'))];
        }

        $parents = $category->parents()->andWhere(['>', 'depth', 0])->all();
        $children = $category->children(1)->all();

        if ($category->hasPaints()) {
            $this->layout = '/paints';
        }

        return $this->render('view', compact('category', 'parents', 'dataProvider', 'children', 'filterForm'));
    }
}
