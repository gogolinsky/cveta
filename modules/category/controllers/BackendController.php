<?php

namespace app\modules\category\controllers;

use app\modules\admin\components\BalletController;
use app\modules\category\helpers\CategoryHelper;
use app\modules\category\models\Category;
use app\modules\category\models\CategorySearch;
use Yii;
use InvalidArgumentException;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class BackendController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $category = new Category();

        if (Yii::$app->request->isAjax && $category->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($category);
        }

        if ($category->load(Yii::$app->request->post())) {

            $parent = Category::findOne($category->parent_id);

            if (null === $parent) {
                throw new InvalidArgumentException('No category with id ' . $category->parent_id);
            }

            $category->appendTo($parent);

            return $this->redirect(['update', 'id' => $category->id]);
        }

        list($dropDownArray, $dropDownOptionsArray) = CategoryHelper::generateDropDownArrays();

        return $this->render('create', compact('category', 'dropDownArray', 'dropDownOptionsArray'));
    }

    public function actionUpdate($id)
    {
        $category = Category::getOrFail($id);

        if (Yii::$app->request->isAjax && $category->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($category);
        }

        if ($category->load(Yii::$app->request->post())) {
            $currentParentId = $category->currentParent();

            if ($category->parent_id != $currentParentId) {
                $newParentModel = Category::getOrFail($category->parent_id);
                $category->appendTo($newParentModel);
            } else {
                $category->save();
            }

            return $this->redirect(['update', 'id' => $category->id]);
        }

        [$dropDownArray, $dropDownOptionsArray] = CategoryHelper::generateDropDownArrays($category);
        $category->parent_id = $category->currentParent();

        return $this->render('_main', compact('category', 'dropDownArray', 'dropDownOptionsArray'));
    }

    public function actionSeo($id)
    {
        $category = Category::getOrFail($id);

        if ($category->load(Yii::$app->getRequest()->post()) && $category->save()) {
            return $this->refresh();
        }

        return $this->render('_seo', compact('category'));
    }

    public function actionDelete($id)
    {
        $category = Category::getOrFail($id);
        $category->deleteWithChildren();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        $category = Category::getOrFail($id);
        $category->deleteImage();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionMoveUp($id)
    {
        $category = Category::getOrFail($id);
        $prev = $category->prev()->one();

        if (null !== $prev) {
            $category->insertBefore($prev);
        }
    }

    public function actionMoveDown($id)
    {
        $category = Category::getOrFail($id);
        $next = $category->next()->one();

        if (null !== $next) {
            $category->insertAfter($next);
        }
    }
}
