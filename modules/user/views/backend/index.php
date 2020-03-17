<?php

use app\modules\user\models\User;
use kartik\date\DatePicker;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\icons\Icon;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \app\modules\user\models\UserSearch $searchModel
 */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = 'Пользователи';

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'bordered' => false,
    'pjax' => false,
    'striped' => false,
    'hover' => false,
    'panel' => ['type' => GridView::TYPE_ACTIVE, 'before', 'after' => false],
    'toolbar' => [
        [
            'content'=>
                Html::a(Icon::show('plus-outline') . ' Добавить', ['create'], ['data-pjax' => 0, 'class' => 'btn btn-success'])
                . ' '
                . Html::a(Icon::show('arrow-sync-outline'), ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default'])
        ],
        '{toggleData}',
        '{export}',
    ],
    'toggleDataOptions' => [
        'all' => ['icon' => 'resize-full', 'label' => 'Показать все', 'class' => 'btn btn-default', 'title' => 'Показать все'],
        'page' => ['icon' => 'resize-small', 'label' => 'Страницы', 'class' => 'btn btn-default', 'title' => 'Постаничная разбивка'],
    ],
    'export' => [
        'target' => GridView::TARGET_BLANK,
        'label' => 'Экспорт',
        'header' => '<li role="presentation" class="dropdown-header">Экспорт данных</li>',
    ],
    'exportConfig' => [
        GridView::CSV => [
            'label' => 'CSV',
            'icon' => 'floppy-open',
            'iconOptions' => ['class' => 'text-primary'],
            'showHeader' => true,
            'showPageSummary' => true,
            'showFooter' => true,
            'showCaption' => true,
            'filename' => 'client_export_cvs',
            'mime' => 'application/csv',
            'config' => [
                'colDelimiter' => ",",
                'rowDelimiter' => "\r\n",
            ]
        ],
    ],
    'columns' => [
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'id',
            'width' => '100px',
        ],
        [
            'attribute' => 'created_at',
            'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'date_from',
                'attribute2' => 'date_to',
                'type' => DatePicker::TYPE_RANGE,
                'separator' => '-',
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
            ]),
            'width' => '300px',
            'value' => function(User $user) {
                return date('d.m.Y H:i:s', $user->created_at);
            }
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'email',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'format' => 'raw',
            'attribute' => 'is_active',
            'label' => 'Статус',
            'filter' => [0 => 'Не активный', 1 => 'Активный'],
            'value' => function (User $user) {
                return $user->isActive()
                    ? "<form method='post' action='". Url::to(['/user/backend/block', 'id' => $user->id]) . "'>".Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken(), [])."<button type='submit' class='btn btn-xs btn-success' title='Заблокировать'>Активный</button></form>"
                    : "<form method='post' action='". Url::to(['/user/backend/unblock', 'id' => $user->id]) . "'>".Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken(), [])."<button type='submit' class='btn btn-xs btn-danger' title='Разблокировать'>Не активный</button></form>";
            }
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'format' => 'raw',
            'attribute' => 'is_confirm',
            'label' => 'Email подтвержден',
            'filter' => [0 => 'Нет', 1 => 'Да'],
            'value' => function (User $user) {
                return $user->isConfirmed()
                    ? "<form method='post' action='". Url::to(['/user/backend/unconfirm', 'id' => $user->id]) . "'>".Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken(), [])."<button type='submit' class='btn btn-xs btn-success' title='Отменить подтверждение'>Да</button></form>"
                    : "<form method='post' action='". Url::to(['/user/backend/confirm', 'id' => $user->id]) . "'>".Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken(), [])."<button type='submit' class='btn btn-xs btn-danger' title='Подтвердить'>Нет</button></form>";
            }
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{update}',
            'width' => '150px',
            'mergeHeader' => false,
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="fa fa-pencil"></i> Редактировать', $url, [
                        'class' => 'btn btn-xs btn-primary',
                        'data-pjax' => '0',
                    ]);
                },
            ],
        ],
    ],
]) ?>