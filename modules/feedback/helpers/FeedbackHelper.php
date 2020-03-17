<?php

namespace app\modules\feedback\helpers;

use app\modules\feedback\factories\FormFactory;
use app\modules\feedback\models\Feedback;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\helpers\Url;

class FeedbackHelper
{
    public static function getGridColumns($columnNames)
    {
        return array_map(function($name){
            switch ($name) {
                case 'view': return [
                        'class' => ActionColumn::class,
                        'template' => '{view}',
                        'width' => '150px',
                        'mergeHeader' => false,
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return '<span 
                                    href="'.Url::to(['/feedback/backend/default/view', 'id' => $model->id]).'"
                                    class="btn btn-xs btn-primary"
                                    data-toggle="modal"
                                    data-pjax="0"
                                    data-target="#modal-lg"
                                ><i class="fa fa-eye"></i> Просмотр</span>';
                            },
                        ],
                    ];
                case 'status': return [
                        'class' => DataColumn::class,
                        'vAlign' => GridView::ALIGN_MIDDLE,
                        'attribute' => 'status',
                        'format' => 'raw',
                        'width' => '100px',
                        'filter' => StatusHelper::getStatusList(),
                        'value' => function(Feedback $feedback) {
                            return self::getStatusButton($feedback);
                        }
                    ];
                case 'created_at': return [
                        'class' => DataColumn::class,
                        'vAlign' => GridView::ALIGN_MIDDLE,
                        'label' => 'Дата заявки',
                        'attribute' => 'created_at',
                        'width' => '120px',
                        'value' => function(Feedback $feedback) {
                            return date('d.m.Y H:i', $feedback->created_at);
                        }
                    ];
                case 'name': return [
                        'class' => DataColumn::class,
                        'vAlign' => GridView::ALIGN_MIDDLE,
                        'attribute' => 'name',
                    ];
                case 'phone': return [
                        'class' => DataColumn::class,
                        'vAlign' => GridView::ALIGN_MIDDLE,
                        'attribute' => 'phone',
                    ];
                case 'id': return [
                        'class' => DataColumn::class,
                        'vAlign' => GridView::ALIGN_MIDDLE,
                        'attribute' => 'id',
                        'width' => '50px',
                    ];
                default: return [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'attribute' => $name,
                ];
            }
        }, $columnNames);
    }

    public static function getMenuItems()
    {
        return array_filter(array_map(function($formClass) {
            return self::getItemMenu($formClass);
        }, FormFactory::$types));
    }

    public static function getItemMenu($formClass)
    {
        return [
            'label' => $formClass::TITLE . Badge::getBadge($formClass::TYPE),
            'icon' => $formClass::ICON,
            'options' => ['style' => 'position: relative'],
            'url' => ['/feedback/backend/default/index', 'type' => $formClass::TYPE],
        ];
    }

    public static function getStatusButton (Feedback $feedback)
    {
        return '<button 
            data-target="#modal-lg"
            data-toggle="modal"
            href="' . Url::to(['/feedback/backend/default/view', 'id' => $feedback->id]) . '" 
            class="btn btn-xs btn-' . StatusHelper::getStatusClass($feedback->status) . '"
        >' . StatusHelper::getStatusText($feedback->status) . '</button>';
    }

}