<?php

namespace app\modules\page\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\page\helpers\PageHelper;
use app\modules\page\models\Page;
use app\modules\page\models\PageSearch;
use Yii;
use yii\base\InvalidParamException;

class DefaultController extends BalletController
{

    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $page = new Page();

        if ($page->load(Yii::$app->request->post())) {
            /** @var Page $parent */
            $parent = Page::findOne($page->parent_id);

            if (null === $parent) {
                throw new InvalidParamException('No category with id ' . $page->parent_id);
            }

            $page->appendTo($parent);

            return $this->redirect(['update', 'id' => $page->id]);
        }

        [$dropDownArray, $dropDownOptionsArray] = PageHelper::generateDropDownArrays();

        return $this->render('create', compact('page', 'dropDownArray', 'dropDownOptionsArray'));
    }

    public function actionUpdate($id)
    {
        $page = Page::getOrFail($id);

        if ($page->load(Yii::$app->request->post())) {
            $currentParentId = $page->currentParent();

            if ($page->parent_id !== $currentParentId) {
                $newParentModel = Page::getOrFail($page->parent_id);
                $page->appendTo($newParentModel);
            } else {
                $page->save();
            }
            $page->saveElements();

            return $this->redirect(['update', 'id' => $page->id]);
        }

        [$dropDownArray, $dropDownOptionsArray] = PageHelper::generateDropDownArrays($page);
        $page->parent_id = $page->currentParent();

        return $this->render('update', compact('page', 'dropDownArray', 'dropDownOptionsArray'));
    }

    public function actionSeo($id)
    {
        $page = Page::getOrFail($id);

        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            return $this->refresh();
        }

        return $this->render('seo', compact('page'));
    }

    public function actionDelete($id)
    {
        Page::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }
}
