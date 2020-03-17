<?php

namespace app\modules\eav\traits;

use app\modules\eav\models\EavAttribute;
use app\modules\eav\models\EavAttributeValue;
use app\modules\product\models\Product;
use Yii;
use yii\base\ErrorException;
use yii\web\Response;

trait EavControllerTrait
{
    public function actionOptionCreate($id)
    {
        $entity = Product::findOne($id);

        if (null == $entity) {
            throw new ErrorException('No such product');
        }

        $model = new EavAttributeValue();
        $model->entity_id = $entity->id;

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->save()) {
                return ['message' => 'success'];
            }

            return ['message' => 'fail'];
        }

        $data = EavAttribute::find()
            ->indexBy('id')
            ->orderBy(['title' => SORT_ASC])
            ->select(['title'])
            ->where(['not', ['id' => EavAttributeValue::find()->where(['entity_id' => $entity->id])->select(['attribute_id'])->column()]])
            ->column();

        return $this->renderAjax('@app/modules/eav/views/trait/option_value_create', compact('model', 'entity', 'data', 'attribute'));
    }

    public function actionOptionUpdate($id)
    {
        $model = EavAttributeValue::findOne($id);

        if (null == $model) {
            throw new ErrorException('No such attribute value');
        }

        $entity = Product::findOne($model->entity_id);

        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($entity->save()) {
                return ['message' => 'success'];
            }

            return ['message' => 'fail'];
        }

        return $this->renderAjax('@app/modules/eav/views/trait/option_value_update', compact('model', 'entity'));
    }

    public function actionOptionDelete($id)
    {
        $model = EavAttributeValue::findOne($id);

        if (null == $model) {
            throw new ErrorException('No such attribute value');
        }

        EavAttributeValue::deleteAll(['entity_id' => $model->entity_id, 'attribute_id' => $model->attribute_id]);
    }
}