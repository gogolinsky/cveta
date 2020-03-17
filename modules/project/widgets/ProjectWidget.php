<?php

namespace app\modules\project\widgets;

use yii\base\Widget;

/**
 * @property \app\modules\project\models\Project $project
 */
class ProjectWidget extends Widget
{
    public $project;

    public function run()
    {
        return $this->render('project', [
            'project' => $this->project,
        ]);
    }
}