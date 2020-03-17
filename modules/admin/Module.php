<?php

namespace app\modules\admin;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use Yii;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = Yii::$container;
        $container->set(CKEditor::class, [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                'toolbarGroups' => [
                    ['name' => 'clipboard', 'groups' => ['mode', 'undo', 'clipboard']],
                    ['name' => 'paragraph', 'groups' => ['list', 'align']],
                    ['name' => 'styles'],
                    ['name' => 'blocks'],
                    ['name' => 'basicstyles', 'groups' => ['colors', 'cleanup']],
                    ['name' => 'links', 'groups' => ['links', 'insert']],
                    ['name' => 'others'],
                ],
                'removeButtons' => 'Subscript,Superscript,Flash,Smiley,SpecialChar,PageBreak,Anchor,Font,Styles,BGColor,Unlink,PasteFromWord,CreateDiv',
                'inline' => false,
                'height' => '400px',
                'skin' => 'office2013',
                'forceEnterMode' => true,
                'allowedContent' => true,
                'fillEmptyBlocks' => false,
            ]),
        ]);

        $app->get('urlManager')->rules[] = new GroupUrlRule([
            'rules' => [
                '/admin' => '/admin/default/index',
            ],
        ]);
    }
}
