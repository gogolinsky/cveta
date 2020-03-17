<?php

use Cekurte\Environment\Environment;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'sourceLanguage' => 'en-US',
    'name' => 'Мастерская цвета',
    'layout' => '@app/views/layouts/default.php',
    'language' => 'ru-RU',
    'bootstrap' => [
        'log',
        \app\modules\user\Bootstrap::class,
        'admin',
        'category',
        'product',
        'feedback',
        'page',
        'vendor',
        'service',
        'promo',
        'employee',
        'project',
        'post',
        'direction',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => \mihaildev\elfinder\Controller::class,
            'access' => ['@', '?'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl' => '@web',
                    'basePath' => '@webroot',
                    'path' => 'uploads/images',
                    'name' => 'Изображения'
                ],
                [
                    'baseUrl' => '@web',
                    'basePath' => '@webroot',
                    'path' => 'uploads/files',
                    'name' => 'Файлы'
                ],
            ]
        ]
    ],
    'modules' => [
        'user' => \app\modules\user\Module::class,
        'admin' => \app\modules\admin\Module::class,
        'gridview' => \kartik\grid\Module::class,
        'setting' => \app\modules\setting\Module::class,
        'page' => \app\modules\page\Module::class,
        'category' => \app\modules\category\Module::class,
        'product' => \app\modules\product\Module::class,
        'eav' => \app\modules\eav\Module::class,
        'feedback' => \app\modules\feedback\Module::class,
        'vendor' => \app\modules\vendor\Module::class,
        'service' => \app\modules\service\Module::class,
        'promo' => \app\modules\promo\Module::class,
        'employee' => \app\modules\employee\Module::class,
        'project' => \app\modules\project\Module::class,
        'post' => \app\modules\post\Module::class,
        'partner' => \app\modules\partner\Module::class,
        'cert' => \app\modules\cert\Module::class,
        'slider' => \app\modules\slider\Module::class,
        'filter' => \app\modules\filter\Module::class,
        'direction' => \app\modules\direction\Module::class,
    ],
    'components' => [
        'authManager' => \yii\rbac\DbManager::class,
        'assetManager' => [
            'class' => \yii\web\AssetManager::class,
            'appendTimestamp' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'sw4paa0OVs3wAGtfXBYU-5r9-OFpyfhq',
            'baseUrl' => '',
        ],
        'cache' => \yii\caching\FileCache::class,
        'user' => [
            'identityClass' => \app\modules\user\models\User::class,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            'useFileTransport' => YII_ENV_DEV,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => Environment::get('SMTP_HOST'),
                'username' => Environment::get('SMTP_USERNAME'),
                'password' => Environment::get('SMTP_PASSWORD'),
                'port' => Environment::get('SMTP_PORT'),
                'encryption' => Environment::get('SMTP_ENCRYPTION'),
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/contacts' => '/site/contact'
            ],
        ],
        'formatter' => [
            'class' => \yii\i18n\Formatter::class,
            'locale' => 'en',
            'dateFormat' => 'dd.MM.yyyy',
            'datetimeFormat' => 'dd.MM.yyyy hh:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'nullDisplay' => '<span class="text-muted">(Не&nbsp;задано)</span>',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = \yii\debug\Module::class;
}

return $config;
