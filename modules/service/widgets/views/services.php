<?php

use app\modules\service\widgets\ServiceWidget;

/**
 * @var \yii\web\View $this
 * @var \app\modules\service\models\Service[] $services
 */

?>

<?php if (!empty($services)): ?>
    <section class="section">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">Наши услуги</h2>
                <p class="section__caption">Предпочитаем перед продажей подробно консультировать клиентов, дабы избежать ошибок и недочетов</p>
            </header>
            <div class="section__body">
                <ul class="services">
                    <?php foreach ($services as $service): ?>
                        <li class="services__item">
                            <?= ServiceWidget::widget(compact('service')) ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif ?>